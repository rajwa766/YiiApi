<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Job */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-form">

    <?php $form = ActiveForm::begin(); ?>
 <?=   $form->field($model, 'customer_user_id')->label('Select Customer')->widget(Select2::classname(), [
        'model' => $model,
        'data' => common\models\Customer::getOptions(),
        'options' => [
            'placeholder' => 'Select Customer',
            'class' => 'form-control',
            'multiple' => false
        ],]);
    ?>

                 <?=   $form->field($model, 'region_id')->label('Select Region')->widget(Select2::classname(), [
        'model' => $model,
        'data' => common\models\Region::getOptions(),
        'options' => [
            'placeholder' => 'Select Region',
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
            'enctype' => 'multipart/form-data',
            'multiple' => false
        ],]);
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    

    <?=
     $form->field($model, 'status')->dropDownList(['1'=>'Pending' , '2' => 'In Progress', '3' => 'Complete']);
    ?>

    <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'longitude')->textInput() ?>

      <?= $form->field($model, 'latitude')->textInput() ?>

   <?php echo '<label>Check Issue Date</label>';
    echo DatePicker::widget([
    'model'=>$model,
    'attribute' => 'date', 
     'value' => date('Y-M-d', strtotime('+2 days')),
    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'autoclose' => true,
        'todayHighlight' => true
    ]
]);
?>


<?=
     $form->field($model, 'work_options')->dropDownList(['1'=>'Daily' , '2' => 'Weekly', '3' => 'Monthly']);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
