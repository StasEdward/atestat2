<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DaylyTestResults */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dayly-test-results-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'stationid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uutname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'partnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serialnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'techname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'testdate')->textInput() ?>

    <?= $form->field($model, 'timestart')->textInput() ?>

    <?= $form->field($model, 'timestop')->textInput() ?>

    <?= $form->field($model, 'uutplace')->textInput() ?>

    <?= $form->field($model, 'testmode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'globalresult')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indexrange')->textInput() ?>

    <?= $form->field($model, 'versions')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'backupflag')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
