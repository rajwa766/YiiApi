<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\CleanerCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cleaner-category-form">

    <?php $form = ActiveForm::begin(); ?>

             <?=   $form->field($model, 'cleaner_user_id')->label('Select Theme')->widget(Select2::classname(), [
        'model' => $model,
        'data' => common\models\Cleaner::getOptions(),
        'options' => [
            'placeholder' => 'Select Cleaner',
            'class' => 'form-control',
            'multiple' => false
        ],]);
    ?>

   
             <?=   $form->field($model, 'category_id')->label('Select Category')->widget(Select2::classname(), [
        'model' => $model,
        'data' => common\models\Category::getOptions(),
        'options' => [
            'placeholder' => 'Select Category',
            'class' => 'form-control',
            'multiple' => false
        ],]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
