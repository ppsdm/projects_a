<<<<<<< HEAD
<?php

namespace app\modules\projects\controllers;

use app\modules\projects\models\Project;
use app\modules\projects\models\ProjectMeta;
use app\modules\projects\models\ProjectActivity;
use app\modules\projects\models\ProjectActivityMeta;
use common\modules\profile\models\Profile;
use common\modules\profile\models\ProfileMeta;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use Yii;
use Yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

class ProjectController extends \yii\web\Controller
{

public function init()
{
    parent::init();

    Yii::$app->user->loginUrl = '../../site/login';
}


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['batch', 'signup'],
                'rules' => [
                    [
                        //'actions' => ['batch'],
                        'allow' => true,
                        'roles' => ['@'],
                                'denyCallback' => function($rule, $action) {
                          Yii::$app->session->addFlash('success', 'status saved');
             //  return Yii::$app->response->redirect(['../../loginaaaa']);
            },
                    ],
                    /*[
                        'actions' => ['batch'],
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    */

                ],
            ],


            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }



    public function actionIndex()
    {
        return $this->render('index');

        
    }


    public function actionChangestatus($id)
    {
        $project_activity_model = ProjectActivity::findOne($id);
        $assessor_model = ProjectActivityMeta::find()->andWhere(['project_activity_id' => $id])->andWhere(['key' => 'status'])
        //->andWhere(['<>','value','2'])
        ->One();
        if (null !== $assessor_model)
        {

        } else {
            $assessor_model = new ProjectActivityMeta;
            $assessor_model->key = 'status';
            $assessor_model->type = 'general';
            $assessor_model->project_activity_id = $id;
        }

        if($_POST){
            $assessor_model->value = $_POST['ProjectActivityMeta']['value'];
            $assessor_model->save();
          Yii::$app->session->addFlash('success', 'status saved');
              return $this->redirect(['project/dashboard', 'id' => $project_activity_model->project_id]);

        }



    return $this->render($project_activity_model->project_id . '/changestatus',
        [
        'assessor_model' => $assessor_model,
            ]);
    }




    public function actionChoose($id)
    {
        $project_activity_model = ProjectActivity::findOne($id);
        $assessor_model = ProjectActivityMeta::find()->andWhere(['project_activity_id' => $id])->andWhere(['key' => 'assessor'])
        ->andWhere(['<>','value','2'])->One();
        if (null !== $assessor_model)
        {

        } else {
            $assessor_model = new ProjectActivityMeta;
            $assessor_model->key = 'assessor';
            $assessor_model->type = 'general';
            $assessor_model->project_activity_id = $id;
        }

        if($_POST){
            $assessor_model->value = $_POST['ProjectActivityMeta']['value'];
            $assessor_model->save();
          Yii::$app->session->addFlash('success', 'assessor saved');
              return $this->redirect(['project/dashboard', 'id' => $project_activity_model->project_id]);

        }



    return $this->render($project_activity_model->project_id . '/choose',
        [
        'assessor_model' => $assessor_model,
            ]);
    }

    public function actionChooseso($id)
    {
        $project_activity_model = ProjectActivity::findOne($id);
        $assessor_model = ProjectActivityMeta::find()->andWhere(['project_activity_id' => $id])
        ->andWhere(['attribute_1'=>null])
        ->andWhere(['key' => 'second_opinion'])
        ->andWhere(['<>','value','2'])->One();
        if (null !== $assessor_model)
        {

        } else {
            $assessor_model = new ProjectActivityMeta;
            $assessor_model->key = 'second_opinion';
            $assessor_model->type = 'general';
            $assessor_model->project_activity_id = $id;
        }

        if($_POST){
            $assessor_model->value = $_POST['ProjectActivityMeta']['value'];
            $assessor_model->save();
          Yii::$app->session->addFlash('success', 'SO saved');
              return $this->redirect(['project/dashboard', 'id' => $project_activity_model->project_id]);

        }



    return $this->render($project_activity_model->project_id . '/chooseso',
        [
        'assessor_model' => $assessor_model,
            ]);
    }


    public function actionChooseso2($id)
    {
        $project_activity_model = ProjectActivity::findOne($id);
        $assessor_model = ProjectActivityMeta::find()->andWhere(['project_activity_id' => $id])
        ->andWhere(['attribute_1' => '2nd_so'])
        ->andWhere(['key' => 'second_opinion'])
        ->andWhere(['<>','value','2'])->One();
        if (null !== $assessor_model)
        {

        } else {
        $existing_model = ProjectActivityMeta::find()->andWhere(['project_activity_id' => $id])
        ->andWhere(['attribute_1' => null])
        ->andWhere(['key' => 'second_opinion'])
        ->andWhere(['<>','value','2'])->One();


            $assessor_model = new ProjectActivityMeta;
            $assessor_model->key = 'second_opinion';
            $assessor_model->type = 'general';
            $assessor_model->attribute_1 = '2nd_so';
            $assessor_model->project_activity_id = $id;
        }

        if($_POST){
            if ($existing_model->value == $_POST['ProjectActivityMeta']['value'])
            {
 Yii::$app->session->addFlash('danger', 'SO cannot be 2nd SO');
      } else {
        $assessor_model->value = $_POST['ProjectActivityMeta']['value'];
            $assessor_model->save();
          Yii::$app->session->addFlash('success', '2nd SO saved');
      }

              return $this->redirect(['project/dashboard', 'id' => $project_activity_model->project_id]);

        }



    return $this->render($project_activity_model->project_id . '/chooseso2',
        [
        'assessor_model' => $assessor_model,
            ]);
    }


    public function actionFindactivity($id)
    {

        if ($_POST){
            echo $_POST['assessorname'];
        }
        return $this->render('findactivity');
    }

    public function beforeAction($action) {


 // Log::add(Yii::$app->controller->id, $action->id,'activity');

//echo "test";

    return parent::beforeAction($action);
}
    public function actionAdminbatch($id, $batch){

            if (Yii::$app->user->isGuest) {
                echo 'you have to login first!';
            }
            else {
        $profile_model = Yii::$app->user->identity->profile->id;
        //Profile::find()->andWhere(['user_id' => Yii::$app->user->id])->One();
        

        if (null !== $profile_model) {
            $project_meta_model = ProfileMeta::find()
                ->andWhere(['type' => 'project-role'])
                ->andWhere(['profile_id' => Yii::$app->user->identity->profile->id])
                ->andWhere(['key' => $id])
                ->All();
            if(sizeof($project_meta_model) > 0 ) {
            
            
            return $this->render('adminbatch',[
                    'project_meta_model' => $project_meta_model,
             'id' => $id,
             'batch' => $batch
                    //'assessor_activity_ids' => $assessor_activity_ids,
                ]);
                }
                else echo "no project";
        } else {
            echo 'NO PROFILE YET ASSOCIATED WITH THIS USER!';
           }
        }


    }

    public function actionBatch($id, $batch){

            if (Yii::$app->user->isGuest) {
                echo 'you have to login first!';
            }
            else {
        $profile_model = Yii::$app->user->identity->profile->id;
        //Profile::find()->andWhere(['user_id' => Yii::$app->user->id])->One();
        

        if (null !== $profile_model) {
            $project_meta_model = ProfileMeta::find()
                ->andWhere(['type' => 'project-role'])
                ->andWhere(['profile_id' => Yii::$app->user->identity->profile->id])
                ->andWhere(['key' => $id])
                ->All();
            if(sizeof($project_meta_model) > 0 ) {
            
            
            return $this->render('batch',[
                    'project_meta_model' => $project_meta_model,
             'id' => $id,
             'batch' => $batch
                    //'assessor_activity_ids' => $assessor_activity_ids,
                ]);
                }
                else echo "no project";
        } else {
            echo 'NO PROFILE YET ASSOCIATED WITH THIS USER!';
           }
        }


    }
    
    public function actionDashboard($id)
    {

        if (Yii::$app->user->isGuest) {
            echo 'you have to login first!';
        }
        else {
        	$profile_model = Yii::$app->user->identity->profile->id;
            //Profile::find()->andWhere(['user_id' => Yii::$app->user->id])->One();
        

        	if (null !== $profile_model) {
        		$project_meta_model = ProfileMeta::find()
        			->andWhere(['type' => 'project-role'])
                    ->andWhere(['profile_id' => Yii::$app->user->identity->profile->id])
        			->andWhere(['key' => $id])
        			->All();
                if(sizeof($project_meta_model) > 0 ) {
                
                
            	   return $this->render('dashboard',[
            			'project_meta_model' => $project_meta_model,
                        //'assessor_activity_ids' => $assessor_activity_ids,
            		]);
                }
                
                else echo "no project";
        	} 
            else {
    		  echo 'NO PROFILE YET ASSOCIATED WITH THIS USER!';
    	   }
        }
    }

    public function actionActivities($profile_id, $project_id)
    {
        return $this->render('activities',[
             
            ]); 
    }

    public function actionEmailall($message)
    {

    }

    public function actionAssessorlist($id)
    {

            $assessor_query = ProfileMeta::find()
            ->andWhere(['type' => 'project-role'])
            ->andWhere(['key' => $id])
            ->andWhere(['value' => 'assessor'])->asArray()->All();

            $ids = ArrayHelper::getColumn($assessor_query, 'profile_id');

            $profile_query = Profile::find()->andWhere(['in','id',$ids]);

            $assessorDataProvider = new ActiveDataProvider([
                'query' => $profile_query,
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => [
                    'defaultOrder' => [
            //            'created_at' => SORT_DESC,
              //          'title' => SORT_ASC, 
                    ]
                ],
            ]);


        return $this->render('assessorlist',[
                'assessorDataProvider' => $assessorDataProvider,
            ]); 
    }


    public function actionCheckactivitiesstatuses($id)
    {
            $projects = ProjectActivity::find()->andWhere(['project_id' => $id])->asArray()->All();
            $ids = ArrayHelper::getColumn($projects, 'id');

            $activities_schedules = ProjectActivityMeta::find()->andWhere(['in','project_activity_id',$ids])->andWhere(['type' => 'schedule'])
            ->andWhere(['key' => 'scheduled'])->All();

            foreach ($activities_schedules as $key => $value) {
                # code...
                echo $key . ' : ' . $value->value;

                $date1 = new \DateTime("now");
                $date2 = new \DateTime($value->value);
$interval = date_diff($date1, $date2);
echo '--->  ' . $interval->format('%R%a days');

                echo '<br/>';
            }
        //check semua activities kalau ada yang mau atau sudah expired
        //yang sudah expire di rubah status dan kirim notifikasi
        //yang mau expire kirim notifikasi ke assessornya 
    }

    public function actionSelect()
    {
            $profile_model = Yii::$app->user->identity->profile->id;
            //Profile::find()->andWhere(['user_id' => Yii::$app->user->id])->One();
            if(null !== $profile_model)
            {
            $project_meta_models = ProfileMeta::find()
            ->andWhere(['type' => 'project-role'])
            ->andWhere(['profile_id' => Yii::$app->user->identity->profile->id])
            ->groupBy(['key'])->asArray()
            ->All();

            $projects_ids = ArrayHelper::getColumn($project_meta_models, 'key');


            $project_query = Project::find()
            ->andWhere(['in','id',$projects_ids]);

            $projectDataProvider = new ActiveDataProvider([
                'query' => $project_query,
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => [
                    'defaultOrder' => [
            //            'created_at' => SORT_DESC,
              //          'title' => SORT_ASC, 
                    ]
                ],
            ]);


//echo '<pre>';
            //print_r($project_models);
    	return $this->render('select',[
    			'projectDataProvider' => $projectDataProvider,
    		]);	
        
            } else {echo "ProFil kosong";}
            
    }

}
=======
<?php

