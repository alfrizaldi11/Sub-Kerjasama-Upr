<!DOCTYPE html>
<html>
<head>
	<title>Export Data Ke Excel Dengan PHP</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
		border: 1px solid #3c3c3c;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
 
	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>
<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data kerjasama fkip.xls");
?>

<h3>Data Kerjasama Universitas Palangkaraya</h3>
		
<table>

	<?php
	// Load file koneksi.php
	include "koneksiex.php";
	
	// Buat query untuk menampilkan semua data siswa
	$sql = $pdo->prepare("SELECT u.*, k.* FROM kerjasama k LEFT JOIN unit u ON k.`id_unit` = u.`id_unit` WHERE nama_unit='Fakultas Ilmu Keguruan dan Ilmu Pendidikan' order by u.nama_unit ASC");
	$sql->execute(); // Eksekusi querynya
	echo 
	'<tr>
	<td style="background:#EEE;font-weight:bold;">No.</td>
	<td style="background:#EEE;font-weight:bold;">Nama Unit</td>
	<td style="background:#EEE;font-weight:bold;">Institusi Mitra Kerjasama</td>
	<td style="background:#EEE;font-weight:bold;">Ruang Lingkup</td>
	<td style="background:#EEE;font-weight:bold;">Periode Berlaku</td>
	<td style="background:#EEE;font-weight:bold;">Tempo Berlaku</td>
	<td style="background:#EEE;font-weight:bold;">Keterangan</td>
	</tr>';
	
	$no = 1; // Untuk penomoran tabel, di awal set dengan 1
	while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
		echo "<tr>";
		echo "<td>".$no."</td>";
		echo "<td>".$data['nama_unit']."</td>";
		echo "<td>".$data['institusi_mitra']."</td>";
		echo "<td>".$data['ruang_lingkup']."</td>";
		echo "<td>".$data['periode_berlaku']."</td>";
		echo "<td>".$data['tempo_berlaku']."</td>";
		echo "<td>".$data['keterangan']."</td>";
		echo "</tr>";
		
		$no++; // Tambah 1 setiap kali looping
	}
	?>
	</table>
</body>
</html>
