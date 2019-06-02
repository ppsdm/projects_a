<<<<<<< HEAD
<?php

namespace app\modules\admin\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "organization_adminuser".
 *
 * @property integer $organization_id
 * @property integer $user_id
 * @property string $status
 *
 * @property Organization $organization
 * @property User $user
 */
class OrganizationAdminuser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization_adminuser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organization_id', 'user_id'], 'integer'],
            [['status'], 'string', 'max' => 255],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'organization_id' => Yii::t('app', 'Organization ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return OrganizationAdminuserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrganizationAdminuserQuery(get_called_class());
    }
}
=======
<?php

namespace app\modules\admin\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "organization_adminuser".
 *
 * @property integer $organization_id
 * @property integer $user_id
 * @property string $status
 *
 * @property Organization $organization
 * @property User $user
 */
class OrganizationAdminuser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization_adminuser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organization_id', 'user_id'], 'integer'],
            [['status'], 'string', 'max' => 255],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'organization_id' => Yii::t('app', 'Organization ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return OrganizationAdminuserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrganizationAdminuserQuery(get_called_class());
    }
}
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
