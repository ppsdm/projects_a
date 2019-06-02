<<<<<<< HEAD
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model vendor\gamantha\pao\project\models\Activity */

$this->title = Yii::t('app', 'Create Activity');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
=======
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model vendor\gamantha\pao\project\models\Activity */

$this->title = Yii::t('app', 'Create Activity');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
