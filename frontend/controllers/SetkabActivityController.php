<?php

namespace frontend\controllers;

use Yii;
use frontend\models\SetkabActivity;
use frontend\models\SetkabAssessee;
use frontend\models\SetkabLkj;
use frontend\models\SetkabActivitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\helpers\VarDumper;
use yii\data\SqlDataProvider;
use app\modules\projects\models\ProjectAssessment;
/**
 * SetkabActivityController implements the CRUD actions for SetkabActivity model.
 */
class SetkabActivityController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SetkabActivity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SetkabActivitySearch();
		$params = Yii::$app->request->queryParams;
		$params['SetkabActivitySearch']['assessor_id'] = '127';
        $dataProvider = $searchModel->search($params);

	
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
		
		
		//echo Yii::$app->user->id;
		//echo '<pre>';
		//print_r($params);
		
    }

    /**
     * Displays a single SetkabActivity model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SetkabActivity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SetkabActivity();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SetkabActivity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SetkabActivity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SetkabActivity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SetkabActivity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SetkabActivity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }





	public function actionDebug($id)
	{




	}




	public function actionSubmit($id)
	{
        echo 'validasi data laporan. kalua belum maka ditolak';
		
		$limit_kompetensi = 500;
		$limit_kelemahan = 300;
		$limit_kekuatan = 300;
		$limit_saran = 300;
		$limit_exsum = 1000;
        //cek jumlah karakter tiap uraian
        $model = $this->findModel($id);
        echo $integritas_uraian = str_word_count(strip_tags($model->integritas_uraian));
        echo $kerjasama_uraian = str_word_count(strip_tags($model->kerjasama_uraian));
        echo $komunikasi_uraian = str_word_count(strip_tags($model->komunikasi_uraian));
        echo $integritas_uraian = str_word_count(strip_tags($model->integritas_uraian));
        echo $orientasihasil_uraian = str_word_count(strip_tags($model->orientasihasil_uraian));
        echo $pelayananpublik_uraian = str_word_count(strip_tags($model->pelayananpublik_uraian));
        echo $pengembangandiri_uraian = str_word_count(strip_tags($model->pengembangandiri_uraian));
        echo $pengelolaanperubahan_uraian = str_word_count(strip_tags($model->pengelolaanperubahan_uraian));
        echo $pengambilankeputusan_uraian = str_word_count(strip_tags($model->pengambilankeputusan_uraian));
        echo $perekatbangsa_uraian = str_word_count(strip_tags($model->perekatbangsa_uraian));
        echo $kekuatan = str_word_count(strip_tags($model->kekuatan));
        echo $kelemahan = str_word_count(strip_tags($model->kelemahan));
        echo $exsum = str_word_count(strip_tags($model->executive_summary));
        echo $saran = str_word_count(strip_tags($model->saran));

	



	}
	




	public function actionPdf($id)
	{

    $activityAssesse= $this->findModel($id);

    $profile = SetkabAssessee::find(["id" => $id])->one();

    $idAssessor = $activityAssesse['assessor_id'];

    $profileAssessor = SetkabAssessee::find(["id" => $idAssessor])->one();

    $project_assessment_model = ProjectAssessment::find()
                                    ->andWhere(['activity_id' => $id])
                                    ->andWhere(['status' => 'active'])
                                    ->One();

    $kompetensiSQLDataProvider = new SqlDataProvider([
        'sql' => 'select * from (select table1.id,table1.project_assessment_id,
      table1.type,table1.key,table1.value,table1.attribute_1,table1.attribute_2,table1.attribute_3,
       table1.catalog_id, catalog_meta.attribute_3 * 1 as ordering,
       catalog_meta.attribute_1 as standar
       from (SELECT project_assessment_result.id, project_assessment_result.project_assessment_id,
        project_assessment_result.type, project_assessment_result.key, project_assessment_result.value,
        project_assessment_result.attribute_1, project_assessment_result.attribute_2,
        project_assessment_result.attribute_3, project_assessment.catalog_id FROM `project_assessment_result`
         join project_assessment on project_assessment_result.project_assessment_id = project_assessment.id
         where project_assessment_result.project_assessment_id = :project_assessment_id  AND project_assessment_result.type ="kompetensigram") as table1
    join catalog_meta
    on
    table1.catalog_id = catalog_meta.catalog_id
    and table1.type = catalog_meta.type
    and table1.key = catalog_meta.value) as table2 ORDER BY table2.type, table2.ordering',
        'params' => [':project_assessment_id' => $project_assessment_model['id']],
        //'totalCount' => $count,
        'sort' => [
            'attributes' => [
               // 'age',
                /*'name' => [
                    'asc' => ['first_name' => SORT_ASC, 'last_name' => SORT_ASC],
                    'desc' => ['first_name' => SORT_DESC, 'last_name' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Name',
                ],
                */
            ],
        ],
        'pagination' => [
            'pageSize' => 20,
        ],
    ]);

		return $this->renderPartial('pdf',['activity'=>$activityAssesse, 'profile' => $profile,'assessor' => $profileAssessor, 'kompetensi' => $kompetensiSQLDataProvider ]);
		// VarDumper::dump($profile);

	}




    public function actionExsum($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('exsum', [
                'model' => $model,
            ]);
        }
    }

    public function actionDatadiri($id)
    {
        $model = $this->findModel($id);
		$assessee_model = SetkabAssessee::findOne($model->assessee_id);
        if ($assessee_model->load(Yii::$app->request->post()) && $assessee_model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('datadiri', [
                'model' => $assessee_model,
            ]);
        }
    }
    public function actionPsikogram($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('psikogram', [
                'model' => $model,
            ]);
        }
    }
    public function actionKelemahan($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('kelemahan', [
                'model' => $model,
            ]);
        }
    }
    public function actionKekuatan($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('kekuatan', [
                'model' => $model,
            ]);
        }
    }
    public function actionSaran($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('saran', [
                'model' => $model,
            ]);
        }
    }






    public function actionIntegritas($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if (Yii::$app->request->post('submit2') == 'refresh') {
				            return $this->render('integritas', [
                'model' => $model,
            ]);
			} else {

            return $this->redirect(['view', 'id' => $model->id]);
			}
        } else {
            return $this->render('integritas', [
                'model' => $model,
            ]);
        }

    }


	    public function actionPerekatbangsa($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if (Yii::$app->request->post('submit2') == 'refresh') {
				            return $this->render('perekatbangsa', [
                'model' => $model,
            ]);
			} else {

            return $this->redirect(['view', 'id' => $model->id]);
			}
        } else {
            return $this->render('perekatbangsa', [
                'model' => $model,
            ]);
        }

    }

	    public function actionPengambilankeputusan($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if (Yii::$app->request->post('submit2') == 'refresh') {
				            return $this->render('pengambilankeputusan', [
                'model' => $model,
            ]);
			} else {

            return $this->redirect(['view', 'id' => $model->id]);
			}
        } else {
            return $this->render('pengambilankeputusan', [
                'model' => $model,
            ]);
        }

    }

	    public function actionPerubahan($id)
    {
        $model = $this->findModel($id);
		$assessee_model = SetkabAssessee::findOne($model->assessee_id);
		$lkj = SetkabLkj::find()->andWhere(['level' => strtolower($assessee_model->level)])->One();
		if (sizeof($lkj) == 0) {
			$lkj = new SetkabLkj;
		}
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if (Yii::$app->request->post('submit2') == 'refresh') {
				            return $this->render('perubahan', [
							'lkj' => $lkj,
                'model' => $model,
            ]);
			} else {

            return $this->redirect(['view', 'id' => $model->id]);
			}
        } else {
            return $this->render('perubahan', [
					'lkj' => $lkj,
                'model' => $model,
            ]);
        }

		//echo $assessee_model->level;
    }




}
