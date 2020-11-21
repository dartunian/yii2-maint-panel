<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use common\models\User;

$this->title = 'Users';
?>
<div>
	<div class="panel panel-default">
        <div class="panel-heading">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">
			<?php
			$getUsers = User::find()->all();
			
			foreach($getUsers as $user)
				echo $user->username;
			endforeach;
			?>
        </div>
    </div>
</div>
