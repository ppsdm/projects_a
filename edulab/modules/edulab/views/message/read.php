<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\modules\catalog\models\CatalogPrice;
use common\modules\tao\models\TaoUriMap;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\CatalogGeneral */

?>
<div class="container" style="margin-top: 20px">
<div class="row">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
           // 'type',
            'message',
       //     'description:ntext',
         //   'imageUrl:url',
         //   'status',
            [
                'label' => 'Link',
                'attribute' => 'attribute_1',
                'format' => 'raw',
                 'value' => $model->attribute_1,
            ],

        ],
    ]) ?>

</div>
</div>