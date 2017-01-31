<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ROUTINGCONFIG;

/**
 * ROUTINGCONFIGSearch represents the model behind the search form about `app\models\ROUTINGCONFIG`.
 */
class ROUTINGCONFIGSearch extends ROUTINGCONFIG
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sample_ratio', 'sample_period', 'sample_counter'], 'integer'],
            [['source_station', 'destination_station', 'uut_name', 'last_update'], 'safe'],
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
        $query = ROUTINGCONFIG::find();

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
            'sample_ratio' => $this->sample_ratio,
            'sample_period' => $this->sample_period,
            'sample_counter' => $this->sample_counter,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'source_station', $this->source_station])
            ->andFilterWhere(['like', 'destination_station', $this->destination_station])
            ->andFilterWhere(['like', 'uut_name', $this->uut_name]);

        return $dataProvider;
    }
}
