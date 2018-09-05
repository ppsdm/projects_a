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
use app\assets\Project4Asset;
use app\assets\InsertatcaretAsset;
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
use kartik\grid\GridView;
use machour\yii2\notifications\widgets\NotificationsWidget;
use common\modules\core\models\Notification;
use kartik\editable\Editable;
use yii2tech\html2pdf\Manager;

/* @var $this yii\web\View */
/* @var $model app\modules\projects\models\Activity */

$this->title = $model->name;

AppAsset::register($this);

    //InsertatcaretAsset::register($this);
     //Project4Asset::register($this);
$uraian = [];


$total_psikogram = 0;
$total_lki = 0;
$total_lkj = 0;
$total_gap = 0;

$gaps=[];

$status_list = ['done', 'under_review', 'so_reviewed', 'so_returned', 'so_finished'];





foreach ($data['psikogram']['lki'] as $psikogram_lki_key => $psikogram_lki_value) {
    $total_psikogram = $total_psikogram + $psikogram_lki_value;
}

foreach ($data['kompetensigram']['lki'] as $kompetensigram_lki_key => $kompetensigram_lki_value) {
    $total_lki = $total_lki + $kompetensigram_lki_value;
    $evidences = RefAssessmentDictionary::find()->andWhere(['type' => 'kompetensigram_setneg'])->andWhere(['key' =>$kompetensigram_lki_key . $kompetensigram_lki_value])->All();
    $uraian[$kompetensigram_lki_key . $kompetensigram_lki_value][0] = 'tidak ada kompetensi';
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
<?php 
echo '<div style="display: inline-block;">'. Html::a(Yii::t('app', 'Print'), ['print', 'id' => $model->id], ['class' => 'btn btn-info', 'target'=>'_blank']).'</div>';
?>

<link rel="stylesheet" type="text/css" href="<?=Url::to('@web/css/psikogramTable.css');?>">
  <script src="<?=Url::to('@web/js/d3.min.js');?>" charset="utf-8"></script>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart'], 'language': 'id'});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Potensi', 'Kompetensi'],
          [ <?php echo round($PArp/62*100); ?>,     <?php echo round($PArk/$sumC*100); ?>], //ini harus diisi

        ]);

        var options = {
          title: 'Gambaran Posisi 9-Cell (Kompetensi dan Potensi)',
          hAxis: {
              //title: 'Potensi', minValue: 0, maxValue: 100,
              gridlines:{color: '#eee', count: 7},
              ticks: [0, 20, 40, 60, 80, 100, 120, 140, ]
              },
          vAxis: {
             // title: 'Kompetensi', minValue: 0, maxValue: 100, 
             gridlines:{color: '#eee', count: 7},
             ticks: [0, 20, 40, 60, 80, 100, 120, 140, ]
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
<?php
/*
echo '<pre>';
print_r($uraian);
echo '</pre>';
*/

//echo '<div style="display: inline-block;">'. Html::a(Yii::t('app', 'Print'), ['pdf', 'id' => $model->id], ['class' => 'btn btn-info']).'</div>';
//echo '&nbsp;';
//echo '<div style="display: inline-block;">'. Html::a(Yii::t('app', 'Download PDF'), ['getfile', 'id' => $model->id], ['class' => 'btn btn-info']).'</div>';

    $proj_act = ProjectActivity::findOne($_GET['id']);


$user_profile = Profile::find()->andWhere(['user_id' => Yii::$app->user->id])->One();

$is_so = ProjectActivityMeta::find()
->andWhere(['project_activity_id' => $_GET['id']])
->andWhere(['type' => 'general'])
->andWhere(['key' => 'second_opinion'])
->andWhere(['value'=> $user_profile->id])
->One();

if (null !== $is_so)
{
    //echo 'GUS SO';
} else {
    //echo 'GUS ' . $user_profile->id;
}

$is_assessor = ProjectActivityMeta::find()
->andWhere(['project_activity_id' => $_GET['id']])
->andWhere(['type' => 'general'])
->andWhere(['key' => 'assessor'])
->andWhere(['value'=> $user_profile->id])
->One();


$options = [1 => '1',2 => '2',3=>'3',4=>'4',5=>'5',6=>'6',7 => '7'];

   $form = ActiveForm::begin([
        'id' => 'assessment-form',
        //'enableAjaxValidation' => true
        ]);
//Notification::notify(Notification::KEY_NEW_MESSAGE, '2', '99');



$statusproject = ProjectActivityMeta::find()
->andWhere(['project_activity_id' => $_GET['id']])
->andWhere(['type' => 'assessment'])
->andWhere(['key' => 'status'])
->One();

                    $assessee_model = ProjectActivityMeta::find()
                    ->andWhere(['project_activity_id' => $_GET['id']])
                    ->andWhere(['type' => 'general'])
                    ->andWhere(['key' => 'assessee'])->One();
                    if (null !== $assessee_model) {
                    $assessee_profile_model = Profile::findOne($assessee_model->value);
                    $profile_id = $assessee_profile_model->id;
    $rumpunjabatan = ProfileMeta::find()
    ->andWhere(['profile_id' => $profile_id])
    ->andWhere(['key' => 'rumpun_skj'])
    ->andWhere(['type' => 'work'])->One();

    $leveljabatan = ProfileMeta::find()
    ->andWhere(['profile_id' => $profile_id])
    ->andWhere(['key' => 'level'])
    ->andWhere(['type' => 'work'])->One();

        $rumpun = ProfileMeta::find()
    ->andWhere(['profile_id' => $profile_id])
    ->andWhere(['key' => 'rumpun'])
    ->andWhere(['type' => 'work'])->One();

/*
    $find_catalog = RefValue::find()->andWhere(['type' => 'catalog-mapping'])->andWhere(['key' => 'catalog_id'])
->andWhere(['attribute_1' => $rumpun->value])
->andWhere(['attribute_2' => $leveljabatan->value])
->One();
*/
    $find_catalog = Catalog::find()->andWhere(['type' => 'setneg'])->andWhere(['name' => $rumpun->value])
->One();


if (null !== $find_catalog) {
    $catalog_id = $find_catalog->id;
} else {
    $catalog_id = null;
}

$Pa = ProjectAssessment::find()->andWhere(['activity_id'=> $_GET['id']])->One();

//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title .'(cat='.$catalog_id . ', assessment='. $Pa->id. ')';


                } else {
                        $profile_id = 'NO-ID';
                }



$readonly = false;
$status_list = ['done', 'under_review', 'so_reviewed', 'so_returned', 'so_finished'];

if ((null !== $is_assessor) && (!in_array($statusproject->value, $status_list))) {
    $readonly = false;
}
if ((null !== $is_so) ) {
    $readonly = false;
    }


?>
<div class="activity-view">

    <h1><span>
        <?php
        
        echo Html::img('@web/project-uploads/'.$proj_act->project_id.'/photos/'.$profile_id.'.jpg', ['alt' => '--missing image--','style'=> 'max-width:200px;max-height:200px'
            ]);
        ?>
    </span><?= Html::encode($this->title) ?></h1>


<?php




/**
value dibawah ini hanya untuk dummy saat dev saja
*/




echo DetailView::widget([
        'model' => $model,
   //     'mode'=>DetailView::MODE_EDIT,
        'attributes' => [
            [
                'label' => 'Nomor Test',
                'value' => function($data)
                {
                        $assessment_model = ProjectAssessment::find()->andWhere(['activity_id' => $data->id])
                        ->andWhere(['status' => 'active'])
                        ->All();
                        if (sizeof($assessment_model) == 1) {
                            $nomor_test = ProjectAssessmentResult::find()->andWhere(['key' => 'nomor_test'])
                            ->andWhere(['project_assessment_id' => $assessment_model[0]->id])->All();
                            if(sizeof($nomor_test) == 1)
                            {
                                return $nomor_test[0]->value;
                            } else {
                                return 'WARNING: invalid jumlah nomor_test => ' . sizeof($nomor_test);
                            }
                        } else {
                            return 'multiple assessment/activity';
                        }
               
                },
            ],


            [
                'label' => 'Nama Lengkap',
                'format' => 'raw',
                'value' => function($data) use ($form, $readonly){
                    $activity_assessee_model = ProjectActivityMeta::find()
                    ->andWhere(['project_activity_id' => $data->id])
                    ->andWhere(['type' => 'general'])
                    ->andWhere(['key' => 'assessee'])->One();
                    if (null !== $activity_assessee_model) {
                    $assessee_model = Profile::findOne($activity_assessee_model->value);
                    if ($readonly) {
                        $fn = isset($assessee_model->first_name)?$assessee_model->first_name  : '';
                        $ln = isset($assessee_model->last_name) ? $assessee_model->last_name : '';
                    return  $fn . ' ' . $ln;
                    } else {
return $form->field($assessee_model, 'first_name')->textInput(['readonly'=> $readonly])->label('');
                        
                }
                    } else {
                        return 'no profile set for this assessee';
                    }
                }
            ],
            [
                'label' => 'Gender',
                'format' => 'raw',
                'value' => function($data) use ($form, $readonly){


                    $activity_assessee_model = ProjectActivityMeta::find()
                    ->andWhere(['project_activity_id' => $data->id])
                    ->andWhere(['type' => 'general'])
                    ->andWhere(['key' => 'assessee'])->One();

                    if (null !== $activity_assessee_model) {
                    $assessee_model = Profile::findOne($activity_assessee_model->value);


                        return $form->field($assessee_model, 'gender')->textInput(['readonly'=> $readonly])
                        ->label('');
                        //return '';
                    }
                }
            ],


            [
                'label' => 'Tanggal Lahir (Wajib diisi)',
                'format' => 'raw',
                'value' => function($data) use ($form, $readonly){


                    $activity_assessee_model = ProjectActivityMeta::find()
                    ->andWhere(['project_activity_id' => $data->id])
                    ->andWhere(['type' => 'general'])
                    ->andWhere(['key' => 'assessee'])->One();

                    if (null !== $activity_assessee_model) {
                    $assessee_model = Profile::findOne($activity_assessee_model->value);

                                 $fmt = Yii::$app->formatter;
                    $birthdate = $fmt->asDate($assessee_model->birthdate, 'dd MMMM yyyy');

                        return $form->field($assessee_model, 'birthdate')->textInput(['readonly'=> $readonly])->hint('Tahun-Bulan-Hari. Contoh: 1985-04-21')->label('');
                        //return '';
                    }
                }
            ],


            [
                'label' => 'Tempat lahir (Wajib diisi)',
                 'format' => 'raw',
                'value' => function($data) use ($form, $readonly, $biodata){
                    $fmt = Yii::$app->formatter;
                    $activity_assessee_model = ProjectActivityMeta::find()
                    ->andWhere(['project_activity_id' => $data->id])
                    ->andWhere(['type' => 'general'])
                    ->andWhere(['key' => 'assessee'])->One();
                    if (null !== $activity_assessee_model) {
                    $assessee_model = Profile::findOne($activity_assessee_model->value);

             

                    $latest = ProfileMeta::find()
                    ->andWhere(['profile_id' => $activity_assessee_model->value])
                    ->andWhere(['type' => 'personal'])
                    ->andWhere(['key' => 'birthplace'])->One();


                    if (null !== $latest){
                        $biodata->birthplace = $latest->value;
                    } else {

                    }
                    return $form->field($biodata, 'birthplace')->textInput(['readonly'=> $readonly])->label('');
                    } else {
                        return 'no profile set for this assessee';
                    }
                }
            ],
            
            [
                'label' => 'NIP',
                'format' => 'raw',
                'value' => function($data) use ($form, $readonly, $biodata){
                    $fmt = Yii::$app->formatter;
                    $activity_assessee_model = ProjectActivityMeta::find()
                    ->andWhere(['project_activity_id' => $data->id])
                    ->andWhere(['type' => 'general'])
                    ->andWhere(['key' => 'assessee'])->One();
                    if (null !== $activity_assessee_model) {
                    $assessee_model = Profile::findOne($activity_assessee_model->value);
                    $latest = ProfileMeta::find()
                    ->andWhere(['profile_id' => $activity_assessee_model->value])
                    ->andWhere(['type' => 'work'])
                    ->andWhere(['key' => 'nip'])->One();
                    //$birthdate = $fmt->asDate($assessee_model->birthdate, 'dd MMMM yyyy');

                    if (null !== $latest){
                        $biodata->nip = $latest->value;
                    } else {

                    }
                    return $form->field($biodata, 'nip')->textInput(['readonly'=> $readonly])->label('');
                    } else {
                        return 'no profile set for this assessee';
                    }
                }
            ],    
            [
                'label' => 'Jabatan saat ini',
                'format' => 'raw',
                'value' => function($data) use ($form, $readonly, $biodata){
                    $fmt = Yii::$app->formatter;
                    $activity_assessee_model = ProjectActivityMeta::find()
                    ->andWhere(['project_activity_id' => $data->id])
                    ->andWhere(['type' => 'general'])
                    ->andWhere(['key' => 'assessee'])->One();
                    if (null !== $activity_assessee_model) {
                    $assessee_model = Profile::findOne($activity_assessee_model->value);
                    $latest = ProfileMeta::find()
                    ->andWhere(['profile_id' => $activity_assessee_model->value])
                    ->andWhere(['type' => 'work'])
                    ->andWhere(['key' => 'current_position'])->One();
                    //$birthdate = $fmt->asDate($assessee_model->birthdate, 'dd MMMM yyyy');

                    if (null !== $latest){
                        $biodata->current_position = $latest->value;
                    } else {

                    }
                    return $form->field($biodata, 'current_position')->textInput(['readonly'=> $readonly])->label('');
                    } else {
                        return 'no profile set for this assessee';
                    }
                }
            ],

            [
                'label' => 'Rumpun',
                'format' => 'raw',
                'value' => function($data) use ($form, $readonly, $assessment_report, $biodata){
                    $fmt = Yii::$app->formatter;
                    $activity_assessee_model = ProjectActivityMeta::find()
                    ->andWhere(['project_activity_id' => $data->id])
                    ->andWhere(['type' => 'general'])
                    ->andWhere(['key' => 'assessee'])->One();
                    if (null !== $activity_assessee_model) {
                    $assessee_model = Profile::findOne($activity_assessee_model->value);
                    $latest = ProfileMeta::find()
                    ->andWhere(['profile_id' => $activity_assessee_model->value])
                    ->andWhere(['type' => 'work'])
                    ->andWhere(['key' => 'rumpun'])->One();
                    //$birthdate = $fmt->asDate($assessee_model->birthdate, 'dd MMMM yyyy');

                    if (null !== $latest){
                        $biodata->rumpun = $latest->value;
                    } else {

                    }
                    return $form->field($biodata, 'rumpun')->textInput(['readonly'=> true])->label('');
                    } else {
                        return 'no profile set for this assessee';
                    }
                }
            ],
            [
                'label' => 'Golongan',
                'format' => 'raw',
                'value' => function($data) use ($form, $readonly, $biodata){
                    $fmt = Yii::$app->formatter;
                    $activity_assessee_model = ProjectActivityMeta::find()
                    ->andWhere(['project_activity_id' => $data->id])
                    ->andWhere(['type' => 'general'])
                    ->andWhere(['key' => 'assessee'])->One();
                    if (null !== $activity_assessee_model) {
                    $assessee_model = Profile::findOne($activity_assessee_model->value);
                    $latest = ProfileMeta::find()
                    ->andWhere(['profile_id' => $activity_assessee_model->value])
                    ->andWhere(['type' => 'work'])
                    ->andWhere(['key' => 'golongan'])->One();
                    //$birthdate = $fmt->asDate($assessee_model->birthdate, 'dd MMMM yyyy');

                    if (null !== $latest){
                        $biodata->golongan = $latest->value;
                    } else {

                    }
                    return $form->field($biodata, 'golongan')->textInput(['readonly'=> $readonly])->label('');
                    } else {
                        return 'no profile set for this assessee';
                    }
                }
            ],          

            [
                'label' => 'Level',
                'format' => 'raw',
                'value' => function($data) use ($form, $readonly, $biodata){
                    $fmt = Yii::$app->formatter;
                    $activity_assessee_model = ProjectActivityMeta::find()
                    ->andWhere(['project_activity_id' => $data->id])
                    ->andWhere(['type' => 'general'])
                    ->andWhere(['key' => 'assessee'])->One();
                    if (null !== $activity_assessee_model) {
                    $assessee_model = Profile::findOne($activity_assessee_model->value);
                    $latest = ProfileMeta::find()
                    ->andWhere(['profile_id' => $activity_assessee_model->value])
                    ->andWhere(['type' => 'work'])
                    ->andWhere(['key' => 'level'])->One();
                    //$birthdate = $fmt->asDate($assessee_model->birthdate, 'dd MMMM yyyy');

                    if (null !== $latest){
                        $biodata->level = $latest->value;
                    } else {

                    }
                    return $form->field($biodata, 'level')->textInput(['readonly'=> $readonly])->label('');
                    } else {
                        return 'no profile set for this assessee';
                    }
                }
            ],
            [
                'label' => 'Pendidikan Terakhir',
                'format' => 'raw',
                'value' => function($data) use ($form, $readonly, $biodata){
                    $fmt = Yii::$app->formatter;
                    $activity_assessee_model = ProjectActivityMeta::find()
                    ->andWhere(['project_activity_id' => $data->id])
                    ->andWhere(['type' => 'general'])
                    ->andWhere(['key' => 'assessee'])->One();
                    if (null !== $activity_assessee_model) {
                    $assessee_model = Profile::findOne($activity_assessee_model->value);

             

                    $latest = ProfileMeta::find()
                    ->andWhere(['profile_id' => $activity_assessee_model->value])
                    ->andWhere(['type' => 'education'])
                    ->andWhere(['key' => 'latest_education'])->One();
                    //$birthdate = $fmt->asDate($assessee_model->birthdate, 'dd MMMM yyyy');

                    if (null !== $latest){
                        $biodata->latest_education = $latest->value;
                    } else {

                    }
                    return $form->field($biodata, 'latest_education')->textInput(['readonly'=> $readonly])->label('');
                    } else {
                        return 'no profile set for this assessee';
                    }
                }
            ],

            [
                'label' => 'Alamat',
                'format' => 'raw',
                'value' => function($data) use ($form, $readonly, $biodata){
                    $activity_assessee_model = ProjectActivityMeta::find()
                    ->andWhere(['project_activity_id' => $data->id])
                    ->andWhere(['type' => 'general'])
                    ->andWhere(['key' => 'assessee'])->One();
                    if (null !== $activity_assessee_model) {
                    $assessee_model = Profile::findOne($activity_assessee_model->value);

                    $address = ProfileMeta::find()
                    ->andWhere(['profile_id' => $activity_assessee_model->value])
                    ->andWhere(['type' => 'contact'])
                    ->andWhere(['key' => 'home_address'])->One();

                    if (null !== $address){
                        $biodata->home_address = $address->value;
                    } else {

                    }
                    return $form->field($biodata, 'home_address')->textInput(['readonly'=> $readonly])->label('');
                    } else {
                        return 'no profile set for this assessee';
                    }


                }
            ],
            
                    [
                'label' => 'Tujuan Pemeriksaan',
                'value' => 'setneg'
            ],

                    [
                'label' => 'Tempat / Tanggal Test',
                'value' => 'setneg'
            ],


        ],
    ]);




    ?>

</div>


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
	   <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[inteligensi_umum]" value="1" 
            <?php echo ($data['psikogram']['lki']['inteligensi_umum'] == '1') ? 'checked="checked"' : '';?></td>
	   <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[inteligensi_umum]" value="2" 
            <?php echo ($data['psikogram']['lki']['inteligensi_umum'] == '2') ? 'checked="checked"' : '';?></td>
	   <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[inteligensi_umum]" value="3" 
            <?php echo ($data['psikogram']['lki']['inteligensi_umum'] == '3') ? 'checked="checked"' : '';?></td>
	   <td class="psikogramtable13"><input type="radio" class="calc" id="radio3" name="psikogram[inteligensi_umum]" value="4" 
            <?php echo ($data['psikogram']['lki']['inteligensi_umum'] == '4') ? 'checked="checked"' : '';?></td>
	   <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[inteligensi_umum]" value="5" 
            <?php echo ($data['psikogram']['lki']['inteligensi_umum'] == '5') ? 'checked="checked"' : '';?></td>
	   <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[inteligensi_umum]" value="6" 
            <?php echo ($data['psikogram']['lki']['inteligensi_umum'] == '6') ? 'checked="checked"' : '';?></td>
	   <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[inteligensi_umum]" value="7" 
            <?php echo ($data['psikogram']['lki']['inteligensi_umum'] == '7') ? 'checked="checked"' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9" >
	   2</td>
	   <td class="psikogramtable10" colspan="3">Berpikir Analitis</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kemampuan menguraikan masalah  &  melihat kaitan antara satu hal dg hal lainnya hingga menemukan kesimpulan</td>
	   <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[berpikir_analitis]" value="1" 
       <?php echo ($data['psikogram']['lki']['berpikir_analitis'] == '1') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[berpikir_analitis]" value="2" 
       <?php echo ($data['psikogram']['lki']['berpikir_analitis'] == '2') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[berpikir_analitis]" value="3" 
       <?php echo ($data['psikogram']['lki']['berpikir_analitis'] == '3') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[berpikir_analitis]" value="4" 
       <?php echo ($data['psikogram']['lki']['berpikir_analitis'] == '4') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable13"><input type="radio" class="calc" id="radio3" name="psikogram[berpikir_analitis]" value="5" 
       <?php echo ($data['psikogram']['lki']['berpikir_analitis'] == '5') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[berpikir_analitis]" value="6" 
       <?php echo ($data['psikogram']['lki']['berpikir_analitis'] == '6') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[berpikir_analitis]" value="7" 
       <?php echo ($data['psikogram']['lki']['berpikir_analitis'] == '7') ? 'checked="checked"' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9" >
	   3</td>
	   <td class="psikogramtable10" colspan="3">Logika Berpikir</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kemampuan untuk mengorganisir proses berpikir yang menunjukkan adanya alur berpikir yang sistematis dan logis</td>
	   <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[logika_berfikir]" value="1" 
       <?php echo ($data['psikogram']['lki']['logika_berfikir'] == '1') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[logika_berfikir]" value="2" 
       <?php echo ($data['psikogram']['lki']['logika_berfikir'] == '2') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[logika_berfikir]" value="3" 
       <?php echo ($data['psikogram']['lki']['logika_berfikir'] == '3') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[logika_berfikir]" value="4" 
       <?php echo ($data['psikogram']['lki']['logika_berfikir'] == '4') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable13"><input type="radio" class="calc" id="radio3" name="psikogram[logika_berfikir]" value="5" 
       <?php echo ($data['psikogram']['lki']['logika_berfikir'] == '5') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[logika_berfikir]" value="6" 
       <?php echo ($data['psikogram']['lki']['logika_berfikir'] == '6') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[logika_berfikir]" value="7" 
       <?php echo ($data['psikogram']['lki']['logika_berfikir'] == '7') ? 'checked="checked"' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9" >
	   4</td>
	   <td class="psikogramtable10" colspan="3">Kemampuan Belajar</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kemampuan menguasai dan meningkatkan pengetahuan dan ketrampilan kerja yang baru maupun yang telah dimiliki</td>
	   <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[kemampuan_belajar]" value="1" 
       <?php echo ($data['psikogram']['lki']['kemampuan_belajar'] == '1') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[kemampuan_belajar]" value="2" 
       <?php echo ($data['psikogram']['lki']['kemampuan_belajar'] == '2') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[kemampuan_belajar]" value="3" 
       <?php echo ($data['psikogram']['lki']['kemampuan_belajar'] == '3') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable13"><input type="radio" class="calc" id="radio3" name="psikogram[kemampuan_belajar]" value="4" 
       <?php echo ($data['psikogram']['lki']['kemampuan_belajar'] == '4') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[kemampuan_belajar]" value="5" 
       <?php echo ($data['psikogram']['lki']['kemampuan_belajar'] == '5') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[kemampuan_belajar]" value="6" 
       <?php echo ($data['psikogram']['lki']['kemampuan_belajar'] == '6') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[kemampuan_belajar]" value="7" 
       <?php echo ($data['psikogram']['lki']['kemampuan_belajar'] == '7') ? 'checked="checked"' : '';?></td>
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
       <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[sistematika_kerja]" value="1" 
            <?php echo ($data['psikogram']['lki']['sistematika_kerja'] == '1') ? 'checked="checked"' : '';?></td>       
       <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[sistematika_kerja]" value="2" 
            <?php echo ($data['psikogram']['lki']['sistematika_kerja'] == '2') ? 'checked="checked"' : '';?></td>
       <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[sistematika_kerja]" value="3" 
            <?php echo ($data['psikogram']['lki']['sistematika_kerja'] == '3') ? 'checked="checked"' : '';?></td>
       <td class="psikogramtable13"><input type="radio" class="calc" id="radio3" name="psikogram[sistematika_kerja]" value="4" 
            <?php echo ($data['psikogram']['lki']['sistematika_kerja'] == '4') ? 'checked="checked"' : '';?></td>
       <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[sistematika_kerja]" value="5" 
            <?php echo ($data['psikogram']['lki']['sistematika_kerja'] == '5') ? 'checked="checked"' : '';?></td>
       <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[sistematika_kerja]" value="6" 
            <?php echo ($data['psikogram']['lki']['sistematika_kerja'] == '6') ? 'checked="checked"' : '';?></td>
       <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[sistematika_kerja]" value="7" 
            <?php echo ($data['psikogram']['lki']['sistematika_kerja'] == '7') ? 'checked="checked"' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9" >
	   2</td>
	   <td class="psikogramtable10" colspan="3">Tempo Kerja</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kecepatan dan kecekatan kerja, yang menunjukkan kemampuan menyelesaikan sejumlah tugas dalam batas waktu tertentu <span style="mso-spacerun:yes">&nbsp;</span></td>
       <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[tempo_kerja]" value="1" 
       <?php echo ($data['psikogram']['lki']['tempo_kerja'] == '1') ? 'checked="checked"' : '';?></td>       
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[tempo_kerja]" value="2" 
       <?php echo ($data['psikogram']['lki']['tempo_kerja'] == '2') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[tempo_kerja]" value="3" 
       <?php echo ($data['psikogram']['lki']['tempo_kerja'] == '3') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable13"><input type="radio" class="calc" id="radio3" name="psikogram[tempo_kerja]" value="4" 
       <?php echo ($data['psikogram']['lki']['tempo_kerja'] == '4') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[tempo_kerja]" value="5" 
       <?php echo ($data['psikogram']['lki']['tempo_kerja'] == '5') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[tempo_kerja]" value="6" 
       <?php echo ($data['psikogram']['lki']['tempo_kerja'] == '6') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[tempo_kerja]" value="7" 
       <?php echo ($data['psikogram']['lki']['tempo_kerja'] == '7') ? 'checked="checked"' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9" >
	   3</td>
	   <td class="psikogramtable10" colspan="3">Ketelitian</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kemampuan bekerja dengan sesedikit mungkin melakukan kesalahan atau kekeliruan</td>
       <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[ketelitian]" value="1" 
       <?php echo ($data['psikogram']['lki']['ketelitian'] == '1') ? 'checked="checked"' : '';?></td>       
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[ketelitian]" value="2" 
       <?php echo ($data['psikogram']['lki']['ketelitian'] == '2') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[ketelitian]" value="3" 
       <?php echo ($data['psikogram']['lki']['ketelitian'] == '3') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[ketelitian]" value="4" 
       <?php echo ($data['psikogram']['lki']['ketelitian'] == '4') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable13"><input type="radio" class="calc" id="radio3" name="psikogram[ketelitian]" value="5" 
       <?php echo ($data['psikogram']['lki']['ketelitian'] == '5') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[ketelitian]" value="6" 
       <?php echo ($data['psikogram']['lki']['ketelitian'] == '6') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[ketelitian]" value="7" 
       <?php echo ($data['psikogram']['lki']['ketelitian'] == '7') ? 'checked="checked"' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9" >4</td>
	   <td class="psikogramtable10" colspan="3" style="height: 20pt;">Ketekunan</td>
	   <td class="psikogramtable11" colspan="6"  width="332">
	   Daya tahan menghadapi dan menyelesaikan tugas sampai tuntas dalam waktu relatif lama dengan mencapai hasil yang optimal</td>
       <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[ketekunan]" value="1" 
       <?php echo ($data['psikogram']['lki']['ketekunan'] == '1') ? 'checked="checked"' : '';?></td>       
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[ketekunan]" value="2" 
       <?php echo ($data['psikogram']['lki']['ketekunan'] == '2') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[ketekunan]" value="3" 
       <?php echo ($data['psikogram']['lki']['ketekunan'] == '3') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable13"><input type="radio" class="calc" id="radio3" name="psikogram[ketekunan]" value="4" 
       <?php echo ($data['psikogram']['lki']['ketekunan'] == '4') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[ketekunan]" value="5" 
       <?php echo ($data['psikogram']['lki']['ketekunan'] == '5') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[ketekunan]" value="6" 
       <?php echo ($data['psikogram']['lki']['ketekunan'] == '6') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[ketekunan]" value="7" 
       <?php echo ($data['psikogram']['lki']['ketekunan'] == '7') ? 'checked="checked"' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9"  >
	   5</td>
	   <td class="psikogramtable10" colspan="3">Komunikasi Efektif</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kemampuan menyampaikan pendapat secara lancar, sehingga pendengar paham dan bersedia mengikuti pendapatnya</td>
       <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[komunikasi_efektif]" value="1" 
       <?php echo ($data['psikogram']['lki']['komunikasi_efektif'] == '1') ? 'checked="checked"' : '';?></td>       
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[komunikasi_efektif]" value="2" 
       <?php echo ($data['psikogram']['lki']['komunikasi_efektif'] == '2') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[komunikasi_efektif]" value="3" 
       <?php echo ($data['psikogram']['lki']['komunikasi_efektif'] == '3') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[komunikasi_efektif]" value="4" 
       <?php echo ($data['psikogram']['lki']['komunikasi_efektif'] == '4') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable13"><input type="radio" class="calc" id="radio3" name="psikogram[komunikasi_efektif]" value="5" 
       <?php echo ($data['psikogram']['lki']['komunikasi_efektif'] == '5') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[komunikasi_efektif]" value="6" 
       <?php echo ($data['psikogram']['lki']['komunikasi_efektif'] == '6') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[komunikasi_efektif]" value="7" 
       <?php echo ($data['psikogram']['lki']['komunikasi_efektif'] == '7') ? 'checked="checked"' : '';?></td>
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
       <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[motivasi]" value="1" 
       <?php echo ($data['psikogram']['lki']['motivasi'] == '1') ? 'checked="checked"' : '';?></td>       
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[motivasi]" value="2" 
       <?php echo ($data['psikogram']['lki']['motivasi'] == '2') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[motivasi]" value="3" 
       <?php echo ($data['psikogram']['lki']['motivasi'] == '3') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable13"><input type="radio" class="calc" id="radio3" name="psikogram[motivasi]" value="4" 
       <?php echo ($data['psikogram']['lki']['motivasi'] == '4') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[motivasi]" value="5" 
       <?php echo ($data['psikogram']['lki']['motivasi'] == '5') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[motivasi]" value="6" 
       <?php echo ($data['psikogram']['lki']['motivasi'] == '6') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[motivasi]" value="7" 
       <?php echo ($data['psikogram']['lki']['motivasi'] == '7') ? 'checked="checked"' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9" >
	   2</td>
	   <td class="psikogramtable10" colspan="3">Konsep Diri</td>
	   <td class="psikogramtable11" colspan="6" >
	   Pemahaman atas kelebihan dan kekurangan diri sendiri</td>
       <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[konsep_diri]" value="1" 
       <?php echo ($data['psikogram']['lki']['konsep_diri'] == '1') ? 'checked="checked"' : '';?></td>       
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[konsep_diri]" value="2" 
       <?php echo ($data['psikogram']['lki']['konsep_diri'] == '2') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[konsep_diri]" value="3" 
       <?php echo ($data['psikogram']['lki']['konsep_diri'] == '3') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable13"><input type="radio" class="calc" id="radio3" name="psikogram[konsep_diri]" value="4" 
       <?php echo ($data['psikogram']['lki']['konsep_diri'] == '4') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[konsep_diri]" value="5" 
       <?php echo ($data['psikogram']['lki']['konsep_diri'] == '5') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[konsep_diri]" value="6" 
       <?php echo ($data['psikogram']['lki']['konsep_diri'] == '6') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[konsep_diri]" value="7" 
       <?php echo ($data['psikogram']['lki']['konsep_diri'] == '7') ? 'checked="checked"' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9" >
	   3</td>
	   <td class="psikogramtable10" colspan="3">Empati</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kemampuan memahami dan merasakan adanya permasalahan dan kondisi emosional orang lain</td>
       <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[empati]" value="1" 
       <?php echo ($data['psikogram']['lki']['empati'] == '1') ? 'checked="checked"' : '';?></td>       
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[empati]" value="2" 
       <?php echo ($data['psikogram']['lki']['empati'] == '2') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[empati]" value="3" 
       <?php echo ($data['psikogram']['lki']['empati'] == '3') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[empati]" value="4" 
       <?php echo ($data['psikogram']['lki']['empati'] == '4') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable13"><input type="radio" class="calc" id="radio3" name="psikogram[empati]" value="5" 
       <?php echo ($data['psikogram']['lki']['empati'] == '5') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[empati]" value="6" 
       <?php echo ($data['psikogram']['lki']['empati'] == '6') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[empati]" value="7" 
       <?php echo ($data['psikogram']['lki']['empati'] == '7') ? 'checked="checked"' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9" >
	   4</td>
	   <td class="psikogramtable10" colspan="3">Pemahaman Sosial</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kemampuan bereaksi dengan cepat terhadap kebutuhan orang lain atau tuntutan lingkungan, serta memahami norma sosial yang berlaku.</td>
       <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[pemahaman_sosial]" value="1" 
       <?php echo ($data['psikogram']['lki']['pemahaman_sosial'] == '1') ? 'checked="checked"' : '';?></td>       
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[pemahaman_sosial]" value="2" 
       <?php echo ($data['psikogram']['lki']['pemahaman_sosial'] == '2') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[pemahaman_sosial]" value="3" 
       <?php echo ($data['psikogram']['lki']['pemahaman_sosial'] == '3') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[pemahaman_sosial]" value="4" 
       <?php echo ($data['psikogram']['lki']['pemahaman_sosial'] == '4') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable13"><input type="radio" class="calc" id="radio3" name="psikogram[pemahaman_sosial]" value="5" 
       <?php echo ($data['psikogram']['lki']['pemahaman_sosial'] == '5') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[pemahaman_sosial]" value="6" 
       <?php echo ($data['psikogram']['lki']['pemahaman_sosial'] == '6') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[pemahaman_sosial]" value="7" 
       <?php echo ($data['psikogram']['lki']['pemahaman_sosial'] == '7') ? 'checked="checked"' : '';?></td>
   </tr>
   <tr>
	   <td class="psikogramtable9"  >
	   5</td>
	   <td class="psikogramtable10" colspan="3">Pengaturan Diri</td>
	   <td class="psikogramtable11" colspan="6" >
	   Kemampuan mengendalikan diri dalam situasi-situasi sulit dan kemampuan melakukan perencanaan sebelum bertindak.   <span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;</span></td>
       <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[pengaturan_diri]" value="1" 
       <?php echo ($data['psikogram']['lki']['pengaturan_diri'] == '1') ? 'checked="checked"' : '';?></td>       
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[pengaturan_diri]" value="2" 
       <?php echo ($data['psikogram']['lki']['pengaturan_diri'] == '2') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[pengaturan_diri]" value="3" 
       <?php echo ($data['psikogram']['lki']['pengaturan_diri'] == '3') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable13"><input type="radio" class="calc" id="radio3" name="psikogram[pengaturan_diri]" value="4" 
       <?php echo ($data['psikogram']['lki']['pengaturan_diri'] == '4') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[pengaturan_diri]" value="5" 
       <?php echo ($data['psikogram']['lki']['pengaturan_diri'] == '5') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[pengaturan_diri]" value="6" 
       <?php echo ($data['psikogram']['lki']['pengaturan_diri'] == '6') ? 'checked="checked"' : '';?></td>
  <td class="psikogramtable12"><input type="radio" class="calc" id="radio3" name="psikogram[pengaturan_diri]" value="7" 
       <?php echo ($data['psikogram']['lki']['pengaturan_diri'] == '7') ? 'checked="checked"' : '';?></td>
   </tr>
   <tr bgcolor="#B8CCE4">
	   <td class="psikogramtable18" colspan="11" width="444">
	   TOTAL SKOR</td>
	   <td class="psikogramtable2" colspan="7"><div id="total_psikogram"><?= $total_psikogram ?></div></td>
   </tr>
</table>
<?php
if ((null !== $is_assessor) && (!in_array($statusproject->value, $status_list))) {


echo '<div>';
       
            echo Html::a(Yii::t('app', 'simpan nilai psikogram'), ['savereview', 'id' => $model->id, 'status' => 'open'], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to save this report?'),
                'method' => 'post',
            ],
        ]);


echo '</div>';

}

