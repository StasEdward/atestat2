<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TestResults;

/**
 * TestResultsSearch represents the model behind the search form about `app\models\TestResults`.
 */
class TestResultsSearch extends TestResults
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'HEADER_ID', 'TEST_ID'], 'integer'],
            [['TESTNAME', 'MINRANGE', 'RESULT', 'MAXRANGE', 'UNITS', 'TESTSTATUS', 'TIMEOFTEST', 'GRAPH_ID', 'TEST_TYPE', 'X_AXIS', 'Y_AXIS'], 'safe'],
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
        $query = TestResults::find();

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
            'ID' => $this->ID,
            'HEADER_ID' => $this->HEADER_ID,
            'TEST_ID' => $this->TEST_ID,
            'TIMEOFTEST' => $this->TIMEOFTEST,
        ]);

        $query->andFilterWhere(['like', 'TESTNAME', $this->TESTNAME])
            ->andFilterWhere(['like', 'MINRANGE', $this->MINRANGE])
            ->andFilterWhere(['like', 'RESULT', $this->RESULT])
            ->andFilterWhere(['like', 'MAXRANGE', $this->MAXRANGE])
            ->andFilterWhere(['like', 'UNITS', $this->UNITS])
            ->andFilterWhere(['like', 'TESTSTATUS', $this->TESTSTATUS])
            ->andFilterWhere(['like', 'GRAPH_ID', $this->GRAPH_ID])
            ->andFilterWhere(['like', 'TEST_TYPE', $this->TEST_TYPE])
            ->andFilterWhere(['like', 'X_AXIS', $this->X_AXIS])
            ->andFilterWhere(['like', 'Y_AXIS', $this->Y_AXIS]);

        return $dataProvider;
    }
}
