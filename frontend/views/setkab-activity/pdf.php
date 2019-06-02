<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

use yii\web\View;
use app\assets\AppAsset;
use yii\helpers\ArrayHelper;

$monthUS = array("","January","February","March","April","May","June","July","August","September","October","November","December");
$monthID = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");


$activityDateTest= $activity->tanggal_test;

$day = substr($activityDateTest, 0,2);
$month = substr($activityDateTest, 2,2);
$year = substr($activityDateTest, 4,4);
$dateTest = $day.'-'.$month.'-'.$year;
$newDate = str_replace($monthUS, $monthID, date("j F Y", strtotime($dateTest)+'21 days'));

$daySignature = substr($activityDateTest, 0,1).substr($activityDateTest, 1,1)+2;
$dateTestSignature = $daySignature.'-'.$month.'-'.$year;
$newDateSignature = str_replace($monthUS, $monthID,date("j F Y", strtotime($dateTestSignature)));

$footerReport='
<div class="footerReport">
<hr>
  <table width=100%>
    <tr>
      <td style="padding-right:10px;">
        <i>Assessment Psikologik dan Kompetensi Bagi Jabatan Tinggi Pratama,</i> <br/>
        <i>Jabatan Administrator, dan Jabatan Pengawas </i><br/>
        <i>Kementerian Kesehatan RI 2017 </i></div>
      </td>
      <td  style="text-align:left;border-left: solid  1px #000000;padding-left:10px;" valign="top">
        <div id="pageFooter"></div>
      </td>
    </tr>
  </table>';

$pagebreak = $footerReport.'</b></p></article>
  </section>
    <section class="sheet padding-25mm">
      <div class="headerReport">
        <h2>RAHASIA</h2>
        <hr>
      </div>
      <img style="position:absolute; right: 100px; top: 50px;" src="'.Url::base().'/images/ppsdm-logo-atas.png">
      <article><br/>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $profile->nama_lengkap; ?></title>
  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" type="text/css" href="<?php echo Url::to('@web/css/normalize.css');?>">
  <!-- Load paper.css for happy printing  -->
  <link rel="stylesheet" type="text/css"href="<?php echo Url::to('@web/css/paper.css');?>">
  <link rel="stylesheet" type="text/css" href="<?php echo Url::to('@web/css/psikogramTable.css');?>">
  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <script src="<?php echo Url::to('@web/js/d3.min.js');?>" charset="utf-8"></script>
