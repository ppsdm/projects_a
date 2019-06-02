<<<<<<< HEAD
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Change username';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" style="margin-top: 20px">
<div class="site-login">

        <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>


                <div class="form-group">
                     <?= Html::submitButton('Change', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
=======
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Change username';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" style="margin-top: 20px">
<div class="site-login">

        <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>


                <div class="form-group">
                     <?= Html::submitButton('Change', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
</div>