<<<<<<< HEAD
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


										<?php
	$current_assessment = Assessment::find()->andWhere(['catalog_id' => $model->id])->orderBy(['id'=> SORT_DESC])->andWhere(['user_id' => Yii::$app->user->id])->One();

										
if (null == $current_assessment) {

} else {

?>


							<div class="col-md-6 col-lg-3 col-sm-6" style="margin-top: 20px">
								<div class="panel panel-default panel-white core-box">
									<div class="panel-tools">
										<a href="#" class="btn btn-xs btn-link panel-close">
											<i class="fa fa-times"></i>
										</a>
									</div>
									<div class="panel-body no-padding">
										<div class="partition-green padding-5 text-center core-icon">
										<?= Html::img($model->imageUrl, ['alt' => 'My logo', 'width' => '75px', 'style' => 'padding-top: 15px;']) ?>
										</div>
										<div class="padding-20 core-content">
											<h3 class="title block no-margin"><?=$model->name?></h3>
											<span class="subtitle"><?=$model->attribute2?></span>
										</div>
									</div>
									<div class="panel-footer clearfix no-padding">
										<div class=""></div>
<a href="../catalog/view?id=<?=$model->id?>" class="col-xs-4 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="" data-original-title="More Options"><i class="fa fa-cog"></i>Info</a>

										<!---a id="modalButtonTO" value="../catalog/view?id=<?=$model->id?>" class="col-xs-4 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="" data-original-title="More Options"><i class="fa fa-cog"></i>Info</a------>
										   		<?php
										   		
											       Modal::begin([
											           'header' => '<h4>Info '.$model->name.'</h4>',
											           'id' => 'modalTO',
											           'size' => 'modal-sm',
											           'class' => 'modal2',
											       ]);
											       echo "<div id='modalContent2'>
											       </div>";
											       Modal::End();
											   ?>

<?php






	$resume_state = AssessmentResult::find()->andWhere(['assessment_id' => $current_assessment->id])->One();
	if(null == $resume_state) {
		$resume_status = 'Kerjakan assessment baru';
	} else {
			$resume_status = 'Lanjutkan pengerjaan';
	}


											if ($current_assessment->status == 'active')
											{
												$cls = "col-xs-8 padding-10 text-center text-white tooltips partition-orange";
												$txt = $resume_status;
                                                $lnk = "../assessment/start?catalog_id=".$model->id ;
											} else if ($current_assessment->status == 'finished')
											{
												$cls = "col-xs-8 padding-10 text-center text-white tooltips partition-green";
												$txt = "Result";
                                                $lnk = "../assessment/result?catalog_id=".$model->id ;
											}
											else
											{
												$cls = "col-xs-8 padding-10 text-center text-white tooltips partition-red";
												$txt = "Daftar";
                                                $lnk = "../assessment/register?catalog_id=".$model->id ;
											}
}
											

	
										?>
												
												

										   		<?php
										   		
											       Modal::begin([
											           'header' => '<h4>Info '.$model->name.'</h4>',
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

=======
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


										<?php
	$current_assessment = Assessment::find()->andWhere(['catalog_id' => $model->id])->orderBy(['id'=> SORT_DESC])->andWhere(['user_id' => Yii::$app->user->id])->One();

										
if (null == $current_assessment) {

} else {

?>


							<div class="col-md-6 col-lg-3 col-sm-6" style="margin-top: 20px">
								<div class="panel panel-default panel-white core-box">
									<div class="panel-tools">
										<a href="#" class="btn btn-xs btn-link panel-close">
											<i class="fa fa-times"></i>
										</a>
									</div>
									<div class="panel-body no-padding">
										<div class="partition-green padding-5 text-center core-icon">
										<?= Html::img($model->imageUrl, ['alt' => 'My logo', 'width' => '75px', 'style' => 'padding-top: 15px;']) ?>
										</div>
										<div class="padding-20 core-content">
											<h3 class="title block no-margin"><?=$model->name?></h3>
											<span class="subtitle"><?=$model->attribute2?></span>
										</div>
									</div>
									<div class="panel-footer clearfix no-padding">
										<div class=""></div>
<a href="../catalog/view?id=<?=$model->id?>" class="col-xs-4 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="" data-original-title="More Options"><i class="fa fa-cog"></i>Info</a>

										<!---a id="modalButtonTO" value="../catalog/view?id=<?=$model->id?>" class="col-xs-4 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="" data-original-title="More Options"><i class="fa fa-cog"></i>Info</a------>
										   		<?php
										   		
											       Modal::begin([
											           'header' => '<h4>Info '.$model->name.'</h4>',
											           'id' => 'modalTO',
											           'size' => 'modal-sm',
											           'class' => 'modal2',
											       ]);
											       echo "<div id='modalContent2'>
											       </div>";
											       Modal::End();
											   ?>

<?php






	$resume_state = AssessmentResult::find()->andWhere(['assessment_id' => $current_assessment->id])->One();
	if(null == $resume_state) {
		$resume_status = 'Kerjakan assessment baru';
	} else {
			$resume_status = 'Lanjutkan pengerjaan';
	}


											if ($current_assessment->status == 'active')
											{
												$cls = "col-xs-8 padding-10 text-center text-white tooltips partition-orange";
												$txt = $resume_status;
                                                $lnk = "../assessment/start?catalog_id=".$model->id ;
											} else if ($current_assessment->status == 'finished')
											{
												$cls = "col-xs-8 padding-10 text-center text-white tooltips partition-green";
												$txt = "Result";
                                                $lnk = "../assessment/result?catalog_id=".$model->id ;
											}
											else
											{
												$cls = "col-xs-8 padding-10 text-center text-white tooltips partition-red";
												$txt = "Daftar";
                                                $lnk = "../assessment/register?catalog_id=".$model->id ;
											}
}
											

	
										?>
												
												

										   		<?php
										   		
											       Modal::begin([
											           'header' => '<h4>Info '.$model->name.'</h4>',
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

>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
