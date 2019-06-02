<<<<<<< HEAD
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

$results = Result::find()->select(['*, SUM(value) as totalscore, COUNT(value) as totalcount'])
//->andWhere(['in','catalog_id', $catalog_item_list])
->andWhere(['catalog_id' => $_GET['catalog_id']])
->andWhere(['status' => 'current'])
->andWhere(['attribute_1' => 'correct'])
->groupBy(['type'])
->All();


$columns =  [//['class' => 'yii\grid\SerialColumn'],
            //  'id',
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


         ];
                

$tpatotal = 0;
$tpa_incorrect_total = 0;

$matpel_exception = ['tpa_1', 'tpa_2', 'tpa_3'];

foreach ($results as $result_key => $result_value) {

        if (!in_array($result_value->type , $matpel_exception)) {

    # code...
    array_push($columns,
                    [
                    'label' => $result_value->type . ' betul',
                     'encodeLabel' => false,
                    'value' => function($data) use ($result_value){
                        $result = Result::find()->andWhere(['type' => $result_value->type])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'correct'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? $result->value.'' : '0';
                    }]);
    array_push($columns,
                    [
                    'label' => $result_value->type . ' salah',
                     'encodeLabel' => false,
                    'value' => function($data) use ($result_value){
                        $result = Result::find()->andWhere(['type' => $result_value->type])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'incorrect'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? $result->value.'' : '0';
                    }]);
    array_push($columns,
                    [
                    'label' => $result_value->type . ' kosong',
                     'encodeLabel' => false,
                    'value' => function($data) use ($result_value){
                        $result = Result::find()->andWhere(['type' => $result_value->type])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'unanswered'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? $result->value.'' : '0';
                    }]);
    array_push($columns,
                    [
                    'label' => $result_value->type . ' poin',
                     'encodeLabel' => false,
                    'value' => function($data) use ($result_value){
                        $result = Result::find()->andWhere(['type' => $result_value->type])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'correct'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? round($result->value / 15 * 60).'%' : '0%';
                    }]);
} else {
    $tpatotal = $tpatotal + $result_value->value;
                        $incorrect_result = Result::find()->andWhere(['type' => $result_value->type])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'incorrect'])
                        ->andWhere(['catalog_id' => $_GET['catalog_id']])->One();
    $tpa_incorrect_total = $tpa_incorrect_total + $incorrect_result->value;
}
                    
}


    array_push($columns,
                    [
                    'label' => 'tpa betul',
                     'encodeLabel' => false,
                    'value' => function($data) use ($tpatotal){
                      
                        return isset($tpatotal) ? $tpatotal .'' : '0';
                    }]);

    array_push($columns,
                    [
                    'label' => 'tpa salah',
                     'encodeLabel' => false,
                    'value' => function($data) use ($tpa_incorrect_total){
                      
                        return isset($tpa_incorrect_total) ? $tpa_incorrect_total .'' : '0';
                    }]);
        array_push($columns,
                    [
                    'label' => 'tpa kosong',
                     'encodeLabel' => false,
                    'value' => function($data) use ($tpatotal, $tpa_incorrect_total){
                      
                        return isset($tpatotal) ? (45 - ($tpatotal + $tpa_incorrect_total)) .'' : '0';
                    }]);
            array_push($columns,
                    [
                    'label' => 'tpa poin',
                     'encodeLabel' => false,
                    'value' => function($data) use ($tpatotal){
                      
                        return isset($tpatotal) ? round($tpatotal / 45 * 100) .'%' : '0%';
                    }]);




                array_push($columns,          [
            'label' => 'Point',
            'attribute' => 'resultsum',
            'value' => function($data) {
                return number_format($data->resultsum,2);
            }
         ]);

echo GridView::widget([
        'dataProvider' => $takers,
        'filterModel' => $searchModel,
        //'headerRowOptions' => ['colspan'=>'2'],
        'columns' => $columns,
           

            
            //'description:ntext',
            //'imageUrl:url',
            //'status',

        //    ['class' => 'yii\grid\ActionColumn'],
        
    ]); 

$soc = $takers->getModels();

