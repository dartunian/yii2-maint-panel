<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

$this->title = 'New Maintenance Request';
$this->params['breadcrumbs'][] = $this->title;
$requestArray = [
    1 => 'Repair',
    2 => 'Other'
];
?>
<div class="well">
    <?php
        $form = ActiveForm::begin([
            'id' => 'login-form-vertical', 
            'type' => ActiveForm::TYPE_VERTICAL
        ]); 
    ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'rememberMe')->checkbox(['id' => 'remember-me-ver']) ?>
        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>