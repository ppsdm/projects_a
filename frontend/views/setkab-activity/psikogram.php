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


$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Setkab Activity',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Setkab Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="setkab-activity-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(); ?>



<h3>Aspek Intelektual</h3>
<table class="table table-bordered table-responsive table-hover">
    <thead>    
        <tr>
            <th>Aspek Psikologis</th>
            <th>Keterangan</th>
            <th width="20%">Penilaian</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Inteligensi umum</td>
            <td>Gabungan keseluruhan potensi kecerdasan sebagai perpaduan dari aspek-aspek pembentukan intelektualitas</td>
            <td><?= $form->field($model, 'psikogram_inteligensiumum')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5'])->label(false); ?></td>
        </tr>
        <tr>
            <td>Berpikir Analitis</td>
            <td>Kemampuan menguraikan masalah & melihat kaitan antara satu hal dg hal lainnya hingga menemukan kesimpulan</td>
            <td><?= $form->field($model, 'psikogram_berpikiranalitis')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5'])->label(false); ?></td>
        </tr>
        <tr>
            <td>Logika berpikir</td>
            <td>Kemampuan untuk mengorganisir proses berpikir yang menunjukkan adanya alur berpikir yang sistematis dan logis   </td>
            <td><?= $form->field($model, 'psikogram_logikaberpikir')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5'])->label(false); ?></td>
        </tr>
        <tr>
            <td>Fleksibilitas berpikir</td>
            <td></td>
            <td><?= $form->field($model, 'psikogram_fleksibilitasberpikir')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5'])->label(false); ?></td>
        </tr>
        <tr>
            <td>Kemampuan belajar</td>
            <td>Kemampuan menguasai dan meningkatkan pengetahuan dan ketrampilan kerja yang baru maupun yang telah dimiliki </td>
            <td><?= $form->field($model, 'psikogram_kemampuanbelajar')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5'])->label(false); ?></td>
        </tr>
    </tbody>
</table>

<hr/>

pek Sikap Kerja</h3>
<table class="table table-bordered table-responsive table-hover">
    <thead>
        <tr>
            <th>Aspek Psikologis</th>
            <th>Keterangan</th>
            <th width="20%">Penilaian</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Sistematika Kerja</td>
            <td>Kemampuan dan ketrampilan menyelesaikan suatu tugas secara runut, proporsional, sesuai dengan skala prioritas tertentu  </td>
            <td><?= $form->field($model, 'psikogram_sistematikakerja')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5'])->label(false); ?></td>
        </tr>
        <tr>
            <td>Tempo Kerja</td>
            <td>Kecepatan dan kecekatan kerja, yang menunjukkan kemampuan menyelesaikan sejumlah tugas dalam batas waktu tertentu</td>
            <td><?= $form->field($model, 'psikogram_tempokerja')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5'])->label(false); ?></td>
        </tr>
        <tr>
            <td>Ketelitian</td>
            <td>Kemampuan bekerja dengan sesedikit mungkin melakukan kesalahan atau kekeliruan  </td>
            <td><?= $form->field($model, 'psikogram_ketelitian')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5'])->label(false); ?></td>
        </tr>
        <tr>
            <td>Ketekunan</td>
            <td>Daya tahan menghadapi dan menyelesaikan tugas sampai tuntas dalam waktu relatif lama dengan mencapai hasil yang optimal</td>
            <td><?= $form->field($model, 'psikogram_ketekunan')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5'])->label(false); ?></td>
        </tr>
        <tr>
            <td>Komunikasi Efektif</td>
            <td>Kemampuan menyampaikan pendapat secara lancar, sehingga pendengar paham dan bersedia mengikuti pendapatnya</td>
            <td><?= $form->field($model, 'psikogram_komunikasiefektif')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5'])->label(false); ?></td>
        </tr>
    </tbody>
</table>

<hr/>

<h3>Aspek Kepribadian</h3>
<table class="table table-bordered table-responsive table-hover">
    <thead>
        <tr>
            <th>Aspek Psikologis</th>
            <th>Keterangan</th>
            <th width="20%">Penilaian</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Motivasi</td>
            <td>Keinginan meningkatkan hasil kerja dan selalu berfokus pada profit opportunities</td>
            <td><?= $form->field($model, 'psikogram_motivasi')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5'])->label(false); ?></td>
        </tr>
        <tr>
            <td>Konsep Diri</td>
            <td>Pemahaman atas kelebihan dan kekurangan diri sendiri</td>
            <td><?= $form->field($model, 'psikogram_konsepdiri')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5'])->label(false); ?></td>
        </tr>
        <tr>
            <td>Empati</td>
            <td>Kemampuan memahami dan merasakan adanya permasalahan dan kondisi emosional orang lain   </td>
            <td><?= $form->field($model, 'psikogram_empati')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5'])->label(false); ?></td>
        </tr>
        <tr>
            <td>Pemahaman Sosial</td>
            <td>Kemampuan bereaksi dengan cepat terhadap kebutuhan orang lain atau tuntutan lingkungan, serta memahami norma sosial yang berlaku.   </td>
            <td><?= $form->field($model, 'psikogram_pemahamansosial')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5'])->label(false); ?></td>
        </tr>
        <tr>
            <td>Pengaturan Diri</td>
            <td>Kemampuan mengendalikan diri dalam situasi-situasi sulit dan kemampuan melakukan perencanaan sebelum bertindak.</td>
            <td><?= $form->field($model, 'psikogram_pengaturandiri')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5'])->label(false); ?></td>
        </tr>
    </tbody>
</table>

<?php
/*
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'assessee_id',
            'assessor_id',
            'second_opinion_id',
            'tanggal_test',
            'tempat_test',
            'tujuan_pemeriksaan',
			[
				'label' => 'LKI',
				'value' => function($data) {
					//echo Html::activeRadioList($this->model, $this->attribute, $this->enum, $this->options);
					return Html::radioList(array('1'=>'One',2=>'Two'));
					
					//return 'sasdada';
				}
			],
        ],
    ]);
	*/
	?>
	
	
	    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'value' => 'update', 'name' => 'submit2']) ?>
    </div>
    <?php ActiveForm::end(); ?>
	
	</div>
