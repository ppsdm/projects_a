<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use yii\helpers\Html;
use app\assets\AppAsset;
use common\modules\catalog\models\CatalogGeneral;
use app\assets\SortAsset;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

AppAsset::register($this);
SortAsset::register($this);

$this->title = 'Video';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
<div class="row" style="margin-top: 20px">
<div class="">
<!--div style="background-color: rgba(0, 0, 0, .9); position: fixed; z-index: 9999; width: 100%; height: 100%; text-align: center; vertical-align: middle;"></br>
<img width="60%" src="http://www.freepngimg.com/download/coming_soon/4-2-coming-soon-png.png">
</div-->

<?php
      $dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);



    echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_videoseriesitem',
]);



    ?>
</div>
</div>
</div>