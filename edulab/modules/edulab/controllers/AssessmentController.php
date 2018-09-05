<?php

namespace app\modules\edulab\controllers;
use common\modules\assessment\models\Assessment;
use common\modules\assessment\models\AssessmentExtended;
use common\modules\assessment\models\TakerSearch;
use common\modules\assessment\models\AssessmentSearch;
use yii\data\ActiveDataProvider;



use common\modules\assessment\models\AssessmentResult;
use common\modules\tao\models\TaoUriMap;
use common\modules\tao\models\ResultsStorage;
use common\modules\tao\models\Statements;

use yii\helpers\Html;
use yii\helpers\Url;

use Yii;

class AssessmentController extends \common\modules\assessment\controllers\AssessmentController {
    // empty class

    public function actionChart()
    {

    	
		return $this->render('chart');
	}

	public function actionTakers($catalog_id)
	{





    $searchModel = new TakerSearch();
       // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);



    $searchparams = Yii::$app->request->queryParams;
    $searchparams['TakerSearch']['catalog_id'] = $catalog_id;
        $takers = $searchModel->search($searchparams);

$im1=Yii::getAlias('@app').'/modules/edulab/views/assessment/takers_'.$catalog_id.'.php';

if (file_exists($im1)) {
    return $this->render('takers_' . $catalog_id,['takers' => $takers,'searchModel' => $searchModel,]);
} else {
    echo 'takers_ ' . $catalog_id. ' doesnt exists';
}






	}








