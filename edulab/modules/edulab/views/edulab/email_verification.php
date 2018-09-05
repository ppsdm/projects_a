<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use yii\jui\DatePicker;
use kartik\date\DatePicker;

use app\assets\AppAsset;
use app\assets\MomentAsset;
use yii\helpers\Url;

AppAsset::register($this);

MomentAsset::register($this);


$this->title = 'Verify Email';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("$('[data-toggle=\"popover\"]').popover();");
$this->registerJs("$('#show-email').click(function (e) { e.preventDefault(); $('#details-email').removeClass('hide'); $('#user-new_email').prop('disabled', false); $(this).addClass('hide'); });");


?>
<div class="container" style="margin-top: 20px">
<div class="site-signup">


    <h1><?= Html::encode($this->title) ?></h1>

    <p>Use the verification key sent to your email :</p>

    <div class="row">


        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>




<?=Html::input('text','verification_string','',['class'=>'form-control'])?>
                <?php
                /* echo Html::label('confirm password','pwdconfirm',['class' => 'control-label']);
                    echo Html::passwordInput('pwdconfirm',null,['class' => 'form-control']);
                    echo '<br/>';
                    */
                ?>


                <div class="form-group">
                    <?= Html::submitButton('Verify', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>