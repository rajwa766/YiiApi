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
use yii\filters\auth\QueryParamAuth;
use Yii;

class CleanerController extends ActiveController
{
    public $modelClass = 'common\models\Cleaner';  
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
              'only' => ['view', 'index'],  // in a controller
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
           'only' => ['create', 'delete'],
           'rules' => [[
           'actions' => ['create'],
           'allow' => true,
            // Allow users, moderators and admins to create
           'roles' => [
           User::ROLE_ADMIN
           ],
        ],
       
           [
           'actions' => ['delete'],
           'allow' => true,
            // Allow admins to delete
           'roles' => [
           User::ROLE_ADMIN
           ],
        ],
      ],
    ],
  ]);

  } 
  public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    public function actions() 
  { 
    $actions = parent::actions();
    $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
  
    return $actions;
  }

  public function prepareDataProvider() 
  {
    $searchModel = new \common\models\CleanerSearch();  
    
    return $searchModel->search(\Yii::$app->request->queryParams);
  }

  public function actionViewProfile()
  {
       $cleaner_regions=\common\models\Cleaner::find()->where(['user_id'=>Yii::$app->user->identity->id]);

  
      $activeData = new ActiveDataProvider([
            'query' =>  $cleaner_regions,
            
        ]);
        return $activeData;
   }

  

}