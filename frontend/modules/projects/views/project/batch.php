<?php
/* @var $this yii\web\View */
?>
<h1>PROJECT DASHBOARD</h1>

<p>

</p>
<div>


	<?php



					//$im1=Yii::getAlias('@vendor').'/gamantha/pao/project/views/project/_'.$value->value.'.php';
					$im1=Yii::getAlias('@app').'/modules/projects/views/project/'.$_GET['id'].'/_second_opinion_bybatch.php';

					if (file_exists($im1)) {
					  					echo $this->render($_GET['id'] . '/_second_opinion_bybatch', [
					        				//'model' => $model,
					        				//'searchresult' => $searchresult,
					    				]);
					} else {
					    echo '_second_opinion_bybatch doesnt exists';
					}


  				
    		
	?>


</div>