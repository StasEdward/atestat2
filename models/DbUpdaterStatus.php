<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "db_updater_status".
 *
 * @property integer $id
 * @property string $FACILITY
 * @property string $HOST
 * @property string $LAST_UPDATE
 */
class DbUpdaterStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'db_updater_status';
    }

    public function getUpdaterStatus()
    {
        $res1 = Yii::$app->db->createCommand('SELECT * FROM  db_updater_status ORDER BY LAST_UPDATE DESC')->queryAll();
        return $res1;
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FACILITY', 'HOST', 'LAST_UPDATE'], 'required'],
            [['LAST_UPDATE'], 'safe'],
            [['FACILITY', 'HOST'], 'string', 'max' => 20],
            [['HOST'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'FACILITY' => 'Facility',
            'HOST' => 'Host',
            'LAST_UPDATE' => 'Last  Update',
        ];
    }
}
