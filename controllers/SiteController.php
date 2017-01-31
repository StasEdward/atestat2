<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\DaylyTestResults;
use app\models\PASSFAILDAYLY;
use app\models\DbStat;
use yii\web\JsExpression;
use \yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $daylydataProvider = new ActiveDataProvider([
            'query' => PASSFAILDAYLY::find()->orderBy('DATE'),
            'pagination' => false
        ]);

        if (Yii::$app->user->isGuest){
            return $this->render('about', [
            ]);
        }

        $fail_arr = array();
        $pass_arr = array();
        $error_arr = array();
        $average_arr = array();
        $pass_arr = DaylyTestResults::getLastDayPassResults();
        $fail_arr = DaylyTestResults::getLastDayFailResults();
        $error_arr = DaylyTestResults::getLastDayErrorResults();
        $average_arr = $this->foreachFunc($pass_arr,$fail_arr);
        $db_statist_arr = array();
        $db_global_arr = array();
        $db_result_arr = array();
        $db_trace_arr = array();
        $db_statist_arr = DbStat::getDbStatistics();

    //    print_r($db_statist_arr[3]);
        $db_result_arr = $db_statist_arr[2];
        $db_global_arr = $db_statist_arr[3];
        $db_trace_arr = $db_statist_arr[4];


    //    print_r($db_trace_arr);

        $uutFail_result = array();
        $uut_result = array();
        $TotaluutFail_result = array();
        $uutFail_result = DaylyTestResults::getLastDayUUTFails();

        //print_r($uutFail_result);

        $UUTFailprovider = new ArrayDataProvider([
            'allModels' => $uutFail_result,
            'sort' => [
                'attributes' => ['name', 'fails',],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);



        $color_array = array();
        $elements_in_arr = count($uutFail_result);
        for ($i=0; $i < $elements_in_arr; $i++) {
            $color_code = rand (0 , 9);
            $js_text = "Highcharts.getOptions().colors[".$color_code."]";
            $color_array[$i]['color'] = new JsExpression($js_text);
        }



        //    echo("</br>");
        for ($i=0; $i < $elements_in_arr; $i++) {
            $TotaluutFail_result[$i] =  $uutFail_result[$i] + $color_array[$i];
            $TotaluutFail_result[$i]['y'] =  (int)$TotaluutFail_result[$i]['fails'];
        }
        //  print_r($TotaluutFail_result);
//print_r($TotaluutFail_result);

        $pass_percent = 0;
        $fail_percent = 0;
        $error_percent = 0;
        $facility_arr = array();

        $totall_produced = array_sum($pass_arr) + array_sum($fail_arr) + array_sum($error_arr);
        $pass_percent = ceil ((array_sum($pass_arr) * 100) / $totall_produced);
        $fail_percent = ceil ((array_sum($fail_arr) * 100) / $totall_produced);
        $error_percent = ceil ((array_sum($error_arr) * 100) / $totall_produced);

        if ((Yii::$app->user->identity->username <> 'admin') AND (Yii::$app->user->identity->username <> 'Ceragon')){
            $facility_arr = [Yii::$app->user->identity->username];
            //$facility_name = Yii::$app->user->identity->username;
        }
        else{
            $facility_arr = ['Ceragon', 'Flex', 'Ionics', 'VCL', 'JBL' ];
            //$facility_arr = ['Ceragon', 'Flex1', 'Flex2', 'Ionics1', 'Ionics2', 'VCL1', 'JBL1' ];
            //$facility_name = '';
        }



        $DaylyPF_result = array();
        $DaylyPF_result = DaylyTestResults::getDaylyPassFailResults();


        $coloPFr_array = array();

        for ($i=0; $i < count($facility_arr) ; $i++) {
            $js_text = "Highcharts.getOptions().colors[".($i-1)."]";
            $coloPFr_array[$i]['color'] = new JsExpression($js_text);
        }

        //    print(count(array_column($DaylyPF_result[0], 'PASS')));
        $TotalDaylyPF_Passresult = array();
        for ($i=0; $i < count($facility_arr); $i++) {
            $TotalDaylyPF_Passresult[$i] = $coloPFr_array[$i];
            $TotalDaylyPF_Passresult[$i]['name'] = $facility_arr[$i];
            $TotalDaylyPF_Passresult[$i]['type'] = "line";
            $TotalDaylyPF_Passresult[$i]['pointStart'] = gmmktime(0, 0, 0, 1, 17, 2017) * 1000;
            $TotalDaylyPF_Passresult[$i]['pointInterval'] = 24 * 3600 * 1000;
            $tmp_dayly = $DaylyPF_result[$i];
            $tmp_arr = array_column($tmp_dayly, 'PASS');
            $TotalDaylyPF_Passresult[$i]['data'] = array_merge(array_map('intval', array_slice($tmp_arr, 0)));
        }

        $TotalDaylyPF_Failsresult = array();
        for ($i=0; $i < count($facility_arr); $i++) {
            $TotalDaylyPF_Failsresult[$i] = $coloPFr_array[$i];
            $TotalDaylyPF_Failsresult[$i]['name'] = $facility_arr[$i];
            $TotalDaylyPF_Failsresult[$i]['type'] = "line";
            $TotalDaylyPF_Failsresult[$i]['pointStart'] = gmmktime(0, 0, 0, 1, 17, 2017) * 1000;
            $TotalDaylyPF_Failsresult[$i]['pointInterval'] = 24 * 3600 * 1000;
            $tmp_dayly = $DaylyPF_result[$i];
            $tmp_arr = array_column($tmp_dayly, 'FAIL');
            $TotalDaylyPF_Failsresult[$i]['data'] = array_merge(array_map('intval', array_slice($tmp_arr, 0)));
        }


        return $this->render('index', [
            //      'searchModel' => $searchModel,
            //   'dataProvider' => $dataProvider,
            'pass_arr' => $pass_arr,
            'fail_arr' => $fail_arr,
            'error_arr' => $error_arr,
            'average_arr' => $average_arr,
            'daylydataProvider' => $daylydataProvider,
            'db_global_arr' => $db_global_arr,
            'db_result_arr' => $db_result_arr,
            'db_trace_arr' => $db_trace_arr,
            'pass_percent' => $pass_percent,
            'fail_percent' => $fail_percent,
            'error_percent' => $error_percent,
            'uutFail_result' => $uutFail_result,
            'TotaluutFail_result' => $TotaluutFail_result,
            'facility_arr' => $facility_arr,
            'TotalDaylyPF_Passresult' => $TotalDaylyPF_Passresult,
            'TotalDaylyPF_Failsresult' => $TotalDaylyPF_Failsresult,
            'UUTFailprovider' => $UUTFailprovider,
            //'facility_name' => $facility_name,


        ]);

    }



    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('/index'));
        //return $this->goHome();
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            // change layout for error action
            if ($action->id=='login')
            $this->layout = 'login';
            return true;
        } else {
            return false;
        }
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }


    public function actionEntry()
    {
        $model = new EntryForm;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // ?????? ? $model ?????? ?????????

            // ?????? ???-?? ???????? ? $model ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // ???? ???????? ???????????? ?????? ???, ???? ???? ?????? ? ??????
            return $this->render('entry', ['model' => $model]);
        }
    }


}