?>
<br/>
<div class='center'>
<h3>DIAGRAM KOMPETENSI</H3>

 <div class="radarChart" style=" background-image: url('<?=Url::base();?>/images/4/<?=$catalog_id;?>.png'); 
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
			<th>LKI (min = 0, MAX = 5)</th>
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
			<td>
            <input type="number" id="field"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="kompetensigram[<?=$key;?>]" min="0" max="5" 
            value="<?= $data['kompetensigram']['lki'][$key]?>"></td>
    <td><?= $data['kompetensigram']['lkj'][$key] - $data['kompetensigram']['lki'][$key]?></td>
       
			<td><?= round((($data['kompetensigram']['lki'][$key] ) / $data['kompetensigram']['lkj'][$key] * 100),0) ?> %</td>
		</tr>

<?php   } ?>      
		
	</tbody>
</table>

</div>
<br/>
<?php

            echo Html::a(Yii::t('app', 'Update LKI & pilihan indikator'), ['savereview', 'id' => $model->id, 'status' => 'open'], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure?'),
                'method' => 'post',
            ],
        ]) . ' <i>!!! merubah nilai LKI akan menghapus indikator yang sudah dipilih !!!</i>';
?>
<br/>
<h3><i>PERHATIAN: apabila nilai LKI diatas dirubah PASTIKAN anda telah menekan tombol Update LKI</i></h3>
<?php
if ((null !== $is_assessor) && (!in_array($statusproject->value, $status_list))) {


echo '<div>';
       
            echo Html::a(Yii::t('app', 'simpan nilai kompetensigram & update uraian'), ['savereview', 'id' => $model->id, 'status' => 'open'], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to save this report?'),
                'method' => 'post',
            ],
        ]);


