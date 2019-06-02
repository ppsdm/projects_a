<<<<<<< HEAD
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use common\modules\assessment\models\Assessment;
use common\modules\catalog\models\CatalogGeneral;
use common\modules\profile\models\ProfileExtended;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
?>
<div class="container">
   

	<?php


	$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_messageitem',
]);


?>

</div>
</div>

</div>





=======
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use common\modules\assessment\models\Assessment;
use common\modules\catalog\models\CatalogGeneral;
use common\modules\profile\models\ProfileExtended;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
?>
<div class="container">
   

	<?php


	$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_messageitem',
]);


?>

</div>
</div>

</div>





>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
