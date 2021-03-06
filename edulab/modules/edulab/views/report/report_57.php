<<<<<<< HEAD
<?php
/* @var $this yii\web\View */
use common\modules\ref\models\RefRelation;
use common\modules\assessment\models\Assessment;
use common\modules\assessment\models\Result;
use common\modules\assessment\models\AssessmentResult;

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

$report_name = 'smaxiiipa';


//ambil semua assessment yang berhubungan dengan smaxiiipa = 20, , , , 
// untuk tiap catalog item hanya ambil assessment (dan resultnya) yang finished & terbaru
$catalog_item_list = ['26','29','32','36','51'];

$score_array = [];
$user_score_array = [];
$timetocompare = '2017-03-08 19:50:04';

/*$assessments = Assessment::find()->andWhere(['in','catalog_id', $catalog_item_list])->andWhere(['user_id' => Yii::$app->user->id])
        ->andWhere(['status' => 'finished'])->andWhere(['<','timestamp', $timetocompare])->All();

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

}

foreach ($results as $result_key => $result_value) {

  $score_array[$catalog_item_value][$result_value->type]['sum'] = $result_value->totalscore;
  $score_array[$catalog_item_value][$result_value->type]['count'] = $result_value->totalcount;

}




}

echo "<div class='container' style='margin-top: 20px; margin-bottom: 20px;'>";
?>
<div class="text-center bg-primary"><h1>Report for SMA XII IPA</h1></div>

<p>

</p>

<?php
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
print_r($user_total_array);
echo '</hr>';
print_r($user_score_array);
echo 'jumlah user = ' . ($total_array['20']['count'] ) / 8;
*/
$jumlah_soal = 10 * 15;
//print_r($user_score_array);

echo "<div class='bg-info'>";
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
            'categories' => ['TO 1', 'TO 2', 'TO 3', 'TO 4', 'TO 5'],
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
  'data' => [

                            isset($user_total_array['26']) ? round($user_total_array['26']/ ( 10 * 15) * 100) : 0, 
                            isset($user_total_array['29']) ? round($user_total_array['29']/ ( 10 * 15) * 100) : 0,
                            isset($user_total_array['32']) ? round($user_total_array['32']/ ( 10 * 15) * 100) : 0, 
                            isset($user_total_array['36']) ? round($user_total_array['36']/ ( 10 * 15) * 100) : 0,  
                            isset($user_total_array['51']) ? round($user_total_array['51']/ ( 10 * 15) * 100) : 0,  

                
                            ],

            ],
            [
                'type' => 'column',
                'name' => 'Average',
  'data' => [

                            isset($total_array['26']['sum']) ? round($total_array['26']['sum'] / ($total_array['26']['count'] * 15) * 100) : 0, 
                            isset($total_array['29']['sum']) ? round($total_array['29']['sum'] / ($total_array['29']['count'] * 15) * 100) : 0,
                            isset($total_array['32']['sum']) ? round($total_array['32']['sum'] / ($total_array['32']['count'] * 15) * 100) : 0, 
                            isset($total_array['36']['sum']) ? round($total_array['36']['sum'] / ($total_array['36']['count'] * 15) * 100) : 0,  
                            isset($total_array['51']['sum']) ? round($total_array['51']['sum'] / ($total_array['51']['count'] * 15) * 100) : 0, 
                        //    isset($total_array['23']['sum']) ? $total_array['23']['sum'] / ($total_array['23']['count'] * 15) * 100 : 0, 
                         //   isset($total_array['24']['sum']) ? $total_array['24']['sum'] / ($total_array['24']['count'] * 15) * 100 : 0, 
                         //   isset($total_array['25']['sum']) ? $total_array['25']['sum'] / ($total_array['25']['count'] * 15) * 100 : 0,                  
                            ],

            

               // 'data' => [$total_to1_avg, $total_to2_avg, $total_to3_avg, $total_to4_avg, $total_to5_avg],
            ],
            
        ],
    ]
]);

