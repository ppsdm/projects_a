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



<p> <h3>Aspek Intelektual</h3>
<?= $form->field($model, 'psikogram_inteligensiumum')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']        ,

                            [
                                /*'item' => function($index, $label, $name, $checked, $value) {
								
                                    $return = '<label class="modal-radio">';
                                    $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                                    $return .= '<i></i>';
                                    $return .= '<span>' . ucwords($label) . '</span>';
                                    $return .= '</label>';

                                    return $return;
                                }
								*/
                            ]


); ?>
<?= $form->field($model, 'psikogram_berpikiranalitis')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']); ?>
<?= $form->field($model, 'psikogram_logikaberpikir')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']); ?>
<?= $form->field($model, 'psikogram_fleksibilitasberpikir')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']); ?>
<?= $form->field($model, 'psikogram_kemampuanbelajar')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']); ?>
</p>
<hr/>
<p>

<h3>Aspek Sikap Kerja</h3>
<?= $form->field($model, 'psikogram_sistematikakerja')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']); ?>
<?= $form->field($model, 'psikogram_tempokerja')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']); ?>
<?= $form->field($model, 'psikogram_ketelitian')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']); ?>
<?= $form->field($model, 'psikogram_ketekunan')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']); ?>
<?= $form->field($model, 'psikogram_komunikasiefektif')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']); ?>
</p>
<hr/>
<p>
<h3>Aspek Kepribadian</h3>
<?= $form->field($model, 'psikogram_motivasi')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']); ?>
<?= $form->field($model, 'psikogram_konsepdiri')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']); ?>
<?= $form->field($model, 'psikogram_empati')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']); ?>
<?= $form->field($model, 'psikogram_pemahamansosial')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']); ?>
<?= $form->field($model, 'psikogram_pengaturandiri')->radioList([0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5']); ?>
</p>

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