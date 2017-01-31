<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Atereport]].
 *
 * @see Atereport
 */
class AtereportQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Atereport[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Atereport|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
