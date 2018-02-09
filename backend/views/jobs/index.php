<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
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
<?php Pjax::begin(); ?>    <?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
					
			'id',
			[
				'attribute'=>'email',
				'filter'=>$searchModel,
				'value'=>function($model){
					if(isset($model->customerUser->user->email))
					return $model->customerUser->user->email;
				else
					return "none";
				}
			],
			
			[
			  'attribute'=>'region_name',
			  'filter'=>$searchModel,
			  'value' => function($model)
			  {
				if(isset($model->region)){
					return $model->region->name;
				}
				
			else
				return "none";
			  }
			],

			[
				'attribute'=>'category_name',
				'filter'=>$searchModel,
				'value'=>function($model){
					if(isset($model->category))
					return $model->category->name;
				else
					return "none";
				}
			],

		  /*  [
				'attribute'=>'category_id',
				'value'=> 'category.name',
			],
*/
		   
			
			'title',
			 'price',
			// 'status',
			 'contact_no',
			// 'description:ntext',
			 'address',
			// 'timestamp',
			 'date',
			 'longitude',
			 'latitude',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
<?php Pjax::end(); ?></div>
