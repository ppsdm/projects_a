<<<<<<< HEAD
<?php
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

/* @var $this yii\web\View */
?>
<h1>Messages</h1>

<p>
' '
</p>

<?php




echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_message',
]);


echo Html::a(Yii::t('app', 'Create new message'), ['createmessage', 'id' => $id], ['class' => 'btn btn-info']);

=======
<?php
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

/* @var $this yii\web\View */
?>
<h1>Messages</h1>

<p>
' '
</p>

<?php




echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_message',
]);


echo Html::a(Yii::t('app', 'Create new message'), ['createmessage', 'id' => $id], ['class' => 'btn btn-info']);

>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
?>