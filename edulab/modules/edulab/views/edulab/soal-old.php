<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use app\assets\AppAsset;
use app\assets\SortAsset;

AppAsset::register($this);
SortAsset::register($this);

$this->title = 'Latihan Soal';
$this->params['breadcrumbs'][] = $this->title;

?>
<!--div style="background-color: rgba(0, 0, 0, .9); position: fixed; z-index: 9999; width: 100%; height: 100%; text-align: center; vertical-align: middle;"></br>
<img width="60%" src="http://www.freepngimg.com/download/coming_soon/4-2-coming-soon-png.png">
</div-->
<div class="container">
<div class="row" style="margin-top: 20px">
<div class="col-md-9 col-md-push-3">
<ul id="container">
<?php
  foreach ($model as $key => $value) {
?>
<li data-genre="zenner" data-main-actors="benazio" data-director="adel">
  <! -- Spotify Panel -->
  <div class="col-lg-3 col-md-4 col-sm-4 mb" data-director="adel">
    <div class="content-panel pnm-out">
      <div id="spotify">
        <div class="embed-responsive embed-responsive-16by9 pnm">
            <img class="embed-responsive-item" src="<?php echo $value->imageUrl; ?>"/>
        </div> 
        <div class="play">
            <i class="fa fa-play-circle"></i>
        </div>
      </div>
      <div class="text-center"><?php echo $value->name; ?></div>
    </div>
  </div><! --/col-md-4-->
</li>
<?php } ?>
</ul>
</div>
  <div class="col-md-3 col-md-pull-9">
      <div id="placeHolder"></div>
  </div>
</div>
</div>