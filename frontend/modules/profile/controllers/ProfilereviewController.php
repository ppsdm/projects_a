<?php

namespace app\modules\profile\controllers;

use Yii;
use app\modules\profile\models\Profile;
use app\modules\profile\models\ProfileMeta;
use app\modules\profile\models\ProfileReview;
use app\modules\profile\models\ProfileReviewSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ProfilereviewController implements the CRUD actions for ProfileReview model.
 */
class ProfilereviewController extends Controller
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
     * Lists all ProfileReview models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProfileReviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProfileReview model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProfileReview model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProfileReview();

        $profi = Profile::find()->andWhere(['user_id' => Yii::$app->user->id])->One();
        $assessors_model = ProfileMeta::find()->andWhere(['type' => 'global'])->andWhere(['key' => 'role'])->andWhere(['value' => 'assessor'])->asArray()->All();
        $assessors = ArrayHelper::map($assessors_model, 'profile_id', function($data){
            $profile = Profile::findOne($data['profile_id']);

            return $profile->first_name;
        });
        
        $model->reviewer_id = $profi->id;


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                          'assessors' => $assessors,
            ]);
        }
    }

    /**
     * Updates an existing ProfileReview model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        $profi = Profile::find()->andWhere(['user_id' => Yii::$app->user->id])->One();
        $assessors_model = ProfileMeta::find()->andWhere(['type' => 'global'])->andWhere(['key' => 'role'])->andWhere(['value' => 'assessor'])->asArray()->All();
        $assessors = ArrayHelper::map($assessors_model, 'profile_id', function($data){
            $profile = Profile::findOne($data['profile_id']);

            return $profile->first_name;
        });
        


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'assessors' => $assessors,
            ]);
        }
    }

    /**
     * Deletes an existing ProfileReview model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProfileReview model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProfileReview the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProfileReview::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
