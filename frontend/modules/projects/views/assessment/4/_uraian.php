<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use common\modules\catalog\models\RefAssessmentDictionary;
use common\modules\catalog\models\CatalogMeta;
use common\modules\catalog\models\Catalog;
use app\modules\projects\models\ProjectActivityMeta;
use app\modules\projects\models\ProjectAssessmentResult;
use kartik\editable\Editable;

use common\modules\profile\models\ProfileMeta;
use common\modules\profile\models\Profile;


use kartik\detail\DetailView;
use yii\redactor\widgets\Redactor as Redactor;
use app\assets\AppAsset;
use app\assets\InsertatcaretAsset;
use app\assets\Project4Asset;
?>
<div class="uraian">

    <?php

       Project4Asset::register($this);




$model = ProjectAssessmentResult::findOne($model['id']);

$user_profile = Profile::find()->andWhere(['user_id' => Yii::$app->user->id])->One();

$is_so = ProjectActivityMeta::find()
->andWhere(['project_activity_id' => $_GET['id']])
->andWhere(['type' => 'general'])
->andWhere(['key' => 'second_opinion'])
->andWhere(['value'=> $user_profile->id])
->One();

$is_assessor = ProjectActivityMeta::find()
->andWhere(['project_activity_id' => $_GET['id']])
->andWhere(['type' => 'general'])
->andWhere(['key' => 'assessor'])
->andWhere(['value'=> $user_profile->id])
->One();


 		$x = RefAssessmentDictionary::find()
 		->andWhere(['type' => 'deskripsi_kompetensigram_setneg'])
 		->andWhere(['key' => $model->key])->One();


 		$y = CatalogMeta::find()->andWhere(['catalog_id' => $catalog_id])
 		->andWhere(['type' => $model->type])->andWhere(['value' => $model->key])->One();

 		//$val = $model->textvalue;
