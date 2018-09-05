<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Catalog Meta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogs'), 'url' => ['catalog?id=1']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Catalog Meta'), ['createmeta'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'catalog_id',
                'type',
                'key',
                'value',
                'attribute_1',
                'attribute_2',
                'attribute_3',
                
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open">
                                </span>', 'viewmeta?catalog_id='. $model->catalog_id .'&value='. $model->value);

                            // return $model->catalog_id .'|'. $model->value;
                        },

                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil">
                                </span>', 'updatemeta?catalog_id='. $model->catalog_id .'&value='. $model->value);

                            // return $model->catalog_id .'|'. $model->value;
                        },

                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash">
                                </span>', 'deletemeta?catalog_id='. $model->catalog_id .'&value='. $model->value);

                            // return $model->catalog_id .'|'. $model->value;
                        },
                    ],
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
