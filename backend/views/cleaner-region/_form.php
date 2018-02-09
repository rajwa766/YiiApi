<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\CleanerRegion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cleaner-region-form">

    <?php $form = ActiveForm::begin(); ?>


                <?=   $form->field($model, 'region_id')->label('Select Region')->widget(Select2::classname(), [
        'model' => $model,
        'data' => common\models\Region::getOptions(),
        'options' => [
            'placeholder' => 'Select Region',
            'class' => 'form-control',
            'multiple' => false
        ],]);
    ?>

               <?=   $form->field($model, 'cleaner_user_id')->label('Select Theme')->widget(Select2::classname(), [
        'model' => $model,
        'data' => common\models\Cleaner::getOptions(),
        'options' => [
            'placeholder' => 'Select Cleaner',
            'class' => 'form-control',
            'multiple' => false
        ],]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
