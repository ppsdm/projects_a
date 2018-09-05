<?php

use yii\helpers\Html;

use kartik\sidenav\SideNav;
use yii\widgets\ActiveForm;

$formatter = \Yii::$app->formatter;
/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileGeneral */

//$this->title = Yii::t('app', 'Profile');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile Generals'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
if ($avatarmodel->value == null){
  $pp = "icon-member.gif";
}
  else{
  $pp = $avatarmodel->value;
  }
?>
<div class="container">

<div class="container">
  <div class="row" style="padding-bottom: 20px;">

      <div class="image-bg-fluid-height">
      <div class="col-sm-10" style="padding:25px;">

      <img style="width: 130px;border: 4px solid rgba(255, 255, 255, .2);" title="profile image" class="img-circle img-responsive" src="<?=Yii::$app->request->baseUrl;?>/uploads/avatars/<?PHP echo $pp; ?>">

      </div>
      <div class="col-sm-2">
  </div>         
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3"><!--left col-->
              
          <ul class="list-group">
            <li class="list-group-item text-muted"><h3><b><?= $model->first_name." ".$model->last_name; ?></b></h3></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>User ID</strong></span> <?= $model->user_id; ?></li>
  <li class="list-group-item text-right"><span class="pull-left"><strong>Username</strong></span> <?= Yii::$app->user->identity->username; ?><br/> <?= Html::a('(Change)', ['edulab/changeusername'], ['class' => 'profile-link']) ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Email</strong></span> <?= $formatter->asEmail($email); ?><?= isset($email_verification->status) ? '(' . $email_verification->status . ') <br/>'. Html::a('Resend Verification', ['edulab/resendverification','email' => $email], ['class' => 'profile-link']) : ''; ?><br/> <?= Html::a('(Change)', ['edulab/changeemail'], ['class' => 'profile-link']) ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Birthdate</strong></span> <?= $formatter->asDate($model->birthdate); ?></li>
  <li class="list-group-item text-right"><span class="pull-left"></span><?= Html::a('Change Password', ['edulab/changepassword'], ['class' => '']) ?></li>
    
            <li><hr/></li>
                        <li class="list-group-item text-muted"><h4>Forum Setting</h4></li>
                  <li class="list-group-item text-right"><span class="pull-left"><strong>TimeZone</strong></span>Asia/Jakarta</li>
                  <li class="list-group-item text-right"><span class="pull-left"><strong>Location</strong></span>Indonesia</li>
            
          </ul> 
          
        </div><!--/col-3-->
      <div class="col-sm-9">
          
          <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
            <li><a href="#contact" data-toggle="tab">Contact</a></li>
            <li><a href="#edulab" data-toggle="tab">Edulab</a></li>
                        <li><a href="#forum" data-toggle="tab">Forum Setting</a></li>
          </ul>
              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
              <div class="profile-general-update">

                  <?= $this->render('_form', [
                      'model' => $model,
                     // 'modelext' => $modelext,
                              'imageuploadmodel' => $imageuploadmodel,
                                   'avatarmodel' => $avatarmodel,
                  ]) ?>

              </div>
              
              <h4>Recent Activity</h4>
              
              <div class="table-responsive">
                <table class="table table-hover">
                  
                  <!--tbody>
                    <tr>
                      <td><i class="pull-right fa fa-edit"></i> Today, 1:00 - Jeff Manzi liked your post.</td>
                    </tr>
                    <tr>
                      <td><i class="pull-right fa fa-edit"></i> Today, 12:23 - Mark Friendo liked and shared your post.</td>
                    </tr>
                    <tr>
                      <td><i class="pull-right fa fa-edit"></i> Today, 12:20 - You posted a new blog entry title "Why social media is".</td>
                    </tr>
                    <tr>
                      <td><i class="pull-right fa fa-edit"></i> Yesterday - Karen P. liked your post.</td>
                    </tr>
                    <tr>
                      <td><i class="pull-right fa fa-edit"></i> 2 Days Ago - Philip W. liked your post.</td>
                    </tr>
                    <tr>
                      <td><i class="pull-right fa fa-edit"></i> 2 Days Ago - Jeff Manzi liked your post.</td>
                    </tr>
                  </tbody-->
                </table>
              </div>
              
             </div><!--/tab-pane-->
             <div class="tab-pane" id="contact">
               
                    <div class="profile-general-update">


                  <?= $this->render('_contactform', [
                      'model' => $model,
                     // 'modelext' => $modelext,
                'email' => $email,
                'mobile' => $mobile,
                'home' => $home,
                'work' => $work,
                'home_address' => $home_address,
                'work_address' => $work_address
                  ]) ?>

                        </div> 
               
             </div><!--/tab-pane-->
             <div class="tab-pane" id="edulab">

                    <div class="profile-general-update">


                  <?= $this->render('_edulabform', [
              'edlevel' => $edlevel,
              'location' => $location,
              'edulab_id' => $edulab_id,
                  ]) ?>

                        </div> 
              </div><!--/tab-pane-->

             <div class="tab-pane" id="forum">

                    <div class="profile-general-update">


                  <?= $this->render('_localeform', [
              'profile_location' => $profile_location,
              'timezone' => $timezone
                  ]) ?>

                        </div> 
              </div><!--/tab-pane-->


          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
</div>