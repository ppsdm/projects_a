<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\web\View;
use app\assets\AppAsset;
use common\modules\core\models\RefValue;
use app\modules\projects\models\Project;
use app\modules\projects\models\ProjectMeta;
use app\modules\projects\models\ProjectActivity;
use app\modules\projects\models\AssessmentReport;
use app\modules\projects\models\ProjectActivityMeta;
use app\modules\projects\models\ProjectAssessment;
use app\modules\projects\models\ProjectAssessmentResult;
use common\modules\profile\models\ProfileMeta;
use common\modules\profile\models\Profile;
use common\modules\catalog\models\RefAssessmentDictionary;
use common\modules\catalog\models\Catalog;
use common\modules\catalog\models\CatalogMeta;
use yii\data\SqlDataProvider;


use yii\helpers\ArrayHelper;



$pengawasSQLDataProvider = new SqlDataProvider([
  'sql' => 'SELECT b.activity_id,b.catalog_id, a.project_assessment_id, a.psikogram psikogram_lki, a.kompetensigram kompetensigram_lki, c.psikogram psikoram_lkj, c.kompetensigram kompetensigram_lkj, d.attribute_2 LEVEL, ROUND(a.psikogram/c.psikogram*100) psikogram_score, ROUND(a.kompetensigram/c.kompetensigram*100) kompetensigram_score
  FROM project_assessment_score a
  LEFT JOIN project_assessment b ON a.project_assessment_id = b.id
  LEFT JOIN catalog_meta_sum_lkj c ON b.catalog_id = c.catalog_id
  LEFT JOIN ref_value d ON c.catalog_id = d.value where d.attribute_2 = :level',
  'params' => [':level' => 'PENGAWAS'],
  'pagination' => false,
]);

//echo '<pre>';
//print_r($pengawasSQLDataProvider->getModels());

$pengawas = $pengawasSQLDataProvider->getModels();
echo count($pengawas);

?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Potensi', 'Kompetensi'],
          <?php
for ($x = 0; $x < count($pengawas); $x++) {
    echo "[".$pengawas[$x]['psikogram_score'].",".$pengawas[$x]['kompetensigram_score']."],";
}
?>           
        ]);

        var options = {
            
             hAxis: {
                 title: 'Potensi', minValue: 0, maxValue: 100,
                 gridlines:{color: '#eee', count: 7},
                 ticks: [0, 20, 40, 60, 80, 100, 120, 140, ]
                 },
             vAxis: {
                title: 'Kompetensi', minValue: 0, maxValue: 100, 
                gridlines:{color: '#eee', count: 7},
                ticks: [0, 20, 40, 60,  80,100, 120, 140, ]
                },
             crosshair: { trigger: 'both' },
             legend: 'none',
             backgroundColor: { fill:'transparent' }
             //vAxis.gridlines:{color: '#333', count: 4}
           };

        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>

<fieldset>
<legend>ESELON 3</legend>
  <div id="chart_div" 
    style="width: 600px; height: 600px; 
    background-image: url('<?=Url::base()?>/images/ninecell.png'); 
    background-repeat: no-repeat;
    background-position: center; 
    ">
    </div>
    </fieldset>    
  </body>
</html>
