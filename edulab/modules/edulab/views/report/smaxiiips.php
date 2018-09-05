<?php
/* @var $this yii\web\View */
use common\modules\ref\models\RefRelation;
use common\modules\assessment\models\Assessment;
use common\modules\assessment\models\Result;
use common\modules\assessment\models\AssessmentResult;

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

$report_name = 'smaxiiips';


//ambil semua assessment yang berhubungan dengan smaxiiipa = 20, , , ,
// untuk tiap catalog item hanya ambil assessment (dan resultnya) yang finished & terbaru
$catalog_item_list = ['27','30','33','38','52'];

$score_array = [];
$user_score_array = [];
$timetocompare = '2017-03-08 19:50:04';

<<<<<<< Updated upstream
/*$assessments = Assessment::find()->andWhere(['in','catalog_id', $catalog_item_list])->andWhere(['user_id' => Yii::$app->user->id])
        ->andWhere(['status' => 'finished'])->andWhere(['<','timestamp', $timetocompare])->All();
=======
$assessments = Assessment::find()->andWhere(['in','catalog_id', $catalog_item_list])->andWhere(['user_id' => Yii::$app->user->id])
        ->andWhere(['status' => 'finished'])->andWhere(['<','timestamp', $timetocompare])->All();

>>>>>>> Stashed changes

*/
//$items = RefRelation::find()->andWhere(['subject' => $report_name])->andWhere(['predicate' => 'report'])->All();

foreach ($catalog_item_list as $catalog_item_key => $catalog_item_value) {
  # code...


$results = Result::find()->select(['*, SUM(value) as totalscore, COUNT(value) as totalcount'])
//->andWhere(['in','catalog_id', $catalog_item_list])
->andWhere(['catalog_id' => $catalog_item_value])
->andWhere(['status' => 'current'])
->andWhere(['attribute_1' => 'correct'])
->groupBy(['type'])
->All();

$user_assessment = Assessment::find()->andWhere(['catalog_id' => $catalog_item_value])
->andWhere(['user_id' => Yii::$app->user->id])
->andWhere(['status' => 'finished'])->orderBy(['id' => SORT_DESC])->One();
//$user_assessment_array = ['55','54'];

if (null !== $user_assessment) {
$user_results = Result::find()
//->select(['*, SUM(value) as totalscore, COUNT(value) as totalcount'])
//->andWhere(['in','assessment_id', $user_assessment_array])
->andWhere(['assessment_id' => $user_assessment->id])
->andWhere(['status' => 'current'])
->andWhere(['attribute_1' => 'correct'])
->groupBy(['type'])
->All();

if (sizeof($user_results) > 0) {
  foreach ($user_results as $user_result_key => $user_result_value) {
    $user_score_array[$catalog_item_value][$user_result_value->type] = $user_result_value->value;
    //$user_score_array[$catalog_item_value]['assessment_id'] = $user_assessment->id;
  }
} else {
  //echo $user_assessment->id;
}

<<<<<<< Updated upstream
}

foreach ($results as $result_key => $result_value) {
=======
$total_score = [];
$scores = [];


//echo sizeof($assessments);
>>>>>>> Stashed changes

  $score_array[$catalog_item_value][$result_value->type]['sum'] = $result_value->totalscore;
  $score_array[$catalog_item_value][$result_value->type]['count'] = $result_value->totalcount;

}




}

echo "<div class='container' style='margin-top: 20px; margin-bottom: 20px'>";
?>
<<<<<<< Updated upstream
<div class="text-center bg-primary"><h1>Report for SMA XII IPS</h1></div>

<p>
=======
<h1>Report for SMA XII IPA</h1>

<p>

</p>
>>>>>>> Stashed changes

</p>

<?php
<<<<<<< Updated upstream
$total_array = [];
foreach ($score_array as $summary_key => $summary_values) {
  # code...
  $total_per_matpel = 0;
  $total_count_matpel = 0;
  foreach ($summary_values as $summary_values_key => $summary_values_value) {
    # code...
    $total_per_matpel = $total_per_matpel + $summary_values_value['sum'];
$total_count_matpel = $total_count_matpel + $summary_values_value['count'];
  }
  $total_array[$summary_key]['sum'] = $total_per_matpel;
  $total_array[$summary_key]['count'] = $total_count_matpel;
  echo '<br/>';
=======
$score_array = [];
foreach ($catalog_item_list as $key => $value) {
  # code...
  //echo '<br/> id : ';
  //echo $value;

  $assessment = Assessment::find()->andWhere(['catalog_id' => $value])->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['status' => 'finished'])->orderBy(['id' => SORT_DESC])->One();

  if( null !== $assessment) {
  //echo '  --  ' . $assessment->id;
  $assessment_result = AssessmentResult::find()->andWhere(['assessment_id' => $assessment->id])->orderBy(['id' => SORT_DESC])->One();
                          $json_data = json_decode($assessment_result->result_json);
                        $data = $json_data->data;
                        //print_r($data);


                        $final_correct = 0;
$final_incorrect = 0;
$final_unanswered = 0;







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
                        }


                    }
                      $score_array[$index]['correct'] = $correct;
                      $score_array[$index]['incorrect'] = $incorrect;
            $score_array[$index]['unanswered'] = $unanswered;



                    //     echo '<br/>' . $correct . ' : ' .  $incorrect . ' : ' . $unanswered;
                         $final_correct = $final_correct + $correct;
                         $final_unanswered = $final_unanswered + $unanswered;
                         $final_incorrect = $final_incorrect + $incorrect;
            }

        } else {
                                $score_array[$index]['correct'] = 0;
                      $score_array[$index]['incorrect'] = 0;
            $score_array[$index]['unanswered'] = 0;
        }



      //      echo '<br/><br/>';
            # code...
            $t = $value;
              $index++;


        }
//echo $assessment->id;


              $tpa_betul = $score_array[12]['correct'] + $score_array[13]['correct'] + $score_array[14]['correct'];
