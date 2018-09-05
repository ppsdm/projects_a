<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\projects\models\Catalog */

$this->title = Yii::t('app', 'Update Catalog Meta: ', [
    'modelClass' => 'CatalogMeta',
]) . ucwords($model->catalog->name) .' - '. ucwords(str_replace('_', ' 	', $model->value));
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogs'), 'url' => ['catalogmeta']];
$this->params['breadcrumbs'][] = ['label' => $model->catalog->name .' | '. $model->attribute_2, 'url' => ['viewmeta', 'catalog_id' => $model->catalog_id, 'value' => $model->value]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="catalog-update">

    <h2><?= Html::encode($this->title) ?></h2>
    <br>
    <?= $this->render('_form_meta', [
        'model' => $model,
    ]) ?>

</div>
