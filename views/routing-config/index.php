<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
//use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
//use kartik\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ROUTINGCONFIGSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Routing Configuration table';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="routingconfig-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Routingconfig', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    //    'filterModel' => $searchModel,
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


        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        //    'id',
        'uut_name',
            'source_station',
            'destination_station',
            [
                'attribute'=>'sample_ratio',
                'label' => 'Sample Ratio(%)',
                'vAlign'=>'middle',
                'contentOptions' => ['style'=>'text-align:center'],
                'width'=>'150px',
                'value'=>function ($model, $key, $index, $widget) {
                    return $model->sample_ratio;
                },
            ],
            [
                'attribute'=>'sample_period',
                'label' => 'Sample Period(days)',
                'vAlign'=>'middle',
                'contentOptions' => ['style'=>'text-align:center'],
                'width'=>'150px',
                'value'=>function ($model, $key, $index, $widget) {
                    return $model->sample_period;
                },
            ],
             'last_update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
