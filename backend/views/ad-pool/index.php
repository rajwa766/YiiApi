<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\AdPoolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ad Pools');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-pool-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ad Pool'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           [
              'attribute'=>'cleaner_user_id',
             'value' => function($model) { 
              return $model->poolUser->username;
          }
           ],


            //'cleaner_user_id',
           // 'cleanerUser.cleaner.user.name',
           /* [
        'attribute' => 'ad_place_id',
        'value' => function($model) { 
              return $model->adPlace->name  ;
            },
        ], */
        [
            'attribute'=> 'ad_place_id',
            'value'=>'adPlace.name',
        ],

        [
            'attribute'=>'subscription_id',
            'value'=>'subscription.name',
        ],
           
        [
            'attribute'=>'image',
            'format' => ['image',['width'=>'100','height'=>'100']],
            'value' => function($model) {
            
             return $model->image;
        }
           ],

           /*  [
        'attribute' => 'status',
        'value' => function($model) { 
              if($model->status == 0)
              {
                return 'Pending';
              }
              else if($model -> status == 1)
              {
                return 'Unapproved';
              }
              else
              {
                return 'Approved';
              }
            },
        ],
*/

        [
        'attribute' => 'status',
        'format' => 'raw',
        'value' => function ($model) {                      
           if($model->status == 0)
              {
                return 'Pending';
              }
              else if($model -> status == 1)
              {
                return 'Unapproved';
              }
              else
              {
                return 'Approved';
              }
        },
        'filter'=>[0=>"Pending",1=>'UnApproved', 2=>"Approved"]],

       [
            'header' => 'Payable',
                'format' => 'html',
            
                'value' => function($model) {
              
                 return "<div class='payment_button_general' ><a class='" . $model->id . "' >payment voucher</a></div>";
    
           
                }
       ],
            [
                'class' => 'yii\grid\ActionColumn'],
            ],

             ]);
     
              ?>
              
<?php Pjax::end(); ?></div>
