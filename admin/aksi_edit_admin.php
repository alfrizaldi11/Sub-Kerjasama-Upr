<?php 
//error_reporting(0);
include '../config/koneksi.php';
  session_start();

  $id_admin = $_POST['id_admin'];
  $nama_lengkap = $_POST ['nama_lengkap'];
  $username = $_POST ['username'];
  $pass = $_POST ['pass'];
  $email = $_POST ['email'];
  $lvl = $_POST ['level'];

  
$query=mysqli_query($koneksi,"UPDATE myadmin SET nama_lengkap='$nama_lengkap', username='$username', 
					pass='$pass', email='$email', level='$lvl' WHERE id_admin='$id_admin'");

if($query){
 
	echo "<script> alert ('Data berhasil di ubah');
	window.location = 'kelola_admin.php'</script>";
	} else {
		echo "<script> alert ('Data gagal di ubah');
		window.location = 'kelola_admin.php'</script>";
}
?>