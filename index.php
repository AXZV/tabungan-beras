<?php
	session_start();
	include('db_con2.php');
	include 'function/fungsi.php';

	$query3 = "SELECT SUM(`jumlah_transaksi_beras`) as total FROM log_sedekah WHERE status='sudah_diverifikasi'";
	$results3 = mysqli_query($db, $query3) or die (mysqli_error());
	$row3=mysqli_fetch_array($results3);
	$lenght4 = mysqli_num_rows($results3);
	$totalsedekah = round($row3['total'], 2);

	$konv= new konversi;
	$finaltotalsaldo = $konv->normal($totalsedekah);

	$query2 = "SELECT * FROM log_penyaluran_sedekah";
	$results2 = mysqli_query($db, $query2) or die (mysqli_error());
	$lenght1=mysqli_num_rows($results2);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Tabungan Beras | Website Penyedia Tabungan Beras</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="icon" href="favicon/favicon.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon"/>
	<meta name="theme-color" content="#4AB616">
	<?php include('partials/css.php'); ?>
</head>
<body>


<!-- nav bar -->

		<?php

		// echo '<pre>' . print_r($_SESSION, TRUE).'<pre>';
		if (isset($_SESSION['s_user_id']))
		{
			$id_user= $_SESSION['s_user_id'];
			echo("<script>console.log('PHP: " . "session id : ". $id_user . "');</script>");
			//// ambil nama depan pengguna
			$query = "SELECT * FROM akun_user WHERE id_user='$id_user'";
			$results = mysqli_query($db, $query) or die (mysqli_error());
			$data=mysqli_fetch_array($results);
	
			$namalkp = $data['nama'];
			$namapengguna = strtok($namalkp, " ");
		}
		else
		{
			$id_user = null;
			echo("<script>console.log('PHP: " . "session id : ". "null" . "');</script>");
		}
		?>
				<nav class="navbar navbar-expand-lg navbar-dark transparent fixed-top nav-sticky" style="z-index: 2">
				<a class="navbar-brand" href="index"><!-- <i class="fas fa-balance-scale"></i> --><span style="font-family: 'Righteous', cursive; letter-spacing: 1px"> Tabungan Beras</span></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
					aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
					<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="tabungan/beras"><i class="fas fa-money-bill-wave"></i> Tabungan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="penarikan/beras"><i class="fab fa-get-pocket"></i> Penarikan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="sedekah/beras"><i class="fas fa-donate"></i> Sedekah</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="tentang"><i class="fa fa-address-card"></i> Tentang Kami</a>
					</li>
					<?php
					if($id_user == null) { ?>
						<li class="nav-item">
							<a class="nav-link" href="login"><i class="fa fa-sign-in-alt"></i> Masuk</a>
						</li>
					<?php }
					if ($id_user != null) {?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?php echo $namapengguna ?> </a>
							<div class="dropdown-menu dropdown-primary dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
								<a class="dropdown-item" href="profile"><i class="fa fa-user grey-text"></i> Profile</a>
								<a class="dropdown-item" data-toggle="modal" data-target="#basicExampleModal"><i class="fa fa-sign-out-alt grey-text"></i> Keluar</a>
							</div>
						</li>
					<?php } ?>

				</ul>
			</div>
		</nav>
		<!-- modal logout -->
		<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Keluar</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<span>Apakah anda yakin akan keluar?</span>
					</div>
					<div class="modal-footer">
						<a class="btn btn-color" data-dismiss="modal">Batal</a>
						<a href="login/logout.php" class="btn btn-danger">Keluar</a>
					</div>
				</div>
			</div>
		</div>

<!-- end code -->

<div class="container-fluid">
	<div class="row" style="height: 450px; background: url(https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80); background-size: cover; background-position: center; filter: brightness(0.4);"></div>
	<div class="wellcome " style="position: absolute; left: 0; right: 0; margin: auto; top: 20vh">
		<div class="title white-text text-center">
		  <h1 class="font-weight-bold" style="font-family: 'Righteous', cursive;"><!-- <i class="fas fa-balance-scale"></i> --> Tabungan Beras</h1>
		  <h5>Tabungan Beras merupakan penyedia jasa layanan tabungan<br>dengan konsep setoran yang berbeda dengan penyedia jasa tabungan pada umumnya</h5>
		  <div class="d-inline-block">
		  	<a href="#pelajari" class="btn btn-color">Pelajari Lebih Lanjut</a>
		  </div>
		</div>
	</div>
