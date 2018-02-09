<?php

namespace common\models;

use common\models\user;
use Yii;

/**
 * This is the model class for table "advertisment".
 *
 * @property integer $id
 * @property string $customer_id
 * @property integer $pool_id
 * @property integer $advertisment_id
 *
 * @property Cleaner $customer
 * @property AdPool $pool
 */
class Advertisment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advertisment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login_user_id', 'pool_id',], 'required'],
            [['login_user_id', 'pool_id'], 'integer'],
            
            [['login_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['login_user_id' => 'id']],
            [['pool_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdPool::className(), 'targetAttribute' => ['pool_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'login_user_id' => Yii::t('app', 'Customer ID'),
            'pool_id' => Yii::t('app', 'Pool ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(user::className(), ['id' => 'login_user_id']);
    }
   
  /* public function getCustomerName()
   {
    return $this->customer->user->username;
   }*/
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPool()
    {
        return $this->hasOne(AdPool::className(), ['id' => 'pool_id']);
    }
}
