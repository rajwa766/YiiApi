<?php

namespace backend\controllers;

use Yii;
use common\models\Rating;
use common\models\RatingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\swiftmailer\Mailer;
/**
 * RatingController implements the CRUD actions for Rating model.
 */
class RatingController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Rating models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RatingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rating model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

  public function actionNotification()
  {

  		
           $model=(new Query())->select('job_id,COUNT(job_id) AS coun,customer_user_id,cleaner_user_id')
                ->from('rating')
                ->groupBy(['job_id','customer_user_id','cleaner_user_id'])
                ->having(['<','coun',2])
                ->andWhere(['=','cleaner_user_id',Yii::$app->user->identity->id])
                ->all();
              
                 return $this->render('//rating/notificaton',
               ['model'=>$model
       
        ]);

  }

    /**
     * Creates a new Rating model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rating();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->EmailNotification();
            return $this->redirect(['view', 'id' => $model->id]);
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Rating model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Rating model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rating model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rating the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rating::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

     public function EmailNotification()
  {

   /* $query = (new Query())->select('rating.job_id','rating.customer_user_id','rating.cleaner_user_id',
                        'user.username','user.email')
                     ->from('rating')
                      ->innerJoin(  'user','user.id =rating.cleaner_user_id')
                     ->one();
                    $myemail = $query['email'];
                   var_dump($myemail);
                   exit();*/
                  // $user = $query['username'];

                   $query = new Query;

                    $query  ->select(['rating.job_id','rating.customer_user_id','rating.cleaner_user_id',
                        'user.username','user.email']) 
                            ->from('rating')
                            ->innerJoin(  'user','user.id =rating.cleaner_user_id')
                        ->one();
                              $command = $query->createCommand();
                              $data = $command->queryAll(); 

                              foreach($data as $data){
                                $myemail = $data['email'];
                              }
                           
                            
                /* $model1 = Rating::find()
                        ->joinWith('user', true, 'INNER JOIN')
                        ->andWhere('=','user.id','rating.cleaner_user_id')
                        ->orderBy('cleaner_user_id');

                       // $myemail = $model1['user.email'];
                        var_dump($model1);
                        exit();*/


                   if($myemail)
                   {
                    Yii::$app->mailer->compose()
                    ->setFrom('cleanersite4@gmail.com')
                    ->setTo($myemail)
                    ->setSubject('someone rated you!')
                    ->send();
                   }

               else
               {

                return "no such email";
               }
               
    
  }
}
