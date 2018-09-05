<?php


namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

use yii\imagine\Image;

class ImageUpload extends Model
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
            $this->imageFile->saveAs('uploads/' . Yii::$app->user->id . '_' . $this->imageFile->baseName . '.' . $this->imageFile->extension);

            Image::frame('uploads/' . Yii::$app->user->id . '_' . $this->imageFile->baseName . '.' . $this->imageFile->extension, 5, '666', 0)
    ->rotate(-8)
    ->save('uploads/rotated_' . Yii::$app->user->id . '_' . $this->imageFile->baseName . '.' . $this->imageFile->extension, ['jpeg_quality' => 50]);


            return true;
        } else {
            return false;
        }
    }
}

?>