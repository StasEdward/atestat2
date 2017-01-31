<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ROUTINGCONFIG */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="routingconfig-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'source_station')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'destination_station')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uut_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sample_ratio')->textInput() ?>

    <?= $form->field($model, 'sample_period')->textInput() ?>

    <?= $form->field($model, 'sample_counter')->textInput() ?>

    <?= $form->field($model, 'last_update')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
