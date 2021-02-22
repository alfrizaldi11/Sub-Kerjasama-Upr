<?php 

include '../config/koneksi.php';
//error_reporting(0);

$nama_lengkap = $_POST ['nama_lengkap'];
$username = $_POST ['username'];
$pass = $_POST ['pass'];
$email = $_POST ['email'];
$lvl = $_POST ['level'];



 $cekreg=mysqli_query($koneksi,"SELECT * from myadmin where email ='$email'");
 if(mysqli_num_rows($cekreg) > 0){
	echo "<script>alert('email $email sudah terdaftar'); 
	window.location='kelola_admin.php';</script>";
	} else {
 
$query = mysqli_query($koneksi,"INSERT INTO myadmin (nama_lengkap,username,pass,email,level)
					VALUES ('$nama_lengkap','$username','$pass','$email','$lvl')");
	}
 if($query){ 
  echo "<script> alert('Data Admin berhasil disimpan');
  window.location = 'kelola_admin.php'</script>";
 }else{ 
 echo "<script> alert ('Data Unit Gagal disimpan');
window.location = 'kelola_admin.php'</script>";
 }
 ?>  