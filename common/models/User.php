<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 20;
    const STATUS_BANNED = 30;
    const ROLE_USER = 10;
    const ROLE_ADMIN=30;
    const ROLE_CLEANER=20;
    const SCENARIO_SIGNUP = 'signup';
    const SCENARIO_LOGIN = 'login';

    public $password;
   
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED,self::STATUS_INACTIVE]],

           ['role', 'in', 'range' => [self::ROLE_USER,self::ROLE_CLEANER,self::ROLE_ADMIN]],
              [['username','email','first_name','last_name','address','password','contact_no','role'], 'safe'],
               [['email'], 'required','on'=>self::SCENARIO_SIGNUP],

                [['email'], 'unique'],
                [['email'], 'email'],
            
        ];
    }

    public function attributeLabels()
    {
    return [
           'id' => Yii::t('app', 'ID'),
           'username' => Yii::t('app', 'Full Name'),
           //'password' => Yii::t('app', 'Password'),
           'email' => Yii::t('app', 'Email'),
           'role' => Yii::t('app', 'Role'),
           'status' => Yii::t('app', 'Status'),      
       
       ];
   }

   public function afterSave($insert,$changedAttributes)
   {

        if($insert)
        {
            if($this->role==USER::ROLE_CLEANER)
            {
                $cleaner= new \common\models\Cleaner();
                $cleaner->user_id=$this->id;
                $cleaner->save();
            }
                if($this->role==USER::ROLE_USER)
            {
                $customer= new \common\models\Customer();
                $customer->user_id=$this->id;
                $customer->save();
            }
        }
   
      
   }
    public function fields()
    {
        return [

        'username',
        'email',
        'first_name',
        'last_name',
        'contact_no',
        'address',
        //'password'
        ];
    } 

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }


    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }
    public function getIsAdmin()
    {
        return $this->role == self::ROLE_ADMIN;
    }
  
    public function getIsUser()
    {
        return $this->role == self::ROLE_USER;
    }
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
    public static function findAdminByUsername($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE,'role'=>self::ROLE_ADMIN]);
    }
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

   
    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }
        public static function findByAccountActivationToken($token)
    {
        return static::findOne([
            'account_activation_token' => $token,
            'status' => User::STATUS_INACTIVE,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function beforeSave($insert)
    {

        
    if (parent::beforeSave($insert)) {

        if ($this->isNewRecord) {

           
            $this->auth_key=Yii::$app->getSecurity()->generateRandomString();
            if(isset($_POST['password']))
            {
                $this->password_hash=Yii::$app->security->generatePasswordHash($_POST['password']);
            }
             if(isset($_POST['User']['password']))
            {
                $this->password_hash=Yii::$app->security->generatePasswordHash($_POST['User']['password']);
                $this->status=10;
            }

        }
        else {
             $request = Yii::$app->request;
          $param = $request->getBodyParam('password');
          if(isset($param))
          {
            $this->password_hash=Yii::$app->security->generatePasswordHash($param);
          }
        } 
        return true;
    }
        
        
   
    return false;
}


    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
 


    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
         $this->password_hash = Yii::$app->security->generatePasswordHash($password);
      // $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generateAccountActivationToken()
    {
        $this->account_activation_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes account activation token.
     */
    public function removeAccountActivationToken()
    {
        $this->account_activation_token = null;
    }
    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}