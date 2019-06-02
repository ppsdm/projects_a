<<<<<<< HEAD
<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\EdulabAsset;
use app\assets\SortAsset;
use common\widgets\Alert;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\icons\Icon;
use common\modules\profile\models\UserCredit;
use common\modules\profile\models\ProfileExtended;
use lo\modules\noty\Wrapper;

use common\models\Notification;
use machour\yii2\notifications\widgets\NotificationsWidget;
use common\modules\organization\models\OrganizationAdminuser;

AppAsset::register($this);
EdulabAsset::register($this);
//SortAsset::register($this);

$this->title = 'SiapNgampus.com | ';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

<div class="yellow-tittle">
<div class="container">
<h3>  <?php //Breadcrumbs::widget([
    //'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//]) ?></h3>
</div>
</div>

<div class="wrap">
    <?php

           NotificationsWidget::widget([
    'theme' => NotificationsWidget::THEME_GROWL,
    'clientOptions' => [
        'location' => 'id',
    ],
    'counters' => [
        '.notifications-header-count',
        '.notifications-icon-count'
    ],
    'listSelector' => '#notifications',
]);


$admin = OrganizationAdminuser::find()
->andWhere(['user_id' => Yii::$app->user->id])
->andWhere(['status' => 'active'])
->One();
$ifadmin = '';
if(isset($admin)) {
  $ifadmin = 'ADMIN';
}

    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logo_kecil.png', ['alt'=>Yii::$app->name]) . $ifadmin,
        'brandUrl' => Url::toRoute('index'),
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    ?>
    <div class="form-group">

    <?php
    $menuItems = [

    ];


    if (Yii::$app->user->isGuest) {
        //$menuItems[] = ['label' => Yii::t('app', 'Signup'), 'url' => ['/site/signup']];
        $menuItems[] = Html::a('Signup', ['/edulab/edulab/signup'], ['class'=>'btn-menu-transparent btn-trns']);

        $menuItems[] = Html::button('Login',['value'=>Url::toRoute('/edulab/edulab/loginpop'),'class'=>'btn-menu btn-success', 'id' =>'modalButton']);

        ?>
    </div>
        <?php
    } else {

      $usercredit = UserCredit::find()
       ->andWhere(['user_id' => Yii::$app->user->id])
       ->andWhere(['credit_type' => 'credit'])
               ->andWhere(['status' => 'active'])
       ->One();

//print_r($usercredit);
       if(!$usercredit) {
           $creditpoint = 0;
       } else {
           $creditpoint = $usercredit->credit_point;
       }
$selectionobj = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['type'=>'edulab'])->andWhere(['key'=>'ed_level'])->One();
if (is_null($selectionobj))
   $selection = '';
else
   $selection = $selectionobj->value;
       //http://localhost:8090/gamantha/pao/frontend/web/index.php/catalog/default/list?selection=akademik;sma;xii

       //$menuItems[] = ['label' => Yii::t('app', 'Catalog'), 'url' => ['/catalog']];
                   //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', 'Beli Soal'), ['/catalog/default/index?path='], ['class'=>'']) . '</li>';
        //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', 'Latihan Soal'), ['/edulab/edulab/soal'], ['class'=>'']) . '</li>';
        //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', 'Try Out'), ['/edulab/edulab/tryout'], ['class'=>'']) . '</li>';
        //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', 'Video'), ['/edulab/edulab/video'], ['class'=>'']) . '</li>';
        //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', 'Materi'), ['/edulab/edulab/materi'], ['class'=>'']) . '</li>';
   //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', 'Report'), ['/edulab/edulab/report'], ['class'=>'']) . '</li>';
           //$menuItems[] = Html::a(Yii::t('app', 'Credit ('.$creditpoint.')'), ['/profile/credit/index'], ['class'=>'']);
               //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', 'test center'), ['/tao/tao/taoredirect'], ['class'=>'']) . '</li>';
                //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', 'Latihan Soal'), ['/assessment/assessment/index'], ['class'=>'']) . '</li>';
                                   //$menuItems[] = Html::a(Yii::t('app', 'Leaderboard'), ['/assessment/leaderboard/index'], ['class'=>'dropdown']);

                       //$menuItems[] = ['label' => Yii::t('app', 'Credit ('.$creditpoint.')'), 'url' => ['/assessment/credit/index']];
                       //$menuItems[] = ['label' => Yii::t('app', 'My Assessments'), 'url' => ['/assessment/assessment/index']];
                               //$menuItems[] = ['label' => Yii::t('app', 'Take test'), 'url' => ['/tao/tao/taoredirect']];
            //   $menuItems[] =  Html::a('Logout (' . Yii::$app->user->identity->username . ')', ['#'], ['class'=>'btn btn-trns', 'onclick' => 'document.getElementById("logoutbutton").submit()']);
                                   //  $menuItems[] = Html::a(Yii::t('app', 'Test Center'), ['/tao/tao/taoredirect'], ['class'=>'btn btn-trns']);

