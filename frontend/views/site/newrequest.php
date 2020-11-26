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
$form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
?>
<div class="well">
<?php
echo FormGrid::widget([
    //'model' => $model,
    'formConfig' => ['showErrors' => true],
    'formName' => 'requestForm',
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'contentBefore' => '<legend class="text-info"><small>Maintenance Request Form</small></legend>',
            'attributes' => [       // 2 column layout
                'name' => ['label' => '<div style="margin-top: 5px;">Name</div>', 'type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter name...', 'autocomplete' => 'off']],
                'type' => ['label' => '<div style="margin-top: 5px;">Type</div>', 'type' => Form::INPUT_DROPDOWN_LIST, 'items' => $requestArray, 'hint' => 'Select a request type...', 'options' => ['autocomplete' => 'off']],                
            ]
        ],
        [
            'attributes' => [
                'notes' => [
                    'label' => '<div style="margin-top: 5px;">Additional information</div>',
                    'type' => Form::INPUT_TEXTAREA,
                    'options' => [
                        'placeholder' => 'Enter additional information...',
                        'style' => 'resize: none;',
                        'rows' => '4',
                        'maxlength' => '255',
                        'autocomplete' => 'off',
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