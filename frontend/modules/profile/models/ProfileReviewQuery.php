<?php

namespace app\modules\profile\models;

/**
 * This is the ActiveQuery class for [[ProfileReview]].
 *
 * @see ProfileReview
 */
class ProfileReviewQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ProfileReview[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProfileReview|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