/*

  $menuItems[] = '    <li class="dropdown" style="list-style: none;">'

.Html::a(Yii::t('app', 'Go To User mode'), ['#'], ['class'=>'dropdown-toggle', 'data-toggle'=>'dropdown']) .
       '<ul class="dropdown-menu">
           <li>
'.Html::a(Yii::t('app', 'Video'), ['/edulab/edulab/video'], ['class'=>'']) .'
           </li>
           <li>
'.Html::a(Yii::t('app', 'Belajar Interaktif'), ['/edulab/edulab/materi'], ['class'=>'']) .'
           </li>
           <li>
'.Html::a(Yii::t('app', 'Download Materi'), ['/edulab/edulab/materi'], ['class'=>'']) .'
           </li>


         </ul>
   </li>';
   */

   $menuItems[] = ['label' => Yii::t('app', 'Go to User Mode'), 'url' => ['/edulab/edulab/index']];


$menuItems[] = ['label' => Yii::t('app', 'Top-up'), 'url' => ['topup']];
$menuItems[] = ['label' => Yii::t('app', 'Register parent'), 'url' => ['parent']];

  $menuItems[] = '
<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <span class="label label-warning notifications-icon-count">0</span>
    </a>
    <ul class="dropdown-menu" style="width:215px;">
        <li class="dropdown-header">
        <a href=""></a><B>'.
Html::a(Yii::t('app', 'You have <span class="notifications-header-count">0</span> notifications'), ['/edulab/message/index'], ['class'=>'']) 
.'</B>
        </li>
        <li>
            <div id="notifications"></div>
        </li>
    </ul>
</li>';

       //$menuItems[] = ['label' => Yii::t('app', 'Profile'), 'url' => ['/profile']];
                       //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', 'Profile'), ['/profile'], ['class'=>'btn btn-trns']) . '</li>';
  $menuItems[] = '    <li class="dropdown" style="list-style: none;">'

.Html::a(Yii::t('app', '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> (' . Yii::$app->user->identity->username . ' / '.Yii::$app->user->id.')<b class="caret"></b>'), ['/edulab/profile/profile'], ['class'=>'dropdown-toggle', 'data-toggle'=>'dropdown']) .
       '<ul class="dropdown-menu">
           <li>
'.Html::a(Yii::t('app', 'Profile'), ['/edulab/profile/profile'], ['class'=>'']) .'
           </li>
           <li>
'.Html::a(Yii::t('app', 'eduPoin (' . $creditpoint . ')'), ['/edulab/credit/index'], ['class'=>'']) .'
           </li>
                       <li>
'.Html::a(Yii::t('app', 'Contact'), ['/site/contact'], ['class'=>'']) .'
           </li>
           <li>
'.Html::a(Yii::t('app', '*Report Bug'), ['/site/bugreport'], ['class'=>'']) .'
           </li>
           <li class="divider"></li>
           <li>' .

                       Html::beginForm(['/site/logout'], 'post', ['id' => 'logoutbutton'])
          //. Html::Button(Yii::t('app', 'Logout'), [''], ['class'=>'','onclick' => 'document.getElementById("logoutbutton").submit()'])

           . Html::submitButton(
               'Logout (' . Yii::$app->user->identity->username . ')',
               //['class' => 'btn btn-link']
                     ['class' => 'dropdown',
                     'style' => 'border:none;
outline:none;
background:none;
cursor:pointer;
color:#0000EE ;
padding-left:20px;
text-decoration:underline;
font-family:inherit;
font-size:inherit;'
                     ]
           )
           . Html::endForm()