echo "</div><BR>";
/**
ASUMSI setiap test punya aspek penilaian yang sama
*/
echo "<div class='row bg-success'>";
$matpel_exception = ['tpa_1', 'tpa_2', 'tpa_3'];
foreach ($catalog_item_list as $cat_key => $cat_value) {
$tpa_total[$cat_value] = 0;
$tpa_average_total[$cat_value] = 0;
}
foreach ($score_array['26'] as $matpel_key => $matpel_value) {
  # code...
  //echo $matpel_key;
if (!in_array($matpel_key , $matpel_exception)) {
echo "<div class='col-md-6'>";
$matpel_title = $matpel_key;
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
            'categories' => ['TO 1', 'TO 2', 'TO 3', 'TO 4', 'TO 5'],
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
  'data' => [

                            isset($user_score_array['26'][$matpel_key]) ? round($user_score_array['26'][$matpel_key] * 100 / 15) : 0, 
                            isset($user_score_array['29'][$matpel_key]) ? round($user_score_array['29'][$matpel_key] * 100 / 15) : 0,
                            isset($user_score_array['32'][$matpel_key]) ? round($user_score_array['32'][$matpel_key] * 100 / 15) : 0, 
                            isset($user_score_array['36'][$matpel_key]) ? round($user_score_array['36'][$matpel_key] * 100 / 15) : 0,  
                            isset($user_score_array['51'][$matpel_key]) ? round($user_score_array['51'][$matpel_key] * 100 / 15) : 0, 
 
                        
                            ],
            ],
            [
                'type' => 'column',
                'name' => 'Average',
                'data' => [

                isset($score_array['26'][$matpel_key]['sum']) ? round($score_array['26'][$matpel_key]['sum'] / ($score_array['26'][$matpel_key]['count'] ? $score_array['26'][$matpel_key]['count'] : 1) * 100 / 15) : 0, 
                isset($score_array['29'][$matpel_key]['sum']) ? round($score_array['29'][$matpel_key]['sum'] / ($score_array['29'][$matpel_key]['count'] ? $score_array['29'][$matpel_key]['count'] : 1) * 100 / 15) : 0, 
                isset($score_array['32'][$matpel_key]['sum']) ? round($score_array['32'][$matpel_key]['sum'] / ($score_array['32'][$matpel_key]['count'] ? $score_array['32'][$matpel_key]['count'] : 1) * 100 / 15) : 0, 
                isset($score_array['36'][$matpel_key]['sum']) ? round($score_array['36'][$matpel_key]['sum'] / ($score_array['36'][$matpel_key]['count'] ? $score_array['36'][$matpel_key]['count'] : 1) * 100 / 15) : 0, 
  isset($score_array['51'][$matpel_key]['sum']) ? round($score_array['51'][$matpel_key]['sum'] / ($score_array['51'][$matpel_key]['count'] ? $score_array['51'][$matpel_key]['count'] : 1) * 100 / 15) : 0, 
             ],

              //  'data' => [$tpa_1_avg, $tpa_2_avg, $tpa_3_avg, $tpa_4_avg, $tpa_5_avg],
            ],
            
        ],
    ]
]);
echo "</div>";

} else {
  $increment1 = isset($user_score_array['26'][$matpel_key]) ? $user_score_array['26'][$matpel_key] : 0;
  $increment2 = isset($user_score_array['29'][$matpel_key]) ? $user_score_array['29'][$matpel_key] : 0;
  $increment3 = isset($user_score_array['32'][$matpel_key]) ? $user_score_array['32'][$matpel_key] : 0;
  $increment4 = isset($user_score_array['36'][$matpel_key]) ? $user_score_array['36'][$matpel_key] : 0;
  $increment5 = isset($user_score_array['51'][$matpel_key]) ? $user_score_array['51'][$matpel_key] : 0;
  $tpa_total['26'] = $tpa_total['26'] + $increment1; 
  $tpa_total['29'] = $tpa_total['29'] + $increment2;
  $tpa_total['32'] = $tpa_total['32'] + $increment3; 
  $tpa_total['36'] = $tpa_total['36'] + $increment4;
  $tpa_total['51'] = $tpa_total['51'] + $increment5;
$increment11 = isset($score_array['26'][$matpel_key]['sum']) ? $score_array['26'][$matpel_key]['sum'] / ($score_array['26'][$matpel_key]['count'] ? $score_array['26'][$matpel_key]['count'] : 1)  : 0;
$increment22 = isset($score_array['29'][$matpel_key]['sum']) ? $score_array['29'][$matpel_key]['sum'] / ($score_array['29'][$matpel_key]['count'] ? $score_array['29'][$matpel_key]['count'] : 1) : 0;
$increment33 = isset($score_array['32'][$matpel_key]['sum']) ? $score_array['32'][$matpel_key]['sum'] / ($score_array['32'][$matpel_key]['count'] ? $score_array['32'][$matpel_key]['count'] : 1) : 0;
$increment44 = isset($score_array['36'][$matpel_key]['sum']) ? $score_array['36'][$matpel_key]['sum'] / ($score_array['36'][$matpel_key]['count'] ? $score_array['36'][$matpel_key]['count'] : 1) : 0;
$increment55 = isset($score_array['51'][$matpel_key]['sum']) ? $score_array['51'][$matpel_key]['sum'] / ($score_array['51'][$matpel_key]['count'] ? $score_array['51'][$matpel_key]['count'] : 1) : 0;
    $tpa_average_total['26'] = $tpa_average_total['26'] + $increment11;
    $tpa_average_total['29'] = $tpa_average_total['29'] + $increment22;
    $tpa_average_total['32'] = $tpa_average_total['32'] + $increment33;
    $tpa_average_total['36'] = $tpa_average_total['36'] + $increment44;
    $tpa_average_total['51'] = $tpa_average_total['51'] + $increment55;
}





}

