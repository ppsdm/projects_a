<?php
use yii\helpers\Html;
use common\modules\assessment\models\Assessment;
use common\modules\assessment\models\AssessmentResult;
use common\modules\catalog\models\CatalogGeneral;
//use common\modules\profile\models\ProfileExtended;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\assets\AppAsset;
use app\assets\EdulabAsset;
use yii\bootstrap\Modal;
use yii\helpers\Url;

AppAsset::register($this);
EdulabAsset::register($this);

$edulab = CatalogGeneral::find()
->andWhere(['id'=>$model->subject])
->andWhere(['type'=>'video-series-items'])
->andWhere(['status'=>'active']) 
->One();

//echo $model->subject;
//echo '<br/>';


?>

  <! -- Spotify Panel -->
  <div class="col-lg-4 col-md-4 col-sm-4 mb" data-director="adel">
    <div class="content-panel pn"  style="margin-bottom: 20px;">
      <div id="spotify">
        <div class="embed-responsive embed-responsive-16by9 pnv">
            <iframe class="embed-responsive-item" src="<?php echo $edulab->pathUrl; ?>?rel=0&amp;controls=0&amp;showinfo=0" allowfullscreen></iframe>
        </div> 
      </div>
      <div class="text-center"><B><?=$edulab->name; ?></B>
      </div>
    </div>
  </div><! --/col-md-4-->
