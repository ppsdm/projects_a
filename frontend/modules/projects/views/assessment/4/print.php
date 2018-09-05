<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//use kartik\detail\DetailView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\widgets\DatePicker;


use yii\web\View;
use app\assets\AppAsset;
//use app\assets\InsertatcaretAsset;
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
use app\modules\projects\models\Biodata;
use yii\data\SqlDataProvider;

use yii\helpers\ArrayHelper;

$monthE = array("","January","February","March","April","May","June","July","August","September","October","November","December");
$bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$array_bulan = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");

$tanggal_test = $data['tanggal_test'];
//echo $data['tanggal_test'];
$nomor_test = $data['nomor_test'];

if ($data['profile']['level'] == 'PENGAWAS') { $eselon = 'ESELON4';}
else if ($data['profile']['level'] == 'ADMINISTRATOR') { $eselon = 'ESELON3';}
else { $eselon = 'ESELON2';}

$arr = explode("/", $tanggal_test, 3);


$day = $arr[0];
$month = $arr[1];	
$year = substr($arr[2],0,4);	
$date_test = $day.'-'.$month.'-'.$year;


$daySignature = $day;
$date_testSignature = $daySignature.'-'.$month.'-'.$year;
$newDateSignature = str_replace($monthE, $bulan,date("j F Y", strtotime($date_testSignature)));
$footerReport='
<div class="footerReport">

<hr>
<table width=100%><tr><td style="padding-right:10px;">
<i>Kegiatan Profil Asesmen Kompetensi<br/>
Jabatan Administrator, Pengawas, Pelaksana dan Fungsional<br/>
Kementerian Sekretariat Negara RI 2017</i>
</div>
</td>
<td  style="text-align:left;border-left: solid  1px #000000;padding-left:10px;" valign="top">
<div id="pageFooter"></div>
</td>
</tr>
</table>

';
$pagebreak = $footerReport.'</b></p></article>
</section>
<section class="sheet padding-25mm">
<div class="headerReport">
<h2>RAHASIA</h2>
<hr></div>
<img style="position:absolute; right: 100px; top: 50px;" src="'.Url::base().'/images/ppsdm-logo-atas.png">
<article><br/>';

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?=$model->name;?></title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" type="text/css" href="<?=Url::to('@web/css/normalize.css');?>">

  <!-- Load paper.css for happy printing  -->
  <link rel="stylesheet" type="text/css"href="<?=Url::to('@web/css/paper.css');?>">
 
  <link rel="stylesheet" type="text/css" href="<?=Url::to('@web/css/psikogramTable.css');?>">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->

  <script src="<?=Url::to('@web/js/d3.min.js');?>" charset="utf-8"></script>

  
  
</head>

<body class="A4">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-0mm">
  <div style= "width: 210mm; height: 296mm; margin:0; background-image: url('<?=Url::base();?>/images/4/coverlaporan.png'); 
 background-position: center; background-repeat: no-repeat;background-size: 210mm 296mm" >
<article>
   

 </div>
 <div style="font-size: 18pt;position:absolute; right: 80px; top: 17px;"><b><?=isset($nomor_test) ?$nomor_test  : '0000';?></b></div>

 <div style="font-size: 18pt;position:absolute; left: 250px; top: 500px;"><b><?=isset($data['profile']['first_name']) ?$data['profile']['first_name']  : '';?></b></div>
 <div style="font-size: 18pt;position:absolute; left: 250px; top: 550px;"><b><?=isset($data['profile']['nip']) ?$data['profile']['nip']  : '';?></b></div>

 <div style="font-size: 18pt;position:absolute;left: 50%;top: 690px;transform: translateX(-50%);">
 <b>
 <?php 
 if ($data['tanggal_test'] == "9/11/2017 8:00"){ 
     echo '9 - 10 November 2017'; 
    }
 else {
     echo '1 - '.$newDateSignature;
    }
 ?>
 </b>
 </div>


</article>
</section>


<?php

$uraian = [];


$total_psikogram = 0;
$total_lki = 0;
$total_lkj = 0;
$total_gap = 0;

$gaps=[];







foreach ($data['psikogram']['lki'] as $psikogram_lki_key => $psikogram_lki_value) {
    $total_psikogram = $total_psikogram + $psikogram_lki_value;
}

foreach ($data['kompetensigram']['lki'] as $kompetensigram_lki_key => $kompetensigram_lki_value) {
    $total_lki = $total_lki + $kompetensigram_lki_value;
    $evidences = RefAssessmentDictionary::find()->andWhere(['type' => 'kompetensigram_setneg'])->andWhere(['key' =>$kompetensigram_lki_key . $kompetensigram_lki_value])->All();
    foreach ($evidences as $evidence_key => $evidence_value) {
    $uraian[$kompetensigram_lki_key . $kompetensigram_lki_value][$evidence_value->value] = $evidence_value->textvalue;
    }

}


foreach ($data['kompetensigram']['lkj'] as $kompetensigram_lkj_key => $kompetensigram_lkj_value) {
    $total_lkj = $total_lkj + $kompetensigram_lkj_value;
}

