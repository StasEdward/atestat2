<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TestResults */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-results-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'HEADER_ID')->textInput() ?>

    <?= $form->field($model, 'TEST_ID')->textInput() ?>

    <?= $form->field($model, 'TESTNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MINRANGE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RESULT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MAXRANGE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UNITS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TESTSTATUS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TIMEOFTEST')->textInput() ?>

    <?= $form->field($model, 'GRAPH_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TEST_TYPE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'X_AXIS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Y_AXIS')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
