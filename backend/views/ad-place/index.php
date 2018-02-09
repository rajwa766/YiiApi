<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $searchModel common\models\AdPlaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ad Places');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-place-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ad Place'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
/*
            [
              'attribute'=> 'name',
               'value'=>'name',
            ],*/
            
            'name',
            'timestamp',

           /* [
                        'label' => Yii::t('app', "Date"),
                        'attribute' => 'timestampe',
                        'value' => 'timestamp',
                        'format' => 'raw',
                        'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'date1',
                            'convertFormat' => true,
                            'pluginOptions' => [
                                'locale' => [
                                    'format' => 'y-m-d'
                                ],
                            ],
                        ]),
           
        ],
*/



            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