$tpa_salah = $score_array[12]['incorrect'] + $score_array[13]['incorrect'] + $score_array[14]['incorrect'];
$tpa_kosong = $score_array[12]['unanswered'] + $score_array[13]['unanswered'] + $score_array[14]['unanswered'];


$total_score[$assessment->id]['tpa']['correct'] = $tpa_betul;
$total_score[$assessment->id]['tpa']['incorrect'] = $tpa_salah;
$total_score[$assessment->id]['tpa']['unanswered'] = $tpa_kosong;
$scores[$assessment->catalog_id]['tpa'] = (($tpa_betul + $tpa_salah + $tpa_kosong) > 0 ) ? ($tpa_betul / ($tpa_betul + $tpa_salah + $tpa_kosong)) : '0';



$bind_betul = $score_array[10]['correct'];
$bind_salah = $score_array[10]['incorrect'];
$bind_kosong = $score_array[10]['unanswered'];
$scores[$assessment->catalog_id]['bind'] = (($bind_betul + $bind_salah + $bind_kosong) > 0 ) ? ($bind_betul / ($bind_betul + $bind_salah + $bind_kosong)) : '0';

$total_score[$assessment->id]['bind']['correct'] = $bind_betul;
$total_score[$assessment->id]['bind']['incorrect'] = $bind_salah;
$total_score[$assessment->id]['bind']['unanswered'] = $bind_kosong;


$bing_betul = $score_array[11]['correct'];
$bing_salah = $score_array[11]['incorrect'];
$bing_kosong = $score_array[11]['unanswered'];
$scores[$assessment->catalog_id]['bing'] = (($bing_betul + $bing_salah + $bing_kosong) > 0 ) ? ($bing_betul / ($bing_betul + $bing_salah + $bing_kosong)) : '0';


$total_score[$assessment->id]['bing']['correct'] = $bing_betul;
$total_score[$assessment->id]['bing']['incorrect'] = $bing_salah;
$total_score[$assessment->id]['bing']['unanswered'] = $bing_kosong;


$biologi_betul = $score_array[7]['correct'] + $score_array[8]['correct'];
$biologi_salah = $score_array[7]['incorrect'] + $score_array[8]['incorrect'];
$biologi_kosong = $score_array[7]['unanswered'] + $score_array[8]['unanswered'];
$scores[$assessment->catalog_id]['biologi'] = (($biologi_betul + $biologi_salah + $biologi_kosong) > 0 ) ? ($biologi_betul / ($biologi_betul + $biologi_salah + $biologi_kosong)) : '0';

$total_score[$assessment->id]['biologi']['correct'] = $biologi_betul;
$total_score[$assessment->id]['biologi']['incorrect'] = $biologi_salah;
$total_score[$assessment->id]['biologi']['unanswered'] = $biologi_kosong;



$kimia_betul = $score_array[5]['correct'] + $score_array[6]['correct'];
$kimia_salah = $score_array[5]['incorrect'] + $score_array[6]['incorrect'];
$kimia_kosong = $score_array[5]['unanswered'] + $score_array[6]['unanswered'];

$scores[$assessment->catalog_id]['kimia'] = (($kimia_betul + $kimia_salah + $kimia_kosong) > 0 ) ? ($kimia_betul / ($kimia_betul + $kimia_salah + $kimia_kosong)) : '0';

$total_score[$assessment->id]['kimia']['correct'] = $kimia_betul;
$total_score[$assessment->id]['kimia']['incorrect'] = $kimia_salah;
$total_score[$assessment->id]['kimia']['unanswered'] = $kimia_kosong;


$fisika_betul = $score_array[3]['correct'] + $score_array[4]['correct'];
$fisika_salah = $score_array[3]['incorrect'] + $score_array[4]['incorrect'];
$fisika_kosong = $score_array[3]['unanswered'] + $score_array[4]['unanswered'];
$scores[$assessment->catalog_id]['fisika'] = (($fisika_betul + $fisika_salah + $fisika_kosong) > 0 ) ? ($fisika_betul / ($fisika_betul + $fisika_salah + $fisika_kosong)) : '0';

$total_score[$assessment->id]['fisika']['correct'] = $fisika_betul;
$total_score[$assessment->id]['fisika']['incorrect'] = $fisika_salah;
$total_score[$assessment->id]['fisika']['unanswered'] = $fisika_kosong;



$mtk_betul = $score_array[9]['correct'];
$mtk_salah = $score_array[9]['incorrect'];
$mtk_kosong = $score_array[9]['unanswered'];
$scores[$assessment->catalog_id]['mtk'] = (($mtk_betul + $mtk_salah + $mtk_kosong) > 0 ) ? ($mtk_betul / ($mtk_betul + $mtk_salah + $mtk_kosong)) : '0';

$total_score[$assessment->id]['mtk']['correct'] = $mtk_betul;
$total_score[$assessment->id]['mtk']['incorrect'] = $mtk_salah;
$total_score[$assessment->id]['mtk']['unanswered'] = $mtk_kosong;



$ekonomi_betul = $score_array[2]['correct'];
$ekonomi_salah = $score_array[2]['incorrect'];
$ekonomi_kosong = $score_array[2]['unanswered'];
$scores[$assessment->catalog_id]['ekonomi'] = (($ekonomi_betul + $ekonomi_salah + $ekonomi_kosong) > 0 ) ? ($ekonomi_betul / ($ekonomi_betul + $ekonomi_salah + $ekonomi_kosong)) : '0';

$total_score[$assessment->id]['ekonomi']['correct'] = $ekonomi_betul;
$total_score[$assessment->id]['ekonomi']['incorrect'] = $ekonomi_salah;
$total_score[$assessment->id]['ekonomi']['unanswered'] = $ekonomi_kosong;


$ratarata = 0;

