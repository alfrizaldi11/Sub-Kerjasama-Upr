<?php
include 'config/koneksi.php';
$data_visi_misi = mysqli_query($koneksi,"SELECT * from visi_misi");
$data=mysqli_fetch_array($data_visi_misi);

?>

<!DOCTYPE html>
<html lang="en">
  <?php
include 'head.php';
  ?>
  <body>
  
  <div class="site-wrap">

   
    <?php
    include 'headerprofile.php';

    ?>
    <div class="site-blocks-cover overlay" style="background-image: url(images/header.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
                        
            <div class="row justify-content-center mb-4">
              <div class="col-md-8 text-center">
                <h1>Visi & Misi<span></span></h1>
                <p class="lead mb-5">Sub Bagian Kerjasama </p>
               
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>  


    <section class="site-section testimonial-wrap">

		<div class="col-md-3 ml-auto">
           </div>

      <div class="site-section bg-light" >
      <div class="container">
        <div class="row" >
          <div class="col-md-12 mb-5" >
            <form class="p-5 bg-white" align="center">
          <p><?php
                echo $data['isi_visi_misi'];
                ?></p>
              </form>
              </div>
            </div>
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