echo "<div class='col-md-6'>";

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
            'categories' => ['TO 1', 'TO 2', 'TO 3', 'TO 4', 'TO 5'],
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
                'data' => [

                         round($tpa_total['26'] * 100/45), round($tpa_total['29'] * 100/45), round($tpa_total['32'] * 100/45), round($tpa_total['36'] * 100/45),round($tpa_total['51'] * 100/45),
                        
                            ],
            ],
            [
                'type' => 'column',
                'name' => 'Average',
                'data' => [
   round($tpa_average_total['26'] * 100/45),   round($tpa_average_total['29'] * 100/45),   round($tpa_average_total['32'] * 100/45),   round($tpa_average_total['36'] * 100/45), round($tpa_average_total['51'] * 100/45),
           
            ],
            
        ],
    ],
    ]
]);
echo "</div>";



echo "</div>"; //div row
echo "</div>"; //div row
?>

=======
<?php
/* @var $this yii\web\View */
use common\modules\ref\models\RefRelation;
use common\modules\assessment\models\Assessment;
use common\modules\assessment\models\Result;
use common\modules\assessment\models\AssessmentResult;

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

$report_name = 'smaxiiipa';


//ambil semua assessment yang berhubungan dengan smaxiiipa = 20, , , , 
// untuk tiap catalog item hanya ambil assessment (dan resultnya) yang finished & terbaru
$catalog_item_list = ['26','29','32','36','51'];

$score_array = [];
$user_score_array = [];
$timetocompare = '2017-03-08 19:50:04';

/*$assessments = Assessment::find()->andWhere(['in','catalog_id', $catalog_item_list])->andWhere(['user_id' => Yii::$app->user->id])
        ->andWhere(['status' => 'finished'])->andWhere(['<','timestamp', $timetocompare])->All();

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

}

foreach ($results as $result_key => $result_value) {

  $score_array[$catalog_item_value][$result_value->type]['sum'] = $result_value->totalscore;
  $score_array[$catalog_item_value][$result_value->type]['count'] = $result_value->totalcount;

}




}

echo "<div class='container' style='margin-top: 20px; margin-bottom: 20px;'>";
?>
<div class="text-center bg-primary"><h1>Report for SMA XII IPA</h1></div>

<p>

</p>

<?php
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
print_r($user_total_array);
echo '</hr>';
print_r($user_score_array);
echo 'jumlah user = ' . ($total_array['20']['count'] ) / 8;
*/
$jumlah_soal = 10 * 15;
//print_r($user_score_array);

