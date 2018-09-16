<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SetkabActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Setkab Activities');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setkab-activity-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Setkab Activity'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['data-id' => $model->id];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'assessee_id',
			[
				'label' => 'Nama',
				           'content'=>function($data){
							   //$setkab_assessment = SetkabAssessment::find()->andWhere(['activity_id' => $data->id])->One();
               // return $data->assessee->nama_lengkap;
			   return 'nama';
            }
			],
			
			[
				'label' => 'Assessor',
				           'content'=>function($data){
							   //$setkab_assessment = SetkabAssessment::find()->andWhere(['activity_id' => $data->id])->One();
                //return $data->assessor->first_name;
				return 'nama asesor';
            }
			],
          //  'second_opinion_id',
            'tanggal_test',
            // 'tempat_test',
            // 'tujuan_pemeriksaan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
<?php
$this->registerJs("

    $('td').hover(function() {
        $(this).css('cursor','pointer');
    }).click(function (e) {
        var id = $(this).closest('tr').data('id');
        if(e.target == this)
            location.href = 'http://projects.ppsdm.com/index.php/setkab-activity/view?id=' + id;
    });

");
?>
