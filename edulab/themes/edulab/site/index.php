<?php

use yii\helpers\Url;
use common\models\User;
use app\modules\accounting\models\Accounting;

$this->title = 'Siap Ngampus | Belajar & Ujian Online';

/* @var $this yii\web\View */

//$this->title = 'My Yii Application';
?>
<BR>
<div class="bg"></div>
<div class="jumbotron">
    <div class="container" style="margin:auto";>
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="embed-responsive embed-responsive-16by9">
               <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/t0euDAUNNdI" frameborder="0"></iframe>
            </div>
        </div>
      </div>
          

     <br/>
        <p style=" text-align: center;">
        <a class="btn-menu-transparent btn-trns" href="
        <?php
            if (Yii::$app->user->isGuest) {
                echo Url::to(['/edulab/edulab/signup']);
            } else {
                echo Url::to(['/catalog']);
            }
        ?>
         ">DAFTAR SEKARANG</a></p>
      
        </div>
<!--iframe frameborder="0" width="480" height="270"
src="http://dai.ly/k6oANZAGdGUr5YnigM4?autoplay=1&mute=0&ui-logo=false&sharing-enable=false&endscreen-enable=false"
allowfullscreen></iframe-->
    <div id="mid">
    </div>
</div>
<div id="mid-yellow">
    <div class="container">
        <div class="row">
              <a href="#">
              <div class="col-md-4 text-center">
                  <img src="<?=@web?>../../images/tes-online.png">
                  <BR><span id="tittle">Test Online</span><BR>
                  <BR><span id="sub-tittle">Mengerjakan soal-soal latihan untuk<BR>menghadapi ujian secara online</span><BR>
              </div>
              </a>
              <a href="#">
              <div class="col-md-4 text-center">
              <img src="<?=@web?>../../images/hasil-instant.png">
                  <BR><span id="tittle">Hasil Instant</span><BR>
                  <BR><span id="sub-tittle">Melihat hasil penilaian test yang<BR>sudah dikerjakan</span><BR>
              </div>
              </a>
              <a href="#">
              <div class="col-md-4 text-center">
              <img src="<?=@web?>../../images/papan-peringkat.png">
                  <BR><span id="tittle">Papan Peringkat</span><BR>
                  <BR><span id="sub-tittle">Bersaing dengan teman-temanmu<BR>untuk menjadi yang pertama</span><BR>
              </div>
              </a>
        </div>
    </div>
</div>

<section id="carousel">           
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
                <div class="quote"><i class="fa fa-quote-left fa-4x"></i></div>
        <div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
          <!-- Carousel indicators -->
                  <ol class="carousel-indicators">
            <li data-target="#fade-quote-carousel" data-slide-to="0"></li>
            <li data-target="#fade-quote-carousel" data-slide-to="1"></li>
            <li data-target="#fade-quote-carousel" data-slide-to="2" class="active"></li>
                    <li data-target="#fade-quote-carousel" data-slide-to="3"></li>
                    <li data-target="#fade-quote-carousel" data-slide-to="4"></li>
                    <li data-target="#fade-quote-carousel" data-slide-to="5"></li>
          </ol>
          <!-- Carousel items -->
          <div class="carousel-inner">
            <div class="item">
                        <div class="profile-circle" style="background-color: rgba(0,0,0,.2);"></div>
              <blockquote><Strong>M. Rizky Ramadhan</strong> <BR>(SMA 3 BDG - FTI ITB)<BR><BR>
                <p>Edulab memberikan suasana yang nyaman dan harmonis. Educator dan para edulabers dapat menjalin hubungan dalam belajar mengajar lebih terkoneksi antar individu, dikarenakan terjalinnya kekeluargaan yang tak akan kalian dapatkan di bimbel lain. Kalian juga dapat belajar kapan saja dan difasilitasi. Edulab juga memberikan kesan rumah kedua dan disediakan konsutasi untuk planning ke depan. The most important thing is “Do the things that you love, and love the things that you do”</p>
              </blockquote> 
            </div>
            <div class="item">
                        <div class="profile-circle" style="background-color: rgba(77,5,51,.2);"></div>
              <blockquote><Strong>Sabrina Nadya Anwar</strong> <BR>(SMAN 5 SBY - SBM ITB)<BR><BR>
                <p>Belajar di Edulab suasnanya homey, nyaman, pengajarnya santai kayak temen dan udah seperti keluarga sendiri juga bisa tambahan  kapanpunjadi flexibel. Edulab emang keren banget !</p>
              </blockquote>
            </div>
            <div class="active item">
                        <div class="profile-circle" style="background-color: rgba(145,169,216,.2);"></div>
              <blockquote><Strong>Julsyawiah Novthalia</strong><BR> (SMA Al-Azhar MDN - FK UNPAD)<BR><BR>
                <p>Di Edulab itu belajarnya asik, gurunya ramah dan bersahabat, fasilitasnya lengkap dan nyaman. Belajarnya juga fulltime, jadi bisa kapanpun kita mau. Saya sering belajar di Edulab karena menambah wawasan dan pengetahuan.</p>
              </blockquote>
            </div>
                    <div class="item">
                        <div class="profile-circle" style="background-color: rgba(77,5,51,.2);"></div>
                <blockquote><Strong>Junico Nobel Valentino</strong><BR> (SMA 10 PDG - TS Univ. Andalas)<BR><BR>
                <p>Edulab itu udah kaya keluarga kedua.Edulab itu udah kaya keluarga kedua.Belajar di edu asik bgt, nyaman, educatornyapada baik, ramah, perhatian juga.Sarana lengkap, suasana homey bgt, pokoknya cepetfaham deh kalo di edulab.Dan lagi, edulab itu ga kaya bimbel yang lain,paling beda dan paling asik.Edulab keren lah pokoknya mah !Terimakasih buat semua educatorwali,pokoknya semua elemen edulab deh,terimakasih edulab! Sukses selalu.</p>
              </blockquote>
            </div>
                    <div class="item">
                        <div class="profile-circle" style="background-color: rgba(77,5,51,.2);"></div>
                <blockquote><Strong>Raditya Priyongga</strong> <BR>(SMAN 5 BDG - STIE ITB)<BR><BR>
                <p>Belajar di Edulab itu asik banget. Guru - gurunya gaul, rame, dan unik dan tempat belajarnya nyaman banget ! Pokoknya ga nyesel deh disini. Intinya, be your own and never give up !!!</p>
              </blockquote>
            </div>
                    
          </div>
        </div>
      </div>              
    </div>
  </div>
</section>