<?php 
// mengaktifkan session pada php
session_start();
// menghubungkan php dengan koneksi database
include "config/koneksilogin.php";

 
// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$pass = $_POST['pass'];
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"SELECT * FROM myadmin where username='$username' and pass='$pass'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

$logintime = "UPDATE myadmin SET last_login = now() where username = '$username'";
mysqli_query($koneksi, $logintime);

// cek apakah username dan password di temukan pada database
if($cek > 0){
 
  $data = mysqli_fetch_assoc($login);
  // cek jika user login sebagai admin
  if($data['level']=="admin"){
    // buat session login dan username
    $_SESSION['username'] = $username;
    $_SESSION['level'] = "admin";
    $_SESSION["last_login_time"] = time();
    // alihkan ke halaman dashboard admin
    header("location:admin/index.php");
 
  // cek jika user login sebagai pegawai
  }else if($data['level']=="staf"){
    // buat session login dan username
    $_SESSION['username'] = $username;
    $_SESSION['level'] = "staf";
    $_SESSION["last_login_time"] = time();
    // alihkan ke halaman dashboard pegawai
    header("location:admin/index.php");
 
  // cek jika user login sebagai pengurus
  }else if($data['level']=="unit"){
    // buat session login dan username
    $_SESSION['username'] = $username;
    $_SESSION['level'] = "unit";
    $_SESSION["last_login_time"] = time();
    // alihkan ke halaman dashboard pengurus
    header("location:input_data.php");
 
  }else{
    // alihkan ke halaman login kembali
    echo "<script> alert('Username atau Password anda salah');
    window.location = 'hal_login.php'</script>";
  } 
}else{ 
    echo "<script> alert('Username atau Password anda salah');
    window.location = 'hal_login.php'</script>";
}


?>

<?php
$tanggal=date("Y-m-d H:i:s");
 
//fungsi untuk Logout otomatis
function login_validate() {
  //ukuran waktu dalam detik
  $timer=1800;
  //untuk menambah masa validasi
  $_SESSION["expires_by"] = time() + $timer;
}
 
function login_check() {
  //berfungsi untuk mengambil nilai dari session yang pertama
  $exp_time = $_SESSION["expires_by"];
  
  //jika waktu sistem lebih kecil dari nilai waktu session
  if (time() < $exp_time) {
    //panggil fungsi dan tambah waktu session
    login_validate();
    return true; 
  }else{
    //jika waktu session lebih kecil dari waktu session atau lewat batas
    //maka akan dilakukan unset session
    unset($_SESSION["expires_by"]);
    return false; 
  }
}
?>
