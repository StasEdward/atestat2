<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\themes\adminLTE\assets\AdminlteAsset;
use yii\helpers\Url;

use dektrium\user\models\User;

/* @var $this \yii\web\View */
/* @var $content string */
AdminlteAsset::register($this);
AppAsset::register($this);


//print_r(Yii::$app->user->identity);

//echo Yii::$app->user->identity->email;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

		<link rel="icon" type="image/png" href="/favicon.png" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="skin-blue sidebar-mini">

<?php $this->beginBody() ?>
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="/" class="logo">
              <!-- mini logo for sidebar mini 50x50 pixels -->
              <span class="logo-mini"><b>A</b>TE</span>
              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg"><?php echo Html::img('@web/images/logo_white.png', ['alt'=>Yii::$app->name]) ?></span>
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
              <!-- Sidebar toggle button-->
              <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>
              <div class="navbar-custom-menu">
                  <?php
									$navItems=[
    							//		['label' => 'Home', 'url' => ['/site/index']],
    							//		['label' => 'Contact', 'url' => ['/site/contact']]
  							];
  							if (Yii::$app->user->isGuest) {
									array_push($navItems,['label' => '<i class="fa fa-unlock-alt"></i>  Sign In', 'url' => ['/user/security/login']]);
  							} else {
    							array_push($navItems,['label' => '<i class="fa  fa-lock"></i>  Logout (' . Yii::$app->user->identity->username . ') ',
        					'url' => ['/user/security/logout'],                                       
        					'linkOptions' => ['data-method' => 'post']]
    						);
  							}
								echo Nav::widget([
								    'options' => ['class' => 'nav navbar-nav'],
								    'items' => $navItems,
										'encodeLabels' => false,
								]);
                  ?>
              </div>
            </nav>

        </header>

        <?= $content ?>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <?php echo Yii::powered(); ?>
            </div>
            Copyright &copy; <?php echo date('Y'); ?> by Ceragon Networks Ltd. All Rights Reserved.
        </footer>

    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php
yii\bootstrap\Modal::begin([
    'header' => '<span id="modalHeaderTitle"></span>',
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-sm',
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
		'closeButton' =>['tag'=>'close', 'label'=> 'Zamknij'],
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
echo '<div id="modalContent"><div style="text-align:center"><img src="'.Url::to('/images/loading.gif').'"></div></div>';
yii\bootstrap\Modal::end();
?>
