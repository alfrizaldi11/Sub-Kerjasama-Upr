<?php 
error_reporting(0);
include '../config/koneksiadmin.php';
  session_start();
$nama_album = $_POST['nama_album'];

 $lokasi_file    = $_FILES['cover']['tmp_name'];
 $nama_file      = $_FILES['cover']['name'];
 $tipe_foto      = $_FILES['cover']['type'];
 $direktori1 = "image/album/$nama_file";
  // Apabila ada gambar yang diupload

    
 $sql="SELECT * FROM album WHERE nama_album ='$nama_album'";
 $cek= mysqli_query($connect, $sql);
 if(mysqli_num_rows($cek) > 0){
	echo "<script>alert('Nama album $nama_album sudah terdaftar'); window.location='kelola_album.php';</script>";
	} else {
 if(empty($lokasi_file)){
	mysqli_set_charset('utf8');
			$query = "INSERT INTO album (nama_album)VALUES ('$nama_album')";
	}
	elseif (empty($nama_album)) {
     echo "<script> alert('Masukkan Nama album'); window.location='kelola_album.php';</script>";
}
			
	 elseif(!empty($lokasi_file)){
		 mysqli_set_charset('utf8');
	 if($tipe_foto != 'image/jpeg'){
			echo "<script>alert('Proses Tambah Gagal, cover Harus Format JPEG'); window.location='kelola_album.php';</script>";
		} else {
 move_uploaded_file($lokasi_file,'image/album/'.$nama_file);
 $query = "INSERT INTO album (nama_album, cover)VALUES ('$nama_album', '$nama_file')";
		}
	 }		
 $hasil = mysqli_query($connect, $query); 
 
 if($hasil){ 
  echo "<script> alert('Data album berhasil disimpan');
  window.location = 'kelola_album.php'</script>";
 }else{ 
 echo "<script> alert ('Data album Gagal disimpan');
window.location = 'kelola_album.php'</script>";
 }}
 
 ?>  