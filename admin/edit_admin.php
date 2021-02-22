<?php
include '../config/koneksi.php';

session_start();
if (empty ($_SESSION['username']) AND empty ($_SESSION['pass']) ){
  echo "<script> alert('Anda harus login terlebih dahulu');
  window.location = '../hal_login.php'</script>";
}
if($_SESSION['level']!="admin"){
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
       Edit Admin
      </h1>
     
    </section>
	<?php
	$edit=mysqli_query($koneksi,"SELECT * FROM myadmin WHERE id_admin = '$_GET[id]'");
    $hasil = mysqli_fetch_array($edit);
    $id_admin = $hasil['id_admin'];
    $nama_lengkap = $hasil['nama_lengkap'];
    $username = $hasil['username'];
    $pass= $hasil['pass'];
    $email= $hasil['email'];
    $lvl= $hasil['level'];
	
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
            <form role="form" action="aksi_edit_admin.php" method="POST">
             <input type="hidden" name="id_admin" value="<?php echo $id_admin; ?>"/>
			  <div class="box-body">
                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input value="<?php echo $nama_lengkap; ?>" name="nama_lengkap" type="text" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                </div>
				
				 <div class="form-group">
                  <label>Username</label>
                  <input value="<?php echo $username; ?>" name="username" type="text" class="form-control" placeholder="Masukkan Email Username" required>
                </div>
        
                 <div class="form-group">
                  <label>Password</label>
                  <input value="<?php echo $pass; ?>" name="pass" type="text" class="form-control" placeholder="Masukkan Password" required>
                 </div>
        
                 <div class="form-group">
                  <label>Email</label>
                  <input value="<?php echo $email; ?>" name="email" type="text" class="form-control" placeholder="Masukkan Email" required>
                 </div>
        
                 <div class="form-group">
                  <label>Level</label>
                    <select name="level" class="form-control">
                        <option value="<?php echo $lvl ?>"> <?php echo $lvl; ?> </option>
                        <option value="">-- Pilih Level--</option>
                        <option value="staf">staf</option>
                        <option value="unit">unit</option>
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
