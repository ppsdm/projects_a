<?php
use common\modules\assessment\models\Assessment;
use common\modules\assessment\models\AssessmentResult;
use common\modules\tao\models\TaoUriMap;
use common\modules\tao\models\ResultsStorage;
use common\modules\tao\models\Statements;

use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
?>

    <?php $form = ActiveForm::begin(); ?>
<?php


echo '<p>';
  echo Html::input('text','institution_1','',['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Masukkan no kode jurusan']);
  echo '</p>';

echo '<p>';
  echo Html::input('text','institution_2','',['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Masukkan no kode jurusan']);
  echo '</p>';


echo '<p>';
  echo Html::input('text','institution_3','',['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Masukkan no kode jurusan']);
  echo '</p>';




    ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Go!'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>