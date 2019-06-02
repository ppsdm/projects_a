<<<<<<< HEAD
<?php

use common\modules\organization\models\Organization;

//use Yii\helpers\Html;
use yii\helpers\Html;

?>

<div class="admin-default-index">
    <h1>Choose your organization</h1>
<?php

foreach ($orgs as $key => $value) {
	# code...
	//echo $value->organization->name;
echo 	Html::a($value->organization->name, ['main', 'org_id'=>$value->organization_id], ['class'=>'btn-menu-transparent btn-info']);
	echo '<br/>';
}

?>

</div>

=======
<?php

use common\modules\organization\models\Organization;

//use Yii\helpers\Html;
use yii\helpers\Html;

?>

<div class="admin-default-index">
    <h1>Choose your organization</h1>
<?php

foreach ($orgs as $key => $value) {
	# code...
	//echo $value->organization->name;
echo 	Html::a($value->organization->name, ['main', 'org_id'=>$value->organization_id], ['class'=>'btn-menu-transparent btn-info']);
	echo '<br/>';
}

?>

</div>

>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
