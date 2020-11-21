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
			echo GridView::widget([
				'id' => 'kv-grid-demo',
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
				'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
				'headerRowOptions' => ['class' => 'kartik-sheet-style'],
				'filterRowOptions' => ['class' => 'kartik-sheet-style'],
				'pjax' => true, // pjax is set to always true for this demo
				// set your toolbar
				/*				
				'toolbar' =>  [
					['content' => 
						Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
						Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
					],
					'{export}',
					'{toggleData}',
				],
				// set export properties

				'export' => [
					'fontAwesome' => true
				],
				// parameters from the demo form

				'bordered' => $bordered,
				'striped' => $striped,
				'condensed' => $condensed,
				'responsive' => $responsive,
				'hover' => $hover,
				'showPageSummary' => $pageSummary,
				*/
				'panel' => [
					'type' => GridView::TYPE_PRIMARY,
					'heading' => $this->title,
				],
				'persistResize' => false,
				'toggleDataOptions' => ['minCount' => 10]
				//'exportConfig' => $exportConfig,
			]);
			?>
        </div>
    </div>
</div>
