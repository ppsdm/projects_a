<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class = "row">
<?php

echo '<div class="col-sm-6 col-md-3">'.Html::a(Html::img('@web/images/'.$model->id.'/logo.png', ['alt'=>$model->name]) , ['project/dashboard', 'id' => $model->id], ['class' => 'thumbnail']  ).'</div>';

?>
</div>

