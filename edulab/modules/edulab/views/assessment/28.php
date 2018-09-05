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
use common\modules\assessment\models\AssessmentExtended;
use common\modules\institution\models\Institution;
use common\modules\institution\models\InstitutionExtended;
use yii\db\Expression;

use common\modules\catalog\models\CatalogGeneral;

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
$final_correct = 0;
$final_incorrect = 0;
$final_unanswered = 0;


$score_array = [];
$average_score_array = [];
$matpel_array = ['','matematika_ipa', 'fisika', 'kimia', 'biologi', 'matematika_dasar', 'bahasa_indonesia', 'bahasa_inggris', 'tpa_1', 'tpa_2', 'tpa_3', 'geografi', 'ekonomi','sosiologi', 'sejarah'];
$index9 = 0;

foreach ($matpel_array as $matpel_key => $matpel_value) {
$average_score_array[$catalog_id][$matpel_value]['sum'] = 0;
$average_score_array[$catalog_id][$matpel_value]['count'] = 0;
if ($index9 > 0) {
                      $score_array[$index9]['correct'] = 0;
                      $score_array[$index9]['incorrect'] = 0;
            $score_array[$index9]['unanswered'] = 0;
          }
  $index9++;

}
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

  //      echo '<br/>correct = ' . $final_correct;
    //    echo '<br/>incorrect = ' . $final_incorrect;
//echo '<br/>unanswered = ' . $final_unanswered;

$this->title = 'Hasil Try Out';
$this->params['breadcrumbs'][] = $this->title;

$ranking = "87/636";

$matpel_index = 0;


/**********************************************BUAT NGITUNG AVERAGE****************************/

$results = Result::find()->select(['*, SUM(value) as totalscore, COUNT(value) as totalcount'])
//->andWhere(['in','catalog_id', $catalog_item_list])
->andWhere(['catalog_id' => $catalog_id])
->andWhere(['status' => 'current'])
->andWhere(['attribute_1' => 'correct'])
->groupBy(['type'])
->All();

foreach ($results as $result_key => $result_value) {

  $average_score_array[$catalog_id][$result_value->type]['sum'] = $result_value->totalscore;
  $average_score_array[$catalog_id][$result_value->type]['count'] = $result_value->totalcount;

}
$total_array = [];
foreach ($average_score_array as $summary_key => $summary_values) {
  # code...
  $total_per_matpel = 0;
  $total_count_matpel = 0;
  foreach ($summary_values as $summary_values_key => $summary_values_value) {
    # code...
    $total_per_matpel = $total_per_matpel + $summary_values_value['sum'];
$total_count_matpel = $total_count_matpel + $summary_values_value['count'];
  $total_array[$summary_key][$summary_values_key]['sum'] = $summary_values_value['sum'];
  $total_array[$summary_key][$summary_values_key]['count'] = $summary_values_value['count'];
  }

}

/**********************************************BUAT NGITUNG AVERAGE****************************/

$total_betul = 0;
$total_salah = 0;
$total_kosong = 0;
$total_soal = 210;

$is_existed = Result::find()->andWhere(['assessment_id' => $assessment_result->assessment_id])->One();

