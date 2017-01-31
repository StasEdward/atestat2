<?php
namespace app\controllers;

use Yii;
use app\models\TracesList;
use app\models\MaskList;
use app\models\MaskListSearch;
use app\models\TracesListSearch;
//use app\controllers\MaskListController;
//use app\controllers\MaskList;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * TracesListController implements the CRUD actions for TracesList model.
 */
class TracesListController extends Controller
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
     * Lists all TracesList models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TracesListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TracesList model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $mask_name)
    {
        str_replace(' ', '%20', $mask_name);

//      $mask_name = "Delta Pout(dBm)";
      $trace_model = $this->findModel($id);
      $tr_arr = $trace_model->toArray();


      $arr_freq = array();
      $strings_array = explode('|', $tr_arr['TRACE_FREQ_DATA']);

      foreach ($strings_array as $each_number) {
          $arr_freq[] = (float) $each_number;
      }

      $arr_power = array();
      $strings_array = explode('|', $tr_arr['TRACE_POWER_DATA']);

      foreach ($strings_array as $each_number) {
          $arr_power[] = (float) $each_number;
      }

      $arr_ids = array();
      $strings_array = explode('|', $tr_arr['TRACE_POINT_IDS']);

      foreach ($strings_array as $each_number) {
          $arr_ids[] = (int) $each_number;
      }
    //  print_r($arr_ids);
      array_multisort($arr_ids, SORT_ASC, $arr_freq, $arr_power);
//      array_multisort($arr_ids, SORT_DESC, $arr_power);
    //  var_dump($arr_ids);
//      print_r($arr_ids);
//      echo "<br>";

//      echo $maskPowerRef;
//      echo "<br>";

      $NewMask= array();
      $pos = strpos($mask_name, ')');
      if ($pos > 0)
      {
         // echo $pos;
          $short_mask_name = substr($mask_name, $pos+1);
        //  echo "mask name:".$short_mask_name."";
          if (strlen($short_mask_name) > 1){
              $mask_model = new MaskList();
              $mask_id = (int) MaskList::getMaskID($short_mask_name);
              if($mask_id > 0){
                  $doSubMask = true;
              }
              else{
                  $doSubMask = false;
              }
          }
          else{
              $doSubMask = false;
            //  $short_mask_name = "blank";
            //  array_push($NewMask,0);
          }

      }
     else
        {
     	    $doSubMask = false;
        }
        //echo $short_mask_name;
        if ($doSubMask == true)
                {
                    //$fr_center = (count($arr_freq) -1) / 2;
                    $pw_center = (count($arr_power) -1) / 2;

              //      $maskFreqRef = $arr_freq[$fr_center];
                    $maskPowerRef = $arr_power[$pw_center];



                    $maskFreq_arr = MaskList::getMaskFreqValues($mask_id);
                    $maskPower_arr = MaskList::getMaskPowerValues($mask_id);
                    $maxDots = count($maskFreq_arr);
                //    echo $maskFreq_arr[0]['freq_val'];
                    $maskArrayX = array();
                    for ($i=0; $i < ($maxDots); $i++){
                        array_push($maskArrayX, $maskFreq_arr[$i]['freq_val']);
                    }

                    $maskArrayY = array();
                    for ($i=0; $i < ($maxDots); $i++){
                        if ($mask_id < 200000)
                            array_push($maskArrayY, $maskPower_arr[$i]['power_val']);
                        else
                            array_push($maskArrayY, $maskPower_arr[$i]['power_val']  + $maskPowerRef);
                    }



            //        print_r($maskArrayX);
            //        echo "<br>";
            //        print_r($maskArrayY);


                    //echo "maxDots: ".$maxDots."<br>";
                    $Span = $maskArrayX[$maxDots-1] - $maskArrayX[0];
                    //echo "Span: ".$Span."<br>";
        	        $CenterFreq = ($Span /2) + $arr_freq[0];
                    //echo "CenterFreq: ".$CenterFreq."<br>";
        	        $TrStep = $Span/(count($arr_power)-1);
                    //echo "TrStep: ".$TrStep."<br>";
        	        $CurrFreq = $arr_freq[0];
                    //echo "CurrFreq: ".$CurrFreq."<br>";
        	        $tmpval = $maskArrayY[0];
                    //echo "tmpval: ".$tmpval."<br>";
        	        $OutCounter = count($arr_power)-1;
                    //echo "OutCounter: ".$OutCounter."<br>";

                    $NewMask= array();
                    for ($Counter=0; $Counter <= ($OutCounter);$Counter++)
   	                {
   	                    $i = 0;
   	                    while ($i < ($maxDots-1))
   	                    {
                            if (($CurrFreq >= ($maskArrayX[$i] + $CenterFreq)) and ($CurrFreq <= ($maskArrayX[$i + 1] + $CenterFreq)))
   	                        {
                                $tmpval = (($CurrFreq - ($maskArrayX[$i] + $CenterFreq))/(($maskArrayX[$i + 1] + $CenterFreq) - ($maskArrayX[$i] + $CenterFreq)))*($maskArrayY[$i + 1] - $maskArrayY[$i]) + $maskArrayY[$i];
   	                            break;
   	                        }
                            $i = $i+1;
                        }
   	                    $CurrFreq = $CurrFreq + $TrStep;
   	                    array_push($NewMask,$tmpval);
   	                }
                }

        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'arr_freq' => $arr_freq,
            'arr_power' => $arr_power,
            'mask_name' => $short_mask_name,
            'doSubMask' => $doSubMask,
            'mask_arr' => $NewMask,
          //  'freq_array' => $freq_array,
        ]);
    }

    /**
     * Creates a new TracesList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    //    $mask_model = new MaskList();


        $model = new TracesList();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TracesList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
     * Deletes an existing TracesList model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TracesList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TracesList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TracesList::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