echo '</div>';

}

?>
<br/>
<table class="blueTable2">
<thead>
<tr>
<th>KOMPETENSI</th>
<th>LEVEL</th>
<th>DESKRIPSI LEVEL</th>
<th>INDIKATOR PERILAKU</th>
</tr>
</thead>

<tbody>

    <?php

foreach ($uraian as $uraian_key => $uraian_value) {
    echo '<tr>';
    echo '<td>' . substr($uraian_key, 0, -1).'</td>';
    echo '<td>' . substr($uraian_key, -1).'</td>';
        echo '<td>' . $uraian_value[0].'</td>';
        echo '<td>';
$value_uraian  = [];
try {
               

             //   $serialize_items = unserialize($data['kompetensigram']['evidence']['kub']);
if (isset($data['kompetensigram']['evidence'][substr($uraian_key, 0, -1)]))
{
     $serialize_items = unserialize($data['kompetensigram']['evidence'][substr($uraian_key, 0, -1)]);
                foreach ($serialize_items as $serialize_key => $serialize_value) {
                    array_push($value_uraian, $serialize_value);
                    //echo 'sasa';
                }
}
            } catch (Exception $e) {

            }

                //$value_uraian = [1,2];
  //              echo substr($uraian_key, 0, -1);

foreach ($uraian_value as $uraian_value_key => $uraian_value_value) {
    if ($uraian_value_key !== 0)
    {

 $ifcheck = '';
 //$test = '';
if (in_array($uraian_value_key, $value_uraian))
{
    $ifcheck = 'checked="checked"';
    //$test = $uraian_value_key;
} 
        
echo '<input name="evidence['.$uraian_key.'][]" type="checkbox" '.$ifcheck.' value='.$uraian_value_key.' />';
        echo ' ' . $uraian_value_value;
        echo '<br/>';
    }

}
       echo '</td>';
//echo '<td><input name="evidence1" type="checkbox" value="1" />1. Melaksanakan nilai strategis organisasi ke dalam lingkup pekerjaan sehari-hari berdasarkan program dan kegiatan yang telah ditetapkan<br /> 
//<input name="evidence1" type="checkbox" value="1" />2. Melaksanakan nilai strategis organisasi ke dalam lingkup pekerjaan sehari-hari berdasarkan program dan kegiatan yang telah ditetapkan</td>';
    echo '</tr>';
}

    ?>
