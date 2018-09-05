<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use common\modules\assessment\models\Assessment;
use common\models\Notification;
use common\modules\catalog\models\CatalogGeneral;
use common\modules\profile\models\ProfileExtended;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;

use kartik\helpers\Html as KartikHtml;


$this->title = 'Bakat Minat';
$this->params['breadcrumbs'][] = $this->title;
$data = [
  /*  "red" => "red",
    "green" => "green",
    */
];


$form = ActiveForm::begin(['id' => 'form-signup']);


// Without model and implementing a multiple select
echo Select2::widget([
    'name' => 'search',
    'data' => $data,
    'options' => [
        'placeholder' => 'Search ...',
      //  'multiple' => true
    ],
    'pluginOptions' => [
        'tags' => true,
        'tokenSeparators' => [',', ' '],
        'maximumInputLength' => 10
    ],
    'addon' => [
        'prepend' => [
         //   'content' => KartikHtml::icon('globe')
        ],
        'append' => [
            'content' => KartikHtml::submitButton(KartikHtml::icon('search'), [
                'class' => 'btn btn-primary', 
                      'title' => 'Search', 
                'data-toggle' => 'tooltip'
            ]),
            'asButton' => true
        ]
    ]
]);
?>
            <?php ActiveForm::end(); ?>

<div class="container" style="margin-top: 20px"><h1>
<?= $this->title ?>
</h1>
<div class="row">

	<?php



echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_catalogitem',
]);

?>

						</div>



</div>






