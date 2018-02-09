<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Rating */

$this->title = Yii::t('app', 'Create Rating');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ratings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rating-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
