<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use kartik\widgets\DepDrop;


/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\Profile */

?>
<div class="profile-update">

    <h1><?= Html::encode($this->title) ?></h1>
<div class="profile-form">

    <?php        $form = ActiveForm::begin([
        'id' => 'review-form']);


    ?>


    <?= $form->field($review, 'reviewee_id')->dropDownList($assessors, ['prompt'=>'Select...']);?>

<?php
/*echo $form->field($review, 'review')->widget(DepDrop::classname(), [
    'options'=>['id'=>'review-id'],
    'pluginOptions'=>[
        'depends'=>['cat-reviewee_id'],
        'placeholder'=>'Select...',
        'url'=>Url::to(['getreview'])
    ]
]);
*/
?>
    <?= $form->field($review, 'review')->textArea(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($review->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $review->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>





</div>
