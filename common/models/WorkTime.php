<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%work_time}}".
 *
 * @property int $id
 * @property int $workDays_id
 * @property string $start_at
 * @property string $end_at
 */
class WorkTime extends \yii\db\ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%work_time}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workDays_id'], 'integer'],
            [['workDays_id', 'start_at', 'end_at'], 'required'],
            [['start_at', 'end_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'workDays_id' => 'Work Days ID',
            'start_at' => 'Start At',
            'end_at' => 'End At',
        ];
    }

    public function getDays()
    {
        return $this->hasOne(WorkDays::className(), ['id' => 'workDays_id']);
    }

    public function getArray($id)
    {


       return ArrayHelper::map(WorkDays::find()
            ->asArray()
            ->where(['store_id' => $id])
            ->all(),'id',
            'id'
        );
    }




}
