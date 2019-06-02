<<<<<<< HEAD
<?php

use yii\helpers\Html;
use kartik\sidenav\SideNav;


/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileGeneral */

$this->title = Yii::t('app', 'Profile');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile Generals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <p>
                <?= Html::a(Yii::t('app', 'Edulab Info'), ['/edulab/edulab/profile'], ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('app', 'Educator Info'), ['/edulab/educator/profile'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
        <?= Html::a(Yii::t('app', 'Education'), ['/cats/profile/education'], ['class' => 'btn btn-info']) ?>
        <?= Html::a(Yii::t('app', 'Contact Info'), ['/cats/profile/contacts'], ['class' => 'btn btn-info']) ?>
        <?= Html::a(Yii::t('app', 'Work Info'), ['/cats/profile/work'], ['class' => 'btn btn-info']) ?>

    </p>
    


<div class="profile-general-update">


    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
       // 'modelext' => $modelext,
                'imageuploadmodel' => $imageuploadmodel,
                     'avatarmodel' => $avatarmodel,
    ]) ?>

</div>
=======
<?php

use yii\helpers\Html;
use kartik\sidenav\SideNav;


/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileGeneral */

$this->title = Yii::t('app', 'Profile');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile Generals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <p>
                <?= Html::a(Yii::t('app', 'Edulab Info'), ['/edulab/edulab/profile'], ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('app', 'Educator Info'), ['/edulab/educator/profile'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
        <?= Html::a(Yii::t('app', 'Education'), ['/cats/profile/education'], ['class' => 'btn btn-info']) ?>
        <?= Html::a(Yii::t('app', 'Contact Info'), ['/cats/profile/contacts'], ['class' => 'btn btn-info']) ?>
        <?= Html::a(Yii::t('app', 'Work Info'), ['/cats/profile/work'], ['class' => 'btn btn-info']) ?>

    </p>
    


<div class="profile-general-update">


    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
       // 'modelext' => $modelext,
                'imageuploadmodel' => $imageuploadmodel,
                     'avatarmodel' => $avatarmodel,
    ]) ?>

</div>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
