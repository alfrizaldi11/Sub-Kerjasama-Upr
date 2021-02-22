<?php 
include 'config/koneksi.php';
$halaman = 10; //batasan halaman
$page = isset($_GET['halaman'])? (int)$_GET["halaman"]:1;
$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
$query = mysql_query("SELECT * from kerjasama LIMIT $mulai, $halaman");
$sql = mysql_query("SELECT * from kerjasama");
$total = mysql_num_rows($sql);
$pages = ceil($total/$halaman); 
for ($i=1; $i<=$pages ; $i++){ ?>
 <a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
 
 <?php } 
 
?>