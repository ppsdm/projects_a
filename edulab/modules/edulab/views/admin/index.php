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





?>
<div class="container" style="margin-top: 20px"><h1>
Tryout Results
</h1>
<div class="row">

	<?php


echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_catalogitem',
]);

?>

						</div>



</div>






