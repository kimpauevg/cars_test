<?php


use yii\bootstrap\ActiveForm;
use yii\helpers\Html; ?>

<?php $form = ActiveForm::begin();?>

<?= $form->field($model, 'name')->textInput() ?>
<?= Html::submitButton('Create car!', ['class' => 'btn btn-primary', 'name' => 'create car']) ?>
<?php ActiveForm::end(); ?>