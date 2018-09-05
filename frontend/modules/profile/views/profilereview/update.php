<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileReview */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Profile Review',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile Reviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="profile-review-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'assessors' => $assessors,
    ]) ?>

</div>
