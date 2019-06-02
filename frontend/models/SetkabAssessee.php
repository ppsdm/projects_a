<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "setkab_assessee".
 *
 * @property string $id
 * @property integer $profile_id
 * @property string $nama_lengkap
 * @property string $tanggal_lahir
 * @property string $tempat_lahir
 * @property string $jabatan_saat_ini
 * @property string $prospek_jabatan
 * @property string $golongan
 * @property string $jabatan
 * @property string $level
 * @property string $nip
 * @property string $pendidikan_terakhir
 * @property string $alamat
 * @property string $avatar
 * @property string $facebook
 * @property string $twitter
 * @property string $instagram
 */
class SetkabAssessee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setkab_assessee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id'], 'integer'],
            [['nama_lengkap', 'tanggal_lahir', 'tempat_lahir', 'jabatan_saat_ini', 'prospek_jabatan', 'golongan', 'jabatan', 'level', 'nip', 'pendidikan_terakhir', 'alamat', 'avatar', 'facebook', 'twitter', 'instagram'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'profile_id' => Yii::t('app', 'Profile ID'),
            'nama_lengkap' => Yii::t('app', 'Nama Lengkap'),
            'tanggal_lahir' => Yii::t('app', 'Tanggal Lahir'),
            'tempat_lahir' => Yii::t('app', 'Tempat Lahir'),
            'jabatan_saat_ini' => Yii::t('app', 'Jabatan Saat Ini'),
            'prospek_jabatan' => Yii::t('app', 'Prospek Jabatan'),
            'golongan' => Yii::t('app', 'Golongan'),
            'jabatan' => Yii::t('app', 'Jabatan'),
            'level' => Yii::t('app', 'Level'),
            'nip' => Yii::t('app', 'Nip'),
            'pendidikan_terakhir' => Yii::t('app', 'Pendidikan Terakhir'),
            'alamat' => Yii::t('app', 'Alamat'),
            'avatar' => Yii::t('app', 'Avatar'),
            'facebook' => Yii::t('app', 'Facebook'),
            'twitter' => Yii::t('app', 'Twitter'),
            'instagram' => Yii::t('app', 'Instagram'),
        ];
    }

    /**
     * @inheritdoc
     * @return SetkabAssesseeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SetkabAssesseeQuery(get_called_class());
    }
}
