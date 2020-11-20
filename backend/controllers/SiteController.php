<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

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
                        'actions' => ['logout', 'index'],
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
                echo "user exists";
            }
            else
            {
                echo "user does not exist";
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
