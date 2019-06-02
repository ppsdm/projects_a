<<<<<<< HEAD
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\profile\models\ProfileExtended;
use common\modules\profile\models\ProfileGeneral;
use common\modules\profile\models\UserCredit;
use kartik\sidenav\SideNav;
use kartik\file\FileInput;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileGeneral */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-general-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'user_id')->textInput(['readonly' => false]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Make Parent'), ['class' => 'btn btn-primary', 'data-confirm' => 'are you sure?']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
=======
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\profile\models\ProfileExtended;
use common\modules\profile\models\ProfileGeneral;
use common\modules\profile\models\UserCredit;
use kartik\sidenav\SideNav;
use kartik\file\FileInput;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileGeneral */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-general-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'user_id')->textInput(['readonly' => false]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Make Parent'), ['class' => 'btn btn-primary', 'data-confirm' => 'are you sure?']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
