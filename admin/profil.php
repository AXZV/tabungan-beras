<?php
include('../db_con.php');


if (isset($_SESSION['s_admin_id']))
{
	echo("<script>console.log('s_admin_id: " . $_SESSION['s_admin_id'] . "');</script>");
	$id_admin=$_SESSION['s_admin_id'];

$query = "SELECT * FROM akun_admin WHERE id_admin='$id_admin'";
$results = mysqli_query($db, $query) or die (mysqli_error());
$data=mysqli_fetch_array($results);


  echo("<script>console.log('PHP: " . "non session" . "');</script>");
  $username = $data['username'];
  // $password = $data['password'];
  $nohp = $data['no_hp'];
  $namalengkap = $data['nama'];
  $email = $data['email'];


?>


<!DOCTYPE html>
<html>
<head>
	<title>Pengaturan Profil</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="icon" href="favicon/favicon.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon"/>
	<meta name="theme-color" content="#4AB616">
	<?php include('../partials/css.php'); ?>
	<link rel="stylesheet" type="text/css" href="../asset/css/admin.css">
  <script type="text/javascript" src="../partials/jquery-3.2.1.min.js"></script>
</head>
<body>
<?php
  if(isset($_GET['p']))
  {
    echo 
    "<script> 
      $(window).on('load', function(){
        alert('Password yang anda masukan tidak cocok'); 
      });
    </script>";
  }
?>
<div id="wrapper">
    <ul class="navbar-nav sidebar sidebar-dark accordion background-color-1" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index">
        <div class="sidebar-brand-icon">
          <i class="fas fa-balance-scale" style="font-size: 1.5rem"></i>
        </div>
        <div class="sidebar-brand-text mx-3" style="font-family: 'Righteous', cursive; letter-spacing: 3px; text-transform: none; font-size: 1.2rem">Tabungan</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link" href="index">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Menu
      </div>
      <li class="nav-item">
        <a class="nav-link" href="notifikasi">
          <i class="fa fa-bell"></i>
          <span>Notifikasi</span></a>
      </li>
			<li class="nav-item">
        <a class="nav-link" href="penarikan">
					<i class="fab fa-get-pocket"></i>
          <span>Penarikan</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pengguna">
          <i class="fa fa-user"></i>
          <span>Pengguna</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sedekah">
          <i class="fas fa-donate"></i>
          <span>Sedekah</span></a>
      </li>
      <hr class="sidebar-divider d-none d-md-block">
      <div class="sidebar-heading">
        Akun
      </div>
      <li class="nav-item active">
        <a class="nav-link" href="profil">
          <i class="fa fa-cogs"></i>
          <span>Pengaturan</span></a>
      </li>
      <hr class="sidebar-divider d-none d-md-block">
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column" style="background-color: #fff">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3 p-0">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav">
            <li class="nav-item"><h4 class="nav-link font-weight-bold font-color m-0">Pengaturan</h4></li>
          </ul>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                <img width="25" class="rounded-circle border" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXXmBvHF1K3QQ0cbaznD0yfSqNizuv3rOrcQKW43gWgQ8ujiyg'); background-size: cover; background-repeat: no-repeat; background-position: center;">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profil">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Pengaturan Akun
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Keluar
                </a>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
        	<section class="mb-4">
				<div class="row">
					<div class="col-lg-8 col-sm-12">
						<div class="card-body">
							<div class="media">
							  <img class="d-flex mr-3" width="55" src="https://image.flaticon.com/icons/svg/2206/2206248.svg" alt="Generic placeholder image">
							  <div class="media-body">
							    <h5 class="mt-0 font-weight-bold">Halo! Selamat Pagi Admin.</h5>
							    <span>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. amet nibh libero, in gravida nulla.</span>
							  </div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-sm-12">
		              <div class="card background-color-1">
		                <div class="card-body">
		                  <div class="text-center">
		                    <span class='time text-white' id='time'></span>
		                  </div>
		                </div>
		              </div>
					</div>
				</div>
				<hr>
        	</section>
        	<section>
				<div class="card mb-4">
					<div class="card-header">
						<h5 class="mb-0 font-weight-bold">Menu</h5>
					</div>
					<div class="card-body text-center">
						<div class="row">
							<div class="col-3">
								<a class="black-text active-tab-2" id="buttonprofil">
									<img id="bprofil" class="mb-2 border rounded p-1 grey lighten-3" width="70" src="https://image.flaticon.com/icons/svg/145/145867.svg">
									<p class="m-0 font-weight-bold">Profil</p>
								</a>
							</div>
							<div class="col-3">
								<a class="black-text active-tab-2" id="buttonakun">
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
								<a class="black-text active-tab-2" href="index">
									<img class="mb-2" width="70" src="https://image.flaticon.com/icons/svg/1299/1299944.svg">
									<p class="m-0">Kembali</p>
								</a>
							</div>
						</div>
					</div>
				</div>


    			<div class="card"  id="divprofil">
					<div class="card-header">
						<h5 class="mb-0 font-weight-bold">Pengaturan Profil</h5>
					</div>
    				<div class="card-body">
						<form action="prosespengaturan.php" method="POST">
                <label>Nama Lengkap : </label>   </br>
						    <input type="text" class="form-control mb-4" name="nama" placeholder="Nama" value="<?php echo $namalengkap; ?>">
                <label>Nomor Telepon : </label> </br>
                <input type="number" class="form-control mb-4" name="nohp" placeholder="No.Telepon" value="<?php echo $nohp; ?>">
						    <button class="btn btn-color btn-block m-0" name="pengaturanprofil" type="submit"><i class="fa fa-save"></i> Simpan</button>
						</form>
    				</div>
    			</div>

          <!-- //////////////////// -->

          <div class="card"  id="divakun"  style="display:none;">
					<div class="card-header">
						<h5 class="mb-0 font-weight-bold">Pengaturan Akun</h5>
					</div>
    				<div class="card-body">
						<form action="prosespengaturan.php" method="POST">
                <label> Nama Pengguna : </label> </br>
						    <input type="text" class="form-control mb-2" name="username" placeholder="Nama Pengguna" value="<?php echo $username; ?>"
                required pattern="^[A-Za-z0-9_]{1,15}$" title="Nama Pengguna hanya bisa terdiri dari huruf dan angka, serta tanpa spasi">
						    <small class="mb-1">* Nama pengguna hanya dapat terdiri dari huruf, angka, dan max 15 karakter</small><br><br>
                <label>Email : </label>
                <input type="email" class="form-control mb-4" name="email" placeholder="Email" value="<?php echo $email; ?>">
						    <button class="btn btn-color btn-block m-0" name="pengaturanakun" type="submit"><i class="fa fa-save"></i> Simpan</button>
						</form>
    				</div>
    			</div>

          <!-- //////////////////// -->

          <div class="card" id="divpass"  style="display:none;">
					<div class="card-header">
						<h5 class="mb-0 font-weight-bold">Pengaturan Password</h5>
					</div>
    				<div class="card-body">
						<form action="prosespengaturan.php" method="POST">
                <label>Password : </label> </br>
						    <input type="password" name="password" class="form-control mb-4" placeholder="Password Baru"
                required pattern="^[A-Za-z0-9_]{1,15}$" title="Password hanya dapat terdiri dari huruf, angka, dan max 15 karakter">
                <label>Kofirmasi Password : </label> </br>
						    <input type="password" name="password2" class="form-control mb-2" placeholder="Konfirmasi Password Baru"
						    required pattern="^[A-Za-z0-9_]{1,15}$" title="Password hanya dapat terdiri dari huruf, angka, dan max 15 karakter">
                <small class="mb-4">* Password hanya dapat terdiri dari huruf, angka, dan max 15 karakter</small><br><br>
                <button class="btn btn-color btn-block m-0" name="pengaturanpassword" type="submit"><i class="fa fa-save"></i> Simpan</button>
						</form>
    				</div>
    			</div>

	        </section>
        </div>
        <?php include('partials/footer.php'); ?>
    </div>
  
<?php include('../partials/js.php'); ?>
<script src="../asset/js/javascript.js"></script>
</body>
</html>

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
			$('#bprofil').removeClass('border rounded p-1 grey lighten-3');
			$('#bakun').removeClass('border rounded p-1 grey lighten-3');

		}
	}

	
	// document.getElementById("profil").addEventListener ("click", menu1, false);
	
</script>


<?php 
}
else
{
	header('Location:../login/index.php') ;
}
?>