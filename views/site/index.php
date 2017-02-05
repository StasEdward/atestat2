<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use \yii\helpers\ArrayHelper;
use yii\i18n\Formatter;
use app\controllers\DaylyTestResultsController;
use miloschuman\highcharts\SeriesDataHelper;
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use yii\helpers\Url;
use yii\web\UrlManager;
use kartik\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'ATE Dashboard';
?>


<div class="dayly-test-results-index">
    <!-- Main content -->
    <!-- Small boxes (Stat box) row  -->
    <div class="row">
        <!-- Total Produced -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-industry"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Produced</span>
                    <span class="info-box-number"><?= array_sum($fail_arr) + array_sum($pass_arr) + array_sum($error_arr) ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 10%"></div>
                    </div>
                    <span class="progress-description">
                        10% Increase in last day
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>

        <!-- Total PASS -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
                <a href=<?= Url::base() ?>/global-test/passed style="color:#FFFFFF"><span class="info-box-icon"><i class="fa fa-thumbs-up"></i></span></a>
                <div class="info-box-content">
                    <span class="info-box-text">Pass</span>
                    <span class="info-box-number"><?= array_sum($pass_arr) ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: <?php echo $pass_percent; ?>%"></div>
                    </div>
                    <span class="progress-description">
                        <?= $pass_percent ?>% of totall
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>

        <!-- Total FAIL -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red">
                <a href=<?= Url::base() ?>/global-test/failed style="color:#FFFFFF"><span class="info-box-icon"><i class="fa fa-thumbs-down"></i></span></a>
                <div class="info-box-content">
                    <span class="info-box-text">Fail</span>
                    <span class="info-box-number"><?= array_sum($fail_arr) ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: <?php echo $fail_percent; ?>%"></div>
                    </div>
                    <span class="progress-description">
                        <?= $fail_percent ?>% of totall
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>

        <!-- Total ERROR -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
                <a href=<?= Url::base() ?>/global-test/errors style="color:#FFFFFF"><span class="info-box-icon"><i class="fa fa-warning"></i></span></a>
                <div class="info-box-content">
                    <span class="info-box-text">Error</span>
                    <span class="info-box-number"><?= array_sum($error_arr) ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: <?php echo $error_percent; ?>%"></div>
                    </div>
                    <span class="progress-description">
                        <?= $error_percent ?>% of totall
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- first row -->
        <section class="col-lg-4 connectedSortable ui-sortable">
            <!-- Last 24 hours test results-->
            <div class="box box-success">
                <div class="box box-solid ">
                    <div class="box-header with-border">
                        <i class="fa fa-picture-o"></i>
                        <h3 class="box-title">Last 24 hours test results</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body border-radius-none">
                        <?= Highcharts::widget([
                            'scripts' => [
                                'highcharts-more',
                                'modules/exporting',
                                'themes/grid',
                            ],
                            'options' => [
                                'credits' => 'false',
                                'gridLineWidth' => 0,
                                'chart' => [
                                    'borderWidth' => '0',
                                    'backgroundColor' => '#FFFFFF',
                                    'plotBackgroundColor' => '#FFFFFF',
                                    'marginLeft' => 40
                                ],
                                'title' => [
                                    'text' => null,
                                    'style' => [
                                        'color' => 'black',
                                        'fontWeight' => 'bold'
                                    ]
                                ],
                                'xAxis' => [
                                    'categories' => $facility_arr,

                                ],
                                'labels' => [
                                    'items' => [
                                        [
                                            'html' => 'Total test results',
                                            'style' => [
                                                'left' => '50px',
                                                'top' => '18px',
                                                'color' => 'white',
                                            ],
                                        ],
                                    ],
                                ],
                                'series' => [
                                    [
                                        'type' => 'column',
                                        'name' => 'Error',
                                        'data' => $error_arr,
                                        'color' => new JsExpression('Highcharts.getOptions().colors[3]'),
                                    ],
                                    [
                                        'type' => 'column',
                                        'name' => 'Fail',
                                        'data' => $fail_arr,
                                        'color' => new JsExpression('Highcharts.getOptions().colors[2]'),
                                    ],
                                    [
                                        'type' => 'column',
                                        'name' => 'Pass',
                                        'data' => $pass_arr,
                                        'color' => new JsExpression('Highcharts.getOptions().colors[5]'),
                                    ],
                                    [
                                        'type' => 'spline',
                                        'name' => 'Average',
                                        'data' => $average_arr,
                                        'marker' => [
                                            'lineWidth' => 2,
                                            'lineColor' => 'red',
                                            'fillColor' => 'white',
                                        ],
                                    ],
                                    [
                                        'type' => 'pie',
                                        'name' => 'Total consumption',
                                        'data' => [
                                            [
                                                'name' => 'Fail',
                                                'y' => array_sum($fail_arr),
                                                'color' => new JsExpression('Highcharts.getOptions().colors[2]'), // John's color
                                            ],
                                            [
                                                'name' => 'Pass',
                                                'y' => array_sum($pass_arr),
                                                'color' => new JsExpression('Highcharts.getOptions().colors[5]'), // Joe's color
                                            ],
                                            [
                                                'name' => 'Error',
                                                'y' => array_sum($error_arr),
                                                'color' => new JsExpression('Highcharts.getOptions().colors[3]'), // John's color
                                            ],
                                        ],
                                        'center' => [70, 80],
                                        'size' => 100,
                                        'showInLegend' => false,
                                        'dataLabels' => [
                                            'enabled' => true,
                                            'color' => 'black'
                                        ],
                                    ],
                                ],
                            ]
                        ]);  ?>
                    </div>
                </div>
            </div>
            <!-- /.Last 24 hours test results -->
        </section>
        <section class="col-lg-4 connectedSortable ui-sortable">
            <!-- Production history-->
            <div class="box box-success">
                <div class="box box-solid ">
                    <div class="box-header with-border">
                        <i class="fa fa-picture-o"></i>
                        <h3 class="box-title"><b>ODU</b> FP YEILD last 30 days</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body border-radius-none">
                        <?=
                        //print_r($yeild_TOTALL_arr);
                        Highcharts::widget([
                            'scripts' => [
                                'highcharts-more',
                                'modules/exporting',
                                'themes/grid',
                            ],
                            'options' => [
                                'credits' => 'false',
                                'gridLineWidth' => 0,
                                'chart' => [
                                    'borderWidth' => '0',
                                    'backgroundColor' => '#FFFFFF',
                                    'plotBackgroundColor' => '#FFFFFF',
                                    'marginLeft' => 40
                                ],
                                'plotOptions' => [
                                    'column' => [
                                        'stacking' => 'percent'
                                    ],
                                ],
                                'title' => [
                                    'text' => null,
                                    'style' => [
                                        'color' => 'black',
                                        'fontWeight' => 'bold'
                                    ]
                                ],
                                'xAxis' => [
                                    'categories' => $yeild_ODU_UUT_arr,
                                    'labels' => [
                                        'color' => 'white',
                                    ],
                                ],
                                'labels' => [
                                    'items' => [
                                        [
                                            'html' => 'Total test results',
                                            'style' => [
                                                'left' => '50px',
                                                'top' => '18px',
                                                'color' => 'white',
                                            ],
                                        ],
                                    ],
                                ],
                                'series' => [
                                    [
                                        'type' => 'column',
                                        'name' => 'Fail(units)',
                                        'data' => $yeild_ODU_FAIL_arr,
                                        'color' => new JsExpression('Highcharts.getOptions().colors[2]'),
                                    ],
                                    [
                                        'type' => 'column',
                                        'name' => 'Pass(units)',
                                        'data' => $yeild_ODU_PASS_arr,
                                        'color' => new JsExpression('Highcharts.getOptions().colors[1]'),
                                    ],
                                ],
                            /*    'tooltip' => [
                                               'enabled' => true,
                                               'footerFormat' => true,
                                               'formatter' => "js:function() {
                                                    return 'my special information';
                                                }"
                                            ], */
                            ]
                        ]);  ?>
                    </div>
                </div>
            </div>
            <!-- Production history-->
        </section>
        <section class="col-lg-4 connectedSortable ui-sortable">
            <!-- Production history-->
            <div class="box box-success">
                <div class="box box-solid ">
                    <div class="box-header with-border">
                        <i class="fa fa-picture-o"></i>
                        <h3 class="box-title"><b>IDU</b> FP YEILD last 30 days</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body border-radius-none">
                        <?=
                        //print_r($yeild_TOTALL_arr);
                        Highcharts::widget([
                            'scripts' => [
                                'highcharts-more',
                                'modules/exporting',
                                'themes/grid',
                            ],
                            'options' => [
                                'credits' => 'false',
                                'gridLineWidth' => 0,
                                'chart' => [
                                    'borderWidth' => '0',
                                    'backgroundColor' => '#FFFFFF',
                                    'plotBackgroundColor' => '#FFFFFF',
                                    'marginLeft' => 40
                                ],
                                'plotOptions' => [
                                    'column' => [
                                        'stacking' => 'percent'
                                    ],
                                ],
                                'title' => [
                                    'text' => null,
                                    'style' => [
                                        'color' => 'black',
                                        'fontWeight' => 'bold'
                                    ]
                                ],
                                'xAxis' => [
                                    'categories' => $yeild_IDU_UUT_arr,

                                ],
                                'labels' => [
                                    'items' => [
                                        [
                                            'html' => 'Total test results',
                                            'style' => [
                                                'left' => '50px',
                                                'top' => '18px',
                                                'color' => 'white',
                                            ],
                                        ],
                                    ],
                                ],
                                'series' => [
                                    [
                                        'type' => 'column',
                                        'name' => 'Fail(units)',
                                        'data' => $yeild_IDU_FAIL_arr,
                                        'color' => new JsExpression('Highcharts.getOptions().colors[2]'),
                                    ],
                                    [
                                        'type' => 'column',
                                        'name' => 'Pass(units)',
                                        'data' => $yeild_IDU_PASS_arr,
                                        'color' => new JsExpression('Highcharts.getOptions().colors[1]'),
                                    ],
                                ],
                            ]
                        ]);  ?>
                    </div>
                </div>
            </div>
            <!-- Production history-->
        </section>
    </div>
        <!-- /.first row -->
    <div class="row">
        <!-- second row -->
        <section class="col-lg-4 connectedSortable ui-sortable">
            <!-- last 24 hours UUT fail chart-->
            <div class="box box-success">
                <div class="box box-solid ">
                    <div class="box-header with-border">
                        <i class="fa fa-pie-chart"></i>
                        <h3 class="box-title">Last 24 hours UUT fail (graph)</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body border-radius-none">
                        <?= Highcharts::widget([
                            'scripts' => [
                                'highcharts-more',
                                'modules/exporting',
                                'themes/grid',
                            ],
                            'options' => [
                                'credits' => 'false',
                                'gridLineWidth' => 0,
                                'chart' => [
                                    'borderWidth' => '0',
                                    'backgroundColor' => '#FFFFFF',
                                    'plotBackgroundColor' => '#FFFFFF',
                                    'marginLeft' => 10
                                ],
                                'title' => [
                                    'text' => null,
                                ],

                                'credits' => ['enabled' => false],
                                'series' => [
                                    [
                                        'type' => 'pie',
                                        'allowPointSelect' => 'true',
                                        'cursor' => 'pointer',
                                        'name' => 'Total Fail',
                                        'data' =>   $TotaluutFail_result,
                                        'center' => ["50%", "50%"],
                                        'size' => 175,
                                        'showInLegend' => false,
                                        'dataLabels' => [
                                            'enabled' => true,
                                        ],
                                    ],
                                ],
                            ]
                        ]);  ?>
                    </div>
                    <!-- /.box-body -->
                    <!-- /.box-header -->
                </div>
            </div>
            <!-- last 24 hours UUT fail chart-->
        </section>
        <section class="col-lg-4 connectedSortable ui-sortable">
            <!-- last 24 hours UUT fail table -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <i class="glyphicon glyphicon-list-alt"></i>
                    <h3 class="box-title">Last 24 hours UUT fail</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

            <div class="box-body border-radius-none">
                             <?php Pjax::begin();


                         //    echo $date;
                             ?>    <?=
                             GridView::widget([
                                     'dataProvider' => $UUTFailprovider,
                                     'bootstrap' => 'true',
                                     'bordered'=>true,
                                     'striped'=>true,
                                     'condensed'=>true,
                                     'responsive'=>true,
                                     'hover'=>true,
                                     //'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
                                     //'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
                                     //'headerRowOptions'=>['class'=>'kartik-sheet-style'],
                                     //'filterRowOptions'=>['class'=>'kartik-sheet-style'],
                                     'pjax'=>true, // pjax is set to always true for this demo
                                     'showPageSummary'=> false,
                                     'columns' => [
                                         ['class' => 'yii\grid\SerialColumn'],

                                     //    'name',
                                         [
                                             'label' => 'UUT name',
                                             'attribute'=>'name',
                                         ],
                                         [
                                             'label' => 'Fails',
                                             'attribute'=>'fails',
                                         ],
                                         [
                                             'class' => 'yii\grid\ActionColumn',
                                             'contentOptions' => ['style'=>'text-align:center'],
                                             'header'=>'Action',
                                             'headerOptions' => ['width' => '30'],
                                             'template' => '{view} {link}',
                                             'contentOptions' => ['style'=>'text-align:center'],
                                             'buttons' => [
                                             'view' => function ($url,$model) {
                                             //    print_r($model);
                                             if ((Yii::$app->user->identity->username <> 'admin') AND (Yii::$app->user->identity->username <> 'Ceragon')){
                                                 $facility_name = Yii::$app->user->identity->username;
                                             }
                                             else {
                                                 $facility_name = '';
                                             }
                                                 $date = date("Y-m-d", time());
                                                 return Html::a('<span class="glyphicon glyphicon-info-sign"></span>', Url::base().'/global-test/index?GlobalTestSearch[FACILITY]='.$facility_name.'&GlobalTestSearch[UUTNAME]='.$model['name'].'&GlobalTestSearch[GLOBALRESULT]=Fail&GlobalTestSearch[TESTDATE]='.$date.'');
                                                 },
                                             ],

                                         ],
                                     ],
                                 ]); ?>
                                 <?php  Pjax::end(); ?>
                             <?php // http://atestat/global-test/index?GlobalTestSearch[FACILITY]=VCL1&GlobalTestSearch[UUTNAME]=&GlobalTestSearch[GLOBALRESULT]=Fail ?>
                             <!-- /.box-body -->
                         </div>
                     </div>

                     <!-- /.box -->

            <!-- /.last 24 hours UUT fail table-->
        </section>
        <section class="col-lg-4 connectedSortable ui-sortable">
            <!-- Data Base statistics chart -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <i class="fa fa-pie-chart"></i>
                    <h3 class="box-title">Data Base statistics</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <?= Highcharts::widget([
                    'scripts' => [
                        'highcharts-more',
                        'modules/exporting',
                        'themes/grid',
                    ],
                    'options' => [
                        'credits' => 'false',
                        'gridLineWidth' => 0,
                        'chart' => [
                            'borderWidth' => '0',
                            'backgroundColor' => '#FFFFFF',
                            'plotBackgroundColor' => '#FFFFFF',
                            'marginLeft' => 10
                        ],
                        'title' => [
                            'text' => null,
                        ],
                        'xAxis' => [
                            'categories' => ['Global', 'Tests', 'Traces'],
                        ],
                        'credits' => ['enabled' => false],
                        'series' => [
                            [
                                'type' => 'pie',
                                'allowPointSelect' => 'true',
                                'cursor' => 'pointer',
                                'name' => 'Total rows',
                                'data' => [
                                    [
                                        'name' => $db_global_arr['DB_Name'],
                                        'y' => (int)$db_global_arr['table_rows'],
                                        'color' => new JsExpression('Highcharts.getOptions().colors[2]'), // Test
                                    ],
                                    [
                                        'name' => $db_result_arr['DB_Name'],
                                        'y' => (int)$db_result_arr['table_rows'],
                                        'color' => new JsExpression('Highcharts.getOptions().colors[0]'), // results
                                    ],
                                    [
                                        'name' => $db_trace_arr['DB_Name'],
                                        'y' => (int)$db_trace_arr['table_rows'],
                                        'color' => new JsExpression('Highcharts.getOptions().colors[1]'), // traces
                                    ],
                                ],
                                'center' => ["50%", "50%"],
                                'size' => 175,
                                'showInLegend' => false,
                                'dataLabels' => [
                                    'enabled' => true,
                                ],
                            ],
                        ],
                    ]
                ]);  ?>
                <!-- /.box-body -->
                <div class="box-footer no-padding">
                    <div class="box-body bg-red color-palette">
                        <div class="col-md-4 ">
                            <span class="text">GLOBALTEST</span>
                        </div>
                        <div class="col-md-4">
                            <span class="pull-left text-white"><i class="fa fa-database"></i> <?= Yii::$app->formatter->asDecimal((int)$db_global_arr['table_rows']) ?></span>
                        </div>
                        <div class="col-md-4">
                            <span class="pull-right text-white"><i class="fa fa-hdd-o"></i> <?= Yii::$app->formatter->asShortSize((int)$db_global_arr['DB_Size']) ?></span>
                        </div>
                    </div>
                    <div class="box-body bg-light-blue-active color-palette">
                        <div class="col-md-4 ">
                            <span class="text">GLOBALRES</span>
                        </div>
                        <div class="col-md-4">
                            <span class="pull-left text-white"><i class="fa fa-database"></i> <?= Yii::$app->formatter->asDecimal((int)$db_result_arr['table_rows']) ?></span>
                        </div>
                        <div class="col-md-4">
                            <span class="pull-right text-white"><i class="fa fa-hdd-o"></i> <?= Yii::$app->formatter->asShortSize((int)$db_result_arr['DB_Size']) ?></span>
                        </div>
                    </div>
                    <div class="box-body bg-green-active color-palette">
                        <div class="col-md-4 ">
                            <span class="text"><?= $db_trace_arr['DB_Name'] ?></span>
                        </div>
                        <div class="col-md-4">
                            <span class="pull-left text-white"><i class="fa fa-database"></i> <?= Yii::$app->formatter->asDecimal((int)$db_trace_arr['table_rows']) ?></span>
                        </div>
                        <div class="col-md-4">
                            <span class="pull-right text-white"><i class="fa fa-hdd-o"></i> <?= Yii::$app->formatter->asShortSize((int)$db_trace_arr['DB_Size']) ?></span>
                        </div>
                    </div>

                </div>
                <!-- /.footer -->
            </div>
            <!-- /.Data Base statistics chart -->
        </section>
        <!-- /.first row -->
    </div>
        <!-- /.row (main row) -->
        <!-- third row -->
    <div class="row">
        <section class="col-lg-4 connectedSortable ui-sortable">
            <!-- Production history-->
            <div class="box box-success">
                <div class="box box-solid">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs pull-right">
                            <li class="active"><a href="#tab_1-1" data-toggle="tab" aria-expanded="true">Pass</a></li>
                            <li class=""><a href="#tab_2-2" data-toggle="tab" aria-expanded="false">Fail</a></li>
                            <li class="pull-left header"><i class="fa fa-area-chart"></i> Production history</li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1-1" style="width:100%;margin: 0 auto">
                                <?= Highcharts::widget([
                                    'scripts' => [
                                        'highcharts-more',
                                        'modules/exporting',
                                        'themes/grid',
                                    ],
                                    'options' => [
                                        //  'width' => '100%',
                                        //  'renderTo' => 'container',
                                        'credits' => 'false',
                                        'gridLineWidth' => 0,
                                        'chart' => [
                                            'type' => 'line',
                                            'borderWidth' => '0',
                                            'backgroundColor' => '#FFFFFF',
                                            'plotBackgroundColor' => '#FFFFFF',
                                            'marginLeft' => 40
                                        ],
                                        'title' => [
                                            'text' => null,
                                        ],
                                        'xAxis' => [
                                            'type' => 'datetime',
                                            'maxZoom' => 48 * 3600 * 1000,
                                        ],
                                        'series' => $TotalDaylyPF_Passresult,
                                    ]
                                ]);
                                ?>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2-2" style="width:100%;margin: 0 auto">
                                <?= Highcharts::widget([
                                    'scripts' => [
                                        'highcharts-more',
                                        'modules/exporting',
                                        'themes/grid',
                                    ],
                                    'options' => [
                                        //  'renderTo' => 'tab_2-2',
                                        'credits' => 'false',
                                        'gridLineWidth' => 0,
                                        'chart' => [
                                            'type' => 'column',
                                            'borderWidth' => '0',
                                            'backgroundColor' => '#FFFFFF',
                                            'plotBackgroundColor' => '#FFFFFF',
                                            'marginLeft' => 40
                                        ],
                                        'title' => [
                                            'text' => null,
                                        ],
                                        'xAxis' => [
                                            'type' => 'datetime',
                                            'maxZoom' => 48 * 3600 * 1000,
                                        ],
                                        'series' => $TotalDaylyPF_Failsresult,
                                    ]
                                ]);
                                ?>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
            </div>
            <!-- Production history-->
        </section>
        <!-- /.third row -->
    </div>


</div>
