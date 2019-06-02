<<<<<<< HEAD
<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="note">
 <h2>
	<?php

if($model->type == 'message-admin') {
	$sender = 'Admin';

echo Yii::t('app', Html::encode($sender . ' ' . $model->datetime));
} else if($model->type == 'message-candidate') {
$sender = $model->candidate->user->username;

echo Html::a(Yii::t('app', Html::encode($sender . ' ' . $model->datetime)), ['deletemessage', 'id' => $model->id], ['class' => '','data-confirm' => 'delete message. are you sure?']);
}



?>


</h2>

    <?= HtmlPurifier::process($model->value) ?>    
=======
<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="note">
 <h2>
	<?php

if($model->type == 'message-admin') {
	$sender = 'Admin';

echo Yii::t('app', Html::encode($sender . ' ' . $model->datetime));
} else if($model->type == 'message-candidate') {
$sender = $model->candidate->user->username;

echo Html::a(Yii::t('app', Html::encode($sender . ' ' . $model->datetime)), ['deletemessage', 'id' => $model->id], ['class' => '','data-confirm' => 'delete message. are you sure?']);
}



?>


</h2>

    <?= HtmlPurifier::process($model->value) ?>    
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
</div>