</div>

<section>
	<div class="container mt-3 py-5">
		<div class="heading text-center mb-5">
			<h2 class="font-weight-bold">Kategori</h2>
			<hr>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-12 text-center">
				<img width="100" src="https://image.flaticon.com/icons/svg/1138/1138548.svg">
				<h5 class="font-weight-bold mt-1">Tabungan</h5>
				<p>Tabungan Beras, Tabungan Uang<br>anda dapat mengakses menu tabungan di sini.</p>
				<a href="tabungan/beras" class="btn btn-color">Tabung Sekarang</a>
			</div>
			<div class="col-md-6 col-sm-12 text-center">
				<img width="100" src="https://image.flaticon.com/icons/svg/1530/1530847.svg">
				<h5 class="font-weight-bold mt-1">Sedekah</h5>
				<p>Sedekah Beras, Sedekah Uang<br>anda dapat mengakses menu sedekah di sini.</p>
				<a href="sedekah/beras" class="btn btn-color">Sedekah Sekarang</a>
			</div>
		</div>
	</div>
</section>
<section id="pelajari" style="padding-top: 4rem;">
	<div class="container">
		<div class="heading text-center mb-5">
			<h2 class="font-weight-bold">Bagaimana Tabungan Beras Bekerja?</h2>
			<hr>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-12 border-right mb-3">
				<img class="img-fluid" src="asset/image/undraw_digital_currency_qpak.svg">
			</div>
			<div class="col-md-6 col-sm-12">
				<div class="media mb-3">
				  <img class="d-flex mr-3" width="70" src="https://image.flaticon.com/icons/svg/145/145867.svg" alt="Generic placeholder image">
				  <div class="media-body text-justify">
				    <h5 class="mt-0 font-weight-bold">Daftar</h5>
				    <span>Untuk dapat mengakses layanan Tabungan Beras, anda dapat membuat akun terlebih dahulu, dengan mendaftarkan diri anda. Isi formulir pendaftaran dengan cermat, demi kemudahan transaksi. Data diri anda menjadi rahasia kami.</span>
				  </div>
				</div>
				<div class="media mb-3">
				  <img class="d-flex mr-3" width="70" src="https://image.flaticon.com/icons/svg/1138/1138548.svg" alt="Generic placeholder image">
				  <div class="media-body text-justify">
				    <h5 class="mt-0 font-weight-bold">Menabung</h5>
				    <span>Selesaikan proses transaksi dengan mengisi form yang tersedia.
					Untuk setoran uang anda dapat memilih dengan menyerahkan langsung setoran ke kantor terdekat kami atau dengan transfer bank.
					Untuk setoran beras, anda juga dapat menyerahkan langsung ke kantor terdekat kami.
					NB: layanan COD setoran, bisa untuk transaksi tabungan dengan minimal setoran beras 500 kg, atau setoran uang Rp 500.000</span>
				  </div>
				</div>
				<div class="media mb-3">
				  <img class="d-flex mr-3" width="70" src="https://image.flaticon.com/icons/svg/1530/1530847.svg" alt="Generic placeholder image">
				  <div class="media-body text-justify">
				    <h5 class="mt-0 font-weight-bold">Sedekah</h5>
				    <span>Anda juga dapat menggunakan layanan sedekah kami, yang pengalokasiannya akan kami kordinasikan dengan pemberi sedekah, dan kami konfirmasi setelah selesai penyerahan.</span>
				  </div>
				</div>
				<div class="media mb-3">
				  <img class="d-flex mr-3" width="70" src="https://image.flaticon.com/icons/svg/639/639365.svg" alt="Generic placeholder image">
				  <div class="media-body text-justify">
				    <h5 class="mt-0 font-weight-bold">Penarikan</h5>
				    <span>Nasabah dapat menarik kapanpun tabungannya, minimal satu bulan setelah tanggal penabungan.</span>
				  </div>
				</div>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container py-5">
		<div class="heading text-center">
			<h2 class="font-weight-bold">Sedekah</h2>
			<p class="text-center">Sedekah yang anda sumbangkan akan kami salurkan ke pihak-pihak yang membutuhkan.<br>Proses penyaluran dilakukan secara langsung atau bekerjasama dengan Lembaga maupun Organisasi nonprofit.</p>
			<hr>
		</div>
		<div class="row">
			<div class="col-md-8 col-sm-12">
				<div class="card mb-3">
					<div class="card-header">
						<h5 class="font-weight-bold m-0">Detail Penyaluran Sedekah</h5>
					</div>
					<div class="card-body p-0">
						<div class="scr-div" style="height: 250px; overflow-y: auto;">
						<?php if($lenght1 < 0){ ?>
							<ul class="list-group list-group-flush">

							<?php while ($row33 = mysqli_fetch_array($results2)){ ?>
								<li class="list-group-item">
									<div class="media">
									  <img class="d-flex mr-3" width="70" src="https://image.flaticon.com/icons/svg/1530/1530847.svg" alt="Generic placeholder image">
									  <div class="media-body">
									    <h5 class="mt-0"><?php echo $row33['target']?></h5>
									    <p class="m-0"><span>Jumlah :</span> <?php echo $row33['jumlah']?> Kg</p>
									    <p class="m-0"><span>Tanggal :</span> <?php echo $row33['tanggal']?></p>
									  </div>
									</div>
								</li>	
								<?php } ?>						
							</ul>
							<?php } else {?>
									<div>
										<i class="far fa-frown"></i>
										<p>kami belum menyalurkan sedekah / kami belum menerima sumbangan sedekah dari donatur.<br>
										Mari bantu ringankan beban saudara-saudara kita.</p>
										<a href="sedekah/beras" class="btn btn-color"><i class="fas fa-hand-holding-heart"></i> Sedekah Sekarang</a>
									</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-12 text-center">
				<h5 class="mt-0 font-weight-bold">Total Saldo Sedekah Saat Ini</h5>
				<h1 class="font-color" style="font-size: 3.5rem;"><span class="counter"><?php echo $finaltotalsaldo ?></span> Kg</h1>
				<img class="img-fluid" src="asset/image/undraw_gifts_btw0.svg">
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container py-5">
		<div class="heading text-center mb-5">
			<h2 class="font-weight-bold">Mengapa Memilih Tabungan Beras?</h2>
			<hr>
		</div>
		<div class="row text-center">
			<div class="col-md-4 col-sm-12">
				<i style="font-size: 5rem" class="fas fa-user-shield font-color mb-1"></i>
				<h4 class="font-weight-bold">Keamanan</h4>
				<p>Tabungan Beras menggunakan sistem keamanan yang baik, sehingga pengguna tidak perlu khawatir dengan masalah keamanan.</p>
			</div>
			<div class="col-md-4 col-sm-12">
				<i style="font-size: 5rem" class="fas fa-shipping-fast font-color mb-1"></i>
				<h4 class="font-weight-bold">Layanan</h4>
				<p>Tabungan Beras mempunyai layanan COD (Ambil Barang Langsung Ketempat) untuk mempermudah dalam transaksi.</p>
			</div>
			<div class="col-md-4 col-sm-12">
				<i style="font-size: 5rem" class="fas fa-money-check-alt font-color mb-1"></i>
				<h4 class="font-weight-bold">Kemudahan</h4>
				<p>Tabungan Beras mempunyai metode pembayaran, seperti transfer uang, untuk mempermudah dalam pembayaran.</p>
			</div>
		</div>
	</div>
</section>
<hr>
<section class="white">
       <div class="container p-4">
          <div class="copyright text-center text-muted">
            <span style="font-family: 'Righteous', cursive; font-size: 1.5rem; line-height: 1"><!-- <i class="fa fa-balance-scale"> --></i>Tabungan Beras<br></span>
            <small style="line-height: 1"> 
				<a class="text-muted font-weight-bold" href="tentang">Tentang</a> &bull; 
				<a class="text-muted font-weight-bold" href="privasi">Kebijakan</a>
				<br><span>Tabungan 1.0 All Right Reserved</span>
			</small>
          </div>
        </div>
</section>
<style type="text/css">
.nav-sticky.scrolled {
  background-color: #4AB616 !important;
  transition: background-color 200ms linear;
}
</style>

<?php include('partials/js.php'); ?>
<!-- sticky -->
<script>
$(function () {
  $(document).scroll(function () {
    var $nav = $(".nav-sticky");
    $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
  });
});
</script>

<!-- scroll -->
<script>
$(document).ready(function(){
  $("a").on('click', function(event) {
    if (this.hash !== "") {
      event.preventDefault();
      var hash = this.hash;
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 300, function(){
        window.location.hash = hash;
      });
    }
  });
});

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
<script src="asset/js/jquery.countup.js"></script>
<script>
$('.counter').countUp();
</script>
</body>
</html>