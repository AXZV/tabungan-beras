<?php
include('../db_con.php');
if (isset($_SESSION['s_admin_id']))
{
	header('Location:../admin') ;
}
else if (isset($_SESSION['s_user_id']))
{
	header('Location:../profile') ;
}
else
{

// $_SESSION['black']= "rrtt";
	// echo '<pre>' . print_r($_SESSION, TRUE).'<pre>';
///////////  Management Error
	if (isset($_SESSION['errorusername1']))
	{
		$sameusername = $_SESSION['errorusername1'];
	}
	else
	{
		$sameusername = 0;
	}
	if (isset($_SESSION['errornohp1']))
	{
		$samenohp = $_SESSION['errornohp1'];
	}
	else
	{
		$samenohp = 0;
	}
	if (isset($_SESSION['passwordbetul1']))
	{
		$passwordbetul = $_SESSION['passwordbetul1'];
	}
	else
	{
		$passwordbetul = 1;
	}

	if (isset($_SESSION['formerror1']) == 1 )
	{
		$username4 = $_SESSION['username1'];
		$password1 = $_SESSION['password1'];
		$password2 = $_SESSION['password21'];
		$nohp = $_SESSION['nohp1'];
		$namalengkap = $_SESSION['namalengkap1'];
		$noktp = $_SESSION['noktp1'];
		$alamat = $_SESSION['alamat1'];
		// $lat = $_SESSION['lat1'];
		// $lng = $_SESSION['lng1'];
		$email = $_SESSION['email1'];
	}
	else
	{
		$username4 = null;
		$password1 = null;
		$password2 = null;
		$nohp = null;
		$namalengkap = null;
		$noktp= null;
		$alamat = null;
		$lat = null;
		$lng = null;
		$email = null;
	}

	?>

<!DOCTYPE html>
<html>
<head>
	<title>Daftar</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
	<link rel="manifest" href="../favicon/site.webmanifest">
	<meta name="theme-color" content="#4AB616">
	<?php include('../partials/css.php'); ?>
</head>
<body>
<?php include('../partials/navbar.php'); ?>
<section class="container">
	<div >
		<div class="row py-5">
			<div class="col-lg-6 col-sm-12 px-0 px-sm-0 px-md-0 px-lg-3 px-xl-3">
				<div class="card">
					<div class="card-header">
						<h5 class="mb-0 font-weight-bold">Daftar</h5>
					</div>
					<div class="card-body">
				        <form method="post" action="proses_register.php">

							<label><span class="red-text">*</span> Nama Pengguna : </label> </br>
							<?php if($sameusername == 1 ){ ?>
							<small class=" red-text mb-4">Nama Pengguna sudah terdaftar !</small> <?php } ?>
						    <input type="text" id="username" class="form-control" placeholder="Nama Pengguna" name="username" value="<?php echo $username4 ?>"
								required pattern="^[A-Za-z0-9_]{1,15}$" title="Nama pengguna hanya dapat terdiri dari huruf, angka, dan max 15 karakter">
							<small class=" mb-4"> * Nama pengguna hanya dapat terdiri dari huruf, angka, dan max 15 karakter</small><br><br>

							<label><span class="red-text">*</span> Password : </label></br>
							<?php if($passwordbetul == 0){ ?>
								<small class=" red-text mb-4">Password yang dimasukan tidak cocok !</small> <?php } ?>
								<input class="form-control mb-4" type="password" name="password" id="password" placeholder="Password" value="<?php echo $password1 ?>"
								required pattern="^[A-Za-z0-9_]{1,15}$" title="Password hanya dapat terdiri dari huruf, angka, dan max 15 karakter">
								<input class="form-control" type="password" name="password2" id="password2" placeholder="Konfirmasi Password" value="<?php echo $password2 ?>"
								required pattern="^[A-Za-z0-9_]{1,15}$" title="Password hanya dapat terdiri dari huruf, angka, dan max 15 karakter">
							<small class="mb-4">* Password hanya dapat terdiri dari huruf, angka, dan max 15 karakter</small><br><br>

							<label><span class="red-text">*</span> Nomor Telepon : </label></br>
							<?php if($samenohp == 1){ ?>
								<small class=" red-text mb-4">Nomor Telepon Sudah Terdaftar di sistem !</small>
							 <?php } ?>
							<input class="form-control mb-4" type="number" name="nohp" id="nohp" placeholder="Nomor telepon" required="" value="<?php echo $nohp ?>">
							
							<label><span class="red-text">*</span> Nama Lengkap : </label>
							<input class="form-control mb-4" type="text" name="namalengkap" id="namalengkap" placeholder="Nama Lengkap" required="" value="<?php echo $namalengkap ?>">
							
							<label><span class="red-text">*</span> Nomor KTP : </label>
							<input class="form-control mb-4" type="number" name="noktp" id="noktp" placeholder="Nomor KTP" required="" value="<?php echo $noktp ?>">
							
							<label><span class="red-text">*</span> Alamat : </label>
							<div>
								<small><span class="red-text">*</span> Geser pin map sesuai alamat</small>
								<div class="mampus">	
									<div class="input-group" id="search">		
										<input type="text" class="form-control" value="" id="addr" placeholder="Cari alamat">
									    <div class="input-group-prepend">
									      <button type="button" class="btn btn-color white m-0 btn-sm z-depth-0" onclick="addr_search();showResult();" style="border-radius: 0 .25rem .25rem 0; z-index: 1">Cari</button>
									    </div>
									</div>
									<div id="results" class="border rounded p-2 grey lighten-4"></div>
									<div class="rounded my-3" id="map" style="z-index: 1"></div>
									<div class="form-group row d-none">
										<div class="col"><input type="text" readonly="" class="form-control" id="lat" name="lat2" value=""></div>
										<div class="col"><input type="text" readonly="" class="form-control" id="lon" name="lng2" value=""></div>
									</div>
									<small><span class="red-text">*</span> Masukan alamat lengkap sesuai KTP</small>
									<textarea id="address" class="form-control mb-3" name="alamat" required=""><?php echo $alamat ?></textarea>
									<?php include('../maps/maps-in-data3.php'); ?>
								</div>
							</div>

							<label>Email : </label>
							<input class="form-control mb-4" type="email" name="email" id="email" placeholder="Email"  value="<?php echo $email ?>">
							<div class="notice mb-4">
								<small>(<span class="red-text">*</span>) Wajib di isi</small>
							</div>
							<button class="btn btn-color white-text btn-block m-0 mb-3 border-0" name='reguser' type="submit">Daftar</button>
						</form>
					    <p>Sudah Punya Akun?
					        <a class="font-color" href="../login">Masuk Sekarang</a>
					    </p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-sm-12" style="background: url(../asset/image/undraw_complete_task_u2c3.svg); background-size: contain; background-repeat: no-repeat;">
			</div>
		</div>
	</div>
</section>
<?php include('../partials/footer.php'); ?>
<?php include('../partials/js.php'); ?>

</body>
</html>

<!-- ////// geoloc -->

<?php 
	}
?>

