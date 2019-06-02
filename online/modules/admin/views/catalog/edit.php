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


/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileGeneral */

$this->title = Yii::t('app', 'View Job');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile Generals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-general-create">

    <h1><?= Html::encode($this->title) ?></h1>


<div class="profile-general-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php



echo 'group';
    //echo $form->field('', 'uri')->textInput();

    echo Html::input('text','group',$group,['class'=>'form-control']);

    echo 'delivery';
        echo Html::input('text','delivery',$delivery,['class'=>'form-control']);
//echo     $form->field('', 'uri')->textInput();



    ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


</div>
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


/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileGeneral */

$this->title = Yii::t('app', 'View Job');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile Generals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-general-create">

    <h1><?= Html::encode($this->title) ?></h1>


<div class="profile-general-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php



echo 'group';
    //echo $form->field('', 'uri')->textInput();

    echo Html::input('text','group',$group,['class'=>'form-control']);

    echo 'delivery';
        echo Html::input('text','delivery',$delivery,['class'=>'form-control']);
//echo     $form->field('', 'uri')->textInput();



    ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


</div>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