$Pa = ProjectAssessment::find()->andWhere(['activity_id'=> $_GET['id']])->One();
$PArp = ProjectAssessmentResult::find()->andWhere(['type'=>'psikogram_setneg'])->andWhere(['project_assessment_id'=>$Pa->id])->Sum('value');
$PArk = ProjectAssessmentResult::find()->andWhere(['type'=>'kompetensi_setneg'])->andWhere(['project_assessment_id'=>$Pa->id])->Sum('value');
$sumC =     CatalogMeta::find()->andWhere(['catalog_id'=>$Pa->catalog_id])->andWhere(['type'=>'kompetensi_setneg'])->Sum('attribute_1');

$sumbuY = round($PArk/$sumC*100);
$sumbuX = round($PArp/62*100);


?>



<section class="sheet padding-25mm">
<div class="headerReport">
<h2>RAHASIA</h2>
<hr></div>
<img style="position:absolute; right: 100px; top: 50px;" src="<?=Url::base();?>/images/ppsdm-logo-atas.png">
<article>


<div class='center'>
<h3>
KEGIATAN PROFIL ASESMEN KOMPETENSI<BR/>
JABATAN ADMINISTRATOR, PENGAWAS, PELAKSANA DAN FUNGSIONAL DI <BR/>
LINGKUNGAN KEMENTERIAN SEKRETARIAT NEGARA<BR/>
REPUBLIK INDONESIA<BR/>
TAHUN 2017</h3>
</div>

<br/>


<div style="font-size: 18pt;position:absolute; right: 95px; top: 290px;">
<?=Html::img('@web/project-uploads/4/photos/'.$data['profile']['id'].'.jpg', ['alt' => '--missing image--','style'=> 'max-width:150px;max-height:150px' ]);?>
</div>
<?php




if (strlen($day) > 1 ){$day1 = $day;} else {$day1 = '0'.$day;}
if (strlen($month) > 1 ){$month1 = $month;} else {$month1 = '0'.$month;}

$tanggaltest=  $day1.$month1.substr($year,2,2);


$myDateTime = DateTime::createFromFormat('Y-m-d', $data['profile']['birthdate']);
$tgl_lahir = $myDateTime->format('d/m/Y');
?>

<table class='cover'>
<tbody>
<tr>
<td>Nomor Test</td><td>:</td><td><?=$nomor_test;?>/EVAL/SETNEG/<?=$tanggaltest;?>/<?=$array_bulan[$month];?>/<?=$year;?> </td></tr>
<tr>
<td>Nama Lengkap</td><td>:</td><td><b><?=isset($data['profile']['first_name'])?$data['profile']['first_name']  : ''; ?></b></td></tr>
<tr>
<td>Tempat, Tgl. Lahir</td><td>:</td><td><?=isset($data['profile']['birthplace'])?$data['profile']['birthplace']  : ''; ?>, <?=isset($tgl_lahir)?$tgl_lahir  : ''; ?></td></tr>
<tr>
<td>Jabatan Saat ini</td><td>:</td><td><?=isset($data['profile']['current_position'])?$data['profile']['current_position']  : ''; ?></td></tr>
<tr>
<td>Golongan</td><td>:</td><td><?=isset($data['profile']['golongan'])?$data['profile']['golongan']  : ''; ?></td></tr>
<tr>
<td>Pendidikan Terakhir</td><td>:</td><td><?=isset($data['profile']['latest_education'])?$data['profile']['latest_education']  : ''; ?></td></tr>
<tr>
<td>Tujuan Pemeriksaan</td><td>:</td><td>PEMETAAN POTENSI & KOMPETENSI</td></tr>
<tr>
<td>Tempat / Tgl Test</td><td>:</td><td>Jakarta,  
<?php 
 if ($data['tanggal_test'] == "9/11/2017 8:00"){ 
     echo '9 - 10 November 2017'; 
    }
 else {
     echo '1 - '.$newDateSignature;
    }
 ?>
 </td>
</tr>
</tbody>
</table>

<?php
//$date = date_create($date_test);
//date_add($date, date_interval_create_from_date_string('21 days'));

$date = date_create($year.'-'.$month.'-'.$day);
date_add($date, date_interval_create_from_date_string('21 days'));
//overwrite tanggal sama 24 nov
$date = date_create($year.'-'.$month.'-24');
?>

<div class='center'>
<br/>
<br/>
    Jakarta, <?=str_replace($monthE,$bulan,date_format($date, "j F Y"));?><br/>
    <b>PPSDM Consultant</b>
</div>
<br/>
<table>
<tr>
<td>
<div class='kananTandaTangan'>
<div class='center'>
	Assesor<br/>
	<b><?=$data['assessor_name'];?><b>
</div>
</div>
</td>
<td width='200px'>
</td>
<td>
<div class='kiriTandaTangan'>
<div class='center'>
	Penanggung jawab<br/>
	<strong>Drs. Budiman Sanusi, MPsi.
	<br/>
	SIP : 0723-12-2-1</strong>
</div>
</div>
</td>
</tr>
</table>
<?=$footerReport;?>
</article>
</section>

<section class="sheet padding-25mm">
<div class="headerReport">
<h2>RAHASIA</h2>
<hr></div>
<img style="position:absolute; right: 100px; top: 48px;" src="<?=Url::base();?>/images/ppsdm-logo-atas.png">
<article>

<div class='center'>
<h3>EXECUTIVE SUMMARY</h3>
</div>
<?php
$htmltag = array('<p style="text-align: justify;">','<p></p>');
$htmlesc   = array('<p>','');
?>
<div style="margin-bottom:60px;text-align:justify;text-justify:inter-word;font-size: 12;";>
<?=wordwrap(str_replace($htmltag, $htmlesc, $data['uraian']['executive_summary']), 3150,  $pagebreak, false);?>
</div>


