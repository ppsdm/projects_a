<<<<<<< HEAD
<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class = "row">
<?php

echo '<div class="col-sm-6 col-md-3">'.Html::a(Html::img('@web/images/'.$model->id.'/logo.png', ['alt'=>$model->name]) , ['project/dashboard', 'id' => $model->id], ['class' => 'thumbnail']  ).'</div>';

?>
</div>

=======
<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="project">

<?php

echo Html::a($model->name, ['project/dashboard', 'id' => $model->id], ['class' => 'btn btn-lg btn-success']);

?>
</div>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
