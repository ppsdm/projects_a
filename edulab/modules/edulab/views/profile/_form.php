<<<<<<< HEAD
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\profile\models\ProfileExtended;
use app\modules\profile\models\ProfileGeneral;
use app\models\ImageUpload;
use kartik\sidenav\SideNav;
use kartik\file\FileInput;
use yii\jui\DatePicker;
//use kartik\widgets\DatePicker;
//use app\assets\AppAsset;
//use app\assets\EdulabAsset;
//use app\assets\SortAsset;


//AppAsset::register($this);
//EdulabAsset::register($this);
//SortAsset::register($this);



/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileGeneral */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-general-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'user_id')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>



        <?php
    echo 'Birthday<br/>';
        echo DatePicker::widget([
       'model' => $model,
       'attribute' => 'birthdate',
       'language' => 'en',
       'dateFormat' => 'yyyy-MM-dd',
       'options' => ['class' => 'form-control']
     ]);
    ?>



    <?= $form->field($model, 'gender')->dropdownList(['male'=>'male', 'female'=>'female'],['prompt'=>'Select Category']) ?>

<?php 

//echo Html::img(Yii::$app->request->baseUrl .'/avatars/' . $avatarmodel->value, ['title' => 'avatar image']);


    //echo $form->field($avatarmodel, 'value')->textInput();



//echo $form->field($imageuploadmodel, 'imageFile')->fileInput();

echo $form->field($imageuploadmodel, 'imageFile')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
]);

  //  echo $form->field($modelext, 'value')->label('Jenjang')->dropdownList(['smaxiiipa'=>'sma xii IPA','smaxiiips'=>'sma xii IPS'],['prompt'=>'Select Category']);

    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
=======
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\profile\models\ProfileExtended;
use app\modules\profile\models\ProfileGeneral;
use app\models\ImageUpload;
use kartik\sidenav\SideNav;
use kartik\file\FileInput;
use yii\jui\DatePicker;
//use kartik\widgets\DatePicker;
//use app\assets\AppAsset;
//use app\assets\EdulabAsset;
//use app\assets\SortAsset;


//AppAsset::register($this);
//EdulabAsset::register($this);
//SortAsset::register($this);



/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileGeneral */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-general-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'user_id')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>



        <?php
    echo 'Birthday<br/>';
        echo DatePicker::widget([
       'model' => $model,
       'attribute' => 'birthdate',
       'language' => 'en',
       'dateFormat' => 'yyyy-MM-dd',
       'options' => ['class' => 'form-control']
     ]);
    ?>



    <?= $form->field($model, 'gender')->dropdownList(['male'=>'male', 'female'=>'female'],['prompt'=>'Select Category']) ?>

<?php 

//echo Html::img(Yii::$app->request->baseUrl .'/avatars/' . $avatarmodel->value, ['title' => 'avatar image']);


    //echo $form->field($avatarmodel, 'value')->textInput();



//echo $form->field($imageuploadmodel, 'imageFile')->fileInput();

echo $form->field($imageuploadmodel, 'imageFile')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
]);

  //  echo $form->field($modelext, 'value')->label('Jenjang')->dropdownList(['smaxiiipa'=>'sma xii IPA','smaxiiips'=>'sma xii IPS'],['prompt'=>'Select Category']);

    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
