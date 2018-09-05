<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\modules\catalog\models\CatalogPrice;
use common\modules\tao\models\TaoUriMap;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\CatalogGeneral */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalog Generals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-general-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <!--?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) -->
        <!--= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) -->

    </p>
<?php

/*echo Html::a(Yii::t('app', 'Register'), ['/catalog/cataloggeneral/register', 'id' => $model->id], ['class' => 'btn btn-success',



       'data' => [
            'confirm' => Yii::t('app', 'Are you sure?'),
            'method' => 'post',
        ]
                    ]);
*/
    $taouriobject = TaoUriMap::find()->andWhere(['type'=>'group'])->andWhere(['id'=>$model->id])->One();
    $priceobject = CatalogPrice::find()->andWhere(['catalog_id' => $model->id])
    ->andWhere(['credit_type' => 'credit'])
    ->One();

    if (is_null($priceobject)) {
        $price = 0;
    } else {
        $price = $priceobject->required_point; 
    }
    if (is_null($taouriobject)) {
        $taouri = null;
    } else {
        $taouri = $taouriobject->uri; 
    }

?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'description:ntext',
         //   'imageUrl:url',
         //   'status',
           // [
           //     'label' => 'group uri',
             //    'value' => $taouri,
            //],
            [
                'label' => 'TAO URI',
                 'value' => isset($taouriobject->uri) ? $taouriobject->uri : $taouri,
            ],
            [
                'label' => 'price',
                 'value' => $price,
            ],
        ],
    ]) ?>

</div>
