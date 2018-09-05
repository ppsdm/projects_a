<?php

//namespace common\modules\profile\controllers;
namespace app\modules\edulab\controllers;
use common\models\Log;
use common\modules\profile\models\UserCredit;
use common\modules\profile\models\UserTransaction;
use yii\db\Expression;
use Yii;
use yii\data\ActiveDataProvider;

class CreditController extends \common\modules\profile\controllers\CreditController
{
    public function actionIndex()
    {

        $usertransactions_query = UserTransaction::find()->andWhere(['user_id' => Yii::$app->user->id]);


            $DataProvider = new ActiveDataProvider([
    'query' => $usertransactions_query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);


        $credit = UserCredit::find()->andWhere(['user_id' =>Yii::$app->user->id])->andWhere(['credit_type' => 'credit'])->andWhere(['status' => 'active'])->One();
        if (isset($credit->credit_point)) {

        } else {
                        $credit = new UserCredit();
            $credit->user_id = Yii::$app->user->id;
            $credit->credit_point = 0;
        }
        return $this->render('/credit/index', ['credit' => $credit,

            'dataProvider' => $DataProvider,
            ]);
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