$total_betul = $tpa_betul + $bind_betul + $bing_betul + $biologi_betul + $kimia_betul + $fisika_betul + $mtk_betul + $ekonomi_betul;
$total_salah = $tpa_salah + $bind_salah + $bing_salah + $biologi_salah + $kimia_salah + $fisika_salah + $mtk_salah + $ekonomi_salah;
$total_kosong = $tpa_kosong + $bind_kosong + $bing_kosong + $biologi_kosong + $kimia_kosong + $fisika_kosong + $mtk_kosong + $ekonomi_kosong;


  //      echo '<br/>correct = ' . $final_correct;
    //    echo '<br/>incorrect = ' . $final_incorrect;
//echo '<br/>unanswered = ' . $final_unanswered;



  } else {
    //echo 'TOIDAADA';
  }
>>>>>>> Stashed changes
}

$user_total_array = [];
$user_total_sum = 0;
foreach ($user_score_array as $user_summary_key => $user_summary_value) {
  # code...
  $total_per_matpel = 0;
  foreach ($user_summary_value as $user_summary_value_key => $user_summary_value_value) {
    # code...
    $total_per_matpel = $total_per_matpel + $user_summary_value_value;
    //$user_total_array[$user_summary_key][$user_summary_value_key] = $user_summary_value_value;
  }
  $user_total_array[$user_summary_key] = $total_per_matpel;
}

/*
echo '<pre>';
<<<<<<< Updated upstream
print_r($user_total_array);
echo '</hr>';
print_r($user_score_array);
echo 'jumlah user = ' . ($total_array['20']['count'] ) / 8;
*/
$jumlah_soal = 14 * 15;
//print_r($user_score_array);

echo "<div class='bg-info'>";
=======
print_r($total_score);
echo '<hr/>';
print_r($scores);
*/

$soal_tpa = 45;
$soal_mtk = 15;
$soal_bind = 15;
$soal_bing = 15;
$soal_fisika = 15;
$soal_kimia = 15;
$soal_biologi = 15;
$soal_ekonomi = 15;


