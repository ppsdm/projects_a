<<<<<<< HEAD
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;
use common\modules\profile\models\ProfileExtended;
use common\modules\profile\models\ProfileGeneral;
//$this->title = 'SiapNgampus.com';
//$this->params['breadcrumbs'][] = $this->title;
$avatarmodel = ProfileExtended::find()
->andWhere(['user_id'=>Yii::$app->user->id])
->andWhere(['type'=>'profile-extended'])
->andWhere(['key'=>'avatar']) 
->One();
if (!isset($avatarmodel->value)){
  $pp = "icon-member.gif";
}
  else{
  $pp = Yii::$app->user->id."_".$avatarmodel->value;
  }

$name = ProfileGeneral::findOne(Yii::$app->user->id); 
if (null == $name) {
  $name = new ProfileGeneral;
}

$edulab_id = ProfileExtended::find()
->andWhere(['user_id'=>Yii::$app->user->id])
->andWhere(['type'=>'edulab'])
->andWhere(['key'=>'id']) 
->One();
if (!isset($edulab_id->value)){
  $ed_id = "<a href='../profile/profile#edulab' class='btn btn-warning' role='button'>pilih</a>";
}
  else{
  $ed_id = $edulab_id->value;
  }

$edulab_location = ProfileExtended::find()
->andWhere(['user_id'=>Yii::$app->user->id])
->andWhere(['type'=>'edulab'])
->andWhere(['key'=>'location']) 
->One();
if (!isset($edulab_location->value)){
  $location = "<a href='../profile/profile#edulab' class='btn btn-warning' role='button'>pilih</a>";
}
  else{
  $location = $edulab_location->value;
  }

$ed_level = ProfileExtended::find()
->andWhere(['user_id'=>Yii::$app->user->id])
->andWhere(['type'=>'edulab'])
->andWhere(['key'=>'ed_level']) 
->One();
if (!isset($ed_level->value)){
  $ed = "<a href='../profile/profile#edulab' class='btn btn-warning' role='button'>pilih</a>";
}
  else{
  $ed = $ed_level->value;
  }
?>
<header class="image-bg-fluid-height">
        <!--img class="img-responsive img-center" src="http://placehold.it/200x200&text=Logo" alt=""---->