//
//$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a('Logout (' . Yii::$app->user->identity->username . ')', ['#'], ['class'=>'btn btn-trns', 'onclick' => 'document.getElementById("logoutbutton").submit()']) . '</li>';
           //Html::beginForm(['/site/logout'], 'post', ['id' => 'logoutbutton'])
           .'


           </li>
         </ul>
   </li>';



  //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', '<span class="glyphicon glyphicon-bell" aria-hidden="true"></span>'), ['/edulab/edulab/message'], ['class'=>'']) . '</li>';

//$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a('Logout (' . Yii::$app->user->identity->username . ')', ['#'], ['class'=>'btn btn-trns', 'onclick' => 'document.getElementById("logoutbutton").submit()']) . '</li>';

   }


     echo Html::beginForm(['/site/logout'], 'post', ['id' => 'logoutbutton']);
   echo Nav::widget([
       'options' => ['class' => 'navbar-nav navbar-right'],
       'items' => $menuItems,
   ]);

   NavBar::end();
   echo Html::endForm();
   ?>
   <?php
       Modal::begin([
           'header' => '<h4>LOGIN</h4>',
           'id' => 'modal',
           'size' => 'modal-sm',
       ]);
       echo "<div id='modalContent'>
       </div>";
       Modal::End();
   ?>
   <div class="

<?php

if ((Yii::$app->controller->id == 'site') && (Yii::$app->controller->action->id == 'index')){
 echo '';
} else {
 echo'';
}
?>
   ">


       <?php
echo Wrapper::widget([
    'layerClass' => 'lo\modules\noty\layers\Toastr',
    // default options
    'options' => [
      "closeButton" => false,
            "debug" => false,
            "newestOnTop" => true,
            "progressBar" => false,
            "positionClass" => "toast-bottom-right",
            "preventDuplicates" => false,
            "onclick" => null,
            "showDuration" => "300",
            "hideDuration" => "1000",
            "timeOut" => "5000",
            "extendedTimeOut" => "1000",
            "showEasing" => "swing",
            "hideEasing" => "linear",
            "showMethod" => "fadeIn",
            "hideMethod" => "fadeOut"
        // and more for this library here https://github.com/ksylvest/jquery-growl
    ],
]);

       ?>

       <?= $content ?>
       <?php



//echo Yii::$app->controller->id;
       ?>
</div>
</div>
<div id="footer">
<div class="container">

<div class="row" id="final-footer">

  <div class="col-md-4">
       <?=Html::img('@web/images/logo_kecil.png', ['class'=>'img-responsive', 'align'=>'center']);?>
  </div>
  <div class="col-md-4 col-md-offset-4 text-right">
  <h5>
      <?php

        $parent = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['type' => 'edulab'])
        ->andWhere(['key' => 'isparent'])
        ->andWhere(['value' => 'true'])
        ->One();

        $admin = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['type' => 'edulab'])
        ->andWhere(['key' => 'isadmin'])
        ->andWhere(['value' => 'true'])
        ->One();


      if ($admin) {
                echo Html::a(Yii::t('app', 'Admin'), ['/edulab/admin'], ['class'=>'']) ;
        echo " | ";
      }

      if ($parent) {
                echo Html::a(Yii::t('app', 'Parent'), ['/edulab/parent'], ['class'=>'']) ;
        echo " | ";
      }
        echo Html::a(Yii::t('app', 'About Us'), ['/site/about'], ['class'=>'']) ;
        echo " | ";
        echo Html::a(Yii::t('app', 'Blog'), [''], ['class'=>'']) ;
      ?>
      </h5>
  </div>
        
</div><!--/container-->
</div><!--/footer-->


            <div id="push"></div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
