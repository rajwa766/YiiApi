<?php
namespace api\modules\v1\controllers;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior ;
use yii\db\Expression;
use common\components\AccessRule;
use yii\data\ActiveDataProvider;
use common\models\User;
use common\models;
use common\models\UploadForm;
use yii\web\UploadedFile;
use yii\filters\auth\QueryParamAuth;

use Yii;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class UploadController extends ActiveController
{

    public $documentPath;
    public $modelClass = '';
   public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),[
          [
            'class' => \yii\filters\Cors::className(),
        ],
           [
           'class' => CompositeAuth::className(),
           'except' => ['options'],
           'authMethods' => [
             HttpBearerAuth::className(),
             QueryParamAuth::className(),

           
           ],
        ],
       
           [
           'class' => TimestampBehavior::className(),

           ],
             [
              'class' => 'yii\filters\ContentNegotiator',
              'only' => ['upload'],  // in a controller
              // if in a module, use the following IDs for user actions
              // 'only' => ['user/view', 'user/index']
              'formats' => [
                  'application/json' => Response::FORMAT_JSON,
              ],
           
          ],
           [
           'class' => AccessControl::className(),
    // We will override the default rule config with the new AccessRule class
           'ruleConfig' => [
           'class' => AccessRule::className(),
           ],
           'only' => ['upload','multi-upload'],
           'rules' => [[
           'actions' => ['upload'],
           'allow' => true,
            // Allow users, moderators and admins to create
           'roles' => [
         
           User::ROLE_ADMIN,
           User::ROLE_CLEANER,
           User::ROLE_USER,
           ],
        ],
        [
           'actions' => ['multi-upload'],
           'allow' => true,
            // Allow users, moderators and admins to create
           'roles' => [
         
           User::ROLE_ADMIN,
           User::ROLE_CLEANER,
           User::ROLE_USER,
           ],
        ],
    
      
         ],
         ],


           ]



           );

    }   
      public function actionUpload()
    {
        $model = new UploadForm();
      //return Yii::$app->getRequest()->getBodyParams();
       // return    $model->load(Yii::$app->getRequest()->getBodyParams(), '');
   
        if (Yii::$app->request->isPost) {

          if (UploadedFile::getInstanceByName('data'))
          {

              $model->image = UploadedFile::getInstanceByName('data');
              $path=\Yii::getAlias('@common').'/upload/' ;
              
        }
   
        else
        {

          return false;
        }

           if ($model->validate()) 
           {
              $basename = \Yii::$app->security->generateRandomString();
              $model->image->saveAs($path. $basename . '.' . $model->image->extension);
              return $basename.".".$model->image->extension;
          }   
          else
            {
              return $model->firstErrors;
            }
              
        }
    }

    public function actionMultiUpload()
    {
        $model = new UploadForm();
        //return Yii::$app->getRequest()->getBodyParams();
       // return    $model->load(Yii::$app->getRequest()->getBodyParams(), '');
          // $file[]= UploadedFile::getInstancesByName('Photos[image]');
          // return $file;
  
       
                  
        //  $file[]= UploadedFile::getInstancesByName('Photos[image]');
    
           if (!empty(UploadedFile::getInstancesByName('Photos[image]')))
            {

               $model->image= UploadedFile::getInstancesByName('Photos[image]');
             
                 }
          $i=0;

          $path=\Yii::getAlias('@common').'/upload/';
         
            $basename=array();
              foreach ($model->image as $file) {
               // $basename[] = $file->name;
                $basename[] = \Yii::$app->security->generateRandomString().".".$file->extension;
               $file->saveAs($path.'/'. $basename[$i]. '.' . $file->extension);
                
               $i++;
             }
          return $basename.".".$model->image->extension;
          $prefixed_array = preg_filter('/^/', $path, $basename);
          return $prefixed_array;
         // return sizeof( $prefixed_array);
         $model=new \common\models\Software;

         foreach($prefixed_array as $array)
          {
            

         $model->load(Yii::$app->getRequest()->getBodyParams(), '');
           $model->id = NULL;
          $model->isNewRecord = true;
              
         $model->downloadlink=$array;
          if(!$model->save())
          {
             return $model->firstErrors;
          }
          else{

             
             continue;
          
         }
        }
        return "Software added successfully";
          
       
           
              
       
    }

  
}