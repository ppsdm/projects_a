<<<<<<< HEAD
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
?>
<style type="text/css">
.alert {
  border-radius: 0;
  -webkit-border-radius: 0;
  box-shadow: 0 1px 2px rgba(0,0,0,0.11);
  display: table;
  width: 100%;
}

.alert-white {
  background-image: linear-gradient(to bottom, #fff, #f9f9f9);
  border-top-color: #d8d8d8;
  border-bottom-color: #bdbdbd;
  border-left-color: #cacaca;
  border-right-color: #cacaca;
  color: #404040;
  padding-left: 61px;
  position: relative;
}

.alert-white.rounded {
  border-radius: 3px;
  -webkit-border-radius: 3px;
}

.alert-white.rounded .icon {
  border-radius: 3px 0 0 3px;
  -webkit-border-radius: 3px 0 0 3px;
}

.alert-white .icon {
  text-align: center;
  width: 45px;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  border: 1px solid #bdbdbd;
  padding-top: 15px;
}


.alert-white .icon:after {
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg);
  display: block;
  content: '';
  width: 10px;
  height: 10px;
  border: 1px solid #bdbdbd;
  position: absolute;
  border-left: 0;
  border-bottom: 0;
  top: 50%;
  right: -6px;
  margin-top: -3px;
  background: #fff;
}

.alert-white .icon i {
  font-size: 20px;
  color: #fff;
  left: 12px;
  margin-top: -10px;
  position: absolute;
  top: 50%;
}
/*============ colors ========*/
.alert-success {
  color: #3c763d;
  background-color: #dff0d8;
  border-color: #d6e9c6;
}

.alert-white.alert-success .icon, 
.alert-white.alert-success .icon:after {
  border-color: #54a754;
  background: #60c060;
}

.alert-info {
  background-color: #d9edf7;
  border-color: #98cce6;
  color: #3a87ad;
}

.alert-white.alert-info .icon, 
.alert-white.alert-info .icon:after {
  border-color: #3a8ace;
  background: #4d90fd;
}


.alert-white.alert-warning .icon, 
.alert-white.alert-warning .icon:after {
  border-color: #d68000;
  background: #fc9700;
}

.alert-warning {
  background-color: #fcf8e3;
  border-color: #f1daab;
  color: #c09853;
}

.alert-danger {
  background-color: #f2dede;
  border-color: #e0b1b8;
  color: #b94a48;
}

.alert-white.alert-danger .icon, 
.alert-white.alert-danger .icon:after {
  border-color: #ca452e;
  background: #da4932;
}
</style>

      



<div class="container bootstrap snippet">

    <div class="alert alert-info alert-white rounded">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
        <div class="icon">
            <i class="fa fa-info-circle"></i>
        </div>

          <strong><?=$model->message->type?>!</strong> 
			<?php
			echo Html::a('<h3 class="title block no-margin">'. 
				$model->message->message.'</h3>', ['/edulab/message/read?id='.$model->message->id], ['class'=>'']);
			echo Yii::$app->formatter->asDate($model->created_at);

			?>
		</div>
	</div>								

=======
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
?>
<style type="text/css">
.alert {
  border-radius: 0;
  -webkit-border-radius: 0;
  box-shadow: 0 1px 2px rgba(0,0,0,0.11);
  display: table;
  width: 100%;
}

.alert-white {
  background-image: linear-gradient(to bottom, #fff, #f9f9f9);
  border-top-color: #d8d8d8;
  border-bottom-color: #bdbdbd;
  border-left-color: #cacaca;
  border-right-color: #cacaca;
  color: #404040;
  padding-left: 61px;
  position: relative;
}

.alert-white.rounded {
  border-radius: 3px;
  -webkit-border-radius: 3px;
}

.alert-white.rounded .icon {
  border-radius: 3px 0 0 3px;
  -webkit-border-radius: 3px 0 0 3px;
}

.alert-white .icon {
  text-align: center;
  width: 45px;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  border: 1px solid #bdbdbd;
  padding-top: 15px;
}


.alert-white .icon:after {
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg);
  display: block;
  content: '';
  width: 10px;
  height: 10px;
  border: 1px solid #bdbdbd;
  position: absolute;
  border-left: 0;
  border-bottom: 0;
  top: 50%;
  right: -6px;
  margin-top: -3px;
  background: #fff;
}

.alert-white .icon i {
  font-size: 20px;
  color: #fff;
  left: 12px;
  margin-top: -10px;
  position: absolute;
  top: 50%;
}
/*============ colors ========*/
.alert-success {
  color: #3c763d;
  background-color: #dff0d8;
  border-color: #d6e9c6;
}

.alert-white.alert-success .icon, 
.alert-white.alert-success .icon:after {
  border-color: #54a754;
  background: #60c060;
}

.alert-info {
  background-color: #d9edf7;
  border-color: #98cce6;
  color: #3a87ad;
}

.alert-white.alert-info .icon, 
.alert-white.alert-info .icon:after {
  border-color: #3a8ace;
  background: #4d90fd;
}


.alert-white.alert-warning .icon, 
.alert-white.alert-warning .icon:after {
  border-color: #d68000;
  background: #fc9700;
}

.alert-warning {
  background-color: #fcf8e3;
  border-color: #f1daab;
  color: #c09853;
}

.alert-danger {
  background-color: #f2dede;
  border-color: #e0b1b8;
  color: #b94a48;
}

.alert-white.alert-danger .icon, 
.alert-white.alert-danger .icon:after {
  border-color: #ca452e;
  background: #da4932;
}
</style>

      



<div class="container bootstrap snippet">

    <div class="alert alert-info alert-white rounded">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
        <div class="icon">
            <i class="fa fa-info-circle"></i>
        </div>

          <strong><?=$model->message->type?>!</strong> 
			<?php
			echo Html::a('<h3 class="title block no-margin">'. 
				$model->message->message.'</h3>', ['/edulab/message/read?id='.$model->message->id], ['class'=>'']);
			echo Yii::$app->formatter->asDate($model->created_at);

			?>
		</div>
	</div>								

>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
