<<<<<<< HEAD
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Organization;
use app\modules\admin\models\OrganizationAdminuser;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;

use dosamigos\ckeditor\CKEditor;
use dosamigos\ckeditor\CKEditorInline;



echo $model->description;

      echo Html::a(Yii::t('app', 'Apply job'), ['/cats/jobs/register?id='.$model->id], ['class' => 'btn btn-primary']);

=======
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Organization;
use app\modules\admin\models\OrganizationAdminuser;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;

use dosamigos\ckeditor\CKEditor;
use dosamigos\ckeditor\CKEditorInline;



echo $model->description;

      echo Html::a(Yii::t('app', 'Apply job'), ['/cats/jobs/register?id='.$model->id], ['class' => 'btn btn-primary']);

>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
?>