<?php

namespace app\modules\projects\controllers;

use Yii;
use app\modules\projects\models\Catalog;
use app\modules\projects\models\CatalogSearch;
use app\modules\projects\models\CatalogMeta;
use app\modules\projects\models\CatalogMetaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminController implements the CRUD actions for Catalog model.
 */
class AdminController extends Controller
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
     * Lists all Catalog models.
     * @return mixed
     */
    public function actionCatalog($id)
    {
        $searchModel = new CatalogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('catalog', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Catalog Meta models.
     * @return mixed
     */
    public function actionCatalogmeta()
    {
        $searchModel = new CatalogMetaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('catalog_meta', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Catalog model.
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
     * Displays a single CatalogMeta model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewmeta()
    {
        return $this->render('view_meta', [
            'model' => $this->findCatalogMeta(Yii::$app->request->queryParams),
        ]);
    }

    /**
     * Creates a new Catalog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Catalog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Catalog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatemeta()
    {
        $model = new CatalogMeta();        

        if (null != Yii::$app->request->post()) {
            // print_r(Yii::$app->request->post()); die();
            
            $model->load(Yii::$app->request->post()) && $model->save();
            return $this->redirect(['viewmeta?catalog_id='.$model->catalog_id.'&value='.$model->value]);
        } else {
            return $this->render('create_meta', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Catalog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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

    public function actionUpdatemeta($catalog_id, $value)
    {
        $model = $this->findCatalogMeta(array(
            'catalog_id' => $catalog_id, 
            'value' => $value, 
        ));

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
                'viewmeta', 
                'catalog_id' => $model->catalog_id, 
                'value' => $model->value
            ]);
        } 
        else {
            return $this->render('update_meta', [
                'model' => $model,
            ]);
        }        
    }

    /**
     * Deletes an existing Catalog model.
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
     * Deletes an existing Catalog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeletemeta($catalog_id, $value)
    {
        $query = array('catalog_id' => $catalog_id, 'value' => $value);
        $this->findCatalogMeta($query)->delete();

        return $this->redirect([
            'catalogmeta'            
        ]);
    }

    /**
     * Finds the Catalog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Catalog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Catalog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findCatalogMeta($queryParams)
    {
        $searchModel = new CatalogMetaSearch();
        $dataProvider = $searchModel->search($queryParams);

        return CatalogMeta::findOne($queryParams);

        // print_r($queryParams); die();
    }
}