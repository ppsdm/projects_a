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


$this->title = 'Frequently Asked Questions';
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

<a id="test" href="#" data-toggle="tooltip" data-confirm='rure' data-placement="top" title="" data-original-title="More Options"><i class="fa"></i>sdasdadada</a>
<?php

echo Html::a(Yii::t('app', 'Delete Message'), ['delete-email', 'id' => '3'], [
    'class' => 'btn btn-primary',
    'data' => [
        'confirm' => 'Are you sure want to delete this message?',
        'method' => 'post',
    ]
]);


/*echo ListView::widget([
    'dataProvider' => $dataProvider2,
    'itemView' => '_rewarditem',
]);
*/

?>

                        </div>



</div>

