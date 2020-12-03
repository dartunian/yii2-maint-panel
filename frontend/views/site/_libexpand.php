<?php
//use kartik\widgets\Select2;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/*
$script2 = <<< JS
function addUser(id, file)
{
	$.ajax({
		type: 'POST',
		url:'$toSU',
		showNoty: false, // add this for disable notification
		data:{id:id, file:file},
		success:function(data){
			$.pjax.reload({container: '#library_grid-pjax', timeout:5000});		
		},
	});
}
JS;

$this->registerJs($script2, \yii\web\View::POS_READY);
*/

if($model->status == 0)
{
	$panelType = 'info';
	$status = 'Created';	
}
elseif($model->status == 1)
{
	$panelType = 'warning';
	$status = 'In Progress';	
}
elseif($model->status == 2)
{
	$panelType = 'success';
	$status = 'Complete';	
}                    
?>
<div class="panel panel-<?= $panelType ?>" style="border:0px;margin:0px;border-radius:0px;">
	<div class="panel-heading" style="border-radius:0px;"><b>Status: </b><?= $status ?></div>
</div>
<div class="panel panel-<?= $panelType ?>" style="border:0px;margin:0px;border-radius:0px;">
	<div class="panel-heading" style="border-radius:0px;"><b>Summary: </b><span style="word-break: break-all;"><?= $model->summary ?></span></div>
</div>