foreach ($matpel_array as $matpel_key => $matpel_value) {
	if ($matpel_index > 0) {
			//	$mtk_betul = $score_array[$matpel_index]['correct'];
			//$mtk_salah = $score_array[$matpel_index]['incorrect'];
		//	$mtk_kosong = $score_array[$matpel_index]['unanswered'];



if (null == $is_existed) {

$c_correct =  (isset($score_array[$matpel_index]['correct'])) ? strval($score_array[$matpel_index]['correct']) : 0;
$c_incorrect =  (isset($score_array[$matpel_index]['incorrect'])) ? strval($score_array[$matpel_index]['incorrect']) : 0;
$c_unanswered =  (isset($score_array[$matpel_index]['unanswered'])) ? strval($score_array[$matpel_index]['unanswered']) : 0;
      $new_result = new Result();
      $new_result->assessment_id = $assessment_result->assessment_id;
      $new_result->catalog_id = $catalog_id;
      $new_result->type = $matpel_array[$matpel_index];
      $new_result->status = 'current';
      $new_result->attribute_1 = 'correct';
      $new_result->value = $c_correct;
      $new_result->created_at = new Expression('NOW()');
      $new_result->save();

      $new_result = new Result();
      $new_result->assessment_id = $assessment_result->assessment_id;
      $new_result->catalog_id = $catalog_id;
      $new_result->type = $matpel_array[$matpel_index];
      $new_result->status = 'current';
      $new_result->attribute_1 = 'incorrect';
      $new_result->value = $c_incorrect;
      $new_result->created_at = new Expression('NOW()');
      $new_result->save();

      $new_result = new Result();
      $new_result->assessment_id = $assessment_result->assessment_id;
      $new_result->catalog_id = $catalog_id;
      $new_result->type = $matpel_array[$matpel_index];
      $new_result->status = 'current';
      $new_result->attribute_1 = 'unanswered';
      $new_result->value = $c_unanswered;
      $new_result->created_at = new Expression('NOW()');
      $new_result->save();

		}

			$total_betul = $total_betul + $score_array[$matpel_index]['correct'];
			$total_salah = $total_salah + $score_array[$matpel_index]['incorrect'];
			$total_kosong = $total_kosong + $score_array[$matpel_index]['unanswered'];
}
$matpel_index++;

}


//print_r($score_array);





$ratarata = 0;


$institution_targets = AssessmentExtended::find()->andWhere(['assessment_id'=>$assessment_result->assessment_id])
->andWhere(['type' => 'edulab-target-institution'])
->All();
    $pref_array[1]['name'] = 'N/A';
  $pref_array[1]['jurusan'] = 'N/A';
  $pref_array[1]['passing-grade'] = 'N/A';
      $pref_array[1]['color'] = '#FF0000';
    $pref_array[2]['name'] = 'N/A';
  $pref_array[2]['jurusan'] = 'N/A';
  $pref_array[2]['passing-grade'] = 'N/A';
      $pref_array[2]['color'] = '#FF0000';
          $pref_array[3]['name'] = 'N/A';
  $pref_array[3]['jurusan'] = 'N/A';
  $pref_array[3]['passing-grade'] = 'N/A';
      $pref_array[3]['color'] = '#FF0000';

foreach ($institution_targets as $institution_target) {
  //echo $institution_target->value;
  $pref = InstitutionExtended::find()
  ->andWhere(['type' => 'passing-grade'])
  ->andWhere(['attribute_2' => $institution_target->value])->One();
  if (null !== $pref) {
    $ptn = Institution::findOne($pref->institution_id);
  $pref_array[$institution_target->key][$ptn->name][$pref->key]['passing-grade'] = $pref->value;
    $pref_array[$institution_target->key]['name'] = $ptn->name;
  $pref_array[$institution_target->key]['jurusan'] = $pref->key;
  $pref_array[$institution_target->key]['passing-grade'] = $pref->value;
  if (($total_betul / ($total_soal) * 100) >= $pref->value) {
    $pref_array[$institution_target->key]['color'] = '#00FF00';
    } else {
      $pref_array[$institution_target->key]['color'] = '#FF0000';
    }
  } else {
    $pref_array[$institution_target->key]['name'] = 'N/A';
  $pref_array[$institution_target->key]['jurusan'] = 'N/A';
  $pref_array[$institution_target->key]['passing-grade'] = 'N/A';
      $pref_array[$institution_target->key]['color'] = '#FF0000';
  }

}


?>

