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
use kartik\switchinput\SwitchInput;

$panelTemplate = ("
<div class='panel-{type}'>
	{panelBefore}
    {panelHeading}
    {items}
    <div class='text-center'>{panelFooter}</div>
</div>
");

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
						"<button class='btn btn-default' id='dltrowbtn'><span class='glyphicon glyphicon-trash'></span></button>" .
					"</div>"
				],
				'{export}',
				//'{toggleData}',
			],			
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
				'value' => function($data){
					return ("<img src='" . $data->g_picture . "' style='max-width:30px;' class='img-thumbnail'>");
				}
			],
			[
				'label' => 'Name',
				'hAlign' => 'center',
				'vAlign' => 'middle',
				'attribute' => 'g_name',
			],
			[
				'class' => 'kartik\grid\BooleanColumn',
				'label' => 'Active',
				'hAlign' => 'center',
				'vAlign' => 'middle',
				'mergeHeader' => true,
				'format' => 'raw',
				'value' => function($data){$data->status != 0;}
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
	}
	
?>
