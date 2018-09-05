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

$results = Result::find()
//->select(['*, SUM(value) as totalscore, COUNT(value) as totalcount'])
//->andWhere(['in','catalog_id', $catalog_item_list])
->andWhere(['catalog_id' => $_GET['catalog_id']])
->andWhere(['status' => 'current'])
->andWhere(['attribute_1' => 'correct'])
->groupBy(['type'])
->All();

$columns =  [['class' => 'yii\grid\SerialColumn'],
            //  'id',
              //  'user_id',
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
                



$matpel_exception = ['tpa_1', 'tpa_2', 'tpa_3'];


$tpatotal = [];
$tpa_incorrect_total = [];


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
                        ->andWhere(['assessment_id' => ($data->id)])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? number_format($result->value,2).'' : '0.00';
                    }]);
    array_push($columns,
                    [
                    'label' => $result_value->type . ' salah',
                     'encodeLabel' => false,
                    'value' => function($data) use ($result_value){
                        $result = Result::find()->andWhere(['type' => $result_value->type])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'incorrect'])
                        ->andWhere(['assessment_id' => ($data->id)])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? number_format($result->value,2).'' : '0.00';
                    }]);
    array_push($columns,
                    [
                    'label' => $result_value->type . ' kosong',
                     'encodeLabel' => false,
                    'value' => function($data) use ($result_value){
                        $result = Result::find()->andWhere(['type' => $result_value->type])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'unanswered'])
                        ->andWhere(['assessment_id' => ($data->id)])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? number_format($result->value,2).'' : '0.00';
                    }]);
    array_push($columns,
                    [
                    'label' => $result_value->type . ' poin',
                     'encodeLabel' => false,
                    'value' => function($data) use ($result_value){
                        $result = Result::find()->andWhere(['type' => $result_value->type])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'correct'])
                        ->andWhere(['assessment_id' => ($data->id)])
                        ->andWhere(['catalog_id' => $data->catalog_id])->One();
                        return isset($result->value) ? number_format($result->value / 15 * 100 , 2) : '0.00';
                    }]);
} else {
    $prev_tpatotal = isset($tpatotal[$result_value->assessment_id]) ? $tpatotal[$result_value->assessment_id] : 0;
    $prev_tpa_incorrect_total = isset($tpa_incorrect_total[$result_value->assessment_id]) ? $tpa_incorrect_total[$result_value->assessment_id] : 0;
    $tpatotal[$result_value->assessment_id] = $prev_tpatotal + $result_value->value;
                        $incorrect_result = Result::find()->andWhere(['type' => $result_value->type])->andWhere(['status' => 'current'])
                        ->andWhere(['attribute_1' => 'incorrect'])
                        ->andWhere(['assessment_id' => ($result_value->assessment_id)])
                        ->andWhere(['catalog_id' => $_GET['catalog_id']])->One();
    $tpa_incorrect_total[$result_value->assessment_id] = $prev_tpa_incorrect_total + $incorrect_result->value;
}




              
}


    array_push($columns,
                    [
                    'label' => 'tpa betul',
                     'encodeLabel' => false,
                    'value' => function($data) use ($tpatotal){
                      
                        return isset($tpatotal[$data->id]) ? number_format($tpatotal[$data->id],2) .'' : '0.00';
                    }]);

    array_push($columns,
                    [
                    'label' => 'tpa salah',
                     'encodeLabel' => false,
                    'value' => function($data) use ($tpa_incorrect_total){
                      
                        return isset($tpa_incorrect_total[$data->id]) ? number_format($tpa_incorrect_total[$data->id],2) .'' : '0.00';
                    }]);
        array_push($columns,
                    [
                    'label' => 'tpa kosong',
                     'encodeLabel' => false,
                    'value' => function($data) use ($tpatotal, $tpa_incorrect_total){
                      
                        return isset($tpatotal[$data->id]) ? number_format((45 - ($tpatotal[$data->id] + $tpa_incorrect_total[$data->id])),2) .'' : '0.00';
                    }]);
            array_push($columns,
                    [
                    'label' => 'tpa poin',
                     'encodeLabel' => false,
                    'value' => function($data) use ($tpatotal){
                      
                        return isset($tpatotal[$data->id]) ? number_format($tpatotal[$data->id] / 45 * 100 ,2) : '0.00';
                    }]);



              






                array_push($columns,          [
            'label' => 'Total Point',
            'attribute' => 'resultsum',
            'value' => function($data) {
                return number_format($data->resultsum/210 * 100,2);
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