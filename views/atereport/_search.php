<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Atereport;
use yii\helpers\ArrayHelper;
//use kartik\widgets\Select2;
//use kartik\widgets\ActiveForm;
use yii\helpers\Url;
//use yii\helpers\Json;
use app\models\AtereportSearch;
use kartik\depdrop\DepDrop;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model app\models\AtereportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atereport-search">
    
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]);
    
    
    echo '<div class="container-fluid">
    <div class="row">
    <div class="col-sm-3">';
    
    
    echo $form->field($model, 'UUTNAME')->dropDownList($uutListData, [
        'id'=>'uut_name',
        'prompt' => 'Select UUT name',
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => [
            'options' => ['multiple' => true],
            'pluginOptions'=>['allowClear' => true]
        ],
    ]);
    
    echo "</div>
    <div class=\"col-sm-3\">";
    // Child # 1
    
    echo $form->field($model, 'PARTNUMBER')->widget(DepDrop::classname(), [
        'options'=>['id'=>'PARTNUMBER'],
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
    
    echo '<div class="drp-container">';
    echo $form->field($model, 'TESTDATE')->widget(DateRangePicker::classname(),[
        'name'=>'date_range_2',
        'presetDropdown'=>true,
        'hideInput'=>true
    ]); ?>
    
</div>


<?php // echo $form->field($model, 'TECHNAME') ?>


<?php // echo $form->field($model, 'TIMESTART') ?>

<?php // echo $form->field($model, 'TIMESTOP') ?>

<?php // echo $form->field($model, 'UUTPLACE') ?>

<?php // echo $form->field($model, 'TESTMODE') ?>

<?php 
echo '</div>';
echo '<div class="col-sm-3">';

     echo $form->field($model, 'GLOBALRESULT')->dropDownList(['Pass'=>'Pass', 'Fail'=>'Fail', 'Error'=>'Error'], ['prompt'=>'Choose result...']); ?>

</div>
</div>


<?php // echo $form->field($model, 'VERSIONS') ?>

<?php // echo $form->field($model, 'FACILITY') ?>

<div class="form-group">
    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Reset', ['/atereport/index'],['class' => 'btn btn-warning']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
