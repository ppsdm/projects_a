<<<<<<< HEAD
<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
// TO 1
  $tpa_1 = 60;
  $mtk_1 = 50;
  $bind_1 = 55;
  $bing_1 = 40;
  $fisika_1 = 70;
  $kimia_1 = 40;
  $biologi_1 = 80;
  $ekonomi_1 = 55;
  $tpa_1_avg = 60;
  $mtk_1_avg = 50;
  $bind_1_avg = 55;
  $bing_1_avg = 40;
  $fisika_1_avg = 70;
  $kimia_1_avg = 40;
  $biologi_1_avg = 80;
  $ekonomi_1_avg = 55;
// TO 2
  $tpa_2 = 80;
  $mtk_2 = 70;
  $bind_2 = 55;
  $bing_2 = 40;
  $fisika_2 = 70;
  $kimia_2 = 40;
  $biologi_2 = 80;
  $ekonomi_2 = 55;
  $tpa_2_avg = 80;
  $mtk_2_avg = 70;
  $bind_2_avg = 55;
  $bing_2_avg = 40;
  $fisika_2_avg = 70;
  $kimia_2_avg = 40;
  $biologi_2_avg = 80;
  $ekonomi_2_avg = 55;
// TO 3
  $tpa_3 = 60;
  $mtk_3 = 50;
  $bind_3 = 55;
  $bing_3 = 40;
  $fisika_3 = 70;
  $kimia_3 = 80;
  $biologi_3 = 70;
  $ekonomi_3 = 65;
  $tpa_3_avg = 60;
  $mtk_3_avg = 50;
  $bind_3_avg = 55;
  $bing_3_avg = 40;
  $fisika_3_avg = 70;
  $kimia_3_avg = 80;
  $biologi_3_avg = 70;
  $ekonomi_3_avg = 65;
// TO 4
  $tpa_4 = 60;
  $mtk_4 = 50;
  $bind_4 = 55;
  $bing_4 = 80;
  $fisika_4 = 40;
  $kimia_4 = 40;
  $biologi_4 = 80;
  $ekonomi_4 = 75;
  $tpa_4_avg = 60;
  $mtk_4_avg = 50;
  $bind_4_avg = 55;
  $bing_4_avg = 80;
  $fisika_4_avg = 40;
  $kimia_4_avg = 40;
  $biologi_4_avg = 80;
  $ekonomi_4_avg = 75;