?>
</div>
</div>
=======
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

$results = Result::find()->select(['*, SUM(value) as totalscore, COUNT(value) as totalcount'])
//->andWhere(['in','catalog_id', $catalog_item_list])
->andWhere(['catalog_id' => $_GET['catalog_id']])
->andWhere(['status' => 'current'])
->andWhere(['attribute_1' => 'correct'])
->groupBy(['type'])
->All();


$columns =  [//['class' => 'yii\grid\SerialColumn'],
            //  'id',
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


         ];
                

$tpatotal = 0;
$tpa_incorrect_total = 0;

$matpel_exception = ['tpa_1', 'tpa_2', 'tpa_3'];

foreach ($results as $result_key => $result_value) {

        if (!in_array($result_value->type , $matpel_exception)) {

    # code...
    array_push($columns,
                    [
                    'label' => $result_value->type . ' betul',
                     'encodeLabel' => false,
                    'value' => function($data) use ($result_value){
                        $result = Result::find()->andWhere(['type' => $result_value->type])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'correct'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? $result->value.'' : '0';
                    }]);
    array_push($columns,
                    [
                    'label' => $result_value->type . ' salah',
                     'encodeLabel' => false,
                    'value' => function($data) use ($result_value){
                        $result = Result::find()->andWhere(['type' => $result_value->type])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'incorrect'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? $result->value.'' : '0';
                    }]);
    array_push($columns,
                    [
                    'label' => $result_value->type . ' kosong',
                     'encodeLabel' => false,
                    'value' => function($data) use ($result_value){
                        $result = Result::find()->andWhere(['type' => $result_value->type])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'unanswered'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? $result->value.'' : '0';
                    }]);
    array_push($columns,
                    [
                    'label' => $result_value->type . ' poin',
                     'encodeLabel' => false,
                    'value' => function($data) use ($result_value){
                        $result = Result::find()->andWhere(['type' => $result_value->type])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'correct'])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? round($result->value / 15 * 60).'%' : '0%';
                    }]);
} else {
    $tpatotal = $tpatotal + $result_value->value;
                        $incorrect_result = Result::find()->andWhere(['type' => $result_value->type])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'incorrect'])
                        ->andWhere(['catalog_id' => $_GET['catalog_id']])->One();
    $tpa_incorrect_total = $tpa_incorrect_total + $incorrect_result->value;
}
                    
}


    array_push($columns,
                    [
                    'label' => 'tpa betul',
                     'encodeLabel' => false,
                    'value' => function($data) use ($tpatotal){
                      
                        return isset($tpatotal) ? $tpatotal .'' : '0';
                    }]);

    array_push($columns,
                    [
                    'label' => 'tpa salah',
                     'encodeLabel' => false,
                    'value' => function($data) use ($tpa_incorrect_total){
                      
                        return isset($tpa_incorrect_total) ? $tpa_incorrect_total .'' : '0';
                    }]);
        array_push($columns,
                    [
                    'label' => 'tpa kosong',
                     'encodeLabel' => false,
                    'value' => function($data) use ($tpatotal, $tpa_incorrect_total){
                      
                        return isset($tpatotal) ? (45 - ($tpatotal + $tpa_incorrect_total)) .'' : '0';
                    }]);
            array_push($columns,
                    [
                    'label' => 'tpa poin',
                     'encodeLabel' => false,
                    'value' => function($data) use ($tpatotal){
                      
                        return isset($tpatotal) ? round($tpatotal / 45 * 100) .'%' : '0%';
                    }]);




                array_push($columns,          [
            'label' => 'Point',
            'attribute' => 'resultsum',
            'value' => function($data) {
                return number_format($data->resultsum,2);
            }
         ]);

echo GridView::widget([
        'dataProvider' => $takers,
        'filterModel' => $searchModel,
        //'headerRowOptions' => ['colspan'=>'2'],
        'columns' => $columns,
           

            
            //'description:ntext',
            //'imageUrl:url',
            //'status',

        //    ['class' => 'yii\grid\ActionColumn'],
        
    ]); 

$soc = $takers->getModels();

?>
</div>
</div>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