echo "<div class='bg-info'>";
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
            'categories' => ['TO 1', 'TO 2', 'TO 3', 'TO 4', 'TO 5'],
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
  'data' => [

                            isset($user_total_array['26']) ? round($user_total_array['26']/ ( 10 * 15) * 100) : 0, 
                            isset($user_total_array['29']) ? round($user_total_array['29']/ ( 10 * 15) * 100) : 0,
                            isset($user_total_array['32']) ? round($user_total_array['32']/ ( 10 * 15) * 100) : 0, 
                            isset($user_total_array['36']) ? round($user_total_array['36']/ ( 10 * 15) * 100) : 0,  
                            isset($user_total_array['51']) ? round($user_total_array['51']/ ( 10 * 15) * 100) : 0,  

                
                            ],

            ],
            [
                'type' => 'column',
                'name' => 'Average',
  'data' => [

                            isset($total_array['26']['sum']) ? round($total_array['26']['sum'] / ($total_array['26']['count'] * 15) * 100) : 0, 
                            isset($total_array['29']['sum']) ? round($total_array['29']['sum'] / ($total_array['29']['count'] * 15) * 100) : 0,
                            isset($total_array['32']['sum']) ? round($total_array['32']['sum'] / ($total_array['32']['count'] * 15) * 100) : 0, 
                            isset($total_array['36']['sum']) ? round($total_array['36']['sum'] / ($total_array['36']['count'] * 15) * 100) : 0,  
                            isset($total_array['51']['sum']) ? round($total_array['51']['sum'] / ($total_array['51']['count'] * 15) * 100) : 0, 
                        //    isset($total_array['23']['sum']) ? $total_array['23']['sum'] / ($total_array['23']['count'] * 15) * 100 : 0, 
                         //   isset($total_array['24']['sum']) ? $total_array['24']['sum'] / ($total_array['24']['count'] * 15) * 100 : 0, 
                         //   isset($total_array['25']['sum']) ? $total_array['25']['sum'] / ($total_array['25']['count'] * 15) * 100 : 0,                  
                            ],

            

               // 'data' => [$total_to1_avg, $total_to2_avg, $total_to3_avg, $total_to4_avg, $total_to5_avg],
            ],
            
        ],
    ]
]);