<?=$footerReport;?>
</article>
</section>




<section class="sheet padding-25mm">
<div class="headerReport">
<h2>RAHASIA</h2>
<hr></div>
<img style="position:absolute; right: 100px; top: 48px;" src="<?=Url::base();?>/images/ppsdm-logo-atas.png">
<article>

<div class='center'>
<h3>DIAGRAM KOMPETENSI</H3>

 <div class="radarChart" style=" background-image: url('<?=Url::base();?>/images/4/<?=$data['catalog_id'];?>.png'); 
 background-position: center; background-repeat: no-repeat;background-size: 400px 420px;"></div>
 <script src="<?=Url::to('@web/js/radarChart.js');?>"></script>

 
		<script>
      
      /* Radar chart design created by Nadieh Bremer - VisualCinnamon.com */
      
			////////////////////////////////////////////////////////////// 
			//////////////////////// Set-Up ////////////////////////////// 
			////////////////////////////////////////////////////////////// 

			var margin = {top: 10, right: 50, bottom: 35, left: 50},
				width = Math.min(500, window.innerWidth - 10) - margin.left - margin.right,
				height = Math.min(width, window.innerHeight - margin.top - margin.bottom - 20);
					
			////////////////////////////////////////////////////////////// 
			////////////////////////// Data ////////////////////////////// 
			////////////////////////////////////////////////////////////// 
			var data = [
				[
			<?php $kompetensigram = $data['kompetensigram']['lkj'];
					  			foreach ($kompetensigram as $key => $value) {
					  				echo "{axis:'',value:'".trim($value)."'},";
					  			}

			?>
				],
                [
                    <?php $kompetensigram = $data['kompetensigram']['lki'];
					  			foreach ($kompetensigram as $key => $value) {
					  				echo "{axis:'',value:'".trim($value)."'},";
					  			}

			?>
                ],
			  ];

			////////////////////////////////////////////////////////////// 
			//////////////////// Draw the Chart ////////////////////////// 
			////////////////////////////////////////////////////////////// 

			var color = d3.scale.ordinal()
			.range(['#AEDFFB','#35274E']);
			
			var radarChartOptions = {
			w: width,
			h: height,
			margin: margin,
			maxValue: 7,
			levels: 6,
			roundStrokes: false,
			color: color,
			opacityArea: 0.5,
			opacityCircles: 0,
			dotRadius: 3,
			strokeWidth: 2, 
			wrapWidth: 10,
			labelFactor: 10,
			};
			//Call function to draw the Radar chart
			RadarChart(".radarChart", data, radarChartOptions);
		</script>

<br/>


<table class="blueTable2">
	<thead>
		<tr>
			<th>Kategori</th>
			<th>Kompetensi</th>
			<th>LKJ</th>
			<th>LKI</th>
			<th>GAP</th>
            <th>PCT (%)</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="2">Total</td>
			<td><?= $total_lkj?></td>
			<td><?= $total_lki?></td>
            <td><?= $total_lkj - $total_lki ?></td>
			<td><?= round((($total_lki ) / $total_lkj * 100),0) ?> %</td>
		</tr>
	</tfoot>
	<tbody>

  <?php
  foreach ($data['kompetensigram']['lkj'] as $key => $value) {

    $gaps[$key] = $data['kompetensigram']['lkj'][$key] - $data['kompetensigram']['lki'][$key];
     ?> 
		<tr>
			<td>Kompetensi Managerial</td>
			<td><?=$key;?></td>
			<td><?=$value;?></td>
			<td><?= $data['kompetensigram']['lki'][$key]?></td>
    <td><?= $data['kompetensigram']['lkj'][$key] - $data['kompetensigram']['lki'][$key]?></td>
       
			<td><?= round((($data['kompetensigram']['lki'][$key] ) / $data['kompetensigram']['lkj'][$key] * 100),0) ?> %</td>
		</tr>

<?php   } ?>      
		
	</tbody>
</table>

</div>
<br/>


<table class="rekomendasi" align="center">

<tr bgcolor="#B8CCE4">
<th colspan="2" rowspan="1" scope="col">Kualifikasi</th>
<th colspan="1" rowspan="1" scope="col">Rekomendasi</th>
<th colspan="3" rowspan="1" scope="col">Skala</th>
</tr>
<?php



if (round($PArk/$sumC*100) >=100) {
    $bgclolor1 = '#C4D79B';$bgclolor2 = '#ffffff';$bgclolor3 = '#ffffff';
}

else if ((round($PArk/$sumC*100) >= 75) && (round($PArk/$sumC*100) <= 99)) {
    $bgclolor1 = '#ffffff';$bgclolor2 = '#C4D79B';$bgclolor3 = '#ffffff';

}

else {
	$bgclolor1 = '#ffffff';$bgclolor2 = '#ffffff';$bgclolor3 = '#C4D79B';
}

