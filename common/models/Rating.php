<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rating".
 *
 * @property integer $id
 * @property integer $job_id
 * @property string $customer_user_id
 * @property integer $rating
 *
 * @property Job $job
 * @property User $user
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_id', 'customer_user_id','cleaner_user_id','rating', 'rated_by'], 'required'],
            [['job_id', 'customer_user_id','cleaner_user_id', 'rated_by'], 'integer'],
            [['review','rating'],'safe'],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Job::className(), 'targetAttribute' => ['job_id' => 'id']],
            [['customer_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['customer_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'job_id' => Yii::t('app', 'Job ID'),
            'customer_user_id' => Yii::t('app', 'User ID'),
            'cleaner_user_id'=> yii::t('app','Cleaner ID'),
            'rating' => Yii::t('app', 'Rating'),
            'rated_by'=> yii::t('app','rated_by'),
            'review' => yii::t('app','review'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(Job::className(), ['id' => 'job_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'customer_user_id']);
    }
}
