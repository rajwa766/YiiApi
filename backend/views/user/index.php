<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
             
                          
            'username',
            'first_name',
            'last_name',

            [
                       'attribute' => 'role',
                'format' => 'raw',
                'value' => function ($model) {                      
                    return  $model->role == 30 ? "Admin" : ($model->role == 10 ? "Customer" : 'Cleaner');
                },
                 'filter'=>[30=>"Admin",10=>"Customer",20=>"Cleaner"],
            ],

                  
                    'contact_no',
                    
                    // 'auth_key',
                    // 'password_hash',
                    // 'password_reset_token',
                    // 'email:email',
                    // 'profile_pic',
                    // 'address',
                    // 'role',
                    // 'account_activation_token',
                    // 'is_paid',
                    // 'status',

                     [
            'attribute' => 'status',
            'format' => 'raw',
            'value' => function ($model) {                      
           if($model->status == 10)
              {
                return 'Active';
              }
              
              else
              {
                return 'Banned';
              }
                },
                'filter'=>[10=>"Active",20=>'Banned']],

                    // 'created_at',
                    // 'updated_at',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
<?php Pjax::end(); ?></div>
