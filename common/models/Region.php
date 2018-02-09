<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property integer $id
 * @property string $name
 *
 * @property CleanerRegion[] $cleanerRegions
 * @property Job[] $jobs
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 450],
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
        ];
    }
      public static function getOptions(){
      $data= Region::find()->all();
       $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','name'); //id = your ID model, name = your caption

       return $value;
   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCleanerRegions()
    {
        return $this->hasMany(CleanerRegion::className(), ['region_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobs()
    {
        return $this->hasMany(Job::className(), ['region_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
     
}
