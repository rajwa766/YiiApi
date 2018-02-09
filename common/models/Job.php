<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "job".
 *
 * @property integer $id
 * @property string $customer_user_id
 * @property integer $region_id
 * @property integer $category_id
 * @property string $title
 * @property double $price
 * @property integer $status
 * @property string $contact_no
 * @property string $description
 * @property string $address
 * @property string $timestamp
 * @property string $date
 * @property double $longitude
 * @property double $latitude
 * @property string $sajid
 *
 * @property Rating[] $ratings
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_user_id', 'region_id', 'category_id','title', 'contact_no', 'address','date','image','price'], 'required'],
            [['customer_user_id', 'category_id', 'status','work_options','region_id'], 'integer'],
            [['price', 'longitude', 'latitude'], 'number'],
            [['description'], 'string'],
        
            [['timestamp', 'date','image',], 'safe'],
            [['title', 'contact_no', 'address'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'customer_user_id' => Yii::t('app', 'User Name'),
            'region_id' => Yii::t('app', 'Region Name'),
            'category_id' => Yii::t('app', 'Category Name'),
            'title' => Yii::t('app', 'Title'),
            'price' => Yii::t('app', 'Price'),
            'job.status' => Yii::t('app', 'Status'),
            'contact_no' => Yii::t('app', 'Contact No'),
            'description' => Yii::t('app', 'Description'),
            'address' => Yii::t('app', 'Address'),
            'timestamp' => Yii::t('app', 'Timestamp'),
            'date' => Yii::t('app', 'Date'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
            'work_options' =>Yii::t('app','work_options'),

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['job_id' => 'id']);
    }

    public function getRegion()
    {
        return $this->hasOne(Region::className(),['id' => 'region_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id' => 'customer_user_id']);
    }

     public function getCategory()
    {
        return $this->hasOne(Category::className(),['id' => 'category_id']);
    }

    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->image as $file) {
                $file->saveAs('../../../uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}
