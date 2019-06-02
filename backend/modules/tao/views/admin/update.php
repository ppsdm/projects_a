<<<<<<< HEAD
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\RefConfig */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Ref Config',
]) . $model->type;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ref Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->type, 'url' => ['view', 'type' => $model->type, 'key' => $model->key]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ref-config-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
=======
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\RefConfig */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Ref Config',
]) . $model->type;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ref Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->type, 'url' => ['view', 'type' => $model->type, 'key' => $model->key]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ref-config-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