<!--tr>
<td>{KEPEMMPINAN VISIONER}</td>
<td>1</td>
<td>Mengidentifikasi sumber daya dalam menyusun rencana strategis</td>
<td><input name="evidence1" type="checkbox" value="1" />1. Melaksanakan nilai strategis organisasi ke dalam lingkup pekerjaan sehari-hari berdasarkan program dan kegiatan yang telah ditetapkan<br /> <input name="evidence1" type="checkbox" value="1" />2. Melaksanakan nilai strategis organisasi ke dalam lingkup pekerjaan sehari-hari berdasarkan program dan kegiatan yang telah ditetapkan</td>
</tr>
<tr>
<td>INOVASI</td>
<td>3</td>
<td>Menciptakan ide / gagasan / pemikiran baru berdasarkan ide / gagasan / pemikiran orang lain yang unik {ino0}</td>
<td><input name="evidence1" type="checkbox" value="1" />1. Melaksanakan nilai strategis organisasi ke dalam lingkup pekerjaan sehari-hari berdasarkan program dan kegiatan yang telah ditetapkan<br /> <input name="evidence1" type="checkbox" value="1" />2. Melaksanakan nilai strategis organisasi ke dalam lingkup pekerjaan sehari-hari berdasarkan program dan kegiatan yang telah ditetapkan</td>
</tr-->
</tbody>
</table>
<?php
if ((null !== $is_assessor) && (!in_array($statusproject->value, $status_list))) {

echo '<br/>';
echo '<div>';
       
            echo Html::a(Yii::t('app', 'Simpan indikator'), ['savereview', 'id' => $model->id, 'status' => 'open'], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to save this report?'),
                'method' => 'post',
            ],
        ]);


