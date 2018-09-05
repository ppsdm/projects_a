<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

use common\modules\core\models\RefValue;

$this->title = 'Belajar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

</div>

<?php

$matapelajarans = RefValue::find()
	->andWhere(['type' => 'catalog'])
	->andWhere(['key' => 'matapelajaran'])
	->All();

foreach ($matapelajarans as $matapelajaran_key => $matapelajaran_value) {
	# code...

	 echo '<div class="col-md-2 btn btn-primary">'.$matapelajaran_value->value.'</div>';
	
}
//echo '<pre>';
//print_r($matapelajarans);
?>
