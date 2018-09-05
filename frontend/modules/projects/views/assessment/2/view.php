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

use kartik\grid\GridView;
use machour\yii2\notifications\widgets\NotificationsWidget;
use common\modules\core\models\Notification;
use kartik\editable\Editable;
use yii2tech\html2pdf\Manager;

/* @var $this yii\web\View */
/* @var $model app\modules\projects\models\Activity */

$this->title = $model->name;

$catalog_id = 30;


$proj_act = ProjectActivity::findOne($_GET['id']);



$options = [1 => '1',2 => '2',3=>'3',4=>'4',5=>'5',6=>'6',7 => '7'];

    $form = ActiveForm::begin([
        'action' => ['savecakim'],
        'method' => 'post',
    ]);
//Notification::notify(Notification::KEY_NEW_MESSAGE, '2', '99');

$statusproject = ProjectActivityMeta::find()
->andWhere(['project_activity_id' => $_GET['id']])
->andWhere(['type' => 'assessment'])
->andWhere(['key' => 'status'])
->One();
$user_profile = Profile::find()->andWhere(['user_id' => Yii::$app->user->id])->One();
$is_so = ProfileMeta::find()
->andWhere(['profile_id' => $user_profile->id])
->andWhere(['type' => 'project-role'])
->andWhere(['value' => 'second_opinion'])
->andWhere(['key'=> '2'])
->One();


if (($statusproject->value == 'done') )
        {
            if (null !== $is_so) {

            } else {
  //Yii::$app->session->addFlash('warning', 'anda sudah tidak dapat mangakses lagi');
//return Yii::$app->response->redirect(Url::to(['project/dashboard', 'id' => '2']));

  //echo 'IS NOT SO';
  //echo $is_so->value;
  //echo $user_profile->id;
}
        }

                    $assessee_model = ProjectActivityMeta::find()
                    ->andWhere(['project_activity_id' => $_GET['id']])
                    ->andWhere(['type' => 'general'])
                    ->andWhere(['key' => 'assessee'])->One();
                    if (null !== $assessee_model) {
                    $assessee_profile_model = Profile::findOne($assessee_model->value);
                    $profile_id = $assessee_profile_model->id;



$Pa = ProjectAssessment::find()->andWhere(['activity_id'=> $_GET['id']])->One();

//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title .'(cat='.$catalog_id . ', assessment='. $Pa->id. ')';


                } else {
                        $profile_id = 'NO-ID';
                }





?>
 <link rel="stylesheet" type="text/css" href="<?=Url::to('@web/css/cakim.css');?>">
<div class="activity-view">
<h3>Assesor : 
			            			<?php 
									
									
	$assessee_id_model = ProjectActivityMeta::find()
			            		->andWhere(['project_activity_id' => $_GET['id']])
			            		->andWhere(['type' => 'general'])
			            		->andWhere(['key' => 'assessor'])
 								->andWhere(['<>','value','2'])
			            		->One();
			            		$assessor_list = '';

			            		$userprofile = Profile::find()->andWhere(['user_id' => Yii::$app->user->id])->One();
			            		
			            		if (null !== $assessee_id_model) {
			            			$assessee_model = Profile::findOne($assessee_id_model->value);
			            		$fn = isset($assessee_model->first_name ) ? $assessee_model->first_name : '';
			            		$ln = isset($assessee_model->last_name) ? $assessee_model->last_name : '';
			            			$assessor_list = $fn .' ' . $ln;
			            			echo $assessor_list;
			            		} else {
			            			echo 	Html::a('== no assessor ==' , ['cakim/claim', 'id' => $_GET['id']], 
			            				[
        'class' => 'btn btn-warning',
        'data' => [
            'confirm' => Yii::t('app', 'PERHATIAN!! : Anda akan menambahkan diri '.$userprofile->first_name.' sebagai assessor'),
            'method' => 'post',
        ],
        ]);


			            		}
								
									
									
?>
</h3>
    <h1><span>
        <?php
        
        echo Html::img('@web/project-uploads/'.$proj_act->project_id.'/photos/'.$profile_id.'.jpg', ['alt' => '--missing image--','style'=> 'max-width:200px;max-height:200px'
            ]);
        ?>
    </span><?= Html::encode($this->title) ?></h1>


<?php
echo '<br/>';



/**
value dibawah ini hanya untuk dummy saat dev saja
*/


 $assessment_report = new AssessmentReport();


//echo //disinni model





    ?>


<?php


//echo $Pa->id;
$results = ProjectAssessmentResult::find()->andWhere(['project_assessment_id' => $Pa->id])->All();
$profile_metas = ProfileMeta::find()->andWhere(['profile_id' => $profile_id])->All();
$activity_metas = ProjectActivityMeta::find()->andWhere(['project_activity_id' => $_GET['id']])->All();

$prof = Profile::findOne($profile_id);

$result_object = [];
$result_object['psikogram_cakim']['analisa_sintesa'] = '1';
$result_object['psikogram_cakim']['kemampuan_umum'] = '1';
$result_object['psikogram_cakim']['proses_belajar'] = '1';
$result_object['psikogram_cakim']['penampilan_fisik'] = '1';
$result_object['psikogram_cakim']['fleksibilitas'] = '1';
$result_object['psikogram_cakim']['integritas_diri'] = '1';
$result_object['psikogram_cakim']['loyalitas'] = '1';
$result_object['psikogram_cakim']['pengendalian_diri'] = '1';
$result_object['psikogram_cakim']['self_confidence'] = '1';
$result_object['psikogram_cakim']['stabilitas_emosi'] = '1';
$result_object['psikogram_cakim']['teamwork'] = '1';
$result_object['psikogram_cakim']['inisiatif'] = '1';
$result_object['psikogram_cakim']['kkk'] = '1';
$result_object['psikogram_cakim']['motivasi_prestasi'] = '1';
$result_object['psikogram_cakim']['sistematika_kerja'] = '1';
$result_object['psikogram_cakim']['berfikir_konseptual'] = '1';

$profile_object['first_name'] = $prof->first_name;
$profile_object['last_name'] = $prof->last_name;
$profile_object['birthdate'] = $prof->birthdate;
$profile_object['gender'] = $prof->gender;
$activity_object = [];



foreach ($results as $key => $value) {
    $result_object[$value['type']][$value['key']] = !is_null($value['value']) ? $value['value'] :'1';
}

foreach ($profile_metas as $prof_key => $prof_value) {
        $profile_object[$prof_value['type']][$prof_value['key']] = $prof_value['value'];
}

foreach ($activity_metas as $act_key => $act_value) {
    $activity_object[$act_value['type']][$act_value['key']] = $act_value['value'];
}



/*
input field name

***PROFILE***
name -> first_name + last_name
tanggal_lahir           [birthdate]
gender                  [gender]
***PROFILE_META***
tempat_lahir            [personal][birthplace]


Pekerjaan               [work][current_job]
pendidikan_terakhir     [education][latest]
asal_perguruantinggi    [education][univ]


***PROJECT_ACTIVITY_META***
nomortest       [general][regno]
prospek_jabatan [general][job_prospect]
tempat_test     [schedule][place]
tanggal_test    [schedule][time]


*/

/*$reg_no = isset($f['work']['reg_no']) ? $profile_object['work']['reg_no'] : '';
$psikotes_no = isset($f['work']['psikotes_no']) ? $profile_object['work']['psikotes_no'] : '';
*/
$reg_no = isset($profile_object['work']['reg_no']) ? $profile_object['work']['reg_no'] : '';
$psikotes_no = isset($result_object['cakim']['nomor_psikotes']) ? $result_object['cakim']['nomor_psikotes'] : '';


