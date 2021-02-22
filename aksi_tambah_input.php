<?php 
error_reporting(0);
include "config/koneksi.php";
  session_start();

$nama_unit = $_POST['id_unit'];
$institusi_mitra = $_POST['institusi_mitra'];
$ruang_lingkup = $_POST['ruang_lingkup'];
$periode_berlaku = $_POST['periode_berlaku'];
$tempo_berlaku = $_POST['tempo_berlaku'];
$keterangan = $_POST['keterangan'];


$query = mysqli_query($koneksi,"INSERT INTO kerjasama 
	(id_unit,institusi_mitra,ruang_lingkup, periode_berlaku,tempo_berlaku,keterangan)
					VALUES 
	('$nama_unit','$institusi_mitra','$ruang_lingkup','$periode_berlaku','$tempo_berlaku','$keterangan')");

 if($query){ 
  echo "<script> alert('Data Kerjasama berhasil disimpan');
  window.location = 'kerjasama.php'</script>";
 }else{ 
 echo "<script> alert ('Data Kerjasama Gagal disimpan');
window.location = 'input_data.php'</script>";
 }
 ?>  
