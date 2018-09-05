<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

use vendor\gamantha\pao\project\Activity;
use common\modules\profile\models\Profile;
use common\modules\profile\models\ProfileMeta;

$this->title = 'Debug';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-debug">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the Debug page. You may modify the following file to customize its content:</p>

    <code><?= __FILE__ ?></code>
</div>
<hr/>
<div>
	<?php
		echo 'sassasaa';
	?>
</div>