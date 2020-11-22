<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin();
echo Form::widget([
    //'model' => $model,
    'form' => $form,
    'columns' => 2,
    'attributes' => [
        'username' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
        'password' => ['type'=>Form::INPUT_PASSWORD, 'options'=>['placeholder'=>'Enter password...']],
        'rememberMe' => ['type'=>Form::INPUT_CHECKBOX],
    ]
]);
ActiveForm::end();
?>