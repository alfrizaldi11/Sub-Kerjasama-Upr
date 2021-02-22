<?php
error_reporting(0);
include 'config/koneksi.php';
mysqli_set_charset('utf8');

?>
  
<?php
include "head.php";

?>

  <body>
  
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    <?php
include "headerprofile.php";

    ?>

  

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/header.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
                        
            <div class="row justify-content-center mb-4">
              <div class="col-md-8 text-center">
                <h1>Galeri</h1>
                <p class="lead mb-5">Sub Bagian Kerjasama</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>


    
    <section class="site-section">
      
      <div class="container">
        <div class="row">
          <?php 
                $sql= mysqli_query($koneksi,"SELECT * FROM galeri where id_album='$_GET[id]'");
                while ($data = mysqli_fetch_array($sql)) { 
            ?>
          <div class="col-6 col-sm-6 col-lg-3 ftco-animate">
            <div class="project">
              <a href="admin/image/galeri/<?php echo $data['foto']; ?>" class="icon image-popup d-flex justify-content-center align-items-center">
                  <img src="admin/image/galeri/<?php echo $data['foto']; ?>" class="img-fluid" style="border-radius:5px;">
              </a>
              </div>
            <div class="text-center">
                    <h4><?php echo $data['nama_galeri']; ?></h4>            
            </div>
            
          </div>

          <?php } ?>
        </div>
      </div>
    </section>

    
    
    <?php
    include "footer.php";

    ?>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
   


  </body>

  </html>