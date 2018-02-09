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
use yii\filters\auth\QueryParamAuth;
use common\models\Rating;
use common\models;
use common\models\User;
use yii\db\Query;
use Yii;

class RatingController extends ActiveController
{
    public $modelClass = 'common\models\Rating';  
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
              'only' => ['view', 'index','notification'],  // in a controller
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
           'only' => ['create', 'delete','notification'],
           'rules' => [[
           'actions' => ['create'],
           'allow' => true, 
            // Allow users, moderators and admins to create
           'roles' => [
           User::ROLE_ADMIN,
           user::ROLE_USER,
           user::ROLE_CLEANER,
           ],
        ],

        [
           'actions' => ['notification'],
           'allow' => true,
            // Allow users, moderators and admins to create
           'roles' => [
           User::ROLE_CLEANER,
           user::ROLE_USER,
           User::ROLE_ADMIN,
           ],
        ],
       
           [
           'actions' => ['delete'],
           'allow' => true,
            // Allow admins to delete
           'roles' => [
           User::ROLE_ADMIN,

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
    unset($actions['index']);
    return $actions;
  }

  public function actionIndex()
  {  
      $activeData = new ActiveDataProvider([
            'query' => \common\models\Rating::find(),
            'pagination'=>false,
            
        ]);
        return $activeData;
  }
  public function actionNotification()
  {
  	    
       if(Yii::$app->user->identity->role == User::ROLE_CLEANER) 
      	{
                $model=(new Query())->select('r.job_id,COUNT(r.job_id) AS coun,r.customer_user_id,r.cleaner_user_id,MAX(u.first_name) as first_name,MAX(u.last_name) as last_name')
                ->from('rating r')
                ->innerJoin('cleaner c' , 'r.cleaner_user_id = c.user_id')
                ->innerJoin('user u' , 'c.user_id = u.id')
                ->groupBy(['r.job_id','r.customer_user_id','r.cleaner_user_id'])
                ->having(['<','coun',2])
                ->andWhere(['=','r.cleaner_user_id',Yii::$app->user->identity->id])
                ->all();
              
          return $model;
         }
       else
       {
         return  "no rating found for this person";
       }
  }



}