</header>
<div class="container" style="margin-top: 20px">
<div class="row">
  <div class="col-xs-6 col-md-4">
     <div class="mb">
              <div class="content-panel">
                <div id="profile-02">
                  <div class="user">
                    <img style="border: 4px solid rgba(255, 255, 255, .2);" src="<?=Yii::$app->request->baseUrl.'/uploads/';?><?=$pp;?>" class="img-circle" width="80">
                    <h4><?=$name->first_name;?> <?=$name->last_name;?></h4>
                  </div>
                </div>
                <div class="pr2-social centered">
                  <a href="#"><i class="glyphicon glyphicon-twitter"></i></a>
                  <a href="#"><i class="fa fa-facebook"></i></a>
                  <a href="#"><i class="fa fa-dribbble"></i></a>

                </div>
                <div style="padding-left: 15px;">
                EDULAB ID </br><b><?=$ed_id;?></b></div>
              </br>
                <div style="padding-left: 15px;">
                EDULAB Location </br><b><?=$location;?></b></div>
              </br>
                <div style="padding-left: 15px;">
                Education Level </br><b><?=$ed;?></b></div>
              <hr>
              </div>

              <! --/panel -->
            </div><!--/ col-md-4 -->
  </div>
  <div class="col-xs-12 col-md-8">

              <!-- Product Panel -->

            <div class="col-xs-6 mb">
              <div class="product-panel-2 pn-index">
                <div class="badge badge-hot pn-index">BARU</div>
               <?= Html::img('http://cdn.playbuzz.com/cdn/aff6e446-b51a-491d-837d-768c87cea6d3/215f138c-1ac0-47ac-8b74-93fd9476db47.png', ['width' => '100%', 'class' => 'pn-index-content']) ?>
                <h3 class="mt yellow-tittle"><B>Latihan Interaktif</B></h3>
                <div class="row">
                  <div class="col-md-6"><h6>Total Soal: 1388</h6></div>
                  <div class="col-md-6">
                  <?= Html::a('Lihat Semua',['/edulab/edulab/exercise'],['class'=>'btn btn-small btn-theme03']); ?>
                  </div>
                </div>
              </div>
            </div><! --/col-md-4 -->

            <div class="col-xs-6 mb">
              <div class="product-panel-2 pn-index">
                <div class="badge badge-hot pn-index">BARU</div>
               <?= Html::img('http://cdn.playbuzz.com/cdn/aff6e446-b51a-491d-837d-768c87cea6d3/215f138c-1ac0-47ac-8b74-93fd9476db47.png', ['width' => '100%', 'class' => 'pn-index-content']) ?>
                <h3 class="mt yellow-tittle"><B>UJIAN & TRYOUT</B></h3>
                <div class="row">
                  <div class="col-md-6"><h6>Total Soal: 1388</h6></div>
                  <div class="col-md-6">
                  <?= Html::a('Lihat Semua',['/edulab/edulab/assessment'],['class'=>'btn btn-small btn-theme03']); ?>
                  </div>
                </div>
              </div>
            </div><! --/col-md-4 -->

      <!-- Product Panel -->
            <div class="col-xs-6 mb">
              <div class="product-panel-2 pn-index">
                <?= Html::img('http://www.wallpaperup.com/uploads/wallpapers/2014/04/09/328144/big_thumb_9de731df4c12837bc274cbd405bd02b6.jpg', ['width' => '100%', 'class' => 'pn-index-content']) ?>
                <h3 class="mt yellow-tittle"><B>BANK SOAL</B></h3>
                <div class="row">
                  <div class="col-md-6"><h6>Total Soal: 1388</h6></div>
                  <div class="col-md-6">
                  <?= Html::a('Lihat Semua',['/edulab/edulab/soal'],['class'=>'btn btn-small btn-theme03']); ?>
                  </div>
                </div>
              </div>
            </div><! --/col-md-4 -->
             <!-- Product Panel -->

            <div class="col-xs-6 mb">
              <div class="product-panel-2 pn-index">
                <?= Html::img('http://blog.a-b-c.com/wp-content/uploads/2014/08/Digital-Solutions-for-Healthcare-Organizations-2.jpg', ['width' => '100%', 'class' => 'pn-index-content']) ?>
                <h3 class="mt yellow-tittle"><B>VIDEO</B></h3>
                <div class="row">
                  <div class="col-md-6"><h6>Total Soal: 968</h6></div>
                  <div class="col-md-6">
          <?= Html::a('Lihat Semua',['/edulab/edulab/video'],['class'=>'btn btn-small btn-theme03']); ?>
                  </div>
                </div>
              </div>
            </div><! --/col-md-4 -->

             <!-- Product Panel -->

            <div class="col-xs-6 mb">
              <div class="product-panel-2 pn-index">
                <?= Html::img('http://employers.edevate.com/wordpress/wp-content/uploads/2016/06/Nutrition-for-school-learning-pic1.jpg', ['width' => '100%', 'class' => 'pn-index-content']) ?>
                <h3 class="mt yellow-tittle"><B>Materi</B></h3>
                <div class="row">
                  <div class="col-md-6"><h6>Total Soal: 2589</h6></div>
                  <div class="col-md-6">
          <?= Html::a('Lihat Semua',['/edulab/edulab/materi'],['class'=>'btn btn-small btn-theme03']); ?>
                  </div>
                </div>
              </div>
            </div><! --/col-md-4 -->

                        <div class="col-xs-6 mb">
              <div class="product-panel-2 pn-index">
                <?= Html::img('http://www.targetdhr.com/wp-content/uploads//2014/08/psychometric-testing1.png', ['width' => '100%', 'class' => 'pn-index-content']) ?>
                <h3 class="mt yellow-tittle"><B>Bakat & Minat</B></h3>
                <div class="row">
                  <div class="col-md-6"><h6>Total Soal: 2589</h6></div>
                  <div class="col-md-6">
          <?= Html::a('Lihat Semua',['/edulab/edulab/materi'],['class'=>'btn btn-small btn-theme03']); ?>
                  </div>
                </div>
              </div>
            </div><! --/col-md-4 -->



  </div>
