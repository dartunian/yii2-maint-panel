<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
?>
<div class="panel panel-default">
    <div class="panel-heading">New Maintenance Request</div>
    <div class="panel-body">
<?php
echo FormGrid::widget([
    //'model'=>$model,
    'formName' => 'requestForm',
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'contentBefore' => '<legend class="text-info"><small>New Maintenance Request</small></legend>',
            'attributes' => [       // 2 column layout
                'username' => ['label' => 'Name', 'type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter name...']],
                'type' => ['label' => 'Request type', 'type' => Form::INPUT_DROPDOWN_LIST, 'items' => [1 => 'test'], 'hint' => 'Select a request type...'],                
            ]
        ],
        [
            'attributes' => [
                'notes' => ['label' => 'Additional information', 'type' => Form::INPUT_TEXTAREA, 'options' => ['placeholder' => 'Enter additional information...']],
            ],
        ],
    ]
]);
?>
    </div>
</div>
<?php
ActiveForm::end();
?>