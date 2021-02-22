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

$data_galeri = mysqli_query($koneksi,"SELECT a.*, g.* FROM galeri g LEFT JOIN album a ON g.`id_album` = a.`id_album` order by g.id_galeri ASC");

?>

<!DOCTYPE html>
<html>
 <?php include 'head.php'; ?>  
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

      <?php include 'header.php'; ?>   
   
  <!-- Left side column. contains the logo and sidebar -->
  <?php include 'sidebar.php';?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <section class="content">
        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
      <h4><b>Input Galeri</b></h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                
                                    <form enctype='multipart/form-data' action="aksi_tambah_galeri.php" method="POST"  id="form_tambah_galeri">
                    
                    <div class="form-group">
                    <label>Nama Album</label>
                  <select name="id_album" class="form-control">
                  <option value="">-- Pilih Album --</option>
                        <?php
                  $tampil=mysqli_query($koneksi,"SELECT * FROM album ORDER BY nama_album");
                  while($data=mysqli_fetch_array($tampil)){
                  echo "<option value=$data[id_album]>$data[nama_album]</option>";}
                ?>
                      </select>
                    </div>
                    <div class="form-group">
                    <label>Nama galeri</label>
                    <input class="form-control"placeholder="Masukkan Nama Galeri "name="nama_galeri"required>
                    </div>
                    <div class="form-group">
                    <label>Foto</label>
                    <input type="file" name="foto" id="foto" required>
                    </div>
                    <br>
                    <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>  Simpan</button>
                    <input type="reset" value="Reset" class="btn btn-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        
                    </div>
                    
                    
                    
                    
                  
                                       </form> 
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
</section>
         
          <!-- Main Content -->
          <section class="content">
              
              <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4><b>Data Galeri</b></h4>
                        </div>
                        
                        <div class="panel-body">
      <div class="table-responsive dataTable_wrapper">
           
            <table align="center" class="table table-striped table-bordered table-hover" id="example1">
            
          <thead class="text-center">
          <th><center>No</th>   
          <th><center>Nama Album</th>         
          <th><center>Nama Galeri</th>
          <th><center>Foto</th>
          <th><center>Aksi</th>  
                
          </thead>
        <tbody>
          <?php
          $no = 1;
          while ($data = mysqli_fetch_array($data_galeri)) {
              ?>
              
        <tr align="center">
          <td><center><?php echo $no++; ?></center></td>
          <td><?php echo $data['nama_album']?></td>
          <td><?php echo $data['nama_galeri']; ?></td>
          <td><center><image src="image/galeri/<?php echo $data['foto']; ?>" style="width: 100px; height: 100px;"></td>
          <td align="center">
                  <div>
                    <a class="btn btn-success" 
                      href="edit_galeri.php?id=<?php echo $data['id_galeri'];?>"><i class="fa fa-pencil"></i></a>
                  </div>

                  <br>

                  <div>
                    <a class="btn btn-danger" 
                      href="aksi_hapus_galeri.php?&id=<?php echo $data['id_galeri'];?>" 
                      onclick="return confirm('Yakin akan dihapus ?');"><i class="fa fa-trash-o"></i></a>
                  </div>
                  </td>
                                   
        </tr>
                
              <?php } ?>
                                </tbody>
      </table>
            
                        <!-- /.table-responsive --> 
              
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
          </div>
        </section>

  </div>
  <!-- /.content-wrapper -->
  <?php include 'footer.php'; ?>
  
 
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