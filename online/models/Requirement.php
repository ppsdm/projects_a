<<<<<<< HEAD
<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requirement".
 *
 * @property integer $id
 * @property integer $object_id
 * @property string $requirement_type
 * @property string $key
 * @property string $value
 */
class Requirement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'requirement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id'], 'integer'],
            [['value'], 'string'],
            [['requirement_type', 'key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'requirement_type' => Yii::t('app', 'Requirement Type'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @inheritdoc
     * @return RequirementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RequirementQuery(get_called_class());
    }
}
=======
<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requirement".
 *
 * @property integer $id
 * @property integer $object_id
 * @property string $requirement_type
 * @property string $key
 * @property string $value
 */
class Requirement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'requirement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id'], 'integer'],
            [['value'], 'string'],
            [['requirement_type', 'key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'requirement_type' => Yii::t('app', 'Requirement Type'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @inheritdoc
     * @return RequirementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RequirementQuery(get_called_class());
    }
}
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
