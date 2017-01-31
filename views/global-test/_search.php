<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\GlobalTestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="global-test-search">


 <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]);
    
    
    echo '<div class="container-fluid">
    <div class="row">
    <div class="col-sm-3">';
    
    
    echo $form->field($model, 'STATIONID')->dropDownList($uutListData, [
        'id'=>'station_id',
        'prompt' => 'Select Station name',
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => [
            'options' => ['multiple' => true],
            'pluginOptions'=>['allowClear' => true]
        ],
    ]);
    
    echo "</div>
    <div class=\"col-sm-3\">";
    // Child # 1
    
    echo $form->field($model, 'UUTNAME')->widget(DepDrop::classname(), [
        'options'=>['id'=>'UUTNAME'],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => [
            'options' => ['multiple' => true],
            'pluginOptions'=>['allowClear' => true]
        ],
        'pluginOptions'=>[
            'depends'=>['uut_name'],
            'placeholder'=>'Select part number...',
            'url'=>Url::to(['/atereport/partnumber-list'])
        ]
    ]);
    
    echo '</div>';
    echo '<div class="col-sm-3">';
    
 ?>
    
</div>




<?php // echo $form->field($model, 'VERSIONS') ?>

<?php // echo $form->field($model, 'FACILITY') ?>

<div class="form-group">
    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Reset', ['/atereport/index'],['class' => 'btn btn-warning']) ?>
</div>

<?php ActiveForm::end(); ?>




    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'STATIONID') ?>

    <?= $form->field($model, 'UUTNAME') ?>

    <?= $form->field($model, 'PARTNUMBER') ?>

    <?= $form->field($model, 'SERIALNUMBER') ?>

    <?php // echo $form->field($model, 'TECHNAME') ?>

    <?php // echo $form->field($model, 'TESTDATE') ?>

    <?php // echo $form->field($model, 'TIMESTART') ?>

    <?php // echo $form->field($model, 'TIMESTOP') ?>

    <?php // echo $form->field($model, 'UUTPLACE') ?>

    <?php // echo $form->field($model, 'TESTMODE') ?>

    <?php // echo $form->field($model, 'GLOBALRESULT') ?>

    <?php // echo $form->field($model, 'VERSIONS') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
