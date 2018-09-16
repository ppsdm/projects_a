<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\SetkabActivity */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Setkab Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setkab-activity-view">

<div class="activity-view">

    <h1><span>
        <?php
        
        echo Html::img('@web/project-uploads/setkab/photos/'.$model->assessee->id.'.jpg', ['alt' => '--missing image--','style'=> 'max-width:200px;max-height:200px'
            ]);
        ?>
    </span><?= Html::encode($model->assessee->nama_lengkap) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		        <?= Html::a(Yii::t('app', 'Print PDF'), ['pdf', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Submit Assessment'), ['submit', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to submit this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
<h3>Uraian</h3>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'label' => 'Data Diri',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::a(Yii::t('app', 'Edit'), ['datadiri', 'id' => $data->id], ['class' => 'btn btn-primary']);
                }

            ],
            [
                'label' => 'Executive Summary',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::a(Yii::t('app', 'Edit'), ['exsum', 'id' => $data->id], ['class' => 'btn btn-primary']);
                }

            ],

            [
                'label' => 'Kekuatan',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::a(Yii::t('app', 'Edit'), ['kekuatan', 'id' => $data->id], ['class' => 'btn btn-primary']);
                }

            ],
            [
                'label' => 'Kelemahan',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::a(Yii::t('app', 'Edit'), ['kelemahan', 'id' => $data->id], ['class' => 'btn btn-primary']);
                }

            ],
            [
                'label' => 'Saran Pengembangan',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::a(Yii::t('app', 'Edit'), ['saran', 'id' => $data->id], ['class' => 'btn btn-primary']);
                }

            ],


//            'tanggal_test',
  //          'tempat_test',
    //        'tujuan_pemeriksaan',
        ],
    ]) ?>
<h3>Aspek Potensi</h3>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Psikogram',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::a(Yii::t('app', 'Edit'), ['psikogram', 'id' => $data->id], ['class' => 'btn btn-primary']);
                }

            ],

        ],
    ]) ?>

<h3>Aspek Kompetensi</h3>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'label' => 'Integritas',
                'format' => 'raw',
                'value' => function($data)
                {
                    //check kalau textnya jumlah nya cukup
					
					$words = str_word_count(strip_tags($data->integritas_uraian));
					$characters = strlen(str_replace(' ','',strip_tags($data->integritas_uraian)));
					
					$btn_class = 'btn btn-primary';
					
                    return Html::a(Yii::t('app', 'Edit'), ['integritas', 'id' => $data->id], ['class' => $btn_class]) . ' words = ' . $words;
                }

            ],
            [
                'label' => 'Kerjasama',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::a(Yii::t('app', 'Edit'), ['kerjasama', 'id' => $data->id], ['class' => 'btn btn-primary']);
                }
            ],
            [
                'label' => 'Komunikasi',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::a(Yii::t('app', 'Edit'), ['komunikasi', 'id' => $data->id], ['class' => 'btn btn-primary']);
                }
            ],
            [
                'label' => 'Orientasi pada hasil',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::a(Yii::t('app', 'Edit'), ['orientasihasil', 'id' => $data->id], ['class' => 'btn btn-primary']);
                }
            ],
            [
                'label' => 'Pelayanan Publik',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::a(Yii::t('app', 'Edit'), ['pelayananpublik', 'id' => $data->id], ['class' => 'btn btn-primary']);
                }
            ],
            [
                'label' => 'Pengembangan Diri dan Orang Lain',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::a(Yii::t('app', 'Edit'), ['pengembangandiri', 'id' => $data->id], ['class' => 'btn btn-primary']);
                }
            ],
            [
                'label' => 'Mengelola Perubahan',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::a(Yii::t('app', 'Edit'), ['perubahan', 'id' => $data->id], ['class' => 'btn btn-primary']);
                }
            ],
            [
                'label' => 'Pengambilan Keputusan',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::a(Yii::t('app', 'Edit'), ['pengambilankeputusan', 'id' => $data->id], ['class' => 'btn btn-primary']);
                }
            ],
            [
                'label' => 'Perekat Bangsa',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::a(Yii::t('app', 'Edit'), ['perekatbangsa', 'id' => $data->id], ['class' => 'btn btn-primary']);
                }
            ],
            //'tanggal_test',
            //'tempat_test',
            //'tujuan_pemeriksaan',
        ],
    ]) ?>

</div>