echo "</div><BR>";
/**
ASUMSI setiap test punya aspek penilaian yang sama
*/
echo "<div class='row bg-success'>";
$matpel_exception = ['tpa_1', 'tpa_2', 'tpa_3'];
foreach ($catalog_item_list as $cat_key => $cat_value) {
$tpa_total[$cat_value] = 0;
$tpa_average_total[$cat_value] = 0;
}
foreach ($score_array['26'] as $matpel_key => $matpel_value) {
  # code...
  //echo $matpel_key;
if (!in_array($matpel_key , $matpel_exception)) {
echo "<div class='col-md-6'>";
$matpel_title = $matpel_key;
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
            'categories' => ['TO 1', 'TO 2', 'TO 3', 'TO 4', 'TO 5'],
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
  'data' => [

                            isset($user_score_array['26'][$matpel_key]) ? round($user_score_array['26'][$matpel_key] * 100 / 15) : 0, 
                            isset($user_score_array['29'][$matpel_key]) ? round($user_score_array['29'][$matpel_key] * 100 / 15) : 0,
                            isset($user_score_array['32'][$matpel_key]) ? round($user_score_array['32'][$matpel_key] * 100 / 15) : 0, 
                            isset($user_score_array['36'][$matpel_key]) ? round($user_score_array['36'][$matpel_key] * 100 / 15) : 0,  
                            isset($user_score_array['51'][$matpel_key]) ? round($user_score_array['51'][$matpel_key] * 100 / 15) : 0, 
 
                        
                            ],
            ],
            [
                'type' => 'column',
                'name' => 'Average',
                'data' => [

                isset($score_array['26'][$matpel_key]['sum']) ? round($score_array['26'][$matpel_key]['sum'] / ($score_array['26'][$matpel_key]['count'] ? $score_array['26'][$matpel_key]['count'] : 1) * 100 / 15) : 0, 
                isset($score_array['29'][$matpel_key]['sum']) ? round($score_array['29'][$matpel_key]['sum'] / ($score_array['29'][$matpel_key]['count'] ? $score_array['29'][$matpel_key]['count'] : 1) * 100 / 15) : 0, 
                isset($score_array['32'][$matpel_key]['sum']) ? round($score_array['32'][$matpel_key]['sum'] / ($score_array['32'][$matpel_key]['count'] ? $score_array['32'][$matpel_key]['count'] : 1) * 100 / 15) : 0, 
                isset($score_array['36'][$matpel_key]['sum']) ? round($score_array['36'][$matpel_key]['sum'] / ($score_array['36'][$matpel_key]['count'] ? $score_array['36'][$matpel_key]['count'] : 1) * 100 / 15) : 0, 
  isset($score_array['51'][$matpel_key]['sum']) ? round($score_array['51'][$matpel_key]['sum'] / ($score_array['51'][$matpel_key]['count'] ? $score_array['51'][$matpel_key]['count'] : 1) * 100 / 15) : 0, 
             ],

              //  'data' => [$tpa_1_avg, $tpa_2_avg, $tpa_3_avg, $tpa_4_avg, $tpa_5_avg],
            ],
            
        ],
    ]
]);
echo "</div>";

} else {
  $increment1 = isset($user_score_array['26'][$matpel_key]) ? $user_score_array['26'][$matpel_key] : 0;
  $increment2 = isset($user_score_array['29'][$matpel_key]) ? $user_score_array['29'][$matpel_key] : 0;
  $increment3 = isset($user_score_array['32'][$matpel_key]) ? $user_score_array['32'][$matpel_key] : 0;
  $increment4 = isset($user_score_array['36'][$matpel_key]) ? $user_score_array['36'][$matpel_key] : 0;
  $increment5 = isset($user_score_array['51'][$matpel_key]) ? $user_score_array['51'][$matpel_key] : 0;
  $tpa_total['26'] = $tpa_total['26'] + $increment1; 
  $tpa_total['29'] = $tpa_total['29'] + $increment2;
  $tpa_total['32'] = $tpa_total['32'] + $increment3; 
  $tpa_total['36'] = $tpa_total['36'] + $increment4;
  $tpa_total['51'] = $tpa_total['51'] + $increment5;
$increment11 = isset($score_array['26'][$matpel_key]['sum']) ? $score_array['26'][$matpel_key]['sum'] / ($score_array['26'][$matpel_key]['count'] ? $score_array['26'][$matpel_key]['count'] : 1)  : 0;
$increment22 = isset($score_array['29'][$matpel_key]['sum']) ? $score_array['29'][$matpel_key]['sum'] / ($score_array['29'][$matpel_key]['count'] ? $score_array['29'][$matpel_key]['count'] : 1) : 0;
$increment33 = isset($score_array['32'][$matpel_key]['sum']) ? $score_array['32'][$matpel_key]['sum'] / ($score_array['32'][$matpel_key]['count'] ? $score_array['32'][$matpel_key]['count'] : 1) : 0;
$increment44 = isset($score_array['36'][$matpel_key]['sum']) ? $score_array['36'][$matpel_key]['sum'] / ($score_array['36'][$matpel_key]['count'] ? $score_array['36'][$matpel_key]['count'] : 1) : 0;
$increment55 = isset($score_array['51'][$matpel_key]['sum']) ? $score_array['51'][$matpel_key]['sum'] / ($score_array['51'][$matpel_key]['count'] ? $score_array['51'][$matpel_key]['count'] : 1) : 0;
    $tpa_average_total['26'] = $tpa_average_total['26'] + $increment11;
    $tpa_average_total['29'] = $tpa_average_total['29'] + $increment22;
    $tpa_average_total['32'] = $tpa_average_total['32'] + $increment33;
    $tpa_average_total['36'] = $tpa_average_total['36'] + $increment44;
    $tpa_average_total['51'] = $tpa_average_total['51'] + $increment55;
}





}

echo "<div class='col-md-6'>";

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
            'categories' => ['TO 1', 'TO 2', 'TO 3', 'TO 4', 'TO 5'],
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
                'data' => [

                         round($tpa_total['26'] * 100/45), round($tpa_total['29'] * 100/45), round($tpa_total['32'] * 100/45), round($tpa_total['36'] * 100/45),round($tpa_total['51'] * 100/45),
                        
                            ],
            ],
            [
                'type' => 'column',
                'name' => 'Average',
                'data' => [
   round($tpa_average_total['26'] * 100/45),   round($tpa_average_total['29'] * 100/45),   round($tpa_average_total['32'] * 100/45),   round($tpa_average_total['36'] * 100/45), round($tpa_average_total['51'] * 100/45),
           
            ],
            
        ],
    ],
    ]
]);
echo "</div>";



echo "</div>"; //div row
echo "</div>"; //div row
?>

>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
