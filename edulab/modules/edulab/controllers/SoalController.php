<<<<<<< HEAD
<?php

namespace app\modules\edulab\controllers;
use app\assets\AppAsset;
use app\assets\EdulabAsset;
use app\assets\SoalAsset;
use common\modules\catalog\models\CatalogGeneral;
use common\modules\catalog\models\CatalogPrice;
use Yii;

use yii\helpers\Url;

class SoalController extends \yii\web\Controller
{
    public function actionIndex()
    {



    		//echo 'index';
        //return $this->render('index');
    }

    public function actionStart($catalog_id)
    {
        $catalog_item = CatalogGeneral::findOne($catalog_id);
$assetmanager = Yii::$app->assetManager;

try {
$path = $assetmanager->publish($catalog_item->pathUrl);
$this->redirect($path[1]);
} catch (\Exception $e) {
          Yii::$app->session->setFlash('danger', $e->getMessage());

          echo $e->getMessage();
  // return $this->redirect(Yii::$app->request->referrer);

}

    }

}
=======
<?php

namespace app\modules\edulab\controllers;
use app\assets\AppAsset;
use app\assets\EdulabAsset;
use app\assets\SoalAsset;
use common\modules\catalog\models\CatalogGeneral;
use common\modules\catalog\models\CatalogPrice;
use Yii;

use yii\helpers\Url;

class SoalController extends \yii\web\Controller
{
    public function actionIndex()
    {



    		//echo 'index';
        //return $this->render('index');
    }

    public function actionStart($catalog_id)
    {
        $catalog_item = CatalogGeneral::findOne($catalog_id);
$assetmanager = Yii::$app->assetManager;

try {
$path = $assetmanager->publish($catalog_item->pathUrl);
$this->redirect($path[1]);
} catch (\Exception $e) {
          Yii::$app->session->setFlash('danger', $e->getMessage());

          echo $e->getMessage();
  // return $this->redirect(Yii::$app->request->referrer);

}

    }

}
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
