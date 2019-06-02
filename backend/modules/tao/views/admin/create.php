<<<<<<< HEAD
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\RefConfig */

$this->title = Yii::t('app', 'Create Ref Config');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ref Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-config-create">

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

$this->title = Yii::t('app', 'Create Ref Config');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ref Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-config-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