echo '</div>';

}

?>

<br/>
<table class="center">
<tr>
<td>
<?php




if (round($PArk/$sumC*100) >=100) {
    echo "<img src=".Url::base()."/images/kompetensiSumbuY-top.png>";
}

else if ((round($PArk/$sumC*100) >= 75) && (round($PArk/$sumC*100) <= 99)) {
    echo "<img src=".Url::base()."/images/kompetensiSumbuY-middle.png>";

}

else {
    //echo round($PArp/66*100);
   echo "<img src=".Url::base()."/images/kompetensiSumbuY-bottom.png>";
}
?>
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
<td align="center">
<?php


if (round($PArp/62*100) >=100) {
    echo "<img src=".Url::base()."/images/potensiSumbuX.png>";
}

else if ((round($PArp/62*100) >= 75) && (round($PArp/62*100) <= 99)) {
    echo "<img src=".Url::base()."/images/potensiSumbuX-middle.png>";

}

else {
 //   echo round($PArp/66*100);
    echo "<img src=".Url::base()."/images/potensiSumbuX-bottom.png>";
}
?>
</td>
</table>                        
  
<?php

if ((null !== $is_so) ) {

    //if(strlen($data['uraian_saran']) > 0) {
        if (true) {


/*
echo '<hr/>';
// /echo '<h3>Bagi para SO yang telah pernah mengisi box uraian ini sebelumnya, harap dijabarkan ke uraian setiap kompetensi. Box ini ditampilkan lagi hanya sebagai referensi</h3>';

echo '
             <div style="color:#999;margin:1em 0">
                    bisa klik tombol dibawah untuk insert uraian dari sistem
                </div>
';


echo '<textarea id="textarea" name="uraian_saran" rows="10" cols="100">'.$data['uraian_saran'].'</textarea>';
*/


foreach ($uraian as $uraian_key => $uraian_value) {

    //echo '<br/>' . substr($uraian_key, 0, -1);
   // echo ' level : ' . substr($uraian_key, -1);
        //echo '<br/>' . $uraian_value[0];
     //   echo '<br/>';
$value_uraian  = [];
try {
                $serialize_items = unserialize($data['kompetensigram']['evidence'][substr($uraian_key, 0, -1)]);
                if ($data['kompetensigram']['evidence'][substr($uraian_key, 0, -1)])
                {
                                foreach ($serialize_items as $serialize_key => $serialize_value) {
                                    array_push($value_uraian, $serialize_value);
                                }
                }
            } catch (Exception $e) {

            }


foreach ($uraian_value as $uraian_value_key => $uraian_value_value) {
    if ($uraian_value_key !== 0)
    {

 $ifcheck = '';
 //$test = '';
if (in_array($uraian_value_key, $value_uraian))
        {
         /*   echo '<button type="button" class="uraian_button" value="'.$uraian_value_value.'" name="evidence['.$uraian_value_key.']">Insert uraian</button>';
        echo '<span> '.$uraian_value_value.'</span>';
                //echo ' ' . $uraian_value_value;
                echo '<br/>';
                */
        } 

    }

}

    echo '</br>';
}


}

}









