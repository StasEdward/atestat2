<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ROUTINGCONFIGSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="routingconfig-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'source_station') ?>

    <?= $form->field($model, 'destination_station') ?>

    <?= $form->field($model, 'uut_name') ?>

    <?= $form->field($model, 'sample_ratio') ?>

    <?php // echo $form->field($model, 'sample_period') ?>

    <?php // echo $form->field($model, 'sample_counter') ?>

    <?php // echo $form->field($model, 'last_update') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
