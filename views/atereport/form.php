<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Atereport */
/* @var $form ActiveForm */
?>
<div class="atereport-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'TESTDATE') ?>
        <?= $form->field($model, 'TIMESTART') ?>
        <?= $form->field($model, 'TIMESTOP') ?>
        <?= $form->field($model, 'UUTPLACE') ?>
        <?= $form->field($model, 'STATIONID') ?>
        <?= $form->field($model, 'PARTNUMBER') ?>
        <?= $form->field($model, 'SERIALNUMBER') ?>
        <?= $form->field($model, 'UUTNAME') ?>
        <?= $form->field($model, 'TECHNAME') ?>
        <?= $form->field($model, 'TESTMODE') ?>
        <?= $form->field($model, 'GLOBALRESULT') ?>
        <?= $form->field($model, 'FACILITY') ?>
        <?= $form->field($model, 'VERSIONS') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- atereport-form -->
