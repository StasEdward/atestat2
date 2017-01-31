<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ROUTING_CONFIG".
 *
 * @property integer $id
 * @property string $source_station
 * @property string $destination_station
 * @property string $uut_name
 * @property integer $sample_ratio
 * @property integer $sample_period
 * @property integer $sample_counter
 * @property string $last_update
 */
class ROUTINGCONFIG extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ROUTING_CONFIG';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_atemain');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'source_station', 'destination_station'], 'required'],
            [['id', 'sample_ratio', 'sample_period', 'sample_counter'], 'integer'],
            [['last_update'], 'safe'],
            [['source_station', 'destination_station', 'uut_name'], 'string', 'max' => 25],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'source_station' => 'Source Station',
            'destination_station' => 'Destination Station',
            'uut_name' => 'Uut Name',
            'sample_ratio' => 'Sample Ratio',
            'sample_period' => 'Sample Period',
            'sample_counter' => 'Sample Counter',
            'last_update' => 'Last Update',
        ];
    }
}
