<?php

namespace app\controllers;

use Yii;
use app\models\DaylyTestResults;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DaylyTestResultsController implements the CRUD actions for DaylyTestResults model.
 */
class DaylyTestResultsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function foreachFunc($arr1, $arr2) {
        $ret = array();
        foreach ($arr1 as $key => $value) {
            $ret[$key] = $arr1[$key] - $arr2[$key];
        }
        return $ret;
    }



    public function actionIndex()
    {
      //  $searchModel = new DaylyTestResultsSearch();
     //   $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $fail_arr = array();
        $pass_arr = array();
        $error_arr = array();
        $average_arr = array();

        $pass_arr = DaylyTestResults::getLastDayPassResults();
        $fail_arr = DaylyTestResults::getLastDayFailResults();
        $error_arr = DaylyTestResults::getLastDayErrorResults();

        $average_arr = $this->foreachFunc($pass_arr,$fail_arr);


        return $this->render('index', [
      //      'searchModel' => $searchModel,
         //   'dataProvider' => $dataProvider,
            'pass_arr' => $pass_arr,
            'fail_arr' => $fail_arr,
            'error_arr' => $error_arr,
            'average_arr' => $average_arr,
        ]);
    }

}
