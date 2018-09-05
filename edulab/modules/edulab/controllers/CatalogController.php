<?php

namespace app\modules\edulab\controllers;
use common\modules\assessment\models\Assessment;
use common\modules\assessment\models\TakerSearch;
use common\modules\assessment\models\AssessmentSearch;
use common\modules\catalog\models\CatalogGeneral;
use common\modules\catalog\models\CatalogTransaction;
use common\modules\catalog\models\CatalogPrice;
use yii\data\ActiveDataProvider;
use common\modules\profile\models\UserCredit;
use yii\db\Expression;
use common\modules\profile\models\UserTransaction;


use Yii;

class CatalogController extends \common\modules\catalog\controllers\CataloggeneralController {
    // empty class

    public function actionStart($catalog_id)
    {
      $catalog_id = urlencode($catalog_id);
      $catalog_item = CatalogGeneral::findOne($catalog_id);
      if($catalog_item->type == 'exercise') {
          $this->redirect(['/edulab/exercise/start', 'catalog_id' => $catalog_id]);
      } else if ($catalog_item->type == 'assessment') {
          $this->redirect(['/edulab/assessment/start', 'catalog_id' => $catalog_id]);
      } else if ($catalog_item->type == 'video') {
          $this->redirect(['/edulab/video/start', 'catalog_id' => $catalog_id]);
      } else if ($catalog_item->type == 'course') {
          $this->redirect(['/edulab/course/start', 'catalog_id' => $catalog_id]);
      } else if ($catalog_item->type == 'materi') {
          $this->redirect(['/edulab/materi/start', 'catalog_id' => $catalog_id]);
      } else if ($catalog_item->type == 'soal') {
          $this->redirect(['/edulab/soal/start', 'catalog_id' => $catalog_id]);
      } else {
        
      }

    }

    private function isTao($catalog_id)
    {
      $istao = false;
      $catalog_item = CatalogGeneral::findOne($catalog_id);
      if($catalog_item->type == 'exercise') {
      $istao = true;
      } else if ($catalog_item->type == 'assessment') {
      $istao = true;
      } else if ($catalog_item->type == 'video') {

      } else if ($catalog_item->type == 'course') {
      $istao = true;
      } else if ($catalog_item->type == 'materi') {

      } else if ($catalog_item->type == 'soal') {

      } else {
        
      }  
      return $istao;
    }

    private function newCatalogTransaction($catalog_id, $points_needed)
    {

            $catalog_transaction = new CatalogTransaction;
            $catalog_transaction->user_id = Yii::$app->user->id;
            $catalog_transaction->status = 'active';
            $catalog_transaction->catalog_id = $catalog_id;
            //$usertransaction->credit_point = $points_needed;
            //$usertransaction->transaction_type = 'purchase';
            $catalog_transaction->timestamp = new Expression('NOW()');
            return $catalog_transaction->save();

    }

    private function newUserTransaction($catalog_id, $points_needed)
    {

            $usertransaction = new UserTransaction;
            $usertransaction->user_id = Yii::$app->user->id;
            $usertransaction->credit_type = 'credit';
            $usertransaction->catalog_id = $catalog_id;
            $usertransaction->credit_point = $points_needed;
            $usertransaction->transaction_type = 'purchase';
            $usertransaction->timestamp = new Expression('NOW()');
            return $usertransaction->save();

    }

    private function newAssessment($catalog_id)
    {
                  $assessment = new Assessment;
            $assessment->catalog_id = $catalog_id;
            $assessment->user_id = Yii::$app->user->id;
            $assessment->status = 'active';
                        $assessment->timestamp = new Expression('NOW()');
     return       $assessment->save();
    }

    public function actionRegister($catalog_id)
    {

        $catalog_price = CatalogPrice::find()
        ->andWhere(['catalog_id' => $catalog_id])
        ->andWhere(['credit_type' => 'credit'])
        ->One();

        $points_needed = isset($catalog_price->required_point) ? $catalog_price->required_point : 0;

        $user_credit_1 = UserCredit::find()
        ->andWhere(['user_id' => Yii::$app->user->id])
        ->andWhere(['status' => 'active'])
        ->andWhere(['credit_type' => 'credit'])
        ->One();
      
        if (isset($user_credit_1->credit_point)) {
  //$user_credit = $user_credit_1->credit_point;
        } else {
              //$user_credit = 0;
              $user_credit_1 = new UserCredit;
              $user_credit_1->credit_type = 'credit';
              $user_credit_1->status = 'active';
              $user_credit_1->credit_point = 0;
              $user_credit_1->user_id = Yii::$app->user->id;
        }
      
      //echo 'sasasa';
                $catalog_transaction =     CatalogTransaction::find()->andWhere(['catalog_id' => $catalog_id])->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['status' => 'active'])->One();
      $assessment = Assessment::find()->andWhere(['catalog_id' => $catalog_id])->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['status' => 'active'])->One();

      //if (null !== $assessment) {
       if (null !== $catalog_transaction) {

         Yii::$app->session->addFlash('warning', 'already registered');
    } else {

            if ($user_credit_1->credit_point >= $points_needed) {
            

if($this->istao($catalog_id))
{
             $add_group_result = Yii::$app->runAction('tao/addtogroup', ['userid' => Yii::$app->user->id, 'groupid' => $catalog_id]);
             if($add_group_result)
             {

      if (null !== $assessment) {
        $assessment->status = 'closed';
        $assessment->save();
      } 
                                     $this->newAssessment($catalog_id);        
                                   
            } else {
         Yii::$app->session->addFlash('warning', 'Catalog configuration incomplete! NO GROUP OR USER URI');
                    return $this->redirect(Yii::$app->request->referrer);
            }
} 

            $user_credit_1->credit_point = $user_credit_1->credit_point - $points_needed;
            $user_credit_1->save();

            $this->newCatalogTransaction($catalog_id, $points_needed);
            $this->newUserTransaction($catalog_id, $points_needed);


             Yii::$app->session->addFlash('success', 'youre now registered. points used ' . $points_needed);
              return $this->redirect(Yii::$app->request->referrer);



    

        } else {
                  Yii::$app->session->addFlash('warning', 'you dont have enough credit points');
                  return $this->redirect(Yii::$app->request->referrer);
                                 }

        //HARUS ADD KE GROUP + ADD KE ASSESSMENT RESULT
    }
    }




}

?>