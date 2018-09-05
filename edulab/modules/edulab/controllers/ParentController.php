<?php

namespace app\modules\edulab\controllers;
use common\modules\profile\models\ProfileExtended;
use common\modules\profile\models\ProfileGeneral;
use yii\base\ErrorException;
use yii\web\NotFoundHttpException;
use yii\base\ViewNotFoundException;
use common\modules\assessment\models\Assessment;
use common\modules\assessment\models\AssessmentResult;
use yii\web\Controller;
use Yii;
use common\modules\organization\models\OrganizationAdminuser;
use common\modules\catalog\models\CatalogGeneral;
use yii\data\ActiveDataProvider;
use common\models\Notification;
use common\modules\core\models\Message;
use common\modules\assessment\models\TakerSearch;
/**
 * Default controller for the `edulab` module
 */
class ParentController extends Controller
{

	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}



    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {




        $query = ProfileExtended::find()
        ->andWhere(['type' => 'childof'])
        //->andWhere(['key' => 'childof'])
        ->andWhere(['key' => Yii::$app->user->id]);


    $DataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);

        return $this->render('index',
                [
            'dataProvider' => $DataProvider,
        ]);
           
        
        
    }



    public function actionAddchild()
    {
        $model = new ProfileExtended();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->type = 'childof';
            $model->key = (string) Yii::$app->user->id;
            $model->value = 'false';
            if ($model->save()) {

                    $userprofile = ProfileGeneral::find()->andWhere(['user_id' => Yii::$app->user->id])->One();
                   $newmessage = new Message;
                   $newmessage->type = 'notificattion';
                   $newmessage->message = 'You have been added as ' . $userprofile->first_name  . ' ' . $userprofile->last_name. '`s child';
                   $newmessage->status = 'active';
                   if ($newmessage->save()) {
                                       Yii::$app->session->addFlash('success', 'Child is added with you as parent');
                   Notification::notify(Notification::KEY_NEW_MESSAGE, $model->user_id, $newmessage->id);
               return $this->redirect(['index']);
           } else {
            print_r($newmessage->errors);
           }

            } else {
                //echo '<pre>';
                //print_r($model->errors);
                //print_r($model);

                     throw new NotFoundHttpException('invalid or duplicate value');
            }
        } else {
            return $this->render('addchild', [
                'model' => $model,
            ]);
        }
    }

    public function actionRemovechild($user_id, $type, $key )
    {
        echo 'sa';
                $model = ProfileExtended::find()
                ->andWhere(['user_id' => (string) $user_id])
                ->andWhere(['type' => $type])
                ->andWhere(['key' => (string) $key])
                //->andWhere(['value' => 'true'])
                ->One();

                if(isset($model)) {
                    //echo 'ffff';
                    if($model->delete())
                    {
                         Yii::$app->session->addFlash('success', 'Child is deleted');
                                       return $this->redirect(['index']);

                    } else {
                        print_r($model->errors);
                    }

                } else {
                                 //     echo 'uuuuu';
                      print_r($model);
                }
        


    }

    public function actionView($user_id)
    {
            $model = ProfileGeneral::findOne($user_id);
            return $this->render('view', [
                'model' => $model,
            ]);
    }


        public function beforeAction($event)
    {

$parent = ProfileExtended::find()
->andWhere(['user_id' => Yii::$app->user->id])
->andWhere(['type' => 'edulab'])
->andWhere(['key' => 'isparent'])
->andWhere(['value' => 'true'])
->One();

        if(!isset($parent)) {
            throw new NotFoundHttpException('Not a parent');
        }
        return parent::beforeAction($event);
    }



}
