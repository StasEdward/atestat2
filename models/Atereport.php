<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PHOSTESTGLOBALTEST".
 *
 * @property string $id
 * @property string $STATIONID
 * @property string $UUTNAME
 * @property string $PARTNUMBER
 * @property string $SERIALNUMBER
 * @property string $TECHNAME
 * @property string $TESTDATE
 * @property string $TIMESTART
 * @property string $TIMESTOP
 * @property integer $UUTPLACE
 * @property string $TESTMODE
 * @property string $GLOBALRESULT
 * @property string $VERSIONS
 * @property string $FACILITY
 *
 * @property PHOSTESTGLOBALRES[] $pHOSTESTGLOBALRESs
 */
class Atereport extends \yii\db\ActiveRecord
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
            [['TESTDATE', 'TIMESTART', 'TIMESTOP'], 'safe'],
            [['UUTPLACE'], 'integer'],
            [['STATIONID', 'PARTNUMBER', 'SERIALNUMBER'], 'string', 'max' => 20],
            [['UUTNAME'], 'string', 'max' => 50],
            [['TECHNAME'], 'string', 'max' => 30],
            [['TESTMODE', 'GLOBALRESULT', 'FACILITY'], 'string', 'max' => 10],
            [['VERSIONS'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'STATIONID' => 'Stationid',
            'UUTNAME' => 'Uutname',
            'PARTNUMBER' => 'Partnumber',
            'SERIALNUMBER' => 'Serialnumber',
            'TECHNAME' => 'Techname',
            'TESTDATE' => 'Testdate',
            'TIMESTART' => 'Timestart',
            'TIMESTOP' => 'Timestop',
            'UUTPLACE' => 'Uutplace',
            'TESTMODE' => 'Testmode',
            'GLOBALRESULT' => 'Globalresult',
            'VERSIONS' => 'Versions',
            'FACILITY' => 'Facility',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPHOSTESTGLOBALRESs()
    {
        return $this->hasMany(PHOSTESTGLOBALRES::className(), ['HEADER_ID' => 'id']);
    }


    /**
     * @inheritdoc
     * @return AtereportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AtereportQuery(get_called_class());
    }
}
