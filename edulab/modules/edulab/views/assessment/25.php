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
use common\modules\institution\models\Institution;
use common\modules\institution\models\InstitutionExtended;
use common\modules\catalog\models\CatalogGeneral;

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
$final_correct = 0;
$final_incorrect = 0;
$final_unanswered = 0;


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



//print_r($score_array);
$this->title = 'Hasil Try Out';
$this->params['breadcrumbs'][] = $this->title;

$ranking = "87/636";


$tpa_betul = $score_array[12]['correct'] + $score_array[13]['correct'] + $score_array[14]['correct'];
$tpa_salah = $score_array[12]['incorrect'] + $score_array[13]['incorrect'] + $score_array[14]['incorrect'];
$tpa_kosong = $score_array[12]['unanswered'] + $score_array[13]['unanswered'] + $score_array[14]['unanswered'];





$bind_betul = $score_array[10]['correct'];
$bind_salah = $score_array[10]['incorrect'];
$bind_kosong = $score_array[10]['unanswered'];



$bing_betul = $score_array[11]['correct'];
$bing_salah = $score_array[11]['incorrect'];
$bing_kosong = $score_array[11]['unanswered'];




$biologi_betul = $score_array[7]['correct'] + $score_array[8]['correct'];
$biologi_salah = $score_array[7]['incorrect'] + $score_array[8]['incorrect'];
$biologi_kosong = $score_array[7]['unanswered'] + $score_array[8]['unanswered'];





$kimia_betul = $score_array[5]['correct'] + $score_array[6]['correct'];
$kimia_salah = $score_array[5]['incorrect'] + $score_array[6]['incorrect'];
$kimia_kosong = $score_array[5]['unanswered'] + $score_array[6]['unanswered'];


$fisika_betul = $score_array[3]['correct'] + $score_array[4]['correct'];
$fisika_salah = $score_array[3]['incorrect'] + $score_array[4]['incorrect'];
$fisika_kosong = $score_array[3]['unanswered'] + $score_array[4]['unanswered'];




$mtk_betul = $score_array[9]['correct'];
$mtk_salah = $score_array[9]['incorrect'];
$mtk_kosong = $score_array[9]['unanswered'];



$ekonomi_betul = $score_array[2]['correct'];
$ekonomi_salah = $score_array[2]['incorrect'];
$ekonomi_kosong = $score_array[2]['unanswered'];


$is_existed = Result::find()->andWhere(['assessment_id' => $assessment_result->assessment_id])->One();

if (null == $is_existed) {
$new_result = new Result();
$new_result->assessment_id = $assessment_result->assessment_id;
$new_result->catalog_id = $catalog_id;
$new_result->type = 'tpa_correct';
$new_result->status = 'current';
$new_result->created_at = new Expression('NOW()');
$new_result->value = strval($tpa_betul);
$new_result->save();



$new_result = new Result();
$new_result->assessment_id = $assessment_result->assessment_id;
$new_result->catalog_id = $catalog_id;
$new_result->type = 'indonesia_correct';
$new_result->status = 'current';
$new_result->value = strval($bind_betul);
$new_result->created_at = new Expression('NOW()');
$new_result->save();


$new_result = new Result();
$new_result->assessment_id = $assessment_result->assessment_id;
$new_result->catalog_id = $catalog_id;
$new_result->type = 'inggris_correct';
$new_result->status = 'current';
$new_result->value = strval($bing_betul);
$new_result->created_at = new Expression('NOW()');
$new_result->save();

$new_result = new Result();
$new_result->assessment_id = $assessment_result->assessment_id;
$new_result->catalog_id = $catalog_id;
$new_result->type = 'biologi_correct';
$new_result->status = 'current';
$new_result->value = strval($biologi_betul);
$new_result->created_at = new Expression('NOW()');
$new_result->save();


$new_result = new Result();
$new_result->assessment_id = $assessment_result->assessment_id;
$new_result->catalog_id = $catalog_id;
$new_result->type = 'fisika_correct';
$new_result->status = 'current';
$new_result->value = strval($kimia_betul);
$new_result->created_at = new Expression('NOW()');
$new_result->save();


$new_result = new Result();
$new_result->assessment_id = $assessment_result->assessment_id;
$new_result->catalog_id = $catalog_id;
$new_result->type = 'kimia_correct';
$new_result->status = 'current';
$new_result->created_at = new Expression('NOW()');
$new_result->value = strval($kimia_betul);
$new_result->save();



$new_result = new Result();
$new_result->assessment_id = $assessment_result->assessment_id;
$new_result->catalog_id = $catalog_id;
$new_result->type = 'matematika_correct';
$new_result->status = 'current';
$new_result->created_at = new Expression('NOW()');
$new_result->value = strval($mtk_betul);
$new_result->save();


$new_result = new Result();
$new_result->assessment_id = $assessment_result->assessment_id;
$new_result->catalog_id = $catalog_id;
$new_result->type = 'matematika_ipa_correct';
$new_result->status = 'current';
$new_result->value = strval($ekonomi_betul);
$new_result->created_at = new Expression('NOW()');
$new_result->save();
}


$ratarata = 0;

$total_betul = $tpa_betul + $bind_betul + $bing_betul + $biologi_betul + $kimia_betul + $fisika_betul + $mtk_betul + $ekonomi_betul;
$total_salah = $tpa_salah + $bind_salah + $bing_salah + $biologi_salah + $kimia_salah + $fisika_salah + $mtk_salah + $ekonomi_salah;
$total_kosong = $tpa_kosong + $bind_kosong + $bing_kosong + $biologi_kosong + $kimia_kosong + $fisika_kosong + $mtk_kosong + $ekonomi_kosong;


