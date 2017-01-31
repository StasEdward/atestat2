<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PHOSTESTGLOBALTEST".
 *
 * @property integer $id
 * @property string $stationid
 * @property string $uutname
 * @property string $partnumber
 * @property string $serialnumber
 * @property string $techname
 * @property string $testdate
 * @property string $timestart
 * @property string $timestop
 * @property integer $uutplace
 * @property string $testmode
 * @property string $globalresult
 * @property integer $indexrange
 * @property string $versions
 * @property integer $backupflag
 */
class GlobalTest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'PHOSTESTGLOBALTEST';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'uutplace'], 'integer'],
            [['testdate', 'timestart', 'timestop'], 'string'],
            [['stationid'], 'string', 'max' => 20],
            [['uutname'], 'string', 'max' => 50],
            [['partnumber', 'serialnumber', 'techname'], 'string', 'max' => 30],
            [['testmode', 'globalresult'], 'string', 'max' => 10],
            [['versions'], 'string', 'max' => 500],
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
            'stationid' => 'Stationid',
            'uutname' => 'Uutname',
            'partnumber' => 'Partnumber',
            'serialnumber' => 'Serialnumber',
            'techname' => 'Techname',
            'testdate' => 'Testdate',
            'timestart' => 'Timestart',
            'timestop' => 'Timestop',
            'uutplace' => 'Uutplace',
            'testmode' => 'Testmode',
            'globalresult' => 'Globalresult',
          'versions' => 'Versions',
            'backupflag' => 'Backupflag',
        ];
    }
}
