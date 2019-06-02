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
                          <p><i>
                            Update data edulab akan di-review dan di-verifikasikan terleboh dahulu oleh tim kami sebelum aktif. Pastikan anda sudah meninjau kembali data anda sebelum melakukan update
                          </i></p>
                            <label for="ed_level">Edulab ID</label>
                              <?php
                            echo Html::input('text','edulab_id',$edulab_id,['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Edulab ID']);

                              ?>
                          </div>




                                                                 <div class="form-group">
                            <label for="ed_level">Lokasi Edulab</label>
                              <?php
                                $locations = RefValue::find()->andWhere(['type' => 'edulab'])
                                ->andWhere(['key' => 'location'])
                                ->andWhere(['not',['value' => 'other']])
                                ->asArray()->All();
                                $location_selection = ArrayHelper::map($locations, 'value', 'attribute_1');
                                $location_selection['other'] = 'Other';
                                //array_push($location_selection, ['other' => 'Other']);
                              //$location_selection = ['bandung' => 'Bandung', 'jakarta' => 'Jakarta', 'other' => 'Other'];
                            //echo Html::input('text','ed_level',$edlevel,['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Ed level']);
                            echo Html::dropDownList('location', $location,$location_selection, ['prompt' => 'Pilih lokasi...','class' => 'form-control']);
                                //$form->field($model, 'status')->dropDownList([ 'smaxiiipa' => 'sma XII IPA', 'smaxiiips' => 'Sma Xii IPS', ], ['prompt' => '']);
                              ?>
                          </div>


                                               <div class="form-group">
                            <label for="ed_level"><?= Yii::t('app', 'Jenjang pendidikan')?></label>
                              <?php


                                                              $edlevels = RefValue::find()->andWhere(['type' => 'edulab'])
                                ->andWhere(['key' => 'ed_level'])
                                ->andWhere(['not',['value' => 'other']])
                                ->asArray()->All();

                                $edlevel_selection = ArrayHelper::map($edlevels, 'value', 'attribute_1');
                              if (isset($edlevel->value)) {
 //echo Html::input('text','ed_level',$edlevel->value,['readonly' => true, 'class'=>'form-control', 'placeholder' => 'Ed level']);
                            echo Html::dropDownList('ed_level', $edlevel->value,$edlevel_selection, ['class' => 'form-control', 'prompt' => 'Pilih jenjang pendidikan..', 'readonly' => false]);
                              } else {
                            //echo Html::input('text','ed_level',$edlevel,['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Ed level']);
                            echo Html::dropDownList('ed_level', $edlevel->value,$edlevel_selection, ['class' => 'form-control', 'prompt' => 'Pilih jenjang pendidikan...','readonly' => false]);
}

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
                          <p><i>
                            Update data edulab akan di-review dan di-verifikasikan terleboh dahulu oleh tim kami sebelum aktif. Pastikan anda sudah meninjau kembali data anda sebelum melakukan update
                          </i></p>
                            <label for="ed_level">Edulab ID</label>
                              <?php
                            echo Html::input('text','edulab_id',$edulab_id,['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Edulab ID']);

                              ?>
                          </div>




                                                                 <div class="form-group">
                            <label for="ed_level">Lokasi Edulab</label>
                              <?php
                                $locations = RefValue::find()->andWhere(['type' => 'edulab'])
                                ->andWhere(['key' => 'location'])
                                ->andWhere(['not',['value' => 'other']])
                                ->asArray()->All();
                                $location_selection = ArrayHelper::map($locations, 'value', 'attribute_1');
                                $location_selection['other'] = 'Other';
                                //array_push($location_selection, ['other' => 'Other']);
                              //$location_selection = ['bandung' => 'Bandung', 'jakarta' => 'Jakarta', 'other' => 'Other'];
                            //echo Html::input('text','ed_level',$edlevel,['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Ed level']);
                            echo Html::dropDownList('location', $location,$location_selection, ['prompt' => 'Pilih lokasi...','class' => 'form-control']);
                                //$form->field($model, 'status')->dropDownList([ 'smaxiiipa' => 'sma XII IPA', 'smaxiiips' => 'Sma Xii IPS', ], ['prompt' => '']);
                              ?>
                          </div>


                                               <div class="form-group">
                            <label for="ed_level"><?= Yii::t('app', 'Jenjang pendidikan')?></label>
                              <?php


                                                              $edlevels = RefValue::find()->andWhere(['type' => 'edulab'])
                                ->andWhere(['key' => 'ed_level'])
                                ->andWhere(['not',['value' => 'other']])
                                ->asArray()->All();

                                $edlevel_selection = ArrayHelper::map($edlevels, 'value', 'attribute_1');
                              if (isset($edlevel->value)) {
 //echo Html::input('text','ed_level',$edlevel->value,['readonly' => true, 'class'=>'form-control', 'placeholder' => 'Ed level']);
                            echo Html::dropDownList('ed_level', $edlevel->value,$edlevel_selection, ['class' => 'form-control', 'prompt' => 'Pilih jenjang pendidikan..', 'readonly' => false]);
                              } else {
                            //echo Html::input('text','ed_level',$edlevel,['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Ed level']);
                            echo Html::dropDownList('ed_level', $edlevel->value,$edlevel_selection, ['class' => 'form-control', 'prompt' => 'Pilih jenjang pendidikan...','readonly' => false]);
}

                                //$form->field($model, 'status')->dropDownList([ 'smaxiiipa' => 'sma XII IPA', 'smaxiiips' => 'Sma Xii IPS', ], ['prompt' => '']);
                              ?>
                          </div>


                            <div class="form-group">
                                <?= Html::submitButton( Yii::t('app', 'Update'), ['class' => 'btn btn-primary', 'data-confirm' => 'are you sure?']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
                          </div>