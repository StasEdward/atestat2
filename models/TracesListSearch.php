<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TracesList;

/**
 * TracesListSearch represents the model behind the search form about `app\models\TracesList`.
 */
class TracesListSearch extends TracesList
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'POINT_COUNT'], 'integer'],
            [['TRACE_FREQ_DATA', 'TRACE_POWER_DATA'], 'safe'],
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
        $query = TracesList::find();

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
            'POINT_COUNT' => $this->POINT_COUNT,
        ]);

        $query->andFilterWhere(['like', 'TRACE_FREQ_DATA', $this->TRACE_FREQ_DATA])
            ->andFilterWhere(['like', 'TRACE_POWER_DATA', $this->TRACE_POWER_DATA]);

        return $dataProvider;
    }
}
