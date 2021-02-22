<!DOCTYPE html>
<html lang="en">
  <?php
include 'head.php';
  ?>
  <body>
  
  <div class="site-wrap">

   
    <?php
    include 'headerkerjasama.php';

    ?>
    <div class="site-blocks-cover overlay" style="background-image: url(images/header.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
                        
            <div class="row justify-content-center mb-4">
              <div class="col-md-8 text-center">
                <h1>Selamat Datang di Sistem Informasi<span class="#"></span></h1>
                <p class="lead mb-5">Sub Bagian Kerjasama </p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>  


    <section class="site-section testimonial-wrap">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 text-center">
            <h2 class="text-black h1 site-section-heading text-center">Kerjasama</h2>
          </div>
        </div>
      </div>

      <div style="padding-left:40px; padding-right:40px;">
      <div class="row">
        <div class="col-xs-15 col-sm-6">
          <!--
          -- Input Group adalah salah satu komponen yang disediakan bootstrap
          -->
          <div class="p-2 mb-1 bg-white">
          <div class="input-group" style="">
            <!-- Buat sebuah textbox dan beri id keyword -->
            <input type="text" placeholder="Masukkan nama Fakultas/Unit.." id="keyword" style="width:250px; margin-right:15px; border-radius:5px; margin-top:5px; margin-bottom:5px;" />
            <span class="input-group-btn" style="margin-right:15px;">
              <!-- Buat sebuah tombol search dan beri id btn-search -->
              <button class="btn btn-primary" type="button" id="btn-search" style="padding-left:15px; padding-right:15px; margin-top:5px; margin-bottom:5px;" >Search</button>
              <a href="kerjasama.php" class="btn btn-light" style="padding-left:15px; padding-right:15px; margin-top:5px; margin-bottom:5px;">Reset</a>
            </span>
            <!-- Example single danger button -->
            <div class="btn-group" >
              <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding-left:15px; padding-right:15px; margin-top:5px; margin-bottom:5px;">
                Download Data Kerjasama
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="export_fkip.php">Fakultas Ilmu Keguruan dan Ilmu Pendidikan</a>
                <a class="dropdown-item" href="export_feb.php">Fakultas Ekonomi dan Bisnis</a>
                <a class="dropdown-item" href="export_faperta.php">Fakultas Pertanian</a>
                <a class="dropdown-item" href="export_teknik.php">Fakultas Teknik</a>
                <a class="dropdown-item" href="export_hukum.php">Fakultas Hukum</a>
                <a class="dropdown-item" href="export_fisipol.php">Fakultas Ilmu Sosial dan Ilmu Politik</a>
                <a class="dropdown-item" href="export_fk.php">Fakultas Kedokteran</a>
                <a class="dropdown-item" href="export_fmipa.php">Fakultas Matematika dan Ilmu Pengetahuan Alam</a>
                <a class="dropdown-item" href="export_pascasarjana.php">Pascasarjana</a>
                <a class="dropdown-item" href="export_lahp.php">UPT.LAHP</a>
                <a class="dropdown-item" href="#">UPT.CIMTROP</a>
                <a class="dropdown-item" href="#">UPT.TIK</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="export.php">Seluruh Data Kerjasama</a>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div id="view"><?php include "view.php"; ?></div>

        </div>
        </div>
    </section>
    
    
    <?php
include 'footer.php';

    ?>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
  <!-- Load file ajax.js yang ada di folder js -->
  <script src="js/ajax.js"></script>
  
    
  </body>
</html>