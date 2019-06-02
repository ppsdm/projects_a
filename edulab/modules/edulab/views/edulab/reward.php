<<<<<<< HEAD
<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\modules\catalog\models\CatalogGeneral;
use common\modules\catalog\models\CatalogTransaction;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;


$this->title = 'Rewards';
$this->params['breadcrumbs'][] = $this->title;
$data = [
  /*  "red" => "red",
    "green" => "green",
    */
];
?>

<div class="container" style="margin-top: 20px"><h1>
<?= $this->title ?>
</h1>
<div class="row">

<?php
echo ListView::widget([
    'dataProvider' => $dataProvider2,
    'itemView' => '_rewarditem',
]);


?>

                        </div>



</div>

=======
<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\modules\catalog\models\CatalogGeneral;
use common\modules\catalog\models\CatalogTransaction;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;


$this->title = 'Rewards';
$this->params['breadcrumbs'][] = $this->title;
$data = [
  /*  "red" => "red",
    "green" => "green",
    */
];
?>

<div class="container" style="margin-top: 20px"><h1>
<?= $this->title ?>
</h1>
<div class="row">

<?php
echo ListView::widget([
    'dataProvider' => $dataProvider2,
    'itemView' => '_rewarditem',
]);


?>

                        </div>



</div>

>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
