<<<<<<< HEAD
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
=======
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="container background-form">
	<div class="img-logo-center form-box">
		<center>
			<?php echo Html::img('/images/ppsdm-logo-atas.png', ['class' => 'img-responsive', 'alt' => 'logo']); ?>
		</center>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4" id="login">
      <form id="form-signup" action="/index.php/site/signup" method="post" role="form">
				<div class="form-group">
					<div class="input-group">
						<div class="icon-input">
							<?php echo Html::img('/images/icon-user.png', ['class' => 'icon-input', 'alt' => 'icon']); ?>
						</div>
						<div class="form-input">
							<input type="text" class="form-control" id="username" name="SignupForm[username]" placeholder="Username" autofocus aria-required="true">
						</div>
					</div>
				</div>
        <div class="form-group">
					<div class="input-group">
						<div class="icon-input">
							<?php echo Html::img('/images/icon-email.png', ['class' => 'icon-input', 'alt' => 'icon']); ?>
						</div>
						<div class="form-input">
							<input type="text" class="form-control" id="email" name="SignupForm[email]" aria-required="true" placeholder="Email">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="icon-input">
							<?php echo Html::img('/images/icon-password.png', ['class' => 'icon-input', 'alt' => 'icon']); ?>
						</div>
						<div class="form-input">
							<input type="password" class="form-control" id="password" name="SignupForm[password]" aria-required="true" placeholder="Password">
						</div>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success" name="signup-button" style="border-radius:0px; width:100%;">Signup</button>
				</div>
				<div class="form-group">
					<a href="/index.php/site/login"><input type="button" class="btn btn-primary" value="Login" style="border-radius:0px; width: 100%;"></a>
    		</div>
   			<div class="form-group">
    					<div style="color: black; font-size: 15px; float: right; margin-right: 10px;">
								<a href="/index.php/site/request-password-reset">Reset Password</a>
							</div>
				</div>
			</form>
  		</div>
			<div class="col-md-6 col-md-offset-3">
				<div class="info">
					<center>
						<?php echo Html::img('/images/product.png', ['class' => 'img-responsive', 'alt' => 'logo']); ?>
					</center>
				</div>
			</div>
			<div class="col-md-6 col-md-offset-3">
				<div class="info">
					<center>
						<b><p>
							KONSULTAN PSIKOLOGI DAN PENGEMBANGAN SDM<br>
							Gedung ILP Pusat, Lt. III
						</p></b>
						<p>
							Jl. Raya Pasar Minggu No. 39 A Pancoran, Jakarta Selatan 12780, <br>
							Telp. (021) 7940525, (021) 79181128 fax: (021) 79101921 <br>
							psippsdm@yahoo.com
						</p>
					</center>
				</div>
			</div>
	</div>
</div>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
