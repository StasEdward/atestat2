<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DaylyTestResults;

/**
 * DaylyTestResultsSearch represents the model behind the search form about `app\models\DaylyTestResults`.
 */
class DaylyTestResultsSearch extends DaylyTestResults
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uutplace', 'indexrange', 'backupflag'], 'integer'],
            [['stationid', 'uutname', 'partnumber', 'serialnumber', 'techname', 'testdate', 'timestart', 'timestop', 'testmode', 'globalresult', 'versions'], 'safe'],
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
        $query = DaylyTestResults::find();


        // add conditions that should always apply here
        // WHERE testdate >= dateadd (-1 day to current_date)
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
            'server_name' => $this->server_name,
            'pass_result' => $this->pass_result,
            'fail_result' => $this->fail_result,
        ]);

        $query->andFilterWhere(['like', 'time_update', $this->time_update]);

        return $dataProvider;
    }
}
