<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\JobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Jobs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Job'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
           
            [
              'attribute'=>'customer_user_id',
              'value'=>'user.username',
            ],

            [
              'attribute'=>'region_id',
              'value'=>'region.name',
            ],

            
            [
              'attribute'=>'category_id',
              'value'=>'category.name',
            ],
            'title',
            // 'price',
            // 'status',

             [
        'attribute' => 'status',
        'format' => 'raw',
        'value' => function ($model) {                      
           if($model->status == 1)
              {
                return 'Pending';
              }
              else if($model -> status == 2)
              {
                return 'In progress';
              }
              else
              {
                return 'Complete';
              }
        },
        'filter'=>[1=>"Pending",2=>'In progress', 3=>"Complete"]],

        [
        'attribute' => 'work_options',
        'format' => 'raw',
        'value' => function ($model) {                      
           if($model->status == 1)
              {
                return 'Daily';
              }
              else if($model -> status == 2)
              {
                return 'Weekly';
              }
              else
              {
                return 'Monthly';
              }
        },
        'filter'=>[1=>"Daily",2=>'Weekly', 3=>"Monthly"]],

            // 'contact_no',
            // 'description:ntext',
            // 'address',
            // 'timestamp',
            // 'date',
            // 'longitude',
            // 'latitude',
            // 'sajid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
