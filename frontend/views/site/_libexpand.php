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
?>
<label class="control-label">Summary</label>
<div class='panel panel-default'>
	<div class='panel-body' style='word-break: break-all; max-width: 150px;'>
		<?= $model->summary ?>
	</div>
</div>