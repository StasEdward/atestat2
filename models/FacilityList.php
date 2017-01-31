<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "FACILITY_LIST".
 *
 * @property string $facility_name
 * @property string $external_ip
 * @property string $internal_ip
 * @property string $description
 */
class FacilityList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'FACILITY_LIST';
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
            [['FACILITY_NAME', 'EXTERNAL_IP', 'INTERNAL_IP'], 'required'],
            [['FACILITY_NAME', 'EXTERNAL_IP', 'INTERNAL_IP'], 'string', 'max' => 25],
            [['DESCRIPTION'], 'string', 'max' => 100],
            [['FACILITY_NAME'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'FACILITY_NAME' => 'Facility Name',
            'EXTERNAL_IP' => 'External Ip',
            'INTERNAL_IP' => 'Internal Ip',
            'DESCRIPTION' => 'Description',
        ];
    }
}
