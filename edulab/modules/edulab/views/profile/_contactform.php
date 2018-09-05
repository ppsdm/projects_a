<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\profile\models\ProfileExtended;
use app\modules\profile\models\ProfileGeneral;
use app\models\ImageUpload;
use kartik\sidenav\SideNav;
use kartik\file\FileInput;
use yii\jui\DatePicker;
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
                            <label for="exampleInputEmail1">Email address</label>
                        <?php
                            echo Html::input('text','email',$email,['readonly' => true, 'class'=>'form-control', 'placeholder' => 'Email']);
                        ?>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Mobile</label>
                              <?php
                            echo Html::input('text','mobile',$mobile,['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Mobile Phone']);
                              ?>
                          </div>


                          <div class="form-group">
                            <label for="exampleInputEmail1">Home Phone</label>
                              <?php
                            echo Html::input('text','home',$home,['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Home Phone']);
                              ?>
                          </div>

                            <div class="form-group">
                            <label for="exampleInputEmail1">Work Phone</label>
                              <?php
                            echo Html::input('text','work',$work,['readonly' => false, 'class'=>'form-control', 'placeholder' => 'Work Phone']);
                              ?>
                          </div>


                            <div class="form-group">
                            <label for="exampleInputEmail1">Home Address</label>
                              <?php
                                        echo Html::textArea('home_address',$home_address,['class'=>'form-control', 'rows' => '3']);
                              ?>
                          </div>

                            <div class="form-group">
                            <label for="exampleInputEmail1">Work Address</label>
                              <?php
                                        echo Html::textArea('work_address',$work_address,['class'=>'form-control', 'rows' => '3']);
                              ?>
                          </div>


                            <div class="form-group">
                                <?= Html::submitButton( Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>

                          </div>