<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadTest extends Model
{
    /**
     * @var UploadedFile
     */
    public $testFile;
    public $description;

    public function rules()
    {
        return [
            [['description'], 'required'],
            [['testFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'txt'],
            [['description'], 'string'],
            [['description'],'safe'],
           
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'description' => 'Descripción',
            'testFile' => 'Archivo de Texto',
        ];
    }
    
    public function upload()
    {
    
        if ($this->validate()) {
            $this->testFile->saveAs('uploads/' . $this->testFile->baseName . '.' . $this->testFile->extension);
            $this->process_file();
            return true;
        } else {
            return false;
        }
    }
    
    private function process_file(){
        
        $file = file_get_contents('uploads/' . $this->testFile->baseName . '.' . $this->testFile->extension);
        
        $test = new Test();
                $test->description = $this->description;
                $test->save();
        
        //Obtengo bloques pregunta-respuestas
        
        $bloques = preg_split("/[\s]*[\d]+[.][\s]/",$file);
        
            //Elimino elementos vacíos y reseteo índices
        
        $bloques = array_values(array_filter($bloques, "strlen"));
        
        
        foreach($bloques as $bloque){
            
            $elements = preg_split("/[\s][a-z][.][\s]/",$bloque);
                
            $bloque_pregunta = $elements[0];
            $bloque_respuestas = array_slice($elements,1);
                
            // Procesado del bloque de la pregunta
                
            $elements_pregunta = preg_split("/[\[\[]/",$bloque_pregunta);
                
                // Elimino elementos vacíos en el array y reseteo indices
            $elements_pregunta=array_values(array_filter($elements_pregunta, "strlen"));
            
            $texto_pregunta;
            $categorias = [];
            $imagen = 0;                        
                
            
            if (isset($elements_pregunta[1])){ 
                
                $texto_pregunta = trim($elements_pregunta[0]);
                
                $categoria_e_imagen = trim(str_replace("]]", "",$elements_pregunta[1]));
                
                $categoria_e_imagen = preg_split("/[{{]/",$categoria_e_imagen);
                
                    // Elimino elementos vacíos en el array y reseteo indices
                $categoria_e_imagen=array_values(array_filter($categoria_e_imagen, "strlen"));
                
                if(isset($categoria_e_imagen[1])){
                    
                    $categorias = array_map("trim",explode(',',trim($categoria_e_imagen[0])));
                    
                    $imagen = trim(str_replace("}}", "",$categoria_e_imagen[1]));
                    
                     
                    var_dump("Pregunta");
                    var_dump($texto_pregunta);
                    var_dump("Categorias");
                    var_dump($categorias);
                    var_dump("Imagen");
                    var_dump($imagen);
                    
                }else {
                    
                    $categorias = array_map("trim",explode(',',trim($categoria_e_imagen[0])));
                     
                    var_dump("Pregunta");
                    var_dump($texto_pregunta);
                    var_dump("Categorias");
                    var_dump($categorias);
                    var_dump("Imagen");
                    var_dump($imagen);
                                     
                }    
                
            }else {
                    
                
                $pregunta_e_imagen = preg_split("/[{{]/",$elements_pregunta[0]);
                    
                        //Elimino elementos vacios y reseteo indices
                    
                $pregunta_e_imagen = array_values(array_filter($pregunta_e_imagen, "strlen"));
                    
                if(isset($pregunta_e_imagen[1])){
                        
                        
                    $texto_pregunta = trim($pregunta_e_imagen[0]);
                    $imagen = trim(str_replace("}}", "",$pregunta_e_imagen[1]));
                                              
                    var_dump("Pregunta");
                    var_dump($texto_pregunta);                                           
                    var_dump("Categorias");
                    var_dump($categorias);
                    var_dump("Imagen");
                    var_dump($imagen);
                    
                }else{
                    
                    $texto_pregunta = trim($pregunta_e_imagen[0]);
                    var_dump("Pregunta");
                    var_dump($texto_pregunta);                                           
                    var_dump("Categorias");
                    var_dump($categorias);
                    var_dump("Imagen");
                    var_dump($imagen);
                    
                }  
                    
                    
            }
                
            // Tratamiento del bloque de la respuesta   
                
            $cadena_respuesta_correcta = "xxxxxxxx";
            $respuesta_correcta = "";
            $respuestas = [];
                
            foreach($bloque_respuestas as $key => $respuesta){
                    
                $pos = strpos($respuesta,$cadena_respuesta_correcta);
                    
                if($pos !== false){
                    $respuesta_correcta = chr($key+97);
                    $respuesta = str_replace($cadena_respuesta_correcta," ",$respuesta);
                }
                    $respuestas[] = trim($respuesta);
                                        
                }
                
                var_dump("Respuestas");
                var_dump($respuestas);
                var_dump($respuesta_correcta);
                  
                $pregunta = new Pregunta();
                $pregunta->texto = $texto_pregunta;
                $pregunta->respuesta_correcta = $respuesta_correcta;
                $pregunta->save();
                $pregunta->link('tests',$test);                
               
                
                foreach($respuestas as $texto_respuesta){
                    
                    $respuesta = new Respuesta();
                    $respuesta->texto = $texto_respuesta;
                    $respuesta->link('pregunta',$pregunta);
                    
                    
                }
                
                if(!empty($categorias)){
                    
                    foreach($categorias as $texto_categoria){
                    
                        $categoria = Categoria::findOne([
                           'texto' => $texto_categoria,                   
                       ]);
                        
                        if(!is_null($categoria)){
                            
                            $pregunta->link('categorias',$categoria); 
                            
                        }
                                         
                    }
                                    
                    
                    
                }else{
                    
                   $no_category = "Sin Categoria"; 
                   $categoria = Categoria::findOne([
                       'texto' => $no_category,                   
                   ]);
                   
                   
                   $pregunta->link('categorias',$categoria);
                    
                    
                    
                    
                }
               
                
        }
        
        
    }
}