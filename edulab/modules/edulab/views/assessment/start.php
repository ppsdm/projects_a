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
<h1>Sebelum anda melanjutkan ke Tryout</h1>

<p>
masukkan kode PT & Jurusan anda terlebih dahulu di form dibawah ini. Kode ini berfungsi untuk membandungkan hasil yang anda dapat dengan passing grade PT / Jurusan yang diinginkan.
<i>
  Pastikan kode yang dimasukkan sudah sesuai dengan PT/Jurusan tujuan. Kode ini tidak bisa diganti
  </i>
</p>

    <?php $form = ActiveForm::begin(); ?>
<?php
echo '<p>';
echo 'List kode PT & prediksi passing grade bisa didownload di bawah<br/>';
echo Html::a(Yii::t('app', 'PREDIKSI PASSING GRADE 2017 EDULAB (IPA)'), ['../../../uploads/PREDIKSI PASSING GRADE 2017 EDULAB (IPA).pdf'], ['class'=>'']);
echo '<br/>';
echo Html::a(Yii::t('app', 'PREDIKSI PASSING GRADE 2017 EDULAB (IPS)'), ['../../../uploads/PREDIKSI PASSING GRADE 2017 EDULAB (IPS).pdf'], ['class'=>'']);

  //echo Html::input('text','institution_1','',['readonly' => false, 'class'=>'form-control', 'placeholder' => 'kode preferensi 1']);
  echo '</p>';


echo '<p>';
echo Html::label('Preferensi ke 1', 'institution_1', ['class' => '']);
  echo Html::input('text','institution_1','',['readonly' => false, 'class'=>'form-control', 'placeholder' => 'kode preferensi 1']);
  echo '</p>';

echo '<p>';
echo Html::label('Preferensi ke 2', 'institution_2', ['class' => '']);
  echo Html::input('text','institution_2','',['readonly' => false, 'class'=>'form-control', 'placeholder' => 'kode preferensi 2']);
  echo '</p>';


echo '<p>';
echo Html::label('Preferensi ke 3', 'institution_3', ['class' => '']);
  echo Html::input('text','institution_3','',['readonly' => false, 'class'=>'form-control', 'placeholder' => 'kode preferensi 3']);
  echo '</p>';




    ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Go!'), ['class' => 'btn btn-primary', 'data-confirm' => 'Periksa lagi! data ini tidak akan bisa diganti. Apakah anda sudah yakin?']) ?>
    </div>

    <?php ActiveForm::end(); ?>