$birthplace = isset($profile_object['personal']['birthplace']) ? $profile_object['personal']['birthplace'] : '';
$birthdate = $prof->birthdate;
$gender = $prof->gender;
$job_prospect = isset($profile_object['work']['prospect_position']) ? $profile_object['work']['prospect_position'] : '';
$latest_education = isset($profile_object['education']['latest']) ? $profile_object['education']['latest'] : '';
$univ = isset($profile_object['education']['univ']) ? $profile_object['education']['univ'] : '';
$schedule_place = isset($activity_object['schedule']['place']) ? $activity_object['schedule']['place'] : '';
$schedule_time = isset($activity_object['schedule']['scheduled']) ? $activity_object['schedule']['scheduled'] : '';
$current_job = isset($profile_object['work']['current_job']) ? $profile_object['work']['current_job'] : '';

?>

<script type="text/javascript" src="<?=Url::to('@web/js/jquery-1.7.1.js');?>"></script>			
<script type = 'text/javascript' >
function calcscore() {
	var score = 0;
	$(".calc:checked").each(function () {
		score += parseInt($(this).val(), 10);
	});
	$("input[name=sum]").val(score)
}
function calcscore2() {
  var score = 0;
	$(".calc2:checked").each(function () {
		score += parseInt($(this).val(), 10) * $("input[name=sum]").val() ;
	});
	$("input[name=sum2]").val(score) 
}

$().ready(function () {
	$(".calc").change(function () {
		calcscore()
	});
  $(".calc2").change(function () {
		calcscore2();
    if (this.value == '0' ) {
        $(".baik").css("background", '');
        $(".cukup").css("background", '');
        $(".kurang").css("background", '');
        $(".buruk").css("background", 'grey');
    }else if(this.value >= '77' ) {
      $(".baik").css("background", 'grey');
        $(".cukup").css("background", '');
        $(".kurang").css("background", '');
        $(".buruk").css("background", '');
    }

	});
});

$(document).ready(calculate); 



</script>






            <table border="0" cellpadding="0" cellspacing="0" class="MsoNormalTable" width="80%">
	<tr>
		<td colspan="3" nowrap style="border-top: solid windowtext 1.0pt;border-left: solid windowtext 1.0pt;;border-bottom: solid black 1.0pt;border-right:none;padding:3px;" >
			<p style="text-align:center">
				<b>HASIL PEMERIKSAAN PSIKOLOGIS</b>
			</p>
		</td>
		<td nowrap style="border-top: solid windowtext 1.0pt;; border-left:solid windowtext 1.0pt;border-bottom:solid black 1.0pt; border-right: solid windowtext 1.0pt;;padding:3px;" >
			<p style="text-align:center">
				<b>KETERANGAN</b>
			</p>
		</td>
	</tr>
	<tr>
		<td nowrap style="border:none;border-left: solid windowtext 1.0pt;; padding:3px;" >Nomor Psikotest</td>
		<td nowrap style="padding:3px; " >
			<p style="text-align:center">:</p>
		</td>
		<td nowrap style="padding:3px; "  >
			<?php echo Html::input('text', 'psikotes_no', $psikotes_no, ['class' => 'form-control', 'readonly' => true]);?></td>
		<td nowrap style="border-top:none;border-left:solid windowtext 1.0pt; border-bottom:none;border-right: solid windowtext 1.0pt;;padding:3px; " >
			<p>....</p>
		</td>
	</tr>
    <tr>
        <td nowrap style="border:none;border-left: solid windowtext 1.0pt;; padding:3px;" >Nomor Registrasi</td>
        <td nowrap style="padding:3px; " >
            <p style="text-align:center">:</p>
        </td>
        <td nowrap style="padding:3px; "  >
            <?php echo Html::input('text', 'reg_no', $reg_no, ['class' => 'form-control' , 'readonly' => true]);?></td>
        <td nowrap style="border-top:none;border-left:solid windowtext 1.0pt; border-bottom:none;border-right: solid windowtext 1.0pt;;padding:3px; " >
            <p>....</p>
        </td>
    </tr>
	<tr>
		<td nowrap style="border:none;border-left: solid windowtext 1.0pt;; padding:3px;" >Nama Lengkap		</td>
		<td nowrap style="padding:3px;" >
			<p style="text-align:center;">:</p>
		</td>
		<td nowrap style="padding:3px;"  >
			<?php echo Html::input('text', 'first_name' , $prof->first_name, ['class' => 'form-control']);?></td>
		<td nowrap style="border-top:none;border-left:solid windowtext 1.0pt; border-bottom:none;border-right: solid windowtext 1.0pt;;padding:3px; " >7: Very Above Average</td>
	</tr>
	<tr >
		<td nowrap style="border:none;border-left: solid windowtext 1.0pt;; padding:3px;">Tempat, Tgl lahir</td>
		<td nowrap style="padding:3px; " >
			<p style="text-align:center">:</p>
		</td>
		<td nowrap style="padding:3px; "  >
			<?php echo Html::input('text', 'birthplace', $birthplace, ['class' => 'form-control']);?>
			<?php echo DatePicker::widget([
    'name' => 'birthdate',
    'type' => DatePicker::TYPE_INPUT,
    'value' => $birthdate,
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd'
    ]
]);
?></td>
		<td nowrap style="border-top:none;border-left:solid windowtext 1.0pt; border-bottom:none;border-right: solid windowtext 1.0pt;;padding:3px; " >
			<p>6 : Above Average
			</p>
		</td>
	</tr>
	<tr >
		<td nowrap style="border:none;border-left: solid windowtext 1.0pt;; padding:3px;" >Pekerjaan Saat Ini</td>
		<td nowrap style="padding:3px; " >
			<p style="text-align:center">:</p>
		</td>
		<td nowrap style="padding:3px; "  >
			<?php echo Html::input('text', 'current_job', $current_job, ['class' => 'form-control']);?></td>
		<td nowrap style="border-top:none;border-left:solid windowtext 1.0pt; border-bottom:none;border-right: solid windowtext 1.0pt;;padding:3px; " >
			<p>5 : High Average <span/>
			</p>
		</td>
	</tr>
	<tr >
		<td nowrap style="border:none;border-left: solid windowtext 1.0pt;; padding:3px;">Jenis Kelamin</td>
		<td nowrap style="padding:3px; " >
			<p style="text-align:center">:</p>
		</td>
		<td nowrap style="padding:3px; "  >
			<?php echo Html::input('text', 'gender', $gender, ['class' => 'form-control']);?></td>
		<td nowrap style="border-top:none;border-left:solid windowtext 1.0pt; border-bottom:none;border-right: solid windowtext 1.0pt;;padding:3px; " >
			<p>4 : Average</p>
		</td>
	</tr>
	<tr >
		<td nowrap style="border:none;border-left: solid windowtext 1.0pt;; padding:3px;">Prospek Jabatan</td>
		<td nowrap style="padding:3px; " >
			<p style="text-align:center">:</p>
		</td>
		<td nowrap style="padding:3px; "  >
			<?php echo Html::input('text', 'job_prospect', $job_prospect, ['class' => 'form-control']);?></td>
		<td nowrap style="border-top:none;border-left:solid windowtext 1.0pt; border-bottom:none;border-right: solid windowtext 1.0pt;;padding:3px; " >
			<p>3 : Low Average</p>
		</td>
	</tr>
	<tr>
		<td nowrap style="border:none;border-left: solid windowtext 1.0pt;; padding:3px;" >Pendidikan Terakhir</td>
		<td nowrap style="padding:3px; " >
			<p style="text-align:center;">:</p>
		</td>
		<td nowrap style="padding:3px; "  >
			<?php echo Html::input('text', 'latest_education', $latest_education, ['class' => 'form-control']);?></td>
		<td nowrap style="border-top:none;border-left:solid windowtext 1.0pt; border-bottom:none;border-right: solid windowtext 1.0pt;;padding:3px; " >
			<p>2 : Below Average</p>
		</td>
	</tr>
	<tr>
		<td nowrap style="border:none;border-left: solid windowtext 1.0pt;; padding:3px;">Asal Perguruan Tinggi</td>
		<td nowrap style="padding:3px; " >
			<p style="text-align:center">:</p>
		</td>
		<td nowrap style="padding:3px; "  >
			<?php echo Html::input('text', 'univ', $univ, ['class' => 'form-control']);
