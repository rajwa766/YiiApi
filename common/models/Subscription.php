<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subscription".
 *
 * @property integer $id
 * @property string $name
 * @property double $price
 * @property string $timestamp
 *
 * @property AddPool[] $addPools
 */
class Subscription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscription';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           
            [['id','days'], 'integer'],
            [['price'], 'number'],
            [['timestamp'], 'safe'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'Price'),
            'timestamp' => Yii::t('app', 'Timestamp'),
            'days' =>yii::t('app','Days'),
        ];
    }
      public static function getOptions(){
      $data= Subscription::find()->all();
       $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','name'); //id = your ID model, name = your caption

       return $value;
   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddPools()
    {
        return $this->hasMany(AddPool::className(), ['subscription_id' => 'id']);
    }
}
