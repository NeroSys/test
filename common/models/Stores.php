<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%stores}}".
 *
 * @property int $id
 * @property string $name
 *
 * @property WorkDays[] $workDays
 */
class Stores extends \yii\db\ActiveRecord
{

    public $day;
    public $dayNew;
    public $start;
    public $startNew;
    public $end;
    public $endNew;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%stores}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['day', 'start', 'end', 'dayNew', 'startNew', 'endNew'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkDays()
    {
        return $this->hasMany(WorkDays::className(), ['store_id' => 'id']);
    }

    public function getWorkTimes()
    {
        return $this->hasMany(WorkTime::className(), ['workDays_id' => 'id'])->viaTable('{{%work_days}}', ['store_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $days = Days::find()->all();

        if (!empty($days)){

            foreach ($days as $item) {

                $timeOne = WorkDays::find()->where(['store_id' => $this->id])->andWhere(['day_id' => $item->id])->one();

                if (empty($timeOne)){

                    $workDays = new WorkDays();

                    $workDays->store_id = $this->id;
                    $workDays->day_id = $item->id;
                    $workDays->save();
                }

            }

        }

    }

}