// 1
$TO1_tpa_results = Result::find()->andWhere(['catalog_id' => '20'])->andWhere(['type' => 'tpa_correct'])->andWhere(['status' => 'current']);
$TO1_mtk_results = Result::find()->andWhere(['catalog_id' => '20'])->andWhere(['type' => 'matematika_correct'])->andWhere(['status' => 'current']);
$TO1_bind_results = Result::find()->andWhere(['catalog_id' => '20'])->andWhere(['type' => 'indonesia_correct'])->andWhere(['status' => 'current']);
$TO1_bing_results = Result::find()->andWhere(['catalog_id' => '20'])->andWhere(['type' => 'inggris_correct'])->andWhere(['status' => 'current']);
$TO1_fisika_results = Result::find()->andWhere(['catalog_id' => '20'])->andWhere(['type' => 'fisika_correct'])->andWhere(['status' => 'current']);
$TO1_kimia_results = Result::find()->andWhere(['catalog_id' => '20'])->andWhere(['type' => 'kimia_correct'])->andWhere(['status' => 'current']);
$TO1_biologi_results = Result::find()->andWhere(['catalog_id' => '20'])->andWhere(['type' => 'biologi_correct'])->andWhere(['status' => 'current']);
$TO1_ekonomi_results = Result::find()->andWhere(['catalog_id' => '20'])->andWhere(['type' => 'matematika_ipa_correct'])->andWhere(['status' => 'current']);
// 2
$TO2_tpa_results = Result::find()->andWhere(['catalog_id' => '22'])->andWhere(['type' => 'tpa_correct'])->andWhere(['status' => 'current']);
$TO2_mtk_results = Result::find()->andWhere(['catalog_id' => '22'])->andWhere(['type' => 'matematika_correct'])->andWhere(['status' => 'current']);
$TO2_bind_results = Result::find()->andWhere(['catalog_id' => '22'])->andWhere(['type' => 'indonesia_correct'])->andWhere(['status' => 'current']);
$TO2_bing_results = Result::find()->andWhere(['catalog_id' => '22'])->andWhere(['type' => 'inggris_correct'])->andWhere(['status' => 'current']);
$TO2_fisika_results = Result::find()->andWhere(['catalog_id' => '22'])->andWhere(['type' => 'fisika_correct'])->andWhere(['status' => 'current']);
$TO2_kimia_results = Result::find()->andWhere(['catalog_id' => '22'])->andWhere(['type' => 'kimia_correct'])->andWhere(['status' => 'current']);
$TO2_biologi_results = Result::find()->andWhere(['catalog_id' => '22'])->andWhere(['type' => 'biologi_correct'])->andWhere(['status' => 'current']);
$TO2_ekonomi_results = Result::find()->andWhere(['catalog_id' => '22'])->andWhere(['type' => 'matematika_ipa_correct'])->andWhere(['status' => 'current']);
// 3
$TO3_tpa_results = Result::find()->andWhere(['catalog_id' => '23'])->andWhere(['type' => 'tpa_correct'])->andWhere(['status' => 'current']);
$TO3_mtk_results = Result::find()->andWhere(['catalog_id' => '23'])->andWhere(['type' => 'matematika_correct'])->andWhere(['status' => 'current']);
$TO3_bind_results = Result::find()->andWhere(['catalog_id' => '23'])->andWhere(['type' => 'indonesia_correct'])->andWhere(['status' => 'current']);
$TO3_bing_results = Result::find()->andWhere(['catalog_id' => '23'])->andWhere(['type' => 'inggris_correct'])->andWhere(['status' => 'current']);
$TO3_fisika_results = Result::find()->andWhere(['catalog_id' => '23'])->andWhere(['type' => 'fisika_correct'])->andWhere(['status' => 'current']);
$TO3_kimia_results = Result::find()->andWhere(['catalog_id' => '23'])->andWhere(['type' => 'kimia_correct'])->andWhere(['status' => 'current']);
$TO3_biologi_results = Result::find()->andWhere(['catalog_id' => '23'])->andWhere(['type' => 'biologi_correct'])->andWhere(['status' => 'current']);
$TO3_ekonomi_results = Result::find()->andWhere(['catalog_id' => '23'])->andWhere(['type' => 'matematika_ipa_correct'])->andWhere(['status' => 'current']);
// 4
$TO4_tpa_results = Result::find()->andWhere(['catalog_id' => '24'])->andWhere(['type' => 'tpa_correct'])->andWhere(['status' => 'current']);
$TO4_mtk_results = Result::find()->andWhere(['catalog_id' => '24'])->andWhere(['type' => 'matematika_correct'])->andWhere(['status' => 'current']);
$TO4_bind_results = Result::find()->andWhere(['catalog_id' => '24'])->andWhere(['type' => 'indonesia_correct'])->andWhere(['status' => 'current']);
$TO4_bing_results = Result::find()->andWhere(['catalog_id' => '24'])->andWhere(['type' => 'inggris_correct'])->andWhere(['status' => 'current']);
$TO4_fisika_results = Result::find()->andWhere(['catalog_id' => '24'])->andWhere(['type' => 'fisika_correct'])->andWhere(['status' => 'current']);
$TO4_kimia_results = Result::find()->andWhere(['catalog_id' => '24'])->andWhere(['type' => 'kimia_correct'])->andWhere(['status' => 'current']);
$TO4_biologi_results = Result::find()->andWhere(['catalog_id' => '24'])->andWhere(['type' => 'biologi_correct'])->andWhere(['status' => 'current']);
$TO4_ekonomi_results = Result::find()->andWhere(['catalog_id' => '24'])->andWhere(['type' => 'matematika_ipa_correct'])->andWhere(['status' => 'current']);
// 5
$TO5_tpa_results = Result::find()->andWhere(['catalog_id' => '25'])->andWhere(['type' => 'tpa_correct'])->andWhere(['status' => 'current']);
$TO5_mtk_results = Result::find()->andWhere(['catalog_id' => '25'])->andWhere(['type' => 'matematika_correct'])->andWhere(['status' => 'current']);
$TO5_bind_results = Result::find()->andWhere(['catalog_id' => '25'])->andWhere(['type' => 'indonesia_correct'])->andWhere(['status' => 'current']);
$TO5_bing_results = Result::find()->andWhere(['catalog_id' => '25'])->andWhere(['type' => 'inggris_correct'])->andWhere(['status' => 'current']);
$TO5_fisika_results = Result::find()->andWhere(['catalog_id' => '25'])->andWhere(['type' => 'fisika_correct'])->andWhere(['status' => 'current']);
$TO5_kimia_results = Result::find()->andWhere(['catalog_id' => '25'])->andWhere(['type' => 'kimia_correct'])->andWhere(['status' => 'current']);
$TO5_biologi_results = Result::find()->andWhere(['catalog_id' => '25'])->andWhere(['type' => 'biologi_correct'])->andWhere(['status' => 'current']);
$TO5_ekonomi_results = Result::find()->andWhere(['catalog_id' => '25'])->andWhere(['type' => 'matematika_ipa_correct'])->andWhere(['status' => 'current']);

  $tpa_1 = 0;
  $tpa_2 = 0;
  $tpa_3 = 0;
  $tpa_4 = 0;
  $tpa_5 = 0;
  $mtk_1 = 0;
  $mtk_2 = 0;
  $mtk_3 = 0;
  $mtk_4 = 0;
  $mtk_5 = 0;

  $bind_1 = 0;
  $bind_2 = 0;
  $bind_3 = 0;
  $bind_4 = 0;
  $bind_5 = 0;

  $bing_1 = 0;
  $bing_2 = 0;
  $bing_3 = 0;
  $bing_4 = 0;
  $bing_5 = 0;

  $fisika_1 = 0;
  $fisika_2 = 0;
  $fisika_3 = 0;
  $fisika_4 = 0;
  $fisika_5 = 0;

  $kimia_1 = 0;
  $kimia_2 = 0;
  $kimia_3 = 0;
  $kimia_4 = 0;
  $kimia_5 = 0;

  $biologi_1 = 0;
  $biologi_2 = 0;
  $biologi_3 = 0;
  $biologi_4 = 0;
  $biologi_5 = 0;

  $ekonomi_1 = 0;
  $ekonomi_2 = 0;
  $ekonomi_3 = 0;
  $ekonomi_4 = 0;
  $ekonomi_5 = 0;

