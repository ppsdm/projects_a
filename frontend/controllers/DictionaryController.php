<?php

namespace frontend\controllers;

use Yii;
use common\modules\catalog\models\RefAssessmentDictionary;
use common\modules\catalog\models\RefAssessmentDictionarySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DictionaryController implements the CRUD actions for RefAssessmentDictionary model.
 */
class DictionaryController extends Controller
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
     * Lists all RefAssessmentDictionary models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefAssessmentDictionarySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefAssessmentDictionary model.
     * @param string $type
     * @param string $key
     * @param string $value
     * @return mixed
     */
    public function actionView($type, $key, $value)
    {
        return $this->render('view', [
            'model' => $this->findModel($type, $key, $value),
        ]);
    }

    /**
     * Creates a new RefAssessmentDictionary model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefAssessmentDictionary();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'type' => $model->type, 'key' => $model->key, 'value' => $model->value]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RefAssessmentDictionary model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $type
     * @param string $key
     * @param string $value
     * @return mixed
     */
    public function actionUpdate($type, $key, $value)
    {
        $model = $this->findModel($type, $key, $value);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'type' => $model->type, 'key' => $model->key, 'value' => $model->value]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RefAssessmentDictionary model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $type
     * @param string $key
     * @param string $value
     * @return mixed
     */
    public function actionDelete($type, $key, $value)
    {
        $this->findModel($type, $key, $value)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RefAssessmentDictionary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $type
     * @param string $key
     * @param string $value
     * @return RefAssessmentDictionary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($type, $key, $value)
    {
        if (($model = RefAssessmentDictionary::findOne(['type' => $type, 'key' => $key, 'value' => $value])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
