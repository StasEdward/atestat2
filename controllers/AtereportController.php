<?php

namespace app\controllers;

use Yii;
use app\models\Atereport;
use app\models\AtereportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;


/**
* AtereportController implements the CRUD actions for Atereport model.
*/
class AtereportController extends Controller
{

    public function actions()
    {
        return \yii\helpers\ArrayHelper::merge(parent::actions(), [
            'partnumber' => [
                'class' => \kartik\depdrop\DepDropAction::className(),
                'outputCallback' => function ($selectedId, $params) {
                    return [
                        [
                            'id' => 1,
                            'name' => 'Car',
                        ],
                        [
                            'id' => 2,
                            'name' => 'bike',
                        ],
                    ];

                    // if using with optgroup return something like below instead of above
                    return [
                        'group1' => [
                            ['id' => '', 'name' => ''],
                            ['id' => '', 'name' => '']
                        ],
                        'group2' => [
                            ['id' => '', 'name' => ''],
                            ['id' => '', 'name' => '']
                        ]
                    ];
                }
            ]
        ]);
    }

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
    * Lists all Atereport models.
    * @return mixed
    */
    public function actionIndex()
    {
        $model = new Atereport();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }
        $searchModel = new AtereportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

 /*       $stations = AtereportSearch::find()->select('DISTINCT `STATIONID`')->orderBy(['STATIONID' => SORT_ASC])->all();
        $stationListData = ArrayHelper::map($stations,'STATIONID','STATIONID');
*/
        $uutlist = AtereportSearch::find()->select('DISTINCT `UUTNAME`')->orderBy(['UUTNAME' => SORT_ASC])->all();
        $uutListData = ArrayHelper::map($uutlist,'UUTNAME','UUTNAME');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
      //      'stationListData' => $stationListData,
            'uutlist' => $uutlist,
            'uutListData' => $uutListData,
        ]);
    }

    public function actionUutname()
    {
        print_r($_POST);

        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $stationid = $parents[0];
                $out = self::getUUTList($stationid);


             //   print_r($out);

                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getUUTList($stationid)
    {
        $searchModel = new AtereportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $uutnames = AtereportSearch::find()->select('DISTINCT `UUTNAME`')->orderBy(['UUTNAME' => SORT_ASC])->all();
        return  ArrayHelper::map($uutnames,'STATIONID','UUTNAME');


    }

    public function actionLists($id)
        {
            $countUuts = AtereportSearch::find()->select('DISTINCT `UUTNAME`')->where(['STATIONID' => $id])->orderBy(['UUTNAME' => SORT_ASC])->count();
            $uuts = AtereportSearch::find()->select('DISTINCT `UUTNAME`')->where(['STATIONID' => $id])->orderBy(['UUTNAME' => SORT_ASC])->all();

            if($countPosts>0){
                foreach($uuts as $uut){
                    echo "<option value='".$uut->UUTNAME."'>".$uut->UUTNAME."</option>";
                }
            }
            else{
                echo "<option>-</option>";
            }

        }

    public function actionPartnumbers($uutname)
        {
            $countPartNumberss = AtereportSearch::find()->select('DISTINCT `PARTNUMBER`')->where(['UUTNAME' => $uutname])->orderBy(['PARTNUMBER' => SORT_ASC])->count();
            $partnumbers = AtereportSearch::find()->select('DISTINCT `PARTNUMBER`')->where(['UUTNAME' => $uutname])->orderBy(['PARTNUMBER' => SORT_ASC])->all();

            if($countPartNumberss>0){
                foreach($partnumbers as $upartnumber){
                    echo "<option value='".$upartnumber->PARTNUMBER."'>".$upartnumber->PARTNUMBER."</option>";
                }
            }
            else{
                echo "<option> - </option>";
            }

        }

    public function actionPartnumberList() {
        $out = [];
   //      $out1 = [];
 //       $out = AtereportSearch::getPartNumberList('Albatross FUUT');
      /*foreach ($out as $key => $value) {
            $out1['id'] = $key;
            $out1['name'] = $key;
        }
echo "tyt";
*/
      //  print_r($out);
 /*       $out = [
            ['id'=>'partnum1', 'name'=>'ER-X003-0|B'],
            ['id'=>'partnum2', 'name'=>'ER-X003-0|C']
        ];

        print_r($out);
*/
       if (isset($_POST['depdrop_parents'])) {
            $uut = $_POST['depdrop_parents'];
            if ($uut != null) {
                $uut_name = $uut[0];
 //               $uut_name = 'ACM PPM';
                $out = AtereportSearch::getPartNumberList($uut_name);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
            /*    $out = [
                    ['id'=>'partnum1', 'name'=>'ER-X003-0|B'],
                    ['id'=>'partnum2', 'name'=>'ER-X003-0|C']
                ];  */
                echo Json:: encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
       echo Json::encode(['output'=>'', 'selected'=>'']);
    }


    public function actionPartnumberSecond() {
        $out = [];

        print_r($_POST);
        if (isset($_POST['depdrop_parents'])) {
            $uuts = $_POST['depdrop_parents'];
            $uut_name = empty($uuts[0]) ? null : $uuts[0];
            $subcat_id = empty($uuts[1]) ? null : $uuts[1];
            if ($cat_id != null) {
                $data = self::getProdList($cat_id, $subcat_id);
                /**
                * the getProdList function will query the database based on the
                * cat_id and sub_cat_id and return an array like below:
                *  [
                *      'out'=>[
                *          ['id'=>'<prod-id-1>', 'name'=>'<prod-name1>'],
                *          ['id'=>'<prod_id_2>', 'name'=>'<prod-name2>']
                *       ],
                *       'selected'=>'<prod-id-1>'
                *  ]
                */

                echo Json::encode(['output'=>$data['out'], 'selected'=>$data['selected']]);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    /**
    * Displays a single Atereport model.
    * @param string $id
    * @return mixed
    */
    public function actionView($id)
    {

        $searchModel = new AtereportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            
        ]);
    }

    /**
    * Creates a new Atereport model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return mixed
    */
    public function actionCreate()
    {
        $model = new Atereport();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
    * Updates an existing Atereport model.
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
    * Deletes an existing Atereport model.
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
    * Finds the Atereport model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param string $id
    * @return Atereport the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModel($id)
    {
        if (($model = Atereport::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // THE CONTROLLER
    public function actionSubcat() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getSubCatList($cat_id);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionProd() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $cat_id = empty($ids[0]) ? null : $ids[0];
            $subcat_id = empty($ids[1]) ? null : $ids[1];
            if ($cat_id != null) {
                $data = self::getProdList($cat_id, $subcat_id);
                /**
                * the getProdList function will query the database based on the
                * cat_id and sub_cat_id and return an array like below:
                *  [
                *      'out'=>[
                *          ['id'=>'<prod-id-1>', 'name'=>'<prod-name1>'],
                *          ['id'=>'<prod_id_2>', 'name'=>'<prod-name2>']
                *       ],
                *       'selected'=>'<prod-id-1>'
                *  ]
                */

                echo Json::encode(['output'=>$data['out'], 'selected'=>$data['selected']]);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    public function actionForm()
    {
        $model = new Atereport();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('form', [
            'model' => $model,
        ]);
    }

}