// TO 1
  if (isset($scores['20'])) {
  $tpa_1 = $scores['20']['tpa'] * 100;
  $mtk_1 = $scores['20']['mtk'] * 100;
  $bind_1 = $scores['20']['bind'] * 100;
  $bing_1 = $scores['20']['bing'] * 100;
  $fisika_1 = $scores['20']['fisika'] * 100;
  $kimia_1 = $scores['20']['kimia'] * 100;
  $biologi_1 = $scores['20']['biologi'] * 100;
  $ekonomi_1 = $scores['20']['ekonomi'] * 100;
}
  $tpa_1_avg = 0;
  $mtk_1_avg = 0;
  $bind_1_avg = 0;
  $bing_1_avg = 0;
  $fisika_1_avg = 0;
  $kimia_1_avg = 0;
  $biologi_1_avg = 0;
  $ekonomi_1_avg = 0;

  $tpa_2_avg = 0;
  $mtk_2_avg = 0;
  $bind_2_avg = 0;
  $bing_2_avg = 0;
  $fisika_2_avg = 0;
  $kimia_2_avg = 0;
  $biologi_2_avg = 0;
  $ekonomi_2_avg = 0;

  $tpa_3_avg = 0;
  $mtk_3_avg = 0;
  $bind_3_avg = 0;
  $bing_3_avg = 0;
  $fisika_3_avg = 0;
  $kimia_3_avg = 0;
  $biologi_3_avg = 0;
  $ekonomi_3_avg = 0;

  $tpa_4_avg = 0;
  $mtk_4_avg = 0;
  $bind_4_avg = 0;
  $bing_4_avg = 0;
  $fisika_4_avg = 0;
  $kimia_4_avg = 0;
  $biologi_4_avg = 0;
  $ekonomi_4_avg = 0;

  $tpa_5_avg = 0;
  $mtk_5_avg = 0;
  $bind_5_avg = 0;
  $bing_5_avg = 0;
  $fisika_5_avg = 0;
  $kimia_5_avg = 0;
  $biologi_5_avg = 0;
  $ekonomi_5_avg = 0;


  if ($TO1_tpa_results->count() > 0) {
  $tpa_1_avg =  $TO1_tpa_results->count() > 0 ? $TO1_tpa_results->sum('value') / ($TO1_tpa_results->count() * $soal_tpa)  * 100: 0;
  $mtk_1_avg = $TO1_mtk_results->sum('value') / ($TO1_mtk_results->count() * $soal_mtk) * 100;
  $bind_1_avg = $TO1_bind_results->sum('value') / ($TO1_bind_results->count() * $soal_bind) * 100;
  $bing_1_avg = $TO1_bing_results->sum('value') / ($TO1_bing_results->count() * $soal_bing) * 100;
  $fisika_1_avg = $TO1_fisika_results->sum('value') / ($TO1_fisika_results->count() * $soal_fisika) * 100;
  $kimia_1_avg = $TO1_kimia_results->sum('value') / ($TO1_kimia_results->count() * $soal_kimia) * 100;
  $biologi_1_avg = $TO1_biologi_results->sum('value') / ($TO1_biologi_results->count() * $soal_biologi) * 100;
  $ekonomi_1_avg = $TO1_ekonomi_results->sum('value') / ($TO1_ekonomi_results->count() * $soal_ekonomi) * 100;

}

// TO 2
if (isset($scores['22'])) {
  $tpa_2 = $scores['22']['tpa'] * 100;
  $mtk_2 = $scores['22']['mtk'] * 100;
  $bind_2 = $scores['22']['bind'] * 100;
  $bing_2 = $scores['22']['bing'] * 100;
  $fisika_2 = $scores['22']['fisika'] * 100;
  $kimia_2 = $scores['22']['kimia'] * 100;
  $biologi_2 = $scores['22']['biologi'] * 100;
  $ekonomi_2 = $scores['22']['ekonomi'] * 100;

if($TO2_tpa_results->count() > 0) {
  $tpa_2_avg =    $TO2_tpa_results->count() > 0 ? $TO2_tpa_results->sum('value') / ($TO2_tpa_results->count() * $soal_tpa)  * 100 : 0;
  $mtk_2_avg = $TO2_mtk_results->sum('value') / ($TO2_mtk_results->count() * $soal_mtk) * 100;
  $bind_2_avg = $TO2_bind_results->sum('value') / ($TO2_bind_results->count() * $soal_bind) * 100;
  $bing_2_avg = $TO2_bing_results->sum('value') / ($TO2_bing_results->count() * $soal_bing) * 100;
  $fisika_2_avg = $TO2_fisika_results->sum('value') / ($TO2_fisika_results->count() * $soal_fisika) * 100;
  $kimia_2_avg = $TO2_kimia_results->sum('value') / ($TO2_kimia_results->count() * $soal_kimia) * 100;

  $biologi_2_avg = $TO2_biologi_results->sum('value') / ($TO2_biologi_results->count() * $soal_biologi) * 100;
  $ekonomi_2_avg = $TO2_ekonomi_results->sum('value') / ($TO2_ekonomi_results->count() * $soal_ekonomi) * 100;

  }
}

if (isset($scores['23'])) {
// TO 3

  $tpa_3 = $scores['23']['tpa'] * 100;
  $mtk_3 = $scores['23']['mtk'] * 100;
  $bind_3 = $scores['23']['bind'] * 100;
  $bing_3 = $scores['23']['bing'] * 100;
  $fisika_3 = $scores['23']['fisika'] * 100;
  $kimia_3 = $scores['23']['kimia'] * 100;
  $biologi_3 = $scores['23']['biologi'] * 100;
  $ekonomi_3 = $scores['23']['ekonomi'] * 100;

  if($TO3_tpa_results->count() > 0) {
  $tpa_3_avg =  $TO3_tpa_results->sum('value') / ($TO3_tpa_results->count() * $soal_tpa) * 100;
  $mtk_3_avg = $TO3_mtk_results->sum('value') / ($TO3_mtk_results->count() * $soal_mtk) * 100;
  $bind_3_avg = $TO3_bind_results->sum('value') / ($TO3_bind_results->count() * $soal_bind) * 100;
  $bing_3_avg = $TO3_bing_results->sum('value') / ($TO3_bing_results->count() * $soal_bing) * 100;
  $fisika_3_avg = $TO3_fisika_results->sum('value') / ($TO3_fisika_results->count() * $soal_fisika) * 100;
  $kimia_3_avg = $TO3_kimia_results->sum('value') / ($TO3_kimia_results->count() * $soal_kimia) * 100;
  $biologi_3_avg = $TO3_biologi_results->sum('value') / ($TO3_biologi_results->count() * $soal_biologi) * 100;
  $ekonomi_3_avg = $TO3_ekonomi_results->sum('value') / ($TO3_ekonomi_results->count() * $soal_ekonomi) * 100;
}
}

