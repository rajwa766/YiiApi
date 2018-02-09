<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AdPlace */

$this->title = Yii::t('app', 'Create Ad Place');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ad Places'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-place-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
