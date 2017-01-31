<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use kartik\dynagrid\Module;
use \yii\helpers\ArrayHelper;
use app\controllers\AtereportController;
use yii\helpers\Url;
use yii\web\UrlManager;


/* @var $this yii\web\View */
/* @var $model app\models\GlobalTest */

$this->title = 'Test result for S/N '.$model->SERIALNUMBER;
$this->params['breadcrumbs'][] = ['label' => 'Global Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->SERIALNUMBER;

?>
<div class="global-test-view">
    <?=  DetailView::widget([
        'model' => $model,
        'mode' => 'view',
        'bordered' => false,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'attributes' => [
            [
                'group'=>true,
                'label'=>'Identification Information',
                'rowOptions'=>['class'=>'default']
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'PARTNUMBER',
                        'label'=>'Part Number',
                        'valueColOptions'=>['style'=>'width:25%']
                    ],
                    [
                        'attribute'=>'UUTNAME',
                        'label'=>'UUT Name',
                        'format'=>'raw',
                        'value'=>$model->UUTNAME,
                        'valueColOptions'=>['style'=>'width:25%'],
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'STATIONID',
                        'label'=>'Station ID',
                        'valueColOptions'=>['style'=>'width:25%'],
                    ],
                    [
                        'attribute'=>'TESTMODE',
                        'label'=>'Test Mode',
                        'format'=>'raw',
                    //    'value'=> $model->TESTMODE === 'Test' ? '<span class="label label-warning">'.$model->TESTMODE.'</span>' : '<span class="label label-danger">'.$model->TESTMODE.'</span>',
                        'value' => '<img src='.Url::to('@web/images/'.$model->TESTMODE.'.gif').'> '.$model->TESTMODE,
                        'valueColOptions'=>['style'=>'width:25%'],
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'FACILITY',
                        'label'=>'Facility',
                        'valueColOptions'=>['style'=>'width:25%'],
                    ],
                    [
                        'attribute'=>'GLOBALRESULT',
                        'label'=>'Test Result',
                        'format'=>'raw',
                        'value'=> $model->GLOBALRESULT === 'Pass' ? '<span class="label label-success">'.$model->GLOBALRESULT.'</span>' : (($model->GLOBALRESULT === 'Fail' ) ?'<span class="label label-danger">'.$model->GLOBALRESULT.'</span>' : '<span class="label label-warning">'.$model->GLOBALRESULT.'</span>'),
                        'valueColOptions'=>['style'=>'width:25%'],
                    ],
                ],
            ],

            [
                'group'=>true,
                'label'=>'Test Details',
                'rowOptions'=>['class'=>'default'],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'TESTDATE',
                        'label'=>'Test Date',
                        'format'=>'date',
                        'type'=>DetailView::INPUT_DATE,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                    [
                        'attribute'=>'TIMESTART',
                        'label'=>'Test Start',
                        'format'=>'raw',
                        'value'=>$model->TIMESTART ,
                        'type'=>DetailView::INPUT_SWITCH,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                ]
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'TECHNAME',
                        'label'=>'Tech Name',
                        'format'=>'raw',
                        'value'=>$model->TECHNAME,
                        'type'=>DetailView::INPUT_SELECT2,

                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                    [
                        'attribute'=>'TIMESTOP',
                        'label'=>'Test Stop',
                        'format'=>'raw',
                        'type'=>DetailView::INPUT_SWITCH,
                        'value'=>$model->TIMESTOP,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                ]
            ],
            [
                'attribute'=>'VERSIONS',
                'label'=>'Versions',
                'format'=>'raw',
                'value'=>'<span class="text-justify"><em>' . $model->VERSIONS . '</em></span>',
                'options'=>['rows'=>4]
            ],
        ],


    ]);

     GridView::widget([
        'dataProvider'=> $dataProvider,
        'bootstrap' => true,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>true, // pjax is set to always true for this demo
        'toolbar'=> [
            '{export}',
        ],
        'export'=>[
            'fontAwesome'=>true
        ],
        'bordered'=>false,
        'striped'=>true,
        'condensed'=>true,
        'responsive'=>true,
        'hover'=>true,
        'panel'=>[
            'type'=>GridView::TYPE_PRIMARY,
            'heading'=>  Html::tag('i', Html::encode(' S/N: '.$model->SERIALNUMBER), ['class' => 'glyphicon glyphicon-list']),
        ],
        'persistResize'=>false,
        'responsive'=>true,
        'hover'=>true,
        'columns' => [
            [
                'attribute'=>'TEST_ID',
                'label' => '#',
                'format'=>'raw',
            ],
            'TESTNAME',
            [
                'attribute'=>'MINRANGE',
                'label' => 'Min',
                'format'=>'raw',
            ],
            'RESULT',
            [
                'attribute'=>'MAXRANGE',
                'label' => 'Max',
                'format'=>'raw',
            ],
            'UNITS',
            [
                'attribute'=>'RESULT',
                'value'=>function ($model, $key, $index, $widget) {
                    $pass_or_fail = $model->TESTSTATUS;
                    if($pass_or_fail == 'Fail')
                    return "<span class='label label-danger'> " . $model->TESTSTATUS . '</span>';
                    else if ($pass_or_fail == 'Error')
                    return "<span class='label label-warning'> " . $model->TESTSTATUS . '</span>';
                    else
                    return "<span class='label label-success'> " . $model->TESTSTATUS . '</span>';
                },
                'filterInputOptions'=>['placeholder'=>'Any result'],
                'vAlign'=>'middle',
                'format'=>'raw',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'contentOptions'=>['style'=>'max-width: 50px;'],
                'buttons' => [
                    'view' => function ($url,$model) {
                        if($model->GRAPH_ID <> '0'){
                            return  \yii\bootstrap\Modal::widget([
                                'id' => 'showModalButton'.$model->GRAPH_ID,
                                'clientOptions' => false,
                                'toggleButton' => [
                                    'label' => null,
                                    'class' => 'glyphicon glyphicon-equalizer',
                                    'tag' => 'a',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#showModalButton'.$model->GRAPH_ID,
                                    'href' => Url::toRoute(['/traces-list/view?id='.$model->GRAPH_ID]),
                                ],
                            ]);
                            }
                            //  return Html::a('<span class="showModalButton glyphicon glyphicon-equalizer"></span>', Url::base().'/traces-list/view?id='.$model->GRAPH_ID);
                            else
                            return "";
                        },
                    ],
                ],
            ],
        ]); 
         ?>
    </div>
