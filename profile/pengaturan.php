<?php 
include('../db_con.php');
if (isset($_SESSION['s_user_id']))
{
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pengaturan</title>
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
	<div class="container">
		<div class="row">
			<?php include ('nav-l.php'); ?>
			<div class="col-lg-8 col-sm-12 px-0 px-sm-0 px-md-0 px-lg-3 px-xl-3 mt-3">
<!-- 				<div class="heading">
					<h5 class="font-weight-bold font-color">Pengaturan</h5>
					<hr>
				</div> -->
<!-- ///////////////////////////////// MENU ///////////////////////////////////////////// -->

				<div class="card mb-4">
					<div class="card-header">
						<h5 class="mb-0 font-weight-bold">Menu</h5>
					</div>
					<div class="card-body text-center">
						<div class="row">
							<div class="col-3">
								<a class="black-text active-tab-2" id="buttonprofil" >
									<img id="bprofil" class="mb-2 border rounded p-1 grey lighten-3" width="70" src="https://image.flaticon.com/icons/svg/145/145867.svg">
									<p class="m-0 font-weight-bold">Profil</p>
								</a>
							</div>
							<div class="col-3">
								<a class="black-text active-tab-2" id="buttonakun" href="#">
									<img id="bakun" class="mb-2" width="70" src="https://image.flaticon.com/icons/svg/306/306047.svg">
									<p class="m-0">Akun</p>
								</a>
							</div>
							<div class="col-3">
								<a class="black-text active-tab-2" id="buttonpassword">
									<img id="bpassword" class="mb-2" width="70" src="https://image.flaticon.com/icons/svg/1197/1197500.svg">
									<p class="m-0">Password</p>
								</a>
							</div>
							<div class="col-3">
								<a class="black-text active-tab-2" href="../profile">
									<img class="mb-2" width="70" src="https://image.flaticon.com/icons/svg/1299/1299944.svg">
									<p class="m-0">Kembali</p>
								</a>
							</div>
						</div>
					</div>
				</div>


<!-- ///////////////////////////////// FORM ///////////////////////////////////////////// -->
	<?php 
		$query = "SELECT * FROM akun_user WHERE id_user='$id_user'";
		$results = mysqli_query($db, $query) or die (mysqli_error());
		$data=mysqli_fetch_array($results);

		///////////////////////////////// KTP /////////////////////////////////////////////
		if (isset($_SESSION['errornoktp']))
		{
			$samenoktp = $_SESSION['errornoktp'];
			if ($_SESSION['errornoktp'] == 0)
			{
				$samenoktp = 0;
			}
			elseif($_SESSION['errornoktp'] != 0)
			{
				$samenoktp = 1;
				echo 
				"<script> 
					$(window).on('load', function(){
						alert('Nomor KTP Sudah Terdaftar'); 
					});
				</script>";
			}
		}
		else
		{
			$samenoktp = 0;
		}


		/////////////////////////////////  USERNAME /////////////////////////////////////////////
		if (isset($_SESSION['errorusername']))
		{
			$sameusername = $_SESSION['errorusername'];
			if ($_SESSION['errorusername'] == 0)
			{
				$sameusername = 0;
			}
			elseif($_SESSION['errorusername'] != 0)
			{
				$sameusername = 1;
				echo 
				"<script> 
					$(window).on('load', function(){
						alert('Nama Pengguna Sudah Terdaftar'); 
					});
				</script>";
			}
		}
		else
		{
			$sameusername = 0;
		}

		///////////////////////////////// NOHP /////////////////////////////////////////////
		if (isset($_SESSION['errornohp']))
		{
			$samenohp = $_SESSION['errornohp'];
			if($_SESSION['errornohp'] == 0)
			{
				$samenohp = $_SESSION['errornohp'];
			}
			elseif($_SESSION['errornohp'] != 0)
			{
				$samenohp = 1;
				echo 
				"<script> 
					$(window).on('load', function(){
						alert('Nomor Handphone Sudah Terdaftar'); 
					});
				</script>";
			}
		}
		else
		{
			$samenohp = 0;
		}

		if (isset($_SESSION['passwordbetul']))
		{
			$passwordbetul = $_SESSION['passwordbetul'];
			echo 
			"<script> 
				$(window).on('load', function(){
					alert('Password Tidak Cocok'); 
				});
			</script>";
		}
		else
		{
			$passwordbetul = true;
		}

		if (isset($_SESSION['formerror']) == 1 )
		{
			echo("<script>console.log('PHP: " . "session" . "');</script>");
			$username = $_SESSION['username'];
			$password = $_SESSION['password'];
			$password2 = $_SESSION['password2'];
			$nohp = $_SESSION['nohp'];
			$namalengkap = $_SESSION['namalengkap'];
			$noktp = $_SESSION['noktp'];
			$alamat = $_SESSION['alamat'];
			$lat= $data['lat'];
			$lng=$data['lng'];
			$email = $_SESSION['email'];
		}
		elseif(isset($_SESSION['formerror']) == 0 )
		{
			echo("<script>console.log('PHP: " . "non session" . "');</script>");
			$username = $data['username'];
			$password = null;
			$nohp = $data['no_hp'];
			$namalengkap = $data['nama'];
			$noktp= $data['no_ktp'];
			$lat= $data['lat'];
			$lng=$data['lng'];
			$alamat = $data['alamat'];
			$email = $data['user_email'];
		}

	?>
				<div class="card" id="divprofil" >
					<div class="card-header">
						<h5 class="mb-0 font-weight-bold">Pengaturan Profil</h5>
					</div>
					<div class="card-body">
						<form action="proses_pengaturan.php" method="POST">

							<label><span class="red-text">*</span> Nama Lengkap : </label>
							<input class="form-control mb-4" type="text" name="namalengkap" id="namalengkap" placeholder="Nama Lengkap" required="" value="<?php echo $namalengkap ?>">
							
							<label><span class="red-text">*</span> Nomor KTP : </label> </br>
							<?php if($samenoktp == 1){ ?>
							<small class=" red-text mb-4">Nomor KTP Sudah Terdaftar !</small> <?php } ?>
							<input class="form-control mb-4" type="number" name="noktp" id="noktp" placeholder="Nomor KTP" required="" value="<?php echo $noktp ?>">
							
							<label>Alamat : </label>
							<div>
								<small><span class="red-text">*</span> Geser pin map sesuai alamat</small>
								<div class="mampus">	
									<div class="input-group" id="search">		
										<input type="text" class="form-control" value="" id="addr" placeholder="Cari alamat" required="">
									    <div class="input-group-prepend">
									      <button type="button" class="btn btn-color white m-0 btn-sm z-depth-0" onclick="addr_search();showResult();" style="border-radius: 0 .25rem .25rem 0; z-index: 1">Cari</button>
									    </div>
									</div>
									<div id="results" class="border rounded p-2 grey lighten-4"></div>
									<div class="rounded my-3" id="map" style="z-index: 1"></div>
									<div class="form-group row">
										<div class="col"><input type="text" readonly="" class="form-control" id="lat" name="lat2" value=""></div>
										<div class="col"><input type="text" readonly="" class="form-control" id="lon" name="lng2" value=""></div>
									</div>
									<textarea id="address" class="form-control mb-3" name="alamat" required=""><?php echo $alamat ?></textarea>
									<?php include('../maps/maps-in-data.php'); ?>
								</div>
							</div>

							<div class="notice mb-4">
								<small class="mb-4">(<span class="red-text">*</span>) Wajib di isi</small>
							</div>
						    
							<button class="btn btn-color btn-block" type="submit" name="pengaturanprofil"><i class="fa fa-save"></i>  Simpan Perubahan</button>
						</form>
					</div>
				</div>
				<div class="card" id="divakun" style="display:none;">
					<div class="card-header">
						<h5 class="mb-0 font-weight-bold">Pengaturan Akun</h5>
					</div>
					<div class="card-body">
						<form action="proses_pengaturan.php" method="POST">
							<label><span class="red-text">*</span> Nama Pengguna : </label></br>
							<?php if($sameusername != 0 ){ ?>
							<small class=" red-text mb-4">Nama Pengguna sudah terdaftar !</small> <?php } ?>
							<input type="text" id="username" class="form-control" placeholder="Nama Pengguna" name="username" required="" value="<?php echo $username ?>"
								required pattern="^[A-Za-z0-9_]{1,15}$" title="Nama Pengguna hanya bisa terdiri dari huruf dan angka, serta tanpa spasi">
							<small class="mb-1">* Nama pengguna hanya dapat terdiri dari huruf, angka, dan max 15 karakter</small><br><br>
	
							<label><span class="red-text">*</span> Nomor Telepon : </label> </br>
							<?php if($samenohp != null){ ?>
							<small class=" red-text mb-4">Nomor Telepon Sudah Terdaftar di sistem !</small> <?php } ?>
							<input class="form-control mb-4" type="number" name="nohp" id="nohp" placeholder="Nomor telepon" required="" value="<?php echo $nohp ?>">

							<label>Email : </label>
							<input class="form-control mb-4" type="email" name="email" id="email" placeholder="Email"  value="<?php echo $email ?>">
							
							<div class="notice mb-4">
								<small class="mb-4">(<span class="red-text">*</span>) Wajib di isi</small>
							</div>
							<button class="btn btn-color btn-block" type="submit" name="pengaturanakun"><i class="fa fa-save"></i>  Simpan Perubahan</button>
						</form>
					</div>
				</div>
				<div class="card" id="divpass" style="display:none;">
					<div class="card-header">
						<h5 class="mb-0 font-weight-bold">Pengaturan Password</h5>
					</div>
					<div class="card-body">
						<form action="proses_pengaturan.php" method="POST">
							<label>Password : </label> </br>
							<?php if($passwordbetul == 0){ ?>
							<small class=" red-text mb-4">Password yang dimasukan tidak cocok !</small> <?php } ?>
							<input class="form-control mb-4" type="password" name="password" id="password" placeholder="Password" required="" value="<?php echo $password ?>"
								required pattern="^[A-Za-z0-9_]{1,15}$" title="Password hanya dapat terdiri dari huruf, angka, dan max 15 karakter">
							
							<?php 	if (isset($_SESSION['formerror']) == 0 ){ ?>
								<input class="form-control" type="password" name="password2" id="password2" placeholder="Konfirmasi Password" required="" value="<?php echo $password ?>"
								required pattern="^[A-Za-z0-9_]{1,15}$" title="Password hanya dapat terdiri dari huruf, angka, dan max 15 karakter">
							<?php }
							else { ?>
								<input class="form-control" type="password" name="password2" id="password2" placeholder="Konfirmasi Password" required="" value="<?php echo $password2 ?>"
								required pattern="^[A-Za-z0-9_]{1,15}$" title="Password hanya dapat terdiri dari huruf, angka, dan max 15 karakter">
							<?php } ?>
							<small class="mb-4">* Password hanya dapat terdiri dari huruf, angka, dan max 15 karakter</small><br><br>

							<button class="btn btn-color btn-block" type="submit" name="pengaturanpassword"><i class="fa fa-save"></i>  Simpan Perubahan</button>
						</form>
					</div>
				</div>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////// -->
				
			</div>
		</div>
	</div>
</section>
<?php include('../partials/footer.php'); ?>
<?php include('../partials/js.php'); ?>
</body>
</html>

<?php 
}
else
{
	header('Location:../login/index.php') ;
}
?>