?></td>
		<td nowrap style="border-top:none;border-left:solid windowtext 1.0pt; border-bottom:none;border-right: solid windowtext 1.0pt;;padding:3px; " >
			<p>1 : Very Below Average</p>
		</td>
	</tr>
	<tr style="mso-yfti-irow:10;mso-yfti-lastrow:yes;">
		<td nowrap style="border-top:none;border-left: solid windowtext 1.0pt;; border-bottom: solid windowtext 1.0pt;;border-right:none;padding:3px; ">Tempat / Tanggal Test</td>
		<td nowrap style="border:none;border-bottom: solid windowtext 1.0pt;; padding:3px;" >
			<p style="text-align:center">:</p>
		</td>
		<td nowrap style="border:none;border-bottom: solid windowtext 1.0pt;padding:3px;"  >
			<?php echo Html::input('text', 'schedule_place', $schedule_place, ['class' => 'form-control', 'readonly' => true]);?>
<?php echo Html::input('text', 'schedule_time', $schedule_time, ['class' => 'form-control', 'readonly' => true]);?>
		</td>
		<td nowrap style="border-top:none;border-left:solid windowtext 1.0pt; border-bottom: solid windowtext 1.0pt;;border-right: solid windowtext 1.0pt;; padding:3px;" >
			<p>....</p>
		</td>
	</tr>
</table>

<br/>
<div style="align:right">
<?php



        echo Html::a(Yii::t('app', 'Save Profile'), ['cakim/saveprofile', 'id' => $_GET['id']], [
        'class' => 'btn btn-warning',
        'data' => [
            'confirm' => Yii::t('app', 'Are you sure you want to save this report?'),
            'method' => 'post',
        ],
    ]);






/*

        echo Html::a(Yii::t('app', 'Temporary Save'), ['cakim/sosaved', 'id' => $_GET['id']], [
        'class' => 'btn btn-info',
        'data' => [
            'confirm' => Yii::t('app', 'Are you sure you want to finish review this item?'),
            'method' => 'post',
        ],
    ]);
        */
    

?>
</div>
<br/>
<br/>

<?php


$readonly = false;



        echo $this->render('/assessment/'.$proj_act->project_id.'/30', [
            //'searchModel' => $searchModel,
            //'dataProvider' => $dataProvider,
            'kompetensiDataProvider' => $kompetensiDataProvider,
            'kompetensiSQLDataProvider' => $kompetensiSQLDataProvider,
            'psikogramDataProvider' => $psikogramDataProvider,
            'psikogramSQLDataProvider' => $psikogramSQLDataProvider,
            'psikogramSearchModel' => $psikogramSearchModel,
            'kompetensigramSearchModel' => $kompetensigramSearchModel,
            'catalog_id' => $catalog_id,
            'assessment_report' => $assessment_report,
            'form' => $form,
            'readonly' => $readonly,
            'result_object' => $result_object,
            'profile_object' => $profile_object,
            'activity_object' => $activity_object,
        ]);

?>


<br/>