=======
<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\EdulabAsset;
use app\assets\SortAsset;
use common\widgets\Alert;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\icons\Icon;
use common\modules\profile\models\UserCredit;
use common\modules\profile\models\ProfileExtended;
use lo\modules\noty\Wrapper;

use common\models\Notification;
use machour\yii2\notifications\widgets\NotificationsWidget;
use common\modules\organization\models\OrganizationAdminuser;

AppAsset::register($this);
EdulabAsset::register($this);
//SortAsset::register($this);

$this->title = 'SiapNgampus.com | ';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

<div class="yellow-tittle">
<div class="container">
<h3>  <?php //Breadcrumbs::widget([
    //'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//]) ?></h3>
</div>
</div>

<div class="wrap">
    <?php

           NotificationsWidget::widget([
    'theme' => NotificationsWidget::THEME_GROWL,
    'clientOptions' => [
        'location' => 'id',
    ],
    'counters' => [
        '.notifications-header-count',
        '.notifications-icon-count'
    ],
    'listSelector' => '#notifications',
]);


$admin = OrganizationAdminuser::find()
->andWhere(['user_id' => Yii::$app->user->id])
->andWhere(['status' => 'active'])
->One();
$ifadmin = '';
if(isset($admin)) {
  $ifadmin = 'ADMIN';
}

    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logo_kecil.png', ['alt'=>Yii::$app->name]) . $ifadmin,
        'brandUrl' => Url::toRoute('index'),
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    ?>
    <div class="form-group">

    <?php
    $menuItems = [

    ];


    if (Yii::$app->user->isGuest) {
        //$menuItems[] = ['label' => Yii::t('app', 'Signup'), 'url' => ['/site/signup']];
        $menuItems[] = Html::a('Signup', ['/edulab/edulab/signup'], ['class'=>'btn-menu-transparent btn-trns']);

        $menuItems[] = Html::button('Login',['value'=>Url::toRoute('/edulab/edulab/loginpop'),'class'=>'btn-menu btn-success', 'id' =>'modalButton']);

        ?>
    </div>
        <?php
    } else {

      $usercredit = UserCredit::find()
       ->andWhere(['user_id' => Yii::$app->user->id])
       ->andWhere(['credit_type' => 'credit'])
               ->andWhere(['status' => 'active'])
       ->One();

//print_r($usercredit);
       if(!$usercredit) {
           $creditpoint = 0;
       } else {
           $creditpoint = $usercredit->credit_point;
       }
$selectionobj = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['type'=>'edulab'])->andWhere(['key'=>'ed_level'])->One();
if (is_null($selectionobj))
   $selection = '';
else
   $selection = $selectionobj->value;
       //http://localhost:8090/gamantha/pao/frontend/web/index.php/catalog/default/list?selection=akademik;sma;xii

       //$menuItems[] = ['label' => Yii::t('app', 'Catalog'), 'url' => ['/catalog']];
                   //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', 'Beli Soal'), ['/catalog/default/index?path='], ['class'=>'']) . '</li>';
        //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', 'Latihan Soal'), ['/edulab/edulab/soal'], ['class'=>'']) . '</li>';
        //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', 'Try Out'), ['/edulab/edulab/tryout'], ['class'=>'']) . '</li>';
        //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', 'Video'), ['/edulab/edulab/video'], ['class'=>'']) . '</li>';
        //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', 'Materi'), ['/edulab/edulab/materi'], ['class'=>'']) . '</li>';
   //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', 'Report'), ['/edulab/edulab/report'], ['class'=>'']) . '</li>';
           //$menuItems[] = Html::a(Yii::t('app', 'Credit ('.$creditpoint.')'), ['/profile/credit/index'], ['class'=>'']);
               //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', 'test center'), ['/tao/tao/taoredirect'], ['class'=>'']) . '</li>';
                //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', 'Latihan Soal'), ['/assessment/assessment/index'], ['class'=>'']) . '</li>';
                                   //$menuItems[] = Html::a(Yii::t('app', 'Leaderboard'), ['/assessment/leaderboard/index'], ['class'=>'dropdown']);

                       //$menuItems[] = ['label' => Yii::t('app', 'Credit ('.$creditpoint.')'), 'url' => ['/assessment/credit/index']];
                       //$menuItems[] = ['label' => Yii::t('app', 'My Assessments'), 'url' => ['/assessment/assessment/index']];
                               //$menuItems[] = ['label' => Yii::t('app', 'Take test'), 'url' => ['/tao/tao/taoredirect']];
            //   $menuItems[] =  Html::a('Logout (' . Yii::$app->user->identity->username . ')', ['#'], ['class'=>'btn btn-trns', 'onclick' => 'document.getElementById("logoutbutton").submit()']);
                                   //  $menuItems[] = Html::a(Yii::t('app', 'Test Center'), ['/tao/tao/taoredirect'], ['class'=>'btn btn-trns']);

