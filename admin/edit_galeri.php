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
       Edit Galeri
      </h1>
     
    </section>
	<?php
	$edit=mysqli_query($koneksi,"SELECT a.*, g.* FROM galeri g LEFT JOIN album 
	a ON g.`id_album` = a.`id_album` where g.id_galeri = $_GET[id]");
	$hasil = mysqli_fetch_array($edit);
	$id_galeri = $hasil['id_galeri'];
	$id_album = $hasil['id_album'];
	$nama_galeri = $hasil['nama_galeri'];
	$foto = $hasil['foto'];

	
	?>
	
	
  <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form enctype='multipart/form-data' role="form" action="aksi_edit_galeri.php" method="POST">
             <input type="hidden" name="id_galeri" value="<?php echo $id_galeri; ?>"/>
             <div class="box-body">
			             <div class="form-group">
			             <?php
					$tampil_album=mysqli_query($koneksi,"SELECT * FROM album where id_album='$id_album'");
					$data_album=mysqli_fetch_array($tampil_album);
					$nama_album=$data_album['nama_album'];
					?>
					<label>Nama Album</label>
					<select name="id_album" class="form-control">
					<option value="<?php echo $id_album; ?>"><?php echo $nama_album; ?></option>
					<option value="">-- Pilih Album --</option>
				<?php
					$tampil=mysqli_query($koneksi,"SELECT * FROM album ORDER BY nama_album");
					while($data=mysqli_fetch_array($tampil)){
					echo "<option value=$data[id_album]>$data[nama_album]</option>";}
				?>
				</select>
					</div>
				<div class="form-group">
					<label>Nama Galeri</label>
					<input value="<?php echo $nama_galeri; ?>" class="form-control"
					placeholder="Masukkan Nama Galeri "name="nama_galeri" required>
					</div>
				<div class="form-group">
					<label>Foto</label>
					<input type="file" name="foto" id="foto"  value="<?php echo $foto; ?>" required>
					</div>
				<br>
               

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
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
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
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
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
