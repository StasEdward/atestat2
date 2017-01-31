<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DaylyTestResultsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dayly-test-results-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'stationid') ?>

    <?= $form->field($model, 'uutname') ?>

    <?= $form->field($model, 'partnumber') ?>

    <?= $form->field($model, 'serialnumber') ?>

    <?php // echo $form->field($model, 'techname') ?>

    <?php // echo $form->field($model, 'testdate') ?>

    <?php // echo $form->field($model, 'timestart') ?>

    <?php // echo $form->field($model, 'timestop') ?>

    <?php // echo $form->field($model, 'uutplace') ?>

    <?php // echo $form->field($model, 'testmode') ?>

    <?php // echo $form->field($model, 'globalresult') ?>

    <?php // echo $form->field($model, 'indexrange') ?>

    <?php // echo $form->field($model, 'versions') ?>

    <?php // echo $form->field($model, 'backupflag') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
