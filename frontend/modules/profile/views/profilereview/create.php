<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileReview */

$this->title = Yii::t('app', 'Create Profile Review');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile Reviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-review-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
                  'assessors' => $assessors,
    ]) ?>

</div>
