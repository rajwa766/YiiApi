<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cleaner_region".
 *
 * @property integer $id
 * @property integer $region_id
 * @property string $cleaner_user_id
 *
 * @property Cleaner $cleanerUser
 * @property Region $region
 */
class CleanerRegion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cleaner_region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cleaner_user_id', 'region_id'], 'required'],
            [['id', 'region_id', 'cleaner_user_id'], 'integer'],
            [['cleaner_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cleaner::className(), 'targetAttribute' => ['cleaner_user_id' => 'user_id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

   


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'region_id' => Yii::t('app', 'Region ID'),
            'cleaner_user_id' => Yii::t('app', 'Cleaner User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCleanerUser()
    {
        return $this->hasOne(Cleaner::className(), ['user_id' => 'cleaner_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }
}
