<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PASSFAIL_DAYLY".
 *
 * @property integer $id
 * @property string $DATE
 * @property string $SERVER
 * @property integer $PASS
 * @property integer $FAIL
 */
class PASSFAILDAYLY extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'PASSFAIL_DAYLY';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DATE'], 'safe'],
            [['PASS', 'FAIL'], 'integer'],
            [['SERVER'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'DATE' => 'Date',
            'SERVER' => 'Server',
            'PASS' => 'Pass',
            'FAIL' => 'Fail',
        ];
    }
}