<div class="container" style="margin-top: 20px; margin-bottom: 20px">
<div class="row">
  <div class="col-md-6">
        

              <div class="table-title">
                  <h3>
                  <?php
                    $catalog_item = CatalogGeneral::findOne($catalog_id);
                    echo "<div class='col-md-6'>";
                    echo $catalog_item->name;
                    echo "</div>";
                    echo "<div class='col-md-6 text-right'>";
                    echo Html::a(Yii::t('app','Ranking'), ['takers', 'catalog_id'=>$catalog_id],['class' => 'btn btn-success']);
                    echo "</div>";      
                  ?>
                  </h3>
          </div>  

  <?php
  $tpacorrect = $score_array[8]['correct']+$score_array[9]['correct']+$score_array[10]['correct'];
  $tpaincorrect = $score_array[8]['incorrect']+$score_array[9]['incorrect']+$score_array[10]['incorrect'];
  $tpaunanswered = $score_array[8]['unanswered']+$score_array[9]['unanswered']+$score_array[10]['unanswered'];


  $mtkipa_c =($score_array[1]['correct'] + $score_array[1]['incorrect'] + $score_array[1]['unanswered']) > 0 ? round($score_array[1]['correct'] / 
                      ($score_array[1]['correct'] + $score_array[1]['incorrect'] + $score_array[1]['unanswered']) * 100) : 0;;
  $fisika_c = ($score_array[2]['correct'] + $score_array[2]['incorrect'] + $score_array[2]['unanswered']) > 0 ? round($score_array[2]['correct'] / 
                        ($score_array[2]['correct'] + $score_array[2]['incorrect'] + $score_array[2]['unanswered']) * 100) : 0;
  $kimia_c = ($score_array[3]['correct'] + $score_array[3]['incorrect'] + $score_array[3]['unanswered']) > 0 ? round($score_array[3]['correct'] / 
                        ($score_array[3]['correct'] + $score_array[3]['incorrect'] + $score_array[3]['unanswered']) * 100) : 0;
  $biologi_c = ($score_array[4]['correct'] + $score_array[4]['incorrect'] + $score_array[4]['unanswered']) > 0 ? round($score_array[4]['correct'] / 
                        ($score_array[4]['correct'] + $score_array[4]['incorrect'] + $score_array[4]['unanswered']) * 100) : 0;
  $mtk_c = ($score_array[5]['correct'] + $score_array[5]['incorrect'] + $score_array[5]['unanswered']) > 0 ? round($score_array[5]['correct'] / 
                        ($score_array[5]['correct'] + $score_array[5]['incorrect'] + $score_array[5]['unanswered']) * 100) : 0;
  $bind_c = ($score_array[6]['correct'] + $score_array[6]['incorrect'] + $score_array[6]['unanswered']) > 0 ? round($score_array[6]['correct'] / 
                        ($score_array[6]['correct'] + $score_array[6]['incorrect'] + $score_array[6]['unanswered']) * 100) : 0;
  $bing_c = ($score_array[7]['correct'] + $score_array[7]['incorrect'] + $score_array[7]['unanswered']) > 0 ? round($score_array[7]['correct'] / 
                        ($score_array[7]['correct'] + $score_array[7]['incorrect'] + $score_array[7]['unanswered']) * 100) : 0;
  $tpa_c = ($tpacorrect + $tpaincorrect + $tpaunanswered) > 0 ? round($tpacorrect / 
                        ($tpacorrect + $tpaincorrect + $tpaunanswered) * 100) : 0;
  $geografi_c = ($score_array[11]['correct'] + $score_array[11]['incorrect'] + $score_array[11]['unanswered']) > 0 ? round($score_array[11]['correct'] / 
                        ($score_array[11]['correct'] + $score_array[11]['incorrect'] + $score_array[11]['unanswered']) * 100) : 0;
  $ekonomi_c = ($score_array[12]['correct'] + $score_array[12]['incorrect'] + $score_array[12]['unanswered']) > 0 ? round($score_array[12]['correct'] / 
                        ($score_array[12]['correct'] + $score_array[12]['incorrect'] + $score_array[12]['unanswered']) * 100) : 0;
  $sosiologi_c =($score_array[13]['correct'] + $score_array[13]['incorrect'] + $score_array[13]['unanswered']) > 0 ? round($score_array[13]['correct'] / 
                        ($score_array[13]['correct'] + $score_array[13]['incorrect'] + $score_array[13]['unanswered']) * 100) : 0;
  $sejarah_c = ($score_array[14]['correct'] + $score_array[14]['incorrect'] + $score_array[14]['unanswered']) > 0 ? round($score_array[14]['correct'] / 
                        ($score_array[14]['correct'] + $score_array[14]['incorrect'] + $score_array[14]['unanswered']) * 100) : 0;

  //echo $tpa_c;
            echo Highcharts::widget([
          'scripts' => [
              'modules/exporting',
              'themes/grid-light',
          ],
          'options' => [
              'title' => [
                  'text' => 'Edulab Chart',
              ],
              'xAxis' => [
                  'categories' => ['Matematika IPA','Fisika', 'Kimia', 'Biologi', 'Matematika Dasar', 'B.Indonesia', 'B.Inggris', 'TPA', 'Geografi', 'Ekonomi', 'Sosiologi', 'Sejarah'  ],
              ],
              'yAxis' => [
                  'tickPositions' => [0,10,20,30,40,50,60,70,80,90,100],
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
                      'data' => [$mtkipa_c, $fisika_c, $kimia_c, $biologi_c, $mtk_c, $bind_c, $bing_c, $tpa_c, $geografi_c, $ekonomi_c, $sosiologi_c, $sejarah_c],
                  ],
                  [
                      'type' => 'column',
                      'name' => 'Average',

                      'data' => [round($average_score_array[$catalog_id]['geografi']['sum'] / (($average_score_array[$catalog_id]['geografi']['count']  > 0 ) ? $average_score_array[$catalog_id]['matematika_ipa']['count'] : 1) * 100 / 15), 
                      round($average_score_array[$catalog_id]['ekonomi']['sum'] / (($average_score_array[$catalog_id]['ekonomi']['count'] > 0) ? $average_score_array[$catalog_id]['fisika']['count'] : 1 )* 100 / 15), 
round($average_score_array[$catalog_id]['sosiologi']['sum'] / (($average_score_array[$catalog_id]['sosiologi']['count'] > 0) ? $average_score_array[$catalog_id]['kimia']['count'] : 1 ) * 100 / 15), 
round($average_score_array[$catalog_id]['sejarah']['sum'] / (($average_score_array[$catalog_id]['sejarah']['count'] > 0) ? $average_score_array[$catalog_id]['biologi']['count'] : 1 )* 100 / 15), 
round($average_score_array[$catalog_id]['matematika_dasar']['sum'] / (($average_score_array[$catalog_id]['matematika_dasar']['count'] > 0) ? $average_score_array[$catalog_id]['matematika_dasar']['count'] : 1 )* 100 / 15), 
round($average_score_array[$catalog_id]['bahasa_indonesia']['sum'] / (($average_score_array[$catalog_id]['bahasa_indonesia']['count'] > 0) ? $average_score_array[$catalog_id]['bahasa_indonesia']['count'] : 1 )* 100 / 15), 
round($average_score_array[$catalog_id]['bahasa_inggris']['sum'] / (($average_score_array[$catalog_id]['bahasa_inggris']['count'] > 0) ? $average_score_array[$catalog_id]['bahasa_inggris']['count'] : 1 ) * 100 / 15), 

round($average_score_array[$catalog_id]['geografi']['sum'] / (($average_score_array[$catalog_id]['geografi']['count']  > 0 ) ? $average_score_array[$catalog_id]['matematika_ipa']['count'] : 1) * 100 / 15), 
round($average_score_array[$catalog_id]['ekonomi']['sum'] / (($average_score_array[$catalog_id]['ekonomi']['count'] > 0) ? $average_score_array[$catalog_id]['fisika']['count'] : 1 )* 100 / 15), 
round($average_score_array[$catalog_id]['sosiologi']['sum'] / (($average_score_array[$catalog_id]['sosiologi']['count'] > 0) ? $average_score_array[$catalog_id]['kimia']['count'] : 1 ) * 100 / 15), 
round($average_score_array[$catalog_id]['sejarah']['sum'] / (($average_score_array[$catalog_id]['sejarah']['count'] > 0) ? $average_score_array[$catalog_id]['biologi']['count'] : 1 )* 100 / 15), 

round(($average_score_array[$catalog_id]['tpa_1']['sum'] + $average_score_array[$catalog_id]['tpa_2']['sum'] + $average_score_array[$catalog_id]['tpa_3']['sum']) / 
(($average_score_array[$catalog_id]['tpa_1']['count'] + $average_score_array[$catalog_id]['tpa_2']['count'] + $average_score_array[$catalog_id]['tpa_3']['count']) > 0 ? 
($average_score_array[$catalog_id]['tpa_1']['count'] + $average_score_array[$catalog_id]['tpa_2']['count'] + $average_score_array[$catalog_id]['tpa_3']['count'])
  : 1) * 100 / 15)
                      ],

                  ],                  
              ],
          ]
      ]);
      ?>
  </div>
  <div class="col-md-6"> 

								<table  class="table-fill table  text-center">
								  
								  <tr>
								    <th rowspan="2">MATA PELAJARAN</th>
								    <th colspan="3">JUMLAH</th>
								    <th>TOTAL</th>
								  </tr>
								  <tr>
								    <th>BETUL</th>
								    <th>SALAH</th>
								    <th>KOSONG</th>
								    <th>PRESENTASE</th>
								  </tr>
								  <tr>
								    <td>RANKING</td>
								    <td colspan="4"></td>
								  </tr>

								  <tr>
								    <td>MATEMATIKA IPA</td>
								    <td><?=$score_array[1]['correct'];?></td>
										<td><?=$score_array[1]['incorrect'];?></td>
										<td><?=$score_array[1]['unanswered'];?></td>
								    <td><?=$mtkipa_c;?>%</td>
								  </tr>
								  <tr>
								    <td>FISIKA</td>
								    <td><?=$score_array[2]['correct'];?></td>
										<td><?=$score_array[2]['incorrect'];?></td>
										<td><?=$score_array[2]['unanswered'];?></td>
								    <td><?=$fisika_c;?>%</td>
								  </tr>
                  <tr>
                    <td>KIMIA</td>
                    <td><?=$score_array[3]['correct'];?></td>
                    <td><?=$score_array[3]['incorrect'];?></td>
                    <td><?=$score_array[3]['unanswered'];?></td>
                    <td><?=$kimia_c;?>%</td>
                  </tr>
                  <tr>
                    <td>BIOLOGI</td>
                    <td><?=$score_array[4]['correct'];?></td>
                    <td><?=$score_array[4]['incorrect'];?></td>
                    <td><?=$score_array[4]['unanswered'];?></td>
                    <td><?=$biologi_c;?>%</td>
                  </tr>
                  <tr>
                    <td>MATEMATIKA DASAR</td>
                    <td><?=$score_array[5]['correct'];?></td>
                    <td><?=$score_array[5]['incorrect'];?></td>
                    <td><?=$score_array[5]['unanswered'];?></td>
                    <td><?=$mtk_c;?>%</td>
                  </tr>           
                  <tr>
                    <td>BAHASA INDONESIA</td>
                    <td><?=$score_array[6]['correct'];?></td>
                    <td><?=$score_array[6]['incorrect'];?></td>
                    <td><?=$score_array[6]['unanswered'];?></td>
                    <td><?=$bind_c;?>%</td>
                  </tr>           
                  <tr>
                    <td>BAHASA INGGRIS</td>
                    <td><?=$score_array[7]['correct'];?></td>
                    <td><?=$score_array[7]['incorrect'];?></td>
                    <td><?=$score_array[7]['unanswered'];?></td>
                    <td><?=$bing_c;?>%</td>
                  </tr>
                   <tr>
                    <td>TPA</td>
                    <td><?=$score_array[8]['correct']+$score_array[9]['correct']+$score_array[10]['correct'];?></td>
                    <td><?=$score_array[8]['incorrect']+$score_array[9]['incorrect']+$score_array[10]['incorrect'];?></td>
                    <td><?=$score_array[8]['unanswered']+$score_array[9]['unanswered']+$score_array[10]['unanswered'];?></td>
                    <td><?=$tpa_c;?>%</td>
                  </tr>
                  <tr>
                    <td>GEOGRAFI</td>
                    <td><?=$score_array[11]['correct'];?></td>
                    <td><?=$score_array[11]['incorrect'];?></td>
                    <td><?=$score_array[11]['unanswered'];?></td>
                    <td><?=$geografi_c;?>%</td>
                  </tr>
                  <tr>
                    <td>EKONOMI</td>
                    <td><?=$score_array[12]['correct'];?></td>
                    <td><?=$score_array[12]['incorrect'];?></td>
                    <td><?=$score_array[12]['unanswered'];?></td>
                    <td><?=$ekonomi_c;?>%</td>
                  </tr>
                  <tr>
                    <td>SOSIOLOGI</td>
                    <td><?=$score_array[13]['correct'];?></td>
                    <td><?=$score_array[13]['incorrect'];?></td>
                    <td><?=$score_array[13]['unanswered'];?></td>
                    <td><?=$sosiologi_c;?>%</td>
                  </tr>
                  <tr>
                    <td>SEJARAH</td>
                    <td><?=$score_array[14]['correct'];?></td>
                    <td><?=$score_array[14]['incorrect'];?></td>
                    <td><?=$score_array[14]['unanswered'];?></td>
                    <td><?=$sejarah_c;?>%</td>
                  </tr>           								 
								  <tr>
								    <td><B>TOTAL</B></td>
								    <td><B><?=$total_betul;?></B></td>
								    <td><B><?=$total_salah;?></B></td>
								    <td><B><?=$total_kosong;?></B></td>
                    <td><B><?= round($total_betul / ($total_soal) * 100)  . '%';?></B></td>
								  </tr>
								  <tr>
								    <td colspan="4">RATA-RATA,SISWA EDULAB INDONESIA</td>
								    <td><?=$ratarata;?></td>
								  </tr>
								</table>
								<hr>
		<table class="table-fill table text-center">
		  <tr>
		    <th></th>
		    <th>PTN</th>
		    <th>PG</th>
		    <th>Jurusan</th>
		  </tr>
      <tr style="color:<?=$pref_array[1]['color']?>;"?>>
        <td>Pilihan 1</td>
        <td><?=$pref_array[1]['name']?></td>
        <td><?=$pref_array[1]['passing-grade']?></td>
        <td><?=$pref_array[1]['jurusan']?></td>
      </tr>
      <tr style="color:<?=$pref_array[2]['color']?>;"?>>
        <td>Pilihan 2</td>
        <td><?=$pref_array[2]['name']?></td>
        <td><?=$pref_array[2]['passing-grade']?></td>
        <td><?=$pref_array[2]['jurusan']?></td>
      </tr>
      <tr style="color:<?=$pref_array[3]['color']?>;"?>>
        <td>Pilihan 3</td>
        <td><?=$pref_array[3]['name']?></td>
        <td><?=$pref_array[3]['passing-grade']?></td>
        <td><?=$pref_array[3]['jurusan']?></td>
      </tr>
		  <tr>
		    <td>Keterangan</td>
		    <td colspan="3"></td>
		  </tr>
		</table>

  </div>
  </div>
</div>
</div>