<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Import Test', ['upload'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'description',
            'fecha',

            ['class' => 'yii\grid\ActionColumn', 
                
                            'template'=>'{pdf} {update}{delete}',

                            'buttons'=>[

                              'pdf' => function ($url, $model) {	

                                return Html::a('<span class="glyphicon glyphicon-file"></span>', $url, [

					'title' => Yii::t('yii', 'Pdf'),

                                        ]);                                
                                }

                            ]                            
            ],
        ],
    ]); ?>


</div>
