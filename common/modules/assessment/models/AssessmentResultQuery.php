<<<<<<< HEAD
<?php

namespace common\modules\assessment\models;

/**
 * This is the ActiveQuery class for [[AssessmentResult]].
 *
 * @see AssessmentResult
 */
class AssessmentResultQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AssessmentResult[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AssessmentResult|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
=======
<?php

namespace common\modules\assessment\models;

/**
 * This is the ActiveQuery class for [[AssessmentResult]].
 *
 * @see AssessmentResult
 */
class AssessmentResultQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AssessmentResult[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AssessmentResult|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
