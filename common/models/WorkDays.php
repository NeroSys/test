<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%work_days}}".
 *
 * @property int $id
 * @property int $store_id
 * @property int $day_id
 *
 * @property Stores $store
 */
class WorkDays extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%work_days}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'day_id'], 'integer'],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stores::className(), 'targetAttribute' => ['store_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_id' => 'Store ID',
            'day_id' => 'Day ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Stores::className(), ['id' => 'store_id']);
    }

    public function getDay()
    {
        return $this->hasOne(Days::className(), ['id' => 'day_id']);
    }
}
