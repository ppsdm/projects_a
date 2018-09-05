<?php

namespace app\modules\profile\models;

use Yii;

/**
 * This is the model class for table "profile_review".
 *
 * @property integer $id
 * @property integer $reviewer_id
 * @property integer $reviewee_id
 * @property string $review
 * @property string $attribute_1
 * @property string $attribute_2
 * @property string $attribute_3
 * @property string $created_at
 * @property string $modified_at
 *
 * @property Profile $reviewer
 * @property Profile $reviewee
 */
class ProfileReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reviewer_id', 'reviewee_id'], 'integer'],
            [['review'], 'string'],
            [['created_at', 'modified_at'], 'safe'],
            [['attribute_1', 'attribute_2', 'attribute_3'], 'string', 'max' => 255],
            [['reviewer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['reviewer_id' => 'id']],
            [['reviewee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['reviewee_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'reviewer_id' => Yii::t('app', 'Reviewer ID'),
            'reviewee_id' => Yii::t('app', 'Reviewee ID'),
            'review' => Yii::t('app', 'Review'),
            'attribute_1' => Yii::t('app', 'Attribute 1'),
            'attribute_2' => Yii::t('app', 'Attribute 2'),
            'attribute_3' => Yii::t('app', 'Attribute 3'),
            'created_at' => Yii::t('app', 'Created At'),
            'modified_at' => Yii::t('app', 'Modified At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviewer()
    {
        return $this->hasOne(Profile::className(), ['id' => 'reviewer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviewee()
    {
        return $this->hasOne(Profile::className(), ['id' => 'reviewee_id']);
    }

    /**
     * @inheritdoc
     * @return ProfileReviewQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProfileReviewQuery(get_called_class());
    }
}
