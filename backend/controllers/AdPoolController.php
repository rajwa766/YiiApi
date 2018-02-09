<?php

namespace backend\controllers;

use Yii;
use common\models\AdPool;
use common\models\AdPoolSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * AdPoolController implements the CRUD actions for AdPool model.
 */
class AdPoolController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
{
    return [
        'access' => [
            'class' => \yii\filters\AccessControl::className(),
            'only' => ['create', 'update','index','view','delete'],
           'rules' => [
            [
                'actions' => ['login'],
                'allow' => true,
            ],
            [
                'actions' => ['logout', 'index','create','view','delete','update'],
                'allow' => true,
                'roles' => ['@'],
                'matchCallback' => function ($rule, $action) {
                    return Yii::$app->user->identity->isAdmin;
                }
            ],
         ]
        ],
    ];
}

    /**
     * Lists all AdPool models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdPoolSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdPool model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
           /* $model = AdPool::find()
           ->select('cleaner_user_id, ad_place_id,subscription_id,status')
           ->where(['status' => '0'])
           ->all();],*/
            'model' => $this->findModel($id)
        ]);
    }

    /**
     * Creates a new AdPool model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdPool();

    
            if ($model->load(Yii::$app->request->post())) {
             
        
                $photo = UploadedFile::getInstance($model, 'image');

            if ($photo !== null) {
                $model->image= $photo->name;

                $ext = end((explode(".", $photo->name)));
                $model->image = Yii::$app->security->generateRandomString() . ".{$ext}";

                $path = Yii::getAlias('@common') .'/upload/'. $model->image;
         
                $photo->saveAs($path);

            }
              if ($model->save()) {
             
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
         else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdPool model.
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
     * Deletes an existing AdPool model.
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
     * Finds the AdPool model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdPool the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdPool::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
