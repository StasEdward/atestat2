<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TRACES_LIST".
 *
 * @property integer $id
 * @property string $TRACE_ID
 * @property integer $POINT_COUNT
 * @property resource $TRACE_FREQ_DATA
 * @property resource $TRACE_POWER_DATA
 */
class TracesList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TRACES_LIST';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['POINT_COUNT'], 'integer'],
            [['TRACE_FREQ_DATA', 'TRACE_POWER_DATA'], 'required'],
            [['TRACE_FREQ_DATA', 'TRACE_POWER_DATA'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'POINT_COUNT' => 'Point  Count',
            'TRACE_FREQ_DATA' => 'Trace  Freq  Data',
            'TRACE_POWER_DATA' => 'Trace  Power  Data',
        ];
    }

    /**
     * @inheritdoc
     * @return TRACESLISTQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TRACESLISTQuery(get_called_class());
    }
}
