<?php

include '../config/koneksi.php';
//bagian deklarasi 


$sql = mysqli_query($koneksi,"delete from galeri where id_galeri='$_GET[id]'");
if ($sql == TRUE) {
echo "<script> alert ('Proses Hapus Galeri Berhasil');
window.location='kelola_galeri.php'; </script>";
} else {
echo "<script> alert ('Proses Hapus Galeri Gagal');
history.back(); </script>";
}
?>