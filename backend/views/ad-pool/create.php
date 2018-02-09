<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AdPool */

$this->title = Yii::t('app', 'Create Ad Pool');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ad Pools'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-pool-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