// TO 5
  $tpa_5 = 80;
  $mtk_5 = 60;
  $bind_5 = 75;
  $bing_5 = 60;
  $fisika_5 = 80;
  $kimia_5 = 50;
  $biologi_5 = 90;
  $ekonomi_5 = 95;
  $tpa_5_avg = 80;
  $mtk_5_avg = 60;
  $bind_5_avg = 75;
  $bing_5_avg = 60;
  $fisika_5_avg = 80;
  $kimia_5_avg = 50;
  $biologi_5_avg = 90;
  $ekonomi_5_avg = 95;

  //TPA
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'TPA',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
   
            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
                'data' => [$tpa_1, $tpa_2, $tpa_3, $tpa_4, $tpa_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$tpa_1_avg, $tpa_2_avg, $tpa_3_avg, $tpa_4_avg, $tpa_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[1]'),
                    'fillColor' => 'pink',
                ],
            ],
            
        ],
    ]
]);


  //MATEMATIKA
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'MATEMATIKA',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
   
            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
                'data' => [$mtk_1, $mtk_2, $mtk_3, $mtk_4, $mtk_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$mtk_1_avg, $mtk_2_avg, $mtk_3_avg, $mtk_4_avg, $mtk_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[2]'),
                    'fillColor' => 'red',
                ],
            ],
            
        ],
    ]
]);

  //BAHASA INDONESIA
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'BAHASA INDONESIA',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
   
            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
                'data' => [$bind_1, $bind_2, $bind_3, $bind_4, $bind_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$bind_1_avg, $bind_2_avg, $bind_3_avg, $bind_4_avg, $bind_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[3]'),
                    'fillColor' => 'white',
                ],
            ],
            
        ],
    ]
]);


  //BAHASA INGGRIS
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'BAHASA INGGRIS',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
   
            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
                'data' => [$bing_1, $bing_2, $bing_3, $bing_4, $bing_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$bing_1_avg, $bing_2_avg, $bing_3_avg, $bing_4_avg, $bing_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[4]'),
                    'fillColor' => 'blue',
                ],
            ],
            
        ],
    ]
]);


  //FISIKA
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'FISIKA',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
   
            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
                'data' => [$fisika_1, $fisika_2, $fisika_3, $fisika_4, $fisika_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$fisika_1_avg, $fisika_2_avg, $fisika_3_avg, $fisika_4_avg, $fisika_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[5]'),
                    'fillColor' => 'purple',
                ],
            ],
            
        ],
    ]
]);


  //KIMIA
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'KIMIA',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
   
            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
                'data' => [$kimia_1, $kimia_2, $kimia_3, $kimia_4, $kimia_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$kimia_1_avg, $kimia_2_avg, $kimia_3_avg, $kimia_4_avg, $kimia_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[6]'),
                    'fillColor' => 'yellow',
                ],
            ],
            
        ],
    ]
]);

  //BIOLOGI
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'BIOLOGI',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
   
            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
                'data' => [$biologi_1, $biologi_2, $biologi_3, $biologi_4, $biologi_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$biologi_1_avg, $biologi_2_avg, $biologi_3_avg, $biologi_4_avg, $biologi_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[7]'),
                    'fillColor' => 'green',
                ],
            ],
            
        ],
    ]
]);

  //MATEMATIKA IPA
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'MATEMATIKA IPA',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
   
            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
                'data' => [$ekonomi_1, $ekonomi_2, $ekonomi_3, $ekonomi_4, $ekonomi_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$ekonomi_1_avg, $ekonomi_2_avg, $ekonomi_3_avg, $ekonomi_4_avg, $ekonomi_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[8]'),
                    'fillColor' => 'black',
                ],
            ],
            
        ],
    ]
]);

?>

=======
<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
// TO 1
  $tpa_1 = 60;
  $mtk_1 = 50;
  $bind_1 = 55;
  $bing_1 = 40;
  $fisika_1 = 70;
  $kimia_1 = 40;
  $biologi_1 = 80;
  $ekonomi_1 = 55;
  $tpa_1_avg = 60;
  $mtk_1_avg = 50;
  $bind_1_avg = 55;
  $bing_1_avg = 40;
  $fisika_1_avg = 70;
  $kimia_1_avg = 40;
  $biologi_1_avg = 80;
  $ekonomi_1_avg = 55;
// TO 2
  $tpa_2 = 80;
  $mtk_2 = 70;
  $bind_2 = 55;
  $bing_2 = 40;
  $fisika_2 = 70;
  $kimia_2 = 40;
  $biologi_2 = 80;
  $ekonomi_2 = 55;
  $tpa_2_avg = 80;
  $mtk_2_avg = 70;
  $bind_2_avg = 55;
  $bing_2_avg = 40;
  $fisika_2_avg = 70;
  $kimia_2_avg = 40;
  $biologi_2_avg = 80;
  $ekonomi_2_avg = 55;
// TO 3
  $tpa_3 = 60;
  $mtk_3 = 50;
  $bind_3 = 55;
  $bing_3 = 40;
  $fisika_3 = 70;
  $kimia_3 = 80;
  $biologi_3 = 70;
  $ekonomi_3 = 65;
  $tpa_3_avg = 60;
  $mtk_3_avg = 50;
  $bind_3_avg = 55;
  $bing_3_avg = 40;
  $fisika_3_avg = 70;
  $kimia_3_avg = 80;
  $biologi_3_avg = 70;
  $ekonomi_3_avg = 65;
// TO 4
  $tpa_4 = 60;
  $mtk_4 = 50;
  $bind_4 = 55;
  $bing_4 = 80;
  $fisika_4 = 40;
  $kimia_4 = 40;
  $biologi_4 = 80;
  $ekonomi_4 = 75;
  $tpa_4_avg = 60;
  $mtk_4_avg = 50;
  $bind_4_avg = 55;
  $bing_4_avg = 80;
  $fisika_4_avg = 40;
  $kimia_4_avg = 40;
  $biologi_4_avg = 80;
  $ekonomi_4_avg = 75;
