<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ad_place".
 *
 * @property integer $id
 * @property string $name
 * @property string $timestamp
 *
 * @property AddPool[] $addPools
 */
class AdPlace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ad_place';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
            'name' => Yii::t('app', 'Place Name'),
            'timestamp' => Yii::t('app', 'Timestamp'),
        ];
    }
      public static function getOptions(){
      $data= AdPlace::find()->all();
       $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','name'); //id = your ID model, name = your caption

       return $value;
   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddPools()
    {
        return $this->hasMany(AddPool::className(), ['ad_place_id' => 'id']);
    }
}
