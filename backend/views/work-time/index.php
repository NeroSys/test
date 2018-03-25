<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WorkTimeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Work Times';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-time-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Work Time', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'workDays_id',
            'start_at',
            'end_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