// TO 5
  $tpa_5 = 80;
  $mtk_5 = 60;
  $bind_5 = 75;
  $bing_5 = 60;
  $fisika_5 = 80;
  $kimia_5 = 50;
  $biologi_5 = 90;
  $ekonomi_5 = 95;
  $tpa_5_avg = 80;
  $mtk_5_avg = 60;
  $bind_5_avg = 75;
  $bing_5_avg = 60;
  $fisika_5_avg = 80;
  $kimia_5_avg = 50;
  $biologi_5_avg = 90;
  $ekonomi_5_avg = 95;

  //TPA
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'TPA',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
   
            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
                'data' => [$tpa_1, $tpa_2, $tpa_3, $tpa_4, $tpa_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$tpa_1_avg, $tpa_2_avg, $tpa_3_avg, $tpa_4_avg, $tpa_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[1]'),
                    'fillColor' => 'pink',
                ],
            ],
            
        ],
    ]
]);


  //MATEMATIKA
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'MATEMATIKA',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
   
            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
                'data' => [$mtk_1, $mtk_2, $mtk_3, $mtk_4, $mtk_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$mtk_1_avg, $mtk_2_avg, $mtk_3_avg, $mtk_4_avg, $mtk_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[2]'),
                    'fillColor' => 'red',
                ],
            ],
            
        ],
    ]
]);

  //BAHASA INDONESIA
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'BAHASA INDONESIA',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
   
            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
                'data' => [$bind_1, $bind_2, $bind_3, $bind_4, $bind_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$bind_1_avg, $bind_2_avg, $bind_3_avg, $bind_4_avg, $bind_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[3]'),
                    'fillColor' => 'white',
                ],
            ],
            
        ],
    ]
]);


  //BAHASA INGGRIS
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'BAHASA INGGRIS',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
   
            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
                'data' => [$bing_1, $bing_2, $bing_3, $bing_4, $bing_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$bing_1_avg, $bing_2_avg, $bing_3_avg, $bing_4_avg, $bing_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[4]'),
                    'fillColor' => 'blue',
                ],
            ],
            
        ],
    ]
]);


  //FISIKA
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'FISIKA',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
   
            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
                'data' => [$fisika_1, $fisika_2, $fisika_3, $fisika_4, $fisika_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$fisika_1_avg, $fisika_2_avg, $fisika_3_avg, $fisika_4_avg, $fisika_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[5]'),
                    'fillColor' => 'purple',
                ],
            ],
            
        ],
    ]
]);


  //KIMIA
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'KIMIA',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
   
            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
                'data' => [$kimia_1, $kimia_2, $kimia_3, $kimia_4, $kimia_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$kimia_1_avg, $kimia_2_avg, $kimia_3_avg, $kimia_4_avg, $kimia_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[6]'),
                    'fillColor' => 'yellow',
                ],
            ],
            
        ],
    ]
]);

  //BIOLOGI
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'BIOLOGI',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
   
            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
                'data' => [$biologi_1, $biologi_2, $biologi_3, $biologi_4, $biologi_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$biologi_1_avg, $biologi_2_avg, $biologi_3_avg, $biologi_4_avg, $biologi_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[7]'),
                    'fillColor' => 'green',
                ],
            ],
            
        ],
    ]
]);

  //MATEMATIKA IPA
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'MATEMATIKA IPA',
        ],
        'xAxis' => [
            'categories' => ['TO 1', 'TO 2', 'B.TO 3', 'TO 4', 'TO 5'],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => '',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
   
            [
                'type' => 'column',
                'name' => Yii::$app->user->identity->username,
                'data' => [$ekonomi_1, $ekonomi_2, $ekonomi_3, $ekonomi_4, $ekonomi_5],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [$ekonomi_1_avg, $ekonomi_2_avg, $ekonomi_3_avg, $ekonomi_4_avg, $ekonomi_5_avg],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[8]'),
                    'fillColor' => 'black',
                ],
            ],
            
        ],
    ]
]);

?>

>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