if (isset($scores['24'])) {
// TO 4
  $tpa_4 = $scores['24']['tpa'] * 100;
  $mtk_4 = $scores['24']['mtk'] * 100;
  $bind_4 = $scores['24']['bind'] * 100;
  $bing_4 = $scores['24']['bing'] * 100;
  $fisika_4 = $scores['24']['fisika'] * 100;
  $kimia_4 = $scores['24']['kimia'] * 100;
  $biologi_4 = $scores['24']['biologi'] * 100;
  $ekonomi_4 = $scores['24']['ekonomi'] * 100;

  if($TO4_tpa_results->count() > 0) {
  $tpa_4_avg =  $TO4_tpa_results->sum('value') / ($TO4_tpa_results->count() * $soal_tpa) * 100;
  $mtk_4_avg = $TO4_mtk_results->sum('value') / ($TO4_mtk_results->count() * $soal_mtk) * 100;
  $bind_4_avg = $TO4_bind_results->sum('value') / ($TO4_bind_results->count() * $soal_bind) * 100;
  $bing_4_avg = $TO4_bing_results->sum('value') / ($TO4_bing_results->count() * $soal_bing) * 100;
  $fisika_4_avg = $TO4_fisika_results->sum('value') / ($TO4_fisika_results->count() * $soal_fisika) * 100;
  $kimia_4_avg = $TO4_kimia_results->sum('value') / ($TO4_kimia_results->count() * $soal_kimia) * 100;
  $biologi_4_avg = $TO4_biologi_results->sum('value') / ($TO4_biologi_results->count() * $soal_biologi) * 100;
  $ekonomi_4_avg = $TO4_ekonomi_results->sum('value') / ($TO4_ekonomi_results->count() * $soal_ekonomi) * 100;
}
}

if (isset($scores['25'])) {
// TO 5
  $tpa_5 = $scores['25']['tpa'] * 100;
  $mtk_5 = $scores['25']['mtk'] * 100;
  $bind_5 = $scores['25']['bind'] * 100;
  $bing_5 = $scores['25']['bing'] * 100;
  $fisika_5 = $scores['25']['fisika'] * 100;
  $kimia_5 = $scores['25']['kimia'] * 100;
  $biologi_5 = $scores['25']['biologi'] * 100;
  $ekonomi_5 = $scores['25']['ekonomi'] * 100;

  if($TO5_tpa_results->count() > 0) {
  $tpa_5_avg =  $TO5_tpa_results->sum('value') / ($TO5_tpa_results->count() * $soal_tpa) * 100;
  $mtk_5_avg = $TO5_mtk_results->sum('value') / ($TO5_mtk_results->count() * $soal_mtk) * 100;
  $bind_5_avg = $TO5_bind_results->sum('value') / ($TO5_bind_results->count() * $soal_bind) * 100;
  $bing_5_avg = $TO5_bing_results->sum('value') / ($TO5_bing_results->count() * $soal_bing) * 100;
  $fisika_5_avg = $TO5_fisika_results->sum('value') / ($TO5_fisika_results->count() * $soal_fisika) * 100;
  $kimia_5_avg = $TO5_kimia_results->sum('value') / ($TO5_kimia_results->count() * $soal_kimia) * 100;
  $biologi_5_avg = $TO5_biologi_results->sum('value') / ($TO5_biologi_results->count() * $soal_biologi) * 100;
  $ekonomi_5_avg = $TO5_ekonomi_results->sum('value') / ($TO5_ekonomi_results->count() * $soal_ekonomi) * 100;
}
}
echo "<div class='container' style='margin-top: 20px; margin-bottom: 20px'>";
echo "<div class='row'>";
echo "<div class='col-md-6'>";

//echo 'mtk_1_avg : ' . $tpa_1_avg;
//echo 'tpa_1 : ' . $scores['20']['tpa'] ;
  //TPA
  //$tpa_1 = "30";
>>>>>>> Stashed changes
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'TOTAL',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'yAxis' => [
<<<<<<< Updated upstream
                  'tickPositions' => [0,10,20,30,40,50,60,70,80,90,100],
=======
                  'tickPositions' => [10,20,30,40,50,60,70,80,90,100],
>>>>>>> Stashed changes
              ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [

            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
<<<<<<< Updated upstream
  'data' => [

                            isset($user_total_array['27']) ? round($user_total_array['27']/ ( 10 * 15) * 100) : 0,
                            isset($user_total_array['30']) ? round($user_total_array['30']/ ( 10 * 15) * 100) : 0,
                            isset($user_total_array['33']) ? round($user_total_array['33']/ ( 10 * 15) * 100) : 0,
                            isset($user_total_array['38']) ? round($user_total_array['38']/ ( 10 * 15) * 100) : 0,
                            isset($user_total_array['52']) ? round($user_total_array['52']/ ( 10 * 15) * 100) : 0,
    //                        isset($user_total_array['31']) ? round($user_total_array['31']/ ( 14 * 15) * 100) : 0,
  //                          isset($user_total_array['31']) ? round($user_total_array['31']/ ( 14 * 15) * 100) : 0,
//                            isset($user_total_array['31']) ? round($user_total_array['31']/ ( 14 * 15) * 100) : 0,


                            ],

=======
                'data' => [$tpa_1, $tpa_2, $tpa_3, $tpa_4, $tpa_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$tpa_1_avg, $tpa_2_avg, $tpa_3_avg, $tpa_4_avg, $tpa_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[1]'),
                    'fillColor' => 'pink',
                ],
            ],

        ],
    ]
]);
echo "</div>";
echo "<div class='col-md-6'>";

  //MATEMATIKA
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'MATEMATIKA',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'yAxis' => [
                  'tickPositions' => [10,20,30,40,50,60,70,80,90,100],
              ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
>>>>>>> Stashed changes
            ],
            [
                'type' => 'column',
                'name' => 'Average',
  'data' => [

                            isset($total_array['27']['sum']) ? round($total_array['27']['sum'] / ($total_array['27']['count'] * 15) * 100) : 0,
                            isset($total_array['30']['sum']) ? round($total_array['30']['sum'] / ($total_array['30']['count'] * 15) * 100) : 0,
                            isset($total_array['33']['sum']) ? round($total_array['33']['sum'] / ($total_array['33']['count'] * 15) * 100) : 0,
                            isset($total_array['38']['sum']) ? round($total_array['38']['sum'] / ($total_array['38']['count'] * 15) * 100) : 0,
                            isset($total_array['52']['sum']) ? round($total_array['52']['sum'] / ($total_array['52']['count'] * 15) * 100) : 0,
                        //    isset($total_array['23']['sum']) ? $total_array['23']['sum'] / ($total_array['23']['count'] * 15) * 100 : 0,
                         //   isset($total_array['24']['sum']) ? $total_array['24']['sum'] / ($total_array['24']['count'] * 15) * 100 : 0,
                         //   isset($total_array['25']['sum']) ? $total_array['25']['sum'] / ($total_array['25']['count'] * 15) * 100 : 0,
                            ],


<<<<<<< Updated upstream

               // 'data' => [$total_to1_avg, $total_to2_avg, $total_to3_avg, $total_to4_avg, $total_to5_avg],
=======
        ],
    ]
]);
echo "</div>";
echo "</div>";
echo "<div class='row'>";
echo "<div class='col-md-6'>";
  //BAHASA INDONESIA
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'BAHASA INDONESIA',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'yAxis' => [
                  'tickPositions' => [10,20,30,40,50,60,70,80,90,100],
              ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [

            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
                'data' => [$bind_1, $bind_2, $bind_3, $bind_4, $bind_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$bind_1_avg, $bind_2_avg, $bind_3_avg, $bind_4_avg, $bind_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[3]'),
                    'fillColor' => 'white',
                ],
>>>>>>> Stashed changes
            ],

        ],
    ]
]);

