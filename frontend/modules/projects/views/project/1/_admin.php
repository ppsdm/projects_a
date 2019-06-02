<<<<<<< HEAD
<?php
use app\modules\projects\models\Project;
use app\modules\projects\models\ProjectMeta;
use app\modules\projects\models\ProjectActivity;
use app\modules\projects\models\ProjectActivitySearch;
use app\modules\projects\models\ProjectAssessment;
use app\modules\projects\models\ProjectActivityMeta;
use common\modules\profile\models\Profile;
use common\modules\profile\models\ProfileMeta;
use yii\data\ActiveDataProvider;
//use Yii;
use Yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;


?>

<?php
echo '<h2>ADMIN SECTION</h2><hr/>';

echo $this->render('_admin_menu');
$profile_model = Profile::find()->andWhere(['user_id' => Yii::$app->user->id])->One();

	$projectActivitySearch = new ProjectActivitySearch();
            $distinct_assessor_activities_model = ProjectActivityMeta::find()
                ->andWhere(['type' => 'general'])
                ->andWhere(['key' => 'assessor'])
                ->andWhere(['value' => $profile_model->id])
                ->asArray()->All();

            $assessor_activity_ids = ArrayHelper::getColumn($distinct_assessor_activities_model, 'project_activity_id');


            $activityQuery = ProjectActivity::find()
            ->andWhere(['project_id' => $_GET['id']])
            ->andWhere(['status' => 'active'])
            ->andWhere(['in','id',$assessor_activity_ids]);

			$activityDataProvider = new ActiveDataProvider([
			    'query' => $activityQuery,
			    'pagination' => [
			        'pageSize' => 50,
			    ],
			    'sort' => [
			        'defaultOrder' => [
			//            'created_at' => SORT_DESC,
			  //          'title' => SORT_ASC, 
			        ]
			    ],
			]);



			 echo GridView::widget([
			        'dataProvider' => $activityDataProvider,
			        'filterModel' => $projectActivitySearch,
    'rowOptions'=>function($model, $index, $widget, $grid){
    		$status_model = ProjectActivityMeta::find()
    		->andWhere(['project_activity_id' => $model->id])
    		->andWhere(['type' => 'assessment'])
    		->andWhere(['key' => 'status'])
    		->One();
            if($status_model->value == 'done'){
                return ['class' => 'success'];
            } else if($status_model->value == 'expired'){
                return ['class' => 'danger'];
            }  else if($status_model->value == 'so_reviewed'){
                return ['class' => 'primary'];
            }  else if($status_model->value == 'so_returned'){
                return ['class' => 'danger'];
            }  else if($status_model->value == 'under_review'){
                return ['class' => 'active'];
            } else {
            	                return ['class' => 'warning'];
            }
            
    },
			       // 'filterModel' => $searchModel,
			        'columns' => [
			            ['class' => 'yii\grid\SerialColumn'],

			            //'id',
			            [
			            	'label' => 'Activity',
			            	'attribute' => 'id',
			            	'format' => 'raw',
			            	'value' => function($data){
			            		$link = Html::a($data->id, ['activity/view', 'id' => $data->id], ['class' => 'profile-link']);
			            		return $link;
			            	}
			            ],
			            [
			            	'label' => 'Assessment id',
			            	//'attribute' => 'id',
			            	//'format' => 'raw',
			            	'value' => function($data){
			            		$assessment = ProjectAssessment::find()->andWhere(['activity_id'=>$data->id])->andWhere(['status' => 'active'])->One();
			            		return (null !== $assessment)? $assessment->id : '';
			            	}
			            ],
			           /* [
			            	'label' => 'Project Name',
			            	'value' => function($data)
			            	{
			            		return $data->project->name;
			            	}

			            ],
			            */
			            [
			            	'label' => 'Nama',
			            	'value' => function($data)
			            	{
			            		$assessee_id_model = ProjectActivityMeta::find()
			            		->andWhere(['project_activity_id' => $data->id])
			            		->andWhere(['type' => 'general'])
			            		->andWhere(['key' => 'assessee'])->One();

			            		$assessee_model = Profile::findOne($assessee_id_model->value);
			            		$fn = isset($assessee_model->first_name ) ? $assessee_model->first_name : '';
			            		$ln = isset($assessee_model->last_name) ? $assessee_model->last_name : '';
			            		return $fn .' ' . $ln;
			            	}

			            ],
						[
			            	'label' => 'NIP',
			            	'value' => function($data)
			            	{
			            		$assessee_id_model = ProjectActivityMeta::find()
			            		->andWhere(['project_activity_id' => $data->id])
			            		->andWhere(['type' => 'general'])
			            		->andWhere(['key' => 'assessee'])->One();

								//$assessee_model = Profile::findOne($assessee_id_model->value);
								
								$assessee_profile_id = ProfileMeta::find()
			            		->andWhere(['profile_id' => $assessee_id_model->value])
			            		->andWhere(['type' => 'work'])
			            		->andWhere(['key' => 'nip'])->One();

			            		return $assessee_profile_id->value;
			            	}

			            ],           	
						[
			            	'label' => 'Jabatan',
			            	'value' => function($data)
			            	{
			            		$assessee_id_model = ProjectActivityMeta::find()
			            		->andWhere(['project_activity_id' => $data->id])
			            		->andWhere(['type' => 'general'])
			            		->andWhere(['key' => 'assessee'])->One();

								//$assessee_model = Profile::findOne($assessee_id_model->value);
								
								$assessee_profile_id = ProfileMeta::find()
			            		->andWhere(['profile_id' => $assessee_id_model->value])
			            		->andWhere(['type' => 'work'])
			            		->andWhere(['key' => 'level'])->One();

			            		return $assessee_profile_id->value;
			            	}

						],  
						[
			            	'label' => 'Jadwal',
			            	'value' => function($data)
			            	{
			            		$assessee_id_model = ProjectActivityMeta::find()
			            		->andWhere(['project_activity_id' => $data->id])
			            		->andWhere(['type' => 'schedule'])
			            		->andWhere(['key' => 'scheduled'])->One();

								return $assessee_id_model->value;

			            	}

						],  
			            [
			            	'label' => 'Assessor',
			            	'format' => 'raw',
			            	'value' => function($data)
			            	{
			            		$assessee_id_model = ProjectActivityMeta::find()
			            		->andWhere(['project_activity_id' => $data->id])
			            		->andWhere(['type' => 'general'])->andWhere(['<>','value','2'])
			            		->andWhere(['key' => 'assessor'])->All();
			            		$assessor_list = '';
			            		foreach ($assessee_id_model as $key => $value) {
			            			$assessee_model = Profile::findOne($value->value);
			            		$fn = isset($assessee_model->first_name ) ? $assessee_model->first_name : '';
			            		$ln = isset($assessee_model->last_name) ? $assessee_model->last_name : '';
			            			$assessor_list = $assessor_list .' ,' . $fn .' ' . $ln;
			            		}
			            	
			            		


			                return substr($assessor_list,2) .	Html::a('change' , ['project/choose', 'id' => $data->id], 
			            				[
        				'class' => 'btn btn-warning',
        		'data' => [
          //  'confirm' => Yii::t('app', 'PERHATIAN!! : Anda akan menambahkan diri '.$userprofile->first_name.' sebagai assessor'),
            'method' => 'post',
        			],
        		]);


			            	}

			            ],
			            [
			            	'label' => 'Second Opinion',
			            	'format' => 'raw',
			            	'value' => function($data)
			            	{
			            		$assessee_id_model = ProjectActivityMeta::find()
			            		->andWhere(['project_activity_id' => $data->id])
			            		->andWhere(['type' => 'general'])
			            		->andWhere(['key' => 'second_opinion'])
			->andWhere(['attribute_1' => null])
			            		->All();
			            		$assessor_list = '';
			            		foreach ($assessee_id_model as $key => $value) {
			            			$assessee_model = Profile::findOne($value->value);
			            		$fn = isset($assessee_model->first_name ) ? $assessee_model->first_name : '';
			            		$ln = isset($assessee_model->last_name) ? $assessee_model->last_name : '';
			            			$assessor_list = $assessor_list .' ,' . $fn .' ' . $ln;
			            		}
			            	
			            		
			                return substr($assessor_list,2) .	Html::a('change' , ['project/chooseso', 'id' => $data->id], 
			            				[
        				'class' => 'btn btn-warning',
        		'data' => [
          //  'confirm' => Yii::t('app', 'PERHATIAN!! : Anda akan menambahkan diri '.$userprofile->first_name.' sebagai assessor'),
            'method' => 'post',
        			],
        		]);
			            	}

			            ],
			            [
			            	'label' => '2nd SO',
			            	'format' => 'raw',
			            	'value' => function($data)
			            	{
			            		$assessee_id_model = ProjectActivityMeta::find()
			            		->andWhere(['project_activity_id' => $data->id])
			            		->andWhere(['type' => 'general'])
			            		->andWhere(['key' => 'second_opinion'])
								->andWhere(['attribute_1' => '2nd_so'])
			            		->All();
			            		$assessor_list = '';
			            		foreach ($assessee_id_model as $key => $value) {
			            			$assessee_model = Profile::findOne($value->value);
			            		$fn = isset($assessee_model->first_name ) ? $assessee_model->first_name : '';
			            		$ln = isset($assessee_model->last_name) ? $assessee_model->last_name : '';
			            			$assessor_list = $assessor_list .' ,' . $fn .' ' . $ln;
			            		}
			            	
			            		
			                return substr($assessor_list,2) .	Html::a('change' , ['project/chooseso2', 'id' => $data->id], 
			            				[
        				'class' => 'btn btn-warning',
        		'data' => [
          //  'confirm' => Yii::t('app', 'PERHATIAN!! : Anda akan menambahkan diri '.$userprofile->first_name.' sebagai assessor'),
            'method' => 'post',
        			],
        		]);
			            	}

			            ],
						[
							'label' => 'Status',
							'format' => 'Raw',
		            	'value' => function($data)
			            	{
			            		$assessee_id_model = ProjectActivityMeta::find()
			            		->andWhere(['project_activity_id' => $data->id])
			            		->andWhere(['type' => 'assessment'])
			            		->andWhere(['key' => 'status'])->One();

								//return '<h1>'.$assessee_id_model->value.'</h1>';
					

			                return $assessee_id_model->value .	Html::a('change' , ['project/changestatus', 'id' => $data->id], 
			            				[
        				'class' => 'btn btn-warning',
        		'data' => [
          //  'confirm' => Yii::t('app', 'PERHATIAN!! : Anda akan menambahkan diri '.$userprofile->first_name.' sebagai assessor'),
            'method' => 'post',
        			],
        		]);

			            	} 

			            ],  												
			        ],
			    ]);


