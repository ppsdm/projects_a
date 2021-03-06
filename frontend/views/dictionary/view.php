<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\catalog\models\RefAssessmentDictionary */

$this->title = $model->type;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ref Assessment Dictionaries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-assessment-dictionary-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'type' => $model->type, 'key' => $model->key, 'value' => $model->value], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'type' => $model->type, 'key' => $model->key, 'value' => $model->value], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'type',
            'key',
            'value',
            'textvalue:ntext',
            'attribute_1',
            'attribute_2',
            'attribute_3',
        ],
    ]) ?>

</div>
