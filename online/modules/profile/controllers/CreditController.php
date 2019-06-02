<<<<<<< HEAD
<?php

namespace app\modules\profile\controllers;
use app\models\Log;
use yii\db\Expression;
use Yii;

class CreditController extends \yii\web\Controller
{
    public function actionIndex()
    {


        return $this->render('/profile/index');
    }

            public function beforeAction($action) {

  Log::add(Yii::$app->controller->id, $action->id,'activity');
    if (Yii::$app->session->has('lang')) {
        Yii::$app->language = Yii::$app->session->get('lang');
    } else {
        //or you may want to set lang session, this is just a sample
        //Yii::$app->language = 'us';
    }
    return parent::beforeAction($action);
}





}
=======
<?php

namespace app\modules\profile\controllers;
use app\models\Log;
use yii\db\Expression;
use Yii;

class CreditController extends \yii\web\Controller
{
    public function actionIndex()
    {


        return $this->render('/profile/index');
    }

            public function beforeAction($action) {

  Log::add(Yii::$app->controller->id, $action->id,'activity');
    if (Yii::$app->session->has('lang')) {
        Yii::$app->language = Yii::$app->session->get('lang');
    } else {
        //or you may want to set lang session, this is just a sample
        //Yii::$app->language = 'us';
    }
    return parent::beforeAction($action);
}





}
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
