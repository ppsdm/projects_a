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
use common\modules\organization\models\OrganizationAdminuser;
use common\modules\catalog\models\CatalogGeneral;
use yii\data\ActiveDataProvider;
use common\modules\profile\models\UserCredit;
use common\modules\profile\models\UserTransaction;
use yii\db\Expression;
use common\models\User;

use common\modules\assessment\models\TakerSearch;
/**
 * Default controller for the `edulab` module
 */
class AdminController extends Controller
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

        $status_array = ['active', 'inactive', 'pending'];
        $query = CatalogGeneral::find()
        ->andWhere(['type' => 'assessment'])
        ->andWhere(['attribute1' => 'tryout'])
        ->andWhere(['in', 'status', $status_array]);


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

    public function actionList()
    {

    }

    public function actionReport($catalog_id)
    {

            $searchModel = new TakerSearch();
       // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);



    $searchparams = Yii::$app->request->queryParams;
    $searchparams['TakerSearch']['catalog_id'] = $catalog_id;
        $takers = $searchModel->search($searchparams);


echo 'raport for ' . $catalog_id;
$im1=Yii::getAlias('@app').'/modules/edulab/views/assessment/takers_'.$catalog_id.'.php';

if (file_exists($im1)) {
    return $this->render('@app/modules/edulab/views/assessment/takers_' . $catalog_id,[
        'takers' => $takers,'searchModel' => $searchModel,
        ]);
} else {
    echo 'takers_ ' . $catalog_id. ' doesnt exists';
}
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

    public function actionTopup()
    {

            $usercredit = New UserCredit();
            $post = New UserCredit();
 if($post->load(Yii::$app->request->post())) {
    
                $usercredit = UserCredit::find()->andWhere(['user_id' => $post->user_id])
                ->andWhere(['credit_type' => 'credit'])
                ->andWhere(['status' => 'active'])
                ->One();
                
                if(isset($usercredit)) {
                    if($_POST['deltapoint']) {
                        //echo $_POST['deltapoint'];
                        $usercredit->credit_point = $usercredit->credit_point + $_POST['deltapoint'];
                        $usercredit->save();

            $usertransaction = new UserTransaction;
            $usertransaction->user_id = Yii::$app->user->id;
            $usertransaction->credit_type = 'credit';
            $usertransaction->credit_point = $_POST['deltapoint'];
            $usertransaction->transaction_type = 'topup';
            $usertransaction->timestamp = new Expression('NOW()');
            $usertransaction->save();


                                   Yii::$app->session->addFlash('success', 'credit point is added');
                    }

                } else {
                            $isuserexist = User::findOne($post->user_id);
                            if (null !== $isuserexist) {
                                    $usercredit = New UserCredit();
                                    $usercredit->user_id = $post->user_id;
                                    $usercredit->status = 'active';
                                    $usercredit->credit_type = 'credit';
                                    $usercredit->credit_point = 0;
                                    $usercredit->save();



                                            Yii::$app->session->addFlash('success', 'new user credit account');
                            } else {
                                 Yii::$app->session->addFlash('warning', 'user ID invalid');
                                 $usercredit = New UserCredit();
                             }
                                
                }

 } 
        return $this->render('topup',
                [
            'model' => $usercredit,
        ]);


    }


    public function actionParent()
    {

        $newparent = new ProfileExtended;

 if($newparent->load(Yii::$app->request->post())) {
    $newparent->type = 'edulab';
    $newparent->key = 'isparent';


$alreadyexist = ProfileExtended::find()->andWhere(['user_id' => $newparent->user_id])->andWhere(['type' => 'edulab'])->andWhere(['key' => 'isparent'])->One();

if(null !== $alreadyexist) {
    $alreadyexist->value = 'true';
    $alreadyexist->save();
                                                Yii::$app->session->addFlash('success', 'change to parent');
} else {
    $newparent->value = 'true';
    $newparent->save();
                                                Yii::$app->session->addFlash('success', 'new parent added');
                               //                 print_r($newparent->errors);
}


 }

        return $this->render('parent',
                [
                'model'=> $newparent,
        //    'dataProvider' => $DataProvider,
        ]);
    }


        public function beforeAction($event)
    {

/*$admin = OrganizationAdminuser::find()
->andWhere(['user_id' => Yii::$app->user->id])
->andWhere(['status' => 'active'])
->One();

        if(!isset($admin)) {
            throw new NotFoundHttpException('Not an Admin User');
        }


*/
$this->layout = 'admin';

        $admin = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['type' => 'edulab'])
        ->andWhere(['key' => 'isadmin'])
        ->andWhere(['value' => 'true'])
        ->One();


      if ($admin) {

      } else {
            throw new NotFoundHttpException('Not an Admin User');
      }




        return parent::beforeAction($event);
    }



}
