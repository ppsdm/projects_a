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
        <?= $form->field($model, 'credit_point')->textInput(['readonly' => true]) ?>

        <?php

echo Html::label('point to be added');
echo Html::input('number', 'deltapoint');
        ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary', 'data-confirm' => 'poin is going to be added! are you sure?']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
