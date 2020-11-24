<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
$requestArray = [
    1 => 'Repair',
    2 => 'Other'
];
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
                'type' => ['label' => 'Type', 'type' => Form::INPUT_DROPDOWN_LIST, 'items' => $requestArray, 'hint' => 'Select a request type...'],                
            ]
        ],
        [
            'attributes' => [
                'notes' => [
                    'label' => '<div style="padding: 10px;">Additional information</div>',
                    'type' => Form::INPUT_TEXTAREA,
                    'options' => [
                        'placeholder' => 'Enter additional information...',
                        'style' => 'resize: none;',
                        'rows' => '4',
                        'maxlength' => '255'
                    ]
                ],
            ],
        ],
        [
            'attributes' => [       // 3 column layout                        
                'submitAction' => [    // embed raw HTML content
                    'type' => Form::INPUT_RAW, 
                    'value' => '<div style="text-align: right; margin-top: 20px">' . 
                        Html::submitButton('Submit', ['class' => 'btn btn-primary', 'style' => 'width: 100%;']) . 
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