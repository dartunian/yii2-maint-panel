<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

use yii\authclient\clients\Google;

use common\models\User;
use common\models\LoginForm;

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
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'auth'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'users', 'switch-status'],
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
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionUsers()
    {
        
        $query = User::find();
        
        $searchModel = new User();
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
            
        return $this->render('users', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionSwitchStatus()
    {
        if(Yii::$app->request->isAjax)
        {
            if (Yii::$app->request->post('id')) {

                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                
                $data = Yii::$app->request->post();
                $id = $data['id'];
                $status = $data['status'];
                $authorized = (int) filter_var($status, FILTER_VALIDATE_BOOLEAN);
                
                $find = User::find()
                    ->where(['id' => $id])
                    ->one();
                    
                if($find->status==10)
                {
                    $find->status = 9;
                    $find->save();                                        
                }
                elseif($find->status==9)
                {
                    $find->status = 10;
                    $find->save();                    
                }
                elseif($find->status==0)
                {
                    throw new NotSupportedException('User account has been deleted.');
                }
                
                

                return \yii\helpers\Json::encode(['output' => '', 'message' => 'success ' . $authorized . ' ' . $id]);
            }
        }
    }
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';
/*
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
*/
        return $this->render('login');
    }
    public function actionAuth()
    {
        $config = parse_ini_file('/var/secure/hello.ini', true);
        
        if (!isset($_GET['code']))
        {   
            $oauthClient = Yii::$app->authClientCollection->getClient('google');
            $url = $oauthClient->buildAuthUrl(); // Build authorization URL
            Yii::$app->getResponse()->redirect($url); // Redirect to authorization URL.
        }
        elseif (isset($_GET['code']))
        {
            $oauthClient = Yii::$app->authClientCollection->getClient('google');       
            // After user returns at our site:
            $code = $_GET['code'];
            $accessToken = $oauthClient->fetchAccessToken($code); // Get access token
            $userAttributes = $oauthClient->getUserAttributes();
            $userGoogleId = ArrayHelper::getValue($userAttributes, 'id');
            
            $findUser = User::find()
                ->where(['g_id' => $userGoogleId])
                ->one();
            
            if(isset($findUser))
            {
                // user exists, log in
                $findUser->updated_at = time();
                $findUser->last_ip = Yii::$app->getRequest()->getUserIP();                
                $findUser->g_name = ArrayHelper::getValue($userAttributes, 'name');
                $findUser->g_givenname = ArrayHelper::getValue($userAttributes, 'given_name');
                $findUser->g_familyname = ArrayHelper::getValue($userAttributes, 'family_name');
                $findUser->g_picture = ArrayHelper::getValue($userAttributes, 'picture');
                $findUser->g_locale = ArrayHelper::getValue($userAttributes, 'locale');                
                $findUser->save();
                
                Yii::$app->user->login($findUser);
                
                $this->redirect(['site/index']);
            }
            else
            {
                // user does not exist, create a new one                
                $registerUser = new User();                
                $registerUser->username = strstr(ArrayHelper::getValue($userAttributes, 'email'), '@', true);
                $registerUser->email = ArrayHelper::getValue($userAttributes, 'email');
                $registerUser->created_at = time();
                $registerUser->updated_at = time();
                //$registerUser->verification_token =
                $registerUser->last_ip = Yii::$app->getRequest()->getUserIP();
                $registerUser->g_id = ArrayHelper::getValue($userAttributes, 'id');
                $registerUser->g_name = ArrayHelper::getValue($userAttributes, 'name');
                $registerUser->g_givenname = ArrayHelper::getValue($userAttributes, 'given_name');
                $registerUser->g_familyname = ArrayHelper::getValue($userAttributes, 'family_name');
                $registerUser->g_picture = ArrayHelper::getValue($userAttributes, 'picture');
                $registerUser->g_locale = ArrayHelper::getValue($userAttributes, 'locale');
                $registerUser->save();
                
                Yii::$app->user->login($registerUser);
        
                $this->redirect(['site/index']);
            }
        }
        else
        {
            echo 'error';
        }
    }
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
