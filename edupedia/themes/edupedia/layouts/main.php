<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use common\widgets\Alert;

use app\modules\profile\models\Profile;
use app\modules\profile\models\ProfileMeta;
use app\modules\profile\models\ProfileSearch;

use machour\yii2\notifications\widgets\NotificationsWidget;
use common\modules\core\models\Notification;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

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
    'markAllSeenSelector' => '#notification-seen-all',
    'listSelector' => '#notifications',
]);

    NavBar::begin([
        'brandLabel' => 'EDUPEDIA',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    if (Yii::$app->user->isGuest) {
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
     //   $menuItems[] = ['label' => 'Profile', 'url' => ['/profile/profile']];
       // $menuItems[] = ['label' => 'Assessor/Assessee/User Dashboard', 'url' => ['/project/project/select']];
        $menuItems[] = ['label' => 'Belajar', 'url' => ['/site/belajar']];

          $menuItems[] = '<li class="dropdown" style="list-style: none;">'

.Html::a(Yii::t('app', 'Uji'), [''], ['class'=>'dropdown-toggle', 'data-toggle'=>'dropdown']) .
       '<ul class="dropdown-menu">
           <li>'.Html::a(Yii::t('app', 'Tryout'), ['/profile/profile/update','id'=>''], ['class'=>'']) .'</li>
         </ul>
   </li>';
        $menuItems[] = ['label' => 'Diskusi', 'url' => ['/site/debug']];
        $menuItems[] = ['label' => 'Debug', 'url' => ['/site/debug']];
       // $menuItems[] = ['label' => 'Scan reader', 'url' => ['/project/filereader/index']];
  $menuItems[] = '
<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <span class="label label-warning notifications-icon-count">0</span>
    </a>
    <ul class="dropdown-menu" style="width:215px;">
        <li class="dropdown-header">
        <a href=""></a><B>'.
Html::a(Yii::t('app', 'You have <span class="notifications-header-count">0</span> notifications'), ['/message/index'], ['class'=>'']) 
.'</B>
        </li>
        <li>
            <div id="notifications"></div>
        </li>
    </ul>
</li>';

          $menuItems[] = '<li class="dropdown" style="list-style: none;">'

.Html::a(Yii::t('app', '<span class="glyphicon glyphicon-user"></span> ' . Yii::$app->user->identity->username ), [''], ['class'=>'dropdown-toggle', 'data-toggle'=>'dropdown']) .
       '<ul class="dropdown-menu">
           <li>'.Html::a(Yii::t('app', 'Profile'), ['/profile/profile/update','id'=>''], ['class'=>'']) .'</li>
              <li class="divider"></li><li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'
.
           '
         </ul>
   </li>';

    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; PT. Kreasi Edulab Indonesia <?= date('Y') ?></p>
        <p class="pull-right"><?= Html::a(Yii::t('app', 'Help'), ['/site/contact'])?>  |  
        <?= Html::a(Yii::t('app', 'Contact'), ['/site/contact'])?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
