<?php 
	include('../db_con.php');

	if (isset($_SESSION['s_user_id']))
{
	$id_user = $_SESSION['s_user_id'];
	
	$query2 = "SELECT * FROM log_tabungan WHERE status='sudah_diverifikasi' AND id_user='$id_user'";
	$results2 = mysqli_query($db, $query2) or die (mysqli_error());
	$lenght2=mysqli_num_rows($results2);

	$query3 = "SELECT * FROM log_tabungan WHERE status='belum_diverifikasi' AND id_user='$id_user'";
	$results3 = mysqli_query($db, $query3) or die (mysqli_error());
	$lenght3=mysqli_num_rows($results3);

	//// TOTAL SALDO

	$query = "SELECT * FROM akun_user WHERE id_user='$id_user'";
	$results = mysqli_query($db, $query) or die (mysqli_error());
	$data=mysqli_fetch_array($results);
	$totaltabungan= $data['saldo']; 
	// $query4 = "SELECT SUM(`jumlah_transaksi_beras`) as total FROM log_tabungan WHERE status='sudah_diverifikasi' AND id_user='$id_user'";
	// $results4 = mysqli_query($db, $query4) or die (mysqli_error());
	// $row4=mysqli_fetch_array($results4);
	// $totaltabungan = round($row4['total'], 2);

	//////////////////////  char dot dot 
	if (strpos($totaltabungan, '.') !== false) {
		$b=strstr($totaltabungan, '.', true);
		$removecoma = str_replace('.', '', $b );
		$takedecimal =  substr($totaltabungan, strpos($totaltabungan, ".") + 1); 
	}
	else
	{
		$removecoma = $totaltabungan;
		$takedecimal = null;
	}
	$hasil_rupiah = number_format($removecoma,0,'','.');
	if (strpos($totaltabungan, '.') !== false) {
		$finaltotalsaldo=$hasil_rupiah.",".$takedecimal;
	}
	else
	{
		$finaltotalsaldo=$hasil_rupiah;
	}

?>

<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="../partials/jquery-3.2.1.min.js"></script>
	<title>Profile</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="icon" href="favicon/favicon.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon"/>
	<meta name="theme-color" content="#4AB616">
	<?php include('../partials/css.php'); ?>
</head>
<style>
	.xt
	{
		background:none;
		border:none;
	}
	.xt:focus
	{
		outline:0;
	}
	#sedekahhead, #tabunganhead 
	{
		background-color: #4AB616!important;
	}
	.fa-check, .exit, .exit:hover
	{
		color: #4AB616!important;
		border-color: #4AB616!important;
	}

	.exit2, .exit2:hover
	{
		background-color: #4AB616!important;
	}

</style>
<body>
<?php if(isset($_SESSION['sedekah'])==1)
	{
		echo 
		"<script> 
			$(window).on('load', function(){
				$('#sedekah').modal('toggle')
			});
		</script>";
		unset($_SESSION['sedekah']);
	}
	if(isset($_SESSION['tabungan'])==1)
	{
		echo 
		"<script> 
			$(window).on('load', function(){
				$('#tabungan').modal('toggle')
			});
		</script>";

		unset($_SESSION['tabungan']);
	}
	if(isset($_SESSION['penarikan'])==1)
	{
		echo 
		"<script> 
			$(window).on('load', function(){
				$('#penarikan').modal('toggle')
			});
		</script>";

		unset($_SESSION['penarikan']);
	}
?>


<?php include('../partials/navbar.php'); ?>
<section>
	<div class="container">
		<div class="row">		
			<?php include('nav-l.php'); ?>						
			<div class="col-lg-8 col-sm-12 px-0 px-sm-0 px-md-0 px-lg-3 px-xl-3 mt-3">

<!-- ///////////////////////////////// RINCIAN ///////////////////////////////// -->
				<div class="card mb-4">
					<div class="card-header">
						<h5 class="mb-0 font-weight-bold">Saldo Beras</h5>
					</div>

					<div class="card-body">
						<div class="media">
						  <img class="d-flex mr-3" width="70" src="https://image.flaticon.com/icons/svg/306/306670.svg" alt="Generic placeholder image" style="align-self: center;">
						  <div class="media-body">
						    <h1 class="font-color font-weight-bold"><?php echo $finaltotalsaldo ?> Kg</h1>
						    <span>Saldo beras di peroleh pada saat kamu menabung beras maupun uang.</span>
						  </div>
						</div>
					</div>
				</div>
				<div class="card mb-4">
					<div class="card-header">
						<h5 class="mb-0 font-weight-bold">Menu</h5>
					</div>
					<div class="card-body text-center">
						<div class="row mb-4">
							<div class="col-4">
								<a class="black-text active-tab-2" href="../tabungan/beras">
									<img class="mb-2" width="70" src="https://image.flaticon.com/icons/svg/306/306670.svg">
									<p>Tabungan Beras</p>
								</a>
							</div>
							<div class="col-4">
								<a class="black-text active-tab-2" href="../tabungan/uang">
									<img class="mb-2" width="70" src="https://image.flaticon.com/icons/svg/1138/1138548.svg">
									<p>Tabungan Uang</p>
								</a>
							</div>
							<div class="col-4">
								<a class="black-text active-tab-2" href="../sedekah/beras">
									<img class="mb-2" width="70" src="https://image.flaticon.com/icons/svg/1530/1530847.svg">
									<p>Sedekah</p>
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-4">
								<a class="black-text active-tab-2" href="riwayat_tabungan">
									<img class="mb-2" width="70" src="https://image.flaticon.com/icons/svg/1634/1634836.svg">
									<p>Riwayat Tabungan</p>
								</a>
							</div>
							<div class="col-4">
								<a class="black-text active-tab-2" href="riwayat_penarikan">
									<img class="mb-2" width="70" src="https://image.flaticon.com/icons/svg/1634/1634836.svg">
									<p>Riwayat Penarikan</p>
								</a>
							</div>
							<div class="col-4">
								<a class="black-text active-tab-2" href="riwayat_sedekah">
									<img class="mb-2" width="70" src="https://image.flaticon.com/icons/svg/1634/1634836.svg">
									<p>Riwayat Sedekah</p>
								</a>
							</div>
						</div>
					</div>
				</div>
<!-- ///////////////////////////////// PENGATURAN ///////////////////////////////// -->
				<div class="card">
					<div class="card-header">
						<h5 class="mb-0 font-weight-bold">Pengaturan</h5>
					</div>
					<div class="card-body">
						<a data-toggle="modal" data-target="#modalpengaturan" class="active-tab-2">
							<div class="media">
							  <img class="d-flex mr-3" width="70" src="https://image.flaticon.com/icons/svg/1632/1632619.svg" alt="Generic placeholder image" style="align-self: center;">
							  <div class="media-body">
							    <h5 class="mt-0 font-weight-bold font-color">Pengaturan</h5>
							    <span class="black-text">Anda dapat mengakses pengaturan email, nama, alamat, password.</span>
							  </div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /////////////////////// Modal Logout /////////////////////////////// -->
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
						<button type="button" class="btn btn-color" data-dismiss="modal">Batal</button>
						<button type="button" href="../login/logout.php" class="btn btn-danger">Keluar</button>
					</div>
				</div>
			</div>
		</div>
<!-- /////////////////////// Modal Pengaturan /////////////////////////////// -->
		<div class="modal fade" id="modalpengaturan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header " >
						<h5 class="modal-title" id="exampleModalLabel">Verifikasi</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form name="open_file" id="pengaturan" action="" method="POST" onsubmit="return validate();">
					<div class="modal-body">		
						<span>Untuk melakukan perubahan data diri, silahkan masukan password akun ini</span><br><br>
							<label>Password : </label>
							<input class="form-control mb-4" type="password" name="password" id="password" placeholder="Password">
							<?php if(isset($eerror)==1) { 
								?>
							<small class="red-text mb-4">Nama pengguna hanya dapat terdiri dari huruf, angka, dan max 15 karakter</small>
							<?php } ?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-color" data-dismiss="modal">Batal</button>
						<button type="submit" name="submitx" class="btn btn-danger">Masuk</button>
					</div>
					</form>
					<?php 
						if(isset($_POST['submitx']))
						{
							$id_user = $_SESSION['s_user_id'];

							$query0="SELECT * FROM `akun_user` WHERE id_user='$id_user' ";
							$sql0=mysqli_query($db, $query0) or die (mysqli_error());
							$data=mysqli_fetch_array($sql0);

							$pass = $_POST['password'];
							$pasmd5 = md5($pass);
							$passuser = $data['password'];
							if($pasmd5 == $passuser)
							{
								if(isset($_SESSION['formerror']))
								{
									unset($_SESSION['formerror']);
								};
								if(isset($_SESSION['errornoktp']))
								{
									unset($_SESSION['errornoktp']);
								};
								if(isset($_SESSION['errorusername']))
								{
									unset($_SESSION['errorusername']);
								};
								if(isset($_SESSION['errornohp']))
								{
									unset($_SESSION['errornohp']);
								};
								if(isset($_SESSION['passwordbetul']))
								{
									unset($_SESSION['passwordbetul']);
								};
								echo "<script>window.location.href='pengaturan.php';</script>";
								
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
	
<!-- /////////////////////// Modal Sukses Menabung /////////////////////////////// -->
	<div class="modal fade" id="tabungan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-notify modal-success" role="document">
			<!--Content-->
			<div class="modal-content">
				<!--Header-->
				<div class="modal-header" id="tabunganhead">
					<p class="heading lead">Tabungan</p>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="white-text">&times;</span>
					</button>
				</div>
				<!--Body-->
				<div class="modal-body">
					<div class="text-center">
						<i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
						<p>Berhasil Menabung</p>
						<p>Silahkan tunggu untuk admin melakukan verifikasi</p>
					</div>
				</div>
				<!--Footer-->
				<div class="modal-footer justify-content-center">
					<a class="btn btn-success exit2" href="riwayat_tabungan" ><i class="far fa-clock"></i> Riwayat Tabungan</a>
					<a class="btn btn-outline-success waves-effect exit" data-dismiss="modal">Keluar</a>
				</div>
			</div>
			<!--/.Content-->
		</div>
	</div>

<!-- /////////////////////// Modal Sukses Sedekah /////////////////////////////// -->
	<div class="modal fade" id="sedekah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-notify modal-success" role="document">
			<!--Content-->
			<div class="modal-content">
				<!--Header-->
				<div class="modal-header" id="sedekahhead">
					<p class="heading lead">Sedekah</p>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="white-text">&times;</span>
					</button>
				</div>
				<!--Body-->
				<div class="modal-body">
					<div class="text-center">
						<i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
						<p>Berhasil bersedekah</p>
						<p>Silahkan tunggu untuk admin melakukan verifikasi</p>
					</div>
				</div>
				<!--Footer-->
				<div class="modal-footer justify-content-center">
					<a class="btn btn-success exit2" href="riwayat_sedekah" ><i class="far fa-clock"></i> Riwayat Sedekah</a>
					<a class="btn btn-outline-success waves-effect exit" data-dismiss="modal">Keluar</a>
				</div>
			</div>
			<!--/.Content-->
		</div>
	</div>
	<!-- Central Modal Medium Success-->

<!-- /////////////////////// Modal Sukses Penarikan /////////////////////////////// -->
	<div class="modal fade" id="penarikan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-notify modal-success" role="document">
			<!--Content-->
			<div class="modal-content">
				<!--Header-->
				<div class="modal-header" id="sedekahhead">
					<p class="heading lead">Penarikan</p>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="white-text">&times;</span>
					</button>
				</div>
				<!--Body-->
				<div class="modal-body">
					<div class="text-center">
						<i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
						<p>Berhasil melakukan permintaan penarikan</p>
						<p>Silahkan tunggu untuk admin melakukan verifikasi</p>
					</div>
				</div>
				<!--Footer-->
				<div class="modal-footer justify-content-center">
					<a class="btn btn-color exit2" href="riwayat_penarikan" ><i class="far fa-clock"></i> Riwayat Penarikan</a>
					<a class="btn btn-outline-success waves-effect exit" data-dismiss="modal">Keluar</a>
				</div>
			</div>
			<!--/.Content-->
		</div>
	</div>
<!-- Central Modal Medium Success-->


<?php include('../partials/footer.php'); ?>
<?php include('../partials/js.php'); ?>
<script>
	if (isset($_POST["tutupriwayat"])){
		unset($_POST['riwayattransaksi']);
	}
</script>

</body>
</html>

<?php 
}
else
{
	header('Location:../login/index.php') ;
}
?>
