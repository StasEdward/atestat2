<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\syncdbconfig;

/**
 * syncdbconfigSearch represents the model behind the search form about `app\models\syncdbconfig`.
 */
class syncdbconfigSearch extends syncdbconfig
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'record_count', 'status'], 'integer'],
            [['client_name', 'db_host', 'db_path'], 'safe'],
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
        $query = syncdbconfig::find();

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
            'record_count' => $this->record_count,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'client_name', $this->client_name])
            ->andFilterWhere(['like', 'db_host', $this->db_host])
            ->andFilterWhere(['like', 'db_path', $this->db_path]);

        return $dataProvider;
    }
}
