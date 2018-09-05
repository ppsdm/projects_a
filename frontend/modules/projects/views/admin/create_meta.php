<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\projects\models\Catalog */

$this->title = Yii::t('app', 'Create Catalog Meta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogs'), 'url' => ['catalogmeta']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-meta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <br>

    <?= $this->render('_form_meta', [
        'model' => $model,
    ]) ?>

</div>
