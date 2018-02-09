<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CleanerRegion */

$this->title = Yii::t('app', 'Create Cleaner Region');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cleaner Regions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cleaner-region-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
