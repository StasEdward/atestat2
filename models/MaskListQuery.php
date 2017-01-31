<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MaskList]].
 *
 * @see MaskList
 */
class MaskListQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MaskList[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MaskList|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
