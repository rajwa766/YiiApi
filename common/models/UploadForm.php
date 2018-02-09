<?php 
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $image;

    public function rules()
    {
        return [
             [['image'], 'safe'],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
             $basename = \Yii::$app->security->generateRandomString();
            $this->image->saveAs(\Yii::getAlias('@common').'/upload/' . $basename . '.' . $this->image->extension);
            $hello=$basename.$this->image->extension;
            return $hello;
        } else {
            return $this->errors;
        }
    }
}
?>