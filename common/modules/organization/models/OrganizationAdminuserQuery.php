<<<<<<< HEAD
<?php

namespace common\modules\organization\models;

/**
 * This is the ActiveQuery class for [[OrganizationAdminuser]].
 *
 * @see OrganizationAdminuser
 */
class OrganizationAdminuserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return OrganizationAdminuser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OrganizationAdminuser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
=======
<?php

namespace common\modules\organization\models;

/**
 * This is the ActiveQuery class for [[OrganizationAdminuser]].
 *
 * @see OrganizationAdminuser
 */
class OrganizationAdminuserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return OrganizationAdminuser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OrganizationAdminuser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
