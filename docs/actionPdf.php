  /**
     * Este metodo te permite crear un pdf de un test pasado como argumento
     * @param $numero
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    public function actionPdf($numero)
    {
        // get your HTML raw content without any layouts or scripts
        $test=$numero;
        $t=Test::findOne(['id'=>$test]);
        $p=$t->getPreguntastests()->all();
        $c=$t->categorias1;


        // consulta directa
        $consulta="SELECT c.categoria,COUNT(*) as numero FROM preguntasTest t JOIN pregunta p ON t.pregunta = p.id JOIN categoriaspreguntas c ON p.id = c.pregunta WHERE t.test=$numero GROUP BY c.categoria";
        $contadorCategorias=Yii::$app->db->createCommand($consulta)->queryAll();


        $content = $this->renderPartial('crearPdf',[
            'p'=>$p, // pasando preguntas
            't'=>$t, // pasando el test
            'c'=>$c, // categorias de las preguntas del test
            'n'=>ArrayHelper::index($contadorCategorias,'categoria'), // numero de preguntas por categoria
        ]);



        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            'marginTop' => 30,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            //'filename'=>Yii::getAlias('@app') . '/file/pdf/test.pdf',
            //'destination' => Pdf::DEST_FILE,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            // '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css'
            'cssFile' => ['@app/web/css/kv-mpdf-bootstrap.css','@app/web/css/site.css'],
            //'cssFile' => '@app/web/css
            ///site.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => [
                'title' => 'Alpe Formacion',
                'showWatermarkImage'=>true,
                //'defaultheaderfontsize'=>9,
            ],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>[' | ' . $t->nombre . ' | por Ramon Abramo'],
                'SetFooter'=>[strtoupper($t->tipo) . ' | Alpe Formacion | Pagina {PAGENO}'],
                'SetWatermarkImage'=>[Yii::getAlias('@web') . '/imgs/alpe.png',1,[34,38],[10,0]],

            ]
        ]);

        
        return $pdf->render();
        
 }       