<?php

namespace app\modules\edulab\controllers;

class CourseController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionStart($catalog_id)
    {
    	echo 'start';
    }

}
