<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use common\models\User;
use kartik\grid\GridView;

$this->title = 'Users';
?>
<div>
	<div class="panel panel-default">
        <div class="panel-heading">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">
			<?php
			$gridColumns = [
				['class' => 'kartik\grid\CheckboxColumn']
			];
			GridView::widget([
			
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'class' => 'kartik\grid\EditableColumn',
				'responsive'=> true,
				'hover'=> true,
				'pjax'=> true,
				'tableOptions'=>['class'=>'table table-bordered table-striped dataTable table-hover'],
				'summaryOptions' => ['class' =>'dataTables_info'],
				'layout'=>"{items}\n<div class='row' style='margin:0.1%'>
									 <div class='col-sm-5'>
										{summary}
									 </div>
									 <div class='col-sm-7'>
										<div class='dataTables_paginate paging_simple_numbers'>{pager}</div>
									 </div>
									 </div>",
				'columns' => $gridColumns,
			]);
			?>
        </div>
    </div>
</div>
