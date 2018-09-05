<?php

namespace app\modules\edulab\controllers;
use common\modules\profile\models\ProfileExtended;
use yii\base\ErrorException;
use yii\web\NotFoundHttpException;
use yii\base\ViewNotFoundException;
use common\modules\assessment\models\Assessment;
use common\modules\assessment\models\AssessmentResult;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `edulab` module
 */
class ReportController extends Controller
{

	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}

    public function actionView($catalog_id)
    {


                try{
             return $this->render('report_' . $catalog_id);
        } catch (\Exception $e) {
            //Yii::warning('no file found');
             return $this->render('error');
        //throw new NotFoundHttpException;
            //throw new ViewNotFoundException;
        }


    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

    	//throw new NotFoundHttpException;
    	$ed_level = ProfileExtended::find()
    	->andWhere(['type' => 'edulab'])
    	->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['key' => 'ed_level'])->One();
        

        if(null !== $ed_level)
        {
        		try{
        	 return $this->render($ed_level->value);
        } catch (\Exception $e) {
        	//Yii::warning('no file found');
             return $this->render('error');
        //throw new NotFoundHttpException;
        	//throw new ViewNotFoundException;
        }

        } else {
        	return $this->render('error');
           
        }
        
    }

    public function actionList()
    {

    }
    public function actionRanking($catalog_id)
    {
        echo 'catalog_id';
        $query = Assessment::find()->andWhere(['status' => 'finished'])->andWhere(['catalog_id' => $catalog_id]);
                return $this->render('ranking',['query' => $query]);
    }

/*
    public function actionError()
    {

    	$exception = Yii::$app->errorHandler->exception;
    	if($exception !== null){
    		return $this->render('error', ['exception' => $exception]);
    	}
    }
    */
}
