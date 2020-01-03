<?php 
include('../db_con.php');
if (isset($_SESSION['s_admin_id']))
{
	$id_admin=$_SESSION['s_admin_id'];
	//////////  Get Data Admin
	$query = "SELECT * FROM akun_admin WHERE id_admin='$id_admin'";
	$results = mysqli_query($db, $query) or die (mysqli_error());
	$data=mysqli_fetch_array($results);
	$norek=$data['nomor_rekening'];
	$bank=$data['bank'];
	$pemilik_rek=$data['pemilik_rekening'];

	//////////  hitung total user
	$query2 = "SELECT * FROM akun_user";
	$results2 = mysqli_query($db, $query2) or die (mysqli_error());
	$lenght=mysqli_num_rows($results2);


	$query3 = "SELECT * FROM log_tabungan WHERE status='belum_diverifikasi'";
	$results3 = mysqli_query($db, $query3) or die (mysqli_error());
	$lenght2=mysqli_num_rows($results3);


	$query4 = "SELECT * FROM log_sedekah WHERE status='belum_diverifikasi'";
	$results4 = mysqli_query($db, $query4) or die (mysqli_error());
	$lenght4=mysqli_num_rows($results4);


	$query5 = "SELECT harga_beras FROM harga_beras WHERE id=1";
	$results5 = mysqli_query($db, $query5) or die (mysqli_error());
	$data5=mysqli_fetch_array($results5);
	$hargaberasx=$data5['harga_beras'];

	function harga($hargaberasx){
		$hasil_rupiah = number_format($hargaberasx,0,'','.');
		return $hasil_rupiah;
	};

	$hargaberas= harga($hargaberasx);


?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
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
<body id="page-top">
<div id="wrapper">
    <ul class="navbar-nav sidebar sidebar-dark accordion background-color-1" id="accordionSidebar">
      <?php include('partials/logo-nav.php'); ?>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
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
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#modalpengaturanadmin">
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

            <li class="nav-item"><h4 class="nav-link font-weight-bold font-color m-0">Dashboard</h4></li>

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

                <a class="dropdown-item" data-toggle="modal" data-target="#modalpengaturanadmin">

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
        	<section>
				<div class="row">
					<div class="col-lg-8 col-sm-12">
						<div class="card-body">
							<div class="media">
							  <img class="d-flex mr-3" width="55" src="https://image.flaticon.com/icons/svg/2206/2206248.svg" alt="Generic placeholder image">
							  <div class="media-body">
							    <h5 class="mt-0 font-weight-bold">Halo! Selamat Pagi Admin.</h5>
							    <span>Rejeki bukan hanya berupa uang, tetapi juga umur yang panjang. Nikmatilah kesehatan yang dikelilingi oleh kebaikan dan kedamaian.</span>
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
				<div class="card z-depth-0 mt-3">
					<div class="card-header border-0 rounded m-0">
						<div class="heading text-muted">
							<i class="fas fa-cogs d-inline"></i>
							<h5 class="font-weight-bold d-inline">Pengaturan</h5>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-6 col-md-12">
								<div class="row mb-3">
									<div class="col-lg-4 col-md-12">
										<img class="img-fluid" src="../asset/image/undraw_finance_0bdk.svg">
									</div>
									<div class="col-lg-8 col-md-12">
										<div class="media-body">
											<h5 class="mt-0 font-weight-bold">Harga Beras</h5>
											<span>Harga beras berdasarkan <a href="https://hargapangan.id/" target="_blank" class="font-color font-weight-bold">hargapangan.id</a></span><br>
											<span>Harga sekarang adalah :</span>
											<h1><?php echo $hargaberas; ?> / Kg</h1>
											<a class="btn btn-color m-0" data-toggle="modal" data-target="#modalhargaberas<?php echo $hargaberasx ?>" >Update Harga Beras</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-12">
								<div class="row mb-3">
									<div class="col-lg-4 col-md-12">
										<img class="img-fluid" src="../asset/image/undraw_wallet_aym5.svg">
									</div>
									<div class="col-lg-8 col-md-12">
										<div class="media-body">
											<h5 class="mt-0 font-weight-bold">Nomor Rekening</h5>
											<p class="m-0"><span class="font-weight-bold">Bank : </span><?php echo $bank ?></p>
											<p class="m-0"><span class="font-weight-bold">Nomor Rekening : </span><?php echo $norek ?></p>
											<p class="m-0"><span class="font-weight-bold">Pemilik : </span>an. <?php echo $pemilik_rek ?></p>
											<div class="input-group mb-4">
		<!-- 											<div class="input-group-prepend">
														<span class="input-group-text" style="text-transform: uppercase;"><?php //echo $bank ?></span>
													</div>
													<input type="text" readonly="" min="0" id="norek" name="norek" class="form-control" value="<?php //echo $norek ?>"  required="">
													<div class="input-group-append">
														<span class="input-group-text">an. <?php //echo $pemilik_rek ?></span>
													</div> -->
												</div>
												<?php
													$pr = str_replace(' ', '_', $pemilik_rek );
												?>
											<a class="btn btn-color m-0" data-toggle="modal" data-target="#modalnomorrekening<?php echo $bank, $norek, $pr ?>" >Update Nomor Rekening</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card z-depth-0">
					<div class="card-header border-0 rounded m-0">
						<div class="heading text-muted">
							<i class="fa fa-tasks d-inline"></i>
							<h5 class="font-weight-bold d-inline">Pekerjaan</h5>
						</div>
					</div>
					<div class="card-body">
		        		<div class="row">
		        			<div class="col-lg-4 col-sm-12">
								<a class="banner" href="notifikasi">
		        				<div class="card my-2">
		        					<div class="card-body p-0">
										<div class="media">
										  <div class="p-4 rounded" style="background-color: #00cec9">
										  	<i class="fa fa-bell d-flex text-white hover-image" style="font-size: 4rem;"></i>
										  </div>
										  <div class="media-body p-3 text-muted text-center">
										    <h5 class="mt-0 font-weight-bold">Notifikasi</h5>
										    <h1 class="m-0 font-weight-bold"><?php echo $lenght2 ?></h1>
										  </div>
										</div>
									</div>
								</div>
								</a>
		        			</div>
		        			<div class="col-lg-4 col-sm-12">
								<a class="banner" href="pengguna">
		        				<div class="card my-2">
		        					<div class="card-body p-0">
										<div class="media">
										  <div class="p-4 rounded" style="background-color: #FFCB5A">
										  	<i class="fa fa-user d-flex text-white hover-image" style="font-size: 4rem;"></i>
										  </div>
										  <div class="media-body p-3 text-muted text-center">
										    <h5 class="mt-0 font-weight-bold">Pengguna</h5>
										    <h1 class="m-0 font-weight-bold"><?php echo $lenght ?></h1>
										  </div>
										</div>
									</div>
								</div>
								</a>	
		        			</div>
		        			<div class="col-lg-4 col-sm-12">
								<a class="banner" href="sedekah">
		        				<div class="card my-2">
		        					<div class="card-body p-0">
										<div class="media">
										  <div class="p-4 rounded" style="background-color: #ff7675">
										  	<i class="fas fa-donate d-flex text-white hover-image" style="font-size: 4rem;"></i>
										  </div>
										  <div class="media-body p-3 text-muted text-center">
										    <h5 class="mt-0 font-weight-bold">Sedekah</h5>
										    <h1 class="m-0 font-weight-bold"><?php echo $lenght4 ?></h1>
										  </div>
										</div>
									</div>
								</div>
								</a>	
		        			</div>
		        		</div>
		        	</div>
		        </div>
        	</section>
        	<section>
				<div class="card z-depth-0">
					<div class="card-header border-0 rounded m-0">
						<div class="heading text-muted">
							<i class="fa fa-user d-inline"></i>
							<h5 class="font-weight-bold d-inline">Opsi</h5>
						</div>
					</div>
					<div class="card-body">
			        	<div class="row">
			        		<div class="col-lg-6 col-sm-12">
			        			<div class="card my-2">
			        				<div class="card-header">
			        					<span class="m-0">Cuaca</span>
			        				</div>
			        				<div class="card-body">
										<div class="media">
										  <img class="d-flex mr-3" width="100" src="https://image.flaticon.com/icons/svg/1146/1146860.svg" alt="Generic placeholder image">
										  <div class="media-body">
										    <h5 class="mt-0 font-weight-bold font-color">Hujan di sertai petir</h5>
										    <span>20&deg;C Sebelum berangkat kerja, kamu harus sudah menyiapkan jas hujan dan payung.</span>
										  </div>
										</div>
			        				</div>
			        			</div>
			        		</div>
			        		<div class="col-lg-6 col-sm-12">
			        			<div class="card my-2">
			        				<div class="card-header">
			        					<span class="m-0">Pengaturan</span>
			        				</div>
			        				<div class="card-body">
			        					<a data-toggle="modal" data-target="#modalpengaturanadmin" class="active-tab-2" >
											<div class="media">
											  <img class="d-flex mr-3" width="100" src="https://image.flaticon.com/icons/svg/1632/1632619.svg" alt="Generic placeholder image">
											  <div class="media-body">
											    <h5 class="mt-0 font-weight-bold font-color">Pegaturan Akun</h5>
											    <span class="black-text">Anda dapat mengakses pengaturan email, nama, alamat, password.</span>
											  </div>
											</div>
										</a>
			        				</div>
			        			</div>
			        		</div>
			        	</div>
			        </div>
			    </div>
	        </section>
        </div>
      	<?php include('partials/footer.php') ?>
    </div>

	

<!-- /////////////////////// Modal Pengaturan /////////////////////////////// -->

	<div class="modal fade" id="modalpengaturanadmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header " >
					<h5 class="modal-title" id="exampleModalLabel">Verifikasi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form name="open_file" action="" method="POST" onsubmit="return validate();">
				<div class="modal-body">		
					<span>Untuk melakukan perubahan data diri, silahkan masukan password akun ini</span><br><br>
						<label>Password : </label>
						<input class="form-control mb-4" type="password" name="password" id="password" placeholder="Password" required="">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-color" data-dismiss="modal">Batal</button>
					<input type="submit" name="submit" class="btn btn-danger">
				</div>
				</form>
				<?php 
					if(isset($_POST['submit']))
					{
						$pass = md5($_POST['password']);
						$passuser = $data['password'];

						if($pass == $passuser)
						{
							echo "<script>window.location.href='profil.php';</script>";	
						}
						else
						{
							echo "<script type='text/javascript'> $(document).ready(function() { $('#modalpengaturan').modal('show') }) </script>";
							echo 
							"<script> 
								$(window).on('load', function(){
									alert('Password yang anda masukan salah'); 
								});
							</script>";
						}				
					}
				?>
			</div>
		</div>
	</div>

<!-- /////////////////////// Modal Harga Beras /////////////////////////////// -->

	<div class="modal fade" id="modalhargaberas<?php echo $hargaberasx ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header " >
					<h5 class="modal-title" id="exampleModalLabel">Update Harga Beras</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form name="open_file" action="" method="POST" onsubmit="return validate();">
				<div class="modal-body">		
						<label>Masukan harga beras : </label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Rp.</span>
							</div>
							<input class="form-control" type="text" name="hargaberas" id="hargaberas" value="<?php echo $hargaberasx;?>" required="">
							<div class="input-group-append">
								<span class="input-group-text">/Kg</span>
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-color" data-dismiss="modal">Batal</button>
					<input type="submit" name="submitx" value="update" class="btn btn-danger">
				</div>
				</form>
				<?php 

					if(isset($_POST['submitx']))
					{
						$hargabaru = $_POST['hargaberas'];
						$b = str_replace('.', '', $hargabaru );
						$sql2="UPDATE harga_beras SET harga_beras='$b' WHERE id=1";
						$query2=mysqli_query($db,$sql2) or die (mysqli_error($db));
						if ($query2) 
						{
							echo 
							"<script>
								location.replace('index.php');
							</script>";							
						}
					}
				?>
			</div>
		</div>
	</div>

<!-- /////////////////////// Modal Update no rek /////////////////////////////// -->

<div class="modal fade" id="modalnomorrekening<?php echo $bank, $norek, $pr ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header " >
					<h5 class="modal-title" id="exampleModalLabel">Update Nomor Rekening</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php
					$prx = str_replace('_', ' ', $pr );
				?>
				<form name="open_file" action="" method="POST" onsubmit="return validate();">
				<div class="modal-body">		
							<label>Bank : </label>
							<input class="form-control mb-4" type="text" name="bank" value="<?php echo $bank;?>" required="">
							<label>Nomor Rekening : </label>
							<input class="form-control mb-4" type="text" name="norek" value="<?php echo $norek;?>" required="">
							<label>Terdaftar atas nama : </label>
							<input class="form-control mb-2" type="text" name="prx" value="<?php echo $prx;?>" required="">
				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-color" data-dismiss="modal">Batal</button>
					<input type="submit" name="submitxy" value="update" class="btn btn-danger">
				</div>
				</form>
				<?php 

					if(isset($_POST['submitxy']))
					{
						$norekx = $_POST['norek'];
						$bankx = $_POST['bank'];
						$prxx = $_POST['prx'];
						
						$sql3="UPDATE akun_admin 
						SET nomor_rekening='$norekx', bank='$bankx', pemilik_rekening='$prxx' 
						WHERE id_admin='$id_admin'";

						$query3=mysqli_query($db,$sql3) or die (mysqli_error($db));
						if ($query3) 
						{
							echo 
							"<script>
								location.replace('index.php');
							</script>";							
						}
						else
						{

						}
					}
				?>
			</div>
		</div>
	</div>



<?php include('../partials/js.php'); ?>
<script src="../asset/js/javascript.js"></script>
</body>
</html>

<Script>

	var rupiah = document.getElementById("hargaberas");
	rupiah.addEventListener("keyup", function(e) {
	// tambahkan 'Rp.' pada saat form di ketik
	// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
	rupiah.value = formatRupiah(this.value, "Rp. ");
	});

	/* Fungsi formatRupiah */
	function formatRupiah(angka, prefix) {
	var number_string = angka.replace(/[^,\d]/g, "").toString(),
		split = number_string.split(","),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if (ribuan) {
		separator = sisa ? "." : "";
		rupiah += separator + ribuan.join(".");
	}

	rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
	return prefix == undefined ? rupiah : rupiah ? rupiah : "";
	}

</script>


<?php 
}
else
{
	header('Location:../login/index.php') ;
}
?>