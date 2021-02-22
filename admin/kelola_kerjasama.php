<?php
include "../config/koneksi.php";
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

$data_kerjasama = mysqli_query($koneksi,"SELECT u.*, k.* FROM kerjasama k LEFT JOIN unit u ON k.`id_unit` = u.`id_unit` order by u.nama_unit ASC");


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
       Kelola Kerjasama
      </h1>
     
    </section>
  <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Input Kerjasama</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="aksi_tambah_kerjasama.php" method="POST">
              <div class="box-body">
               
                <div class="form-group">
										<label>Nama Unit</label>
									<select name="id_unit" class="form-control"required>
									      <option value="">-- Pilih Unit --</option>
                                <?php
                          $tampil=mysqli_query($koneksi,"SELECT * FROM unit ORDER BY nama_unit");
                          while($data=mysqli_fetch_array($tampil)){
                          echo "<option value=$data[id_unit]>$data[nama_unit]</option>";}
                        ?>
									</select>
						 	  </div>

                <div class="form-group">
                  <form enctype='multipart/form-data' action="aksi_tambah_kerjasama.php" method="POST"  >
                  <label class="text-black">Institusi Mitra</label> 
                  <textarea name="institusi_mitra" id="message" cols="30" rows="7" class="form-control ckeditor" required></textarea>
                </div>

                <div class="form-group">
                  <form enctype='multipart/form-data' action="aksi_tambah_kerjasama.php" method="POST"  >
                  <label class="text-black">Ruang Lingkup</label> 
                  <textarea name="ruang_lingkup" id="message" cols="30" rows="10" class="form-control ckeditor" required></textarea>
                </div>

				        <div class="form-group">
                  <label>Periode Berlaku</label>
                  <input name="periode_berlaku" type="text" class="form-control" placeholder="Masukkan Periode Berlaku (jika kosong masukan '-')" required>
                </div>
            
               <div class="form-group">
                  <label>Tempo Berlaku</label>
                  <input name="tempo_berlaku" type="text" class="form-control" placeholder="Masukkan Tempo Berlaku (jika kosong masukan '-')" required>
                </div>
               
                <div class="form-group">
                  <label>Keterangan</label>
                  <select name="keterangan" class="form-control" required>
                    <option value="">-- Pilih Keterangan--</option>
                    <option value="Dalam Negri">Dalam Negri</option>
                    <option value="Luar Negri">Luar Negri</option>
                  </select>
                </div>

                    <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>  Simpan</button>
                    <input type="reset" value="Reset" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        
                    </div>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>               
  </section>    

<!-- Main Content -->
<!--/.col (right) -->
<section class="content">
              <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4><b>Data Kerjasama</b></h4>
                        </div>
                        
                        <div class="panel-body">
      <div class="table-responsive dataTable_wrapper">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
				
                <tr>
                  <th>No</th>
                  <th>Nama Unit</th>
                  <th>Institusi dan Mitra</th>
                  <th>Ruang Lingkup</th>
                  <th>Periode Berlaku</th>
                  <th>Tempo Berlaku</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
				
				<?php
				$no=1;
				while($data=mysqli_fetch_array($data_kerjasama))
				{
				?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['nama_unit']?></td>
                  <td><?php echo $data['institusi_mitra']; ?></td>
                  <td><?php echo $data['ruang_lingkup']; ?></td>
                  <td><?php echo $data['periode_berlaku']; ?></td>
                  <td><?php echo $data['tempo_berlaku']; ?></td>
                  <td><?php echo $data['keterangan']; ?></td>
				 
          <td align="center">
                  <div>
                    <a class="btn btn-success" 
                      href="edit_kerjasama.php?id=<?php echo $data['id_kerjasama'];?>"><i class="fa fa-pencil"></i></a>
                  </div>

                  <br>

                  <div>
                    <a class="btn btn-danger" 
                      href="aksi_hapus_kerjasama.php?&id=<?php echo $data['id_kerjasama'];?>" 
                      onclick="return confirm('Yakin akan dihapus ?');"><i class="fa fa-trash-o"></i></a>
                  </div>
                  </td>
                 
                </tr>
                <?php
			
				}
				?>
                </tbody>
              </table>
              </div>
            <!-- /.col-lg-6 (nested) -->
          </div>
          <!-- /.row (nested) -->
          </div>
          <!-- /.panel-body -->
          </div>
            
          </section>
    
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
