<?php

namespace app\modules\projects\models;

/**
 * This is the ActiveQuery class for [[CatalogMeta]].
 *
 * @see CatalogMeta
 */
class CatalogMetaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CatalogMeta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CatalogMeta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}