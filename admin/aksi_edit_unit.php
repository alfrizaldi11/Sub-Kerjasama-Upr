<?php 
error_reporting(0);
include '../config/koneksi.php';
  session_start();

$id_unit = $_POST['id_unit'];
$nama_unit = $_POST['nama_unit'];
$email_unit = $_POST['email_unit'];
$alamat_unit = $_POST['alamat_unit'];

  
$update=mysqli_query($koneksi,"UPDATE unit SET nama_unit='$nama_unit', email_unit='$email_unit', 
					alamat_unit='$alamat_unit' WHERE id_unit='$id_unit'");

if($update){
 
	echo "<script> alert ('Data berhasil di ubah');
	window.location = 'kelola_unit.php'</script>";
	} else {
		echo "<script> alert ('Data gagal di ubah');
		window.location = 'kelola_unit.php'</script>";
}
?>