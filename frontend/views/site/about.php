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
<div class="well">
<?php
echo FormGrid::widget([
    //'model' => $model,
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
                'notes' => [
                    'label' => 'Additional information',
                    'type' => Form::INPUT_TEXTAREA,
                    'options' => [
                        'placeholder' => 'Enter additional information...',
                        'style' => 'resize: none;',
                        'rows' => '5',
                        'maxlength' => '255'
                    ]
                ],
            ],
        ],
        [
            'attributes' => [       // 3 column layout
                'resetAction' => [    // embed raw HTML content
                    'type' => Form::INPUT_RAW, 
                    'value' => '<div style="text-align: left; margin-top: 20px">' . 
                        Html::resetButton('Reset', ['class' => 'btn btn-default']) . ' ' .
                        '</div>'
                ],                             
                'submitAction' => [    // embed raw HTML content
                    'type' => Form::INPUT_RAW, 
                    'value' => '<div style="text-align: right; margin-top: 20px">' . 
                        Html::submitButton('Submit', ['class' => 'btn btn-primary', 'style' => 'width: 50%;']) . 
                        '</div>'
                ],
            ],
        ],        
    ]
]);
?>
</div>
<?php
ActiveForm::end();
?>