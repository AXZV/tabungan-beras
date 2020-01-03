<?php
	session_start();
	include('db_con2.php');
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
						<a type="button" class="btn btn-color" data-dismiss="modal">Batal</a>
						<a type="button" href="login/logout.php" class="btn btn-danger">Keluar</a>
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
	<div class="container my-3 py-5">
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
			<h2 class="font-weight-bold">Bagaimana Tabungan Bekerja?</h2>
			<hr>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-12 border-right">
				<img class="img-fluid" src="asset/image/undraw_Savings_dwkw.svg">
			</div>
			<div class="col-md-6 col-sm-12">
				<div class="media mb-3">
				  <img class="d-flex mr-3" width="100" src="https://image.flaticon.com/icons/svg/755/755195.svg" alt="Generic placeholder image">
				  <div class="media-body">
				    <h5 class="mt-0 font-weight-bold">Media heading</h5>
				    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in
				    vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia
				    congue felis in faucibus.
				  </div>
				</div>
				<div class="media mb-3">
				  <img class="d-flex mr-3" width="100" src="https://image.flaticon.com/icons/svg/2060/2060274.svg" alt="Generic placeholder image">
				  <div class="media-body">
				    <h5 class="mt-0 font-weight-bold">Media heading</h5>
				    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in
				    vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia
				    congue felis in faucibus.
				  </div>
				</div>
				<div class="media">
				  <img class="d-flex mr-3" width="100" src="https://image.flaticon.com/icons/svg/639/639365.svg" alt="Generic placeholder image">
				  <div class="media-body">
				    <h5 class="mt-0 font-weight-bold">Media heading</h5>
				    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in
				    vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia
				    congue felis in faucibus.
				  </div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="background-color-2">
	<div class="container py-5">
		<div class="heading text-center mb-5">
			<h2 class="font-weight-bold">Mengapa Memilih Tabungan?</h2>
			<hr>
		</div>
		<div class="row text-center">
			<div class="col-md-4 col-sm-12">
				<i style="font-size: 5rem" class="fas fa-user-shield font-color mb-1"></i>
				<h4 class="font-weight-bold font-color">Keamanan</h4>
				<p>Tabungan Beras menggunakan sistem keamanan yang baik, sehingga pengguna tidak perlu khawatir dengan masalah keamanan.</p>
			</div>
			<div class="col-md-4 col-sm-12">
				<i style="font-size: 5rem" class="fas fa-shipping-fast font-color mb-1"></i>
				<h4 class="font-weight-bold font-color">Layanan</h4>
				<p>Tabungan Beras mempunyai layanan COD (Ambil Barang Langsung Ketempat) untuk mempermudah dalam transaksi.</p>
			</div>
			<div class="col-md-4 col-sm-12">
				<i style="font-size: 5rem" class="fas fa-money-check-alt font-color mb-1"></i>
				<h4 class="font-weight-bold font-color">Kemudahan</h4>
				<p>Tabungan Beras mempunyai metode pembayaran, seperti transfer uang, untuk mempermudah dalam pembayaran.</p>
			</div>
		</div>
	</div>
</section>

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
</body>
</html>