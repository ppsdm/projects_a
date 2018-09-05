<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

use yii\web\View;
use app\assets\AppAsset;
use app\assets\InsertatcaretAsset;
use yii\helpers\ArrayHelper;

use app\modules\projects\models\Project;
use app\modules\projects\models\ProjectMeta;
use app\modules\projects\models\ProjectActivity;
use app\modules\projects\models\ProjectAssessmentResult;
use app\modules\projects\models\ProjectAssessmentResultSearch;
use app\modules\projects\models\ProjectAssessment;
use app\modules\projects\models\ProjectActivityMeta;
use common\modules\profile\models\ProfileMeta;
use common\modules\profile\models\Profile;
use common\modules\catalog\models\RefAssessmentDictionary;
use common\modules\catalog\models\CatalogMeta;
use common\modules\catalog\models\Catalog;
use app\modules\projects\models\AssessmentReport;
use app\modules\projects\models\Kompetensigram;
use app\modules\projects\models\Biodata;
use kartik\grid\GridView;
use kartik\form\ActiveForm;

use yii\widgets\ListView;
use kartik\editable\Editable;
use yii\data\SqlDataProvider;
//use vova07\imperavi\Widget as Redactor;

use yii\redactor\widgets\Redactor as Redactor;



//use Yii;

?>



<!--head>
<link rel="stylesheet" type="text/css" href="@web/css/psikogramTable.css">
</head-->


<?php

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




$this->context->initAssessment($_GET['id'], $catalog_id);
//Yii::$app->runAction('activity/initassessment', ['id' => $_GET['id'], 'catalog_id' => $catalog_id]);

   $Pa = ProjectAssessment::find()->andWhere(['activity_id'=> $_GET['id']])->One();
   
   $PArp = ProjectAssessmentResult::find()->andWhere(['type'=>'psikogram'])->andWhere(['project_assessment_id'=>$Pa->id])->Sum('value');
   $PArk = ProjectAssessmentResult::find()->andWhere(['type'=>'kompetensigram'])->andWhere(['project_assessment_id'=>$Pa->id])->Sum('value');

   $sumC =     CatalogMeta::find()->andWhere(['catalog_id'=>$Pa->catalog_id])->andWhere(['type'=>'kompetensigram'])->andWhere(['key'=>'kompetensi'])->Sum('attribute_1');

   //echo $PArp/66*100 .'<br/>';
   //echo $PArk/$sumC*100 .'<br/>';

   $saran_komplit = '';
   
?>


<?php

$this->registerCss("

 .lkj input[type='radio']:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #d1d3d1;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 1px solid #ccc;
    }

    .lkj     input[type='radio']:checked:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #ffa500;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 1px solid #ccc;     
    }
    
    .RadioBox {
        border: 1px solid #ccc;
        padding: 10px;    
        display: inline-block;
    }

    .RadioBox2 {
        border: 1px solid #ccc;
        padding: 10px;    
        display: inline-block;
        background-color: #ccc;
    }
    
    
    ");

       
?>

<head>
<style type="text/css">

</style>
</head>

<br/>

<?php
if (null !== $is_so)
{

?>

<h3 align="center">URAIAN KOMPETENSI</h3>

<hr/>

<?php

$kompetensigramSearchModel = new ProjectAssessmentResultSearch();
$kompetensigram_params = Yii::$app->request->queryParams;
          $kompetensigramDataProvider = $kompetensigramSearchModel->search($kompetensigram_params);
$kompetensigramDataProvider->query->andWhere(['project_assessment_id' => $Pa->id])
                    ->andWhere(['project_assessment_result.type' => 'kompetensi_setneg']);


//print_r($kompetensigramDataProvider);

echo ListView::widget([
    'dataProvider' => $kompetensigramDataProvider,
    'itemView' => '_uraian',
    'summary'=>'', 
        //'itemView' => function($model, $key, $index, $widget){}

    'viewParams' => [
      'catalog_id' => $catalog_id,
      'pa_id' => $Pa->id,
      'form' => $form,
      'readonly' => $readonly,
    ],
]);

}






  echo '<hr/><hr/>';
  echo '<h3>Executive Summary</h3>';


echo $form->field($assessment_report, 'executive_summary')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
    //    'imageManagerJson' => ['/redactor/upload/image-json'],
      //  'imageUpload' => ['/redactor/upload/image'],
      //  'fileUpload' => ['/redactor/upload/file'],
       // 'lang' => 'zh_cn',
        'plugins' => ['clips', 'fontcolor','fullscreen', 'counter'],
    ]
]);








  echo '<hr/><hr/>';
  echo '<h3>Kekuatan</h3>';
echo $form->field($assessment_report, 'kekuatan')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'plugins' => ['clips', 'fontcolor','fullscreen', 'counter']
    ]
]);

   

  echo '<hr/><hr/>';
  echo '<h3>Kelemahan</h3>';
echo $form->field($assessment_report, 'kelemahan')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'plugins' => ['clips', 'fontcolor','fullscreen', 'counter']
    ]
]);





  echo '<hr/><hr/>';
  echo '<h3>Saran Pengembangan</h3>';
    echo '<strong>A. UNTUK PENUGASAN</strong>';
      echo '<br/><strong>B. UNTUK PENGEMBANGAN DIRI</strong>';
echo $form->field($assessment_report, 'saran_pengembangan')->widget(\yii\redactor\widgets\Redactor::className(), [
    /*'options' => [
      'id' =>'saranpengembangan', 
    'name' =>'saranpengembangan',
  ],
  */
    'clientOptions' => [
    //'minHeight' => 300,
        'plugins' => ['clips', 'fontcolor','fullscreen', 'counter'],
            'counterCallback' => new \yii\web\JsExpression("
                function(data) {
                    console.log('Words: ' + data.words);
                    console.log('Characters: ' + data.characters);
                    console.log('Characters w/o spaces: ' + (data.characters - data.spaces));
                    console.log(this);
                    console.log(this.core.getElement().context.id);
                    $('#hint_' + this.core.getElement().context.id).html('<i>words : ' + data.words + ', characters : ' + (data.characters - data.spaces) + '</i>');

                }
            "),
    ]
]);




//<h3>Saran Pengembangan Sistem</h3>
  // <br/><?php echo $saran_komplit ;




if (isset($result_object)) {
 //echo $this->context->view->viewFile;
 $path_parts = pathinfo($viewFile);
//  echo $path_parts['filename'];
echo $this->render('_'.$path_parts['filename'], ['result_object' => $result_object]);

} else {
  //echo 'NO DATA';
}
  ?>