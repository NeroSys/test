<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Days;
use common\models\WorkDays;

/* @var $this yii\web\View */
/* @var $model common\models\WorkTime */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-time-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($model->isNewRecord) {?>
        <?= $form->field($model, 'workDays_id')->dropDownList($model->getArray($id), ['prompt' => 'Choose day']) ?>
    <?}?>
    <?= $form->field($model, 'start_at')->textInput() ?>

    <?= $form->field($model, 'end_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
