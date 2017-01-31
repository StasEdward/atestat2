<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\SETSTATIONSLIST;
use app\models\SETSTATIONSLISTSearch;

use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\SETSTATIONSLISTSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setstationslist-search">
<div class="container-fluid">

<?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'class' => 'form-horizontal',
    ]);
    
    
        echo '<div class="row">
            <div class="col-xs-6">';
                echo $form->field($model, 'stationid')->dropDownList($stationListData, [
                    'id'=>'stationid',
                    'prompt' => 'Select Station name',
                    'type' => DepDrop::TYPE_SELECT2,
                    'select2Options' => [
                        'pluginOptions'=>['allowClear' => true]
                        ],
                    ]);
                 ?>
            </div>
        
        </div>
                <div class="form-group">
                    <div>
                    </div>
                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Reset', ['/setstationlist/index'],['class' => 'btn btn-warning']) ?>
                </div>


    <?php ActiveForm::end(); ?>
    </div>

</div>
