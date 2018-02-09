<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CleanerCategory */

$this->title = Yii::t('app', 'Create Cleaner Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cleaner Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cleaner-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
