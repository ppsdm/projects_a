<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\profile\models\Profile;
use app\modules\profile\models\ProfileMeta;
use app\modules\profile\models\ProfileReview;
use app\modules\profile\models\ProfileSearch;

/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileReview */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-review-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php

    if ($model->isNewRecord ) {
        $readonly = false;
    } else {
         $readonly = true;
    }


        echo $form->field($model, 'reviewer_id')->dropDownList($assessors, ['prompt'=>'Select...', 'disabled' => true]);
        echo $form->field($model, 'reviewee_id')->dropDownList($assessors, ['prompt'=>'Select...', 'disabled' => $readonly]);



    $sentiment = [
    '-2' => 'Sangat Kurang',
       '-1' => 'Kurang',
          '0' => 'Netral',
    '1' => 'Baik',
       '2' => 'Sangat Baik',
    ]
    ?>

    <?= $form->field($model, 'review')->textarea(['rows' => 6]) ?>

    <?php
    //$form->field($model, 'attribute_1')->textInput(['maxlength' => true]) 

    ?>

    <?= $form->field($model, 'attribute_1')->radioList($sentiment)->label('Sentimen'); ?>



<?php 

    //$form->field($model, 'attribute_2')->textInput(['maxlength' => true]);

    //$form->field($model, 'attribute_3')->textInput(['maxlength' => true]);


    //$form->field($model, 'created_at')->textInput();

    //$form->field($model, 'modified_at')->textInput();
?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
