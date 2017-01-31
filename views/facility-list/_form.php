<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FacilityList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="facility-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'facility_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'external_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'internal_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
