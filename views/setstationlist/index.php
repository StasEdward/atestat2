<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SETSTATIONSLISTSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stations list';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setstationslist-index">
    <?php echo $this->render('_search', ['model' => $searchModel, 'stationListData' => $stationListData]); ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'bootstrap' => 'true',
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>true, // pjax is set to always true for this demo
        'bordered'=>false,
        'striped'=>true,
        'condensed'=>true,
        'responsive'=>true,
        'hover'=>true,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'stationid',
            'devicename',
            'devicetype',
            'interface',
            'addr',
            // 'order_id',
            // 'devpic',
            // 'test_function_name',
            // 'dllname',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
