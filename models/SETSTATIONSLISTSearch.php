<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SETSTATIONSLIST;

/**
 * SETSTATIONSLISTSearch represents the model behind the search form about `app\models\SETSTATIONSLIST`.
 */
class SETSTATIONSLISTSearch extends SETSTATIONSLIST
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stationid', 'devicename', 'devicetype', 'interface', 'addr', 'devpic', 'test_function_name', 'dllname'], 'safe'],
            [['order_id'], 'integer'],
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
        $query = SETSTATIONSLIST::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
          ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'order_id' => $this->order_id,
        ]);

        $query->andFilterWhere(['=', 'stationid', $this->stationid])
            ->andFilterWhere(['like', 'devicename', $this->devicename])
            ->andFilterWhere(['like', 'devicetype', $this->devicetype])
            ->andFilterWhere(['like', 'interface', $this->interface])
            ->andFilterWhere(['like', 'addr', $this->addr])
            ->andFilterWhere(['like', 'devpic', $this->devpic])
            ->andFilterWhere(['like', 'test_function_name', $this->test_function_name])
            ->andFilterWhere(['like', 'dllname', $this->dllname]);

        return $dataProvider;
    }
}
