<?php

namespace app\modules\projects\controllers\project_4;

use Yii;
use app\modules\projects\models\ProjectActivity;
use app\modules\projects\models\ProjectActivityMeta;
use app\modules\projects\models\ProjectActivitySearch;
use app\modules\projects\models\Project;
use app\modules\profile\models\Profile;
use app\modules\profile\models\ProfileMeta;
use app\modules\projects\models\ProjectMeta;
use app\modules\projects\models\ProjectAssessment;
use app\modules\projects\models\ProjectAssessmentResult;
use app\modules\projects\models\ProjectAssessmentResultSearch;

use app\modules\projects\models\ProjectResultSnapshot;
use app\modules\projects\models\ProjectResultSnapshotMeta;
use app\modules\projects\models\Kompetensigram;
use app\modules\projects\models\AssessmentReport;
use app\modules\projects\models\Biodata;
use app\modules\projects\models\ProjectAssessmentMeta;
use common\modules\catalog\models\RefAssessmentDictionary;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use kartik\grid\EditableColumnAction;
use yii\helpers\ArrayHelper;

use common\modules\catalog\models\Catalog;
use common\modules\catalog\models\CatalogMeta;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Expression;
use common\modules\core\models\Log;

use yii\validators\EmailValidator;
use yii\validators\StringValidator;
use yii\helpers\Html;
use yii2tech\html2pdf\Manager;
use yii\data\SqlDataProvider;

use yii\filters\AccessControl;
//use mikehaertl\wkhtmlto\Pdf;
/**
 * ActivityController implements the CRUD actions for Activity model.
 */
class ActivityController extends Controller
{

