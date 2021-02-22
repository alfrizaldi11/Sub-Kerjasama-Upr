<?php 
error_reporting(0);
include '../config/koneksi.php';
  session_start();

  $id_kerjasama = $_POST['id_kerjasama'];
  $nama_unit = $_POST['id_unit'];
  $institusi_mitra = $_POST['institusi_mitra'];
  $ruang_lingkup = $_POST['ruang_lingkup'];
  $periode_berlaku = $_POST['periode_berlaku'];
  $tempo_berlaku = $_POST['tempo_berlaku'];
  $keterangan = $_POST['keterangan'];

  
  $query = mysqli_query($koneksi,"UPDATE kerjasama SET id_unit='$nama_unit', institusi_mitra='$institusi_mitra', ruang_lingkup='$ruang_lingkup', periode_berlaku='$periode_berlaku', tempo_berlaku='$tempo_berlaku', 
 keterangan='$keterangan' WHERE id_kerjasama='$id_kerjasama'");

if($query){ 
	echo "<script> alert('Data Kerjasama berhasil disimpan');
	window.location = 'kelola_kerjasama.php'</script>";
   }else{ 
   echo "<script> alert ('Data Kerjasama Gagal disimpan');
  window.location = 'kelola_kerjasama.php'</script>";
   }
   ?>  
