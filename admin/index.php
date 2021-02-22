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

$data_admin=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM myadmin"));
$data_unit=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM unit"));
$data_galeri=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM galeri"));
$data_kerjasama=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM kerjasama"));
$data_kerjasama1=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM kerjasama where keterangan='Dalam Negri'"));
$data_kerjasama2=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM kerjasama where keterangan='Luar Negri'"));
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
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $data_admin ?></h3>

              <p>Pengguna</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>

          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $data_unit ?></h3>

              <p>Unit</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-contacts"></i>
            </div>

          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $data_galeri ?></h3>

              <p>Galeri</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-image"></i>
            </div>

          </div>
        </div>
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $data_kerjasama ?></h3>

              <p>Kerjasama</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>

          </div>
        </div>



      </div>


      <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Donut Chart Kerjasama</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="donut-chart" style="height: 500px;"></div>
            </div>
              <div align="center">
              <?php
                  $tanggal= mktime(date("m"),date("d"),date("Y"));
                  echo "Tanggal : <b>".date("d-M-Y", $tanggal)."</b> ";
                  date_default_timezone_set('Asia/Jakarta');
                  $jam=date("H:i:s");
                  echo "| Pukul : <b>". $jam." "."</b>";
                  $a = date ("H");
                  if (($a>=6) && ($a<=11)){
                  echo "<b>, Selamat Pagi..</b>";
                  }
                  else if(($a>11) && ($a<=15))
                  {
                  echo ", Selamat Siang..";}
                  else if (($a>15) && ($a<=18)){
                  echo ", Selamat Sore!!";}
                  else { echo ", <b> Selamat Malam.. </b>";}
              ?>
              </div> 
            </div>
            <!-- /.box-body -->



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
  include 'footer.php';

  ?>

  <!-- /.control-sidebar -->
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
<!-- FLOT CHARTS -->
<script src="bower_components/Flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="bower_components/Flot/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="bower_components/Flot/jquery.flot.pie.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="bower_components/Flot/jquery.flot.categories.js"></script>
<!-- Page script -->

<script>
  $(function () {
     /*
     * DONUT CHART
     * -----------
     */

    var donutData = [
      { label: 'Dalam Negri', data: '<?php echo $data_kerjasama1 ?>', color: '#3c8dbc' },
      { label: 'Luar Negri', data: '<?php echo $data_kerjasama2 ?>', color: '#0073b7' }
    ]
    $.plot('#donut-chart', donutData, {
      series: {
        pie: {
          show       : true,
          radius     : 1,
          innerRadius: 0.5,
          label      : {
            show     : true,
            radius   : 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: false
      }
    })
    /*
     * END DONUT CHART
     */

       })
     function labelFormatter(label, series) {
    return '<div style="font-size:15px; text-align:center; margin-left:25px; color: #fff; font-weight: 800;">'
      + label
      + '<br>'
      + Math.round(series.percent) + '%</div>'
  }

</script>
</body>
</html>