<form id="myForm" action="test">
      <table border="1" cellpadding="0" cellspacing="0" class="MsoTableGrid"
      style="border-right: solid windowtext 1.0pt;width:496.15pt;border-collapse:collapse; border:none; mso-padding-alt:0in 5.4pt 0in 5.4pt"
      width="662">
        <tr style="height:27.85pt">
          <td colspan="2"
          style="width:368.6pt;border-top:solid 1.0pt; border-left:solid 1.0pt;border-bottom:solid 1.0pt;border-right:solid 1.0pt; border-color:windowtext;mso-border-left-alt: solid 1.0pt; padding:5px;height:27.85pt"
          width="491">
            <p align="center" style="margin-left:0in;text-align: center;">
              <b>ASPEK - ASPEK</b>
            </p>
          </td>
          <td colspan="7" rowspan="2"
          style="width:127.55pt;border-top: solid windowtext 1.0pt;; border-left:none;border-bottom: solid windowtext 1.0pt;;border-right: solid windowtext 1.0pt;; padding:5px; height:27.85pt"
          width="170">
            <p align="center" style="margin-left:0in;text-align: center;">
              <b>
                <span style="mso-bidi-font-size: 12.0pt;">RATING</span>
              </b>
            </p>
          </td>
        </tr>
        <tr style="height:27.4pt">
          <td colspan="2"
          style="width:368.6pt;border-top:none;border-left: solid windowtext 1.0pt;border-bottom: solid windowtext 1.0pt;;border-right: solid windowtext 1.0pt;padding:5px; height:27.4pt"
          width="491">
            <p align="left" style="margin-left:0in;text-align:left;">
              <b>A. ASPEK KECERDASAN</b>
            </p>
          </td>
        </tr>
        <tr>
          <td rowspan="3" class="deskripsiCakim" width="38">
            <p align="center" style="text-align:center;">
              <span style="font-size:10.0pt;color:#0D0D0D;">1</span>
            </p>
          </td>
          <td rowspan="3" class="deskripsiCakim" width="454">
          <b>Kemampuan Umum</b>
          <br />Kemampuan dalam menangkap, mengolah, mencerna dan memahami informasi, kemudian memakai atau menggunakannya utuk
          memecahkan masalah sesuai dengan kebutuhan yang ada</td>
          <td class="rater">
            <b>1</b>
          </td>
          <td class="rater">
            <b>2</b>
          </td>
          <td class="rater">
            <b>3</b>
          </td>
          <td class="rater">
            <b>4</b>
          </td>
          <td class="rater">
            <b>5</b>
          </td>
          <td class="rater">
            <b>6</b>
          </td>
          <td class="rater">
            <b>7</b>
          </td>
        </tr>
        <tr>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRaterSelected" width="24" >&nbsp;</td>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
        </tr>
        <tr style="mso-yfti-irow:4;">
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="kemampuan_umum" value="1" 
            <?php echo ($result_object['psikogram_cakim']['kemampuan_umum'] == '1') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="kemampuan_umum" value="2" 
            <?php echo ($result_object['psikogram_cakim']['kemampuan_umum'] == '2') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="kemampuan_umum" value="3" 
            <?php echo ($result_object['psikogram_cakim']['kemampuan_umum'] == '3') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="kemampuan_umum" value="4" 
            <?php echo ($result_object['psikogram_cakim']['kemampuan_umum'] == '4') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="kemampuan_umum" value="5" 
            <?php echo ($result_object['psikogram_cakim']['kemampuan_umum'] == '5') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="kemampuan_umum" value="6" 
            <?php echo ($result_object['psikogram_cakim']['kemampuan_umum'] == '6') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="kemampuan_umum" value="7" 
            <?php echo ($result_object['psikogram_cakim']['kemampuan_umum'] == '7') ? 'checked="checked"' : '';?>
            />
          </td>
        </tr>
        <tr style="mso-yfti-irow:5;">
          <td rowspan="3" class="deskripsiCakim" width="38">
            <p align="center" style="text-align:center;">
              <span style="font-size:10.0pt;color:#0D0D0D;">2</span>
            </p>
          </td>
          <td rowspan="3" class="deskripsiCakim" width="454">
          <b>Kemampuan Berfikir Analisa Sintesa</b>
          <br />Kemampuan untuk meninjau permasalahan secara mendalam dengan menguraikan masalah secara lebih rinci dan menemukan
          hubungan sebab-akibat dari suatu situasi</td>
          <td class="rater" width="24">
            <b>1</b>
          </td>
          <td class="rater" width="24">
            <b>2</b>
          </td>
          <td class="rater" width="24">
            <b>3</b>
          </td>
          <td class="rater" width="24">
            <b>4</b>
          </td>
          <td class="rater" width="24">
            <b>5</b>
          </td>
          <td class="rater" width="24">
            <b>6</b>
          </td>
          <td class="rater" width="24">
            <b>7</b>
          </td>
        </tr>
        <tr>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRaterSelected" width="24" >&nbsp;</td>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24"></td>
        </tr>
        <tr>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="analisa_sintesa" value="1" 
            <?php echo ($result_object['psikogram_cakim']['analisa_sintesa'] == '1') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="analisa_sintesa" value="2" 
            <?php echo ($result_object['psikogram_cakim']['analisa_sintesa'] == '2') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="analisa_sintesa" value="3" 
            <?php echo ($result_object['psikogram_cakim']['analisa_sintesa'] == '3') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="analisa_sintesa" value="4" 
            <?php echo ($result_object['psikogram_cakim']['analisa_sintesa'] == '4') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="analisa_sintesa" value="5" 
            <?php echo ($result_object['psikogram_cakim']['analisa_sintesa'] == '5') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="analisa_sintesa" value="6" 
            <?php echo ($result_object['psikogram_cakim']['analisa_sintesa'] == '6') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="analisa_sintesa" value="7" 
            <?php echo ($result_object['psikogram_cakim']['analisa_sintesa'] == '7') ? 'checked="checked"' : '';?>
            />
          </td>
        </tr>
        <tr>
          <td rowspan="3" class="deskripsiCakim" width="38">
            <p align="center" style="text-align:center;">
              <span style="font-size:10.0pt;color:#0D0D0D;">3</span>
            </p>
          </td>
          <td rowspan="3" class="deskripsiCakim" width="454">
          <b>Kemampuan Berfikir Konseptual</b>
          <br />Kemampuan individu untuk melakukan pertimbangan yang logis dan mengorganisir data dalam suatu pemikiran yang
          berlandaskan pendekatan atau teori tertentu</td>
          <td class="rater" width="24">
            <b>1</b>
          </td>
          <td class="rater" width="24">
            <b>2</b>
          </td>
          <td class="rater" width="24">
            <b>3</b>
          </td>
          <td class="rater" width="24">
            <b>4</b>
          </td>
          <td class="rater" width="24">
            <b>5</b>
          </td>
          <td class="rater" width="24">
            <b>6</b>
          </td>
          <td class="rater" width="24">
            <b>7</b>
          </td>
        </tr>
        <tr>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRaterSelected" width="24" >&nbsp;</td>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
        </tr>
        <tr>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="berfikir_konseptual" value="1" 
            <?php echo ($result_object['psikogram_cakim']['berfikir_konseptual'] == '1') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="berfikir_konseptual" value="2"
            <?php echo ($result_object['psikogram_cakim']['berfikir_konseptual'] == '2') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="berfikir_konseptual" value="3"
            <?php echo ($result_object['psikogram_cakim']['berfikir_konseptual'] == '3') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="berfikir_konseptual" value="4"
            <?php echo ($result_object['psikogram_cakim']['berfikir_konseptual'] == '4') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="berfikir_konseptual" value="5" 
            <?php echo ($result_object['psikogram_cakim']['berfikir_konseptual'] == '5') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="berfikir_konseptual" value="6" 
            <?php echo ($result_object['psikogram_cakim']['berfikir_konseptual'] == '6') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="berfikir_konseptual" value="7" 
            <?php echo ($result_object['psikogram_cakim']['berfikir_konseptual'] == '7') ? 'checked="checked"' : '';?>
            />
          </td>
        </tr>
        <tr style="mso-yfti-irow:11;">
          <td rowspan="3" class="deskripsiCakim" width="38">
            <p align="center" style="text-align:center;">
              <span style="font-size:10.0pt;color:#0D0D0D;">4</span>
            </p>
          </td>
          <td rowspan="3" class="deskripsiCakim" width="454">
          <b>Kemampuan Dan Proses Belajar</b>
          <br />Kemampuan dan kelancaran individu untuk menguasai suatu perilaku dan atau bahan pelajaran serta hal hal yang
          baru</td>
          <td class="rater" width="24">
            <b>1</b>
          </td>
          <td class="rater" width="24">
            <b>2</b>
          </td>
          <td class="rater" width="24">
            <b>3</b>
          </td>
          <td class="rater" width="24">
            <b>4</b>
          </td>
          <td class="rater" width="24">
            <b>5</b>
          </td>
          <td class="rater" width="24">
            <b>6</b>
          </td>
          <td class="rater" width="24">
            <b>7</b>
          </td>
        </tr>
        <tr style="mso-yfti-irow:12;">
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRaterSelected" width="24" >&nbsp;</td>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
        </tr>
        <tr>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="proses_belajar" value="1"
            <?php echo ($result_object['psikogram_cakim']['proses_belajar'] == '1') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="proses_belajar" value="2" 
            <?php echo ($result_object['psikogram_cakim']['proses_belajar'] == '2') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="proses_belajar" value="3" 
            <?php echo ($result_object['psikogram_cakim']['proses_belajar'] == '3') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="proses_belajar" value="4" 
            <?php echo ($result_object['psikogram_cakim']['proses_belajar'] == '4') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="proses_belajar" value="5" 
            <?php echo ($result_object['psikogram_cakim']['proses_belajar'] == '5') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="proses_belajar" value="6" 
            <?php echo ($result_object['psikogram_cakim']['proses_belajar'] == '6') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="proses_belajar" value="7" 
            <?php echo ($result_object['psikogram_cakim']['proses_belajar'] == '7') ? 'checked="checked"' : '';?>
            />
          </td>
        </tr>
      </table>
      <br />
      <table>
        <tr style="mso-yfti-irow:14;height:23.7pt">
          <td colspan="2"
          style="width:368.6pt;border-top: solid windowtext 1.0pt;;border-left: solid windowtext 1.0pt;border-bottom: solid windowtext 1.0pt;;border-right: solid windowtext 1.0pt;padding: 0in 5.4pt 0in 5.4pt;height:23.7pt"
          width="491">
            <p align="left" style="margin-left:0in;text-align:left;">
              <b>B. ASPEK SIKAP DAN CARA KERJA</b>
            </p>
          </td>
          <td colspan="7"
          style="width:127.55pt;border-top: solid windowtext 1.0pt;;border-left: none;border-bottom: solid windowtext 1.0pt;;border-right: solid windowtext 1.0pt;; padding:5px;height:23.7pt"
          width="170">
            <p align="center" style="margin-left:0in;text-align: center;">
              <b>
                <span style="mso-bidi-font-size: 12.0pt;">RATING</span>
              </b>
            </p>
          </td>
        </tr>
        <tr style="mso-yfti-irow:15;height:14.95pt">
          <td rowspan="3" class="deskripsiCakim" width="38">
            <p align="center" style="text-align:center;">
              <span style="font-size:10.0pt; color:#0D0D0D">1</span>
            </p>
          </td>
          <td rowspan="3" class="deskripsiCakim" width="454">
          <b>Motivasi Berprestasi.</b>
          <br />Keinginan meningkatkan hasil kerja dan selalu Berfokus pada profit opportunities. Kemampuan individu untuk bekerja
          dengan baik atau usaha untuk mencapai standard yang luar biasa</td>
          <td class="rater" width="24">
            <b>1</b>
          </td>
          <td class="rater" width="24">
            <b>2</b>
          </td>
          <td class="rater" width="24">
            <b>3</b>
          </td>
          <td class="rater" width="24">
            <b>4</b>
          </td>
          <td class="rater" width="24">
            <b>5</b>
          </td>
          <td class="rater" width="24">
            <b>6</b>
          </td>
          <td class="rater" width="24">
            <b>7</b>
          </td>
        </tr>
        <tr>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRaterSelected" width="24" >&nbsp;</td>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
        </tr>
        <tr>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="motivasi_prestasi" value="1"
            <?php echo ($result_object['psikogram_cakim']['motivasi_prestasi'] == '1') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="motivasi_prestasi" value="2" 
            <?php echo ($result_object['psikogram_cakim']['motivasi_prestasi'] == '2') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="motivasi_prestasi" value="3" 
            <?php echo ($result_object['psikogram_cakim']['motivasi_prestasi'] == '3') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="motivasi_prestasi" value="4" 
            <?php echo ($result_object['psikogram_cakim']['motivasi_prestasi'] == '4') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="motivasi_prestasi" value="5" 
            <?php echo ($result_object['psikogram_cakim']['motivasi_prestasi'] == '5') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="motivasi_prestasi" value="6" 
            <?php echo ($result_object['psikogram_cakim']['motivasi_prestasi'] == '6') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="motivasi_prestasi" value="7" 
            <?php echo ($result_object['psikogram_cakim']['motivasi_prestasi'] == '7') ? 'checked="checked"' : '';?>
            />
          </td>
        </tr>
        <tr style="mso-yfti-irow:18;">
          <td rowspan="3" class="deskripsiCakim" width="38">
            <p align="center" style="text-align:center;">
              <span style="font-size:10.0pt; color:#0D0D0D">2</span>
            </p>
          </td>
          <td rowspan="3" class="deskripsiCakim" width="454">
          <b>Inisiatif</b>
          <br />Kemampuan bertindak melebihi dari tuntutan atau harapan suatu tugas dengan tujuan untuk meningkatkan hasil serta
          menghindari masalah dan menemukan atau menciptakan kesempatan-kesempatan baru</td>
          <td class="rater" width="24">
            <b>1</b>
          </td>
          <td class="rater" width="24">
            <b>2</b>
          </td>
          <td class="rater" width="24">
            <b>3</b>
          </td>
          <td class="rater" width="24">
            <b>4</b>
          </td>
          <td class="rater" width="24">
            <b>5</b>
          </td>
          <td class="rater" width="24">
            <b>6</b>
          </td>
          <td class="rater" width="24">
            <b>7</b>
          </td>
        </tr>
        <tr>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRaterSelected" width="24" >&nbsp;</td>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
        </tr>
        <tr style="mso-yfti-irow:20;">
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="inisiatif" value="1"
            <?php echo ($result_object['psikogram_cakim']['inisiatif'] == '1') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="inisiatif" value="2" 
            <?php echo ($result_object['psikogram_cakim']['inisiatif'] == '2') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="inisiatif" value="3" 
            <?php echo ($result_object['psikogram_cakim']['inisiatif'] == '3') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="inisiatif" value="4" 
            <?php echo ($result_object['psikogram_cakim']['inisiatif'] == '4') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="inisiatif" value="5" 
            <?php echo ($result_object['psikogram_cakim']['inisiatif'] == '5') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="inisiatif" value="6" 
            <?php echo ($result_object['psikogram_cakim']['inisiatif'] == '6') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="inisiatif" value="7" 
            <?php echo ($result_object['psikogram_cakim']['inisiatif'] == '7') ? 'checked="checked"' : '';?>
            />
          </td>
        </tr>
        <tr style="mso-yfti-irow:21;">
          <td rowspan="3" class="deskripsiCakim" width="38">
            <p align="center" style="text-align:center;">
              <span style="font-size:10.0pt; color:#0D0D0D">3</span>
            </p>
          </td>
          <td rowspan="3" class="deskripsiCakim" width="454">
          <b>Sistematika Kerja.</b>
          <br />Kemampuan dan ketrampilan menyelesaikan suatu tugas secara runtut, proporsional, sesuai dengan skala prioritas
          tertentu sehingga unjuk kerjanya efektif, efisien dengan hasil yang optimal</td>
          <td class="rater" width="24">
            <b>1</b>
          </td>
          <td class="rater" width="24">
            <b>2</b>
          </td>
          <td class="rater" width="24">
            <b>3</b>
          </td>
          <td class="rater" width="24">
            <b>4</b>
          </td>
          <td class="rater" width="24">
            <b>5</b>
          </td>
          <td class="rater" width="24">
            <b>6</b>
          </td>
          <td class="rater" width="24">
            <b>7</b>
          </td>
        </tr>
        <tr style="mso-yfti-irow:22;">
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRaterSelected" width="24" >&nbsp;</td>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
        </tr>
        <tr style="mso-yfti-irow:23;height:14.95pt">
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="sistematika_kerja" value="1" 
            <?php echo ($result_object['psikogram_cakim']['sistematika_kerja'] == '1') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="sistematika_kerja" value="2" 
            <?php echo ($result_object['psikogram_cakim']['sistematika_kerja'] == '2') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="sistematika_kerja" value="3" 
            <?php echo ($result_object['psikogram_cakim']['sistematika_kerja'] == '3') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="sistematika_kerja" value="4" 
            <?php echo ($result_object['psikogram_cakim']['sistematika_kerja'] == '4') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="sistematika_kerja" value="5" 
            <?php echo ($result_object['psikogram_cakim']['sistematika_kerja'] == '5') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="sistematika_kerja" value="6" 
            <?php echo ($result_object['psikogram_cakim']['sistematika_kerja'] == '6') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="sistematika_kerja" value="7" 
            <?php echo ($result_object['psikogram_cakim']['sistematika_kerja'] == '7') ? 'checked="checked"' : '';?>
            />
          </td>
        </tr>
        <tr style="mso-yfti-irow:24;">
          <td rowspan="3" class="deskripsiCakim" width="38">
            <p align="center" style="text-align:center;">
              <span style="font-size:10.0pt;color:#0D0D0D;">4</span>
            </p>
          </td>
          <td rowspan="3" class="deskripsiCakim" width="454">
          <b>Ketelitian, Keteraturan Dan Kualitas.</b>
          <br />Kemampuan menyelesaikan tugas sesuai dengan target yang telah ditentukan secara ukuran kualitas yang tertinggi</td>
          <td class="rater" width="24">1</td>
          <td class="rater" width="24">2</td>
          <td class="rater" width="24">3</td>
          <td class="rater" width="24">4</td>
          <td class="rater" width="24">5</td>
          <td class="rater" width="24">6</td>
          <td class="rater" width="24">7</td>
        </tr>
        <tr style="mso-yfti-irow:25;">
          <td class="bawahRater" width="24"></td>
          <td class="bawahRater" width="24"></td>
          <td class="bawahRater" width="24"></td>
          <td class="bawahRater" width="24"></td>
          <td class="bawahRaterSelected" width="24">&nbsp;</td>
          <td class="bawahRater" width="24"></td>
          <td class="bawahRater" width="24"></td>
        </tr>
        <tr style="mso-yfti-lastrow:yes;">
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="kkk" value="1"
            <?php echo ($result_object['psikogram_cakim']['kkk'] == '1') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="kkk" value="2" 
            <?php echo ($result_object['psikogram_cakim']['kkk'] == '2') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="kkk" value="3" 
            <?php echo ($result_object['psikogram_cakim']['kkk'] == '3') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="kkk" value="4" 
            <?php echo ($result_object['psikogram_cakim']['kkk'] == '4') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="kkk" value="5" 
            <?php echo ($result_object['psikogram_cakim']['kkk'] == '5') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="kkk" value="6" 
            <?php echo ($result_object['psikogram_cakim']['kkk'] == '6') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="kkk" value="7" 
            <?php echo ($result_object['psikogram_cakim']['kkk'] == '7') ? 'checked="checked"' : '';?>
            />
          </td>
        </tr>
      </table>
      <br />
      <table border="1" cellpadding="0" cellspacing="0" class="MsoTableGrid"
      style="width:496.15pt;border-collapse:collapse; border:none; mso-padding-alt:0in 5.4pt 0in 5.4pt" width="662">
        <tr style="height:27.85pt">
          <td colspan="2"
          style="width:368.6pt;border-top:solid 1.0pt; border-left:solid 1.0pt;border-bottom:solid 1.0pt;border-right:solid 1.0pt; border-color:windowtext;mso-border-left-alt: solid 1.0pt; padding:5px;height:27.85pt"
          width="491">
            <p align="left" style="margin-left:0in;text-align:left;">
              <b>C. ASPEK KEPRIBADIAN</b>
            </p>
          </td>
          <td colspan="7"
          style="width:127.55pt;border-top: solid windowtext 1.0pt;; border-left:none;border-bottom:solid windowtext 1.0pt;border-right: solid windowtext 1.0pt;; mso-border-right-alt: solid 1.0pt;padding:5px; height:27.85pt"
          width="170">
            <p align="center" style="margin-left:0in;text-align: center;">
              <b>
                <span style="mso-bidi-font-size: 12.0pt;">RATING</span>
              </b>
            </p>
          </td>
        </tr>
        <tr style="height:14.9pt">
          <td rowspan="3" class="deskripsiCakim" width="38">
            <p align="center" style="text-align:center;">
              <span style="font-size:11.0pt; color:#0D0D0D">1</span>
            </p>
          </td>
          <td rowspan="3" class="deskripsiCakim" width="454">
          <b>Integritas Diri</b>
          <br />Menunjukkan kematangan pribadi, kejujuran terhadap nilai-nilai universal, kesesuaian pikiran, perkataan dan
          perbuatan serta kemampuan memberikan pertimbangan yang optimal dalam situasi yang penuh konflik.</td>
          <td class="rater" width="24">1</td>
          <td class="rater" width="24">2</td>
          <td class="rater" width="24">3</td>
          <td class="rater" width="24">4</td>
          <td class="rater" width="24">5</td>
          <td class="rater" width="24">6</td>
          <td class="rater" width="24">7</td>
        </tr>
        <tr>
          <td class="bawahRater" width="24"></td>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRaterSelected" width="24" >&nbsp;</td>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
        </tr>
        <tr>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="integritas_diri" value="1"
            <?php echo ($result_object['psikogram_cakim']['integritas_diri'] == '1') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="integritas_diri" value="2" 
            <?php echo ($result_object['psikogram_cakim']['integritas_diri'] == '2') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="integritas_diri" value="3" 
            <?php echo ($result_object['psikogram_cakim']['integritas_diri'] == '3') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="integritas_diri" value="4" 
            <?php echo ($result_object['psikogram_cakim']['integritas_diri'] == '4') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="integritas_diri" value="5" 
            <?php echo ($result_object['psikogram_cakim']['integritas_diri'] == '5') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="integritas_diri" value="6" 
            <?php echo ($result_object['psikogram_cakim']['integritas_diri'] == '6') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="integritas_diri" value="7" 
            <?php echo ($result_object['psikogram_cakim']['integritas_diri'] == '7') ? 'checked="checked"' : '';?>
            />
          </td>
        </tr>
        <tr>
          <td rowspan="3" class="deskripsiCakim" width="38">
            <p align="center" style="text-align:center;">2</p>
          </td>
          <td rowspan="3" class="deskripsiCakim" width="454">
          <b>Loyalitas</b>
          <br />Kesetiaan dan kesediaan untuk memberikan dukungan yang terus menerus kepada organisasi dan profesi</td>
          <td class="rater">1</td>
          <td class="rater">2</td>
          <td class="rater">3</td>
          <td class="rater">4</td>
          <td class="rater">5</td>
          <td class="rater">6</td>
          <td class="rater">7</td>
        </tr>
        <tr>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRaterSelected" width="24" >&nbsp;</td>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
        </tr>
        <tr>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="loyalitas" value="1" 
            <?php echo ($result_object['psikogram_cakim']['loyalitas'] == '1') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="loyalitas" value="2" 
            <?php echo ($result_object['psikogram_cakim']['loyalitas'] == '2') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="loyalitas" value="3" 
            <?php echo ($result_object['psikogram_cakim']['loyalitas'] == '3') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="loyalitas" value="4" 
            <?php echo ($result_object['psikogram_cakim']['loyalitas'] == '4') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="loyalitas" value="5" 
            <?php echo ($result_object['psikogram_cakim']['loyalitas'] == '5') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="loyalitas" value="6" 
            <?php echo ($result_object['psikogram_cakim']['loyalitas'] == '6') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="loyalitas" value="7" 
            <?php echo ($result_object['psikogram_cakim']['loyalitas'] == '7') ? 'checked="checked"' : '';?>
            />
          </td>
        </tr>
        <tr>
          <td rowspan="3" class="deskripsiCakim" width="38">
            <p align="center" style="text-align:center;">3</p>
          </td>
          <td rowspan="3" class="deskripsiCakim" width="454">
          <b>Stabilitas Emosi</b>
          <br />Kematangan pribadi dan memiliki konsep diri yang positif serta Kemampuan untuk berespon secara optimal meskipun
          dalam situasi atau kondisi yang tidak menyenangkan.</td>
          <td class="rater">1</td>
          <td class="rater">2</td>
          <td class="rater">3</td>
          <td class="rater">4</td>
          <td class="rater">5</td>
          <td class="rater">6</td>
          <td class="rater">7</td>
        </tr>
        <tr>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRaterSelected" width="24" >&nbsp;</td>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
        </tr>
        <tr>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="stabilitas_emosi" value="1" 
            <?php echo ($result_object['psikogram_cakim']['stabilitas_emosi'] == '1') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="stabilitas_emosi" value="2" 
            <?php echo ($result_object['psikogram_cakim']['stabilitas_emosi'] == '2') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="stabilitas_emosi" value="3" 
            <?php echo ($result_object['psikogram_cakim']['stabilitas_emosi'] == '3') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="stabilitas_emosi" value="4"
            <?php echo ($result_object['psikogram_cakim']['stabilitas_emosi'] == '4') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="stabilitas_emosi" value="5" 
            <?php echo ($result_object['psikogram_cakim']['stabilitas_emosi'] == '5') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="stabilitas_emosi" value="6"
            <?php echo ($result_object['psikogram_cakim']['stabilitas_emosi'] == '6') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="stabilitas_emosi" value="7" 
            <?php echo ($result_object['psikogram_cakim']['stabilitas_emosi'] == '7') ? 'checked="checked"' : '';?>
            />
          </td>
        </tr>
        <tr>
          <td rowspan="3" class="deskripsiCakim" width="38">
            <p align="center" style="text-align:center;">4</p>
          </td>
          <td rowspan="3" class="deskripsiCakim" width="454">
          <b>Pengendalian Diri</b>
          <br />Kemampuan mengendalikan diri dan emosi dalam situasidan kondisi ”menekan” / ”stressfull” dengan tetap dapat
          menampilkan unjuk kerja dan unjuk diri yang efektif serta optimal</td>
          <td class="rater">1</td>
          <td class="rater">2</td>
          <td class="rater">3</td>
          <td class="rater">4</td>
          <td class="rater">5</td>
          <td class="rater">6</td>
          <td class="rater">7</td>
        </tr>
        <tr>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRaterSelected" width="24" >&nbsp;</td>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
        </tr>
        <tr>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="pengendalian_diri" value="1" 
            <?php echo ($result_object['psikogram_cakim']['pengendalian_diri'] == '1') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="pengendalian_diri" value="2" 
            <?php echo ($result_object['psikogram_cakim']['pengendalian_diri'] == '2') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="pengendalian_diri" value="3"
            <?php echo ($result_object['psikogram_cakim']['pengendalian_diri'] == '3') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="pengendalian_diri" value="4"
            <?php echo ($result_object['psikogram_cakim']['pengendalian_diri'] == '4') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="pengendalian_diri" value="5"
            <?php echo ($result_object['psikogram_cakim']['pengendalian_diri'] == '5') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="pengendalian_diri" value="6" 
            <?php echo ($result_object['psikogram_cakim']['pengendalian_diri'] == '6') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="pengendalian_diri" value="7" 
            <?php echo ($result_object['psikogram_cakim']['pengendalian_diri'] == '7') ? 'checked="checked"' : '';?>
            />
          </td>
        </tr>
        <tr>
          <td rowspan="3" class="deskripsiCakim" width="38">
            <p align="center" style="text-align:center;">5</p>
          </td>
          <td rowspan="3" class="deskripsiCakim" width="454">
          <b>Fleksibilitas / Penyesuaian Diri</b>
          <br />Mampu menyesuaikan diri dengan berbagai situasi dan berbagai tuntutan tugas, tanggung jawab atau orang-orang di
          sekitarnya</td>
          <td class="rater">1</td>
          <td class="rater">2</td>
          <td class="rater">3</td>
          <td class="rater">4</td>
          <td class="rater">5</td>
          <td class="rater">6</td>
          <td class="rater">7</td>
        </tr>
        <tr>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRaterSelected" width="24" >&nbsp;</td>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
        </tr>
        <tr>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="fleksibilitas" value="1" 
            <?php echo ($result_object['psikogram_cakim']['fleksibilitas'] == '1') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="fleksibilitas" value="2" 
            <?php echo ($result_object['psikogram_cakim']['fleksibilitas'] == '2') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="fleksibilitas" value="3" 
            <?php echo ($result_object['psikogram_cakim']['fleksibilitas'] == '3') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="fleksibilitas" value="4" 
            <?php echo ($result_object['psikogram_cakim']['fleksibilitas'] == '4') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="fleksibilitas" value="5" 
            <?php echo ($result_object['psikogram_cakim']['fleksibilitas'] == '5') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="fleksibilitas" value="6"
            <?php echo ($result_object['psikogram_cakim']['fleksibilitas'] == '6') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="fleksibilitas" value="7" 
            <?php echo ($result_object['psikogram_cakim']['fleksibilitas'] == '7') ? 'checked="checked"' : '';?>
            />
          </td>
        </tr>
        <tr>
          <td rowspan="3" class="deskripsiCakim" width="38">
            <p align="center" style="text-align:center;">6</p>
          </td>
          <td rowspan="3" class="deskripsiCakim" width="454">
          <b>Self Confidence / Kepercayaan Diri</b>
          <br />Kepercayaan individu terhadap dirinya untuk menyelesaikan tugas, mengatasi situasi menantang, mengambil keputusan
          atau menyampaikan pendapat dan mengatasi kegagalan secara konstruktif</td>
          <td class="rater">1</td>
          <td class="rater">2</td>
          <td class="rater">3</td>
          <td class="rater">4</td>
          <td class="rater">5</td>
          <td class="rater">6</td>
          <td class="rater">7</td>
        </tr>
        <tr>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRaterSelected" width="24" >&nbsp;</td>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
        </tr>
        <tr>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="self_confidence" value="1" 
            <?php echo ($result_object['psikogram_cakim']['self_confidence'] == '1') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="self_confidence" value="2" 
            <?php echo ($result_object['psikogram_cakim']['self_confidence'] == '2') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="self_confidence" value="3" 
            <?php echo ($result_object['psikogram_cakim']['self_confidence'] == '3') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="self_confidence" value="4" 
            <?php echo ($result_object['psikogram_cakim']['self_confidence'] == '4') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="self_confidence" value="5" 
            <?php echo ($result_object['psikogram_cakim']['self_confidence'] == '5') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="self_confidence" value="6" 
            <?php echo ($result_object['psikogram_cakim']['self_confidence'] == '6') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3" name="self_confidence" value="7" 
            <?php echo ($result_object['psikogram_cakim']['self_confidence'] == '7') ? 'checked="checked"' : '';?>
            />
          </td>
        </tr>
        <tr>
          <td rowspan="3" class="deskripsiCakim" width="38">
            <p align="center" style="text-align:center;">7</p>
          </td>
          <td rowspan="3" class="deskripsiCakim" width="454">
          <b>Teamwork</b>
          <br />Kemampuan bekerja secara efektif dalam kelompok dengan berbagi peran dan informasi untuk mencapai tujuuan atau
          target kerja kelompok</td>
          <td class="rater">1</td>
          <td class="rater">2</td>
          <td class="rater">3</td>
          <td class="rater">4</td>
          <td class="rater">5</td>
          <td class="rater">6</td>
          <td class="rater">7</td>
        </tr>
        <tr>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
          <td class="bawahRaterSelected" width="24" >&nbsp;</td>
          <td class="bawahRater" width="24" />
          <td class="bawahRater" width="24" />
        </tr>
        <tr>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3"name="teamwork" value="1" 
            <?php echo ($result_object['psikogram_cakim']['teamwork'] == '1') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3"name="teamwork" value="2" 
            <?php echo ($result_object['psikogram_cakim']['teamwork'] == '2') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3"name="teamwork" value="3" 
            <?php echo ($result_object['psikogram_cakim']['teamwork'] == '3') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3"name="teamwork" value="4"
            <?php echo ($result_object['psikogram_cakim']['teamwork'] == '4') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3"name="teamwork" value="5" 
            <?php echo ($result_object['psikogram_cakim']['teamwork'] == '5') ? 'checked="checked"' : '';?>
            />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3"name="teamwork" value="6"
            <?php echo ($result_object['psikogram_cakim']['teamwork'] == '6') ? 'checked="checked"' : '';?>
             />
          </td>
          <td class="radioRater" width="24">
            <input type="radio" class="calc" id="radio3"name="teamwork" value="7" 
            <?php echo ($result_object['psikogram_cakim']['teamwork'] == '7') ? 'checked="checked"' : '';?>
            />
          </td>
        </tr>
        <tr>
          <td colspan="2"
          style="width:368.6pt;border-top:none;border-left: solid windowtext 1.0pt;border-bottom: solid windowtext 1.0pt;;border-right: solid windowtext 1.0pt;padding: 0in 5.4pt 0in 5.4pt;height:29.15pt"
          width="491">
            <p align="right" style="text-align:right;">Total Skor</p>
          </td>
          <td colspan="8"
          style="width:127.55pt;border-top:none; border-left:none;border-bottom: solid windowtext 1.0pt;;border-right: solid windowtext 1.0pt;; padding:5px;height:29.15pt"
          width="170">
            <input type="text" name="sum" />
          </td>
        </tr>
      </table>
      <br />
      <table>
        <tr>
          <td colspan="2"
          style="width:368.6pt;border-top: solid windowtext 1.0pt;;border-left: solid windowtext 1.0pt;border-bottom: solid windowtext 1.0pt;;border-right: solid windowtext 1.0pt;padding: 0in 5.4pt 0in 5.4pt;height:29.15pt"
          width="491">
            <p align="left" style="margin-left:0in;text-align:left;">
              <b>D. ASPEK SELF APPEARANCE (KEPATUTAN DIRI)</b>
            </p>
          </td>
          <td colspan="8"
          style="width:127.55pt;border-top: solid windowtext 1.0pt;;border-left: none;border-bottom: solid windowtext 1.0pt;;border-right: solid windowtext 1.0pt;; padding:5px;height:29.15pt"
          width="170">
            <p align="center" style="margin-left:0in;text-align: center;">
              <b>RATING</b>
            </p>
          </td>
        </tr>
        <tr>
          <td rowspan="3" class="deskripsiCakim" width="38">
            <p align="center" style="text-align:center;">1</p>
          </td>
          <td rowspan="3" class="deskripsiCakim" width="454">
          <b>Penampilan Fisik secara Umum</b>
          <br />Memiliki berat dan tinggi badan yang seimbang / proporsional, tanpa adanya kecacatan fisik, serta dapat menunjukan
          perilaku optimal tanpa adanya gangguan gerakan lain.</td>
          <td colspan="4"
          style="width: 63.75pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #BFBFBF; padding: 0in 5.4pt 0in 5.4pt; height: 16.4pt"
          width="85">0</td>
          <td colspan="4"
          style="width: 63.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #BFBFBF; padding: 0in 5.4pt 0in 5.4pt; height: 16.4pt"
          width="85">1</td>
        </tr>
        <tr>
          <td colspan="4"
          style="width:63.75pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:5px;height:16.4pt"
          width="85" />
          <td colspan="4"
          style="width: 63.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; mso-border-top-alt: solid 1.0pt; mso-border-left-alt: solid .5pt; mso-border-right-alt: solid 1.0pt; background: #BFBFBF; padding: 0in 5.4pt 0in 5.4pt; height: 16.4pt"
          width="85" />
        </tr>
        <tr style="height:16.4pt">
          <td colspan="4"
          style="width:63.75pt;border-top:none; border-left:none;border-bottom: solid windowtext 1.0pt;;border-right:solid windowtext 1.0pt; mso-border-bottom-alt: solid 1.0pt; padding:5px;height:16.4pt"
          width="85">
            <center>
              <input type="radio" class="calc2" id="radio3" name="penampilan_fisik" value="0" 

                          <?php echo ($result_object['psikogram_cakim']['penampilan_fisik'] == '0') ? 'checked="checked"' : '';?>
            </center>
          </td>
          <td colspan="4"
          style="width:63.8pt;border-top:none; border-left:none;border-bottom: solid windowtext 1.0pt;;border-right: solid windowtext 1.0pt;; padding:5px;height:16.4pt"
          width="85">
            <center>
              <input type="radio" class="calc2" id="radio3" name="penampilan_fisik" value="1" 
                          <?php echo ($result_object['psikogram_cakim']['penampilan_fisik'] == '1') ? 'checked="checked"' : '';?>
               />
            </center>
          </td>
        </tr>

        <tr style="height:27.7pt">
          <td colspan="2"
          style="width:368.6pt;border-top:none;border-left: solid windowtext 1.0pt;border-bottom: solid windowtext 1.0pt;;border-right: solid windowtext 1.0pt;padding: 0in 5.4pt 0in 5.4pt;height:27.7pt"
          width="491">
            <p align="right" style="text-align:right;">Total Skor x Rating Self Appearance</p>
          </td>
          <td colspan="8"
          style="width:127.55pt;border-top:none;border-left: none;border-bottom: solid windowtext 1.0pt;;border-right: solid windowtext 1.0pt;; padding:5px;height:27.7pt"
          width="170"> <input type="text" name="sum2" /></td>
        </tr>
      </table>