if (null !== $catalog_id) {
//echo $catalog_id;
//echo $form->errorSummary($model);
        echo $this->render('/assessment/'.$proj_act->project_id.'/' . $catalog_id, [

            'catalog_id' => $catalog_id,
                            'biodata' => $biodata,
            'assessment_report' => $assessment_report,
            'form' => $form,
            'readonly' => $readonly,
        ]);
    
$saran_komplit = '';

function arksort($array)
    {
    arsort($array);
    $newarray=array();
    $temp=array();
    $on=current($array);
    foreach($array as $key => $val)
        {
        if ($val===$on) $temp[$key]=$val;
        else
            {
            ksort($temp);
            $newarray=$newarray+$temp;
            $temp=array();
            $on=$val;
            $temp[$key]=$val;
            }
        }
    ksort($temp);
    $newarray=$newarray+$temp;
    reset($newarray);
    return $newarray;
    }

    $gaps = arksort($gaps);
                    foreach ($gaps as $gap_key => $gap_value) {
                      # code...
                    $randomizer = 1;

                        $maxmodel = RefAssessmentDictionary::find()
                        ->andWhere(['type' => 'saran_kompetensigram'])
                        ->andWhere(['key' =>$gap_key])
                        ->All();
                        $size = sizeof($maxmodel);
                        
                        if ($size > 0) {
                        $random =  rand();
                        $randomizer = $random % $size;
                        $randomizer++;
                      }

                      $lki = RefAssessmentDictionary::find()
                      ->andWhere(['type' => 'saran_kompetensigram'])
                      ->andWhere(['key' =>$gap_key])
                      ->andWhere(['value' => $randomizer])
                      ->One();
                      if (null!== $lki) {

                          $saran =  '<br/>' . $gap_key . 
                          //$randomizer . 
                          ' (GAP = ' . $gap_value.') : ' .  $lki->textvalue;
                          } else {
                                if ($gap_value > 0)
                                {
                                $saran =  '<br/>' . $gap_key  . ' (GAP = ' . $gap_value .                        
                          ') : ***Berikan Judul Training yang Sesuai*** ' ;  
                                } else {
                            $saran =  '<br/>' . $gap_key  . ' (GAP = ' . $gap_value .

                          ') : Tidak ada saran' ;
                                }

                          };
                       $saran_komplit = $saran_komplit  . $saran;


                    }


echo '<pre>';
echo '<h3>Saran Pengembangan dari Sistem</h3>';
//print_r($gaps);
echo $saran_komplit;
echo'</pre>';


} else {
    echo 'NO CATALOG_ID ('.$rumpun->value . ':' . $leveljabatan->value.') FOR THIS USER YET. catalog_id =' . $catalog_id;
}
?>
<hr/>



