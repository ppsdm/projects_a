<<<<<<< HEAD
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
//use kartik\date\DatePicker;

use app\assets\AppAsset;
use app\assets\MomentAsset;
use yii\helpers\Url;

AppAsset::register($this);

MomentAsset::register($this);


$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("$('[data-toggle=\"popover\"]').popover();");
$this->registerJs("$('#show-email').click(function (e) { e.preventDefault(); $('#details-email').removeClass('hide'); $('#user-new_email').prop('disabled', false); $(this).addClass('hide'); });");


?>
<div class="container" style="margin-top: 20px">
<div class="site-signup">


    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">


        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'first_name') ?>
                                <?= $form->field($model, 'last_name') ?>
<?php
                                echo $form->field($model, 'gender')->dropdownList(['male'=>'male', 'female'=>'female'],['prompt'=>'Select Category']
);

/*
    echo $form->field($model, 'birthdate')->widget(DatePicker::classname(), [
    //'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
    'options' =>['class'=>'form-control'],
]);
    */

    //echo '<label>Birthday</label>';


/** 
KARTIK
echo $form->field($model, 'birthdate')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Enter birth date ...'],
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd'
    ]
]);
*/

echo $form->field($model, 'birthdate')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Enter birth date ...'],
  //  'inline' => true,
            'dateFormat' => 'yyyy-MM-dd',
    'clientOptions' => [

        'changeMonth' => true,
        'changeYear' => true,
        'showButtonPanel' => false,

        'yearRange' => '1980:2010'
    ],
]);


//echo $form->field($model, 'current_ed_level')->dropdownList(['smaxiiipa'=>'SMA XII IPA', 'smaxiiips'=>'SMA XII IPS'],['prompt'=>'Select Category'])->label('Education Level');

?>



                <?= $form->field($model, 'email')->textInput([
     'data-container' => 'body',
                                'data-toggle'    => 'popover',
                                'data-placement' => 'right',
                                'data-content'   => Yii::t('app', 'New e-mail has to be activated first. Activation link will be sent to the new address.'),
                                'data-trigger'   => 'focus',
                ]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'password_repeat')->passwordInput() ?>
                <?php
                /* echo Html::label('confirm password','pwdconfirm',['class' => 'control-label']);
                    echo Html::passwordInput('pwdconfirm',null,['class' => 'form-control']);
                    echo '<br/>';
                    */
                ?>


                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
=======
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
//use kartik\date\DatePicker;

use app\assets\AppAsset;
use app\assets\MomentAsset;
use yii\helpers\Url;

AppAsset::register($this);

MomentAsset::register($this);


$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("$('[data-toggle=\"popover\"]').popover();");
$this->registerJs("$('#show-email').click(function (e) { e.preventDefault(); $('#details-email').removeClass('hide'); $('#user-new_email').prop('disabled', false); $(this).addClass('hide'); });");


?>
<div class="container" style="margin-top: 20px">
<div class="site-signup">


    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">


        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'first_name') ?>
                                <?= $form->field($model, 'last_name') ?>
<?php
                                echo $form->field($model, 'gender')->dropdownList(['male'=>'male', 'female'=>'female'],['prompt'=>'Select Category']
);

/*
    echo $form->field($model, 'birthdate')->widget(DatePicker::classname(), [
    //'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
    'options' =>['class'=>'form-control'],
]);
    */

    //echo '<label>Birthday</label>';


/** 
KARTIK
echo $form->field($model, 'birthdate')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Enter birth date ...'],
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd'
    ]
]);
*/

echo $form->field($model, 'birthdate')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Enter birth date ...'],
  //  'inline' => true,
            'dateFormat' => 'yyyy-MM-dd',
    'clientOptions' => [

        'changeMonth' => true,
        'changeYear' => true,
        'showButtonPanel' => false,

        'yearRange' => '1980:2010'
    ],
]);


//echo $form->field($model, 'current_ed_level')->dropdownList(['smaxiiipa'=>'SMA XII IPA', 'smaxiiips'=>'SMA XII IPS'],['prompt'=>'Select Category'])->label('Education Level');

?>



                <?= $form->field($model, 'email')->textInput([
     'data-container' => 'body',
                                'data-toggle'    => 'popover',
                                'data-placement' => 'right',
                                'data-content'   => Yii::t('app', 'New e-mail has to be activated first. Activation link will be sent to the new address.'),
                                'data-trigger'   => 'focus',
                ]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'password_repeat')->passwordInput() ?>
                <?php
                /* echo Html::label('confirm password','pwdconfirm',['class' => 'control-label']);
                    echo Html::passwordInput('pwdconfirm',null,['class' => 'form-control']);
                    echo '<br/>';
                    */
                ?>


                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
</div>