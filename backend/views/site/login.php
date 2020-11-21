<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>
<?php /* 
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
*/ ?>            
            <a class="btn btn-lg btn-success" href="<?= Url::to(['site/auth']) ?>">Login with Google</a>
            
            <div class="col s12 m6 offset-m3 center-align">
                <a class="oauth-container btn darken-4 white black-text" href="/users/google-oauth/" style="text-transform:none">
                    <div class="left">
                        <img width="20px" style="margin-top:7px; margin-right:8px" alt="Google sign-in" 
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                    </div>
                    Login with Google
                </a>
            </div>
            
            <!-- Compiled and minified CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
            
            <!-- Compiled and minified JavaScript -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>                   
</div>