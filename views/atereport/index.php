<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
//use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
//use kartik\widgets\ActiveForm;
use yii\helpers\Url;
//use yii\helpers\Json;
use app\models\AtereportSearch;
use kartik\depdrop\DepDrop;
use kartik\daterange\DateRangePicker;
//use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtereportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atereports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atereport-index">

    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
        Attention! This module is in development, and data may not be correct.
    </div>



    <?php echo $this->render('_search', ['model' => $searchModel, 'uutListData' => $uutListData,]); ?>

    <?php
    /*
    // Child # 2
    echo $form->field($model, 'prod')->widget(DepDrop::classname(), [
    'pluginOptions'=>[
    'depends'=>['cat-id', 'subcat-id'],
    'placeholder'=>'Select...',
    'url'=>Url::to(['/site/prod'])
]
]);
*/
?>


<?php /*

!!!!!!!!!!!!! WORKING CODE !!!!!!!!!!!

<div class="container-fluid">
<div class="row">
<div class="col-sm-3">


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'UUTNAME')->dropDownList(
ArrayHelper::map(AtereportSearch::find()->select('UUTNAME')->asArray()->all(), 'UUTNAME', 'UUTNAME'),
[
'prompt' => 'Select UUT name',
'onchange' => '
$.post("atereport/partnumbers?uutname='.'"+$(this).val(), function( data ) {
$( "select#atereport-partnumber" ).html( data);
});'
]);
?>

</div>
<div class="col-sm-3">
<?= $form->field($model, 'PARTNUMBER')->dropDownList(
ArrayHelper::map(AtereportSearch::find()->select('PARTNUMBER')->asArray()->all(), 'PARTNUMBER', 'PARTNUMBER'),
//                ArrayHelper::map(AtereportSearch::find()->select('PARTNUMBER `PARTNUMBER`')->all(), 'PARTNUMBER', 'PARTNUMBER'),
[
'prompt' => 'Select part number',
//   'multiple' => 'true'

]);
?>

<div class="col-sm-3">
</div>
<div class="col-sm-3">
</div>
</div>
</div>

!!!!!!!!!!!!! WORKING CODE !!!!!!!!!!!

*/

