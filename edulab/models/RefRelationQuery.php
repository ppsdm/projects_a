<<<<<<< HEAD
<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RefRelation]].
 *
 * @see RefRelation
 */
class RefRelationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return RefRelation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RefRelation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
=======
<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RefRelation]].
 *
 * @see RefRelation
 */
class RefRelationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return RefRelation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RefRelation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