<br/>
<table border="1" cellpadding="1" cellspacing="1" class="MsoTableGrid"
      style="border-right: solid windowtext 1.0pt;width:496.15pt;border-collapse:collapse; border:none; mso-padding-alt:0in 5.4pt 0in 5.4pt; padding:5px;"
      width="662">
<thead>
<tr>
<td style='font-size:12pt;padding:5px' colspan="6"><strong>KESIMPULAN  : </strong>Memperhatikan seluruh hasil penilaian Psikologis yang dimiliki, dikaitkan dengan kemungkinan keberhasilannya  untuk bekerja memikul beban tugas dan tanggung jawab kerja Sebagai Hakim, maka  pencalonannya :</td>
</tr>
</thead>
<tbody>
<tr bgcolor="#B8CCE4">
<th colspan="2" rowspan="1" scope="col">KUALITAS</th>
<th colspan="1" rowspan="1" scope="col">REKOMENDASI</th>
<th colspan="3" rowspan="1" scope="col">NORMA</th>
</tr>
<tr class="baik">
<td>K-1</td>
<td>Baik</td>
<td>Dapat Disarankan</td>
<td>77</td><td>-</td><td>ke atas</td>
</tr>
<tr class="cukup">
<td>K-2</td>
<td>Cukup</td>
<td>Masih Dapat Disarankan</td>
<td>68</td><td>-</td><td>76</td>
</tr>
<tr class="kurang">
<td>K-3</td>
<td>Kurang</td>
<td>Kurang Dapat Disarankan</td>
<td>59</td><td>-</td><td>67</td>
</tr>
<tr class="buruk">
<td>K-4</td>
<td>Buruk</td>
<td>Tidak Dapat Disarankan</td>
<td>58</td><td>-</td><td>ke bawah</td>
</tr>
</tbody>
</table>




    </form>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         </form>

