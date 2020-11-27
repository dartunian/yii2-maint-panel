<?php

/* @var $this yii\web\View */
use kartik\grid\GridView;

$panelTemplate = ("
<div class='panel-{type}'>
	{panelBefore}
    {panelHeading}
    {items}
    <div class='text-center'>{panelFooter}</div>
</div>
");

$this->title = 'Maintenance Panel';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Davis Maintenance Panel</h1>
    </div>
</div>
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
        'bordered' => true,
        'striped' => false,
        'hover' => true,
        'condensed' => true,
        //'floatHeader'=>true,
        //'floatHeaderOptions'=>['top'=>'50'],
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '<span class="glyphicon glyphicon-wrench"></span> Maintenance Requests',
            'before' => false,
            'after' => false,
        ],
        'panelTemplate' => $panelTemplate,			
        'tableOptions' => ['style' => 'margin:0px;'],
        'columns' => [
        /*[
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
        ],*/                    
        [
            'label' => 'Name',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'attribute' => 'name',
            'mergeHeader' => true,
        ],			
        [
            'label' => 'Type',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'attribute' => 'type',
            'mergeHeader' => true,
        ],
        [
            'label' => 'Notes',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'attribute' => 'notes',
            'mergeHeader' => true,
        ],
        [
            'label' => 'Status',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'attribute' => 'status',
            'mergeHeader' => true,
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