   public function Actions()
   {
       return ArrayHelper::merge(parent::actions(), [
           'editname' => [                                       // identifier for your editable action
               'class' => EditableColumnAction::className(),     // action class name
               'modelClass' => ProjectActivity::className(),                // the update model class
               'outputValue' => function ($model, $attribute, $key, $index) {
                    $fmt = Yii::$app->formatter;
                    $value = $model->$attribute;                 // your attribute value
                    if ($attribute === 'name') {           // selective validation by attribute
                        //return $fmt->asDecimal($value, 2);       // return formatted value if desired
                        //return json_encode($value);
                        return '';
                    } elseif ($attribute === 'publish_date') {   // selective validation by attribute
                        return $fmt->asDate($value, 'php:Y-m-d');// return formatted value if desired
                    }
                    return '';                                   // empty is same as $value
               },
               'outputMessage' => function($model, $attribute, $key, $index) {
                     return '';                                  // any custom error after model save
               },
               // 'showModelErrors' => true,                     // show model errors after save
               // 'errorOptions' => ['header' => '']             // error summary HTML options
               // 'postOnly' => true,
               // 'ajaxOnly' => true,
               // 'findModel' => function($id, $action) {},
               // 'checkAccess' => function($action, $model) {}
           ],

           'editpsikogram' => [                                       // identifier for your editable action
               'class' => EditableColumnAction::className(),     // action class name
               'modelClass' => ProjectAssessmentResult::className(),                // the update model class
               'outputValue' => function ($model, $attribute, $key, $index) {
                    $fmt = Yii::$app->formatter;
          
                    $value = $model->$attribute;                 // your attribute value
                    if ($attribute === 'value') {           // selective validation by attribute
                        //return $fmt->asDecimal($value, 2);       // return formatted value if desired
                        //return json_encode($value);
                        $radiolistoptions = [1 => '1',2 => '2',3=>'3',4=>'4',5=>'5',6=>'6',7 =>'7'];

                        return Html::RadioList($model->key, $value, $radiolistoptions, [
                                 'item' => function($index, $label, $name, $checked, $value) 
                                    {
                                      $readonly = false;
                                      $aspek = CatalogMeta::find()->andWhere(['type' => 'psikogram'])->andWhere(['key' => 'aspek'])->andWhere(['value' => $name])->One();
                                      $islkj = '';
                                      if ($index == ($aspek->attribute_1-1)) {
                                       // $islkj = 'RadioBox2';
                                        return "<div class='RadioBox2'>".Html::Label(Html::Radio($name,$checked,['class' => 'RadioBox2', 'disabled' => $readonly]) .' '. $label)."</div>";
                                      }
                                  else {
                                                  return "<div class='RadioBox'>".Html::Label(Html::Radio($name,$checked,['class' => 'RadioBox', 'disabled' => $readonly]) .' '. $label)."</div>";
                                                  
                                              }   
                                    },
                                        
                          ]);

                        //return $value;
                    } elseif ($attribute === 'publish_date') {   // selective validation by attribute
                        return $fmt->asDate($value, 'php:Y-m-d');// return formatted value if desired
                    }
                    return 'sasa';                                   // empty is same as $value
               },
               'outputMessage' => function($model, $attribute, $key, $index) {
                     return '';                                  // any custom error after model save
               },
                'showModelErrors' => true,                     // show model errors after save
               // 'errorOptions' => ['header' => '']             // error summary HTML options
               // 'postOnly' => true,
               // 'ajaxOnly' => true,
               // 'findModel' => function($id, $action) {},
               // 'checkAccess' => function($action, $model) {}
           ],
           'editkompetensigram' => [                                       // identifier for your editable action
               'class' => EditableColumnAction::className(),     // action class name
               'modelClass' => ProjectAssessmentResult::className(),                // the update model class
               'outputValue' => function ($model, $attribute, $key, $index) {
                    $fmt = Yii::$app->formatter;
                    $value = $model->$attribute;                 // your attribute value
                    if ($attribute === 'value') {           // selective validation by attribute
                        //return $fmt->asDecimal($value, 2);       // return formatted value if desired
                        //return json_encode($value);
        
      $maxmodel = RefAssessmentDictionary::find()
      ->andWhere(['type' => 'uraian_kompetensigram'])
      ->andWhere(['key' => $model->key . $model->value])
      ->All();
      $size = sizeof($maxmodel);
      $randomizer = 1;
      if ($size > 0) {
      $random =  rand();
      $randomizer = $random % $size;
      $randomizer++;
      //echo 'randomizer : ' . $randomizer
            $model->attribute_1 = (string) $randomizer;
      $model->save();
      }


      
                        return $value;
                    } elseif ($attribute === 'publish_date') {   // selective validation by attribute
                        return $fmt->asDate($value, 'php:Y-m-d');// return formatted value if desired
                    }
                    return '';                                   // empty is same as $value
               },
               'outputMessage' => function($model, $attribute, $key, $index) {
                     return '';                                  // any custom error after model save
               },
               // 'showModelErrors' => true,                     // show model errors after save
               // 'errorOptions' => ['header' => '']             // error summary HTML options
               // 'postOnly' => true,
               // 'ajaxOnly' => true,
               // 'findModel' => function($id, $action) {},
               // 'checkAccess' => function($action, $model) {}
           ],
           'edituraiankompetensigram' => [                                       // identifier for your editable action
               'class' => EditableColumnAction::className(),     // action class name
               'modelClass' => Kompetensigram::className(),                // the update model class
               'outputValue' => function ($model, $attribute, $key, $index) {
                    $fmt = Yii::$app->formatter;
                    $value = $model->$attribute;                 // your attribute value
                    if ($attribute === 'value') {           // selective validation by attribute
                        //return $fmt->asDecimal($value, 2);       // return formatted value if desired
                        //return json_encode($value);
        
                        return $value;
                    } elseif ($attribute === 'publish_date') {   // selective validation by attribute
                        return $fmt->asDate($value, 'php:Y-m-d');// return formatted value if desired
                    }
                    return '';                                   // empty is same as $value
               },
               'outputMessage' => function($model, $attribute, $key, $index) {
                     return '';                                  // any custom error after model save
               },
               // 'showModelErrors' => true,                     // show model errors after save
               // 'errorOptions' => ['header' => '']             // error summary HTML options
               // 'postOnly' => true,
               // 'ajaxOnly' => true,
               // 'findModel' => function($id, $action) {},
               // 'checkAccess' => function($action, $model) {}
           ]


       ]);
   }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
                  'access' => [
                'class' => AccessControl::className(),
                'only' => ['cakimpdf'],
                'rules' => [
                    [
                        'actions' => ['cakimpdf'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['cakimpdf'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }





    /**
     * Lists all Activity models.
     * @return mixed
     */
    public function actionIndex($id)
    {

        
        
        $searchModel = new ProjectActivitySearch();
        $params = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function initAssessment($id, $catalog_id)
    {
      $assessment = ProjectAssessment::find()->andWhere(['activity_id' => $id])->andWhere(['status' => 'active'])
      ->andWhere(['catalog_id' => $catalog_id])
      ->One();
      if (null !== $assessment) {
        $metas = CatalogMeta::find()->andWhere(['catalog_id' => $catalog_id])->All();

        foreach ($metas as $meta_key => $meta_value) {
          # code...
          //echo $meta_key . ': ' . $meta_value->type . ' : ' . $meta_value->key . ' ----> ' . $meta_value->value;
          //echo '<br/>';
          $result = ProjectAssessmentResult::find()->andWhere(['project_assessment_id' => $assessment->id])
          ->andWhere(['type' => $meta_value->type])
          ->andWhere(['key' => $meta_value->value])->One();

          if (null !== $result){

          } else {
            $newresult = new ProjectAssessmentResult();
            $newresult->type  = $meta_value->type;
            $newresult->key = $meta_value->value;
            $newresult->project_assessment_id = $assessment->id;
            $newresult->save();

          }

        }
          //return $assessment->id;
     //   $ProjectAssessmentResult::find()->andWhere(['']);
      } else{

          echo 'ASSESSMENT NOT FOUND: catalog_id mismath. catalog_id  should be : ' . $catalog_id;
      }
    }
    public function actionActivate($id)
    {
        /**
        1. change status to active
        2. send notification to page
        3. send notification by email

        */

    }


    /**
     * Displays a single Activity model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {


        $data = [];
         $assessment_report = new AssessmentReport();
         $biodata = new Biodata();
        $model = $this->findModel($id);

        $profi = Profile::find()->andWhere(['user_id' => Yii::$app->user->id])->One();
        $is_assessor = ProjectActivityMeta::find()
        ->andWhere(['project_activity_id' => $id])
        ->andWhere(['type' => 'general'])
        //->andWhere(['key' => 'assessor'])
        ->andWhere(['value' => $profi->id])->One();


        $assessee_model= ProjectActivityMeta::find()
        ->andWhere(['project_activity_id' => $id])
        ->andWhere(['type' => 'general'])
        ->andWhere(['key' => 'assessee'])->One();


            $model2 = new ProjectActivity;
            $uraian_model = new ProjectAssessmentResult;

        //SATU PROJECT SATU ASSESSMENT MODEL
            $project_assessment_model = ProjectAssessment::find()
                                        ->andWhere(['activity_id' => $id])
                                        ->andWhere(['status' => 'active'])
                                        ->One();

          $catalog = $project_assessment_model->catalog_id;
          $data['activity_id'] = $_GET['id'];
          $data['assessment_id'] = $project_assessment_model->id;
          $data['catalog_id'] = $catalog;

        
          $catalog_metas = CatalogMeta::find()->andWhere(['catalog_id' => $catalog])
            ->orderBy(['type'=>SORT_ASC, 'attribute_3'=>SORT_ASC])->All();

          $profile_metas = ProfileMeta::find()->andWhere(['profile_id' => $assessee_model->value])->All();

          $assessee_profile = Profile::findOne($assessee_model->value);
          $data['profile']['id'] = $assessee_profile->id;
          $data['profile']['first_name'] = $assessee_profile->first_name;
          $data['profile']['birthdate'] = $assessee_profile->birthdate;
          $data['profile']['gender'] = $assessee_profile->gender;

            foreach ($profile_metas as $cm_key => $cm_value) {;
                if ($cm_value['type'] == 'work'){
                    $data['profile'][$cm_value['key']] = $cm_value['value'];
                } 

                if ($cm_value['type'] == 'address'){
                    $data['profile'][$cm_value['key']] = $cm_value['value'];
                } 

                if ($cm_value['type'] == 'education'){
                    $data['profile'][$cm_value['key']] = $cm_value['value'];
                }
            }


 $uraian_saran_model = ProjectAssessmentResult::find()
                  ->andWhere(['project_assessment_id' => $project_assessment_model->id])
 ->andWhere(['type' => 'uraian_setneg'])
 ->andWhere(['key' => 'saran'])
 ->One();

if (null !== $uraian_saran_model)
{
  $data['uraian_saran'] = $uraian_saran_model->textvalue;

} else {
  $data['uraian_saran'] = '';
}

            foreach ($catalog_metas as $cm_key => $cm_value) {
                if ($cm_value['type'] == 'kompetensi_setneg'){
                    //$newdata = new ProjectAssessmentResult;
                  $lki = ProjectAssessmentResult::find()
                  ->andWhere(['project_assessment_id' => $project_assessment_model->id])
                  ->andWhere(['type' => 'kompetensi_setneg'])->andWhere(['key' => $cm_value['value']])->One();
                    if (null !== $lki) {
                      $data['kompetensigram']['lki'][$cm_value['value']] = $lki->value;
 /*$uraian_kompetensi_model = ProjectAssessmentResult::find()
                  ->andWhere(['project_assessment_id' => $project_assessment_model->id])
 ->andWhere(['type' => 'uraian_kompetensi_setneg'])
 ->andWhere(['key' => $cm_value['value']])
 ->andWhere(['value' => $lki->value])
 ->One();

 if(null == $uraian_kompetensi_model)
 {
  $uraian_kompetensi = '';
 } else {
  $uraian_kompetensi = $uraian_kompetensi_model->attribute_1;
 }
 */
                       $data['kompetensigram']['evidence'][$cm_value['value']] = $lki->attribute_1;
                    } else {
                       $data['kompetensigram']['lki'][$cm_value['value']] = 0;
                    }
                   
                    $data['kompetensigram']['lkj'][$cm_value['value']] = $cm_value['attribute_1'];
                }
            }


            foreach ($catalog_metas as $cm_key => $cm_value) {
                if ($cm_value['type'] == 'psikogram_setneg'){
 $lki = ProjectAssessmentResult::find()
                  ->andWhere(['project_assessment_id' => $project_assessment_model->id])
 ->andWhere(['type' => 'psikogram_setneg'])->andWhere(['key' => $cm_value['value']])->One();
                    if (null !== $lki) {
                      $data['psikogram']['lki'][$cm_value['value']] = $lki->value;
                    } else {
                       $data['psikogram']['lki'][$cm_value['value']] = 0;
                    }
                    $data['psikogram']['lkj'][$cm_value['value']] = $cm_value['attribute_1'];
                }
            }

            foreach ($catalog_metas as $cm_key => $cm_value) {
                if ($cm_value['type'] == 'uraian_setneg'){
                    $uraian = ProjectAssessmentResult::find()
                  ->andWhere(['project_assessment_id' => $project_assessment_model->id])
                    ->andWhere(['type' => $cm_value['type']])
                    ->andWhere(['key' => $cm_value['value']])->One();
                    if (null !== $uraian) {
                    $data['uraian'][$cm_value['value']] = $uraian->textvalue;
                  // echo 'ada';
                    } else {
                      $data['uraian'][$cm_value['value']] = '';
                      
                    }
                    $assessment_report->$cm_value['value'] = $data['uraian'][$cm_value['value']];

                } else {
                //  echo $cm_value['type'];
                  //echo $cm_key;
                  //echo '<br/>';
                }
            }






    if (isset($_POST['assessment-form'])) {

echo 'POST';
} else {


//echo '<pre>';
//echo sizeof($catalog_metas);
//echo $catalog;
/*foreach ($catalog_metas as $cmkey => $cmvalue) {
  echo $cmvalue->type . ' : ' . $cmvalue->key;
  echo '<br/>';
  # code...
}
*/
//print_r($data);

            return $this->render('../../activity/4/view', [
                'model' => $model,
                'biodata' => $biodata,
 'assessment_report' => $assessment_report,
                'catalog_metas' => $catalog_metas,
                'data' => $data,
            ]);

            

        }


  }



    public function actionPrinter($id)
    {


        $data = [];
         $assessment_report = new AssessmentReport();
         $biodata = new Biodata();
        $model = $this->findModel($id);

        $profi = Profile::find()->andWhere(['user_id' => Yii::$app->user->id])->One();
        $is_assessor = ProjectActivityMeta::find()
        ->andWhere(['project_activity_id' => $id])
        ->andWhere(['type' => 'general'])
        //->andWhere(['key' => 'assessor'])
        ->andWhere(['value' => $profi->id])->One();


        $assessee_model= ProjectActivityMeta::find()
        ->andWhere(['project_activity_id' => $id])
        ->andWhere(['type' => 'general'])
        ->andWhere(['key' => 'assessee'])->One();


            $model2 = new ProjectActivity;
            $uraian_model = new ProjectAssessmentResult;

        //SATU PROJECT SATU ASSESSMENT MODEL
            $project_assessment_model = ProjectAssessment::find()
                                        ->andWhere(['activity_id' => $id])
                                        ->andWhere(['status' => 'active'])
                                        ->One();

          $catalog = $project_assessment_model->catalog_id;
          $data['activity_id'] = $_GET['id'];
          $data['assessment_id'] = $project_assessment_model->id;
          $data['catalog_id'] = $catalog;

        
          $catalog_metas = CatalogMeta::find()->andWhere(['catalog_id' => $catalog])
            ->orderBy(['type'=>SORT_ASC, 'attribute_3'=>SORT_ASC])->All();

          $profile_metas = ProfileMeta::find()->andWhere(['profile_id' => $assessee_model->value])->All();

          $assessee_profile = Profile::findOne($assessee_model->value);
          $data['profile']['id'] = $assessee_profile->id;
          $data['profile']['first_name'] = $assessee_profile->first_name;
          $data['profile']['birthdate'] = $assessee_profile->birthdate;
          $data['profile']['gender'] = $assessee_profile->gender;

            foreach ($profile_metas as $cm_key => $cm_value) {;
                if ($cm_value['type'] == 'work'){
                    $data['profile'][$cm_value['key']] = $cm_value['value'];
                } 

                if ($cm_value['type'] == 'address'){
                    $data['profile'][$cm_value['key']] = $cm_value['value'];
                } 

                if ($cm_value['type'] == 'education'){
                    $data['profile'][$cm_value['key']] = $cm_value['value'];
                }
            }



            foreach ($catalog_metas as $cm_key => $cm_value) {
                if ($cm_value['type'] == 'kompetensi_setneg'){
                    //$newdata = new ProjectAssessmentResult;
                  $lki = ProjectAssessmentResult::find()
                  ->andWhere(['project_assessment_id' => $project_assessment_model->id])
                  ->andWhere(['type' => 'kompetensi_setneg'])->andWhere(['key' => $cm_value['value']])->One();
                    if (null !== $lki) {
                      $data['kompetensigram']['lki'][$cm_value['value']] = $lki->value;
                      /** 
                      @nirwan dibawah harus diganti
                      */
 $uraian_kompetensi_model = ProjectAssessmentResult::find() 
                  ->andWhere(['project_assessment_id' => $project_assessment_model->id])
 ->andWhere(['type' => 'uraian_kompetensi_setneg'])
 ->andWhere(['key' => $cm_value['value']])
 ->andWhere(['value' => $lki->value])
 ->One();

 if(null == $uraian_kompetensi_model)
 {
  $uraian_kompetensi = '';
 } else {
  $uraian_kompetensi = $uraian_kompetensi_model->attribute_1;
 }
                       $data['kompetensigram']['evidence'][$cm_value['value']] = $uraian_kompetensi;
                    } else {
                       $data['kompetensigram']['lki'][$cm_value['value']] = 0;
                    }
                   
                    $data['kompetensigram']['lkj'][$cm_value['value']] = $cm_value['attribute_1'];
                }
            }


            foreach ($catalog_metas as $cm_key => $cm_value) {
                if ($cm_value['type'] == 'psikogram_setneg'){
 $lki = ProjectAssessmentResult::find()
                  ->andWhere(['project_assessment_id' => $project_assessment_model->id])
 ->andWhere(['type' => 'psikogram_setneg'])->andWhere(['key' => $cm_value['value']])->One();
                    if (null !== $lki) {
                      $data['psikogram']['lki'][$cm_value['value']] = $lki->value;
                    } else {
                       $data['psikogram']['lki'][$cm_value['value']] = 0;
                    }
                    $data['psikogram']['lkj'][$cm_value['value']] = $cm_value['attribute_1'];
                }
            }

            foreach ($catalog_metas as $cm_key => $cm_value) {
                if ($cm_value['type'] == 'uraian_setneg'){
                    $uraian = ProjectAssessmentResult::find()
                  ->andWhere(['project_assessment_id' => $project_assessment_model->id])
                    ->andWhere(['type' => $cm_value['type']])
                    ->andWhere(['key' => $cm_value['value']])->One();
                    if (null !== $uraian) {
                    $data['uraian'][$cm_value['value']] = $uraian->textvalue;
                    } else {
                      $data['uraian'][$cm_value['value']] = '';
                    }
                    $assessment_report->$cm_value['value'] = $data['uraian'][$cm_value['value']];

                }
            }






    if (isset($_POST['assessment-form'])) {

echo 'POST';
} else {


            return $this->render('../../activity/4/print', [
                'model' => $model,
                'biodata' => $biodata,
 'assessment_report' => $assessment_report,
                'catalog_metas' => $catalog_metas,
                'data' => $data,
            ]);

        }


  }



public function actionValidateuraian($uraian)
{
    $model = DynamicModel::validateData(compact('uraian'), [
        [['name'], 'string', 'min' => 200,'max' => 1280],
        
    ]);

    if ($model->hasErrors()) {
        // validation fails
        echo 'ERROR';
    } else {
        // validation succeeds
        return true;
    }
}


  public function actionSaves($id)
  {




  }

    public function Snapshot($id, $type)
    {
      $snapshot_data = ProjectAssessmentResult::find()->andWhere(['project_assessment_id' => $id])->All();

        $new_snapshot = new ProjectResultSnapshot;
        $new_snapshot->project_assessment_id = $id;
        $new_snapshot->snapshot_type = $type;

        $new_snapshot->created_at = new Expression('NOW()');
        $new_snapshot->save();

        $user_save = new ProjectResultSnapshotMeta;
        $user_save->project_result_snapshot_id = $new_snapshot->id;
        $user_save->type = 'subject';
        $user_save->key = 'user_id';
        $user_save->value = (string) Yii::$app->user->id;
                $user_save->save();

      foreach ($snapshot_data as $key => $value) {
        $new_result_snapshot = new ProjectResultSnapshotMeta;
        $new_result_snapshot->project_result_snapshot_id = $new_snapshot->id;
        $new_result_snapshot->type = $value->type;
        $new_result_snapshot->key = $value->key;
        $new_result_snapshot->value = $value->value;
        $new_result_snapshot->textvalue = $value->textvalue;
        $new_result_snapshot->attribute_1 = $value->attribute_1;
        $new_result_snapshot->attribute_2 = $value->attribute_2;
        $new_result_snapshot->attribute_3 = $value->attribute_3;
        $new_result_snapshot->save();
        

      }
      
    }


    public function actionSavereview3($id ,$status)
    {

      echo '<br/><br/><br/><br/>';
      echo '<h1>Data dibawah sukses tersimpan. harap diperiksa</h1>';
      echo '<br/>';
      echo '<pre>';
print_r($_POST);
echo '</pre>';

}
    public function actionSavereview($id ,$status)
    {

      echo '<br/><br/><br/><br/>';
      echo '<h1>Data dibawah sukses tersimpan. harap diperiksa</h1>';
      echo '<br/>';
      echo '<pre>';
print_r($_POST);
echo '</pre>';

//echo $status;

$post = $_POST;

$project_assessment = ProjectAssessment::find()->andWhere(['activity_id' => $id])->All();
$profile_id = ProjectActivityMeta::find()
->andWhere(['project_activity_id' => $id])
->andWhere(['type' => 'general'])
->andWhere(['key' => 'assessee'])
->One();
$profile = Profile::findOne($profile_id->value);
if (sizeof($project_assessment) == 1) {


/**** SAVE ASSESSMENT REPORT ****/
if (isset($post['AssessmentReport'])){
foreach ($post['AssessmentReport'] as $post_key => $post_value) {
  $result_to_save = ProjectAssessmentResult::find()
  ->andWhere(['project_assessment_id' => $project_assessment[0]->id])
  ->andWhere(['type' => 'uraian_setneg'])
  ->andWhere(['key' => $post_key])->One();
  if (null !== $result_to_save)
  {
    $result_to_save->textvalue = $post_value;
  } else {
    $result_to_save = new ProjectAssessmentResult();
    $result_to_save->type = 'uraian_setneg';
    $result_to_save->key = $post_key;
    $result_to_save->textvalue = $post_value;
    $result_to_save->project_assessment_id = $project_assessment[0]->id;
  }
  if ($result_to_save->save())
  {
  } else {
    echo '<br/>uraian_setneg ('.$post_key.') harap diisi dengan value yang valid';
  }
}

}

/**** SAVE KOMPETENSIGRAM ****/
if (isset($post['kompetensigram'])){
foreach ($post['kompetensigram'] as $post_key => $post_value) {
  $result_to_save = ProjectAssessmentResult::find()
  ->andWhere(['project_assessment_id' => $project_assessment[0]->id])
  ->andWhere(['type' => 'kompetensi_setneg'])
  ->andWhere(['key' => $post_key])->One();
  if (null !== $result_to_save)
  {
    if ($result_to_save->value == $post_value)
    { //IF LKI DOESNT CHANGE THEN SAVE EVIDENCE

  if (isset($post['evidence'][$post_key.$post_value])) {
        $result_to_save->attribute_1 = serialize($post['evidence'][$post_key.$post_value]);
        } 
  if (isset($post['uraiankompetensigram_' . $post_key])) {
   $result_to_save->textvalue = $post['uraiankompetensigram_' . $post_key];
    } 
 


    } else {
    $result_to_save->value = $post_value;
    $result_to_save->attribute_1 = null;
  }





  } else {
    $result_to_save = new ProjectAssessmentResult();
    $result_to_save->type = 'kompetensi_setneg';
    $result_to_save->key = $post_key;
    $result_to_save->value = $post_value;
  //  $result_to_save->textvalue = $post['uraiankompetensigram_' . $post_key];
    $result_to_save->project_assessment_id = $project_assessment[0]->id;


  if (isset($post['evidence'][$post_key.$post_value])) {
$result_to_save->attribute_1 = serialize($post['evidence'][$post_key.$post_value]);
} 
  if (isset($post['uraiankompetensigram_' . $post_key])) {
   $result_to_save->textvalue = $post['uraiankompetensigram_' . $post_key];
    } 
 

  }



  if ($result_to_save->save())
  {
  } else {
    echo '<br/>kompetensi_setneg ('.$post_key.') harap diisi dengan value yang valid';
  }
}
}


/**** SAVE evidence KOMPETENSIGRAM ****/
/*if (isset($post['evidence'])){
foreach ($post['evidence'] as $post_key => $post_value) {
  $result_to_save = ProjectAssessmentResult::find()
  ->andWhere(['project_assessment_id' => $project_assessment[0]->id])
  ->andWhere(['type' => 'kompetensi_setneg'])
  ->andWhere(['key' => substr($post_key, 0, -1)])->One();
  if (null !== $result_to_save)
  {
    $result_to_save->value = substr($post_key, -1);
    if(isset($post['uraiankompetensigram_' . substr($post_key, 0, -1)])) {
    $result_to_save->textvalue = $post['uraiankompetensigram_' . substr($post_key, 0, -1)];
    } else {
          //$result_to_save->textvalue = $post['uraiankompetensigram_' . substr($post_key, 0, -1)];
    }
    $result_to_save->attribute_1 = serialize($post_value);
  } else {
    $result_to_save = new ProjectAssessmentResult();
    $result_to_save->type = 'kompetensi_setneg';
    $result_to_save->key = substr($post_key, 0, -1);
    //$array = ArrayHelper::getColumn($post_value, 'id');

    $result_to_save->value = substr($post_key,-1);
    if(isset($post['uraiankompetensigram_' . substr($post_key, 0, -1)])) {
    $result_to_save->textvalue = $post['uraiankompetensigram_' . substr($post_key, 0, -1)];
    } else {
          //$result_to_save->textvalue = $post['uraiankompetensigram_' . substr($post_key, 0, -1)];
    }

    $result_to_save->attribute_1 = serialize($post_value);
    $result_to_save->project_assessment_id = $project_assessment[0]->id;
  }
  if ($result_to_save->save())
  {
  } else {
    echo '<br/>uraian_kompetensi_setneg ('.$post_key.') harap diisi dengan value yang valid';
  }
}
}
*/

/**** SAVE PSIKOGRAM ****/
if (isset($post['psikogram'])){
foreach ($post['psikogram'] as $post_key => $post_value) {
  $result_to_save = ProjectAssessmentResult::find()
  ->andWhere(['project_assessment_id' => $project_assessment[0]->id])
  ->andWhere(['type' => 'psikogram_setneg'])
  ->andWhere(['key' => $post_key])->One();
  if (null !== $result_to_save)
  {
    $result_to_save->value = $post_value;
  } else {
    $result_to_save = new ProjectAssessmentResult();
    $result_to_save->type = 'psikogram_setneg';
    $result_to_save->key = $post_key;
    $result_to_save->value = $post_value;
    $result_to_save->project_assessment_id = $project_assessment[0]->id;
  }
  if ($result_to_save->save())
  {
  } else {
    echo '<br/>psikogram_setneg ('.$post_key.') harap diisi dengan value yang valid';
  }
}
}

$education = ['latest_education'];
$work = ['rumpun','current_position','golongan','level','nip'];
$personal = ['birthplace'];
$contact = ['home_address'];


/**** SAVE BIODATA ****/
if (isset($post['Biodata'])){
foreach ($post['Biodata'] as $post_key => $post_value) {

  if(in_array($post_key, $education)) {
   // echo '[education]' . $post_value;
    $to_save = ProfileMeta::find()
    ->andWhere(['profile_id' => $profile->id])
    ->andWhere(['type' => 'education'])->andWhere(['key' => $post_key])->One();
    if (null == $to_save) {
      $to_save = new ProfileMeta();
      $to_save->profile_id = $profile->id;
      $to_save->type = 'education';
      $to_save->key = $post_key;
    }
      $to_save->value = $post_value;
  } else if(in_array($post_key, $work)) {
   // echo '[work]' . $post_value;
    $to_save = ProfileMeta::find()
    ->andWhere(['profile_id' => $profile->id])
    ->andWhere(['type' => 'work'])->andWhere(['key' => $post_key])->One();
    if (null == $to_save) {
      $to_save = new ProfileMeta();
      $to_save->profile_id = $profile->id;
      $to_save->type = 'work';
      $to_save->key = $post_key;
    }
      $to_save->value = $post_value;
  } else if(in_array($post_key, $personal)) {
    //echo '[personal]' . $post_value;
    $to_save = ProfileMeta::find()
    ->andWhere(['profile_id' => $profile->id])
    ->andWhere(['type' => 'personal'])->andWhere(['key' => $post_key])->One();
    if (null == $to_save) {
      $to_save = new ProfileMeta();
      $to_save->profile_id = $profile->id;
      $to_save->type = 'personal';
      $to_save->key = $post_key;
    }
      $to_save->value = $post_value;
  } else if(in_array($post_key, $contact)) {
   // echo '[contact]' . $post_value;
    $to_save = ProfileMeta::find()
    ->andWhere(['profile_id' => $profile->id])
    ->andWhere(['type' => 'contact'])->andWhere(['key' => $post_key])->One();
    if (null == $to_save) {
      $to_save = new ProfileMeta();
      $to_save->profile_id = $profile->id;
      $to_save->type = 'contact';
      $to_save->key = $post_key;
    }
      $to_save->value = $post_value;
  } else {

  }

  if($to_save->save()){

  //    echo $post_key . ':' . $to_save->value;
  } else {
    echo '<br/>biodata ('.$post_key.') harap diisi dengan value yang valid';
  }




}
}


/**** SAVE PROFILE ****/
if (isset($post['Profile'])){
foreach ($post['Profile'] as $post_key => $post_value) {

    $profile->$post_key = $post_value;
        if ($profile->save())
        {
        } else {
    echo '<br/>profile ('.$post_key.') harap diisi dengan value yang valid';
        }
}
}


/**** SAVE SARAN URAIAN****/

if (isset($post['uraian_saran'])){
  $post_value = $post['uraian_saran'];
  $result_to_save = ProjectAssessmentResult::find()
  ->andWhere(['project_assessment_id' => $project_assessment[0]->id])
  ->andWhere(['type' => 'uraian_setneg'])
  ->andWhere(['key' => 'saran'])->One();
  if (null !== $result_to_save)
  {
    $result_to_save->textvalue = $post_value;
  } else {
    $result_to_save = new ProjectAssessmentResult();
    $result_to_save->type = 'uraian_setneg';
    $result_to_save->key = 'saran';
    $result_to_save->textvalue = $post_value;
    $result_to_save->project_assessment_id = $project_assessment[0]->id;
  }
  if ($result_to_save->save())
  {
  } else {
    echo '<br/>uraian_setneg ('.$post_key.') harap diisi dengan value yang valid';
  }


}

/**** SAVE ACTIVITY STATUS ****/

$assessment_status = ProjectActivityMeta::find()
->andWhere(['project_activity_id' => $id])
->andWhere(['type' => 'assessment'])
->andWhere(['key' => 'status'])
->One();

$assessment_status->value = $status;

        if ($assessment_status->save())
        {
        } else {
    echo '<br/>assessment_status ('.$status.') harap diisi dengan value yang valid';
        }


/**** SAVE ACTIVITY STATUS TIMESTAMP ****/
$status_log = ProjectActivityMeta::find()
->andWhere(['project_activity_id' => $id])
->andWhere(['type' => 'log'])
->andWhere(['key' => $status])
->One();
    if (null == $status_log) {
      $status_log = new ProjectActivityMeta();
      $status_log->project_activity_id = $id;
      $status_log->type = 'log';
      $status_log->key = $status;
    }

$expression = new Expression('NOW()');
$now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW();
$status_log->value = $now; 

        if ($status_log->save())
        {
             //echo 'save status log SUCCESS';
        } else {
          echo 'save status log FAILED';
  
          echo '<br/>';
          print_r($status_log->errors);
        }




            return $this->render('../../activity/4/savereview', [
            //    'model' => $model,
            ]);



} else {
  echo 'JUMLAH ASSESSMENT SALAH';
}





    }

    public function Save($id, $post)
    {

$stringvalidator = new StringValidator();
$stringvalidator->max = 30000;
$stringvalidator->min = 500;
$stringvalidator->tooLong ="terlalu panjang";
$stringvalidator->tooShort ="terlalu pendek";

      $errorexist = 0;
              $activi = ProjectActivityMeta::find()
              ->andWhere(['project_activity_id' => $id])
              ->andWhere(['type' => 'general'])
              ->andWhere(['key' => 'assessee'])
              ->One();
                $assessee_prof = Profile::findOne($activi->value);
        if (isset($post['Profile'])) {
                $assessee_prof->birthdate = $post['Profile']['birthdate'];
                $assessee_prof->first_name = $post['Profile']['first_name'];
                $assessee_prof->save();
             }

        if (isset($_POST['ProfileMeta'])) {
              $birthplace = ProfileMeta::find()
              ->andWhere(['profile_id' => $assessee_prof->id])
              ->andWhere(['type' => 'personal'])
              ->andWhere(['key' => 'birthplace'])
              ->One();
              if (null !== $birthplace) {
                $birthplace->value = $post['ProfileMeta']['value'];
                $birthplace->save();
             } else {
                $newbirthplace = new ProfileMeta();
                $newbirthplace->type = 'personal';
                $newbirthplace->key = 'birthplace';
                $newbirthplace->profile_id = $assessee_prof->id;
                $newbirthplace->value = $post['ProfileMeta']['value'];
                $newbirthplace->save();

             }
           }


        if (isset($_POST['AssessmentReport'])) {
            $project_assessment = ProjectAssessment::find()->andWhere(['activity_id' => $id])->One();
            $exec_summary = ProjectAssessmentResult::find()
            ->andWhere(['project_assessment_id' => $project_assessment->id])
            ->andWhere(['type' => 'executive_summary'])->One();

            $kekuatan = ProjectAssessmentResult::find()
            ->andWhere(['project_assessment_id' => $project_assessment->id])
            ->andWhere(['type' => 'kekuatan'])->One();

            $kelemahan = ProjectAssessmentResult::find()
            ->andWhere(['project_assessment_id' => $project_assessment->id])
            ->andWhere(['type' => 'kelemahan'])->One();


            $saran_pengembangan = ProjectAssessmentResult::find()
            ->andWhere(['project_assessment_id' => $project_assessment->id])
            ->andWhere(['type' => 'saran_pengembangan'])->One();

                    $address = ProfileMeta::find()
                    ->andWhere(['profile_id' => $assessee_prof->id])
                    ->andWhere(['type' => 'address'])
                    ->andWhere(['key' => 'home_address'])->One();


                    $latest_education = ProfileMeta::find()
                    ->andWhere(['profile_id' => $assessee_prof->id])
                    ->andWhere(['type' => 'education'])
                    ->andWhere(['key' => 'latest'])->One();

                    $current_position = ProfileMeta::find()
                    ->andWhere(['profile_id' => $assessee_prof->id])
                    ->andWhere(['type' => 'work'])
                    ->andWhere(['key' => 'current_position'])->One();

                    $satuan_kerja = ProfileMeta::find()
                    ->andWhere(['profile_id' => $assessee_prof->id])
                    ->andWhere(['type' => 'work'])
                    ->andWhere(['key' => 'satuan_kerja'])->One();



            if (null !== $address) {
                $address->value = $post['AssessmentReport']['alamat'];
                $address->save();
            } else {
                $address = new ProfileMeta();
                $address->type = 'address';
                $address->key = 'home_address';
                $address->value = $post['AssessmentReport']['alamat'];
                $address->save();
            }

            if (null !== $latest_education) {
                $latest_education->value = $post['AssessmentReport']['pendidikan_terakhir'];
                $latest_education->save();
            } else {
                $latest_education = new ProfileMeta();
                $latest_education->type = 'education';
                $latest_education->key = 'latest';
                $latest_education->value = $post['AssessmentReport']['pendidikan_terakhir'];
                $latest_education->save();
            }

            if (null !== $current_position) {
                $current_position->value = $post['AssessmentReport']['current_position'];
                $current_position->save();
            } else {
                $current_position = new ProfileMeta();
                $current_position->type = 'work';
                $current_position->key = 'current_position';
                $current_position->value = $post['AssessmentReport']['current_position'];
                $current_position->save();
            }

            if (null !== $satuan_kerja) {
                $satuan_kerja->value = $post['AssessmentReport']['satuan_kerja'];
                $satuan_kerja->save();
            } else {
                $satuan_kerja = new ProfileMeta();
                $satuan_kerja->type = 'work';
                $satuan_kerja->key = 'satuan_kerja';
                $satuan_kerja->value = $post['AssessmentReport']['satuan_kerja'];
                $satuan_kerja->save();
            }


            if (null !== $exec_summary) {
                $exec_summary->textvalue = $post['AssessmentReport']['executive_summary'];

            } else {
                $exec_summary = new ProjectAssessmentResult();
                $exec_summary->project_assessment_id = $project_assessment->id;
                $exec_summary->type = 'executive_summary';
                $exec_summary->textvalue = $post['AssessmentReport']['executive_summary'];

            }
 //$exec_summary_stripped = ;
            if ($stringvalidator->validate(str_replace(' ','',strip_tags($exec_summary->textvalue)) , $error)) {
              $exec_summary->save();
              } else {
                $errorexist++;
           Yii::$app->session->addFlash('warning', 'uraian exec_summary ' . $error . ' : jumlah karakter ' . strlen(str_replace(' ','',strip_tags($exec_summary->textvalue))));
              if ($error == 'terlalu panjang' || $error == 'terlalu pendek')
                  {
                    $exec_summary->save();
              
                  }
              }

            if (null !== $kekuatan) {
                $kekuatan->textvalue = $post['AssessmentReport']['kekuatan'];
            } else {
                $kekuatan = new ProjectAssessmentResult();
                $kekuatan->project_assessment_id = $project_assessment->id;
                $kekuatan->type = 'kekuatan';
                $kekuatan->textvalue = $post['AssessmentReport']['kekuatan'];
            }

            if ($stringvalidator->validate(str_replace(' ','',strip_tags($kekuatan->textvalue)), $error)) {
              $kekuatan->save();
              } else {
                $errorexist++;
                  Yii::$app->session->addFlash('warning', 'uraian kekuatan ' . $error . ' : jumlah karakter ' . strlen(str_replace(' ','',strip_tags($kekuatan->textvalue))));
                  if ($error == 'terlalu panjang' || $error == 'terlalu pendek')
                  {
                    $kekuatan->save();
                  
                  }
              }

            if (null !== $kelemahan) {
                $kelemahan->textvalue = $post['AssessmentReport']['kelemahan'];

            } else {
                $kelemahan = new ProjectAssessmentResult();
                $kelemahan->project_assessment_id = $project_assessment->id;
                $kelemahan->type = 'kelemahan';
                $kelemahan->textvalue = $post['AssessmentReport']['kelemahan'];
   
            }
            if ($stringvalidator->validate(str_replace(' ','',strip_tags($kelemahan->textvalue)), $error)) {
              $kelemahan->save();
              } else {
                $errorexist++;
           Yii::$app->session->addFlash('warning', 'uraian kelemahan ' . $error . ' : jumlah karakter ' . strlen(str_replace(' ','',strip_tags($kelemahan->textvalue))));
              if ($error == 'terlalu panjang' || $error == 'terlalu pendek')
                  {
                    $kelemahan->save();
                   
                  }
              }


            if (null !== $saran_pengembangan) {
                $saran_pengembangan->textvalue = $post['saranpengembangan'];

            } else {
                $saran_pengembangan = new ProjectAssessmentResult();
                $saran_pengembangan->project_assessment_id = $project_assessment->id;
                $saran_pengembangan->type = 'saran_pengembangan';
                $saran_pengembangan->textvalue = $post['saranpengembangan'];

            }

            if ($stringvalidator->validate(str_replace(' ','',strip_tags($saran_pengembangan->textvalue)), $error)) {
              $saran_pengembangan->save();
              } else {
                $errorexist++;
           Yii::$app->session->addFlash('warning', 'uraian saran_pengembangan ' . $error . ' : jumlah karakter ' . strlen(str_replace(' ','',strip_tags($saran_pengembangan->textvalue))));
              if ($error == 'terlalu panjang' || $error == 'terlalu pendek')
                  {
                    $saran_pengembangan->save();

                  }
              }
        }
         
            foreach ($post as $key => $value) {
                $keyx = explode('_', $key);
                //echo $key;
                //echo '<br/>';
                if ($keyx[0] == 'uraiankompetensigram')
                {
                    echo $keyx[1];
                    $project_assessment = ProjectAssessment::find()->andWhere(['activity_id' => $id])->One();
                    $result = Kompetensigram::find()
                    ->andWhere(['project_assessment_id' => $project_assessment->id])
                    ->andWhere(['type'=>'kompetensigram'])->andWhere(['key' => $keyx[1]])->One();



                                if (null !== $result) {
                                    $result->textvalue = $value;
                            
                                } else {
                                    $result = new Kompetensigram();
                                    $result->project_assessment_id = $project_assessment->id;
                                    $result->type = 'kompetensigram';
                                    $result->key = $keyx[1];
                                    $result->textvalue = $value;
                     
                                }
            if ($stringvalidator->validate(str_replace(' ','',strip_tags($result->textvalue)), $error)) {
              //echo 'uraian kesave';
              $result->save();
              } else {
                //echo 'uraian ga kesave';
                $errorexist++;
           Yii::$app->session->addFlash('warning', 'uraian '. $result->key .' ' . $error . ' : jumlah karakter ' . strlen(str_replace(' ','',strip_tags($result->textvalue))));
              if ($error == 'terlalu panjang' || $error == 'terlalu pendek')
                  {
                    $result->save();
                  }
              }
                }
           
            }

return $errorexist;


    }

    public function actionSoreturned($id)
    {

              if(isset($_POST)){
            $errorexist = $this->save($id, $_POST);
            $newlog = new Log();
        $newlog->user_id = Yii::$app->user->id;
        $newlog->controller = 'activity';
        $newlog->action = 'so_returned';
        $newlog->type = 'assessment';
  $newlog->timestamp = new Expression('NOW()');
  $newlog->save();



    $activity_status = ProjectActivityMeta::find()->andWhere(['project_activity_id' => $id])
    ->andWhere(['type' => 'assessment'])
            ->andWhere(['key' => 'status'])->One();
            
//echo '<br/>errro : ' . $errorexist;
            
          if ($errorexist > 0) {
Yii::$app->session->addFlash('danger', 'Status belum berubah. jumlah requirement yang belum terpenuhi = ' . $errorexist);
          } else {
                        if (null !== $activity_status) {
                $activity_status->value = 'so_returned';
                $activity_status->save();
            } else {
                $activity_status = new ProjectActivityMeta();
                $activity_status->project_activity_id = $id;
                $activity_status->type = 'assessment';
                $activity_status->key = 'status';
                $activity_status->value = 'so_returned';
                $activity_status->save();
            }

            $assessment = ProjectAssessment::find()->andWhere(['activity_id' => $id])->One();
            $this->snapshot($assessment->id, 'so_returned');

          Yii::$app->session->setFlash('success', 'Returned by SO -> Success');

          }
       return $this->redirect(Yii::$app->request->referrer);
          
        } 

        else {
          echo 'NO POST';
        }

   

    }


    public function actionSosaved($id)
    {

              if(isset($_POST)){
            $errorexist = $this->save($id, $_POST);
            $newlog = new Log();
        $newlog->user_id = Yii::$app->user->id;
        $newlog->controller = 'activity';
        $newlog->action = 'under_review';
        $newlog->type = 'assessment';
  $newlog->timestamp = new Expression('NOW()');
  $newlog->save();



    $activity_status = ProjectActivityMeta::find()->andWhere(['project_activity_id' => $id])
    ->andWhere(['type' => 'assessment'])
            ->andWhere(['key' => 'status'])->One();
            
//echo '<br/>errro : ' . $errorexist;
            
          if ($errorexist > 0) {
Yii::$app->session->addFlash('danger', 'Status belum berubah. jumlah requirement yang belum terpenuhi = ' . $errorexist);
          } else {
                        if (null !== $activity_status) {
                $activity_status->value = 'under_review';
                $activity_status->save();
            } else {
                $activity_status = new ProjectActivityMeta();
                $activity_status->project_activity_id = $id;
                $activity_status->type = 'assessment';
                $activity_status->key = 'status';
                $activity_status->value = 'under_review';
                $activity_status->save();
            }

            $assessment = ProjectAssessment::find()->andWhere(['activity_id' => $id])->One();
            $this->snapshot($assessment->id, 'under_review');

          Yii::$app->session->setFlash('success', 'saved');

          }
       return $this->redirect(Yii::$app->request->referrer);
          
        } 

        else {
          echo 'NO POST';
        }
/*
   echo '<pre>';
print_r($_POST);
*/

    }


    public function actionSoreviewed($id)
    {

              if(isset($_POST)){
            $errorexist = $this->save($id, $_POST);
            $newlog = new Log();
        $newlog->user_id = Yii::$app->user->id;
        $newlog->controller = 'activity';
        $newlog->action = 'so_reviewed';
        $newlog->type = 'assessment';
  $newlog->timestamp = new Expression('NOW()');
  $newlog->save();



    $activity_status = ProjectActivityMeta::find()->andWhere(['project_activity_id' => $id])
    ->andWhere(['type' => 'assessment'])
            ->andWhere(['key' => 'status'])->One();
            
//echo '<br/>errro : ' . $errorexist;
            
          if ($errorexist > 0) {
Yii::$app->session->addFlash('danger', 'Status belum berubah. jumlah requirement yang belum terpenuhi = ' . $errorexist);
          } else {
                        if (null !== $activity_status) {
                $activity_status->value = 'so_reviewed';
                $activity_status->save();
            } else {
                $activity_status = new ProjectActivityMeta();
                $activity_status->project_activity_id = $id;
                $activity_status->type = 'assessment';
                $activity_status->key = 'status';
                $activity_status->value = 'so_reviewed';
                $activity_status->save();
            }

            $assessment = ProjectAssessment::find()->andWhere(['activity_id' => $id])->One();
            $this->snapshot($assessment->id, 'so_reviewed');

          Yii::$app->session->setFlash('success', 'Reviewed by SO -> Success');

          }
       return $this->redirect(Yii::$app->request->referrer);
          
        } 

        else {
          echo 'NO POST';
        }

   

    }


    public function actionSoreviewedlama($id)
    {
        if(isset($_POST)){


        if (isset($_POST['AssessmentReport'])) {
            $project_assessment = ProjectAssessment::find()->andWhere(['activity_id' => $id])->One();
            $exec_summary = ProjectAssessmentResult::find()
            ->andWhere(['project_assessment_id' => $project_assessment->id])
            ->andWhere(['type' => 'executive_summary'])->One();
            if (null !== $exec_summary) {
                $exec_summary->textvalue = $_POST['AssessmentReport']['executive_summary'];
                $exec_summary->save();
            } else {
                $exec_summary = new ProjectAssessmentResult();
                $exec_summary->project_assessment_id = $project_assessment->id;
                $exec_summary->type = 'executive_summary';
                $exec_summary->textvalue = $_POST['AssessmentReport']['executive_summary'];
                $exec_summary->save();
            }
        }

            $post = $_POST;
            foreach ($post as $key => $value) {
                $keyx = explode('_', $key);
                if ($keyx[0] == 'uraian')
                {
                //    echo $keyx[1];
                    $project_assessment = ProjectAssessment::find()->andWhere(['activity_id' => $id])->One();
                    $result = ProjectAssessmentResult::find()
                    ->andWhere(['project_assessment_id' => $project_assessment->id])
                    ->andWhere(['type'=>'kompetensigram'])->andWhere(['key' => $keyx[1]])->One();
                    if (null !== $result) {
                        $result->textvalue = $value;
                        $result->save();
                    } else {
                        $result = new ProjectAssessmentResult();
                        $result->project_assessment_id = $project_assessment->id;
                        $result->type = 'kompetensigram';
                        $result->key = $keyx[1];
                        $result->textvalue = $value;
                        $result->save();
                    }
                }
                # code...
                //echo $key;
           
            }

            $activity_status = ProjectActivityMeta::find()->andWhere(['project_activity_id' => $id])->andWhere(['type' => 'assessment'])
            ->andWhere(['key' => 'status'])->One();
            if (null !== $activity_status) {
                $activity_status->value = 'so_reviewed';
                $activity_status->save();
            } else {
                $activity_status = new ProjectActivityMeta();
                $activity_status->project_activity_id = $id;
                $activity_status->type = 'assessment';
                $activity_status->key = 'status';
                $activity_status->value = 'so_reviewed';
                $activity_status->save();
            }

        }

        $newlog = new Log();
        $newlog->user_id = Yii::$app->user->id;
        $newlog->controller = 'activity';
        $newlog->action = 'so_reviewed';
        $newlog->type = 'assessment';
  $newlog->timestamp = new Expression('NOW()');
  $newlog->save();

Yii::$app->session->setFlash('success', 'Data is reviewed by SO');
        return $this->redirect(Yii::$app->request->referrer);


    }

    public function actionSoreturnedlama($id)
    {
        if(isset($_POST)){


        if (isset($_POST['AssessmentReport'])) {
            $project_assessment = ProjectAssessment::find()->andWhere(['activity_id' => $id])->One();
            $exec_summary = ProjectAssessmentResult::find()
            ->andWhere(['project_assessment_id' => $project_assessment->id])
            ->andWhere(['type' => 'executive_summary'])->One();
            if (null !== $exec_summary) {
                $exec_summary->textvalue = $_POST['AssessmentReport']['executive_summary'];
                $exec_summary->save();
            } else {
                $exec_summary = new ProjectAssessmentResult();
                $exec_summary->project_assessment_id = $project_assessment->id;
                $exec_summary->type = 'executive_summary';
                $exec_summary->textvalue = $_POST['AssessmentReport']['executive_summary'];
                $exec_summary->save();
            }
        }

            $post = $_POST;
            foreach ($post as $key => $value) {
                $keyx = explode('_', $key);
                if ($keyx[0] == 'uraian')
                {
                //    echo $keyx[1];
                    $project_assessment = ProjectAssessment::find()->andWhere(['activity_id' => $id])->One();
                    $result = ProjectAssessmentResult::find()
                    ->andWhere(['project_assessment_id' => $project_assessment->id])
                    ->andWhere(['type'=>'kompetensigram'])->andWhere(['key' => $keyx[1]])->One();
                    if (null !== $result) {
                        $result->textvalue = $value;
                        $result->save();
                    } else {
                        $result = new ProjectAssessmentResult();
                        $result->project_assessment_id = $project_assessment->id;
                        $result->type = 'kompetensigram';
                        $result->key = $keyx[1];
                        $result->textvalue = $value;
                        $result->save();
                    }
                }
                # code...
                //echo $key;
           
            }

            $activity_status = ProjectActivityMeta::find()->andWhere(['project_activity_id' => $id])->andWhere(['type' => 'assessment'])
            ->andWhere(['key' => 'status'])->One();
            if (null !== $activity_status) {
                $activity_status->value = 'so_returned';
                $activity_status->save();
            } else {
                $activity_status = new ProjectActivityMeta();
                $activity_status->project_activity_id = $id;
                $activity_status->type = 'assessment';
                $activity_status->key = 'status';
                $activity_status->value = 'so_returned';
                $activity_status->save();
            }

        }
        $newlog = new Log();
        $newlog->user_id = Yii::$app->user->id;
        $newlog->controller = 'activity';
        $newlog->action = 'so_returned';
        $newlog->type = 'assessment';
  $newlog->timestamp = new Expression('NOW()');
  $newlog->save();
Yii::$app->session->setFlash('danger', 'Data is returned to assessor');
        return $this->redirect(Yii::$app->request->referrer);


    }

    public function actionSave($id)
    {
        if(isset($_POST)){
            $errorexist = $this->save($id, $_POST);
            $newlog = new Log();
        $newlog->user_id = Yii::$app->user->id;
        $newlog->controller = 'activity';
        $newlog->action = 'save';
        $newlog->type = 'assessment';
  $newlog->timestamp = new Expression('NOW()');
  $newlog->save();

              $activity_status = ProjectActivityMeta::find()->andWhere(['project_activity_id' => $id])->andWhere(['type' => 'assessment'])
            ->andWhere(['key' => 'status'])->One();
            if (null !== $activity_status) {
                $activity_status->value = 'open';
                $activity_status->save();
            } else {
                $activity_status = new ProjectActivityMeta();
                $activity_status->project_activity_id = $id;
                $activity_status->type = 'assessment';
                $activity_status->key = 'status';
                $activity_status->value = 'open';
                $activity_status->save();
            }

Yii::$app->session->setFlash('success', 'Data tersimpan. Harap perhatikan warning diatas sebelum melakukan submit final');
        return $this->redirect(Yii::$app->request->referrer);
      } else {
        echo 'NO POST';
      }

    }


    public function actionFinalize($id)
    {
        if(isset($_POST)){
            $errorexist = $this->save($id, $_POST);
            $newlog = new Log();
        $newlog->user_id = Yii::$app->user->id;
        $newlog->controller = 'activity';
        $newlog->action = 'done';
        $newlog->type = 'assessment';
  $newlog->timestamp = new Expression('NOW()');
  $newlog->save();



    $activity_status = ProjectActivityMeta::find()->andWhere(['project_activity_id' => $id])
    ->andWhere(['type' => 'assessment'])
            ->andWhere(['key' => 'status'])->One();
            
//echo '<br/>errro : ' . $errorexist;
            
          if ($errorexist > 0) {
Yii::$app->session->addFlash('danger', 'Data BELUM ter-submit. jumlah requirement yang belum terpenuhi = ' . $errorexist);
          } else {
                        if (null !== $activity_status) {
                $activity_status->value = 'done';
                $activity_status->save();
            } else {
                $activity_status = new ProjectActivityMeta();
                $activity_status->project_activity_id = $id;
                $activity_status->type = 'assessment';
                $activity_status->key = 'status';
                $activity_status->value = 'done';
                $activity_status->save();
            }

            $assessment = ProjectAssessment::find()->andWhere(['activity_id' => $id])->One();
            $this->snapshot($assessment->id, 'finalize');

          Yii::$app->session->setFlash('success', 'Data is FINALIZED and Readonly');

          }
       return $this->redirect(Yii::$app->request->referrer);
          
        } 

        else {
          echo 'NO POST';
        }

   
    }

    /**
     * Creates a new Activity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectActivity();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Activity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Activity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function beforeAction($action) {
/*
if (isset($_GET['id'])){
        $profile_model = Profile::find()->andWhere(['user_id' => Yii::$app->user->id])->One();
        $hasrole = ProjectActivityMeta::find()->andWhere(['project_activity_id' => $_GET['id']])
        ->andWhere(['type' => 'general'])
        ->andWhere(['value' => $profile_model->id])
        ->andWhere(['in', 'key',['assessor', 'secondopinion','admin']])->One();
        if (isset($hasrole)) {
                return parent::beforeAction($action);
            } else {
                Yii::$app->session->setFlash('danger', 'You dont have access');
                //return $this->redirect('http://www.google.com');
            }
} else {
    return parent::beforeAction($action);
}
///echo $action->id;
*/
    return parent::beforeAction($action);
}

    

