<<<<<<< HEAD
<?php

namespace app\modules\tao\models;

use Yii;

/**
 * This is the model class for table "statements".
 *
 * @property integer $id
 * @property integer $modelid
 * @property string $subject
 * @property string $predicate
 * @property string $object
 * @property string $l_language
 * @property string $author
 * @property string $epoch
 */
class Statement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statements';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('taodb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['modelid'], 'integer'],
            [['subject', 'predicate'], 'required'],
            [['object'], 'string'],
            [['subject', 'predicate', 'l_language', 'author', 'epoch'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'modelid' => Yii::t('app', 'Modelid'),
            'subject' => Yii::t('app', 'Subject'),
            'predicate' => Yii::t('app', 'Predicate'),
            'object' => Yii::t('app', 'Object'),
            'l_language' => Yii::t('app', 'L Language'),
            'author' => Yii::t('app', 'Author'),
            'epoch' => Yii::t('app', 'Epoch'),
        ];
    }

    /**
     * @inheritdoc
     * @return StatementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatementQuery(get_called_class());
    }
}
=======
<?php

namespace app\modules\tao\models;

use Yii;

/**
 * This is the model class for table "statements".
 *
 * @property integer $id
 * @property integer $modelid
 * @property string $subject
 * @property string $predicate
 * @property string $object
 * @property string $l_language
 * @property string $author
 * @property string $epoch
 */
class Statement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statements';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('taodb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['modelid'], 'integer'],
            [['subject', 'predicate'], 'required'],
            [['object'], 'string'],
            [['subject', 'predicate', 'l_language', 'author', 'epoch'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'modelid' => Yii::t('app', 'Modelid'),
            'subject' => Yii::t('app', 'Subject'),
            'predicate' => Yii::t('app', 'Predicate'),
            'object' => Yii::t('app', 'Object'),
            'l_language' => Yii::t('app', 'L Language'),
            'author' => Yii::t('app', 'Author'),
            'epoch' => Yii::t('app', 'Epoch'),
        ];
    }

    /**
     * @inheritdoc
     * @return StatementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatementQuery(get_called_class());
    }
}
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
