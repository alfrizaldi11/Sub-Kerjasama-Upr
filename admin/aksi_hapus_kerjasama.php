<?php 
include '../config/koneksi.php';

$id_kerjasama = $_GET['id'];
$query = mysqli_query($koneksi,"DELETE FROM kerjasama where id_kerjasama='$id_kerjasama'");
	
 if($query){ 
  echo "<script> alert('Data Kerjasama berhasil dihapus');
  window.location = 'kelola_kerjasama.php'</script>";
 }else{ 
 echo "<script> alert ('Data Kerjasama Gagal dihapus');
window.location = 'kelola_kerjasama.php'</script>";
 }
 ?>  