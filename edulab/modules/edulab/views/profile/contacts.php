<?php

use yii\helpers\Html;
use kartik\sidenav\SideNav;

use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileGeneral */

$this->title = Yii::t('app', 'Contacts');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile Generals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" style="margin-top: 20px">

    <p>

     <ul class="nav nav-tabs">
  <li role="presentation" >
 <?= Html::a(Yii::t('app', 'Profile'), ['/edulab/profile/profile'], ['class' => 'btn btn-info']) ?>

  </li>
  <li role="presentation" class="active">
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


    <?php $form = ActiveForm::begin(); ?>



  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
<?php
    echo Html::input('text','email',$email,['readonly' => true, 'class'=>'form-control', 'placeholder' => 'Email']);
?>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Mobile</label>
      <?php
    echo Html::input('text','mobile',$mobile,['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Mobile Phone']);
      ?>
  </div>


  <div class="form-group">
    <label for="exampleInputEmail1">Home Phone</label>
      <?php
    echo Html::input('text','home',$home,['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Home Phone']);
      ?>
  </div>

    <div class="form-group">
    <label for="exampleInputEmail1">Work Phone</label>
      <?php
    echo Html::input('text','work',$work,['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Work Phone']);
      ?>
  </div>


    <div class="form-group">
    <label for="exampleInputEmail1">Home Address</label>
      <?php
                echo Html::textArea('home_address',$home_address,['class'=>'form-control', 'rows' => '3']);
      ?>
  </div>

    <div class="form-group">
    <label for="exampleInputEmail1">Work Address</label>
      <?php
                echo Html::textArea('work_address',$work_address,['class'=>'form-control', 'rows' => '3']);
      ?>
  </div>


    <div class="form-group">
        <?= Html::submitButton( Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
</div>