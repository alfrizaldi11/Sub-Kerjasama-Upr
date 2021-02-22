<?php 
include '../config/koneksi.php';

$id_admin = $_GET['id'];
$query = mysqli_query($koneksi,"DELETE FROM myadmin where id_admin='$id_admin'");
	
 if($query){ 
  echo "<script> alert('Data Admin berhasil dihapus');
  window.location = 'kelola_admin.php'</script>";
 }else{ 
 echo "<script> alert ('Data Admin Gagal dihapus');
window.location = 'kelola_admin.php'</script>";
 }
 ?>  