?>
<tbody>
<tr bgcolor="<?=$bgclolor1;?>">
<td>K-1</td>
<td>Baik</td>
<td>Ready Now</td>
<td>100%</td><td>-</td><td>ke atas</td>
</tr>
<tr bgcolor="<?=$bgclolor2;?>">
<td>K-2</td>
<td>Cukup</td>
<td>Ready with development</td>
<td>75%</td><td>-</td><td>99%</td>
</tr>
<tr bgcolor="<?=$bgclolor3;?>">
<td>K-3</td>
<td>Kurang</td>
<td>Not Ready</td>
<td>74%</td><td>-</td><td>ke bawah</td>
</tr>
</tbody>
</table>
</div>
<?=$footerReport;?>
</article>
</section>


<section class="sheet padding-25mm">
<div class="headerReport">
<h2>RAHASIA</h2>
<hr></div>
<img style="position:absolute; right: 100px; top: 48px;" src="<?=Url::base();?>/images/ppsdm-logo-atas.png">
<article>

<div class='center'>
<h3>PSIKOGRAM HASIL PEMERIKSAAN POTENSI PSIKOLOGIK</h3>
</div>
<table border="3" cellpadding="0" cellspacing="0" style="border-collapse:collapse;width:100%">
   <colgroup>
	   <col span="1"><col span="3"  width="64">
	   <col  width="60">
	   <col span="5"  width="64">
	   <col  width="12">
	   <col  width="32">
	   <col  width="28">
	   <col  width="32">
	   <col  width="33">
	   <col width="24">
	   <col  width="22">
	   <col  width="32">
   </colgroup>
   <tr bgcolor="yellow">
	   <td class="psikogramtable1" colspan="5" rowspan="2"  >
	   ASPEK PSIKOLOGIS</td>
	   <td class="psikogramtable2" colspan="6" rowspan="2" >
	   KETERANGAN</td>
	   <td class="psikogramtable3" colspan="7" >P E  N I L A I A N</td>
   </tr>
   <tr bgcolor="yellow">
	   <td class="psikogramtable4" >1</td>
	   <td class="psikogramtable4" >2</td>
	   <td class="psikogramtable4" >3</td>
	   <td class="psikogramtable4" >4</td>
	   <td class="psikogramtable4" >5</td>
	   <td class="psikogramtable4" >6</td>
	   <td class="psikogramtable5" >7</td>
   </tr>
   <tr bgcolor="#B8CCE4">
	   <td class="psikogramtable6"  style="height: 20pt;; width: 25px;">
	   A</td>
	   <td class="psikogramtable7" colspan="17">ASPEK INTELEKTUAL</td>
   </tr>
   <tr>
	   <td class="psikogramtable8"  rowspan="4" >
	   &nbsp;</td>
	   <td class="psikogramtable9" >1</td>
	   <td class="psikogramtable10" colspan="3">
  
	   Inteligensi umum</td>
	   <td class="psikogramtable11" colspan="6" >
	   Gabungan keseluruhan potensi kecerdasan sebagai perpaduan dari aspek-aspek pembentukan intelektualitas</td>
	   <td class="psikogramtable12"> 
            <?php echo ($data['psikogram']['lki']['inteligensi_umum'] == '1') ? 'X' : '';?></td>
	   <td class="psikogramtable12">
            <?php echo ($data['psikogram']['lki']['inteligensi_umum'] == '2') ? 'X' : '';?></td>
	   <td class="psikogramtable12"> 
            <?php echo ($data['psikogram']['lki']['inteligensi_umum'] == '3') ? 'X' : '';?></td>
	   <td class="psikogramtable13"> 
            <?php echo ($data['psikogram']['lki']['inteligensi_umum'] == '4') ? 'X' : '';?></td>
	   <td class="psikogramtable12">
            <?php echo ($data['psikogram']['lki']['inteligensi_umum'] == '5') ? 'X' : '';?></td>
	   <td class="psikogramtable12">
            <?php echo ($data['psikogram']['lki']['inteligensi_umum'] == '6') ? 'X' : '';?></td>
	   <td class="psikogramtable12"> 
            <?php echo ($data['psikogram']['lki']['inteligensi_umum'] == '7') ? 'X' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9" >
	   2</td>
	   <td class="psikogramtable10" colspan="3">Berpikir Analitis</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kemampuan menguraikan masalah  &  melihat kaitan antara satu hal dg hal lainnya hingga menemukan kesimpulan</td>
	   <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['berpikir_analitis'] == '1') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['berpikir_analitis'] == '2') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['berpikir_analitis'] == '3') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['berpikir_analitis'] == '4') ? 'X' : '';?></td>
  <td class="psikogramtable13">
       <?php echo ($data['psikogram']['lki']['berpikir_analitis'] == '5') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['berpikir_analitis'] == '6') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['berpikir_analitis'] == '7') ? 'X' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9" >
	   3</td>
	   <td class="psikogramtable10" colspan="3">Logika Berpikir</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kemampuan untuk mengorganisir proses berpikir yang menunjukkan adanya alur berpikir yang sistematis dan logis</td>
	   <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['logika_berfikir'] == '1') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['logika_berfikir'] == '2') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['logika_berfikir'] == '3') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['logika_berfikir'] == '4') ? 'X' : '';?></td>
  <td class="psikogramtable13">
       <?php echo ($data['psikogram']['lki']['logika_berfikir'] == '5') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['logika_berfikir'] == '6') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['logika_berfikir'] == '7') ? 'X' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9" >
	   4</td>
	   <td class="psikogramtable10" colspan="3">Kemampuan Belajar</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kemampuan menguasai dan meningkatkan pengetahuan dan ketrampilan kerja yang baru maupun yang telah dimiliki</td>
	   <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['kemampuan_belajar'] == '1') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['kemampuan_belajar'] == '2') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['kemampuan_belajar'] == '3') ? 'X' : '';?></td>
  <td class="psikogramtable13">
       <?php echo ($data['psikogram']['lki']['kemampuan_belajar'] == '4') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['kemampuan_belajar'] == '5') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['kemampuan_belajar'] == '6') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['kemampuan_belajar'] == '7') ? 'X' : '';?></td>
   </tr>

   <tr bgcolor="bf8f00">
	   <td class="psikogramtable6"  style="height: 20pt;; width: 25px;">
	   B</td>
	   <td class="psikogramtable7" colspan="17">ASPEK SIKAP KERJA</td>
   </tr>
   <tr>
	   <td class="psikogramtable8"  rowspan="5" >
	   &nbsp;</td>
	   <td class="psikogramtable9" >1</td>
	   <td class="psikogramtable10" colspan="3">Sistematika Kerja</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kemampuan dan ketrampilan menyelesaikan suatu tugas secara runut, proporsional, sesuai dengan skala prioritas tertentu</td>
       <td class="psikogramtable12">
            <?php echo ($data['psikogram']['lki']['sistematika_kerja'] == '1') ? 'X' : '';?></td>       
       <td class="psikogramtable12">
            <?php echo ($data['psikogram']['lki']['sistematika_kerja'] == '2') ? 'X' : '';?></td>
       <td class="psikogramtable12">
            <?php echo ($data['psikogram']['lki']['sistematika_kerja'] == '3') ? 'X' : '';?></td>
       <td class="psikogramtable13">
            <?php echo ($data['psikogram']['lki']['sistematika_kerja'] == '4') ? 'X' : '';?></td>
       <td class="psikogramtable12">
            <?php echo ($data['psikogram']['lki']['sistematika_kerja'] == '5') ? 'X' : '';?></td>
       <td class="psikogramtable12">
            <?php echo ($data['psikogram']['lki']['sistematika_kerja'] == '6') ? 'X' : '';?></td>
       <td class="psikogramtable12">
            <?php echo ($data['psikogram']['lki']['sistematika_kerja'] == '7') ? 'X' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9" >
	   2</td>
	   <td class="psikogramtable10" colspan="3">Tempo Kerja</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kecepatan dan kecekatan kerja, yang menunjukkan kemampuan menyelesaikan sejumlah tugas dalam batas waktu tertentu <span style="mso-spacerun:yes">&nbsp;</span></td>
       <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['tempo_kerja'] == '1') ? 'X' : '';?></td>       
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['tempo_kerja'] == '2') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['tempo_kerja'] == '3') ? 'X' : '';?></td>
  <td class="psikogramtable13">
       <?php echo ($data['psikogram']['lki']['tempo_kerja'] == '4') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['tempo_kerja'] == '5') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['tempo_kerja'] == '6') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['tempo_kerja'] == '7') ? 'X' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9" >
	   3</td>
	   <td class="psikogramtable10" colspan="3">Ketelitian</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kemampuan bekerja dengan sesedikit mungkin melakukan kesalahan atau kekeliruan</td>
       <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['ketelitian'] == '1') ? 'X' : '';?></td>       
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['ketelitian'] == '2') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['ketelitian'] == '3') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['ketelitian'] == '4') ? 'X' : '';?></td>
  <td class="psikogramtable13">
       <?php echo ($data['psikogram']['lki']['ketelitian'] == '5') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['ketelitian'] == '6') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['ketelitian'] == '7') ? 'X' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9" >4</td>
	   <td class="psikogramtable10" colspan="3" style="height: 20pt;">Ketekunan</td>
	   <td class="psikogramtable11" colspan="6"  width="332">
	   Daya tahan menghadapi dan menyelesaikan tugas sampai tuntas dalam waktu relatif lama dengan mencapai hasil yang optimal</td>
       <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['ketekunan'] == '1') ? 'X' : '';?></td>       
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['ketekunan'] == '2') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['ketekunan'] == '3') ? 'X' : '';?></td>
  <td class="psikogramtable13">
       <?php echo ($data['psikogram']['lki']['ketekunan'] == '4') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['ketekunan'] == '5') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['ketekunan'] == '6') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['ketekunan'] == '7') ? 'X' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9"  >
	   5</td>
	   <td class="psikogramtable10" colspan="3">Komunikasi Efektif</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kemampuan menyampaikan pendapat secara lancar, sehingga pendengar paham dan bersedia mengikuti pendapatnya</td>
       <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['komunikasi_efektif'] == '1') ? 'X' : '';?></td>       
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['komunikasi_efektif'] == '2') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['komunikasi_efektif'] == '3') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['komunikasi_efektif'] == '4') ? 'X' : '';?></td>
  <td class="psikogramtable13">
       <?php echo ($data['psikogram']['lki']['komunikasi_efektif'] == '5') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['komunikasi_efektif'] == '6') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['komunikasi_efektif'] == '7') ? 'X' : '';?></td>
   </tr>
   <tr bgcolor="#00b050">
	   <td class="psikogramtable6"  style="height: 20pt;; width: 25px;">
	   C</td>
	   <td class="psikogramtable7" colspan="17">ASPEK KEPRIBADIAN</td>
   </tr>
   <tr>
	   <td class="psikogramtable8"  rowspan="5" >
	   &nbsp;</td>
	   <td class="psikogramtable9" >1</td>
	   <td class="psikogramtable10" colspan="3">Motivasi</td>
	   <td class="psikogramtable11" colspan="6" >
	   Keinginan meningkatkan hasil kerja dan selalu berfokus pada profit opportunities</td>
       <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['motivasi'] == '1') ? 'X' : '';?></td>       
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['motivasi'] == '2') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['motivasi'] == '3') ? 'X' : '';?></td>
  <td class="psikogramtable13">
       <?php echo ($data['psikogram']['lki']['motivasi'] == '4') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['motivasi'] == '5') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['motivasi'] == '6') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['motivasi'] == '7') ? 'X' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9" >
	   2</td>
	   <td class="psikogramtable10" colspan="3">Konsep Diri</td>
	   <td class="psikogramtable11" colspan="6" >
	   Pemahaman atas kelebihan dan kekurangan diri sendiri</td>
       <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['konsep_diri'] == '1') ? 'X' : '';?></td>       
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['konsep_diri'] == '2') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['konsep_diri'] == '3') ? 'X' : '';?></td>
  <td class="psikogramtable13">
       <?php echo ($data['psikogram']['lki']['konsep_diri'] == '4') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['konsep_diri'] == '5') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['konsep_diri'] == '6') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['konsep_diri'] == '7') ? 'X' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9" >
	   3</td>
	   <td class="psikogramtable10" colspan="3">Empati</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kemampuan memahami dan merasakan adanya permasalahan dan kondisi emosional orang lain</td>
       <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['empati'] == '1') ? 'X' : '';?></td>       
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['empati'] == '2') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['empati'] == '3') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['empati'] == '4') ? 'X' : '';?></td>
  <td class="psikogramtable13">
       <?php echo ($data['psikogram']['lki']['empati'] == '5') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['empati'] == '6') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['empati'] == '7') ? 'X' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9" >
	   4</td>
	   <td class="psikogramtable10" colspan="3">Pemahaman Sosial</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kemampuan bereaksi dengan cepat terhadap kebutuhan orang lain atau tuntutan lingkungan, serta memahami norma sosial yang berlaku.</td>
       <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['pemahaman_sosial'] == '1') ? 'X' : '';?></td>       
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['pemahaman_sosial'] == '2') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['pemahaman_sosial'] == '3') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['pemahaman_sosial'] == '4') ? 'X' : '';?></td>
  <td class="psikogramtable13">
       <?php echo ($data['psikogram']['lki']['pemahaman_sosial'] == '5') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['pemahaman_sosial'] == '6') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['pemahaman_sosial'] == '7') ? 'X' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9"  >
	   5</td>
	   <td class="psikogramtable10" colspan="3">Pengaturan Diri</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kemampuan mengendalikan diri dalam situasi-situasi sulit dan kemampuan melakukan perencanaan sebelum bertindak.   <span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;</span></td>
       <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['pengaturan_diri'] == '1') ? 'X' : '';?></td>       
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['pengaturan_diri'] == '2') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['pengaturan_diri'] == '3') ? 'X' : '';?></td>
  <td class="psikogramtable13">
       <?php echo ($data['psikogram']['lki']['pengaturan_diri'] == '4') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['pengaturan_diri'] == '5') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['pengaturan_diri'] == '6') ? 'X' : '';?></td>
  <td class="psikogramtable12">
       <?php echo ($data['psikogram']['lki']['pengaturan_diri'] == '7') ? 'X' : '';?></td>
   </tr>
   <tr bgcolor="#B8CCE4">
	   <td class="psikogramtable18" colspan="11" width="444">
	   TOTAL SKOR</td>
	   <td class="psikogramtable2" colspan="7"><div id="total_psikogram"><?= $total_psikogram ?></div></td>
   </tr>
