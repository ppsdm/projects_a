<<<<<<< HEAD
<?php

namespace app\modules\edulab\controllers;
use common\modules\core\models\Message;
use common\models\Notification;

use Yii;

class MessageController extends \common\modules\core\controllers\MessageController {
    public function actionIndex()
    {
        $query = Notification::find()->andWhere(['user_id' => Yii::$app->user->id]);
        return $this->render('index', 
        [
            'query' => $query,
        ]);
    }

    public function actionRead($id)
    {

    	$model = Message::findOne($id);
        return $this->render('read', 
        [
            'model' => $model,
        ]);
    }
}
=======
<?php

namespace app\modules\edulab\controllers;
use common\modules\core\models\Message;
use common\models\Notification;

use Yii;

class MessageController extends \common\modules\core\controllers\MessageController {
    public function actionIndex()
    {
        $query = Notification::find()->andWhere(['user_id' => Yii::$app->user->id]);
        return $this->render('index', 
        [
            'query' => $query,
        ]);
    }

    public function actionRead($id)
    {

    	$model = Message::findOne($id);
        return $this->render('read', 
        [
            'model' => $model,
        ]);
    }
}
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
