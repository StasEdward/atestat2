<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SETSTATIONSLIST]].
 *
 * @see SETSTATIONSLIST
 */
class SETSTATIONSLISTQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SETSTATIONSLIST[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SETSTATIONSLIST|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
