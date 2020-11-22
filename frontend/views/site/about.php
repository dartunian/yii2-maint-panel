<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);
echo FormGrid::widget([
    //'model'=>$model,
    'formName' => 'requestForm',
    'form'=>$form,
    'autoGenerateColumns'=>true,
    'rows'=>[
        [
            'contentBefore'=>'<legend class="text-info"><small>Account Info</small></legend>',
            'attributes'=>[       // 2 column layout
                'username'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
                'password'=>['type'=>Form::INPUT_PASSWORD, 'options'=>['placeholder'=>'Enter password...']],
            ]
        ],
        [
            'attributes'=>[       // 1 column layout
                'notes'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter notes...']],
            ],
        ],
        [
            'contentBefore'=>'<legend class="text-info"><small>Profile Info</small></legend>',
            'columns'=>3,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes'=>[       // colspan example with nested attributes
                'address_detail' => [ 
                    'label'=>'Address',
                    'columns'=>6,
                    'attributes'=>[
                        'address'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter address...'],
                            'columnOptions'=>['colspan'=>3],
                        ],
                        'zip_code'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Zip...'],
                            'columnOptions'=>['colspan'=>2],
                        ],
                        'phone'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Phone...']
                        ],
                    ]
                ]
            ],
        ],
        [
            'attributes'=>[       // 3 column layout
                'rememberMe'=>[   // radio list
                    'type'=>Form::INPUT_RADIO_LIST, 
                    'items'=>[true=>'Yes', false=>'No'], 
                    'options'=>['inline'=>true]
                ],
                'actions'=>[    // embed raw HTML content
                    'type'=>Form::INPUT_RAW, 
                    'value'=>  '<div style="text-align: right; margin-top: 20px">' . 
                        Html::resetButton('Reset', ['class'=>'btn btn-default']) . ' ' .
                        Html::submitButton('Submit', ['class'=>'btn btn-primary']) . 
                        '</div>'
                ],
            ],
        ],
    ]
    ]
]);
ActiveForm::end();
?>