    public function actionStart($catalog_id)
    {   
        $assessment = Assessment::find()->andWhere(['catalog_id' => $catalog_id])->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['status' => 'active'])->One();
        if (null !== $assessment) { //if already registered
            $user = TaoUriMap::find()->andWhere(['id' => Yii::$app->user->id])->andWhere(['type' => 'user'])->One();
            $group = TaoUriMap::find()->andWhere(['id' => $catalog_id])->andWhere(['type' => 'group'])->One();
            $delivery = TaoUriMap::find()->andWhere(['id' => $catalog_id])->andWhere(['type' => 'delivery'])->One();
            //$launchUrl = 'http://localhost:8090/gamantha/oat/taoDelivery/DeliveryServer/initDeliveryExecution?uri=' . urlencode($delivery->uri);
            $returnUrl = Url::to(['result', 'catalog_id' => $catalog_id],true);
            //http://localhost:8090/gamantha/pao/edulab/web/index.php/edulab/assessment/getresult?id=20
            //http://localhost:8090/gamantha/oat/taoDelivery/DeliveryServer/initDeliveryExecution?uri=http%3A%2F%2Flocalhost%3A8090%2Fgamantha%2Foat%2Foat.rdf%23i14862157247742169
            $urlstring = Yii::$app->params['TAO_ROOT']."taoDelivery/PaodeliveryServer/resumablejson?user=" . urlencode($user->uri) .'&assessmentid=' . $assessment->id .'&delivery=' . urlencode($delivery->uri);
            $urlstring2 = Yii::$app->params['TAO_ROOT']."taoDelivery/PaodeliveryServer/availablejson?user=" . urlencode($user->uri);
            $ch = curl_init($urlstring);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $resumablejson = curl_exec($ch);
            $ch2 = curl_init($urlstring2);
            curl_setopt($ch2, CURLOPT_HEADER, 0);
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
            $availablejson = curl_exec($ch2);
            curl_close($ch);
            curl_close($ch2);
            $resumable =  json_decode($resumablejson);
            $available =  json_decode($availablejson);
            $available_array = [];
            $resumable_array = [];

            if (sizeof($available) > 0) {
                foreach ($available as $key => $value) {
                    if($value->TAO_DELIVERY_TAKABLE) {
                        $available_array[$value->id] = str_replace("DeliveryServer","PaodeliveryServer",$value->launchUrl);
                            if($delivery->uri == $value->id) {
                            }
                    } else {
                        $available_array[$value->id] = $value->TAO_DELIVERY_TAKABLE;
                    }
                }
            }                       
            //echo '<br/>============RESUMEABLE==================<br/><br/>';    

            if (sizeof($resumable) > 0) {
                foreach ($resumable as $key2 => $value2) {
                    $resumable_array[$value2->delivery->uriResource] = str_replace("DeliveryServer","PaodeliveryServer",$value2->launchUrl);
                    $last_resumeable = $resumable_array[$value2->delivery->uriResource];
                    $unixtime = strtotime(str_replace('Started at ', '', str_replace('/', '-', $value2->description[0])));
                    $time = date("m/d/Y h:i:s A T", $unixtime);
                    $time = $unixtime;
                    //$time = $value2->description[0];
                    if ($unixtime >= strtotime($assessment->timestamp)) {
                        //echo '<br/>'. $value2->label . ' (' . $value2->id . ')  =>  '  . $time . ' -- ';
                        //  echo Html::a(Yii::t('app','resume'), ['/tao/loginredirect?redirect='.urlencode($last_resumeable) . '&return=' . urlencode($returnUrl)],['class' => '']);
                    }
                }
                //echo 'You have an unfinished assessment. Resuming...<br/>';
                //Yii::$app->session->setFlash('success', 'resuming...');
//sleep(3);
                echo Html::a(Yii::t('app','resume'), ['/tao/loginredirect?redirect='.urlencode($resumable_array[$delivery->uri]) . '&return=' . urlencode($returnUrl)],['class' => 'btn btn-info']);
                $this->redirect(['/tao/loginredirect?redirect='.urlencode($resumable_array[$delivery->uri]) . 
                    '&return=' . urlencode($returnUrl)]);
                /*      echo '<br/>';
                  Yii::$app->session->setFlash('warning', 'You have unfinished assessment. Please Resume. Retaking the assessment will cost you credit points');
                   echo Html::a(Yii::t('app','resume'), ['/tao/loginredirect?redirect='.urlencode($last_resumeable) . '&return=' . urlencode($returnUrl)],['class' => 'btn btn-info']);
                */
            } else { //IF THERE's NO RESUMEABLE (belum pernah ambil. BARU DAFTAR)
                if (isset($available_array[$delivery->uri])) {
                    $institution_existed = AssessmentExtended::find()->andWhere(['type' => 'edulab-target-institution'])
                    ->andWhere(['assessment_id' => $assessment->id])->All();
                    if (sizeof($institution_existed) > 0) {
                            $this->redirect(['/tao/logininitdeliveryredirect?redirect='.urlencode(
                            $available_array[$delivery->uri]
                            ) . '&return=' . urlencode($returnUrl) . '&catalog_id=' . $catalog_id]);
                    } else {
                        if($_POST) {
                           if(!empty($_POST['institution_1'])) {
                            $institution_1 = new AssessmentExtended();
                            $institution_1->type = 'edulab-target-institution';
                            $institution_1->key = '1';
                            $institution_1->assessment_id = $assessment->id;
                            $institution_1->value = $_POST['institution_1'];
                            $institution_1->save();
                           }
                           if(!empty($_POST['institution_2'])) {
                            $institution_2 = new AssessmentExtended();
                            $institution_2->type = 'edulab-target-institution';
                            $institution_2->key = '2';
                            $institution_2->assessment_id = $assessment->id;
                            $institution_2->value = $_POST['institution_2'];
                            $institution_2->save();
                           }
                           if(!empty($_POST['institution_3'])) {
                            $institution_3 = new AssessmentExtended();
                            $institution_3->type = 'edulab-target-institution';
                            $institution_3->key = '3';
                            $institution_3->assessment_id = $assessment->id;
                            $institution_3->value = $_POST['institution_3'];
                            $institution_3->save();
                           }

                           //print_r($institution_1->errors);
                            echo Html::a(Yii::t('app','Start new'), ['/tao/logininitdeliveryredirect?redirect='.urlencode(
                            $available_array[$delivery->uri]
                            ) . '&return=' . urlencode($returnUrl) . '&catalog_id=' . $catalog_id],['class' => 'btn btn-danger']);
                                            //
    Yii::$app->session->setFlash('success', 'new assessment');
    //sleep(3);
                            //print_r($available_array);
                            $this->redirect(['/tao/logininitdeliveryredirect?redirect='.urlencode(
                            $available_array[$delivery->uri]
                            ) . '&return=' . urlencode($returnUrl) . '&catalog_id=' . $catalog_id]);
                            
                            //Yii::$app->session->setFlash('success', 'success! should be redirecting');

                            //return $this->render('start', ['catalog_id' => $catalog_id]);
                        } else {
                            return $this->render('start', ['catalog_id' => $catalog_id]);
                        }
                    }
                } else {
                    echo 'NO TAKEABLE URI';
                }
            }
        } else {
            echo 'NULL assessment. register first';
        }

    } //actionstart












}

?>