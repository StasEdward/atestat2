<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Atereport;
use yii\helpers\ArrayHelper;

/**
 * AtereportSearch represents the model behind the search form about `app\models\Atereport`.
 */
class AtereportSearch extends Atereport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'UUTPLACE'], 'integer'],
            [['STATIONID', 'UUTNAME', 'PARTNUMBER', 'SERIALNUMBER', 'TECHNAME', 'TESTDATE', 'TIMESTART', 'TIMESTOP', 'TESTMODE', 'GLOBALRESULT', 'VERSIONS', 'FACILITY'], 'safe'],
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


    public static function getPartNumberList($uut_name)
    {

        $return = [];
        $out = [];

        return Atereport::find()->select('DISTINCT `PARTNUMBER` as id, `PARTNUMBER` as name')->where(['UUTNAME' => $uut_name])->asArray()->all();
        
        //print_r($models);

        //$return = ArrayHelper::map($models, 'id', 'name');
       // print_r($return);


     /*   
        foreach ($return as $key => $value) {
            $out['id'] = $value[$key];
            $out['name'] = $value[$key];
        }
        return $out;
*/
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
        $query = Atereport::find();

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
            'TESTDATE' => $this->TESTDATE,
            'TIMESTART' => $this->TIMESTART,
            'TIMESTOP' => $this->TIMESTOP,
            'UUTPLACE' => $this->UUTPLACE,
        ]);

        $query->andFilterWhere(['like', 'STATIONID', $this->STATIONID])
            ->andFilterWhere(['=', 'UUTNAME', $this->UUTNAME])
            ->andFilterWhere(['like', 'PARTNUMBER', $this->PARTNUMBER])
            ->andFilterWhere(['like', 'SERIALNUMBER', $this->SERIALNUMBER])
            ->andFilterWhere(['like', 'TECHNAME', $this->TECHNAME])
            ->andFilterWhere(['like', 'TESTMODE', $this->TESTMODE])
            ->andFilterWhere(['like', 'GLOBALRESULT', $this->GLOBALRESULT])
            ->andFilterWhere(['like', 'VERSIONS', $this->VERSIONS])
            ->andFilterWhere(['like', 'FACILITY', $this->FACILITY]);

        return $dataProvider;
    }
}
