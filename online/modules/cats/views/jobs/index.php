<<<<<<< HEAD
<?php
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Organization;

/* @var $this yii\web\View */
?>
<h1>Lowongan</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>

<?php
    //  echo Html::a(Yii::t('app', 'Create Job'), ['/admin/jobs/create'], ['class' => 'btn btn-primary']);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        //['class' => 'yii\grid\SerialColumn'],
        //'id',
        [
          'label' => 'Organisasi',
          'attribute' => 'organization_id',
          'filter' => Html::activeDropDownList($searchModel, 'organization_id', ArrayHelper::map(Organization::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'Select Organization']),
          'value' => function($data) {
                 return isset($data->organization->name) ? $data->organization->name : '';
          },
        ],
        'name',
        //'status',
                                     ['class' => 'yii\grid\ActionColumn',
                          'template'=>'{view} {register}',
                          'header' => 'View',
                            'buttons'=>[
                              'register' => function ($url, $model) {     
                                return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
                                        'title' => Yii::t('yii', 'Register'),
                                ]);                                
            
                              }
                          ]                            
                            ],
    ],
]);



=======
<?php
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Organization;

/* @var $this yii\web\View */
?>
<h1>Lowongan</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>

<?php
    //  echo Html::a(Yii::t('app', 'Create Job'), ['/admin/jobs/create'], ['class' => 'btn btn-primary']);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        //['class' => 'yii\grid\SerialColumn'],
        //'id',
        [
          'label' => 'Organisasi',
          'attribute' => 'organization_id',
          'filter' => Html::activeDropDownList($searchModel, 'organization_id', ArrayHelper::map(Organization::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'Select Organization']),
          'value' => function($data) {
                 return isset($data->organization->name) ? $data->organization->name : '';
          },
        ],
        'name',
        //'status',
                                     ['class' => 'yii\grid\ActionColumn',
                          'template'=>'{view} {register}',
                          'header' => 'View',
                            'buttons'=>[
                              'register' => function ($url, $model) {     
                                return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
                                        'title' => Yii::t('yii', 'Register'),
                                ]);                                
            
                              }
                          ]                            
                            ],
    ],
]);



>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
?>