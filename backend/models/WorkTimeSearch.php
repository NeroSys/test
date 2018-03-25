<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\WorkTime;

/**
 * WorkTimeSearch represents the model behind the search form of `common\models\WorkTime`.
 */
class WorkTimeSearch extends WorkTime
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'workDays_id'], 'integer'],
            [['start_at', 'end_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = WorkTime::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'workDays_id' => $this->workDays_id,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
        ]);

        return $dataProvider;
    }
}
