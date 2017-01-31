<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "information_schema.TABLES".
 *
 * @property string $TABLE_CATALOG
 * @property string $TABLE_SCHEMA
 * @property string $TABLE_NAME
 * @property string $TABLE_TYPE
 * @property string $ENGINE
 * @property string $VERSION
 * @property string $ROW_FORMAT
 * @property string $TABLE_ROWS
 * @property string $AVG_ROW_LENGTH
 * @property string $DATA_LENGTH
 * @property string $MAX_DATA_LENGTH
 * @property string $INDEX_LENGTH
 * @property string $DATA_FREE
 * @property string $AUTO_INCREMENT
 * @property string $CREATE_TIME
 * @property string $UPDATE_TIME
 * @property string $CHECK_TIME
 * @property string $TABLE_COLLATION
 * @property string $CHECKSUM
 * @property string $CREATE_OPTIONS
 * @property string $TABLE_COMMENT
 */
class DbStat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'information_schema.TABLES';
    }

/*
    public static function primaryKey()
    {
       return 'TABLE_NAME';
    }*/
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['VERSION', 'TABLE_ROWS', 'AVG_ROW_LENGTH', 'DATA_LENGTH', 'MAX_DATA_LENGTH', 'INDEX_LENGTH', 'DATA_FREE', 'AUTO_INCREMENT', 'CHECKSUM'], 'integer'],
            [['CREATE_TIME', 'UPDATE_TIME', 'CHECK_TIME'], 'safe'],
            [['TABLE_CATALOG'], 'string', 'max' => 512],
            [['TABLE_SCHEMA', 'TABLE_NAME', 'TABLE_TYPE', 'ENGINE'], 'string', 'max' => 64],
            [['ROW_FORMAT'], 'string', 'max' => 10],
            [['TABLE_COLLATION'], 'string', 'max' => 32],
            [['CREATE_OPTIONS'], 'string', 'max' => 255],
            [['TABLE_COMMENT'], 'string', 'max' => 2048],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TABLE_CATALOG' => 'Table  Catalog',
            'TABLE_SCHEMA' => 'Table  Schema',
            'TABLE_NAME' => 'Table  Name',
            'TABLE_TYPE' => 'Table  Type',
            'ENGINE' => 'Engine',
            'VERSION' => 'Version',
            'ROW_FORMAT' => 'Row  Format',
            'TABLE_ROWS' => 'Table  Rows',
            'AVG_ROW_LENGTH' => 'Avg  Row  Length',
            'DATA_LENGTH' => 'Data  Length',
            'MAX_DATA_LENGTH' => 'Max  Data  Length',
            'INDEX_LENGTH' => 'Index  Length',
            'DATA_FREE' => 'Data  Free',
            'AUTO_INCREMENT' => 'Auto  Increment',
            'CREATE_TIME' => 'Create  Time',
            'UPDATE_TIME' => 'Update  Time',
            'CHECK_TIME' => 'Check  Time',
            'TABLE_COLLATION' => 'Table  Collation',
            'CHECKSUM' => 'Checksum',
            'CREATE_OPTIONS' => 'Create  Options',
            'TABLE_COMMENT' => 'Table  Comment',
        ];
    }
    public function getDbStatistics()
    {

        $res1 = Yii::$app->db->createCommand('SELECT table_name "DB_Name", table_rows,
     ((data_length + index_length ) ) "DB_Size",
    (( data_free )/ 1024 ) "DB_Free" FROM information_schema.TABLES where information_schema.TABLES.TABLE_SCHEMA = \'atestat\'')->queryAll();
        $db_res_arr = array();
        $db_res_arr = array($res1[3]['DB_Name'], (int)$res1[3]['table_rows'], (int)$res1[3]['DB_Size'], (int)$res1[3]['DB_Free']);
  //      $db_res_arr = array($res1[1]['DB_Name'], (int)$res1[1]['table_rows'], (int)$res1[1]['DB_Size'], (int)$res1[1]['DB_Free']);

    //    print_r($res1);

        return $res1;
    }

}
