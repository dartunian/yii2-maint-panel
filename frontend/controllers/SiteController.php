<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

use common\models\MaintenanceRequest;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $query = MaintenanceRequest::find();
        
        $searchModel = new MaintenanceRequest();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if(Yii::$app->request->isAjax)
        {
            $dataProvider = $searchModel->search(Yii::$app->request->get());
        }
            
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays new request page.
     *
     * @return mixed
     */
    public function actionNewRequest()
    {
        $model = new MaintenanceRequest();
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $model->created_at = time();
            
            if($model->save())
            {
                Yii::$app->session->setFlash('success', 'Your request was submitted.');
            }
            else
            {
                Yii::$app->session->setFlash('error', 'An error has occurred.');
            }
            
            $this->redirect(['site/index']);
        }
        else
        {
            return $this->render('newrequest', [
                'model' => $model,
            ]);
        }
    }
}
