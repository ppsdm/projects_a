<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\catalog\models\RefAssessmentDictionary */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Ref Assessment Dictionary',
]) . $model->type;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ref Assessment Dictionaries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->type, 'url' => ['view', 'type' => $model->type, 'key' => $model->key, 'value' => $model->value]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ref-assessment-dictionary-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
