<?php 
session_start();
include '../config/koneksiadmin.php';
error_reporting(0);
if (isset($_POST['update'])) { //apabila tombol simpan dijalankan maka update data dijalankan

$id_galeri=$_POST['id_galeri'];
$nama_album = $_POST['id_album'];
$nama_galeri = $_POST['nama_galeri'];

 $lokasi_file    = $_FILES['foto']['tmp_name'];
 $nama_file      = $_FILES['foto']['name'];
 $tipe_foto      = $_FILES['foto']['type'];
 
if(empty($lokasi_file)){
	mysqli_set_charset('utf8');
		$update="UPDATE galeri set id_album='$nama_album', nama_galeri='$nama_galeri' WHERE id_galeri='$id_galeri'";
}
elseif (empty($nama_galeri)) {
     echo "<script> alert('Masukkan Nama Galeri'); window.location='edit-kelola_galeri.php';</script>";
}

elseif (!empty($lokasi_file)){
	 mysqlI_set_charset('utf8');
	if ($tipe_foto != "image/jpeg"){
     echo "<script>window.alert('Proses Ubah Gagal, foto Harus Format JPEG');
       window.location='kelola_galeri.php'</script>";
	}else{
	move_uploaded_file($lokasi_file,'image/galeri/'.$nama_file);
	
		 $update="UPDATE galeri set id_album='$nama_album', nama_galeri='$nama_galeri', foto='$nama_file' where id_galeri='$id_galeri'";
}}
 $cek = mysqli_query($connect, $update);
 
if($cek){ 
 echo "<script> alert('Data Galeri Berhasil Diubah');
  window.location = 'kelola_galeri.php'</script>";
 }else{ 
 echo "<script> alert ('Data Galeri Gagal Diubah');
window.location = 'kelola_galeri.php'</script>";
  }}
 
?>