<<<<<<< Updated upstream
echo "</div><BR>";
/**
ASUMSI setiap test punya aspek penilaian yang sama
*/
$matpel_exception = ['tpa_1', 'tpa_2', 'tpa_3'];

foreach ($catalog_item_list as $cat_key => $cat_value) {
$tpa_total[$cat_value] = 0;
$tpa_average_total[$cat_value] = 0;
}
echo "<div class='row bg-success'>";
foreach ($score_array['27'] as $matpel_key => $matpel_value) {
  # code...
  //echo $matpel_key;
    if (!in_array($matpel_key , $matpel_exception)) {
echo "<div class='col-md-6'>";
$matpel_title = $matpel_key;
=======
echo "</div>";
echo "<div class='col-md-6'>";
  //BAHASA INGGRIS
>>>>>>> Stashed changes
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => $matpel_title,
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'yAxis' => [
<<<<<<< Updated upstream
                  'tickPositions' => [0,10,20,30,40,50,60,70,80,90,100],
=======
                  'tickPositions' => [10,20,30,40,50,60,70,80,90,100],
>>>>>>> Stashed changes
              ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [

            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
<<<<<<< Updated upstream
  'data' => [

                            isset($user_score_array['27'][$matpel_key]) ? round($user_score_array['27'][$matpel_key] * 100 / 15) : 0,
                            isset($user_score_array['30'][$matpel_key]) ? round($user_score_array['30'][$matpel_key] * 100 / 15) : 0,
                            isset($user_score_array['33'][$matpel_key]) ? round($user_score_array['33'][$matpel_key] * 100 / 15) : 0,
                            isset($user_score_array['38'][$matpel_key]) ? round($user_score_array['38'][$matpel_key] * 100 / 15) : 0,
                            isset($user_score_array['52'][$matpel_key]) ? round($user_score_array['52'][$matpel_key] * 100 / 15) : 0,
    //                        isset($user_score_array['31'][$matpel_key]) ? round($user_score_array['31'][$matpel_key] * 100 / 15) : 0,
  //                          isset($user_score_array['31'][$matpel_key]) ? round($user_score_array['31'][$matpel_key] * 100 / 15) : 0,
//                            isset($user_score_array['31'][$matpel_key]) ? round($user_score_array['31'][$matpel_key] * 100 / 15) : 0,


                            ],
=======
                'data' => [$bing_1, $bing_2, $bing_3, $bing_4, $bing_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$bing_1_avg, $bing_2_avg, $bing_3_avg, $bing_4_avg, $bing_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[4]'),
                    'fillColor' => 'blue',
                ],
            ],

        ],
    ]
]);
echo "</div>";
echo "</div>";
echo "<div class='row'>";
echo "<div class='col-md-6'>";

  //FISIKA
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'FISIKA',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'yAxis' => [
                  'tickPositions' => [10,20,30,40,50,60,70,80,90,100],
              ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
>>>>>>> Stashed changes
            ],
            [
                'type' => 'column',
                'name' => 'Average',
<<<<<<< Updated upstream
                'data' => [

                isset($score_array['27'][$matpel_key]['sum']) ? round($score_array['27'][$matpel_key]['sum'] / ($score_array['27'][$matpel_key]['count'] ? $score_array['27'][$matpel_key]['count'] : 1) * 100 / 15) : 0,
                isset($score_array['30'][$matpel_key]['sum']) ? round($score_array['30'][$matpel_key]['sum'] / ($score_array['30'][$matpel_key]['count'] ? $score_array['30'][$matpel_key]['count'] : 1) * 100 / 15) : 0,
                isset($score_array['33'][$matpel_key]['sum']) ? round($score_array['33'][$matpel_key]['sum'] / ($score_array['33'][$matpel_key]['count'] ? $score_array['33'][$matpel_key]['count'] : 1) * 100 / 15) : 0,
                isset($score_array['38'][$matpel_key]['sum']) ? round($score_array['38'][$matpel_key]['sum'] / ($score_array['38'][$matpel_key]['count'] ? $score_array['38'][$matpel_key]['count'] : 1) * 100 / 15) : 0,
                isset($score_array['52'][$matpel_key]['sum']) ? round($score_array['52'][$matpel_key]['sum'] / ($score_array['52'][$matpel_key]['count'] ? $score_array['52'][$matpel_key]['count'] : 1) * 100 / 15) : 0,
//  isset($score_array['31'][$matpel_key]['sum']) ? round($score_array['31'][$matpel_key]['sum'] / ($score_array['31'][$matpel_key]['count'] ? $score_array['31'][$matpel_key]['count'] : 1) * 100 / 15) : 0,
 // isset($score_array['31'][$matpel_key]['sum']) ? round($score_array['31'][$matpel_key]['sum'] / ($score_array['31'][$matpel_key]['count'] ? $score_array['31'][$matpel_key]['count'] : 1) * 100 / 15) : 0,
 //   isset($score_array['31'][$matpel_key]['sum']) ? round($score_array['31'][$matpel_key]['sum'] / ($score_array['31'][$matpel_key]['count'] ? $score_array['31'][$matpel_key]['count'] : 1) * 100 / 15) : 0,
                            ],

              //  'data' => [$tpa_1_avg, $tpa_2_avg, $tpa_3_avg, $tpa_4_avg, $tpa_5_avg],
=======
                'data' => [$fisika_1_avg, $fisika_2_avg, $fisika_3_avg, $fisika_4_avg, $fisika_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[5]'),
                    'fillColor' => 'purple',
                ],
            ],

        ],
    ]
]);
echo "</div>";
echo "<div class='col-md-6'>";

  //KIMIA
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'KIMIA',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'yAxis' => [
                  'tickPositions' => [10,20,30,40,50,60,70,80,90,100],
              ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [

            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
                'data' => [$kimia_1, $kimia_2, $kimia_3, $kimia_4, $kimia_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$kimia_1_avg, $kimia_2_avg, $kimia_3_avg, $kimia_4_avg, $kimia_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[6]'),
                    'fillColor' => 'yellow',
                ],
>>>>>>> Stashed changes
            ],

        ],
    ]
]);
echo "</div>";
<<<<<<< Updated upstream

} else {
  $increment1 = isset($user_score_array['27'][$matpel_key]) ? $user_score_array['27'][$matpel_key] : 0;
  $increment2 = isset($user_score_array['30'][$matpel_key]) ? $user_score_array['30'][$matpel_key] : 0;
  $increment3 = isset($user_score_array['33'][$matpel_key]) ? $user_score_array['33'][$matpel_key] : 0;
  $increment4 = isset($user_score_array['38'][$matpel_key]) ? $user_score_array['38'][$matpel_key] : 0;
  $increment5 = isset($user_score_array['52'][$matpel_key]) ? $user_score_array['52'][$matpel_key] : 0;
  $tpa_total['27'] = $tpa_total['27'] + $increment1;
  $tpa_total['30'] = $tpa_total['30'] + $increment2;
  $tpa_total['33'] = $tpa_total['33'] + $increment3;
  $tpa_total['38'] = $tpa_total['38'] + $increment4;
  $tpa_total['52'] = $tpa_total['52'] + $increment5;
$increment11 = isset($score_array['27'][$matpel_key]['sum']) ? $score_array['27'][$matpel_key]['sum'] / ($score_array['27'][$matpel_key]['count'] ? $score_array['27'][$matpel_key]['count'] : 1)  : 0;
$increment22 = isset($score_array['30'][$matpel_key]['sum']) ? $score_array['30'][$matpel_key]['sum'] / ($score_array['30'][$matpel_key]['count'] ? $score_array['30'][$matpel_key]['count'] : 1) : 0;
$increment33 = isset($score_array['33'][$matpel_key]['sum']) ? $score_array['33'][$matpel_key]['sum'] / ($score_array['33'][$matpel_key]['count'] ? $score_array['33'][$matpel_key]['count'] : 1)  : 0;
$increment44 = isset($score_array['38'][$matpel_key]['sum']) ? $score_array['38'][$matpel_key]['sum'] / ($score_array['38'][$matpel_key]['count'] ? $score_array['38'][$matpel_key]['count'] : 1) : 0;
$increment55 = isset($score_array['52'][$matpel_key]['sum']) ? $score_array['52'][$matpel_key]['sum'] / ($score_array['52'][$matpel_key]['count'] ? $score_array['52'][$matpel_key]['count'] : 1) : 0;
    $tpa_average_total['27'] = $tpa_average_total['27'] + $increment11;
    $tpa_average_total['30'] = $tpa_average_total['30'] + $increment22;
    $tpa_average_total['33'] = $tpa_average_total['33'] + $increment33;
    $tpa_average_total['38'] = $tpa_average_total['38'] + $increment44;
    $tpa_average_total['52'] = $tpa_average_total['52'] + $increment55;
}

}


