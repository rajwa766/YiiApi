<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model common\models\AdPool */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ad-pool-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

               <?=   $form->field($model, 'cleaner_user_id')->label('Select Theme')->widget(Select2::classname(), [
        'model' => $model,
        'name'=>'cleaner_id',
        'data' => common\models\Cleaner::getOptions(),
        'options' => [
            'placeholder' => 'Select Cleaner',
            'class' => 'form-control',
            'multiple' => false
        ],]);

    ?>
 <?=   $form->field($model, 'ad_place_id')->label('Select Place For Ad')->widget(Select2::classname(), [
        'model' => $model,
        'data' => common\models\AdPlace::getOptions(),
        'options' => [
            'placeholder' => 'Select Ad Place',
            'class' => 'form-control',
            'multiple' => false
        ],]);
    ?>

                <?=   $form->field($model, 'subscription_id')->label('Select Subscription')->widget(Select2::classname(), [
        'model' => $model,
        'data' => common\models\Subscription::getOptions(),
        'options' => [
            'placeholder' => 'Select Subscription',
            'class' => 'form-control',
            'multiple' => false
        ],]);
    ?>

     <?=  $form->field($model, 'image')->widget(FileInput::classname(), [
                    
                    'pluginOptions' => [
                        'allowedFileExtensions' => ['jpg', 'gif', 'png', 'bmp'],
                        'showUpload' => true,
                        'initialPreview' => [
                            $model->image ? Html::img(Yii::$app->request->baseUrl . '../../../ads/' . $model->image) : null, // checks the models to display the preview
                        ],
                        'overwriteInitial' => false,
                    ],
                ]);
                ?>
<?=
     $form->field($model, 'status')->dropDownList(['2'=>'Approve' , '1' => 'Unapprove', '0' => 'Pending']);
?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