=======
<?php
use app\modules\projects\models\Project;
use app\modules\projects\models\ProjectMeta;
use app\modules\projects\models\ProjectActivity;
use app\modules\projects\models\ProjectActivitySearch;
use app\modules\projects\models\ProjectActivityMeta;
use common\modules\profile\models\Profile;
use common\modules\profile\models\ProfileMeta;
use yii\data\ActiveDataProvider;
//use Yii;
use Yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;


?>
<hr/>
<?php 
echo '<h3>Admin Functions</h3>';
echo Html::a('Find activity', ['/projects/project/findactivity', 'id' => $_GET['id']], ['class' => 'btn btn btn-info']);
echo '   ';
echo Html::a('Map Assessor', ['/projects/activity/mapassessor', 'id' => $_GET['id']], ['class' => 'btn btn btn-info']);
echo '<hr/>';
echo '<h3>Admin Dashboard</h3>';


$profile_model = Profile::find()->andWhere(['user_id' => Yii::$app->user->id])->One();

            $distinct_assessor_activities_model = ProjectActivityMeta::find()
                ->andWhere(['type' => 'general'])
                ->andWhere(['key' => 'assessor'])
                ->andWhere(['value' => $profile_model->id])
                ->asArray()->All();
    
    $assessor_activity_ids = ArrayHelper::getColumn($distinct_assessor_activities_model, 'project_activity_id');

    $activityQuery = ProjectActivity::find()
                ->andWhere(['project_id' => $_GET['id']])
            ->andWhere(['status' => 'active'])
       //->andWhere(['in','id',$assessor_activity_ids])
            ;


 $activitySearchModel = new ProjectActivitySearch;
