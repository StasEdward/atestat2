<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

//$this->title = 'Ceragon ATE statistics WEB site';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
  <div class="col-md-3">
  </div>
  <div class="col-md-6">
      <div class="site-about">
          <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-ban"></i> Alert! Sign in to start your session</h4>
                  To view this site you must be registered and logged in:   <a href="/user/security/login"><i class="fa fa-unlock-alt"></i>   Sign In</a>
         </div>

        <center><img class="img-responsive" src="/images/about.png" alt="Chania"></center>
      <?php //echo Html::img('@web/images/about.png', ['alt'=>Yii::$app->name]) ?>
    </div>
</div>
<div class="col-md-3">
</div>
</div>
