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
        
        <p> <?= Html::a('Importar Test', ['test/upload'], ['class' => 'btn btn-lg btn-success']) ?> </p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6 text-center">
                <h2>Importación de test</h2>

                <p>En este apartado Vd. podrá importar un test</p>

                <p><?= Html::a('Importar Test', ['test/upload'], ['class' => 'btn btn-lg btn-success']) ?></p>
            </div>
            <div class="col-lg-6 text-center">
                <h2>Generación de test</h2>

                <p>En este apartado Vd. podrá generar un test en formato pdf</p>

                <p><?= Html::a('Generar Test', ['test/upload'], ['class' => 'btn btn-lg btn-success']) ?></p>
            </div>
            

    </div>
</div>
