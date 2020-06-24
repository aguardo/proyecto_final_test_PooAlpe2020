<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'txt'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $this->process_file();
            return true;
        } else {
            return false;
        }
    }
    
    private function process_file(){
        
        $file = file_get_contents('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
        
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
            
            $pregunta;
            $categorias = [];
            $image = 0;                        
                
            if (isset($elements_pregunta[1])){ 
                
                $pregunta = trim($elements_pregunta[0]);

                $elements_pregunta[1] = trim(str_replace("]]", "",$elements_pregunta[1]));

                var_dump("Resto Categorias");
                var_dump($categorias);
                
                
            }else {
                    
                    
                    
                    
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
                var_dump($respuestas);
                var_dump($respuesta_correcta);
               
                  
        }
        die;
        
    }
}