<?php



echo '<div style="display: inline-block;">'. Html::a(Yii::t('app', 'Print'), ['print', 'id' => $model->id], ['class' => 'btn btn-info', 'target'=>'_blank']).'</div>';
 echo '<hr/>';


if ((null !== $is_assessor) && (!in_array($statusproject->value, $status_list))) {


echo '<div class="well">';
        echo '<h3>Menu Assessor (report status = '. $statusproject->value.')</h3>';
       
            echo Html::a(Yii::t('app', 'save draft'), ['savereview', 'id' => $model->id, 'status' => 'open'], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to save this report?'),
                'method' => 'post',
            ],
        ]);

        echo '&nbsp;';
        echo '&nbsp;';

        echo '&nbsp;';
            echo Html::a(Yii::t('app', 'submit final report'), ['savereview', 'id' => $model->id, 'status' => 'done'], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to SUBMIT this report?'),
                'method' => 'post',
            ],
        ]);




echo '</div>';

}
else {
    //echo "ASESOR UDAH DONE";
}

if ((null !== $is_so) ) {


echo '<div class="well">';
        echo '<h3>Menu Second Opinion (report status = '. $statusproject->value.')</h3>';




echo Html::a(Yii::t('app', 'Save draft'), ['savereview', 'id' => $model->id, 'status' => 'under_review'], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to finish review this report?'),
                'method' => 'post',
            ],
        ]);
echo '&nbsp';
echo '&nbsp';
echo '&nbsp';
echo '&nbsp';

            echo Html::a(Yii::t('app', 'Finish SO Review'), ['savereview', 'id' => $model->id, 'status' => 'so_reviewed'], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to finish review this report?'),
                'method' => 'post',
            ],
        ]);
/*echo '  ';
         echo Html::a(Yii::t('app', 'Reject'), ['savereview', 'id' => $model->id, 'status' => 'so_returned'], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to finish review this report?'),
                'method' => 'post',
            ],
        ]);
*/


echo '</div>';

}
else {
    echo "<br/>BUKAN SO";
}




 ?>




    <?php ActiveForm::end();  ?>


 
 
<?php



//echo Html::button('Press me!', ['class' => 'teaser', 'id' => 'halo']);


    

$this->registerJs("


"


);
?>




<?php

//echo '<pre>';
//print_r($data['kompetensigram']['evidence']);
//print_r($data);





?>