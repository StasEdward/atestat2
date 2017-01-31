<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Atereport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atereport-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'STATIONID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UUTNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PARTNUMBER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SERIALNUMBER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TECHNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TESTDATE')->textInput() ?>

    <?= $form->field($model, 'TIMESTART')->textInput() ?>

    <?= $form->field($model, 'TIMESTOP')->textInput() ?>

    <?= $form->field($model, 'UUTPLACE')->textInput() ?>

    <?= $form->field($model, 'TESTMODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GLOBALRESULT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VERSIONS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FACILITY')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
