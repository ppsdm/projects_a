<<<<<<< HEAD
<?php

use Yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;


/* @var $this yii\web\View */
?>
<h3>Select project</h3>

<?php

echo ListView::widget([
    'dataProvider' => $projectDataProvider,
    'itemView' => '_project',
    'summary'=>'', 
]);


/*
			 echo GridView::widget([
			        'dataProvider' => $projectDataProvider,
			       // 'filterModel' => $searchModel,
			        'columns' => [
			            //['class' => 'yii\grid\SerialColumn'],

			            //'id',
			            [
			            	'label' => 'Project',
			            	'attribute' => 'id',
			            	'format' => 'raw',
			            	'value' => function($data){
			            		$link = Html::a($data->id, ['project/dashboard', 'id' => $data->id], ['class' => 'btn btn-lg btn-success']);
			            		return $link;
			            	}
			            ],
            	

			        ],
			    ]);
*/
=======
<?php

use Yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;


/* @var $this yii\web\View */
?>
<h1>Select project</h1>

<?php

echo ListView::widget([
    'dataProvider' => $projectDataProvider,
    'itemView' => '_project',
    'summary'=>'', 
]);


/*
			 echo GridView::widget([
			        'dataProvider' => $projectDataProvider,
			       // 'filterModel' => $searchModel,
			        'columns' => [
			            //['class' => 'yii\grid\SerialColumn'],

			            //'id',
			            [
			            	'label' => 'Project',
			            	'attribute' => 'id',
			            	'format' => 'raw',
			            	'value' => function($data){
			            		$link = Html::a($data->id, ['project/dashboard', 'id' => $data->id], ['class' => 'btn btn-lg btn-success']);
			            		return $link;
			            	}
			            ],
            	

			        ],
			    ]);
*/
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
			    ?>