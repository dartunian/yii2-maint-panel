<?php

/* @var $this yii\web\View */
use kartik\grid\GridView;
use yii\helpers\StringHelper;
use yii\helpers\Html;

$panelTemplate = ("
<div class='panel-{type}'>
	{panelBefore}
    {panelHeading}
    {items}
    <div class='text-center'>{panelFooter}</div>
</div>
");

$this->title = 'Maintenance Panel';
?>

<?php
    echo GridView::widget([
        'id' => 'requests_grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'pjaxSettings' => [
            //'neverTimeout'=>true,
            //'beforeGrid'=>'My fancy content before.',
            //'afterGrid' => $this->registerJs($script, \yii\web\View::POS_READY),
            /*'clientOptions' => [
                    'showNoty' => false
            ],*/
        ],
        'bordered' => false,
        'striped' => false,
        'hover' => true,
        'condensed' => true,
        'responsive' => true,
        'responsiveWrap' => true,
        //'floatHeader'=>true,
        //'floatHeaderOptions'=>['top'=>'50'],
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '<span class="glyphicon glyphicon-wrench"></span>',
            'before' => false,
            'after' => false,
        ],
        'panelTemplate' => $panelTemplate,			
        'tableOptions' => ['style' => 'margin:0px;'],
        'rowOptions' => function($data){
                if($data->status == 0)
                {
                    return ['class' => GridView::TYPE_INFO];
                }
                elseif($data->status == 1)
                {
                    return ['class' => GridView::TYPE_WARNING];
                }
                elseif($data->status == 2)
                {
                    return ['class' => GridView::TYPE_SUCCESS];
                }
        },
        'columns' => [
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'width' => '50px',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
             },
            'detail' => function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_libexpand', ['model' => $model]);
             },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'expandOneOnly' => true,
            'expandIcon' => '',
            'collapseIcon' => '',
            'contentOptions' => [
                'style'=>'max-width:150px; overflow: auto; white-space: normal; word-wrap: break-word;'
            ],            
        ],
        [
            'label' => '#',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'attribute' => 'id',
            'mergeHeader' => true,
            'format' => 'html',
            'value' => function($data){
                if($data->status == 0)
                {
                    return "<span class='label label-info'>".$data->id."</span>";
                }
                elseif($data->status == 1)
                {
                    return "<span class='label label-warning'>".$data->id."</span>";
                }
                elseif($data->status == 2)
                {
                    return "<span class='label label-success'>".$data->id."</span>";
                }                
            },
        ],        
        [
            'label' => 'Name',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'mergeHeader' => true,
            'value' => function($data){return StringHelper::truncate($data->name, 25);},            
        ],			
        [
            'label' => 'Type',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'mergeHeader' => true,
            'value' => function($data)
            {
                if($data->type == 1)
                {
                    return 'Repair';
                }
                elseif($data->type == 2)
                {
                    return 'Request';
                }
                elseif($data->type == 3)
                {
                    return 'Other';
                }                     
            },              
        ],
        [
            'label' => 'Summary',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'mergeHeader' => true,
            'value' => function($data){return StringHelper::truncate($data->summary, 25);},
        ],
        [
            'label' => 'Status',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'mergeHeader' => true,
            'value' => function($data)
            {
                if($data->status == 0)
                {
                    return 'Created';
                }
                elseif($data->status == 1)
                {
                    return 'In Progress';
                }
                elseif($data->status == 2)
                {
                    return 'Complete';
                }                  
            },            
        ],	                
        [
            'label' => 'Created',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'mergeHeader' => true,
            'value' => function($data){return Yii::$app->formatter->asDate($data->created_at, 'php:j F Y h:i A');},				
        ],				
    ]
]);  
?>