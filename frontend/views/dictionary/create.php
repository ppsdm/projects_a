<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\catalog\models\RefAssessmentDictionary */

$this->title = Yii::t('app', 'Create Ref Assessment Dictionary');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ref Assessment Dictionaries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-assessment-dictionary-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
