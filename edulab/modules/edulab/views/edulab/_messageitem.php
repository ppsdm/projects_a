<?php
use yii\helpers\Html;
use common\modules\assessment\models\Assessment;
use common\modules\assessment\models\AssessmentResult;
use common\modules\catalog\models\CatalogGeneral;
//use common\modules\profile\models\ProfileExtended;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\assets\AppAsset;
use app\assets\EdulabAsset;
use yii\bootstrap\Modal;
use yii\helpers\Url;

AppAsset::register($this);
EdulabAsset::register($this);
?>

							<div class="col-md-6 col-lg-3 col-sm-6" style="margin-top: 20px">
								<div class="panel panel-default panel-white core-box">
									<div class="panel-tools">
										<a href="#" class="btn btn-xs btn-link panel-close">
											<i class="fa fa-times"></i>
										</a>
									</div>
									<div class="panel-body no-padding">

										<div class="padding-20 core-content">
											<h3 class="title block no-margin"><?=$model->id?></h3>
											<span class="subtitle"><?=$model->message?></span>
										</div>
									</div>
									<div class="panel-footer clearfix no-padding">
										<div class=""></div>
<a href="../catalog/view?id=<?=$model->id?>" class="col-xs-4 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="" data-original-title="More Options"><i class="fa fa-cog"></i>Info</a>

										<!---a id="modalButtonTO" value="../catalog/view?id=<?=$model->id?>" class="col-xs-4 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="" data-original-title="More Options"><i class="fa fa-cog"></i>Info</a------>
										   		<?php
										   		
											       Modal::begin([
											           'header' => '<h4>Info '.$model->id.'</h4>',
											           'id' => 'modalTO',
											           'size' => 'modal-sm',
											           'class' => 'modal2',
											       ]);
											       echo "<div id='modalContent2'>
											       </div>";
											       Modal::End();
											   ?>
										<?php
	$current_assessment = Assessment::find()->andWhere(['catalog_id' => $model->id])->orderBy(['id'=> SORT_DESC])->andWhere(['user_id' => Yii::$app->user->id])->One();

$cls = "col-xs-8 padding-10 text-center text-white tooltips partition-red";
												$txt = "Lihat report";
                                                $lnk = "../report/view?catalog_id=".$model->id ;



	
										?>
												<a id="" href="<?=$lnk?>" class="<?=$cls?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="More Options"><i class="fa fa-cog"></i><?=$txt?></a>

												<!---a id="modalButtonStart" value="<?=$lnk?>" class="<?=$cls?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="More Options"><i class="fa fa-cog"></i><?=$txt?></a------->

										   		<?php
										   		
											       Modal::begin([
											           'header' => '<h4>Info '.$model->id.'</h4>',
											           'id' => 'modalStart',
											           'size' => 'modal-sm',
											           'class' => 'modal2',
											       ]);
											       echo "<div id='modalContent2'>
											       </div>";
											       Modal::End();
											   ?>
									</div>
								</div>
							</div>

