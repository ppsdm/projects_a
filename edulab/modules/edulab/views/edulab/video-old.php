<<<<<<< HEAD
<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use yii\helpers\Html;
use app\assets\AppAsset;
use app\assets\SortAsset;

AppAsset::register($this);
SortAsset::register($this);

$this->title = 'Video';
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

    if ($value->type == 'video') {


?>
<li data-tag="<?=$value->tag;?>">
  <! -- Spotify Panel -->
  <div class="col-lg-4 col-md-4 col-sm-4 mb" data-director="adel">
    <div class="content-panel pn">
      <div id="spotify">
        <div class="embed-responsive embed-responsive-16by9 pnv">
            <iframe class="embed-responsive-item" src="<?php echo $value->pathUrl; ?>?rel=0&amp;controls=0&amp;showinfo=0" allowfullscreen></iframe>
        </div> 
        <div class="play">
            <i class="fa fa-play-circle"></i>
        </div>
      </div>
      <div class="text-center"><?php echo $value->name; ?></div>
    </div>
  </div><! --/col-md-4-->
</li>
<?php 
} else {


    if ($value->type == 'video-series') {


?>

<li data-tag="<?=$value->tag;?>">
  <! -- Spotify Panel -->
  <div class="col-lg-4 col-md-4 col-sm-4 mb" data-director="adel">
    <div class="content-panel pn" style="background-image: url('<?=$value->imageUrl;?>'); background-size: 100% 100%;">
      <div id="">
        <div class="embed-responsive embed-responsive-16by9 pnv">
            <div class="hilight">
              <p class="col-xs-8 padding-10 text-left text-white" style="font-size: 12px"><?php echo $value->name; ?></p>
              <p class="col-xs-4 padding-10 text-center text-white" style="color: red;"><strong>50</strong></p>
              <div style="font-size: 10px;">Sample text</div>
       
            </div>

        </div> 
         <div class="clearfix no-padding"><h5>
            <a href="" class="col-xs-8 padding-10 text-center text-white" style="background-color: rgba(0,191,255,0.50);">
            <i class="fa fa-info"></i> Info</a>
          
            <a id="" href="<?php echo 'videoseries?id=' . $value->id;?>" class="col-xs-4 padding-10 text-center text-white" style="background-color: rgba(255,0,0,0.50);"><i class="fa fa-play"></i></a></h5>
          </div>
      </div>
    </div>
  </div><! --/col-md-4-->
</li>
<?php 
}

}
} ?>
</ul>
</div>
  <div class="col-md-3 col-md-pull-9">
      <div id="placeHolder"></div>
  </div>
</div>
=======
<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use yii\helpers\Html;
use app\assets\AppAsset;
use app\assets\SortAsset;

AppAsset::register($this);
SortAsset::register($this);

$this->title = 'Video';
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

    if ($value->type == 'video') {


?>
<li data-tag="<?=$value->tag;?>">
  <! -- Spotify Panel -->
  <div class="col-lg-4 col-md-4 col-sm-4 mb" data-director="adel">
    <div class="content-panel pn">
      <div id="spotify">
        <div class="embed-responsive embed-responsive-16by9 pnv">
            <iframe class="embed-responsive-item" src="<?php echo $value->pathUrl; ?>?rel=0&amp;controls=0&amp;showinfo=0" allowfullscreen></iframe>
        </div> 
        <div class="play">
            <i class="fa fa-play-circle"></i>
        </div>
      </div>
      <div class="text-center"><?php echo $value->name; ?></div>
    </div>
  </div><! --/col-md-4-->
</li>
<?php 
} else {


    if ($value->type == 'video-series') {


?>

<li data-tag="<?=$value->tag;?>">
  <! -- Spotify Panel -->
  <div class="col-lg-4 col-md-4 col-sm-4 mb" data-director="adel">
    <div class="content-panel pn" style="background-image: url('<?=$value->imageUrl;?>'); background-size: 100% 100%;">
      <div id="">
        <div class="embed-responsive embed-responsive-16by9 pnv">
            <div class="hilight">
              <p class="col-xs-8 padding-10 text-left text-white" style="font-size: 12px"><?php echo $value->name; ?></p>
              <p class="col-xs-4 padding-10 text-center text-white" style="color: red;"><strong>50</strong></p>
              <div style="font-size: 10px;">Sample text</div>
       
            </div>

        </div> 
         <div class="clearfix no-padding"><h5>
            <a href="" class="col-xs-8 padding-10 text-center text-white" style="background-color: rgba(0,191,255,0.50);">
            <i class="fa fa-info"></i> Info</a>
          
            <a id="" href="<?php echo 'videoseries?id=' . $value->id;?>" class="col-xs-4 padding-10 text-center text-white" style="background-color: rgba(255,0,0,0.50);"><i class="fa fa-play"></i></a></h5>
          </div>
      </div>
    </div>
  </div><! --/col-md-4-->
</li>
<?php 
}

}
} ?>
</ul>
</div>
  <div class="col-md-3 col-md-pull-9">
      <div id="placeHolder"></div>
  </div>
</div>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
</div>