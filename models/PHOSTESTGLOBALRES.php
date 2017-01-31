<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PHOSTESTGLOBALRES".
 *
 * @property string $ID
 * @property integer $HEADER_ID
 * @property integer $TEST_ID
 * @property string $TESTNAME
 * @property string $MINRANGE
 * @property string $RESULT
 * @property string $MAXRANGE
 * @property string $UNITS
 * @property string $TESTSTATUS
 * @property string $TIMEOFTEST
 * @property string $GRAPH_ID
 * @property string $TEST_TYPE
 * @property string $X_AXIS
 * @property string $Y_AXIS
 */
class PHOSTESTGLOBALRES extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'PHOSTESTGLOBALRES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HEADER_ID', 'TEST_ID'], 'integer'],
            [['TIMEOFTEST'], 'safe'],
            [['TESTNAME'], 'string', 'max' => 50],
            [['MINRANGE', 'RESULT', 'MAXRANGE', 'GRAPH_ID', 'TEST_TYPE', 'X_AXIS', 'Y_AXIS'], 'string', 'max' => 20],
            [['UNITS', 'TESTSTATUS'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'HEADER_ID' => 'Header  ID',
            'TEST_ID' => 'Test  ID',
            'TESTNAME' => 'Testname',
            'MINRANGE' => 'Minrange',
            'RESULT' => 'Result',
            'MAXRANGE' => 'Maxrange',
            'UNITS' => 'Units',
            'TESTSTATUS' => 'Teststatus',
            'TIMEOFTEST' => 'Timeoftest',
            'GRAPH_ID' => 'Graph  ID',
            'TEST_TYPE' => 'Test  Type',
            'X_AXIS' => 'X  Axis',
            'Y_AXIS' => 'Y  Axis',
        ];
    }
}
