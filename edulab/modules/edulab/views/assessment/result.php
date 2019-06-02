<<<<<<< HEAD
<?php
/* @var $this yii\web\View */
use common\modules\assessment\models\Assessment;
use common\modules\assessment\models\AssessmentResult;
use common\modules\tao\models\TaoUriMap;
use common\modules\tao\models\ResultsStorage;
use common\modules\tao\models\Statements;
use yii\helpers\Html;
use yii\helpers\Url;
use common\modules\catalog\models\CatalogGeneral;

?>
<h1>RESULT</h1>



<?php
$catalog_item = CatalogGeneral::findOne($catalog_id);
//echo '<h1>Result for ' . $catalog_item->name. '</h1>';
//echo '<br>current assessment  ID : ' . $current_assessment->id .' (' . $current_assessment->timestamp . ')<br/>';
//echo '<p>You have taken this item ' . sizeof($results). ' times</p>';
//echo 'Choose which result you want to see <br/>';



        $dataresult_array = [];
        $latest_result = new ResultsStorage();
        //$latest_result_id ='';
foreach ($results as $result_key => $result_value) {



 $is_execution_end = Statements::find()->andWhere(['subject' => $result_value->result_id])
 ->andWhere(['predicate' => 'http://www.tao.lu/Ontologies/TAODelivery.rdf#DeliveryExecutionEnd'])->One();

    $execution_start = Statements::find()->andWhere(['subject' => $result_value->result_id])
 ->andWhere(['predicate' => 'http://www.tao.lu/Ontologies/TAODelivery.rdf#DeliveryExecutionStart'])->One();
        if (null !== $is_execution_end)
        {
  


if ($execution_start->epoch > $current_assessment->timestamp) {
/*    echo '<br/>start : ';
echo $execution_start->epoch;
    echo '<br/>finish : ';
echo $is_execution_end->epoch;
echo '<br/>';
*/
echo Html::a(Yii::t('app','Result'), ['viewresult', 'catalog_id'=>$catalog_id, 'result_id' => $result_value->result_id],['class' => 'btn btn-info']);
$latest_result_id = $result_value->result_id;

}



  /*                      $get_result = Yii::$app->runAction('tao/getresult', ['result' => $result_value->result_id]);
                        $json_data = json_decode($get_result);
                        $data = $json_data->data;


            $result_array[$result_key] = $result_value;
            $dataresult_array[$result_key] = $data;
*/

        } else {
/**
UNTUK YANG UNFINISHED
*/
//echo Html::button(Yii::t('app','unfinished'), ['class' => 'btn btn-warning']);
          //   echo '  --> unfinished';
            //$result_array[$result_key] = $result_value;
            //$dataresult_array[$result_key] = null;
        }  

//
        }
if (isset($latest_result_id)) {
        Yii::$app->response->redirect(['edulab/assessment/viewresult', 'catalog_id'=>$catalog_id, 'result_id' => $latest_result_id])->send();
    //echo 'sasdsadadsa';
} else {
    echo 'no latest result id';
}
               
/*
 
$max_key = array_search(max($result_array),$result_array);

echo '<br/><p>LATEST RESULT ('. $result_array[$max_key]->result_id.')</p>';
if(null !== $dataresult_array[$max_key]) {
      echo $this->render($id, ['id' => $id, 'data' => $dataresult_array[$max_key]]);
} else {
    echo 'you still have to finish';
}

*/



                                  
/*
echo '<pre>';
print_r(Yii::$app->params);
*/

//echo '<br/>';
//echo Html::a(Yii::t('app','Back'), ['/edulab/edulab/index'],['class' => 'btn btn-info']);

=======
<?php
/* @var $this yii\web\View */
use common\modules\assessment\models\Assessment;
use common\modules\assessment\models\AssessmentResult;
use common\modules\tao\models\TaoUriMap;
use common\modules\tao\models\ResultsStorage;
use common\modules\tao\models\Statements;
use yii\helpers\Html;
use yii\helpers\Url;
use common\modules\catalog\models\CatalogGeneral;

?>
<h1>RESULT</h1>



<?php
$catalog_item = CatalogGeneral::findOne($catalog_id);
//echo '<h1>Result for ' . $catalog_item->name. '</h1>';
//echo '<br>current assessment  ID : ' . $current_assessment->id .' (' . $current_assessment->timestamp . ')<br/>';
//echo '<p>You have taken this item ' . sizeof($results). ' times</p>';
//echo 'Choose which result you want to see <br/>';



        $dataresult_array = [];
        $latest_result = new ResultsStorage();
        //$latest_result_id ='';
foreach ($results as $result_key => $result_value) {



 $is_execution_end = Statements::find()->andWhere(['subject' => $result_value->result_id])
 ->andWhere(['predicate' => 'http://www.tao.lu/Ontologies/TAODelivery.rdf#DeliveryExecutionEnd'])->One();

    $execution_start = Statements::find()->andWhere(['subject' => $result_value->result_id])
 ->andWhere(['predicate' => 'http://www.tao.lu/Ontologies/TAODelivery.rdf#DeliveryExecutionStart'])->One();
        if (null !== $is_execution_end)
        {
  


if ($execution_start->epoch > $current_assessment->timestamp) {
/*    echo '<br/>start : ';
echo $execution_start->epoch;
    echo '<br/>finish : ';
echo $is_execution_end->epoch;
echo '<br/>';
*/
echo Html::a(Yii::t('app','Result'), ['viewresult', 'catalog_id'=>$catalog_id, 'result_id' => $result_value->result_id],['class' => 'btn btn-info']);
$latest_result_id = $result_value->result_id;

}



  /*                      $get_result = Yii::$app->runAction('tao/getresult', ['result' => $result_value->result_id]);
                        $json_data = json_decode($get_result);
                        $data = $json_data->data;


            $result_array[$result_key] = $result_value;
            $dataresult_array[$result_key] = $data;
*/

        } else {
/**
UNTUK YANG UNFINISHED
*/
//echo Html::button(Yii::t('app','unfinished'), ['class' => 'btn btn-warning']);
          //   echo '  --> unfinished';
            //$result_array[$result_key] = $result_value;
            //$dataresult_array[$result_key] = null;
        }  

//
        }
if (isset($latest_result_id)) {
        Yii::$app->response->redirect(['edulab/assessment/viewresult', 'catalog_id'=>$catalog_id, 'result_id' => $latest_result_id])->send();
    //echo 'sasdsadadsa';
} else {
    echo 'no latest result id';
}
               
/*
 
$max_key = array_search(max($result_array),$result_array);

echo '<br/><p>LATEST RESULT ('. $result_array[$max_key]->result_id.')</p>';
if(null !== $dataresult_array[$max_key]) {
      echo $this->render($id, ['id' => $id, 'data' => $dataresult_array[$max_key]]);
} else {
    echo 'you still have to finish';
}

*/



                                  
/*
echo '<pre>';
print_r(Yii::$app->params);
*/

//echo '<br/>';
//echo Html::a(Yii::t('app','Back'), ['/edulab/edulab/index'],['class' => 'btn btn-info']);

>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
?>