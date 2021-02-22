<?php 
include '../config/koneksi.php';

$id_unit = $_GET['id'];
$query = mysqli_query($koneksi,"DELETE FROM unit where id_unit='$id_unit'");
	
 if($query){ 
  echo "<script> alert('Data Unit berhasil dihapus');
  window.location = 'kelola_unit.php'</script>";
 }else{ 
 echo "<script> alert ('Data Unit Gagal dihapus');
window.location = 'kelola_unit.php'</script>";
 }
 ?>  