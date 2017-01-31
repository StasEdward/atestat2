<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "MASK_LIST".
 *
 * @property integer $mask_id
 * @property integer $point_id
 * @property double $freq_val
 * @property double $power_val
 * @property string $mask_name
 * @property string $full_mask_name
 * @property string $rnd_mask_name
 * @property string $rnd_start_freq
 * @property string $rnd_stop_freq
 * @property integer $rnd_point_id
 */
class MaskList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'MASK_LIST';
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
            [['mask_id', 'point_id', 'freq_val', 'power_val'], 'required'],
            [['mask_id', 'point_id', 'rnd_point_id'], 'integer'],
            [['freq_val', 'power_val'], 'number'],
            [['mask_name'], 'string', 'max' => 40],
            [['full_mask_name'], 'string', 'max' => 110],
            [['rnd_mask_name', 'rnd_start_freq', 'rnd_stop_freq'], 'string', 'max' => 30],
            [['mask_id', 'point_id'], 'unique', 'targetAttribute' => ['mask_id', 'point_id'], 'message' => 'The combination of Mask ID and Point ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mask_id' => 'Mask ID',
            'point_id' => 'Point ID',
            'freq_val' => 'Freq Val',
            'power_val' => 'Power Val',
            'mask_name' => 'Mask Name',
            'full_mask_name' => 'Full Mask Name',
            'rnd_mask_name' => 'Rnd Mask Name',
            'rnd_start_freq' => 'Rnd Start Freq',
            'rnd_stop_freq' => 'Rnd Stop Freq',
            'rnd_point_id' => 'Rnd Point ID',
        ];
    }

    /**
     * @inheritdoc
     * @return MaskListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MaskListQuery(get_called_class());
    }

    public function getMaskID($mask_name)
    {
    //    echo $mask_name;
        $res1 = Yii::$app->db_atemain->createCommand('SELECT distinct(mask_id) from MASK_LIST where MASK_NAME=\''.$mask_name.'\'')->queryOne();
    //    print_r($res1);
        return $res1['mask_id'];
    }

    public function getMaskFreqValues($mask_id)
    {
        $res1 = Yii::$app->db_atemain->createCommand('SELECT FREQ_VAL as FREQ_VAL from MASK_LIST where MASK_ID='.$mask_id.' ORDER BY POINT_ID ASC')->queryAll();
        return $res1;
    }
    public function getMaskPowerValues($mask_id)
    {
        $res1 = Yii::$app->db_atemain->createCommand('SELECT POWER_VAL as POWER_VAL from MASK_LIST where MASK_ID='.$mask_id.' ORDER BY POINT_ID ASC')->queryAll();
        return $res1;
    }

}
