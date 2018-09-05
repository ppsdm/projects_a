<?php

use yii\helpers\Html;
use kartik\sidenav\SideNav;


/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileGeneral */

$this->title = Yii::t('app', 'Work');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile Generals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <p>
        <?= Html::a(Yii::t('app', 'Education'), ['/cats/profile/education'], ['class' => 'btn btn-info']) ?>
        <?= Html::a(Yii::t('app', 'Contacts'), ['/cats/profile/contacts'], ['class' => 'btn btn-info']) ?>
        <?= Html::a(Yii::t('app', 'Work'), ['/cats/profile/work'], ['class' => 'btn btn-info']) ?>

    </p>
    


<div class="profile-general-update">


    <h1><?= Html::encode($this->title) ?></h1>



</div>
