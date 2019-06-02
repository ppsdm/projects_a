<<<<<<< HEAD
<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\modules\profile\models\ProfileExtended;
use app\modules\profile\models\ProfileGeneral;
use app\models\ImageUpload;
use kartik\sidenav\SideNav;
use kartik\file\FileInput;
use yii\jui\DatePicker;
use common\models\RefValue;
//use kartik\widgets\DatePicker;
//use app\assets\AppAsset;
//use app\assets\EdulabAsset;
//use app\assets\SortAsset;


//AppAsset::register($this);
//EdulabAsset::register($this);
//SortAsset::register($this);



/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileGeneral */
/* @var $form yii\widgets\ActiveForm */
?>
                            

<div class="profile-general-form">

                   <?php $form = ActiveForm::begin(); ?>

                 

                         <div class="form-group">
<p>Forum Setting</p>





                                                                 <div class="form-group">
                            <label for="ed_level">Time Zone</label>
                              <?php
                                $timezones = RefValue::find()->andWhere(['type' => 'profile'])
                                ->andWhere(['key' => 'timezone'])
                                ->andWhere(['not',['value' => 'other']])
                                ->asArray()->All();
                                $timezone_selection = ArrayHelper::map($timezones, 'value', 'attribute_1');
                                $timezone_selection['other'] = 'Other';
                                //array_push($location_selection, ['other' => 'Other']);
                              //$location_selection = ['bandung' => 'Bandung', 'jakarta' => 'Jakarta', 'other' => 'Other'];
                            //echo Html::input('text','ed_level',$edlevel,['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Ed level']);
                            echo Html::dropDownList('timezone', $timezone,$timezone_selection, ['prompt' => 'Pilih timezone...','class' => 'form-control']);
                                //$form->field($model, 'status')->dropDownList([ 'smaxiiipa' => 'sma XII IPA', 'smaxiiips' => 'Sma Xii IPS', ], ['prompt' => '']);
                              ?>
                          </div>



                                                                 <div class="form-group">
                            <label for="ed_level">Location</label>
                              <?php
                                $locations = RefValue::find()->andWhere(['type' => 'edulab'])
                                ->andWhere(['key' => 'location'])
                                ->andWhere(['not',['value' => 'other']])
                                ->asArray()->All();
                                $location_selection = ArrayHelper::map($locations, 'value', 'attribute_1');
                                $location_selection['other'] = 'Other';
                                //array_push($location_selection, ['other' => 'Other']);
                              //$location_selection = ['bandung' => 'Bandung', 'jakarta' => 'Jakarta', 'other' => 'Other'];
                            echo Html::input('text','profile_location',$profile_location,['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Your whereabouts...']);
                            //echo Html::dropDownList('profile_location', $profile_location,$location_selection, ['prompt' => 'Pilih lokasi...','class' => 'form-control']);
                                //$form->field($model, 'status')->dropDownList([ 'smaxiiipa' => 'sma XII IPA', 'smaxiiips' => 'Sma Xii IPS', ], ['prompt' => '']);
                              ?>
                          </div>



                            <div class="form-group">
                                <?= Html::submitButton( Yii::t('app', 'Update'), ['class' => 'btn btn-primary', 'data-confirm' => 'are you sure?']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
=======
<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\modules\profile\models\ProfileExtended;
use app\modules\profile\models\ProfileGeneral;
use app\models\ImageUpload;
use kartik\sidenav\SideNav;
use kartik\file\FileInput;
use yii\jui\DatePicker;
use common\models\RefValue;
//use kartik\widgets\DatePicker;
//use app\assets\AppAsset;
//use app\assets\EdulabAsset;
//use app\assets\SortAsset;


//AppAsset::register($this);
//EdulabAsset::register($this);
//SortAsset::register($this);



/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\ProfileGeneral */
/* @var $form yii\widgets\ActiveForm */
?>
                            

<div class="profile-general-form">

                   <?php $form = ActiveForm::begin(); ?>

                 

                         <div class="form-group">
<p>Forum Setting</p>





                                                                 <div class="form-group">
                            <label for="ed_level">Time Zone</label>
                              <?php
                                $timezones = RefValue::find()->andWhere(['type' => 'profile'])
                                ->andWhere(['key' => 'timezone'])
                                ->andWhere(['not',['value' => 'other']])
                                ->asArray()->All();
                                $timezone_selection = ArrayHelper::map($timezones, 'value', 'attribute_1');
                                $timezone_selection['other'] = 'Other';
                                //array_push($location_selection, ['other' => 'Other']);
                              //$location_selection = ['bandung' => 'Bandung', 'jakarta' => 'Jakarta', 'other' => 'Other'];
                            //echo Html::input('text','ed_level',$edlevel,['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Ed level']);
                            echo Html::dropDownList('timezone', $timezone,$timezone_selection, ['prompt' => 'Pilih timezone...','class' => 'form-control']);
                                //$form->field($model, 'status')->dropDownList([ 'smaxiiipa' => 'sma XII IPA', 'smaxiiips' => 'Sma Xii IPS', ], ['prompt' => '']);
                              ?>
                          </div>



                                                                 <div class="form-group">
                            <label for="ed_level">Location</label>
                              <?php
                                $locations = RefValue::find()->andWhere(['type' => 'edulab'])
                                ->andWhere(['key' => 'location'])
                                ->andWhere(['not',['value' => 'other']])
                                ->asArray()->All();
                                $location_selection = ArrayHelper::map($locations, 'value', 'attribute_1');
                                $location_selection['other'] = 'Other';
                                //array_push($location_selection, ['other' => 'Other']);
                              //$location_selection = ['bandung' => 'Bandung', 'jakarta' => 'Jakarta', 'other' => 'Other'];
                            echo Html::input('text','profile_location',$profile_location,['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Your whereabouts...']);
                            //echo Html::dropDownList('profile_location', $profile_location,$location_selection, ['prompt' => 'Pilih lokasi...','class' => 'form-control']);
                                //$form->field($model, 'status')->dropDownList([ 'smaxiiipa' => 'sma XII IPA', 'smaxiiips' => 'Sma Xii IPS', ], ['prompt' => '']);
                              ?>
                          </div>



                            <div class="form-group">
                                <?= Html::submitButton( Yii::t('app', 'Update'), ['class' => 'btn btn-primary', 'data-confirm' => 'are you sure?']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
                          </div>