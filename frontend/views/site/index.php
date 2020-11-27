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
?>

<div class="panel panel-default">
    <div class="panel-heading"></div>
        <div class="panel-body">
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
                    'format'=>'raw',
                    'hAlign' => 'center',
                    'vAlign' => 'middle',				
                    'mergeHeader' => true,
                    'value' => function($data){
                        return ("<img src='" . $data->g_picture . "' style='max-width:30px;' class='img-thumbnail'>");
                    }
                ],
                [
                    'label' => 'Username',
                    'hAlign' => 'center',
                    'vAlign' => 'middle',
                    'attribute' => 'username',
                    'mergeHeader' => true,
                ],			
                [
                    'label' => 'Name',
                    'hAlign' => 'center',
                    'vAlign' => 'middle',
                    'attribute' => 'g_name',
                    'mergeHeader' => true,
                ],
                [
                    'label' => 'Email',
                    'hAlign' => 'center',
                    'vAlign' => 'middle',
                    'attribute' => 'email',
                    'mergeHeader' => true,
                ],
                [
                    'label' => 'Last Login',
                    'hAlign' => 'center',
                    'vAlign' => 'middle',
                    'mergeHeader' => true,
                    'value' => function($data){return Yii::$app->formatter->asDate($data->updated_at, 'php:j F Y h:i A');},				
                ],			
                [
                    'label' => 'Last IP',
                    'hAlign' => 'center',
                    'vAlign' => 'middle',
                    'attribute' => 'last_ip',
                    'mergeHeader' => true,
                ],		
                [
                    'label' => 'Locale',
                    'attribute' => 'g_locale',
                    'hAlign' => 'center',
                    'vAlign' => 'middle',
                    'mergeHeader' => true,
                ],
                [
                    'class' => 'kartik\grid\BooleanColumn',
                    'label' => 'Deleted',
                    'hAlign' => 'center',
                    'vAlign' => 'middle',
                    'mergeHeader' => true,
                    'format' => 'raw',
                    'value' => function($data){if($data->status == 0){return true;}else{return false;};}
                ],			
                [
                    //'class' => 'kartik\grid\EditableColumn',
                    'label' => 'Authorized',
                    'hAlign' => 'center',
                    'vAlign' => 'middle',
                    'mergeHeader' => true,
                    'format' => 'raw',
                    'value' => function ($model) {
                        if($model->status==10){$val1=true;}else{$val1=false;}
                        if($model->status==0){$val2=true;}else{$val2=false;}
                        return SwitchInput::widget([
                            'name' => $model->id,
                            'value' => $val1,
                            'disabled' => $val2,
                            'pluginOptions' => [
                                'size' => 'mini',
                                'onColor' => 'success', 
                                'onText' => 'ON',
                                'offText' => 'OFF',
                            ],
                                //'options' => ['id' => $model->id,],
                                'containerOptions' => ['style' => 'margin: 0px;', 'name' => $model->id,],
                        ]);
                    }				
                ],
                //
            ]
        ]);  
        ?>
        </div>
</div>