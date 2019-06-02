<<<<<<< HEAD
<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    /*public $css = [
        'css/creative.css',
    ];
    public $js = [
        'js/main.js',
    ];
*/
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

class DefaultAsset extends AssetBundle
{
        public $sourcePath = '@app/themes/default/';
    //public $basePath = '@app';
    //public $baseUrl = '@app';
    public $css = [
        //'css/creative.css',
        'css/creative.css',
    ];
    public $js = [
      'js/main.js',
    ];



    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}


class PpsdmAsset extends AssetBundle
{
        public $sourcePath = '@app/themes/ppsdm/';
    //public $basePath = '@app';
    //public $baseUrl = '@app';
    public $css = [
        //'css/creative.css',
        'css/creative.css',
    ];
    public $js = [
      'js/main.js',
    ];



    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

class CatsAsset extends AssetBundle
{
        public $sourcePath = '@app/themes/cats/';
    //public $basePath = '@app';
    //public $baseUrl = '@app';
    public $css = [
        //'css/creative.css',
        'css/creative.css',
    ];
    public $js = [
      'js/main.js',
    ];



    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

class EdulabAsset extends AssetBundle
{
        public $sourcePath = '@app/themes/edulab/';
    //public $basePath = '@app';
    //public $baseUrl = '@app';
    public $css = [
        //'css/creative.css',
        'css/creative.css',
        'css/style.css',
        'css/styles.css',
        'css/filtrify.css',
    ];
    public $js = [
      'js/main-edulab.js',
      //'js/sweet-alert.js',
      //'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js',
    ];



    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}


class SoalAsset extends AssetBundle
{
        public $sourcePath = '@app/assets/soal/';
    //public $basePath = '@app';
    //public $baseUrl = '@app';
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}




class SortAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/edulab/';
    public $css = [
        //'css/creative.css',
        
        'css/filtrify.css',
    ];
    public $js = [
        'js/sort.js',
        'js/jquery.min.js',
        //'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js',
        'js/filtrify.min.js',
    ];



    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}



class ChartAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/Chart.bundle.js',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

class RatingAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/jquery-bar-rating/themes/fontawesome-stars.css',
                'js/jquery-bar-rating/themes/bars-1to10.css',
    ];
    public $js = [
        'js/jquery-bar-rating/jquery.barrating.min.js',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}


class ProgressbarAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'js/jquery-bar-rating/themes/fontawesome-stars.css',
                //'js/jquery-bar-rating/themes/bars-1to10.css',
    ];
    public $js = [
        'js/progressbar.min.js',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}




class MomentAsset extends AssetBundle
{
    public $sourcePath = '@npm/moment'; 
    public $js = [
        'moment.js',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}


class FootableAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/footable.standalone.css',
                'css/font-awesome/css/font-awesome.css',
    ];
    public $js = [
        'js/footable.min.js',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];

    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
=======
<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    /*public $css = [
        'css/creative.css',
    ];
    public $js = [
        'js/main.js',
    ];
*/
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

class DefaultAsset extends AssetBundle
{
        public $sourcePath = '@app/themes/default/';
    //public $basePath = '@app';
    //public $baseUrl = '@app';
    public $css = [
        //'css/creative.css',
        'css/creative.css',
    ];
    public $js = [
      'js/main.js',
    ];



    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}


class PpsdmAsset extends AssetBundle
{
        public $sourcePath = '@app/themes/ppsdm/';
    //public $basePath = '@app';
    //public $baseUrl = '@app';
    public $css = [
        //'css/creative.css',
        'css/creative.css',
    ];
    public $js = [
      'js/main.js',
    ];



    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

class CatsAsset extends AssetBundle
{
        public $sourcePath = '@app/themes/cats/';
    //public $basePath = '@app';
    //public $baseUrl = '@app';
    public $css = [
        //'css/creative.css',
        'css/creative.css',
    ];
    public $js = [
      'js/main.js',
    ];



    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

class EdulabAsset extends AssetBundle
{
        public $sourcePath = '@app/themes/edulab/';
    //public $basePath = '@app';
    //public $baseUrl = '@app';
    public $css = [
        //'css/creative.css',
        'css/creative.css',
        'css/style.css',
        'css/styles.css',
        'css/filtrify.css',
    ];
    public $js = [
      'js/main-edulab.js',
      //'js/sweet-alert.js',
      //'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js',
    ];



    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}


class SoalAsset extends AssetBundle
{
        public $sourcePath = '@app/assets/soal/';
    //public $basePath = '@app';
    //public $baseUrl = '@app';
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}




class SortAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/edulab/';
    public $css = [
        //'css/creative.css',
        
        'css/filtrify.css',
    ];
    public $js = [
        'js/sort.js',
        'js/jquery.min.js',
        //'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js',
        'js/filtrify.min.js',
    ];



    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}



class ChartAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/Chart.bundle.js',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

class RatingAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/jquery-bar-rating/themes/fontawesome-stars.css',
                'js/jquery-bar-rating/themes/bars-1to10.css',
    ];
    public $js = [
        'js/jquery-bar-rating/jquery.barrating.min.js',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}


class ProgressbarAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'js/jquery-bar-rating/themes/fontawesome-stars.css',
                //'js/jquery-bar-rating/themes/bars-1to10.css',
    ];
    public $js = [
        'js/progressbar.min.js',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}




class MomentAsset extends AssetBundle
{
    public $sourcePath = '@npm/moment'; 
    public $js = [
        'moment.js',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}


class FootableAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/footable.standalone.css',
                'css/font-awesome/css/font-awesome.css',
    ];
    public $js = [
        'js/footable.min.js',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];

    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
}