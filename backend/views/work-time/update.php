<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WorkTime */

$this->title = 'Update Work Time: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Work Times', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="work-time-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
