<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\redactor\widgets\Redactor as Redactor;
use yii\web\View;
use yii\helpers\ArrayHelper;
use common\modules\catalog\models\RefAssessmentDictionary;
/* @var $this yii\web\View */
/* @var $model frontend\models\SetkabActivity */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Setkab Activity',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Setkab Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="setkab-activity-update">

    <?php $form = ActiveForm::begin(); ?>
<?php

$keyvalue = 'pengelolaanperubahan_lki' . $model->integritas_lki;
$indikators = RefAssessmentDictionary::find()->andWhere(['key' => $keyvalue])->andWhere(['>', 'value',0])->asArray()->All();

$indikator = [
    ['id' => '123', 'name' => 'aaa', 'class' => 'x'],
    ['id' => '124', 'name' => 'bbb', 'class' => 'x'],
    ['id' => '345', 'name' => 'ccc', 'class' => 'y'],
];

echo '<h3>LKJ = ' . $lkj->kompetensigram_pengelolaanperubahan . '</h3>';
$gap = $model->pengelolaanperubahan_lki - $lkj->kompetensigram_pengelolaanperubahan;
if ($gap > 0) {
	$gap = 0;
	}
$daftar_lki =  ['0' => '0','1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'];
//$daftar_lki = ArrayHelper::map($indikators, 'value', 'textvalue');
echo    $form->field($model, 'pengelolaanperubahan_lki')->dropDownList($daftar_lki, ['prompt' => 'select...']);
echo Html::submitButton(Yii::t('app', 'Simpan LKI & update daftar indikator'), ['class' =>'btn btn-primary', 'value' => 'refresh', 'name'=>'submit2']);
echo '<h3>GAP = ' . $gap . '</h3>';
echo '<hr/>';
//echo Html::a('Profile', ['', 'id' => $model->id], ['class' => 'btn btn-primary']);
echo '<p>';
				echo Html::label('Indikator Perilaku', 'pengelolaanperubahan_lki');
				echo '</p>';
				echo Html::activeCheckboxList($model, 'indikatorarray', ArrayHelper::map($indikators, 'value', 'textvalue'));
				
				echo '<hr/>';
				echo '<p>';
				$uraian_kamus = 'masuih kosong. mau diisi apa ya?';
				echo Html::label('Uraian Kamus', 'uraian_kamus');
				echo '</p>';
echo '<p>';


				echo Html::textArea('uraian_kamus', $uraian_kamus,['readonly' => true, 'rows' => '6', 'cols' => '100', 'disable' => true]);
				echo '</p>';

				
echo '<p>';


	echo $form->field($model, 'pengelolaanperubahan_uraian')->widget(\yii\redactor\widgets\Redactor::className(), [

    'clientOptions' => [
		'plugins' => ['clips', 'fontcolor','fullscreen', 'counter']
    ]
]);
echo $hint_text = 'words : ' . str_word_count(strip_tags($model->integritas_uraian)) . ' , characters : ' . strlen(str_replace(' ','',strip_tags($model->integritas_uraian)));
			echo '</p>';
?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'value' => 'update', 'name' => 'submit2']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>





<?php
            
			//echo '<pre>';
//print_r($indikators);
    

			
			$this->registerJs(
    "$(function(){
    $('#setkabactivity-integritas_lki').change(function(){
		
        
    });
});",
    View::POS_READY,
    'my-button-handler'
);


?>