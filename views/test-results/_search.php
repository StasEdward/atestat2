<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TestResultsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-results-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'HEADER_ID') ?>

    <?= $form->field($model, 'TEST_ID') ?>

    <?= $form->field($model, 'TESTNAME') ?>

    <?= $form->field($model, 'MINRANGE') ?>

    <?php // echo $form->field($model, 'RESULT') ?>

    <?php // echo $form->field($model, 'MAXRANGE') ?>

    <?php // echo $form->field($model, 'UNITS') ?>

    <?php // echo $form->field($model, 'TESTSTATUS') ?>

    <?php // echo $form->field($model, 'TIMEOFTEST') ?>

    <?php // echo $form->field($model, 'GRAPH_ID') ?>

    <?php // echo $form->field($model, 'TEST_TYPE') ?>

    <?php // echo $form->field($model, 'X_AXIS') ?>

    <?php // echo $form->field($model, 'Y_AXIS') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
