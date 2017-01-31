<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \yii\helpers\ArrayHelper;
//use app\models\DaylyTestResults;
use app\controllers\DaylyTestResultsController;
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DaylyTestResultsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daily Test Results';
?>
<div class="dayly-test-results-index">

    

<?= Highcharts::widget([

    'scripts' => [
        'modules/exporting',
        'themes/grid',
    ],
    'options' => [
        'title' => [
            'text' => 'Last 24 hours test results',
        ],
        'xAxis' => [
            'categories' => ['Ceragon', 'Flex1', 'Flex2', 'Ionics1', 'Ionics2', 'VCL' ],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => 'Total test results',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => 'black',
                    ],
                ],
            ],
        ],
        'series' => [
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
                'color' => new JsExpression('Highcharts.getOptions().colors[1]'),
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
                        'color' => new JsExpression('Highcharts.getOptions().colors[1]'), // Joe's color
                    ],
                ],
                'center' => [100, 80],
                'size' => 100,
                'showInLegend' => false,
                'dataLabels' => [
                    'enabled' => true,
                ],
            ],
        ],
    ]
]);  ?>
</div>
