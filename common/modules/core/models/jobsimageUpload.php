<<<<<<< HEAD
<?php


namespace common\modules\core\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

use yii\helpers\Url;

class jobsImageUpload extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $url = 'jobs/images/' . Yii::$app->user->id . '_' . time() . '_' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs('jobs/images/' . Yii::$app->user->id . '_' . time() . '_' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return Url::to('@web/' . $url);
            return true;
        } else {
            return false;
        }
    }
}

=======
<?php


namespace common\modules\core\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

use yii\helpers\Url;

class jobsImageUpload extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $url = 'jobs/images/' . Yii::$app->user->id . '_' . time() . '_' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs('jobs/images/' . Yii::$app->user->id . '_' . time() . '_' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return Url::to('@web/' . $url);
            return true;
        } else {
            return false;
        }
    }
}

>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
?>