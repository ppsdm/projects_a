<<<<<<< HEAD
<?php

namespace app\modules\projects\models;

/**
 * This is the ActiveQuery class for [[ProjectResultSnapshotMeta]].
 *
 * @see ProjectResultSnapshotMeta
 */
class ProjectResultSnapshotMetaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ProjectResultSnapshotMeta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProjectResultSnapshotMeta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
=======
<?php

namespace app\modules\projects\models;

/**
 * This is the ActiveQuery class for [[ProjectResultSnapshotMeta]].
 *
 * @see ProjectResultSnapshotMeta
 */
class ProjectResultSnapshotMetaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ProjectResultSnapshotMeta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProjectResultSnapshotMeta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
