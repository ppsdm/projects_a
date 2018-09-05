<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" style="margin-top: 20px">
<div class="site-login">

        <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>


            <?php
                echo Html::input('password','old_password','',['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Old password']);
  echo Html::input('password','new_password','',['readonly' => false, 'class'=>'form-control', 'placeholder' => 'New password']);
  echo Html::input('password','confirm_password','',['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Confirm password']);
                  //$form->field($model, 'password')->passwordInput()
            ?>

                



                <div class="form-group">
                     <?= Html::submitButton('Change', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>