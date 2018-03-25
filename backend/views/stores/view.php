<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use common\models\Days;

/* @var $this yii\web\View */
/* @var $model common\models\Stores */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Stores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stores-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Add new work day-time', ['work-time/create', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

    <p>Working time</p>

    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider(['query' => $model->getWorkTimes()]),
        'layout' => "{items}\n{pager}",
        'columns' => [

            [
                    'attribute' => 'workDays_id',
                'value' => function ($model){

                   return $model->days->day->name;
                }
            ],
            'start_at',
            'end_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete} {link}',
                'buttons' => [
                    'delete' => function ($url,$model,$key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['work-time/delete', 'id' => $model->id],
                            ['data-method' => 'post']
                        );
                    },
                ],
                'controller' => 'work-time',

            ],
        ],
    ]); ?>

</div>
