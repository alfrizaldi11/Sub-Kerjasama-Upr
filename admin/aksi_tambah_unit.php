<?php 

include '../config/koneksi.php';
//error_reporting(0);

$nama_unit = $_POST['nama_unit'];
$email_unit = $_POST['email_unit'];
$alamat_unit = $_POST['alamat_unit'];



$cekreg =mysqli_query($koneksi,"SELECT * FROM unit WHERE nama_unit ='$nama_unit'");
 if(mysqli_num_rows($cekreg) > 0){
	echo "<script>alert('nama_unit $nama_unit sudah terdaftar'); 
	window.location='kelola_unit.php';</script>";
	} else {
 
$query =mysqli_query($koneksi,"INSERT INTO unit (nama_unit,email_unit, alamat_unit)
					VALUES ('$nama_unit','$email_unit','$alamat_unit')");
	}
 if($query){ 
  echo "<script> alert('Data Unit berhasil disimpan');
  window.location = 'kelola_unit.php'</script>";
 }else{ 
 echo "<script> alert ('Data Unit Gagal disimpan');
window.location = 'kelola_unit.php'</script>";
 }
 ?>  