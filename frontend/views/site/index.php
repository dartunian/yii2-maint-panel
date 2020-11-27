<?php

/* @var $this yii\web\View */
use kartik\grid\GridView;

$this->title = 'Maintenance Panel';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Maintenance Panel</h1>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading"></div>
        <div class="panel-body">
        <?php
            echo GridView::widget([
                'dataProvider'=> $dataProvider,
                'filterModel' => $searchModel,
                //'columns' => $gridColumns,
                'responsive'=>true,
                'hover'=>true
            ]);    
        ?>
        </div>
</div>