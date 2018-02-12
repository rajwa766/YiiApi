<?php

namespace common\models;
use yii\db\Query;
use Yii;

/**
 * This is the model class for table "cleaner".
 *
 * @property string $user_id
 *
 * @property User $user
 * @property CleanerCategory[] $cleanerCategories
 * @property CleanerRegion[] $cleanerRegions
 */
class Cleaner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cleaner';
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
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }
    public function extraFields()
    {
    
        return [
            'user',
            // 'rating',
            'cleaner_categories'=>function($model)
            {
                $cleaner_category=array();
                foreach( $model->cleanerCategories as $cc)
                    {

                        $cleaner_category[]=$cc->category;
                    };
    
                    return  $cleaner_category;
            },
                 'cleaner_regions'=>function($model)
            {
                $cleaner_region=array();
                foreach( $model->cleanerRegions as $cr)
                    {

                        $cleaner_regions[]=$cr->region;
                    };
                    return   $cleaner_regions;
            },
            // 'cleaner_rating'=>function($model)
            // {
            //     // $cleaner_rating=array();
            //     $cleanerRating = (new Query())
            //     ->select('SUM(rating) as rating')
            //     ->from('rating')
            //     ->where("cleaner_user_id = '$model->user_id'")
            //     ->one();
             
            //         return   $cleanerRating;
            // },
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getRating()
    {
        return 'sajid';
        
    }
     public static function getOptions(){

    $query=(new Query())->select(['user_id','user.email'])->from('cleaner')->innerJoin('user','user_id = user.id')->all();

       $value=(count($query)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($query,'user_id','email'); //id = your ID model, name = your caption
       return $value;
   
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCleanerCategories()
    {
        return $this->hasMany(CleanerCategory::className(), ['cleaner_user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCleanerRegions()
    {
        return $this->hasMany(CleanerRegion::className(), ['cleaner_user_id' => 'user_id']);
    }
    
}
