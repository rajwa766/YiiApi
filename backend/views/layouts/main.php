<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use kartik\sidenav\SideNav;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Renhold.no',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/user/index']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

    
 <div class="navbar-left col-lg-2  container">
               <?php   echo SideNav::widget([
    'type' =>SideNav::TYPE_PRIMARY,

    'encodeLabels' => false,
    'heading' => 'Operations',
    'encodeLabels' => false,
    //'heading' => $heading,
    'items' => [
        // Important: you need to specify url as 'controller/action',
        // not just as 'controller' even if default action is used.
        ['label' => 'Home', 'icon' => 'home', 'url' => Url::to(['/user/index'])],
        ['label' => 'Users', 'icon' => 'user', 'items' => [
            ['label' => ' All Users', 'url' => Url::to(['/user/index', 'type'=>SideNav::TYPE_DEFAULT])],
     
        
        ]],
           ['label' => 'Categories', 'icon' => 'glyphicon glyphicon-list-alt', 'items' => [

            ['label' => 'All Categories', 'url' => Url::to(['/category/index', 'type'=>SideNav::TYPE_DEFAULT])],
              ['label' => 'Add Categories', 'url' => Url::to(['/category/create', 'type'=>SideNav::TYPE_DEFAULT])],
            ['label' => 'Add Cleaner Categories', 'url' => Url::to(['/cleaner-category/index', 'type'=>SideNav::TYPE_DEFAULT])],
          
        
        ]],
         ['label' => 'Regions', 'icon' => 'glyphicon glyphicon-save-file', 'items' => [
            ['label' => ' All Regions', 'url' => Url::to(['/region/index', 'type'=>SideNav::TYPE_DEFAULT])],
            ['label' => 'Add Region', 'url' => Url::to(['/region/create', 'type'=>SideNav::TYPE_DEFAULT])],
            ['label' => 'Cleaner Regions', 'url' => Url::to(['/cleaner-region/index', 'type'=>SideNav::TYPE_DEFAULT])],
          
        
        ]],
            ['label' => 'Jobs', 'icon' => 'glyphicon glyphicon-compressed', 'items' => [
            ['label' => 'All Jobs', 'url' => Url::to(['/job/index', 'type'=>SideNav::TYPE_DEFAULT])],
            ['label' => 'Create Job', 'url' => Url::to(['/job/create', 'type'=>SideNav::TYPE_DEFAULT])],
          
        
        ]],
            ['label' => 'Ads', 'icon' => 'glyphicon glyphicon-picture', 'items' => [
               ['label' => 'Subscriptions', 'url' => Url::to(['/subscription/index', 'type'=>SideNav::TYPE_DEFAULT])],
            ['label' => 'Ad Places', 'url' => Url::to(['/ad-place/index', 'type'=>SideNav::TYPE_DEFAULT])],
            ['label' => 'Ad Pool', 'url' => Url::to(['/ad-pool/index', 'type'=>SideNav::TYPE_DEFAULT])],
          
        
        ]],
         


    ],
]); ?>
               </div>
                   <div class="container  col-lg-10">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>

        </div>

</div>
   <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; Renhold.no <?= date('Y') ?></p>
   
        </div>
    </footer>
 

    <?php $this->endBody() ?>


<?php $this->endPage() ?>