</table>

<br/>

<table width="100%" class="rekomendasi">
<thead>
<tr>
<td style='font-size:12px;' colspan="6"><strong>REKOMENDASI : </strong>Memperhatikan seluruh Gambaran  aspek psikologis yang dimiliki, dikaitkan dengan kemungkinan keberhasilannya untuk memikul beban tugas dan tanggung jawab yang lebih besar, maka Potensi Psikologinya secara umum tergolong :</td>
</tr>
</thead>
<tbody>
<tr bgcolor="#B8CCE4">
<th colspan="2" rowspan="1" scope="col">Kualifikasi</th>
<th colspan="1" rowspan="1" scope="col">Rekomendasi</th>
<th colspan="3" rowspan="1" scope="col">Skala</th>
</tr>
<?php


if (round($PArp/62*100) >=100) {
    $bgclolor1 = '#C4D79B';$bgclolor2 = '#ffffff';$bgclolor3 = '#ffffff';
}
else if ((round($PArp/62*100) >= 75) && (round($PArp/62*100) <= 99)) {
    $bgclolor1 = '#ffffff';$bgclolor2 = '#C4D79B';$bgclolor3 = '#ffffff';
}
else {
	$bgclolor1 = '#ffffff';$bgclolor2 = '#ffffff';$bgclolor3 = '#C4D79B';
}
?>
<tr bgcolor="<?=$bgclolor1;?>">
<td>K-1</td>
<td>Baik</td>
<td>Mampu berkembang secara wajar</td>
<td>100%</td><td>-</td><td>ke atas</td>
</tr>
<tr bgcolor="<?=$bgclolor2;?>">
<td>K-2</td>
<td>Cukup</td>
<td>Mampu berkembang spesifik</td>
<td>75%</td><td>-</td><td>99%</td>
</tr>
<tr bgcolor="<?=$bgclolor3;?>">
<td>K-3</td>
<td>Kurang</td>
<td>Kemampuan perkembangannya terbatas</td>
<td>74%</td><td>-</td><td>ke bawah</td>
</tr>
</tbody>
</table>
<?=$footerReport;?>
</article>
</section>