$result_value= ['0' => 'Pass', '1' => 'Fail'];
$gridColumns = [
    [
        'class' => 'yii\grid\SerialColumn'
    ],

    [
        'contentOptions' => ['style'=>'text-align:center'],
        'attribute'=>'FACILITY',
        'label' => 'Facility',
        'vAlign'=>'middle',
        'width'=>'100px',
        'value'=>function ($model, $key, $index, $widget) {
            return $model->FACILITY;
        },
        //    'filterType'=>GridView::FILTER_SELECT2,
        //    'filter'=>ArrayHelper::map(GlobalTest::find()->orderBy(['STATIONID'  => SORT_ASC])->indexBy('STATIONID')->asArray()->all(), 'STATIONID', 'STATIONID'),
        //    'filterWidgetOptions'=>[
        //        'pluginOptions'=>['allowClear'=>true],
        //    ],
        //    'filterInputOptions'=>['placeholder'=>'Any station'],
        'format'=>'raw',
        'filter'=>array('Ceragon' => 'Ceragon', 'Flex1' => 'Flex1', 'Flex2' => 'Flex2', 'VCL1' => 'VCL1', 'JBL1' => 'JBL1'),

    ],

    [
        'contentOptions' => ['style'=>'text-align:center'],
        'attribute'=>'STATIONID',
        'label' => 'Station ID',
        'vAlign'=>'middle',
        'width'=>'200px',
        'format'=>'raw',
        'value'=>function ($model, $key, $index, $widget) {
            return $model->STATIONID;
        },
        //    'filterType'=>GridView::FILTER_SELECT2,
        //    'filter'=>ArrayHelper::map(GlobalTest::find()->orderBy(['STATIONID'  => SORT_ASC])->indexBy('STATIONID')->asArray()->all(), 'STATIONID', 'STATIONID'),
        //    'filterWidgetOptions'=>[
        //        'pluginOptions'=>['allowClear'=>true],
        //    ],
        //    'filterInputOptions'=>['placeholder'=>'Any station'],
    ],

    //  'UUTNAME',
    [
        'attribute'=>'UUTNAME',
        'label' => 'UUT Name',
        'vAlign'=>'middle',
        'contentOptions' => ['style'=>'text-align:center'],
        'width'=>'150px',
        'value'=>function ($model, $key, $index, $widget) {
            return $model->UUTNAME;
        },
    ],



    //  'PARTNUMBER',
    [
        'attribute'=>'PARTNUMBER',
        'label' => 'Part Number',
        'width'=>'150px',
        'vAlign'=>'middle',
        'contentOptions' => ['style'=>'text-align:center'],
        //    'width'=>'150px',
        'value'=>function ($model, $key, $index, $widget) {
            return $model->PARTNUMBER;
        },
    ],

    //  'SERIALNUMBER',
    [
        'attribute'=>'SERIALNUMBER',
        'vAlign'=>'middle',
        'label' => 'Serial Number',

        'contentOptions' => ['style'=>'text-align:center'],
        //  'width'=>'100px',
        'value'=>function ($model, $key, $index, $widget) {
            return $model->SERIALNUMBER;
        },
    ],
    // 'techname',
    //'testdate',
    [
        'attribute'=>'TESTDATE',
        'vAlign'=>'middle',
        'label' => 'Test Date',
        'width'=>'120px',
        'value'=>function ($model, $key, $index, $widget) {
            return $model->TESTDATE;
        },

        'format'=>['date', 'dd.MM.YYYY'],
        //  'xlFormat'=>"dd\\, mmm\\, \\-yyyy",
        'contentOptions' => ['style'=>'text-align:center'],
    ],

    [
        'attribute'=>'TIMESTART',
        'vAlign'=>'middle',
        'label' => 'Test Start',
        'width'=>'120px',
        'value'=>function ($model, $key, $index, $widget) {
            return $model->TIMESTART;
        },

        'format'=>['date', 'HH:mm'],
        //  'xlFormat'=>"hh:mm",
        'contentOptions' => ['style'=>'text-align:center'],
    ],

    // 'timestart',
    // 'timestop',
    // 'uutplace',
    // 'testmode',
    //'globalresult',
    [
        //  'class' => '\kartik\grid\BooleanColumn',
        //  'trueLabel' => 'Pass',
        //  'falseLabel' => 'Fail',
        'width'=>'100px',
        'label' => 'Result',
        'attribute'=>'GLOBALRESULT',
        'value'=>function ($model, $key, $index, $widget) {
            $pass_or_fail = $model->GLOBALRESULT;
            if($pass_or_fail == 'Fail')
            return "<span class='label label-danger'> " . $model->GLOBALRESULT . '</span>';
            else if ($pass_or_fail == 'Error')
            return "<span class='label label-warning'> " . $model->GLOBALRESULT . '</span>';
            else
            return "<span class='label label-success'> " . $model->GLOBALRESULT . '</span>';
        },
        // 'width'=>'8%',
        //  'value' => $pass_or_fail->,
        //  'filterType'=>GridView::FILTER_SELECT2,
        //  'filter'=>array('Pass' => 'Pass', 'Fail' => 'Fail'),
        //  'filterWidgetOptions'=>[
        //      'pluginOptions'=>['allowClear'=>true],
        //  ],
        //    'filterInputOptions'=>['placeholder'=>'Any result'],
        //    'vAlign'=>'middle',
        'contentOptions' => ['style'=>'text-align:center'],
        'format'=>'raw',
        'filter'=>array('Fail' => 'Fail', 'Pass' => 'Pass', 'Error' => 'Error', 'Pass*' => 'Pass*'),
        //'noWrap'=>$this->noWrapColor
    ],
    [
        'attribute'=>'TESTMODE',
        'label' => 'T/M',
        'vAlign'=>'middle',

        'width'=>'100px',
        'value'=>function ($model, $key, $index, $widget) {
            $testmodeimage = "<img src=".Url::to('@web/images/'.$model->TESTMODE.'.gif')."> $model->TESTMODE";
            return $testmodeimage;
        },
        'contentOptions' => ['style'=>'text-align:center'],
        'format'=>'html',
        'filter'=>array('Test' => 'Test', 'Room' => 'Room', 'Cold' => 'Cold', 'Hot' => 'Hot'),
    ],

    // 'indexrange',
    // 'versions',
    // 'backupflag',
    [
        'class' => 'yii\grid\ActionColumn',
        'contentOptions' => ['style'=>'text-align:center'],
        'header'=>'Action',
        'headerOptions' => ['width' => '30'],
        'template' => '{view} {link}',
        'contentOptions' => ['style' => 'white-space: nowrap;'],
    ],
];

?>





<?php Pjax::begin(); ?>    <?= GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns,
    'bootstrap' => 'true',
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>true, // pjax is set to always true for this demo
    // set your toolbar
    'toolbar'=> [
        [
            'content'=>
            // Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>Yii::t('kvgrid', 'Add Book'), 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
        ],
        '{export}',
        '{toggleData}',
    ],
    // set export properties
    'export'=>[
        'fontAwesome'=>true
    ],
    // parameters from the demo form
    'bordered'=>false,
    'striped'=>true,
    'condensed'=>true,
    'responsive'=>true,
    'hover'=>true,
    //  'showPageSummary'=>$pageSummary,
    'panel'=>[
        'type'=>GridView::TYPE_PRIMARY,
        //  'heading'=>$heading,
    ],
    'persistResize'=>false,
    // 'exportConfig'=>$exportConfig,
    //     'rowOptions' => function ($model, $key, $index, $grid) {
    //                     return ['id' => $model['id'], 'onclick' => 'alert(this.id);'];
    //             },

]);
?>
<?php  Pjax::end(); ?>



</div>
