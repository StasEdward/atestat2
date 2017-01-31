<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;
use yii\web\JsExpression;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\TracesList */


$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Back', 'url' => Yii::$app->request->referrer];
//$this->params['breadcrumbs'][] = $this->title;
//print_r($arr_freq);
/*
echo "arr_freq:";
print_r($arr_freq);
echo "<br>";

echo "arr_power:";
print_r($arr_power);
echo "<br>";

echo "mask_name:";
echo $mask_name;
echo "<br>";

echo "doSubMask:";
echo $doSubMask;
echo "<br>";

echo "mask_arr:";
print_r($mask_arr);
echo "<br>";
*/


if ($doSubMask == true){
    $maskTitle = ", Mask name $mask_name";
}
else{
    $maskTitle = "";
    $mask_arr = null;
//    $mask_arr = [0];
}



?>
<div class="traces-list-view">

    <div class="box box-success box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Trace #<?= Html::encode($this->title) ?></h3>
                  <h3 class="box-title"><?= Html::encode($maskTitle) ?></h3>
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>

                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div id="modal-body<?= $model->id ?>">

                  <div id="container<?= $model->id ?>">
                  </div>
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
                            'renderTo' => 'container'.$model->id,
                        //    'height' = 400,
                            'borderWidth' => '0',
                            'backgroundColor' => '#FFFFFF',
                            'plotBackgroundColor' => '#FFFFFF',
                            'marginLeft' => 70,
                            'zoomType' => 'x',
                            'panning' => true,
                            'panKey' => 'shift',
                          ],
                          'title' => [
                              'text' => null,
                          ],
                          'xAxis' => [
                            'categories' => $arr_freq,
                            'title' => [
                              'text' => $model->X_AXIS
                            ],
                          ],
                          'yAxis' => [
                        //      'categories' => $arr_power,
                            'title' => [
                              'text' => $model->Y_AXIS

                            ],
                          ],
                          'legend' => [
                            'enabled' => false,
                          ],
                          'plotOptions' => [
                            'series' => [
                              'marker' => [
                                'enabled' => false
                                ]
                              ]
                          ],
                          'series' => [
                              [
                                  'type' => 'spline',
                                  //'name' => false,
                                  'name' => $model->Y_AXIS,
                                  'data' => $arr_power,
                                  'color' => new JsExpression('Highcharts.getOptions().colors[1]'),


                              ],
                              [
                                  'type' => 'spline',
                                  //'name' => false,
                                  'name' => 'Power',
                                  'data' => $mask_arr,
                                  //'data' =>new SeriesDataHelper($mask_arr, ['power_val:int', 'freq_val:int']),
                                  'color' => new JsExpression('Highcharts.getOptions().colors[2]'),


                              ],


                          ],
                      ]
                  ]);

          ?>
                </div>
                <!-- /.box-body -->
              </div>


</div>
