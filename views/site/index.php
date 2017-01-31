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
    <!-- Small boxes (Stat box) -->
    <div class="row">

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
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable ui-sortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="box box-success">
                <div class="box box-solid ">
                    <div class="box-header with-border" style="cursor: move;">
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
            <!-- /.nav-tabs-custom -->

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


        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable ui-sortable">

            <!-- last 24 hours UUT fail chart -->
            <div class="box box-success">
                <div class="box box-solid ">
                    <div class="box-header with-border" style="cursor: move;">
                        <i class="fa fa-pie-chart"></i>

                        <h3 class="box-title">Last 24 hours UUT fail</h3>

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
                    <div class="box-header with-border">
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
            </div>
            <!-- /.box -->


            <!-- /.Data Base statistics chart -->
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

            <!-- Calendar -->
            <div class="box box-solid bg-green-gradient">
                <div class="box-header ui-sortable-handle" style="cursor: move;">
                    <i class="fa fa-calendar"></i>

                    <h3 class="box-title">Calendar</h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <!-- button with a dropdown -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bars"></i></button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="#">Add new event</a></li>
                                    <li><a href="#">Clear events</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">View calendar</a></li>
                                </ul>
                            </div>
                            <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <!--The calendar -->
                        <div id="calendar" style="width: 100%"><div class="datepicker datepicker-inline"><div class="datepicker-days" style="display: block;"><table class="table table-condensed"><thead><tr><th class="prev" style="visibility: visible;">«</th><th colspan="5" class="datepicker-switch">March 2016</th><th class="next" style="visibility: visible;">»</th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td class="old day">28</td><td class="old day">29</td><td class="day">1</td><td class="day">2</td><td class="day">3</td><td class="day">4</td><td class="day">5</td></tr><tr><td class="day">6</td><td class="day">7</td><td class="day">8</td><td class="day">9</td><td class="day">10</td><td class="day">11</td><td class="day">12</td></tr><tr><td class="day">13</td><td class="day">14</td><td class="day">15</td><td class="day">16</td><td class="day">17</td><td class="day">18</td><td class="day">19</td></tr><tr><td class="day">20</td><td class="day">21</td><td class="day">22</td><td class="day">23</td><td class="day">24</td><td class="day">25</td><td class="day">26</td></tr><tr><td class="day">27</td><td class="day">28</td><td class="day">29</td><td class="day">30</td><td class="day">31</td><td class="new day">1</td><td class="new day">2</td></tr><tr><td class="new day">3</td><td class="new day">4</td><td class="new day">5</td><td class="new day">6</td><td class="new day">7</td><td class="new day">8</td><td class="new day">9</td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-months" style="display: none;"><table class="table table-condensed"><thead><tr><th class="prev" style="visibility: visible;">«</th><th colspan="5" class="datepicker-switch">2016</th><th class="next" style="visibility: visible;">»</th></tr></thead><tbody><tr><td colspan="7"><span class="month">Jan</span><span class="month">Feb</span><span class="month">Mar</span><span class="month">Apr</span><span class="month">May</span><span class="month">Jun</span><span class="month">Jul</span><span class="month">Aug</span><span class="month">Sep</span><span class="month">Oct</span><span class="month">Nov</span><span class="month">Dec</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-years" style="display: none;"><table class="table table-condensed"><thead><tr><th class="prev" style="visibility: visible;">«</th><th colspan="5" class="datepicker-switch">2010-2019</th><th class="next" style="visibility: visible;">»</th></tr></thead><tbody><tr><td colspan="7"><span class="year old">2009</span><span class="year">2010</span><span class="year">2011</span><span class="year">2012</span><span class="year">2013</span><span class="year">2014</span><span class="year">2015</span><span class="year">2016</span><span class="year">2017</span><span class="year">2018</span><span class="year">2019</span><span class="year new">2020</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div></div></div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-black">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- Progress bars -->
                                <div class="clearfix">
                                    <span class="pull-left">Task #1</span>
                                    <small class="pull-right">90%</small>
                                </div>
                                <div class="progress xs">
                                    <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                                </div>

                                <div class="clearfix">
                                    <span class="pull-left">Task #2</span>
                                    <small class="pull-right">70%</small>
                                </div>
                                <div class="progress xs">
                                    <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <div class="clearfix">
                                    <span class="pull-left">Task #3</span>
                                    <small class="pull-right">60%</small>
                                </div>
                                <div class="progress xs">
                                    <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                                </div>

                                <div class="clearfix">
                                    <span class="pull-left">Task #4</span>
                                    <small class="pull-right">40%</small>
                                </div>
                                <div class="progress xs">
                                    <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.box -->

            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->

    </div>
