<?php

namespace app\modules\projects\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property integer $id
 * @property integer $organization_id
 * @property string $name
 * @property string $status
 *
 * @property Activity[] $activities
 * @property Assessment[] $assessments
 * @property Organization $organization
        * @property string $description
 * @property ProjectMeta[] $projectMetas
 * @property UserProjectRole[] $userProjectRoles
 */
class Biodata extends \yii\db\ActiveRecord
{


    public $first_name;

    public $level;
    public $current_position;
    public $satuan_kerja;
    public $golongan;
    public $rumpun;
    public $nip;

    public $home_address;
    public $birthplace;
    public $latest_education;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['first_name', 'trim'],
            ['first_name', 'string', 'max' => 255],

            [['home_address', 'latest_education', 'current_position', 'nip','satuan_kerja','level','rumpun','golongan','birthplace'], 'string'],
        ];
    }



}
