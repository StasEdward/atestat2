<?php

namespace app\controllers;

use Yii;
use app\models\SETSTATIONSLIST;
use app\models\SETSTATIONSLISTSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * SetstationlistController implements the CRUD actions for SETSTATIONSLIST model.
 */
class SetstationlistController extends Controller
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

    /**
     * Lists all SETSTATIONSLIST models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $model = new SETSTATIONSLIST();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        $stationlist = SETSTATIONSLISTSearch::find()->select('DISTINCT "STATIONID"')->orderBy(['STATIONID' => SORT_ASC])->all();
        $stationListData = ArrayHelper::map($stationlist,'stationid','stationid');


        $searchModel = new SETSTATIONSLISTSearch();

     //   $query = GlobalTest::find();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'stationlist' => $stationlist,
            'stationListData' => $stationListData,
        ]);
    }

    /**
     * Displays a single SETSTATIONSLIST model.
     * @param string $stationid
     * @param string $devicename
     * @return mixed
     */
    public function actionView($stationid, $devicename)
    {
        return $this->render('view', [
            'model' => $this->findModel($stationid, $devicename),
        ]);
    }

    /**
     * Creates a new SETSTATIONSLIST model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SETSTATIONSLIST();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'stationid' => $model->stationid, 'devicename' => $model->devicename]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SETSTATIONSLIST model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $stationid
     * @param string $devicename
     * @return mixed
     */
    public function actionUpdate($stationid, $devicename)
    {
        $model = $this->findModel($stationid, $devicename);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/setstationlist/index?SETSTATIONSLISTSearch[stationid]='.$model->stationid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SETSTATIONSLIST model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $stationid
     * @param string $devicename
     * @return mixed
     */
    public function actionDelete($stationid, $devicename)
    {
        $this->findModel($stationid, $devicename)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SETSTATIONSLIST model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $stationid
     * @param string $devicename
     * @return SETSTATIONSLIST the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($stationid, $devicename)
    {
        if (($model = SETSTATIONSLIST::findOne(['stationid' => $stationid, 'devicename' => $devicename])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
