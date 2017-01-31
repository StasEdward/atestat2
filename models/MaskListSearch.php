<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MaskList;

/**
 * TestResultsSearch represents the model behind the search form about `app\models\TestResults`.
 */
class MaskListSearch extends MaskList
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mask_id', 'point_id', 'freq_val', 'power_val'], 'required'],
            [['mask_id', 'point_id', 'rnd_point_id'], 'integer'],
            [['freq_val', 'power_val'], 'number'],
            [['mask_name'], 'string', 'max' => 40],
            [['full_mask_name'], 'string', 'max' => 110],
            [['rnd_mask_name', 'rnd_start_freq', 'rnd_stop_freq'], 'string', 'max' => 30],
            [['mask_id', 'point_id'], 'unique', 'targetAttribute' => ['mask_id', 'point_id'], 'message' => 'The combination of Mask ID and Point ID has already been taken.'],        ];
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
        $query = MaskList::find();

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
            'MASK_ID' => $this->MASK_ID,
            'POINT_ID' => $this->POINT_ID,
            'FREQ_VAL' => $this->FREQ_VAL,
            'POWER_VAL' => $this->POWER_VAL,
            'MASK_NAME' => $this->MASK_NAME,
        ]);

        $query->andFilterWhere(['like', 'MASK_ID', $this->MASK_ID])
            ->andFilterWhere(['like', 'POINT_ID', $this->POINT_ID])
            ->andFilterWhere(['like', 'FREQ_VAL', $this->FREQ_VAL])
            ->andFilterWhere(['like', 'POWER_VAL', $this->POWER_VAL])
            ->andFilterWhere(['like', 'MASK_NAME', $this->MASK_NAME]);
        return $dataProvider;
    }
}
