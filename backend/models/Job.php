<?php

namespace backend\models;
use common\models\Category;
use common\models\Customer;
use common\models\Region;
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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job';
    }
  public function formName()
    {
        return '';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'region_id', 'category_id','date','title','price','contact_no'], 'required'],
            [['customer_user_id', 'region_id', 'category_id', 'status'], 'integer'],
                [['description','address'], 'string', 'max' => 1000],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['customer_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_user_id' => 'user_id']],
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
            'customer_user_id' => Yii::t('app', 'Customer User ID'),
            'region_id' => Yii::t('app', 'Region ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'status' => Yii::t('app', 'Status'),
        ];
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