// 			echo 'model type : ' . $model->value;
 		$randomizer = '1';

 			if (isset($model->attribute_1)) {
 					$randomizer = $model->attribute_1;
 			} else {


 			$maxmodel = RefAssessmentDictionary::find()
 			->andWhere(['type' => 'uraian_kompetensigram'])
			->andWhere(['key' => $model->key . $model->value])
			->All();
			$size = sizeof($maxmodel);
			
			if ($size > 0) {
			$random =  rand();
			$randomizer = $random % $size;
			$randomizer++;
			//echo 'randomizer : ' . $randomizer;
		} else {
			//echo 'size : ' . $size;
		}

 			$model->attribute_1 = $randomizer;
 			$model->save();
}

 			$z = RefAssessmentDictionary::find()
 			->andWhere(['type' => 'uraian_kompetensigram'])
			->andWhere(['key' => trim($model->key) . trim($model->value)])
			->andWhere(['value' => $randomizer])
			->One();
			if (null!== $z) {
 			$val = $z->textvalue;

 			} else {
 				$val = '===belum ada uraian===';
 			};

  
	
    //->label($x->attribute_1 . ' - LKI(' . $model->value . ') LKJ(' . $y->attribute_1.') GAP('.($y->attribute_1 - $model->value).')');



 			$singkatan_aspek = isset($x->attribute_1) ? $x->attribute_1 : '';
 			$nilai_lki = isset($y->value) ? $y->value : 0;
 			$nilai_lkj = isset($y->attribute_1) ? $y->attribute_1 : 0;

 			   if(null !== $is_so){
 			   	$value_uraian  = [];
 			   	$evidence_items = new ProjectAssessmentResult;
$evidence_items = ProjectAssessmentResult::find()
->andWhere(['project_assessment_id' => $pa_id])->andWhere(['type' => 'kompetensi_setneg'])
->andWhere(['key' => $nilai_lki])->andWhere(['value' => $model->value])
	->One();

echo '<div id="uraian_zone">';
if ($model->value > 0)   {
try {
$serialize_items = unserialize($evidence_items->attribute_1);
                foreach ($serialize_items as $serialize_key => $serialize_value) {
                    array_push($value_uraian, $serialize_value);
                    //Fecho '<br/><span> '.$nilai_lki . ' ' . $model->value.'</span>';
              
                    $ur_val = RefAssessmentDictionary::find()->andWhere(['type' => 'kompetensigram_setneg'])
                    ->andWhere(['value' => $serialize_value])
                    ->andWhere(['key' => $nilai_lki.$model->value])->One();
                    $uraian_value_value = isset($ur_val->textvalue) ? $ur_val->textvalue : '';
            echo '<button type="button" class="uraian_button" value="'.$uraian_value_value.'" name="uraiankompetensigram_'.$model->key.'">#'.$serialize_value.'</button>';

                echo ' ' . $uraian_value_value;
                echo '<br/>';


                }
                            } catch (Exception $e) {

            }
} else {

	$uraian_value_value = "tidak ada kompetensi";
            echo '<button type="button" class="uraian_button" value="'.$uraian_value_value.'" name="uraiankompetensigram_'.$model->key.'">Insert no evidence </button>';

                echo ' ' . $uraian_value_value;
                echo '<br/>';

}

echo '</div>';



    ?>

<table  class="cluster">
 <tr>
	 <td class="cluster1" rowspan="3" ><b><?php echo strtoupper($singkatan_aspek  . ' ('.$nilai_lki.')'); ?></b></td>
	 <td class="cluster3" rowspan="3" ><?php echo isset($x->textvalue) ? $x->textvalue : 'no description'; ?>
</td>
	 <td class="cluster4" >Standar</td>
	 <td class="cluster4" ><?php echo $nilai_lkj?></td>
 </tr>
 <tr>
	 <td class="cluster4" >Individu</td>
	 <td class="cluster4" ><?php echo $model->value;?></td>
 </tr>
 <tr>
	 <td class="cluster4" >Fit %</td>
	 <td class="cluster4" ><?php echo round($model->value / $nilai_lkj *100);?> %</td>
 </tr>
 <tr>
	 <td class="cluster5" colspan="4">
	 <?php

if ($readonly) {
/*	 echo $form->field($model, 'textvalue')
	 ->textArea(['rows' => 8, 'readonly'=> $readonly, 'id' =>'uraiankompetensigram_'.$model->key, 
	 	'name' =>'uraiankompetensigram_'.$model->key
	 	])
	 ->label('')
	 ->hint('');
*/
	     echo $model->textvalue;
	     echo '<br/><br/>';


} else {

	$uraian_komp = ProjectAssessmentResult::find()
	->andWhere(['type' => 'kompetensi_setneg'])->andWhere(['project_assessment_id' => $pa_id])
	->andWhere(['key' => $y->value])
	->One();
	if (null == $uraian_komp)
	{
			$model->textvalue = 'Yang bersangkutan tidak memiliki kompetensi terkait';
	} else {

		if ($uraian_komp->value !== '0') {
		if (strlen($uraian_komp->textvalue) > 0) {
			$model->textvalue = $uraian_komp->textvalue;
	} else {
		try {
				$unserialized = unserialize($uraian_komp->attribute_1);
		if (isset($uraian_komp->attribute_1))
		{
			foreach ($unserialized as $key => $value) {
				# code...
				$ur_kom_model = RefAssessmentDictionary::find()->andWhere(['type' => 'kompetensigram_setneg'])
				->andWhere(['key' =>  $y->value . $model->value])
				->andWhere(['value' => $value])->One();
				$ur_kom = isset($ur_kom_model) ? $ur_kom_model->textvalue : 'ga ada : ' . $y->value . $model->value;
//				$model->textvalue = $model->textvalue . '-----' . $ur_kom;
			}
		} else {
//$model->textvalue = 'tidak ada uraian';
		}
		            } catch (Exception $e) {
//			$model->textvalue = 'tidak ada uraian';
            }
	}
} else {
//			$model->textvalue = 'Yang bersangkutan tidak memiliki kompetensi terkait';
}
				
}


//echo '<textarea id="box_uraiankompetensigram_'.$model->key .'" name="box_uraiankompetensigram_'.$model->key .'"rows="10" cols="100">'.$model->textvalue. '</textarea>';


echo $form->field($model, 'textvalue')->label('')->widget(\yii\redactor\widgets\Redactor::className(), [
	'options' => [
	    'id' =>'uraiankompetensigram_'.$model->key, 
	 	'name' =>'uraiankompetensigram_'.$model->key,
	],

    'clientOptions' => [
    'minHeight' => 300,
        'plugins' => ['clips', 'fontcolor','fullscreen', 'counter'],
            /*'counterCallback' => new \yii\web\JsExpression("
                function(data) {
                    console.log('Words: ' + data.words);
                    console.log('Characters: ' + data.characters);
                    console.log('Characters w/o spaces: ' + (data.characters - data.spaces));
                   	console.log(this);
                   	console.log(this.core.getElement().context.id);
                   	$('#hint_' + this.core.getElement().context.id).html('<i>words : ' + data.words + ', characters : ' + (data.characters - data.spaces) + '</i>');

                }
            "),
            */
    ]
]);
/*
echo $form->field($model, 'textvalue')->label('')->textarea([
	'rows' => '6', 
	'style'=>'width:800px',
	'name' =>'uraiankompetensigram_'.$model->key,
	'id' =>'uraiankompetensigram_'.$model->key,
	]) ;
*/



}


        if ($is_assessor) {
        if ($readonly) {

        } else {
           // echo Html::a(Yii::t('app', 'Save data'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);

            echo Html::a(Yii::t('app', 'Save'), ['save', 'id' => $_GET['id']], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to save this report?'),
                'method' => 'post',
            ],
        ]);


            
        }


        }

                    if(null !== $is_so){
                    	        if ($readonly) {

        } else {
            /*echo Html::a(Yii::t('app', 'Temporary Save'), ['sosaved', 'id' => $_GET['id']], [
            'class' => 'btn btn-info',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to finish review this item?'),
                'method' => 'post',
            ],
        ]);
            */
            }
        }

	 




	 ?>	 
 </tr>
</table>	

<?php
}


?>
</div>
<hr/>