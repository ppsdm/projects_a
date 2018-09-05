<?php

namespace app\modules\projects\controllers\project_4;

class AssessmentController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDebug()
    {
        echo 'yuhu';
    }

    public function actionPrintreport($id)
    {

    }

    public function actionPrintblankreport($id)
    {
    	
    }

    public function actionPrintdisc($id)
    {

    }

    public function actionPrintprestatif($id)
    {

    }


}
