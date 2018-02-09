<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Ratings;
 
?>
<div class="rating-view">

    <h1><?= Html::encode($this->title) ?></h1>


 <table class="table table-striped table-bordered">
<thead>
<tr>
<td>Job ID</td>
<td>User ID</td>
<td>Cleaner ID</td>
<td>Rated By</td>
<tr>
</thead>
<tbody>
  <?php 
foreach ($model as $model) {
	?>

	<tr>
		<td><?= $model['job_id'];?></td>
       
	</tr>
		<?php
}
   ?>
</tbody>
</table>


</div>
