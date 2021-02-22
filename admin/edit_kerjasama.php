<?php
include '../config/koneksi.php';

session_start();
if (empty ($_SESSION['username']) AND empty ($_SESSION['pass']) ){
  echo "<script> alert('Anda harus login terlebih dahulu');
  window.location = '../hal_login.php'</script>";
}
if($_SESSION['level']!="admin" AND ($_SESSION['level']!="staf")){
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
<html>
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<?php
include 'head.php';


?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php
include 'header.php';


?>


 <!-- Left side column. contains the logo and sidebar -->
<?php
include 'sidebar.php';


?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Edit Kerjasama
      </h1>
     
    </section>
	<?php
	$edit = mysqli_query($koneksi,"SELECT u.*, k.* FROM kerjasama k LEFT JOIN unit u ON k.`id_unit` = u.`id_unit` where k.id_kerjasama = $_GET[id]");
  $hasil = mysqli_fetch_array($edit);
  $id_kerjasama = $hasil['id_kerjasama'];
  $id_unit= $hasil['id_unit'];
  $institusi_mitra= $hasil['institusi_mitra'];
  $ruang_lingkup= $hasil['ruang_lingkup'];
  $periode_berlaku= $hasil['periode_berlaku'];
  $tempo_berlaku = $hasil['tempo_berlaku'];
  $keterangan= $hasil['keterangan'];
	
	?>
	
	
  <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="aksi_edit_kerjasama.php" method="POST">
             <input type="hidden" name="id_kerjasama" value="<?php echo $id_kerjasama; ?>"/>
             <div class="box-body">
             <?php
									$tampil_unit=mysqli_query($koneksi,"SELECT * FROM unit where id_unit='$id_unit'");
									$data_unit=mysqli_fetch_array($tampil_unit);
									$nama_unit=$data_unit['nama_unit'];
								?>
                <div class="form-group">
										<label>Nama Unit</label>
									<select name="id_unit" class="form-control"required>
									<option value="<?php echo $id_unit; ?>"><?php echo $nama_unit; ?></option>
									<option value="">-- Pilih Unit --</option>
												<?php
									$tampil=mysqli_query($koneksi,"SELECT * FROM unit ORDER BY nama_unit");
									while($data=mysqli_fetch_array($tampil)){
									echo "<option value=$data[id_unit]>$data[nama_unit]</option>";}
								?>

                  </select>
                <div class="form-group">
                  <form enctype='multipart/form-data' action="aksi_tambah_kerjasama.php" method="POST"  >
                  <label class="text-black">Institusi Mitra</label> 
                  <textarea name="institusi_mitra" id="message" cols="30" rows="7" class="form-control ckeditor" required><?php echo $institusi_mitra; ?></textarea>
                </div>

                <div class="form-group">
                  <form enctype='multipart/form-data' action="aksi_tambah_kerjasama.php" method="POST"  >
                  <label class="text-black">Ruang Lingkup</label> 
                  <textarea name="ruang_lingkup" id="message" cols="30" rows="10" class="form-control ckeditor" required><?php echo $ruang_lingkup; ?></textarea>
                </div>

                <div class="form-group">
                  <label>Periode Berlaku</label>
                  <input value="<?php echo $periode_berlaku; ?>" name="periode_berlaku" type="text" class="form-control" placeholder="Masukkan Periode Berlaku (jika kosong masukan '-')" required>
                </div>

                <div class="form-group">
                  <label>Tempo Berlaku</label>
                  <input value="<?php echo $tempo_berlaku; ?>" name="tempo_berlaku" type="text" class="form-control" placeholder="Masukkan Tempo Berlaku (jika kosong masukan '-')" required>
                </div>
				 
                <div class="form-group">
                  <label>Keterangan</label>
                  <select name="keterangan" class="form-control">
                  <option value="<?php echo $keterangan; ?>"> <?php echo $keterangan; ?> </option>
                  <option value="">-- Pilih Keterangan--</option>
                  <option value="Dalam Negri">Dalam Negri</option>
                  <option value="Luar Negri">Luar Negri</option>
                </select>
                </div>

                <div class="form-actions">
                <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-save"></i>  Simpan</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

         
        </div>
        <!--/.col (right) -->
		
		
		
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    
  </div>
  <!-- /.content-wrapper -->
 <?php
 include 'footer.php';
 
 
 
 ?>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>
</body>
</html>
