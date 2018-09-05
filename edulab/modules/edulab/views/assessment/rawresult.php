<style type="text/css">
	@import url(http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);

body {
	background-color: #fff;
}
.table-title h3 {
   color: #1b1e24;
   font-size: 30px;
   font-weight: 400;
   font-style:normal;
   font-family: "Roboto", helvetica, arial, sans-serif;
   text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
   text-transform:uppercase;
}
/*** Table Styles **/

.table-fill {
  background: white;
  border-radius:3px;
  border-collapse: collapse;
  height: 320px;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 100%;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  animation: float 5s infinite;
}
 
th {
  color:#D5DDE5;;
  background:#1b1e24;
  border-bottom:4px solid #9ea7af;
  border-right: 1px solid #343a45;
  font-size:14px;
  font-weight: 100;
  padding:24px;
  text-align:center;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  vertical-align:middle;
}

th:first-child {
  border-top-left-radius:3px;
}
 
th:last-child {
  border-top-right-radius:3px;
  border-right:none;
}
  
tr {
  border-top: 1px solid #C1C3D1;
  border-bottom-: 1px solid #C1C3D1;
  color:#666B85;
  font-size:12px;
  font-weight:normal;
  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
}
 
tr:hover td {
  background:#4E5066;
  color:#FFFFFF;
  border-top: 1px solid #22262e;
  border-bottom: 1px solid #22262e;
}
 
tr:first-child {
  border-top:none;
}

tr:last-child {
  border-bottom:none;
}
 
tr:nth-child(odd) td {
  background:#EBEBEB;
}
 
tr:nth-child(odd):hover td {
  background:#4E5066;
}

tr:last-child td:first-child {
  border-bottom-left-radius:3px;
}
 
tr:last-child td:last-child {
  border-bottom-right-radius:3px;
}
 
td {
  background:#FFFFFF;
  padding:10px;
  text-align:left;
  vertical-align:middle;
  font-weight:300;
  font-size:12px;
  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
  border-right: 1px solid #C1C3D1;
}

td:last-child {
  border-right: 0px;
}

th.text-left {
  text-align: left;
}

th.text-center {
  text-align: center;
}

th.text-right {
  text-align: right;
}

td.text-left {
  text-align: left;
}

td.text-center {
  text-align: center;
}

td.text-right {
  text-align: right;
}
</style>

<?php
use yii\helpers\Html;
use yii\helpers\Url;

use common\modules\assessment\models\Result;
use common\modules\assessment\models\AssessmentResult;
use yii\db\Expression;

use common\modules\catalog\models\CatalogGeneral;

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
$final_correct = 0;
$final_incorrect = 0;
$final_unanswered = 0;
$final_unscored = 0;


$score_array = [];


$assessment_result = AssessmentResult::find()->andWhere(['result_id' => $result_id])->One();

$index = 0;

        foreach ($data as $key => $value) {
         //   echo $key; 
           // echo ' : ' . $value->label;
                //echo '<br/>';
                if(isset($value->sortedVars->taoResultServer_models_classes_OutcomeVariable->SCORE[0]->var->value)) {
              //  echo(base64_decode($value->sortedVars->taoResultServer_models_classes_OutcomeVariable->SCORE[0]->var->value));
            } else {
                //echo ' -------    no ScCORE';
            }
if(isset($value->sortedVars->taoResultServer_models_classes_ResponseVariable)) {
            $responses = $value->sortedVars->taoResultServer_models_classes_ResponseVariable;
            

            if(sizeof($responses) > 0) {
                $correct = 0;
                $incorrect = 0;
                $unanswered = 0;
                                $unscored = 0;
                    foreach ($responses as $responses_key => $responses_value) {
                        # code...
                      //  echo '<br/>';
                      //  echo $responses_value[0]->isCorrect;
                        if ($responses_value[0]->isCorrect == 'incorrect') {
                            if($responses_value[0]->var->candidateResponse =='')
                            {
                                    $unanswered++;
                            } else {
                                    $incorrect++;
                            }
                        } else if ($responses_value[0]->isCorrect == 'correct') {
                            $correct++;
                        } else if ($responses_value[0]->isCorrect == 'unscored') {
                            $unscored++;
                        }


                    }
                    	$score_array[$index]['correct'] = $correct;
                    	$score_array[$index]['incorrect'] = $incorrect;
						$score_array[$index]['unanswered'] = $unanswered;
												$score_array[$index]['unscored'] = $unscored;
					


                    //     echo '<br/>' . $correct . ' : ' .  $incorrect . ' : ' . $unanswered;
                         $final_correct = $final_correct + $correct;
                         $final_unanswered = $final_unanswered + $unanswered;
                         $final_incorrect = $final_incorrect + $incorrect;
                                             $final_unscored = $final_unscored + $unscored;
            }
            
        } else {
        	                    	$score_array[$index]['correct'] = 0;
                    	$score_array[$index]['incorrect'] = 0;
						$score_array[$index]['unanswered'] = 0;
											$score_array[$index]['unscored'] = 0;
        }
      //      echo '<br/><br/>';
            # code...
            $t = $value;
            	$index++;
        }

        echo '<br/>correct = ' . $final_correct;
        echo '<br/>incorrect = ' . $final_incorrect;
echo '<br/>unanswered = ' . $final_unanswered;
echo '<br/>unscored = ' . $final_unscored;




//print_r($score_array);
$this->title = 'Hasil Try Out';
$this->params['breadcrumbs'][] = $this->title;



$is_existed = Result::find()->andWhere(['assessment_id' => $assessment_result->assessment_id])->One();


echo '<pre>';
print_r($score_array);
?>
