<<<<<<< HEAD
<?php

namespace common\modules\catalog\models;

/**
 * This is the ActiveQuery class for [[RewardGeneral]].
 *
 * @see RewardGeneral
 */
class RewardGeneralQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return RewardGeneral[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RewardGeneral|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
=======
<?php

namespace common\modules\catalog\models;

/**
 * This is the ActiveQuery class for [[RewardGeneral]].
 *
 * @see RewardGeneral
 */
class RewardGeneralQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return RewardGeneral[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RewardGeneral|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
