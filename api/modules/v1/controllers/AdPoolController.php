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
use common\models\User;
use common\models;
use common\models\Advertisment;
use yii\db\Query;
use Yii;

class AdPoolController extends ActiveController
{
    public $modelClass = 'common\models\AdPool';  
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
           User::ROLE_ADMIN,
           User::ROLE_CLEANER,
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
    unset($actions['index']);
    unset($actions['view']);
    return $actions;
  }

  public function actionIndex()
  {  
      $activeData = new ActiveDataProvider([
            'query' => \common\models\AdPool::find(),
            'pagination'=>false,
            
        ]);
        return $activeData;
  }

  public function actionViewAllAds()
  {
     return (new Query())->select('ad_pool.id,ad_pool.cleaner_user_id,ad_pool.ad_place_id,ad_pool.image')
                     ->from('ad_pool')
                     ->where(['=','ad_pool.cleaner_user_id',Yii::$app->user->identity->id])
                     ->all();      
  }

 public function actionShowAds()
 {
  
                  
                    $array = (new Query())->select('pool_id')
                    ->from('advertisment')
                    ->where(['=','login_user_id',Yii::$app->user->identity->id])
                    ->all();
                    $seen_ads = ArrayHelper::getColumn($array, 'pool_id');
                       for($i=1;$i<=3;$i++)
                       {
                         $pool = $this->GetPoolAdvertisment($seen_ads,$i,true);

                          if($pool==false)
                          {
                              $this->DeleteSeenAds($i);
                              $pool = $this->GetPoolAdvertisment($seen_ads,$i,false);
                              
                          }
                          $result[]=$pool;
                       }

                      if($result != [false,false,false])
                     {
                        foreach ($result as $key => $value) {
                            $model = new Advertisment();
                            $model->pool_id = $value['id'];
                            $model->login_user_id = Yii::$app->user->identity->id;
                            $model->isNewRecord = true;
                            $model->id = NULL;
                            $model->save();
                          }
                         return $result;
                    }
              }
        private function GetPoolAdvertisment($seen_ads,$pool_id,$use_seen_ads=true)
        {
             $query= (new Query())->select('   ad_pool.id,ad_pool.cleaner_user_id,ad_pool.ad_place_id,ad_pool.image')
                     ->from('ad_pool')
                     ->leftJoin('advertisment a' , 'ad_pool.id = a.pool_id')
                     ->where(['=','ad_pool.ad_place_id',$pool_id]);
                     if($use_seen_ads==true)
                     {
                        $query->andWhere(['not in','ad_pool.id',$seen_ads]);
                     }
                     $query->orderBy(new Expression('rand()'));
                     return $query->one();      
            }
        private function DeleteSeenAds($pool_id)
        {
           $array = (new Query())->select('id')
                    ->from('ad_pool')
                    ->where(['=','ad_place_id',$pool_id])
                    ->all();
                    $pool_ads = ArrayHelper::getColumn($array, 'id');
    
          Advertisment::deleteAll(['and', 'login_user_id = :user_id', ['in', 'pool_id', $pool_ads]], [
                   ':user_id'=>\Yii::$app->user->identity->id
                ]);
               
        }

         public function actionUpdateAds()
           {

            $id = Yii::$app->request->get('id');

                Yii::$app->db->createCommand('UPDATE ad_pool SET status = 2 WHERE id= '.$id)
             ->execute();
           }

 }
 