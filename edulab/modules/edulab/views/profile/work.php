<<<<<<< HEAD
<?php

use yii\helpers\Html;
use kartik\sidenav\SideNav;


/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileGeneral */

$this->title = Yii::t('app', 'Edulab');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile Generals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <p>
     <ul class="nav nav-tabs">
  <li role="presentation" class="active">
 <?= Html::a(Yii::t('app', 'Profile'), ['/edulab/cats/profile'], ['class' => 'btn btn-info']) ?>

  </li>
  <li role="presentation">
 <?= Html::a(Yii::t('app', 'Contacts'), ['/edulab/profile/contacts'], ['class' => 'btn btn-info']) ?>


</li>
  <li role="presentation">
 <?= Html::a(Yii::t('app', 'Education'), ['/edulab/profile/education'], ['class' => 'btn btn-info']) ?>


</li>
  <li role="presentation">
 <?= Html::a(Yii::t('app', 'Edulab'), ['/edulab/profile/edulab'], ['class' => 'btn btn-info']) ?>


</li>
</ul>

    </p>
    


<div class="profile-general-update">





</div>
=======
<?php

use yii\helpers\Html;
use kartik\sidenav\SideNav;


/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileGeneral */

$this->title = Yii::t('app', 'Edulab');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile Generals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <p>
     <ul class="nav nav-tabs">
  <li role="presentation" class="active">
 <?= Html::a(Yii::t('app', 'Profile'), ['/edulab/cats/profile'], ['class' => 'btn btn-info']) ?>

  </li>
  <li role="presentation">
 <?= Html::a(Yii::t('app', 'Contacts'), ['/edulab/profile/contacts'], ['class' => 'btn btn-info']) ?>


</li>
  <li role="presentation">
 <?= Html::a(Yii::t('app', 'Education'), ['/edulab/profile/education'], ['class' => 'btn btn-info']) ?>


</li>
  <li role="presentation">
 <?= Html::a(Yii::t('app', 'Edulab'), ['/edulab/profile/edulab'], ['class' => 'btn btn-info']) ?>


</li>
</ul>

    </p>
    


<div class="profile-general-update">





</div>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
