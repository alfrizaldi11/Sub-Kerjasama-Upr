<?php
include "koneksi.php";
session_start();
if (empty ($_SESSION['username']) AND empty ($_SESSION['pass']) ){
  echo "<script> alert('Anda harus login terlebih dahulu');
  window.location = 'hal_login.php'</script>";
}
if($_SESSION['level']!="unit"){
    die("404 Not Found");
}


$timeout = 1; // Set timeout menit
$logout_redirect_url = "hal_login.php"; // Set logout URL
 
$timeout = $timeout * 1800; // Ubah menit ke detik
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Waktu Anda Telah Habis'); window.location = '$logout_redirect_url'</script>";
    }
}
$_SESSION['start_time'] = time();

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Import Data Excel dengan PHP</title>

		<!-- Load File bootstrap.min.css yang ada difolder css -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- Style untuk Loading -->
		<style>
        #loading{
			background: whitesmoke;
			position: absolute;
			top: 140px;
			left: 82px;
			padding: 5px 10px;
			border: 1px solid #ccc;
		}
		</style>

		<!-- Load File jquery.min.js yang ada difolder js -->
		<script src="js/jquery.min.js"></script>

		<script>
		$(document).ready(function(){
			// Sembunyikan alert validasi kosong
			$("#kosong").hide();
		});
		</script>
	</head>
	<body>



		<!-- Content -->
		<div style="padding: 0 15px;">
			<!-- Buat sebuah tombol Cancel untuk kemabli ke halaman awal / view data -->
			

			<h3>Form Import Data</h3>
			<hr>

			<!-- Buat sebuah tag form dan arahkan action nya ke file ini lagi -->
			<form method="post" action="" enctype="multipart/form-data">
				<a href="Format.xlsx" class="btn btn-light pull-right">
					<span class="glyphicon glyphicon-download"></span>
					Download Format
				</a><br><br>

				<!--
				-- Buat sebuah input type file
				-- class pull-left berfungsi agar file input berada di sebelah kiri
				-->
				<input type="file" name="file" class="pull-left">

				<button type="submit" name="preview" class="btn btn-success pull-right">
					<span class="glyphicon glyphicon-eye-open"></span> Preview
				</button>
				<a href="input_data.php" class="btn btn-danger pull-right">
				<span class="glyphicon glyphicon-remove"></span> Cancel
			</a>
			</form>

			<!-- Buat Preview Data -->
			<?php
			// Jika user telah mengklik tombol Preview
			if(isset($_POST['preview'])){


				//$ip = ; // Ambil IP Address dari User
				$nama_file_baru = 'data.xlsx';

				// Cek apakah terdapat file data.xlsx pada folder tmp
				if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
					unlink('tmp/'.$nama_file_baru); // Hapus file tersebut

				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); // Ambil ekstensi filenya apa
				$tmp_file = $_FILES['file']['tmp_name'];

				// Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
				if($ext == "xlsx"){
					// Upload file yang dipilih ke folder tmp
					// dan rename file tersebut menjadi data{ip_address}.xlsx
					// {ip_address} diganti jadi ip address user yang ada di variabel $ip
					// Contoh nama file setelah di rename : data127.0.0.1.xlsx
					move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);

					// Load librari PHPExcel nya
					require_once 'PHPExcel/PHPExcel.php';

					$excelreader = new PHPExcel_Reader_Excel2007();
					$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
					$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

					// Buat sebuah tag form untuk proses import data ke database
					echo "<form method='post' action='import.php'>";

					// Buat sebuah div untuk alert validasi kosong
					echo "<div class='alert alert-danger' id='kosong'>
					Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
					</div>";

					echo "<table class='table table-bordered'>
					<tr>
						<th colspan='6' class='text-center'>Preview Data</th>
					</tr>
					<tr>
						<th>Nama Unit</th>
						<th>Institusi Mitra</th>
						<th>Ruang Lingkup</th>
						<th>Periode Berlaku</th>
						<th>Tempo Berlaku</th>
						<th>Keterangan</th>
					</tr>";
					$numrow = 1;
					$kosong = 0;
					foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
						// Ambil data pada excel sesuai Kolom
						// Ambil data pada excel sesuai Kolom
						$nama_unit = $row['A']; // Ambil data Nama Unit
						$institusi_mitra = $row['B']; // Ambil data instisutusi mitra
						$ruang_lingkup = $row['C']; // Ambil data ruang lingkup
						$periode_berlaku = $row['D']; // Ambil data periode berlaku
						$tempo_berlaku = $row['E']; // Ambil data tempo berlaku
						$keterangan = $row['F']; // Ambil data keterangan

						// Cek jika semua data tidak diisi
						if($nama_unit == "" && $institusi_mitra == "" && $ruang_lingkup == "" && $periode_berlaku == "" && $tempo_berlaku == "" && $keterangan == "")
							continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

						// Cek $numrow apakah lebih dari 1
						// Artinya karena baris pertama adalah nama-nama kolom
						// Jadi dilewat saja, tidak usah diimport
						if($numrow > 1){
							// Validasi apakah semua data telah diisi
							$nama_unit_td = ( ! empty($nama_unit))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
							$institusi_mitra_td = ( ! empty($institusi_mitra))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
							$ruang_lingkup_td = ( ! empty($ruang_lingkup))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
							$periode_berlaku_td = ( ! empty($periode_berlaku))? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah
							$tempo_berlaku_td = ( ! empty($tempo_berlaku))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
							$keterangan_td = ( ! empty($keterangan))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
							// Jika salah satu data ada yang kosong
							if($nama_unit == "" && $institusi_mitra == "" && $ruang_lingkup == "" && $periode_berlaku == "" && $tempo_berlaku == "" && $keterangan == ""){
								$kosong++; // Tambah 1 variabel $kosong
							}

							echo "<tr>";
							echo "<td".$nama_unit_td.">".$nama_unit."</td>";
							echo "<td".$institusi_mitra_td.">".$institusi_mitra."</td>";
							echo "<td".$ruang_lingkup_td.">".$ruang_lingkup."</td>";
							echo "<td".$periode_berlaku_td.">".$periode_berlaku."</td>";
							echo "<td".$tempo_berlaku_td.">".$tempo_berlaku."</td>";
							echo "<td".$keterangan_td.">".$keterangan."</td>";
							echo "</tr>";
						}

						$numrow++; // Tambah 1 setiap kali looping
					}

					echo "</table>";

					// Cek apakah variabel kosong lebih dari 1
					// Jika lebih dari 1, berarti ada data yang masih kosong
					if($kosong > 1){
					?>
						<script>
						$(document).ready(function(){
							// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
							$("#jumlah_kosong").html('<?php echo $kosong; ?>');

							$("#kosong").show(); // Munculkan alert validasi kosong
						});
						</script>
					<?php
					}else{ // Jika semua data sudah diisi
						echo "<hr>";

						// Buat sebuah tombol untuk mengimport data ke database
						echo "<button type='submit' name='import' class='btn btn-primary pull-right'><span class='glyphicon glyphicon-upload'></span> Import</button>";
					}

					echo "</form>";
				}else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
					// Munculkan pesan validasi
					echo "<div class='alert alert-danger'>
					Hanya File Excel 2007 (.xlsx) yang diperbolehkan
					</div>";
				}
			}
			?>
		</div>
	</body>
</html>