<!-- ///// display hide menu profil, akun, pass -->
<script>

	var buttonpass = document.getElementById('buttonprofil');
	buttonpass.onclick = function()
	{
		var divprofil = document.getElementById('divprofil');
		var divakun = document.getElementById('divakun');
		var divpass = document.getElementById('divpass');

		if (divprofil.style.display == 'none')
		{
			divprofil.style.display = 'block';
			divakun.style.display = 'none';
			divpass.style.display = 'none';

			$('#bprofil').addClass('border rounded p-1 grey lighten-3');
			$('#bpassword').removeClass('border rounded p-1 grey lighten-3');
			$('#bakun').removeClass('border rounded p-1 grey lighten-3');

		}
	}

	var buttonpass = document.getElementById('buttonakun');
	buttonpass.onclick = function()
	{
		var divprofil = document.getElementById('divprofil');
		var divakun = document.getElementById('divakun');
		var divpass = document.getElementById('divpass');

		if (divakun.style.display == 'none')
		{
			divprofil.style.display = 'none';
			divakun.style.display = 'block';
			divpass.style.display = 'none';

			$('#bakun').addClass('border rounded p-1 grey lighten-3');
			$('#bpassword').removeClass('border rounded p-1 grey lighten-3');
			$('#bprofil').removeClass('border rounded p-1 grey lighten-3');

		}
	}

	var buttonpass = document.getElementById('buttonpassword');
	buttonpass.onclick = function()
	{
		var divprofil = document.getElementById('divprofil');
		var divakun = document.getElementById('divakun');
		var divpass = document.getElementById('divpass');

		if (divpass.style.display == 'none')
		{
			divprofil.style.display = 'none';
			divakun.style.display = 'none';
			divpass.style.display = 'block';

			$('#bpassword').addClass('border rounded p-1 grey lighten-3');
			$('#bakun').removeClass('border rounded p-1 grey lighten-3');
			$('#bprofil').removeClass('border rounded p-1 grey lighten-3');
		}
	}

	
	// document.getElementById("profil").addEventListener ("click", menu1, false);
	
</script>
