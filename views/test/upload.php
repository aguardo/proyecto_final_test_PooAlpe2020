

<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Tests';
$this->params['breadcrumbs'][] = $this->title;

?>



<?php if (Yii::$app->session->hasFlash('TestSubmitted')): ?>

    <div class="test-upload">  
        
        <h1>Upload Test</h1>
        
        <p>
        <?= Html::a('Ver Tests', ['index'], ['class' => 'btn btn-success']) ?>
        </p>
        
        <p>
            Examen subido correctamente.
        </p>
        
    </div>    
        

 <?php else: ?>  

    <div class="test-upload">   
        
        <h1>Upload Test</h1>
    
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
        
        <?= $form->field($model, 'description')->textInput() ?>

        <?= $form->field($model, 'testFile')->fileInput() ?>

        <div class="form-group">
        <?= Html::submitButton('Importar', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end() ?>  
        
    </div>    
        
 <?php endif; ?>        