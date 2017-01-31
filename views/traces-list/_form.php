<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TracesList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="traces-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'GRAPH_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'POINT_COUNT')->textInput() ?>

    <?= $form->field($model, 'TRACE_FREQ_DATA')->textInput() ?>

    <?= $form->field($model, 'TRACE_POWER_DATA')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