    public function actionPrint($id)
    {
        $data = [];
        $assessment_report = new AssessmentReport();
        $biodata = new Biodata();
       $model = $this->findModel($id);

       $profi = Profile::find()->andWhere(['user_id' => Yii::$app->user->id])->One();
       $is_assessor = ProjectActivityMeta::find()
       ->andWhere(['project_activity_id' => $id])
       ->andWhere(['type' => 'general'])
       //->andWhere(['key' => 'assessor'])
       ->andWhere(['value' => $profi->id])->One();


       $assessee_model= ProjectActivityMeta::find()
       ->andWhere(['project_activity_id' => $id])
       ->andWhere(['type' => 'general'])
       ->andWhere(['key' => 'assessee'])->One();


           $model2 = new ProjectActivity;
           $uraian_model = new ProjectAssessmentResult;

           $project_assessment_model = ProjectAssessment::find()
           ->andWhere(['activity_id' => $id])
           ->andWhere(['status' => 'active'])
           ->One();

           $tanggal_test = ProjectActivityMeta::find()
           ->andWhere(['project_activity_id' => $id])
           ->andWhere(['key' => 'scheduled'])
           ->One();   
           
           
           $data['tanggal_test'] = isset($tanggal_test->value)?$tanggal_test->value  : '2/11/2017 8:00';
          


                                       $nomor_test = ProjectAssessmentResult::find()->andWhere(['type' => 'inventory'])
                                       ->andWhere(['project_assessment_id' =>$project_assessment_model->id])
                                       ->andWhere(['key'=>'nomor_test'])
                                       ->One();  
                                       $data['nomor_test'] =  isset($nomor_test->value)?$nomor_test->value  : '0001 SETNEG 01112017'; ;                                       


                                       $assessor_id = ProjectActivityMeta::find()->andWhere(['project_activity_id' =>$id])->andWhere(['type' => 'general'])
                                       ->andWhere(['key' => 'assessor'])
                                       ->andWhere(['!=','value',2])
                                       ->One();
                                       //$data['assessor_id'] = $assessor_id->value;
                                       
                                       $assessor_name = Profile::find()->andWhere(['id' => $assessor_id->value])->One();
                                       $data['assessor_name'] = 
                                       isset($assessor_name->first_name)?$assessor_name->first_name  : 'unmap';

                                       $nomor_test = ProjectAssessmentResult::find()->andWhere(['type' => 'inventory'])
                                       ->andWhere(['project_assessment_id' =>$project_assessment_model->id])
                                       ->andWhere(['key'=>'nomor_test'])
                                       ->One();  
                               
                                      if (isset($nomor_test->value)) {$data['nomor_test'] = explode(" ", $nomor_test->value, 2)[0]; } else { $data['nomor_test'] =  '0001';  }                                       


         $catalog = $project_assessment_model->catalog_id;
         $data['activity_id'] = $_GET['id'];
         $data['assessment_id'] = $project_assessment_model->id;
         $data['catalog_id'] = $catalog;

       
         $catalog_metas = CatalogMeta::find()->andWhere(['catalog_id' => $catalog])
           ->orderBy(['type'=>SORT_ASC, 'attribute_3'=>SORT_ASC])->All();

         $profile_metas = ProfileMeta::find()->andWhere(['profile_id' => $assessee_model->value])->All();

         $assessee_profile = Profile::findOne($assessee_model->value);
         $data['profile']['id'] = $assessee_profile->id;
         $data['profile']['first_name'] = $assessee_profile->first_name;
         $data['profile']['birthdate'] = $assessee_profile->birthdate;
         $data['profile']['gender'] = $assessee_profile->gender;

           foreach ($profile_metas as $cm_key => $cm_value) {;
               if ($cm_value['type'] == 'work'){
                   $data['profile'][$cm_value['key']] = $cm_value['value'];
               } 

               if ($cm_value['type'] == 'address'){
                   $data['profile'][$cm_value['key']] = $cm_value['value'];
               } 

               if ($cm_value['type'] == 'education'){
                   $data['profile'][$cm_value['key']] = $cm_value['value'];
               }
               if ($cm_value['type'] == 'personal'){
                $data['profile'][$cm_value['key']] = $cm_value['value'];
            }    
            if ($cm_value['type'] == 'contact'){
                $data['profile'][$cm_value['key']] = $cm_value['value'];
            }                         
           }



           foreach ($catalog_metas as $cm_key => $cm_value) {
               if ($cm_value['type'] == 'kompetensi_setneg'){
                   //$newdata = new ProjectAssessmentResult;
                 $lki = ProjectAssessmentResult::find()
                 ->andWhere(['project_assessment_id' => $project_assessment_model->id])
                 ->andWhere(['type' => 'kompetensi_setneg'])->andWhere(['key' => $cm_value['value']])->One();
                   if (null !== $lki) {
                     $data['kompetensigram']['lki'][$cm_value['value']] = $lki->value;
$uraian_kompetensi_model = ProjectAssessmentResult::find()
                 ->andWhere(['project_assessment_id' => $project_assessment_model->id])
->andWhere(['type' => 'uraian_kompetensi_setneg'])
->andWhere(['key' => $cm_value['value']])
->andWhere(['value' => $lki->value])
->One();

if(null == $uraian_kompetensi_model)
{
 $uraian_kompetensi = '';
} else {
 $uraian_kompetensi = $uraian_kompetensi_model->attribute_1;
}
                      $data['kompetensigram']['evidence'][$cm_value['value']] = $uraian_kompetensi;
                   } else {
                      $data['kompetensigram']['lki'][$cm_value['value']] = 0;
                   }
                  
                   $data['kompetensigram']['lkj'][$cm_value['value']] = $cm_value['attribute_1'];
               }
           }


           foreach ($catalog_metas as $cm_key => $cm_value) {
               if ($cm_value['type'] == 'psikogram_setneg'){
$lki = ProjectAssessmentResult::find()
                 ->andWhere(['project_assessment_id' => $project_assessment_model->id])
->andWhere(['type' => 'psikogram_setneg'])->andWhere(['key' => $cm_value['value']])->One();
                   if (null !== $lki) {
                     $data['psikogram']['lki'][$cm_value['value']] = $lki->value;
                   } else {
                      $data['psikogram']['lki'][$cm_value['value']] = 0;
                   }
                   $data['psikogram']['lkj'][$cm_value['value']] = $cm_value['attribute_1'];
               }
           }
           
           foreach ($catalog_metas as $cm_key => $cm_value) {
               if ($cm_value['type'] == 'uraian_setneg'){
                   $uraian = ProjectAssessmentResult::find()
                 ->andWhere(['project_assessment_id' => $project_assessment_model->id])
                   ->andWhere(['type' => $cm_value['type']])
                   ->andWhere(['key' => $cm_value['value']])->One();
                   if (null !== $uraian) {
                   $data['uraian'][$cm_value['value']] = $uraian->textvalue;
                   } else {
                     $data['uraian'][$cm_value['value']] = '';
                   }
                   $assessment_report->$cm_value['value'] = $data['uraian'][$cm_value['value']];

               }
           }

/** GW MASUKKIN DISINI buat saran_uraian **/
 $uraian_saran_model = ProjectAssessmentResult::find()
                  ->andWhere(['project_assessment_id' => $project_assessment_model->id])
 ->andWhere(['type' => 'uraian_setneg'])
 ->andWhere(['key' => 'saran'])
 ->One();

if (null !== $uraian_saran_model)
{
  $data['uraian_saran'] = $uraian_saran_model->textvalue;

} else {
  $data['uraian_saran'] = '';
}

/**
 * 
 */
           return $this->renderPartial('../../activity/4/print', [
               'model' => $model,
               'biodata' => $biodata,
                'assessment_report' => $assessment_report,
               'catalog_metas' => $catalog_metas,
               'data' => $data,
           ]);


    }

    /**
     * Finds the Activity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Activity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectActivity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

 


    public function actionAddassessor($id)
    {


                          $assessor_model = ProjectActivityMeta::find()->andWhere(['project_activity_id' => $id])
                          ->andWhere(['type' => 'general'])->andWhere(['key' => 'assessor'])
                          ->andWhere([ '<>','value', '2'])
                          ->One();

                          if (null == $assessor_model)
                          {
                            $assessor_model = new ProjectActivityMeta;
                            $assessor_model->project_activity_id = $id;
                            $assessor_model->type = 'general';
                            $assessor_model->key = 'assessor';

                          }

                          if($_POST)
                          {
                                $assessor_model->value = $_POST['ProjectActivityMeta']['value'];
                                $assessor_model->save();
                            //echo '<pre>';
                            //print_r($_POST);
   Yii::$app->session->addFlash('success', 'assessor set');
                                return $this->redirect(Yii::$app->request->referrer);


                          } else {



        return $this->render('addassessor', [
          'assessor_model' => $assessor_model,
            //'searchModel' => $searchModel,
            //'dataProvider' => $dataProvider,
        ]);
      }
    }




}



