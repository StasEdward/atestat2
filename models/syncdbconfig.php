<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sync_db_config".
 *
 * @property integer $id
 * @property string $client_name
 * @property string $db_host
 * @property string $db_path
 * @property integer $record_count
 * @property integer $status
 */
class syncdbconfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sync_db_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['record_count', 'status'], 'integer'],
            [['client_name'], 'string', 'max' => 50],
            [['db_host'], 'string', 'max' => 75],
            [['db_path'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_name' => 'Client Name',
            'db_host' => 'Db Host',
            'db_path' => 'Db Path',
            'record_count' => 'Record Count',
            'status' => 'Status',
        ];
    }
}
