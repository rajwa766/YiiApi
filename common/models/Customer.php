<?php

namespace common\models;
use yii\db\Query;
use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property string $user_id
 *
 * @property User $user
 * @property Job[] $jobs
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     *
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }
      public static function getOptions(){


    $query=(new Query())->select(['user_id','user.email'])->from('customer')->innerJoin('user','user_id = user.id')->all();

       $value=(count($query)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($query,'user_id','email'); //id = your ID model, name = your caption

       return $value;
   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobs()
    {
        return $this->hasMany(Job::className(), ['customer_user_id' => 'user_id']);
    }
}