if(Yii::$app->request->queryParams) {
	$params = Yii::$app->request->queryParams;
	$params['ProjectActivitySearch']['project_id'] = $_GET['id'];
	//print_r($params);
      $activityDataProvider = $activitySearchModel->search($params);
} else {


/*
				$activityDataProvider = new ActiveDataProvider([
			    'query' => $activityQuery,
			    'pagination' => [
			        'pageSize' => 40,
			    ],
			    'sort' => [
			        'defaultOrder' => [
			        ]
			    ],
			]);
*/

}


              





/*
 echo GridView::widget([
			        'dataProvider' => $activityDataProvider,
			        'filterModel' => $activitySearchModel,
			        'columns' => [
			            //['class' => 'yii\grid\SerialColumn'],

			            //'id',
			            [
			            	'label' => 'Activity',
			            	'attribute' => 'id',
			            	'format' => 'raw',
			            	'value' => function($data){
			            		$link = Html::a($data->id, ['activity/view', 'id' => $data->id], ['class' => 'profile-link']);
			            		return $link;
			            	}
			            ],
			            [
			            'label' => 'Name',
			     		'attribute' => 'name',
			     		   'value' => function($data)
			     		   {
			     		   	return $data->name;
			     		   }
			            ],

			            [
			            'label' => 'Assessor',
			     		'attribute' => 'assessor',
			     		   'value' => function($data)
			     		   {
			     		   	$returnstring = '';
			     		   	foreach ($data->assessors as $key => $value) {
			     		   		$returnstring = $returnstring . ' ; ' . $value->assessor->first_name . ' ' . $value->assessor->last_name;
			     		   	}
			     		   	return $returnstring;
			     		   }
			            ],
            				            'status',

			        ],
			    ]);

*/

			 echo GridView::widget([
			        'dataProvider' => $activityDataProvider,
			        'filterModel' => $activitySearchModel,
			        'columns' => [
			            //['class' => 'yii\grid\SerialColumn'],
			            [
			            	'label' => 'Activity',
			            	'attribute' => 'id',
			            	'format' => 'raw',
			            	'value' => function($data){
			            		$link = Html::a($data->id, ['activity/view', 'id' => $data->id], ['class' => 'profile-link']);
			            		return $link;
			            	}
			            ],
			            //'project_id',

				            'name',
            				          //  'status',
				            [
				            	'label' => 'test',
				            	//'attribute' => 'project_activity_meta.key',
				            ],
			            [
			            'label' => 'Assessor',
			     		'attribute' => 'assessor',
			     		   /*'value' => function($data)
			     		   {
			     		   	$returnstring = '';
			     		   	foreach ($data->assessors as $key => $value) {
			     		   		$returnstring = $returnstring . ' ; ' . $value->assessor->first_name . ' ' . $value->assessor->last_name;
			     		   	}
			     		   	return $returnstring;
			     		   }
			     		   */
			            ],
            				

			        ],
			    ]);


//echo '<pre>';
//print_r($_REQUEST);

>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
?>