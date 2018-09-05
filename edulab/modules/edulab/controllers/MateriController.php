<?php

namespace app\modules\edulab\controllers;
use app\assets\AppAsset;
use app\assets\EdulabAsset;
use app\assets\SoalAsset;
use common\modules\catalog\models\CatalogGeneral;
use common\modules\catalog\models\CatalogPrice;
use Yii;

use yii\base\Exception;

use yii\helpers\Url;
class MateriController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionMateri()
    {
      echo "materi";
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