echo "<div class='col-md-6'>";

=======
echo "</div>";
echo "<div class='row'>";
echo "<div class='col-md-6'>";
  //BIOLOGI
>>>>>>> Stashed changes
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'TPA',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'yAxis' => [
<<<<<<< Updated upstream
                  'tickPositions' => [0,10,20,30,40,50,60,70,80,90,100],
=======
                  'tickPositions' => [10,20,30,40,50,60,70,80,90,100],
>>>>>>> Stashed changes
              ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [

            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
<<<<<<< Updated upstream
  'data' => [

                         round($tpa_total['27'] * 100/45), round($tpa_total['30'] * 100/45), round($tpa_total['33'] * 100/45), round($tpa_total['38'] * 100/45),round($tpa_total['52'] * 100/45),

                            ],
=======
                'data' => [$biologi_1, $biologi_2, $biologi_3, $biologi_4, $biologi_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$biologi_1_avg, $biologi_2_avg, $biologi_3_avg, $biologi_4_avg, $biologi_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[7]'),
                    'fillColor' => 'green',
                ],
            ],

        ],
    ]
]);
echo "</div>";
echo "<div class='col-md-6'>";
  //MATEMATIKA IPA
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'MATEMATIKA IPA',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'yAxis' => [
                  'tickPositions' => [10,20,30,40,50,60,70,80,90,100],
              ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
>>>>>>> Stashed changes
            ],
            [
                'type' => 'column',
                'name' => 'Average',
                'data' => [
   round($tpa_average_total['27'] * 100/45),   round($tpa_average_total['30'] * 100/45),   round($tpa_average_total['33'] * 100/45),   round($tpa_average_total['38'] * 100/45),round($tpa_average_total['52'] * 100/45),

            ],

        ],
    ],
    ]
]);
echo "</div>";



echo "</div>"; //div row
echo "</div>"; //div row
?>
