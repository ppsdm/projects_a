<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileReviewSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-review-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'reviewer_id') ?>

    <?= $form->field($model, 'reviewee_id') ?>

    <?= $form->field($model, 'review') ?>

    <?= $form->field($model, 'attribute_1') ?>

    <?php // echo $form->field($model, 'attribute_2') ?>

    <?php // echo $form->field($model, 'attribute_3') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'modified_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
