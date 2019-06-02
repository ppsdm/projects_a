<<<<<<< HEAD
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use common\modules\assessment\models\Assessment;
use common\models\Notification;
use common\modules\catalog\models\CatalogGeneral;
use common\modules\profile\models\ProfileExtended;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;




$this->title = 'Edulab Try Out';
$this->params['breadcrumbs'][] = $this->title;
$userprofile = ProfileExtended::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['type' => 'edulab'])
->andWhere(['key' => 'ed_level'])->One();

$user_profile_tag = isset($userprofile->value) ? strtolower($userprofile->value) : '';

$tags_array = [','.$user_profile_tag.','];

$status_array = ['active', 'inactive', 'pending'];
$catalogs_query = CatalogGeneral::find()
->andWhere(['attribute1' => 'tryout'])
->andWhere(['like','tag',$tags_array])
->andWhere(['in', 'status', $status_array])
;


/*


//echo '<pre>';
//print_r($catalogs_query);
$sbmptn_1 = Assessment::find()->andWhere(['catalog_id' => '20'])->orderBy(['id'=> SORT_DESC])->andWhere(['user_id' => Yii::$app->user->id])->One();
if (null == $sbmptn_1) {
	$sbmptn_1 = new Assessment;
}
$sbmptn_2 = Assessment::find()->andWhere(['catalog_id' => '22'])->orderBy(['id'=> SORT_DESC])->andWhere(['user_id' => Yii::$app->user->id])->One();
if (null == $sbmptn_2) {
	$sbmptn_2 = new Assessment;
}
$sbmptn_3 = Assessment::find()->andWhere(['catalog_id' => '23'])->orderBy(['id'=> SORT_DESC])->andWhere(['user_id' => Yii::$app->user->id])->One();
if (null == $sbmptn_3) {
	$sbmptn_3 = new Assessment;
}
$sbmptn_4 = Assessment::find()->andWhere(['catalog_id' => '24'])->orderBy(['id'=> SORT_DESC])->andWhere(['user_id' => Yii::$app->user->id])->One();
if (null == $sbmptn_4) {
	$sbmptn_4 = new Assessment;
}
$sbmptn_5 = Assessment::find()->andWhere(['catalog_id' => '25'])->orderBy(['id'=> SORT_DESC])->andWhere(['user_id' => Yii::$app->user->id])->One();
if (null == $sbmptn_5) {
	$sbmptn_5 = new Assessment;
}

*/


?>
<div class="container" style="margin-top: 20px"><h1>
Tryouts
</h1>
<div class="row">

	<?php


	$dataProvider = new ActiveDataProvider([
    'query' => $catalogs_query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_catalogitem',
]);

?>

						</div>


<?php

$ipc_registration = ProfileExtended::find()
->andWhere(['user_id' => Yii::$app->user->id])
->andWhere(['type' => 'edulab'])
->andWhere(['key' => 'ipc-registration'])
->andWhere(['attribute_1' => date("Y")])
->One();


if(null !== $ipc_registration) {
?>
<h1>
IPC Tryouts
</h1>
<div class="row">

	<?php



echo ListView::widget([
    'dataProvider' => $ipcDataProvider,
    'itemView' => '_catalogitem',
]);

?>

						</div>

						<?php
					} 
						?>
</div>






=======
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use common\modules\assessment\models\Assessment;
use common\models\Notification;
use common\modules\catalog\models\CatalogGeneral;
use common\modules\profile\models\ProfileExtended;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;




$this->title = 'Edulab Try Out';
$this->params['breadcrumbs'][] = $this->title;
$userprofile = ProfileExtended::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['type' => 'edulab'])
->andWhere(['key' => 'ed_level'])->One();

$user_profile_tag = isset($userprofile->value) ? strtolower($userprofile->value) : '';

$tags_array = [','.$user_profile_tag.','];

$status_array = ['active', 'inactive', 'pending'];
$catalogs_query = CatalogGeneral::find()
->andWhere(['attribute1' => 'tryout'])
->andWhere(['like','tag',$tags_array])
->andWhere(['in', 'status', $status_array])
;


/*


//echo '<pre>';
//print_r($catalogs_query);
$sbmptn_1 = Assessment::find()->andWhere(['catalog_id' => '20'])->orderBy(['id'=> SORT_DESC])->andWhere(['user_id' => Yii::$app->user->id])->One();
if (null == $sbmptn_1) {
	$sbmptn_1 = new Assessment;
}
$sbmptn_2 = Assessment::find()->andWhere(['catalog_id' => '22'])->orderBy(['id'=> SORT_DESC])->andWhere(['user_id' => Yii::$app->user->id])->One();
if (null == $sbmptn_2) {
	$sbmptn_2 = new Assessment;
}
$sbmptn_3 = Assessment::find()->andWhere(['catalog_id' => '23'])->orderBy(['id'=> SORT_DESC])->andWhere(['user_id' => Yii::$app->user->id])->One();
if (null == $sbmptn_3) {
	$sbmptn_3 = new Assessment;
}
$sbmptn_4 = Assessment::find()->andWhere(['catalog_id' => '24'])->orderBy(['id'=> SORT_DESC])->andWhere(['user_id' => Yii::$app->user->id])->One();
if (null == $sbmptn_4) {
	$sbmptn_4 = new Assessment;
}
$sbmptn_5 = Assessment::find()->andWhere(['catalog_id' => '25'])->orderBy(['id'=> SORT_DESC])->andWhere(['user_id' => Yii::$app->user->id])->One();
if (null == $sbmptn_5) {
	$sbmptn_5 = new Assessment;
}

*/


?>
<div class="container" style="margin-top: 20px"><h1>
Tryouts
</h1>
<div class="row">

	<?php


	$dataProvider = new ActiveDataProvider([
    'query' => $catalogs_query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_catalogitem',
]);

?>

						</div>


<?php

$ipc_registration = ProfileExtended::find()
->andWhere(['user_id' => Yii::$app->user->id])
->andWhere(['type' => 'edulab'])
->andWhere(['key' => 'ipc-registration'])
->andWhere(['attribute_1' => date("Y")])
->One();


if(null !== $ipc_registration) {
?>
<h1>
IPC Tryouts
</h1>
<div class="row">

	<?php



echo ListView::widget([
    'dataProvider' => $ipcDataProvider,
    'itemView' => '_catalogitem',
]);

?>

						</div>

						<?php
					} 
						?>
</div>






>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
