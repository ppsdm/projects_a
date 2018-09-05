<?php
use yii\grid\GridView;
//use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use common\modules\profile\models\ProfileExtended;
use common\modules\assessment\models\Assessment;
use common\modules\assessment\models\TakerSearch;
use common\modules\assessment\models\Result;
use yii\helpers\ArrayHelper;
?>
<div class="container" style="margin-top: 20px">
<div class="row">
<?php




echo GridView::widget([
        'dataProvider' => $takers,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //	'id',
                'user_id',
                [
                    'label' => 'Nama',
                    'value' => function($data) {
                        return $data->profile->first_name . ' ' . $data->profile->last_name;
                    }
                ],
                'status',
            [
                'label' => 'location',
                'attribute' => 'location',
            'filter' => ArrayHelper::map(ProfileExtended::find()->andWhere(['type' => 'edulab'])->andWhere(['key'=>'location'])->groupBy('value')->asArray()->All(), 'value', 'value'),

                //'filter' => ['11' => '2212'],
                    'value' => function($data)
                    {
                        $location = ProfileExtended::find()->andWhere(['type' => 'edulab'])->andWhere(['key'=>'location'])->andWhere(['user_id'=>$data->user->id])->One();
                        return isset($location->value) ? $location->value : '-';
                    }
            ],
                //'catalog_id',

       
                //'yu',
                [
                    'label' => 'Matematika IPA betul',
                    'value' => function($data) {
                        $result = Result::find()->andWhere(['type' => 'matematika_ipa'])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'correct'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? $result->value : '0';
                    }
                ],
                [
                    'label' => 'Matematika IPA salah',
                    'value' => function($data) {
                        $result = Result::find()->andWhere(['type' => 'matematika_ipa'])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'incorrect'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? (15 - $result->value) : '15';
                    }
                ],
                [
                    'label' => 'Matematika IPA kosong',
                    'value' => function($data) {
                        $result = Result::find()->andWhere(['type' => 'matematika_ipa'])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'unanswered'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? (15 - $result->value) : '15';
                    }
                ],
                [
                    'label' => 'Matematika IPA poin',
                    'value' => function($data) {
                        $result = Result::find()->andWhere(['type' => 'matematika_ipa'])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'correct'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? round($result->value / 15 * 60).'%' : '0%';
                    }
                ],
                [
                    'label' => 'Matematika Dasar betul',
                    'value' => function($data) {
                        $result = Result::find()->andWhere(['type' => 'matematika_dasar'])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'correct'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? $result->value : '0';
                    }
                ],
                [
                    'label' => 'Matematika Dasar salah',
                    'value' => function($data) {
                        $result = Result::find()->andWhere(['type' => 'matematika_dasar'])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'incorrect'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? (15 - $result->value) : '15';
                    }
                ],
                [
                    'label' => 'Matematika Dasar kosong',
                    'value' => function($data) {
                        $result = Result::find()->andWhere(['type' => 'matematika_dasar'])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'unanswered'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? (15 - $result->value) : '15';
                    }
                ],
                [
                    'label' => 'Matematika Dasar poin',
                    'value' => function($data) {
                        $result = Result::find()->andWhere(['type' => 'matematika_dasar'])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'correct'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? round($result->value / 15 * 60).'%' : '0%';
                    }
                ],


                [
                    'label' => 'Bahasa Indonesia betul',
                    'value' => function($data) {
                        $result = Result::find()->andWhere(['type' => 'bahasa_indonesia'])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'correct'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? $result->value : '0';
                    }
                ],
                [
                    'label' => 'Bahasa Indonesia salah',
                    'value' => function($data) {
                        $result = Result::find()->andWhere(['type' => 'bahasa_indonesia'])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'incorrect'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? (15 - $result->value) : '15';
                    }
                ],
                [
                    'label' => 'Bahasa Indonesia kosong',
                    'value' => function($data) {
                        $result = Result::find()->andWhere(['type' => 'bahasa_indonesia'])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'unanswered'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? (15 - $result->value) : '15';
                    }
                ],
                [
                    'label' => 'Bahasa Indonesia poin',
                    'value' => function($data) {
                        $result = Result::find()->andWhere(['type' => 'bahasa_indonesia'])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'correct'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? round($result->value / 15 * 60).'%' : '0%';
                    }
                ],

                [
                    'label' => 'Bahasa Inggris betul',
                    'value' => function($data) {
                        $result = Result::find()->andWhere(['type' => 'bahasa_inggris'])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'correct'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? $result->value : '0';
                    }
                ],
                [
                    'label' => 'Bahasa Inggris salah',
                    'value' => function($data) {
                        $result = Result::find()->andWhere(['type' => 'bahasa_inggris'])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'incorrect'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? (15 - $result->value) : '15';
                    }
                ],
                [
                    'label' => 'Bahasa Inggris kosong',
                    'value' => function($data) {
                        $result = Result::find()->andWhere(['type' => 'bahasa_inggris'])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'unanswered'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? (15 - $result->value) : '15';
                    }
                ],
                [
                    'label' => 'Bahasa Inggris poin',
                    'value' => function($data) {
                        $result = Result::find()->andWhere(['type' => 'bahasa_inggris'])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'correct'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? round($result->value / 15 * 60).'%' : '0%';
                    }
                ],

         //'resultsum',
         [
            'label' => 'Point',
            'attribute' => 'resultsum',
            'value' => function($data) {
                return $data->resultsum;
            }
         ],
                
                //'assessmentresults.testtaker_id',
              //  'results.type',
               /* [
                    'label' => 'value',
                    'attribute' => 'resultsum',
                    'value' => function($data) {
                        $total = 0;
                        foreach ($data->results as $key => $value) {
                            $total = $total + $value->value;
                        }
                        return $total;
                    }
                ],

                */
                


                //'sum',
                //'catalog_id',
                //'filter' => false,
/*                [
                    'label' => 'Username',
                    'value' => function($data)
                    {
                        return $data->user->username;
                    }
                ],
                
            //'catalog_id',
*/

/*
            [
                'label' => 'score',
                'attribute' => 'score',
                    'value' => function($data)
                    {
                            $assessment = Assessment::find()->andWhere(['user_id'=>$data->user->id])->andWhere(['catalog_id' => $data->catalog_id])->andWhere(['status' => 'finished'])->orderBy('id DESC')->One();
                            if (isset($assessment->id)) {
                            $correct_sum = Result::find()->andWhere(['assessment_id'=>$assessment->id])->Sum('value');
                            return isset($correct_sum) ? $correct_sum : 'no result yet';
                        } else {
                            return 'no result yet';
                        }


                    }
            ],
            */
            
            //'description:ntext',
            //'imageUrl:url',
            //'status',

        //    ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
//echo 'takers';
$soc = $takers->getModels();
//echo '<pre>';
//print_r($soc[0]->results);

//echo sizeof($soc[0]->results);
//echo sizeof($soc);
?>
</div>
</div>
