<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\modules\profile\models\ProfileExtended;



?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $DataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'name',
          //  'user_id',
            [
            	'label' => 'Child of',
            	'value' => function($data) {
            		$fn = isset($data->user->profile->first_name) ? $data->user->profile->first_name : '';
            		$ln = isset($data->user->profile->last_name) ? $data->user->profile->last_name : '';
            		return $fn . ' ' . $ln;
            	}
            ],
            
            /*[
                'label' => 'Child of',
                'value' => function($data) {
                    return $data->key;
                }
            ],
            */
                        ['class' => 'yii\grid\ActionColumn',
                            'header' => 'Confirm',
                          'template'=>'{confirmparent} {unconfirmparent}',
                            'buttons'=>[
                              'confirmparent' => function ($url, $model) {
        $childconfirm = ProfileExtended::find()->andWhere(['user_id' => $model->user_id])
        ->andWhere(['type' => 'childof'])
        ->andWhere(['key' => $model->key])
        ->andWhere(['value' => 'true'])
        ->One();
        if(null !== $childconfirm) {
            return '';
        } else {
                                return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, [
                                        'title' => Yii::t('yii', 'Confirm'),
                                           'data-confirm' => Yii::t('yii', 'Are you sure to confirm?'),
                                ]);                                
            }
                              },
                              'unconfirmparent' => function ($url, $model) {  

                                      $childconfirm2 = ProfileExtended::find()->andWhere(['user_id' => $model->user_id])
        ->andWhere(['type' => 'childof'])
        ->andWhere(['key' => $model->key])
             ->andWhere(['value' => 'true'])
        ->One();
  if(null !== $childconfirm2) {
                                return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                                        'title' => Yii::t('yii', 'Unconfirm'),
                                          'data-confirm' => Yii::t('yii', 'Are you sure to unconfirm'),
                                ]);  
        } else {   
                        return '';      
            }
                              },
                          ]                            
                            ],
                            
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
