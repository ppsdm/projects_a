<?php

namespace common\modules\catalog\models;

/**
 * This is the ActiveQuery class for [[CatalogPrice]].
 *
 * @see CatalogPrice
 */
class CatalogPriceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CatalogPrice[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CatalogPrice|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
