<?php 
session_start();
include '../config/koneksiadmin.php';
error_reporting(0);
if (isset($_POST['update'])) { //apabila tombol simpan dijalankan maka update data dijalankan

$id_album=$_POST['id_album'];
$nama_album = $_POST['nama_album'];

 $lokasi_file    = $_FILES['cover']['tmp_name'];
 $nama_file      = $_FILES['cover']['name'];
 $tipe_foto      = $_FILES['cover']['type'];
 
if(empty($lokasi_file)){
	mysqli_set_charset('utf8');
		$update="update album set nama_album='$nama_album' where id_album='$id_album'";
}
elseif (empty($nama_album)) {
     echo "<script> alert('Masukkan Nama album'); window.location='kelola_album.php';</script>";
}

elseif (!empty($lokasi_file)){
	 mysqli_set_charset('utf8');
	if ($tipe_foto != "image/jpeg"){
     echo "<script>window.alert('Proses Ubah Gagal, cover Harus Format JPEG');
       window.location='kelola_album.php'</script>";
	}else{
	move_uploaded_file($lokasi_file,'image/album/'.$nama_file);
	
		 $update="update album set nama_album='$nama_album', cover='$nama_file' where id_album='$id_album'";
}}
 $cek = mysqli_query($connect,$update);
 
if($cek){ 
 echo "<script> alert('Data album Berhasil Diubah');
  window.location = 'kelola_album.php'</script>";
 }else{ 
 echo "<script> alert ('Data album Gagal Diubah');
window.location = 'kelola_album.php'</script>";
  }}
 
?>