</div>
</div>
=======
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;
use common\modules\profile\models\ProfileExtended;
use common\modules\profile\models\ProfileGeneral;
//$this->title = 'SiapNgampus.com';
//$this->params['breadcrumbs'][] = $this->title;
$avatarmodel = ProfileExtended::find()
->andWhere(['user_id'=>Yii::$app->user->id])
->andWhere(['type'=>'profile-extended'])
->andWhere(['key'=>'avatar']) 
->One();
if (!isset($avatarmodel->value)){
  $pp = "icon-member.gif";
}
  else{
  $pp = Yii::$app->user->id."_".$avatarmodel->value;
  }

$name = ProfileGeneral::findOne(Yii::$app->user->id); 
if (null == $name) {
  $name = new ProfileGeneral;
}

$edulab_id = ProfileExtended::find()
->andWhere(['user_id'=>Yii::$app->user->id])
->andWhere(['type'=>'edulab'])
->andWhere(['key'=>'id']) 
->One();
if (!isset($edulab_id->value)){
  $ed_id = "<a href='../profile/profile#edulab' class='btn btn-warning' role='button'>pilih</a>";
}
  else{
  $ed_id = $edulab_id->value;
  }

$edulab_location = ProfileExtended::find()
->andWhere(['user_id'=>Yii::$app->user->id])
->andWhere(['type'=>'edulab'])
->andWhere(['key'=>'location']) 
->One();
if (!isset($edulab_location->value)){
  $location = "<a href='../profile/profile#edulab' class='btn btn-warning' role='button'>pilih</a>";
}
  else{
  $location = $edulab_location->value;
  }

$ed_level = ProfileExtended::find()
->andWhere(['user_id'=>Yii::$app->user->id])
->andWhere(['type'=>'edulab'])
->andWhere(['key'=>'ed_level']) 
->One();
if (!isset($ed_level->value)){
  $ed = "<a href='../profile/profile#edulab' class='btn btn-warning' role='button'>pilih</a>";
}
  else{
  $ed = $ed_level->value;
  }
?>
<header class="image-bg-fluid-height">
        <!--img class="img-responsive img-center" src="http://placehold.it/200x200&text=Logo" alt=""---->

