<?php
include 'config/koneksi.php';
session_start();
if (empty ($_SESSION['username']) AND empty ($_SESSION['pass']) ){
  echo "<script> alert('Anda harus login terlebih dahulu');
  window.location = 'hal_login.php'</script>";
}
if($_SESSION['level']!="unit"){
    die("404 Not Found");
}

$timeout = 1; // Set timeout menit
$logout_redirect_url = "hal_login.php"; // Set logout URL
 
$timeout = $timeout * 1800; // Ubah menit ke detik
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Waktu Anda Telah Habis'); window.location = '$logout_redirect_url'</script>";
    }
}
$_SESSION['start_time'] = time();

?>

<!DOCTYPE html>

<html lang="en">
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
  <script type="text/javascript">
  tinymce.init({
  selector: "textarea"
    });
</script>

<?
    include 'head.php';
  ?>

  <body>
  
  <div class="site-wrap">

    <?
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

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-7 mb-5">

            <form action="aksi_tambah_input.php" method="POST" class="p-5 bg-white">
              
              <h2 class="h4 text-black mb-5">Masukkan Data</h2> 

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black">Nama Unit</label> 
                  <select name="id_unit" class="form-control" required>
                  <option value="">-- Pilih Unit --</option>
                        <?php
                  $tampil=mysqli_query($koneksi,"SELECT * FROM unit ORDER BY nama_unit");
                  while($data=mysqli_fetch_array($tampil)){
                  echo "<option value=$data[id_unit]>$data[nama_unit]</option>";}
                ?>
                      </select>
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black">Institusi Mitra</label> 
                  <textarea name="institusi_mitra" id="message" cols="30" rows="7" class="form-control ckeditor" placeholder="" ></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black">Ruang Lingkup</label> 
                  <textarea name="ruang_lingkup" id="message" cols="30" rows="7" class="form-control ckeditor" placeholder=""></textarea>
                </div>
              </div>
            
              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black">Periode Berlaku</label> 
                  <input name="periode_berlaku" type="text" class="form-control" placeholder=""required>
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black">Tempo Berlaku</label> 
                  <input name="tempo_berlaku" type="text" class="form-control" placeholder=""required>
                </div>
              </div>

             <div class="row form-group">
              <div class="col-md-12">
                  <label>Keterangan</label>
                  <select name="keterangan" class="form-control"required>
                  <option value="">-- Pilih Keterangan --</option>
                  <option value="Dalam Negri">Dalam Negri</option>
                  <option value="Luar Negri">Luar Negri</option>
                </select>
                </div>
                </div>

               
              <div class="row form-group">
                <div class="pull-left">
                  <input type="submit" value="Input" class="btn btn-default btn-flat" style="margin-right:10px; margin-left:15px;">
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">logout</a>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-5">
            
            <div class="p-4 mb-3 bg-white">
              <p class="mb-0 font-weight-bold">Alamat</p>
              <p class="mb-4">Kampus Tunjung Nyaho, Jl. Yos Sudarso, Palangka, Kec. Jekan Raya, Kota Palangka Raya, Kalimantan Tengah 73112</p>

              <p class="mb-0 font-weight-bold">Telepon</p>
              <p class="mb-4"><a href="#"></a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="#"></a></p>

            </div>
            
            <div class="p-4 mb-3 bg-white">
              <h3 class="h5 text-black mb-3">Input Data Excel</h3>
              <p> Sebelum melakukan import data melalui excel, terlebih dahulu mendownload format excel yang sudah di sediakan, klik tombol telusuri untuk mencari file yang ingin di import, klik preview untuk validasi data excel dan klik tombol import data.  </p>
              <p><a href="form.php" class="btn btn-success pull-right"> <span class="glyphicon glyphicon-upload"></span> Import Data Excel </a>
              </p>
            </div>

          </div>

        </div>
      </div>
    </div>

    <?
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