<?php

namespace api\modules\v1\controllers;
//namespace \common\models;
use Yii;
use common\models\User;
use common\models\SignupForm;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior ;
use yii\db\Expression;
use common\components\AccessRule;
use yii\filters\auth\QueryParamAuth;
use yii\filters\AccessControl;
use yii\models;
use yii\db\Query;


class UserController extends ActiveController
{
  public $modelClass = 'common\models\User';


  public function behaviors()
  {
 
    return ArrayHelper::merge(parent::behaviors(),[
     [
   
     'class' => CompositeAuth::className(),
       'except' => ['signup', 'login','options','activate-account'],
     'authMethods' => [
     HttpBearerAuth::className(),
       QueryParamAuth::className(),
     ],
     ],
        'corsFilter' => [
            'class' => \yii\filters\Cors::className(),
        ],
     'timestamp' => [
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
     'access' => [
     'class' => AccessControl::className(),
    // We will override the default rule config with the new AccessRule class
     'ruleConfig' => [
     'class' => AccessRule::className(),
     ],
     'only' => ['create', 'index', 'delete','update','getCleaner'],
     'rules' => [[
     'actions' => ['create'],
     'allow' => true,
            // Allow users, moderators and admins to create
     'roles' => [
     User::ROLE_USER,
     User::ROLE_ADMIN,
     ],
     ],
     [
     'actions' => ['index'],
     'allow' => true,
            // Allow moderators and admins to update
     'roles' => [

     User::ROLE_ADMIN,
     User::ROLE_CLEANER,
     USER::ROLE_USER,
     ],
     ],
          [
     'actions' => ['update'],
     'allow' => true,
      'matchCallback' => function ($rule, $action) {
                        if ( Yii::$app->user->identity->id ==  Yii::$app->getRequest()->getQueryParam('id')) {
                            return true;   // let them in
                        }
                        return false;   // get lost
                    },
     'roles' => [
     User::ROLE_USER,
    User::ROLE_CLEANER,
     User::ROLE_ADMIN,


     ],
     ],
     [
     'actions' => ['delete','deactivate-account'],
     'allow' => true,
            // Allow admins to delete
     'roles' => [
     User::ROLE_ADMIN
     ],
     ],
  
    [
     'actions' => ['getCleaner'],
     'allow' => true,
            // Allow users, moderators and admins to create
     'roles' => [
     User::ROLE_USER,
     User::ROLE_ADMIN,
     ],
     ],
 
     ],
     ],
     'contentNegotiator' => [
     'formats' => [
     'application/json' => Response::FORMAT_JSON,
     ],
     ],


     ] );

  }
  public function actionLogin() {
    $model = new \common\models\LoginForm();
    $model->load(Yii::$app->getRequest()->getBodyParams(), '');
    if ($model->login()) {  
      $data=[

        'access_token'=>\Yii::$app->user->identity->getAuthKey(),
        'role'=>\Yii::$app->user->identity->role,
        'id'=>\Yii::$app->user->identity->id,
        'payment'=>\Yii::$app->user->identity->is_paid,
      ];
       
    return $data;

    }
      
        if ($model->status === User::STATUS_INACTIVE) {
          Yii::$app->response->statusCode = 422;
       
       $data= [ 'message'=> Yii::t('app', 'You have to activate your account first. Please check your email.')];
            return $data;
     
        }
          if ($model->status === User::STATUS_DELETED) {
            Yii::$app->response->statusCode = 422;
          return  $data= [ 'message'=>  Yii::t('app', 'Your account is deactivated')];
        }

        if ($model->status === User::STATUS_BANNED) {
            Yii::$app->response->statusCode = 422;
          return  $data= [ 'message'=>  Yii::t('app', 'Your account is banned')];
        }
     
         else {
        Yii::$app->response->statusCode = 422;
      return  $model->firstErrors;
      
     
    }

  
  }
    private function signupWithActivation($user)
    {
        // sending email has failed
      $model= new \common\models\SignupForm();
        if (!$model->sendAccountActivationEmail($user)) {
            // display error message to user
           return Yii::t('app', 
                'We couldn\'t send you account activation email, please contact us.');

            // log this error, so we can debug possible problem easier.
            return Yii::t('app', 
                'could not sign up. 
                 Possible causes: verification email could not be sent.');
           }

        // everything is OK
        return Yii::t('app', 'To be able to log in, you need to confirm your registration. 
                Please check your email, we have sent you a message.');
    }
   public function actionActivateAccount($token)
    {
        try {

            $user = new \common\models\AccountActivation($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if (!$user->activateAccount()) {
       return Yii::t('app','Due to some problem your we are unable to activate your account. Kindly contact system admin for further details');
        }
        else {
          return Yii::t('app','Your account is activated');
        }

     
           
    
  }

  public function actionSignup()
  {
    $user = new User();
     $user->scenario = User::SCENARIO_SIGNUP;
    $user->load(Yii::$app->getRequest()->getBodyParams(), '');
 
    $user->status=User::STATUS_ACTIVE;
  
    $user->generateAccountActivationToken();
    if($user->save())
    {
      $this->signupWithActivation($user);
      return $data=[ 'message'=>Yii::t('app', 'Check your email to activate your account')];
    }
    else
    {

      Yii::$app->response->statusCode = 422;
      return $user->firstErrors;
    }

  }

   public function actionGetCleaner()
   {
   $model = (new Query())->select('id,username')
 ->from('user')
->where(['=','role',20])
->all();
return $model;
   }


}




