<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Advertisment */

$this->title = Yii::t('app', 'Create Advertisment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Advertisments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advertisment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
