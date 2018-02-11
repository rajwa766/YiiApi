<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use ruskid\stripe\StripeCheckout;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
<?= 
StripeCheckout::widget([
    'action' => '/',
    'name' => 'Demo test',
    'description' => '2 widgets ($20.00)',
    'amount' => 2000,
    'image' => '/128x128.png',
]);
?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'first_name',
            'last_name',
            'contact_no',
            // 'password',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'profile_pic',
            'address',
            'role',
            'account_activation_token',
            'is_paid',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