<hr/>


        <?php


           // echo Html::a(Yii::t('app', 'Save data'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);


$status_ass = ProjectActivityMeta::find()->andWhere(['project_activity_id' => $model->id])->andWhere(['type' => 'assessment'])->andWhere(['key' => 'status'])->One();
                        if (null !== $is_so) {

						if (($status_ass->value != 'done'))
						{
							
							if (($status_ass->value != 'so_reviewed'))
							{
								
							
							
							
						            echo Html::a(Yii::t('app', 'Save'), ['cakim/save', 'id' => $model->id], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to save this report?'),
                'method' => 'post',
            ],
        ]);

            //echo Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-danger']);
            echo Html::a(Yii::t('app', 'Submit (Finalize)'), ['cakim/submit', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to submit this item?'),
                'method' => 'post',
            ],
        ]);
		
							}
						}
            echo Html::a(Yii::t('app', 'Reviewed'), ['cakim/soreviewed', 'id' => $model->id], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to finish SO this report?'),
                'method' => 'post',
            ],
        ]);


            echo Html::a(Yii::t('app', 'Reject'), ['cakim/sorejected', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to reject this report?'),
                'method' => 'post',
            ],
        ]);



            } else {
				
				
						if (($status_ass->value != 'done'))
						{
							
							if (($status_ass->value != 'so_reviewed'))
								{
							
							
            echo Html::a(Yii::t('app', 'Save'), ['cakim/save', 'id' => $model->id], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to save this report?'),
                'method' => 'post',
            ],
        ]);

            //echo Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-danger']);
            echo Html::a(Yii::t('app', 'Submit (Finalize)'), ['cakim/submit', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to submit this item?'),
                'method' => 'post',
            ],
        ]);
						}
					}
}
            
        





        ?>



    <p>
        <?php 
        //echo '<div style="display: inline-block;">'. Html::a(Yii::t('app', 'Print PDF'), ['print', 'id' => $model->id], ['class' => 'btn btn-info']).'</div>';
        echo '<div style="display: inline-block;">'. Html::a(Yii::t('app', 'Print'), ['cakimpdf', 'id' => $model->id], ['class' => 'btn btn-info']).'</div>';
        
        //echo ' <div style="display: inline-block;"><a href="https://api.phantomjscloud.com/api/browser/v2/ak-e6rha-y3pt8-t036y-443eq-52eyk/?requestBase64='.base64_encode('{url:"http://projects.ppsdm.com/index.php/projects/activity/pdf?id='.$model->id.'",renderType:"pdf"}').'" target="_blank">PDF</a></div>';

        echo '&nbsp;';
       
        
        

        //echo '<div style="display: inline-block;">'.Html::a(Yii::t('app', 'Blanko PDF'), ['print', 'id' => $model->id], ['class' => 'btn btn-info']).'</div>';

        ?>
    </p>

    <?php ActiveForm::end(); 



//echo '<pre>';
//print_r($profile_object);
//print_r($result_object);
//print_r($activity_object);
    
    
    ?>