</header>
<div class="container" style="margin-top: 20px">
<div class="row">
  <div class="col-xs-6 col-md-4">
     <div class="mb">
              <div class="content-panel">
                <div id="profile-02">
                  <div class="user">
                    <img style="border: 4px solid rgba(255, 255, 255, .2);" src="<?=Yii::$app->request->baseUrl.'/uploads/';?><?=$pp;?>" class="img-circle" width="80">
                    <h4><?=$name->first_name;?> <?=$name->last_name;?></h4>
                  </div>
                </div>
                <div class="pr2-social centered">
                  <a href="#"><i class="glyphicon glyphicon-twitter"></i></a>
                  <a href="#"><i class="fa fa-facebook"></i></a>
                  <a href="#"><i class="fa fa-dribbble"></i></a>

                </div>
                <div style="padding-left: 15px;">
                EDULAB ID </br><b><?=$ed_id;?></b></div>
              </br>
                <div style="padding-left: 15px;">
                EDULAB Location </br><b><?=$location;?></b></div>
              </br>
                <div style="padding-left: 15px;">
                Education Level </br><b><?=$ed;?></b></div>
              <hr>
              </div>

              <! --/panel -->
            </div><!--/ col-md-4 -->
  </div>
  <div class="col-xs-12 col-md-8">

              <!-- Product Panel -->

            <div class="col-xs-6 mb">
              <div class="product-panel-2 pn-index">
                <div class="badge badge-hot pn-index">BARU</div>
               <?= Html::img('http://cdn.playbuzz.com/cdn/aff6e446-b51a-491d-837d-768c87cea6d3/215f138c-1ac0-47ac-8b74-93fd9476db47.png', ['width' => '100%', 'class' => 'pn-index-content']) ?>
                <h3 class="mt yellow-tittle"><B>Latihan Interaktif</B></h3>
                <div class="row">
                  <div class="col-md-6"><h6>Total Soal: 1388</h6></div>
                  <div class="col-md-6">
                  <?= Html::a('Lihat Semua',['/edulab/edulab/exercise'],['class'=>'btn btn-small btn-theme03']); ?>
                  </div>
                </div>
              </div>
            </div><! --/col-md-4 -->

            <div class="col-xs-6 mb">
              <div class="product-panel-2 pn-index">
                <div class="badge badge-hot pn-index">BARU</div>
               <?= Html::img('http://cdn.playbuzz.com/cdn/aff6e446-b51a-491d-837d-768c87cea6d3/215f138c-1ac0-47ac-8b74-93fd9476db47.png', ['width' => '100%', 'class' => 'pn-index-content']) ?>
                <h3 class="mt yellow-tittle"><B>UJIAN & TRYOUT</B></h3>
                <div class="row">
                  <div class="col-md-6"><h6>Total Soal: 1388</h6></div>
                  <div class="col-md-6">
                  <?= Html::a('Lihat Semua',['/edulab/edulab/assessment'],['class'=>'btn btn-small btn-theme03']); ?>
                  </div>
                </div>
              </div>
            </div><! --/col-md-4 -->

      <!-- Product Panel -->
            <div class="col-xs-6 mb">
              <div class="product-panel-2 pn-index">
                <?= Html::img('http://www.wallpaperup.com/uploads/wallpapers/2014/04/09/328144/big_thumb_9de731df4c12837bc274cbd405bd02b6.jpg', ['width' => '100%', 'class' => 'pn-index-content']) ?>
                <h3 class="mt yellow-tittle"><B>BANK SOAL</B></h3>
                <div class="row">
                  <div class="col-md-6"><h6>Total Soal: 1388</h6></div>
                  <div class="col-md-6">
                  <?= Html::a('Lihat Semua',['/edulab/edulab/soal'],['class'=>'btn btn-small btn-theme03']); ?>
                  </div>
                </div>
              </div>
            </div><! --/col-md-4 -->
             <!-- Product Panel -->

            <div class="col-xs-6 mb">
              <div class="product-panel-2 pn-index">
                <?= Html::img('http://blog.a-b-c.com/wp-content/uploads/2014/08/Digital-Solutions-for-Healthcare-Organizations-2.jpg', ['width' => '100%', 'class' => 'pn-index-content']) ?>
                <h3 class="mt yellow-tittle"><B>VIDEO</B></h3>
                <div class="row">
                  <div class="col-md-6"><h6>Total Soal: 968</h6></div>
                  <div class="col-md-6">
          <?= Html::a('Lihat Semua',['/edulab/edulab/video'],['class'=>'btn btn-small btn-theme03']); ?>
                  </div>
                </div>
              </div>
            </div><! --/col-md-4 -->

             <!-- Product Panel -->

            <div class="col-xs-6 mb">
              <div class="product-panel-2 pn-index">
                <?= Html::img('http://employers.edevate.com/wordpress/wp-content/uploads/2016/06/Nutrition-for-school-learning-pic1.jpg', ['width' => '100%', 'class' => 'pn-index-content']) ?>
                <h3 class="mt yellow-tittle"><B>Materi</B></h3>
                <div class="row">
                  <div class="col-md-6"><h6>Total Soal: 2589</h6></div>
                  <div class="col-md-6">
          <?= Html::a('Lihat Semua',['/edulab/edulab/materi'],['class'=>'btn btn-small btn-theme03']); ?>
                  </div>
                </div>
              </div>
            </div><! --/col-md-4 -->

                        <div class="col-xs-6 mb">
              <div class="product-panel-2 pn-index">
                <?= Html::img('http://www.targetdhr.com/wp-content/uploads//2014/08/psychometric-testing1.png', ['width' => '100%', 'class' => 'pn-index-content']) ?>
                <h3 class="mt yellow-tittle"><B>Bakat & Minat</B></h3>
                <div class="row">
                  <div class="col-md-6"><h6>Total Soal: 2589</h6></div>
                  <div class="col-md-6">
          <?= Html::a('Lihat Semua',['/edulab/edulab/materi'],['class'=>'btn btn-small btn-theme03']); ?>
                  </div>
                </div>
              </div>
            </div><! --/col-md-4 -->



  </div>
</div>
</div>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
