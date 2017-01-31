<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "SETSTATIONSLIST".
 *
 * @property string $stationid
 * @property string $devicename
 * @property string $devicetype
 * @property string $interface
 * @property string $addr
 * @property integer $order_id
 * @property resource $devpic
 * @property string $test_function_name
 * @property string $dllname
 */
class SETSTATIONSLIST extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SETSTATIONSLIST';
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
            [['stationid', 'devicename', 'devicetype', 'interface', 'addr', 'test_function_name', 'dllname'], 'required'],
            [['order_id'], 'integer'],
            [['devpic'], 'string'],
            [['stationid', 'devicename', 'devicetype'], 'string', 'max' => 20],
            [['interface'], 'string', 'max' => 10],
            [['addr'], 'string', 'max' => 30],
            [['test_function_name', 'dllname'], 'string', 'max' => 50],
            [['stationid', 'devicename'], 'unique', 'targetAttribute' => ['stationid', 'devicename'], 'message' => 'The combination of Stationid and Devicename has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'stationid' => 'Stationid',
            'devicename' => 'Devicename',
            'devicetype' => 'Devicetype',
            'interface' => 'Interface',
            'addr' => 'Addr',
            'order_id' => 'Order ID',
            'devpic' => 'Devpic',
            'test_function_name' => 'Test Function Name',
            'dllname' => 'Dllname',
        ];
    }

    /**
     * @inheritdoc
     * @return SETSTATIONSLISTQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SETSTATIONSLISTQuery(get_called_class());
    }
}
