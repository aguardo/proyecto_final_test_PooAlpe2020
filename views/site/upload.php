

<?php
use yii\widgets\ActiveForm;
?>



<?php if (Yii::$app->session->hasFlash('TestSubmitted')): ?>

        <p>
            Examen subido correctamente.
        </p>

 <?php else: ?>  

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

        <?= $form->field($model, 'imageFile')->fileInput() ?>

        <button>Submit</button>

    <?php ActiveForm::end() ?>  
        
 <?php endif; ?>        