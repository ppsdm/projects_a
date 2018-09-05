<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\profile\models\Profile;
use app\modules\profile\models\ProfileMeta;
use app\modules\profile\models\ProfileReview;
use app\modules\profile\models\ProfileReviewSearch;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\profile\models\ProfileReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Profile Reviews');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-review-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Profile Review'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //   'id',
          //  'reviewer_id',
            [
                'label' => 'Reviewer',
                'attribute' => 'reviewer_id',
                'value' => function($data){
                    $profile =  Profile::findOne($data->reviewer_id);
                    return $profile->first_name;
                }
            ],
            //'reviewee_id',
            [
                'label' => 'Reviewee',
                'attribute' => 'reviewee_id',
                'value' => function($data){
                    $profile =  Profile::findOne($data->reviewee_id);
                    return $profile->first_name;
                }
            ],
            //'review:ntext',
           // 'attribute_1',
            [
            'label' => 'Penilaian',
            'attribute' => 'attribute_1',
            'value' => function($data)
            {
                return $data->attribute_1;
            }
            ],
            // 'attribute_2',
            // 'attribute_3',
            // 'created_at',
            // 'modified_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
