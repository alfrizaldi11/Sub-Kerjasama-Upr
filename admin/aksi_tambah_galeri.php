<?php 
error_reporting(0);
include '../config/koneksiadmin.php';
  session_start();
$id_galeri=$_POST['id_galeri'];
$nama_album = $_POST['id_album'];
$nama_galeri = $_POST['nama_galeri'];

 $lokasi_file    = $_FILES['foto']['tmp_name'];
 $nama_file      = $_FILES['foto']['name'];
 $tipe_foto      = $_FILES['foto']['type'];
  // Apabila ada gambar yang diupload

 if(empty($lokasi_file)){
	mysqli_set_charset('utf8');
			$query = "INSERT INTO galeri (id_album, nama_galeri)VALUES ('$nama_album', '$nama_galeri')";
	}
	elseif (empty($nama_galeri)) {
     echo "<script> alert('Masukkan Nama Galeri'); window.location='tambah-kelola_galeri.php';</script>";
}
			
	 elseif(!empty($lokasi_file)){
		 mysqli_set_charset('utf8');
	 if($tipe_foto != 'image/jpeg'){
			echo "<script>alert('Proses Tambah Gagal, foto Harus Format JPEG'); window.location='kelola_galeri.php';</script>";
		} else {
 move_uploaded_file($lokasi_file,'image/galeri/'.$nama_file);
 $query = "INSERT INTO galeri (id_album, nama_galeri, foto)VALUES ('$nama_album', '$nama_galeri', '$nama_file')";
		}
	 }		
 $hasil = mysqli_query($connect, $query); 
 
 if($hasil){ 
  echo "<script> alert('Data galeri berhasil disimpan');
  window.location = 'kelola_galeri.php'</script>";
 }else{ 
 echo "<script> alert ('Data galeri gagal disimpan');
window.location = 'kelola_galeri.php'</script>";
 }
 
 ?>  