<?php

/* @var $this yii\web\View */

$this->title = 'Aplicación Test';
use yii\helpers\Html;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Aplicación de generación de test</h1>
        
        <!---
        <p class="lead">You have successfully created your Yii-powered application.</p>
        --->
        
        <p> <?= Html::a('Instrucciones', ['site/ayuda'], ['class' => 'btn btn-lg btn-primary']) ?> </p>

    </div>

    <div class="body-content">

        <div class="row high">
            <div class="col-lg-6 text-center">
                <h2>Importación de test</h2>

                <p>En este apartado Vd. podrá importar un test</p>

                <p><?= Html::a('Importar Test', ['test/upload'], ['class' => 'btn btn-lg btn-success']) ?></p>
            </div>
            <div class="col-lg-6 text-center">
                <h2>Generación de test</h2>

                <p>En este apartado Vd. podrá generar un test en formato pdf selecionándolo de un listado</p>

                <p><?= Html::a('Imprimir Test', ['test/index'], ['class' => 'btn btn-lg btn-danger']) ?></p>
            </div>
            

    </div>
</div>