namespace app\modules\projects\controllers;

use app\modules\projects\models\Project;
use app\modules\projects\models\ProjectMeta;
use app\modules\projects\models\ProjectActivity;
use app\modules\projects\models\ProjectActivityMeta;
use common\modules\profile\models\Profile;
use common\modules\profile\models\ProfileMeta;

use Yii;
use Yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

class ProjectController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');

        
    }

    public function actionFindactivity($id)
    {

        if ($_POST){
            echo $_POST['assessorname'];
        }
        return $this->render('findactivity');
    }

    public function beforeAction($action) {


 // Log::add(Yii::$app->controller->id, $action->id,'activity');

//echo "test";

    return parent::beforeAction($action);
}

    public function actionDashboard($id)
    {

            if (Yii::$app->user->isGuest) {
                echo 'you have to login first!';
            }
            else {
    	$profile_model = Yii::$app->user->identity->profile->id;
        //Profile::find()->andWhere(['user_id' => Yii::$app->user->id])->One();
        

    	if (null !== $profile_model) {
			
			if ($id == 5) {
				
				$this->redirect(['../setkab-activity/index']);
			}
    		$project_meta_model = ProfileMeta::find()
    			->andWhere(['type' => 'project-role'])
                ->andWhere(['profile_id' => Yii::$app->user->identity->profile->id])
    			->andWhere(['key' => $id])
    			->All();
            if(sizeof($project_meta_model) > 0 ) {
        	return $this->render('dashboard',[
        			'project_meta_model' => $project_meta_model,
                    //'assessor_activity_ids' => $assessor_activity_ids,
        		]);
        	
                }
                else echo "no project";
				
				

    	} else {
    		echo 'NO PROFILE YET ASSOCIATED WITH THIS USER!';
    	   }
        }
    }

    public function actionActivities($profile_id, $project_id)
    {
        return $this->render('activities',[
             
            ]); 
    }

    public function actionEmailall($message)
    {

    }

    public function actionAssessorlist($id)
    {

            $assessor_query = ProfileMeta::find()
            ->andWhere(['type' => 'project-role'])
            ->andWhere(['key' => $id])
            ->andWhere(['value' => 'assessor'])->asArray()->All();

            $ids = ArrayHelper::getColumn($assessor_query, 'profile_id');

            $profile_query = Profile::find()->andWhere(['in','id',$ids]);

            $assessorDataProvider = new ActiveDataProvider([
                'query' => $profile_query,
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => [
                    'defaultOrder' => [
            //            'created_at' => SORT_DESC,
              //          'title' => SORT_ASC, 
                    ]
                ],
            ]);


        return $this->render('assessorlist',[
                'assessorDataProvider' => $assessorDataProvider,
            ]); 
    }


    public function actionCheckactivitiesstatuses($id)
    {
            $projects = ProjectActivity::find()->andWhere(['project_id' => $id])->asArray()->All();
            $ids = ArrayHelper::getColumn($projects, 'id');

            $activities_schedules = ProjectActivityMeta::find()->andWhere(['in','project_activity_id',$ids])->andWhere(['type' => 'schedule'])
            ->andWhere(['key' => 'scheduled'])->All();

            foreach ($activities_schedules as $key => $value) {
                # code...
                echo $key . ' : ' . $value->value;

                $date1 = new \DateTime("now");
                $date2 = new \DateTime($value->value);
$interval = date_diff($date1, $date2);
echo '--->  ' . $interval->format('%R%a days');

                echo '<br/>';
            }
        //check semua activities kalau ada yang mau atau sudah expired
        //yang sudah expire di rubah status dan kirim notifikasi
        //yang mau expire kirim notifikasi ke assessornya 
    }

    public function actionSelect()
    {
            $profile_model = Yii::$app->user->identity->profile->id;
            //Profile::find()->andWhere(['user_id' => Yii::$app->user->id])->One();
            if(null !== $profile_model)
            {
            $project_meta_models = ProfileMeta::find()
            ->andWhere(['type' => 'project-role'])
            ->andWhere(['profile_id' => Yii::$app->user->identity->profile->id])
            ->groupBy(['key'])->asArray()
            ->All();

            $projects_ids = ArrayHelper::getColumn($project_meta_models, 'key');


            $project_query = Project::find()
            ->andWhere(['in','id',$projects_ids]);

            $projectDataProvider = new ActiveDataProvider([
                'query' => $project_query,
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => [
                    'defaultOrder' => [
            //            'created_at' => SORT_DESC,
              //          'title' => SORT_ASC, 
                    ]
                ],
            ]);


//echo '<pre>';
            //print_r($project_models);
    	return $this->render('select',[
    			'projectDataProvider' => $projectDataProvider,
    		]);	
    	//print_r($project_meta_models);
        
            } else {echo "ProFil kosong";}
            
    }

}
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
