<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\modules\catalog\models\CatalogGeneral;
use common\modules\catalog\models\CatalogTransaction;


?>
<h1>EduPoin Credit</h1>

<p>
    You have <?=$credit->credit_point ?> EduPoin
</p>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'name',
            //'user_id',
                    'transaction_type',
                    'catalog_id',
            [
                'label' => 'Catalog name',
                'value' => function($data) {
                    if(isset($data->catalog->id))
                        return $data->catalog->name;
                    else
                        return null;
                }
            ],
            [
                'label' => 'Catalog type',
                'value' => function($data) {
                                        if(isset($data->catalog->id))
                        return $data->catalog->type;
                                        else
                        return null;
                }
            ],
            'credit_point',

            'timestamp',

            /*
            [
                'label' => 'Confirmed',
                'attribute' => 'attribute_1',
            ],
                        ['class' => 'yii\grid\ActionColumn',
                          'template'=>'{view} {removechild}',
                            'buttons'=>[
                              'removechild' => function ($url, $model) {     
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                        'title' => Yii::t('yii', 'Remove'),
                                           'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                ]);                                
            
                              },
                              'view' => function ($url, $model) {     
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                        'title' => Yii::t('yii', 'View'),
                                        //  'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                ]);                                
            
                              },
                          ]                            
                            ],

                            */
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>



