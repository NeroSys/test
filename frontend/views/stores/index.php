<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Days;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\StoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stores-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <div class="row">
        <div class="col-lg-4">
            <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="col-lg-8">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [

                    'id',
                    'name',
                    [
                        'attribute' => 'workDays',
                        'format' => 'html',
                        'label' => 'Work days',
                        'value' => function ($model) {
                            $workDays = '';
                            foreach ($model->workDays as $key => $workDay) {
                                if ($key !== 0) {
                                    $workDays .= '<br />';
                                }

                                $day = Days::find()->where(['id' => $workDay['day_id']])->one();
                                $workDays .= $day->name;
                            }
                            return $workDays;
                        },
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