/*

  $menuItems[] = '    <li class="dropdown" style="list-style: none;">'

.Html::a(Yii::t('app', 'Go To User mode'), ['#'], ['class'=>'dropdown-toggle', 'data-toggle'=>'dropdown']) .
       '<ul class="dropdown-menu">
           <li>
'.Html::a(Yii::t('app', 'Video'), ['/edulab/edulab/video'], ['class'=>'']) .'
           </li>
           <li>
'.Html::a(Yii::t('app', 'Belajar Interaktif'), ['/edulab/edulab/materi'], ['class'=>'']) .'
           </li>
           <li>
'.Html::a(Yii::t('app', 'Download Materi'), ['/edulab/edulab/materi'], ['class'=>'']) .'
           </li>


         </ul>
   </li>';
   */

   $menuItems[] = ['label' => Yii::t('app', 'Go to User Mode'), 'url' => ['/edulab/edulab/index']];


$menuItems[] = ['label' => Yii::t('app', 'Top-up'), 'url' => ['topup']];
$menuItems[] = ['label' => Yii::t('app', 'Register parent'), 'url' => ['parent']];

  $menuItems[] = '
<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <span class="label label-warning notifications-icon-count">0</span>
    </a>
    <ul class="dropdown-menu" style="width:215px;">
        <li class="dropdown-header">
        <a href=""></a><B>'.
Html::a(Yii::t('app', 'You have <span class="notifications-header-count">0</span> notifications'), ['/edulab/message/index'], ['class'=>'']) 
.'</B>
        </li>
        <li>
            <div id="notifications"></div>
        </li>
    </ul>
</li>';

       //$menuItems[] = ['label' => Yii::t('app', 'Profile'), 'url' => ['/profile']];
                       //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', 'Profile'), ['/profile'], ['class'=>'btn btn-trns']) . '</li>';
  $menuItems[] = '    <li class="dropdown" style="list-style: none;">'

.Html::a(Yii::t('app', '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> (' . Yii::$app->user->identity->username . ' / '.Yii::$app->user->id.')<b class="caret"></b>'), ['/edulab/profile/profile'], ['class'=>'dropdown-toggle', 'data-toggle'=>'dropdown']) .
       '<ul class="dropdown-menu">
           <li>
'.Html::a(Yii::t('app', 'Profile'), ['/edulab/profile/profile'], ['class'=>'']) .'
           </li>
           <li>
'.Html::a(Yii::t('app', 'eduPoin (' . $creditpoint . ')'), ['/edulab/credit/index'], ['class'=>'']) .'
           </li>
                       <li>
'.Html::a(Yii::t('app', 'Contact'), ['/site/contact'], ['class'=>'']) .'
           </li>
           <li>
'.Html::a(Yii::t('app', '*Report Bug'), ['/site/bugreport'], ['class'=>'']) .'
           </li>
           <li class="divider"></li>
           <li>' .

                       Html::beginForm(['/site/logout'], 'post', ['id' => 'logoutbutton'])
          //. Html::Button(Yii::t('app', 'Logout'), [''], ['class'=>'','onclick' => 'document.getElementById("logoutbutton").submit()'])

           . Html::submitButton(
               'Logout (' . Yii::$app->user->identity->username . ')',
               //['class' => 'btn btn-link']
                     ['class' => 'dropdown',
                     'style' => 'border:none;
outline:none;
background:none;
cursor:pointer;
color:#0000EE ;
padding-left:20px;
text-decoration:underline;
font-family:inherit;
font-size:inherit;'
                     ]
           )
           . Html::endForm()


