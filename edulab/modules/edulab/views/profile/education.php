<?php

use yii\helpers\Html;
use kartik\sidenav\SideNav;


/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileGeneral */

$this->title = Yii::t('app', 'Education');
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
 <?= Html::a(Yii::t('app', 'Work'), ['/edulab/profile/work'], ['class' => 'btn btn-info']) ?>


</li>
</ul>

    </p>
    


<div class="profile-general-update">


<?php

    echo Html::input('text','email',$email,['class'=>'form-control']);
        echo Html::input('text','mobile phone',$mobile_phone,['class'=>'form-control']);
            echo Html::input('text','home phone',$home_phone,['class'=>'form-control']);
                echo Html::input('text','work phone',$work_phone,['class'=>'form-control']);

?>
</div>
