<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tentang Kami</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="icon" href="favicon/favicon.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon"/>
	<meta name="theme-color" content="#4AB616">
	<?php include('../partials/css.php'); ?>
</head>
<body>
<?php include('../partials/navbar.php'); ?>
<section>
	<div class="container-fluid my-3">
		<div class="row">
			<div class="col-lg-6 col-sm-12">
				<div class="sticky-top mb-3 mb-lg-0" style="top: 5rem; z-index: 1">
					<img class="img-fluid" src="../asset/image/undraw_team_spirit_hrr4.svg">
				</div>
			</div>
			<div class="col-lg-6 col-sm-12 px-0 px-sm-0 px-md-0 px-lg-3 px-xl-3">
				<div class="card mb-4">
					<div class="card-header">
						<h5 class="font-weight-bold mb-0">Tentang Kami</h5>
					</div>
					<div class="card-body">
						<span class="font-color font-weight-bold">Tabungan Beras</span> merupakan penyedia jasa layanan tabungan dengan konsep setoran yang berbeda dengan penyedia jasa tabungan pada umumnya.
						<p class="font-weight-bold m-0 mt-3">Tabunganberas memiliki dua jenis setoran:</p>
						<ol>
							<li class="font-weight-bold">Setor uang<br>
							<span style="font-weight: normal;">Nasabah dengan jenis setoran ini, bisa langsung menyetorkan tabungannya dengan uang, kemudian jumlah nominal uang yang ditabungkan tersebut di konversi ke bentuk beras, jumlah kilogram beras yang didapat kemudian dimasukan ke buku tabungan.</span></li>

							<li class="font-weight-bold">Setor beras<br>
							<span style="font-weight: normal;">Nasabah dengan jenis setoran ini bisa menabung dengan menyetorkan beras yang dimiliki, jumlah kilogram beras dimasukan ke dalam buku tabungan.</span></li>
						</ol>
						Harga patokan yang digunakan untuk konversi mengacu pada harga di <a href="https://hargapangan.id/" target="_blank" class="font-color font-weight-bold">www.hargapangan.id</a>
						
						<p class="font-weight-bold m-0 mt-3">VISI</p>
						<ul>
							<li>menjadi lembaga tabungan kepercayaan petani Indonesia</li>
						</ul>

						<p class="font-weight-bold m-0 mt-3">VISI</p>
						<ul>
							<li>mempermudah akses tabungan untuk petani</li>
							<li>menjadi penyedia jasa tabungan kepercayaan petani</li>
							<li>menjadi pioner penyedian jasa tabungan berbasis sejenis</li>
						</ul>
					</div>
				</div>
				<div class="card mb-4">
					<div class="card-header">
						<h5 class="font-weight-bold mb-0">Kontak Kami</h5>
					</div>
					<div class="card-body">
						<p><span class="font-weight-bold">No. Telepon</span> : +6285601905402</p>
						<p><span class="font-weight-bold">Email</span> : suport.tabungan@gmail.com</p>
						<p><span class="font-weight-bold">Alamat</span> : Purwahamba, Suradadi, Tegal, Central Java, Indonesia</p>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h5 class="font-weight-bold mb-0">Alamat Kami</h5>
					</div>
					<div class="card-body p-0">
						<?php include("../maps/maps-out.php"); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php include('../partials/footer.php'); ?>
<?php include('../partials/js.php'); ?>
</body>
</html>