//
//$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a('Logout (' . Yii::$app->user->identity->username . ')', ['#'], ['class'=>'btn btn-trns', 'onclick' => 'document.getElementById("logoutbutton").submit()']) . '</li>';
           //Html::beginForm(['/site/logout'], 'post', ['id' => 'logoutbutton'])
           .'


           </li>
         </ul>
   </li>';



  //$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a(Yii::t('app', '<span class="glyphicon glyphicon-bell" aria-hidden="true"></span>'), ['/edulab/edulab/message'], ['class'=>'']) . '</li>';

//$menuItems[] = '<li class="dropdown" style="list-style:none;">' . Html::a('Logout (' . Yii::$app->user->identity->username . ')', ['#'], ['class'=>'btn btn-trns', 'onclick' => 'document.getElementById("logoutbutton").submit()']) . '</li>';

   }


     echo Html::beginForm(['/site/logout'], 'post', ['id' => 'logoutbutton']);
   echo Nav::widget([
       'options' => ['class' => 'navbar-nav navbar-right'],
       'items' => $menuItems,
   ]);

   NavBar::end();
   echo Html::endForm();
   ?>
   <?php
       Modal::begin([
           'header' => '<h4>LOGIN</h4>',
           'id' => 'modal',
           'size' => 'modal-sm',
       ]);
       echo "<div id='modalContent'>
       </div>";
       Modal::End();
   ?>
   <div class="

<?php

if ((Yii::$app->controller->id == 'site') && (Yii::$app->controller->action->id == 'index')){
 echo '';
} else {
 echo'';
}
?>
   ">


       <?php
echo Wrapper::widget([
    'layerClass' => 'lo\modules\noty\layers\Toastr',
    // default options
    'options' => [
      "closeButton" => false,
            "debug" => false,
            "newestOnTop" => true,
            "progressBar" => false,
            "positionClass" => "toast-bottom-right",
            "preventDuplicates" => false,
            "onclick" => null,
            "showDuration" => "300",
            "hideDuration" => "1000",
            "timeOut" => "5000",
            "extendedTimeOut" => "1000",
            "showEasing" => "swing",
            "hideEasing" => "linear",
            "showMethod" => "fadeIn",
            "hideMethod" => "fadeOut"
        // and more for this library here https://github.com/ksylvest/jquery-growl
    ],
]);

       ?>

       <?= $content ?>
       <?php



//echo Yii::$app->controller->id;
       ?>
</div>
</div>
<div id="footer">
<div class="container">

<div class="row" id="final-footer">

  <div class="col-md-4">
       <?=Html::img('@web/images/logo_kecil.png', ['class'=>'img-responsive', 'align'=>'center']);?>
  </div>
  <div class="col-md-4 col-md-offset-4 text-right">
  <h5>
      <?php

        $parent = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['type' => 'edulab'])
        ->andWhere(['key' => 'isparent'])
        ->andWhere(['value' => 'true'])
        ->One();

        $admin = ProfileExtended::find()->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['type' => 'edulab'])
        ->andWhere(['key' => 'isadmin'])
        ->andWhere(['value' => 'true'])
        ->One();


      if ($admin) {
                echo Html::a(Yii::t('app', 'Admin'), ['/edulab/admin'], ['class'=>'']) ;
        echo " | ";
      }

      if ($parent) {
                echo Html::a(Yii::t('app', 'Parent'), ['/edulab/parent'], ['class'=>'']) ;
        echo " | ";
      }
        echo Html::a(Yii::t('app', 'About Us'), ['/site/about'], ['class'=>'']) ;
        echo " | ";
        echo Html::a(Yii::t('app', 'Blog'), [''], ['class'=>'']) ;
      ?>
      </h5>
  </div>
        
</div><!--/container-->
</div><!--/footer-->


            <div id="push"></div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