<section class="sheet padding-25mm">
<div class="headerReport">
<h2>RAHASIA</h2>
<hr></div>
<img style="position:absolute; right: 100px; top: 50px;" src="<?=Url::base();?>/images/ppsdm-logo-atas.png">
<article>

<br/>
	<div class='center' style="border-style: solid;"><h3>GAMBARAN POSISI 9-CELL (KOMPETENSI DAN POTENSI)</h3></div>


<!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>-->
    <script src="<?=Url::to('@web/js/loader.js');?>" charset="utf-8"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart'], 'language': 'id'});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Potensi', 'Kompetensi'],
          [ <?=round($PArp/62*100); ?>,  <?=round($PArk/$sumC*100); ?>], //ini harus diisi

        ]);

        var options = {
         
          hAxis: {
              //title: 'Potensi', minValue: 0, maxValue: 100,
              gridlines:{color: '#eee', count: 7},
			  ticks: [0, 20, 40, 60, 80, 100, 120, 140, ]
              },
          vAxis: {
             // title: 'Kompetensi', minValue: 0, maxValue: 100, 
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
<table class="center">
<tr>
<td align="left">

<?php
$sumbuY = round($PArk/$sumC*100);
$sumbuX = round($PArp/62*100);
if ($sumbuY >=100) {
    echo "<img height='450' width='130' src=".Url::base()."/images/kompetensiSumbuY-top.png>";
}

else if ($sumbuY >= 75 && $sumbuY <= 99) {
    echo "<img height='450' width='130' src=".Url::base()."/images/kompetensiSumbuY-middle.png>";

}
else {
	echo "<img height='450' width='130' src=".Url::base()."/images/kompetensiSumbuY-bottom.png>";
}
?>

</td>
<td>
<div id="chart_div" 
    style="width: 600px; height: 600px; 
    background-image: url('<?=Url::base()?>/images/ninecell.png'); 
    background-repeat: no-repeat;
    background-position: center; 
    ">
    </div>
 </td></tr>
 <tr>
 <td>
 
<div style= "margin:10px;">
<table style="width: 100%; margin-left: auto; margin-right: auto;" border="1" cellspacing="1" cellpadding="1">
<tbody>
<tr>
<td bgcolor="yellow">X</td>
<td bgcolor="yellow"><?=$sumbuX;?>%</td>
<td rowspan="2"><h2>
<?php 
if ($sumbuX < 75 && $sumbuY < 75) {$ninecellScore = 1;}
else if ($sumbuX < 75 && $sumbuY < 100 && $sumbuY > 74 && $sumbuY < 100) {$ninecellScore = 2;}
else if ($sumbuX >= 75 && $sumbuX < 100 && $sumbuY < 75) {$ninecellScore = 3;}
else if ($sumbuX < 75 && $sumbuY < 99) {$ninecellScore = 4;}
else if ($sumbuX >= 75 && $sumbuX < 100 && $sumbuY > 74 && $sumbuY < 100) {$ninecellScore = 5;}
else if ($sumbuX >= 100 && $sumbuY < 75) {$ninecellScore = 6;}
else if ($sumbuX >= 75 && $sumbuX < 100 && $sumbuY >= 100) {$ninecellScore = 7;}
else if ($sumbuX >= 100 && $sumbuY >= 75 && $sumbuY < 100) {$ninecellScore = 8;}
else if ($sumbuX >= 100 && $sumbuY >= 100) {$ninecellScore = 9;}
else {$ninecellScore = 0;}
echo '<font style="color:green;">'.$ninecellScore.'</font>';
?>
</h2></td>
</tr>
<tr >
<td bgcolor="#B8CCE4">Y</td>
<td bgcolor="#B8CCE4"><?=$sumbuY;?>%</td>
</tr>
</tbody>
</table>
</div>

 </td>
<td align="left">
<?php
if ($sumbuX >=100) {
    echo "<img height='125' width='500' src=".Url::base()."/images/potensiSumbuX.png>";
}

else if ($sumbuX >= 75 && $sumbuX<= 99) {
    echo "<img height='125' width='500' src=".Url::base()."/images/potensiSumbuX-middle.png>";

}

else {
    echo "<img height='125' width='500' src=".Url::base()."/images/potensiSumbuX-bottom.png>";
}
?>

</td>


 </table>  
 <?=$footerReport;?>
 </article>
 </section>



<!-- ------------ ini placeholder untuk uraian saran ---------- -->

 <section class="sheet padding-25mm">
 <div class="headerReport">
 <h2>RAHASIA</h2>
 <hr></div>
 <img style="position:absolute; right: 100px; top: 45px;" src="<?=Url::base();?>/images/ppsdm-logo-atas.png">
 <article>
 <h3>HASIL ASESSMENT BERDASARKAN KOMPETENSI</H3>
 <hr style='border-top: 3px double;'>
<?php



$i = 0;
$keysLength = count($data['kompetensigram']['lkj']);

foreach ($data['kompetensigram']['lkj'] as $key => $value) {
 $gaps[$key] = $data['kompetensigram']['lkj'][$key] - $data['kompetensigram']['lki'][$key];

 $kompetensidesc = RefAssessmentDictionary::find()
 ->andWhere(['type' => 'kompetensigram_setneg'])
 ->andWhere(['key' => 'uraian_setneg'])
 ->andWhere(['value' => $key])
 ->One();

 $evidence_kompetensi_model = ProjectAssessmentResult::find()
 ->andWhere(['project_assessment_id' => $Pa->id])
 ->andWhere(['type' => 'kompetensi_setneg'])
 ->andWhere(['key' => $key])
 ->andWhere(['value' => $data['kompetensigram']['lki'][$key]])
 ->One();

 $evidence_kompetensi = isset($evidence_kompetensi_model->textvalue) ? $evidence_kompetensi_model->textvalue : 'tidak ada uraian ('.$key . $data['kompetensigram']['lki'][$key] .')';
?>

<table  class="cluster" style = 'width: 100%; height: 100%; overflow: auto;'>
<tr>
<td class="cluster1" rowspan="3" ><h1><?=strtoupper($key);?></h1></td>
<td class="cluster3" rowspan="3" ><b><?=$kompetensidesc->textvalue;?></b><br/>
<?=$kompetensidesc->attribute_1;?></td>
<td class="cluster4" >Standar</td>
<td class="cluster4" ><?=$value;?></td>
</tr>
 <tr>
	 <td class="cluster4" >Individu</td>
	 <td class="cluster4" ><?= $data['kompetensigram']['lki'][$key]?></td>
 </tr>
 <tr>
	 <td class="cluster4" width="50px"  >Fit</td>
	 <td class="cluster4" width="50px" ><?= round((($data['kompetensigram']['lki'][$key] ) / $data['kompetensigram']['lkj'][$key] * 100),0) ?> %</td>
 </tr>
 <tr>
	 <td class="cluster5" colspan="4"><?= $evidence_kompetensi?></td>
 </tr>
 </table>
 <br/>
<?php

if(++$i == 3 ) {
    echo $footerReport.'</article></section><section class="sheet padding-25mm">
    <div class="headerReport">
    <h2>RAHASIA</h2>
    <hr></div>
    <img style="position:absolute; right: 100px; top: 45px;" src="/images/ppsdm-logo-atas.png">
    <article>
        <br/>';} else { echo '';} ;
        
}
?>
<?=$footerReport;?>
 </article>
</section>
<!-- ------------ ini placeholder untuk uraian saran ---------- -->


 <section class="sheet padding-25mm">
 <div class="headerReport">
 <h2>RAHASIA</h2>
 <hr></div>
 <img style="position:absolute; right: 100px; top: 50px;" src="<?=Url::base();?>/images/ppsdm-logo-atas.png">
 <article>
 <h3>KESIMPULAN</H3>
 <hr style='border-top: 3px double;'>
 <STRONG>A. HAL HAL POSITIF YANG MENUNJANG TAMPILNYA KINERJA YANG OPTIMAL</STRONG>

 <div style="text-align:justify;">
 <?=wordwrap(str_replace($htmltag, $htmlesc, $data['uraian']['kekuatan']), 3000,  $pagebreak, false);?>
 </div>
 <?php if (strlen($data['uraian']['kekuatan'])+strlen($data['uraian']['kelemahan']) >= 3000) {echo $pagebreak;} else {echo '';}?>

 <STRONG>B. HAL HAL NEGATIF YANG MENGHAMBAT TAMPILNYA KINERJA YANG OPTIMAL</STRONG>
 <div style="text-align:justify;">
 <?=wordwrap(str_replace($htmltag, $htmlesc, $data['uraian']['kelemahan']), 3000,  $pagebreak, false);?>
</div>

 <?=$footerReport;?>
 </article>
 </section>



 <section class="sheet padding-25mm">
 <div class="headerReport">
 <h2>RAHASIA</h2>
 <hr></div>
 <img style="position:absolute; right: 100px; top: 50px;" src="<?=Url::base();?>/images/ppsdm-logo-atas.png">
 <article>



 <H3>SARAN PENGEMBANGAN</h3>
 <hr style='border-top: 3px double;'>
 <?=wordwrap(str_replace($htmltag, $htmlesc,$data['uraian']['saran_pengembangan']), 2650,  $pagebreak, false);?>

 <div class ='signatureRekomendasi'>
<div class='center'>
	Jakarta, <?=str_replace($monthE,$bulan,date_format($date, "j F Y"));?><br/>
	<strong>A.n PSIKOLOGI PEMERIKSA :<br/>
	<img height="60" width="230"src="<?=Url::base();?>/images/1/signature.png">
	<br/>
Drs. BUDIMAN SANUSI, M.Psi., Psikolog<br/>
No. SIP : 07231221
</strong>
</div>
</div>
<?=$footerReport;?>
 </article>
 </section>



</body>

<?php

//echo '<pre>';
//print_r($data);
?>











