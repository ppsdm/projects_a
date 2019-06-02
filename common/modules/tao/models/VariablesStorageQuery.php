<<<<<<< HEAD
<?php

namespace common\modules\tao\models;

/**
 * This is the ActiveQuery class for [[VariablesStorage]].
 *
 * @see VariablesStorage
 */
class VariablesStorageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return VariablesStorage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return VariablesStorage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
=======
<?php

namespace common\modules\tao\models;

/**
 * This is the ActiveQuery class for [[VariablesStorage]].
 *
 * @see VariablesStorage
 */
class VariablesStorageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return VariablesStorage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return VariablesStorage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
