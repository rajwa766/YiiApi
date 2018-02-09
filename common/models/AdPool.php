<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ad_pool".
 *
 * @property integer $id
 * @property string $cleaner_user_id
 * @property integer $ad_place_id
 * @property integer $subscription_id
 *
 * @property AdPlace $adPlace
 * @property Cleaner $cleanerUser
 * @property Subscription $subscription
 */
class AdPool extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ad_pool';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[  'subscription_id','ad_place_id','image'], 'required'],
            [['cleaner_user_id', 'status', 'subscription_id'], 'integer'],
            [['ad_place_id','image'],'safe'],
            [['ad_place_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdPlace::className(), 'targetAttribute' => ['ad_place_id' => 'id']],
            [['cleaner_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cleaner::className(), 'targetAttribute' => ['cleaner_user_id' => 'user_id']],
            [['subscription_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subscription::className(), 'targetAttribute' => ['subscription_id' => 'id']],
            [['image'], 'string', 'max' => 450],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cleaner_user_id' => Yii::t('app', 'Cleaner'),
            'ad_place_id' => Yii::t('app', 'Place'),
            'subscription_id' => Yii::t('app', 'Subscription'),
            'image' => Yii::t('app', 'Image'),
            'status' => yii::t('app','Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdPlace()
    {
        return $this->hasOne(AdPlace::className(), ['id' => 'ad_place_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            if(isset( $_REQUEST['AdPool']['cleaner_user_id']))
            {
                $this->cleaner_user_id=$_POST ['AdPool']['cleaner_user_id'];
                return true;
            }

        else
        {
            $this->cleaner_user_id=Yii::$app->user->identity->id;
            return true;
        }

        }
        return false;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCleanerUser()
    {
        return $this->hasOne(Cleaner::className(), ['user_id' => 'cleaner_user_id']);
    }
    public function getPoolUser()
    {
        return $this->hasOne(User::className(), ['id' => 'cleaner_user_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscription()
    {
        return $this->hasOne(Subscription::className(), ['id' => 'subscription_id']);
    }
   
    public function getImageurl()
   {
       return  $this->image ? Yii::$app->request->baseUrl.'../../../upload/' . $this->image : null;
//return \Yii::$app->request->BaseUrl.'/<path to image>/'.$this->logo;
   }
         
}
