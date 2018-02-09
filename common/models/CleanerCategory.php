<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cleaner_category".
 *
 * @property integer $id
 * @property string $cleaner_user_id
 * @property integer $category_id
 *
 * @property Category $category
 * @property Cleaner $cleanerUser
 */
class CleanerCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cleaner_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cleaner_user_id', 'category_id'], 'required'],
            [['cleaner_user_id', 'category_id'], 'integer'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['cleaner_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cleaner::className(), 'targetAttribute' => ['cleaner_user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cleaner_user_id' => Yii::t('app', 'Cleaner User ID'),
            'category_id' => Yii::t('app', 'Category ID'),
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
    public function getCleanerUser()
    {
        return $this->hasOne(Cleaner::className(), ['user_id' => 'cleaner_user_id']);
    }
}
