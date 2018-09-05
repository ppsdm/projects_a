<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\modules\projects\models\Catalog;

/* @var $this yii\web\View */
/* @var $model app\modules\projects\models\Catalog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalog-form">

    <?php 
        $action = $model->isNewRecord ? 'createmeta' : 'updatemeta?catalog_id='. $model->catalog_id .'&value='. $model->value;

        $form = ActiveForm::begin([
            'action' => $action
        ]); 

        $catalogs = Catalog::find()->all();
    ?>

    <?= $form->field($model, 'catalog_id')->dropDownList(
        ArrayHelper::map(Catalog::find()->all(), 'id', 'name'), ['prompt' => ' -- Select Catalog --']) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'attribute_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'attribute_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'attribute_3')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
