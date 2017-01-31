<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\syncdbconfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="syncdbconfig-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'db_host')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'db_path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'record_count')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
