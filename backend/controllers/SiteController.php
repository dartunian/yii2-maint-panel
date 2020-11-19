<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\authclient\clients\Google;

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
            //echo $url;
            //var_dump(Yii::$app->authClientCollection->getClient('google'));

        }
        elseif (isset($_GET['code']))
        {
            $oauthClient = Yii::$app->authClientCollection->getClient('google');        
            // After user returns at our site:
            $code = $_GET['code'];
            $accessToken = $oauthClient->fetchAccessToken($code); // Get access token
            //echo 'code: '.$code.' token: ';
            //var_dump($accessToken);
            echo $oauthClient->getUserAttributes();
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
