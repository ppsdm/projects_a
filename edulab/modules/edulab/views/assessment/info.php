<?php
/* @var $this yii\web\View */
use common\modules\assessment\models\Assessment;
use common\modules\assessment\models\AssessmentResult;
use common\modules\tao\models\TaoUriMap;
use common\modules\tao\models\ResultsStorage;
use common\modules\tao\models\Statements;
use yii\helpers\Html;
use yii\helpers\Url;
use common\modules\catalog\models\CatalogGeneral;
use yii\widgets\DetailView;

?>
<?php
echo 'INFO';
echo '<br/>';
                             echo Html::img($model->imageUrl, ['alt' => 'My logo', 'width' => '75px', 'style' => 'padding-top: 15px;']);
echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',                                           // title attribute (in plain text)
        'name',
        'description:html',                                // description attribute formatted as HTML

        /*
        [                                                  // the owner name of the model
            'label' => 'Owner',
            'value' => $model->owner->name,            
            'contentOptions' => ['class' => 'bg-red'],     // HTML attributes to customize value tag
            'captionOptions' => ['tooltip' => 'Tooltip'],  // HTML attributes to customize label tag
        ],
        */
        //'created_at:datetime',                             // creation date formatted as datetime
    ],
]);




?>