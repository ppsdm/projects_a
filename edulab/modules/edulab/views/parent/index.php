<<<<<<< HEAD
<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;



?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Add child'), ['addchild'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'name',
            'user_id',
            [
            	'label' => 'name',
            	'value' => function($data) {
            		$fn = isset($data->user->profile->first_name) ? $data->user->profile->first_name : '';
            		$ln = isset($data->user->profile->last_name) ? $data->user->profile->last_name : '';
            		return $fn . ' ' . $ln;
            	}
            ],
            [
                'label' => 'Confirmed',
                'attribute' => 'value',
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
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
=======
<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;



?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Add child'), ['addchild'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'name',
            'user_id',
            [
            	'label' => 'name',
            	'value' => function($data) {
            		$fn = isset($data->user->profile->first_name) ? $data->user->profile->first_name : '';
            		$ln = isset($data->user->profile->last_name) ? $data->user->profile->last_name : '';
            		return $fn . ' ' . $ln;
            	}
            ],
            [
                'label' => 'Confirmed',
                'attribute' => 'value',
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
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
