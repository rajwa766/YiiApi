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
use common\models\Mall;
use ruskid\stripe\StripeCheckout;
use Yii;

class JobController extends ActiveController
{
    public $modelClass = 'common\models\Job';  
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
           'only' => ['create','update', 'delete'],
           'rules' => [[
           'actions' => ['create'],
           'allow' => true,
            // Allow users, moderators and admins to create
           'roles' => [
           User::ROLE_ADMIN,
           User::ROLE_USER,
            User::ROLE_CLEANER,
           ],
        ],

        [
           'actions' => ['update'],
           'allow' => true,
            // Allow users, moderators and admins to create
           'roles' => [
           User::ROLE_ADMIN,
           User::ROLE_USER,
            User::ROLE_CLEANER,
           ],
        ],
       
           [
           'actions' => ['delete'],
           'allow' => true,
            // Allow admins to delete
           'roles' => [
           User::ROLE_ADMIN,
           User::ROLE_USER
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

  public function actionCustomerJobs()
  {  
      $activeData = new ActiveDataProvider([
            'query' => \common\models\Job::find()->where(['customer_user_id'=>Yii::$app->user->identity->id]),
            
        ]);
        return $activeData;
  }
  public function actions() 
  { 
    $actions = parent::actions();
    $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
    unset($actions['create']);
    unset($actions['update']);
    return $actions;
  }
public function  actionPayment(){
    \Stripe\Stripe::setApiKey(Yii::$app->stripe->privateKey);
    //      // $request = Yii::$app->request;
         $token = \Stripe\Token::create(array(
          "card" => array(
            "number" => "4242424242424242",
            "exp_month" => 8,
            "exp_year" => 2018,
            "cvc" => "314"
          )
        ));
        //  $token = $request->post('stripeToken');
          //$token  = $_POST['stripeToken'];
          $customer = \Stripe\Customer::create(array(
              'email' => 'customer@example.com',
              'source'  => $token
          ));
    
          $charge = \Stripe\Charge::create(array(
              'customer' => $customer->id,
              'amount'   => 2000,
              'currency' => 'usd'
          ));
    var_dump($charge);
    exit();
}
  public function prepareDataProvider() 
  {
    
    $searchModel = new \common\models\JobSearch();    
    return $searchModel->search(\Yii::$app->request->queryParams);
  }
  public function actionCleanerJobs()
  {  
   
    $cleaner_regions=\common\models\CleanerRegion::find()->where(['cleaner_user_id'=>Yii::$app->user->identity->id])->all();

   $regions=array();
   foreach($cleaner_regions as $cr)
   {
      $regions[]=$cr->region_id;
   }
      $activeData = new ActiveDataProvider([
     'query' => \common\models\Job::find()->where(['region_id'=>$regions]),
            
        ]);
        return $activeData;
   }
  public function actionCleanerPreferredJobs()
  {  
    $cleaner_regions=\common\models\CleanerRegion::find()->where(['cleaner_user_id'=>Yii::$app->user->identity->id])->all();
     $cleaner_category=\common\models\CleanerCategory::find()->where(['cleaner_user_id'=>Yii::$app->user->identity->id])->all();
    
   $regions=array();
   foreach($cleaner_regions as $cr)
   {
      $regions[]=$cr->region_id;
   }
      $category=array();
   foreach($cleaner_category as $cr)
   {
      $category[]=$cr->category_id;
   }
      $activeData = new ActiveDataProvider([
            'query' => \common\models\Job::find()->where(['region_id'=>$regions,'category_id'=>$category]),
            
        ]);
        return $activeData;
   }

   public function actionCreate()
   {
       $request=Yii::$app->request;
        $post=$request->post();
        /* return $post;*/
                   
       // return $post;

          $request=Yii::$app->request;
          $post=$request->post();
          $job= new \common\models\Job();

           if(isset($post['image']))
          {
          $value=$post['image'];
         
          if (is_array($value))
          {
            $img = implode(",", $value);
          }
          }
          
         

          if(isset($post))
          {
               
               $job->setIsNewRecord(true);
               $job->customer_user_id=Yii::$app->user->identity->id;
               $job->region_id= $post['region_id'];

               $job->category_id= $post['category_id'];
               $job->title= $post['title'];
               $job->price= $post['price'];
               $job->status= $post['status'];
               $job->contact_no= $post['contact_no'];
               $job->description= $post['description'];
               $job->image= $img;
               $job->address= $post['address'];
               
               $job->date= $post['date'];
               $job->longitude= $post['longitude'];
               $job->latitude= $post['latitude'];
               $job->work_options= $post['work_options'];

               if(!$job->save())
               {
                  Yii::$app->response->statusCode = 422;
                  return $job->errors;
               }
           
          }
 
         return Yii::t('app','job added successfully');

          }

          public function actionUpdate($id)
          {
            
            $job = \common\models\Job::findOne($id);
            $job->load(Yii::$app->getRequest()->getBodyParams(), '');

            $request=Yii::$app->request;
            $post=$request->post();
           
          // return $post['image'];

          if($post['image'][0]=="0")
          {
           /* foreach ($job->image as $imag) {
            unlink(Yii::getAlias('@common'.'/upload/'. $imag));}*/
           
          
            $job->image=null;
            //return $post['image'][0];
          }
        else {
         // return "hello";
         /* foreach ($job->image as $imag) {
            unlink(Yii::getAlias('@common'.'/upload/'. $imag));
          }*/
           
          $value=$post['image'];
          
            $img = implode(",", $value);
            
            $job->image=$img;
          
          }
               if(!$job->save())
               {
                  Yii::$app->response->statusCode = 422;
                  return $job->errors;

          }
           
        

          
         return Yii::t('app','job updated');


          }
 

  }

    

 

