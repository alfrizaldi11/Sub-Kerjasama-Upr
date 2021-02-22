<?php 
include '../config/koneksiadmin.php';
  session_start();

 $isi_visi_misi = ltrim($_POST['isi_visi_misi']);
  
 
if (empty($isi_visi_misi)) {
     echo "<script> alert('Tidak ada visi & misi yang di masukkan'); window.location='kelola_visi&misi.php';</script>";
}
		else {
			$update="UPDATE visi_misi set isi_visi_misi='$isi_visi_misi'";
		
	}
$cek = mysqli_query($connect, $update);

if($cek){
    
 
	echo "<script> alert ('Visi & Misi  berhasil di ubah');
	window.location = 'kelola_visi&misi.php'</script>";
	} else {
		echo "<script> alert ('Visi & Misi gagal di ubah');
		window.location = 'kelola_visi&misi.php'</script>";
}
?>