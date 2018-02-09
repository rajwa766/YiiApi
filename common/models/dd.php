<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "job".
 *
 * @property integer $id
 * @property string $customer_user_id
 * @property integer $region_id
 * @property integer $category_id
 * @property integer $status
 *
 * @property Category $category
 * @property Customer $customerUser
 * @property Region $region
 * @property Rating[] $ratings
 */
class Job extends \yii\db\ActiveRecord
{
    public $email;
    public $category_name;
     public $region_name;
     public $longitude;
     public $latitude;
    /**
     * @inheritdoc
     */
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'date','title','price','contact_no','region_id','category_id'], 'required'],
            [['id','customer_user_id', 'status'], 'integer'],
            [['longitude','latitude','sajid'],'safe'],
            [['email','description','address','region_name', 'category_name','contact_no'], 'string', 'max' => 1000],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['customer_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_user_id' => 'user_id']],
         
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email'=>yii::t('app','Email'),
            'customer_user_id' => Yii::t('app', 'Customer User ID'),
            'region_name' => Yii::t('app', 'Region'),
            'category_name' => Yii::t('app', 'Category'),
            'status' => Yii::t('app', 'Status'),
            'longitude'=>yii::t('app','longitude'),
            'latitude'=>yii::t('app', 'latitude'),
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            $this->customer_user_id=Yii::$app->user->identity->id;
            return true;
        }
        return false;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerUser()
    {
        return $this->hasOne(Customer::className(), ['user_id' => 'customer_user_id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'customer_user_id']);
    }

 
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['job_id' => 'id']);
    }

}