?>

<div class="container" style="margin-top: 20px; margin-bottom: 20px">
<div class="row">
  <div class="col-md-6">
  			

      				<div class="table-title">
									<h3>
									<?php
										$catalog_item = CatalogGeneral::findOne($catalog_id);
										echo $catalog_item->name;
									?>
									</h3>
					</div>	

  <?php
  $tpa_c = ($tpa_betul + $tpa_salah + $tpa_kosong) > 0 ? round($tpa_betul / ($tpa_betul + $tpa_salah + $tpa_kosong) * 100) : 0;
  $mtk_c = ($mtk_betul + $mtk_salah + $mtk_kosong) > 0 ? round($mtk_betul / ($mtk_betul + $mtk_salah + $mtk_kosong) * 100) : 0;
  $bind_c = ($bind_betul + $bind_salah + $bind_kosong) > 0 ? round($bind_betul / ($bind_betul + $bind_salah + $bind_kosong) * 100) : 0;
  $bing_c = ($bing_betul + $bing_salah + $bing_kosong) > 0 ? round($bing_betul / ($bing_betul + $bing_salah + $bing_kosong) * 100) : 0;
  $fisika_c = ($fisika_betul + $fisika_salah + $fisika_kosong) > 0 ? round($fisika_betul / ($fisika_betul + $fisika_salah + $fisika_kosong) * 100) : 0;
  $kimia_c = ($kimia_betul + $kimia_salah + $kimia_kosong) > 0 ? round($kimia_betul / ($kimia_betul + $kimia_salah + $kimia_kosong) * 100) : 0;
  $biologi_c = ($biologi_betul + $biologi_salah + $biologi_kosong) > 0 ? round($biologi_betul / ($biologi_betul + $biologi_salah + $biologi_kosong) * 100) : 0;
  $ekonomi_c = ($ekonomi_betul + $ekonomi_salah + $ekonomi_kosong) > 0 ? round($ekonomi_betul / ($ekonomi_betul + $ekonomi_salah + $ekonomi_kosong) * 100) : 0;

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
			            'categories' => ['TPA', 'Matematika', 'B.Indonesia', 'B.Inggris', 'Fisika', 'Kimia', 'Biologi', 'Matematika IPA'],
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
			                'data' => [$tpa_c, $mtk_c, $bind_c, $bing_c, $fisika_c, $kimia_c, $biologi_c, $ekonomi_c],
			            ],
			            [
			                'type' => 'column',
			                'name' => 'Average',
			                'data' => [30, 40, 20, 30, 29, 35, 10, 40],
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
								    <td>TPA</td>
								    <td><?=$tpa_betul;?></td>
								    <td><?=$tpa_salah;?></td>
								    <td><?=$tpa_kosong;?></td>
								    <td><?= $tpa_c;?></td>
								  </tr>
								  <tr>
								    <td>MATEMATIKA</td>
								    <td><?=$mtk_betul;?></td>
								    <td><?=$mtk_salah;?></td>
								    <td><?=$mtk_kosong;?></td>
								    <td><?= $mtk_c;?></td>
								  </tr>
								  <tr>
								    <td>B INDONESIA</td>
								    <td><?=$bind_betul;?></td>
								    <td><?=$bind_salah;?></td>
								    <td><?=$bind_kosong;?></td>
								    <td><?= $bind_c;?></td>
								  </tr>
								  <tr>
								    <td>B INGGRIS</td>
								    <td><?=$bing_betul;?></td>
								    <td><?=$bing_salah;?></td>
								    <td><?=$bing_kosong;?></td>
								    <td><?= $bing_c;?></td>
								  </tr>
								  <tr>
								    <td>FISIKA</td>
								    <td><?=$fisika_betul;?></td>
								    <td><?=$fisika_salah;?></td>
								    <td><?=$fisika_kosong;?></td>
								    <td><?= $fisika_c;?></td>
								  </tr>
								  <tr>
								    <td>KIMIA</td>
								    <td><?=$kimia_betul;?></td>
								    <td><?=$kimia_salah;?></td>
								    <td><?=$kimia_kosong;?></td>
								    <td><?= $kimia_c;?></td>
								  </tr>
								  <tr>
								    <td>BIOLOGI</td>
								    <td><?=$biologi_betul;?></td>
								    <td><?=$biologi_salah;?></td>
								    <td><?=$biologi_kosong;?></td>
								    <td><?= $biologi_c;?></td>
								  </tr>
								  <tr>
								    <td>MATEMATIKA IPA</td>
								    <td><?=$ekonomi_betul;?></td>
								    <td><?=$ekonomi_salah;?></td>
								    <td><?=$ekonomi_kosong;?></td>
								    <td><?= $ekonomi_c;?></td>
								  </tr>
								  <tr>
								    <td><B>TOTAL</B></td>
								    <td><B><?=$total_betul;?></B></td>
								    <td><B><?=$total_salah;?></B></td>
								    <td><B><?=$total_kosong;?></B></td>
								    <td><B><?= round($total_betul / ($total_betul + $total_salah + $total_kosong) * 100)  . '%';?></B></td>
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
		  <tr>
		    <td>Pilihan 1</td>
		    <td>-</td>
		    <td>-</td>
		    <td>-</td>
		  </tr>
		  <tr>
		    <td>Pilihan 2</td>
		    <td>-</td>
		    <td>-</td>
		    <td>-</td>
		  </tr>
		  <tr>
		    <td>Pilihan 3</td>
		    <td>-</td>
		    <td>-</td>
		    <td>-</td>
		  </tr>
		  <tr>
		    <td>Keterangan</td>
		    <td colspan="3"></td>
		  </tr>
		</table>

  </div>
</div>

</div>