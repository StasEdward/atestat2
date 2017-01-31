<?php

namespace app\controllers;
use Yii;
use app\models\DbStat;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DbStatController extends \yii\web\Controller
{
    public function actionIndex()
    {

              $db_statist_arr = array();
              $db_global_arr = array();
              $db_result_arr = array();
              $db_trace_arr = array();
              $db_statist_arr = DbStat::getDbStatistics();

              print_r($db_statist_arr[1]);


              $db_result_arr = $db_statist_arr[1];
              $db_global_arr = $db_statist_arr[2];
              $db_trace_arr = $db_statist_arr[3];


              print_r($db_trace_arr);

              return $this->render('index', [
                  'db_global_arr' => $db_global_arr,
                  'db_result_arr' => $db_result_arr,
                  'db_trace_arr' => $db_trace_arr,
              ]);

    }

}