</head>
<body class="A4">
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-0mm">
    <div style= "width: 210mm; height: 296mm; margin:0; background-image: url('<?=Url::base();?>/images/1/coverlaporan.png');
 background-position: center; background-repeat: no-repeat;background-size: 210mm 296mm" >
    <article>
    <div style="font-size: 18pt;position:absolute; left: 250px; top: 505px;"><b><?php echo $profile->nama_lengkap ?></b></div>
    <div style="font-size: 18pt;position:absolute; left: 250px; top: 550px;"><b><?php echo $profile->nip; ?></b></div>
    <div style="font-size: 18pt;position:absolute; left: 280px; top: 690px;"><b> <?php echo substr( $activityDateTest, 0,2 )." - ".$newDateSignature;?></b></div>
   </article>
  </section>

  <section class="sheet padding-25mm">
    <div class="headerReport">
      <h2>RAHASIA</h2>
        <hr>
    </div>
    <img style="position:absolute; right: 100px; top: 50px;" src="<?php echo Url::base();?>/images/ppsdm-logo-atas.png">
    <article>
      <div class='center'>
        <h3>
        LAPORAN<br/>
        ASSESSMENT PSIKOLOGIK DAN KOMPETENSI<br/>
        BAGI JABATAN PIMPINAN TINGGI PRATAMA,<br/>
        JABATAN ADMINISTRATOR DAN JABATAN PENGAWAS<br/>
        KEMENTERIAN KESEHATAN REPUBLIK INDONESIA 2017</h3>
      </div>
      <br/>
      <div style="font-size: 18pt;position:absolute; right: 95px; top: 305px;">
      <?php echo Html::img('@web/project-uploads/1/photos/'.$profile->profile_id.'.jpg', ['alt' => '--missing image--','style'=> 'max-width:150px;max-height:150px' ]);?>
      </div>
      <table class='cover'>
      <tbody>
      <tr><td>Nomor Test</td><td>:</td><td><?php echo $activity->no_test."/EVAL/ESELON4/KEMENKES/".$day."/IX/".$year;?> </td></tr>
      <tr><td>Nama Lengkap</td><td>:</td><td><b><?php echo $profile->nama_lengkap; ?></b></td></tr>
      <tr><td>Tempat / Tgl. Lahir</td><td>:</td><td><?php echo $profile->tempat_lahir.", ".date_format(date_create($profile->tanggal_lahir),"d/m/Y"); ?></td></tr>
      <tr><td>Jabatan Saat ini</td><td>:</td><td><?php echo $profile->jabatan_saat_ini; ?></td></tr>
      <tr><td>Prospek Jabatan</td><td>:</td><td><?php echo $profile->prospek_jabatan; ?></td></tr>
      <tr><td>Pendidikan Terakhir</td><td>:</td><td><?php echo $profile->pendidikan_terakhir; ?></td></tr>
      <tr><td>Tujuan Pemeriksaan</td><td>:</td><td>PEMETAAN POTENSI & KOMPETENSI</td></tr>
      <tr><td>Tempat / Tgl Test</td><td>:</td><td>Jakarta, <?=substr($activityDateTest, 0,2)." - ".$newDateSignature;?></td></tr>
      </tbody>
      </table>
      <?php
        // $date = date_create($newDate);
        // print_r($date);
        // date_add($date, date_interval_create_from_date_string('21 days'));
      ?>

      <div class='center'>
        <br/>
        <br/>
            Jakarta, <?php echo $newDate; ?><br/><b>PPSDM Consultant</b>
      </div>
      <br/>
      <table>
        <tr>
          <td>
            <div class='kananTandaTangan'>
              <div class='center'>
      	           Assesor<br/><b><?php echo $assessor->nama_lengkap;?><b>
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
      <?php echo $footerReport;?>
    </article>
  </section>

  <section class="sheet padding-25mm">
    <div class="headerReport">
      <h2>RAHASIA</h2>
      <hr>
    </div>
    <img style="position:absolute; right: 100px; top: 48px;" src="<?php echo Url::base();?>/images/ppsdm-logo-atas.png">
    <article>
      <div class='center'>
        <h3>EXECUTIVE SUMMARY</h3>
      </div>
      <?php
        $htmltag = array('<p style="text-align: justify;">','<p></p>');
        $htmlesc   = array('<p>','');
      ?>
      <div style="margin-bottom:60px;text-align:justify;text-justify:inter-word;font-size: 12;";>
        <?php echo wordwrap(str_replace($htmltag, $htmlesc, $activity->executive_summary), 3150,  $pagebreak, false);?>
      </div>
      <?php echo $footerReport;?>
    </article>
  </section>

  <section class="sheet padding-25mm">
    <div class="headerReport">
      <h2>RAHASIA</h2>
      <hr>
    </div>
    <img style="position:absolute; right: 100px; top: 52px;" src="<?php echo Url::base();?>/images/ppsdm-logo-atas.png">

    <article>
      <div class='center'>
      <h3>DIAGRAM KOMPETENSI</H3>
      <div class="radarChart" style="background-image: url('<?php echo Url::base(); ?>/images/1/29.png'); background-position: center; background-repeat: no-repeat;background-size: 400px 420px;"></div>
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
  			<?php foreach ($activity as $key => $value) {
  					  		if ($key == 'kompetensi') {
  					  			foreach ($value as $key2 => $value2) {
  					  				echo "{axis:'',value:'".trim($value2['standar'])."'},";
  					  			}
  					  		}
  					  	}
  			?>
  				],[
  					<?php
  					foreach ($activity as $key => $value) {
  					  		if ($key == 'kompetensi') {
  					  			foreach ($value as $key2 => $value2) {
  					  				echo 	"{axis:'',value:'".trim($value2['value'])."'},";

  					  			}
  					  		}
  					  	}?>
  				]
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
  			maxValue: 6,
  			levels: 5,
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
    </div>
    <div class='center'>
      <?php if(array_key_exists('0',$kompetensi)){?>
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width:100%;">
        	<colgroup>
        		<col span="1">
        		<col span="18" style="width:20pt" width="26">
        	</colgroup>
          <tr>
        		<td class="kompetensi1" colspan="12" height="20" style="height: 15.0pt; width: 240pt" width="312">
        		Kompetensi</td>
        		<td class="kompetensi1" colspan="2" style="width: 40pt" width="52">LKJ</td>
        		<td class="kompetensi2" colspan="2" style="width: 40pt" width="52">LKI</td>
        		<td class="kompetensi2" colspan="2" style="width: 40pt" width="52">GAP</td>
        		<td class="kompetensi2" colspan="2" style="width: 40pt" width="52">PCT</td>
        	</tr>
          <tr>
            <td class="kompetensi3" colspan="2"  rowspan="4" style="height: 70.0pt;">
            <div style= "transform: rotate(-90deg);">KOMPETENSI<br/>GENERIK</div></td>
            <td class="kompetensi4" colspan="8"></td>
            <td class="kompetensi5" colspan="2"></td>
            <td class="kompetensi6" colspan="2"></td>
            <td class="kompetensi5" colspan="2"></td>
            <td class="kompetensi7" colspan="2" ></td>
            <td class="kompetensi7" colspan="2" ></td>
          </tr>
          <tr>
            <td class="kompetensi4" colspan="8"></td>
            <td class="kompetensi5" colspan="2"></td>
            <td class="kompetensi6" colspan="2"></td>
            <td class="kompetensi5" colspan="2"></td>
            <td class="kompetensi7" colspan="2" ></td>
            <td class="kompetensi7" colspan="2" ></td>
          </tr>
          <tr>
            <td class="kompetensi4" colspan="8"></td>
            <td class="kompetensi5" colspan="2"></td>
            <td class="kompetensi6" colspan="2"></td>
            <td class="kompetensi5" colspan="2"></td>
            <td class="kompetensi7" colspan="2" ></td>
            <td class="kompetensi7" colspan="2" ></td>
          </tr>
          <tr>
            <td class="kompetensi4" colspan="8"></td>
            <td class="kompetensi5" colspan="2"></td>
            <td class="kompetensi6" colspan="2"></td>
            <td class="kompetensi5" colspan="2"></td>
            <td class="kompetensi7" colspan="2" ></td>
            <td class="kompetensi7" colspan="2" ></td>
          </tr>
          <tr>
            <td class="kompetensi23" colspan="2" height="140" rowspan="7" style="height: 105.0pt; ">
            <div style= "transform: rotate(-90deg);">KOMPETENSI <br>SPESIFIK</div></td>
            <td class="kompetensi24" colspan="8"></td>
            <td class="kompetensi25" colspan="2"></td>
            <td class="kompetensi26" colspan="2"></td>
            <td class="kompetensi25" colspan="2"></td>
            <td class="kompetensi27" colspan="2" ></td>
            <td class="kompetensi27" colspan="2" ></td>
          </tr>
          <tr>
            <td class="kompetensi4" colspan="8"></td>
            <td class="kompetensi5" colspan="2"></td>
            <td class="kompetensi6" colspan="2"></td>
            <td class="kompetensi5" colspan="2"></td>
            <td class="kompetensi7" colspan="2" ></td>
            <td class="kompetensi7" colspan="2" ></td>
          </tr>
          <tr>
            <td class="kompetensi4" colspan="8"></td>
            <td class="kompetensi5" colspan="2"></td>
            <td class="kompetensi6" colspan="2"></td>
            <td class="kompetensi5" colspan="2"></td>
            <td class="kompetensi7" colspan="2" ></td>
            <td class="kompetensi7" colspan="2" ></td>
          </tr>
          <tr>
            <td class="kompetensi4" colspan="8"></td>
            <td class="kompetensi5" colspan="2"></td>
            <td class="kompetensi6" colspan="2"></td>
            <td class="kompetensi5" colspan="2"></td>
            <td class="kompetensi7" colspan="2" ></td>
            <td class="kompetensi7" colspan="2" ></td>
          </tr>
          <tr>
            <td class="kompetensi4" colspan="8"></td>
            <td class="kompetensi5" colspan="2"></td>
            <td class="kompetensi6" colspan="2"></td>
            <td class="kompetensi5" colspan="2"></td>
            <td class="kompetensi7" colspan="2" ></td>
            <td class="kompetensi7" colspan="2" ></td>
          </tr>
          <tr>
            <td class="kompetensi4" colspan="8"></td>
            <td class="kompetensi5" colspan="2"></td>
            <td class="kompetensi6" colspan="2"></td>
            <td class="kompetensi5" colspan="2"></td>
            <td class="kompetensi7" colspan="2" ></td>
            <td class="kompetensi7" colspan="2" ></td>
          </tr>
          <tr>
            <td class="kompetensi46" colspan="8">&nbsp;</td>
            <td class="kompetensi45" colspan="2">TOTAL</td>
            <td class="kompetensi46" colspan="2"></td>
            <td class="kompetensi47" colspan="2"></td>
            <td class="kompetensi47" colspan="2" ></td>
            <td class="kompetensi47" colspan="2" ></td>
          </tr>
      <?php } else { echo "Data Not Found "; } ?>
    <br/>

    <table class="rekomendasi" align="center">
      <tr bgcolor="#B8CCE4">
        <th colspan="2" rowspan="1" scope="col">Kualifikasi</th>
        <th colspan="1" rowspan="1" scope="col">Rekomendasi</th>
        <th colspan="3" rowspan="1" scope="col">Skala</th>
      </tr>
      <?php
        $PArk = 86;
        $PArp = 90;
        $sumC = 74;

        if (round($PArk/$sumC*100) >=100) {
            $bgclolor1 = '#C4D79B';$bgclolor2 = '#ffffff';$bgclolor3 = '#ffffff';
        }elseif((round($PArk/$sumC*100) >= 75) && (round($PArk/$sumC*100) <= 99)) {
            $bgclolor1 = '#ffffff';$bgclolor2 = '#C4D79B';$bgclolor3 = '#ffffff';

        }else {
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
