<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;

use common\models\User;

use kartik\grid\GridView;

$panelTemplate = ("
<div class='panel-{type}'>
    {panelHeading}
    {panelBefore}
    {items}
    <div class='text-center'>{panelFooter}</div>
</div>
");

$switchValue = $model->status==10 ? $model->status!=10;

$this->title = 'Users';

?>

<?php        
	if(isset($dataProvider))
	{
		//$dataProvider->sort = ['defaultOrder' => ['id' => 'SORT_DESC']];
		
		echo GridView::widget([
			'id' => 'users_grid',
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
				'heading' => '<span class="glyphicon glyphicon-user"></span> Users',
				'before' => false,
				'after' => false,
			],
			'panelTemplate' => $panelTemplate,
			'toolbar' =>  [
				['content' => 
					"<div class='btn-group'>" .
						"<a class='btn btn-default' href='" . Url::toRoute(['site/users']) . "' id='rfrshbtn' data-pjax='0'><span class='glyphicon glyphicon-repeat'></span></a>" .
						//"<button class='btn btn-default'><span class='glyphicon glyphicon-plus'></span></button>" .
						//"<button class='btn btn-default' id='dltrowbtn'><span class='glyphicon glyphicon-trash'></span></button>" .
					"</div>"
				],
				'{export}',
				//'{toggleData}',
			],
			'tableOptions' => ['style' => 'margin:0px;'],
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
				],                      
				[
					'format'=>'raw',
					'value' => function($data){
						return ("<img src='" . $data->g_picture . "' style='max-width:30px;' class='img-thumbnail'>");
					}
				],
				[
					'class' => 'kartik\grid\EditableColumn',
					//'filterType' => GridView::FILTER_TYPEAHEAD,
					'label' => 'File Name',
					'hAlign' => 'center',
					'vAlign' => 'middle',
					'attribute' => 'name',
					'refreshGrid' => true,
					'editableOptions' => [
						'options' => ['maxlength' => 30],
						'formOptions' => [
						   'action' => Url::toRoute(['file/edit-file-name']),
						]
					]
				],
				[
					'label' => 'Name',
					'hAlign' => 'center',
					'vAlign' => 'middle',
					'attribute' => 'g_name',
				],
				[
					'attribute' => 'time',
					'label' => 'Date',
					'hAlign' => 'center',
					'vAlign' => 'middle',
					'format' => ['date', 'php:j F Y h:i A'],
					'filterType' => GridView::FILTER_DATE,
					'filterWidgetOptions' => [
						'pluginOptions' => [
							'convertFormat' => true,
							'format' => 'yyyy-mm-dd',
							'autoWidget' => true,
							'autoclose' => true,
						]
					],
				],                      
				[
					'label' => 'File Ext.',
					'hAlign' => 'center',
					'vAlign' => 'middle',
					'mergeHeader' => true,
					'format' => 'raw',
					'value' => function ($model) {
						return "<span class='label label-default'>." . $model->type . "</span>";
					}
				],
				[
					'class' => 'kartik\grid\BooleanColumn',
					'label' => 'Shared File',
					'hAlign' => 'center',
					'vAlign' => 'middle',
					'mergeHeader' => true,
					'format' => 'raw',
					'value' => function ($model) {
						return !empty($model->user !== Yii::$app->user->identity->ms_id);
						//return in_array(Yii::$app->user->identity->id, array($model->auth_id_list));
					}
				],
				[
					'label' => 'Locale',
					'attribute' => 'g_locale',
					'hAlign' => 'center',
					'vAlign' => 'middle',
					'mergeHeader' => true,
				],				
				[
					//'class' => 'kartik\grid\EditableColumn',
					'label' => 'Authorized',
					'hAlign' => 'center',
					'vAlign' => 'middle',
					'mergeHeader' => true,
					'format' => 'raw',
					'value' => function ($model) {
						return SwitchInput::widget([
							'name' => $model->id,
							'value' => $switchValue,
							'disabled' => $model->status == 0,
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
			],
		]);
	}
	
?>
