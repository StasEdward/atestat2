<?php

namespace app\controllers;

use Yii;
use app\models\GlobalTest;
use app\models\GlobalTestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\TestResults;

use app\models\TestResultsSearch;

/**
 * GlobalTestController implements the CRUD actions for GlobalTest model.
 */
class GlobalTestController extends Controller
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
     * Lists all GlobalTest models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest){
            return $this->render('/site/about', [
            ]);
        }

        $searchModel = new GlobalTestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=40;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all GlobalTest models.
     * @return mixed
     */
    public function actionFailed()
    {
        $date = date("Y-m-d", time());
        $searchModel = new GlobalTestSearch();
        if ((Yii::$app->user->identity->username <> 'admin') AND (Yii::$app->user->identity->username <> 'Ceragon'))
          $query = GlobalTestSearch::find()->where(['GLOBALRESULT' => 'Fail'])->andWhere(['FACILITY' => Yii::$app->user->identity->username])->orderBy(['TESTDATE' => SORT_DESC]);
        else
          $query = GlobalTestSearch::find()->where(['GLOBALRESULT' => 'Fail'])->andWhere(['TESTDATE' => $date])->orderBy(['TESTDATE' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => 40,
          ],
        ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all GlobalTest models.
     * @return mixed
     */
    public function actionPassed()
    {
        $date = date("Y-m-d", time());
        $searchModel = new GlobalTestSearch();
        if ((Yii::$app->user->identity->username <> 'admin') AND (Yii::$app->user->identity->username <> 'Ceragon'))
          $query = GlobalTestSearch::find()->where(['GLOBALRESULT' => 'Pass'])->andWhere(['FACILITY' => Yii::$app->user->identity->username])->orderBy(['TESTDATE' => SORT_DESC]);
        else
        $query = GlobalTestSearch::find()->where(['GLOBALRESULT' => 'Pass'])->andWhere(['TESTDATE' => $date])->orderBy(['TESTDATE' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => 40,
          ],
        ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all GlobalTest models.
     * @return mixed
     */
    public function actionErrors()
    {
        $date = date("Y-m-d", time());
        $searchModel = new GlobalTestSearch();
        if ((Yii::$app->user->identity->username <> 'admin') AND (Yii::$app->user->identity->username <> 'Ceragon'))
          $query = GlobalTestSearch::find()->where(['GLOBALRESULT' => 'Error'])->andWhere(['FACILITY' => Yii::$app->user->identity->username])->orderBy(['TESTDATE' => SORT_DESC]);
        else
          $query = GlobalTestSearch::find()->where(['GLOBALRESULT' => 'Error'])->andWhere(['TESTDATE' => $date])->orderBy(['TESTDATE' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => 40,
          ],
        ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single GlobalTest model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
  //    $resultModel = new TestResultsSearch();
  //    $resultModel = $resultModel::findAll(['HEADER_ID' => $id]);
    $query = TestResults::find()->where(['HEADER_ID' => $id])->orderBy(['TEST_ID' => SORT_ASC]);
    $dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 100,
        ],
      ]);
  //    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        //    'resultModel' => $resultModel,
        ]);
    }

    /**
     * Creates a new GlobalTest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GlobalTest();
        $model = $model::find()
        ->addOrderBy([
               'ID' => SORT_DESC,
            ])
            ->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GlobalTest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GlobalTest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GlobalTest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GlobalTest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GlobalTest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
