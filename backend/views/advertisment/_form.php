<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Advertisment;

/* @var $this yii\web\View */
/* @var $model common\models\Advertisment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advertisment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'login_user_id')->textInput(['maxlength' => true]) ?>
   <!--  <?= $form//->field($model,'customer_id')->dropDownList(
    		//ArrayHelper::map(Advertisment::find()->all(),'customer_id','username'),
    	//	['prompt'=>'select Cleaner']

    	)?> -->

    <?= $form->field($model, 'pool_id')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
