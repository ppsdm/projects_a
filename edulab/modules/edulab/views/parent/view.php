<?php

use yii\helpers\Html;
use common\modules\profile\models\ProfileExtended;
use common\modules\profile\models\ProfileGeneral;


?>
<div class="addchild">

    <h1><?= Html::encode($this->title) ?></h1>

<?php

echo $model->first_name;

?>

</div>
