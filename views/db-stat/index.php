<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \yii\helpers\ArrayHelper;

use app\controllers\DbStatController;
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;


/* @var $this yii\web\View */
$this->title = 'Data Base statistics';

//print_r($db_global_arr);

?>
<div class="dayly-test-results-index">


  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <?= Highcharts::widget([

          'scripts' => [
            'modules/exporting',
            'themes/grid',
          ],
          'options' => [
            'title' => [
              'text' => 'Data Base statistics',
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
                'name' => 'File size(MB)',
                'data' => [
                  [
                    'name' => $db_global_arr['DB_Name'],
                    'y' => (int)$db_global_arr['DB_Size'],
                    //                        'y' => array_sum($fail_arr),
                    'color' => new JsExpression('Highcharts.getOptions().colors[0]'), // John's color
                  ],
                  [
                    'name' => $db_result_arr['DB_Name'],
                    'y' => (int)$db_result_arr['DB_Size'],
                    //    'sliced' => 'true',
                    //    'selected' => 'true',
                    //                        'y' => array_sum($fail_arr),
                    'color' => new JsExpression('Highcharts.getOptions().colors[1]'), // John's color
                  ],
                  [
                    'name' => $db_trace_arr['DB_Name'],
                    'y' => (int)$db_trace_arr['DB_Size'],
                    //                        'y' => array_sum($fail_arr),
                    'color' => new JsExpression('Highcharts.getOptions().colors[2]'), // John's color
                  ],
                ],
                'center' => ["50%", "50%"],
                'size' => 175,
                'showInLegend' => true,
                'dataLabels' => [
                  'enabled' => true,
                ],
              ],
            ],
          ]
        ]);  ?>


    </div>
    <div class="col-md-6">
      <?= Highcharts::widget([

        'scripts' => [
          'modules/exporting',
          'themes/grid',
        ],
        'options' => [
          'title' => [
            'text' => 'Data Base statistics',
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
                  //                        'y' => array_sum($fail_arr),
                  'color' => new JsExpression('Highcharts.getOptions().colors[3]'), // John's color
                ],
                [
                  'name' => $db_result_arr['DB_Name'],
                  'y' => (int)$db_result_arr['table_rows'],
                  //                        'y' => array_sum($fail_arr),
                  'color' => new JsExpression('Highcharts.getOptions().colors[4]'), // John's color
                ],
                [
                  'name' => $db_trace_arr['DB_Name'],
                  'y' => (int)$db_trace_arr['table_rows'],
                  //                        'y' => array_sum($fail_arr),
                  'color' => new JsExpression('Highcharts.getOptions().colors[5]'), // John's color
                ],
              ],
              'center' => ["50%", "50%"],
              'size' => 175,
              'showInLegend' => true,
              'dataLabels' => [
                'enabled' => true,
              ],
            ],
          ],
        ]
      ]);  ?>
    </div>

  </div>

  
</div>
</div>
