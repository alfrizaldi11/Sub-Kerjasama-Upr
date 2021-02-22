<?php
error_reporting(0);
include '../config/koneksi.php';
//bagian deklarasi 
$id = $_GET[id];


$sql = mysqli_query($koneksi,"delete from album where id_album='$id'");
if ($sql == TRUE) {
echo "<script> alert ('Proses Hapus Album Berhasil');
window.location='kelola_album.php'; </script>";
} else {
echo "<script> alert ('Proses Hapus Album Gagal');
history.back(); </script>";
}
?>