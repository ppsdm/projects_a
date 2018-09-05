<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\projects\models\Catalog */

// $this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalog Meta'), 'url' => ['catalogmeta']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['updatemeta', 'catalog_id'=>$model->catalog_id, 'value'=>$model->value], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['deletemeta', 'catalog_id'=>$model->catalog_id, 'value'=>$model->value], [
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
            'catalog_id',
            'type',
            'key',
            'value',
            'attribute_1',
            'attribute_2',
            'attribute_3',            
        ],
    ]) ?>

</div>
