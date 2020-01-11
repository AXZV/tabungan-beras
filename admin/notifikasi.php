<?php

	include('../db_con.php');

if (isset($_SESSION['s_admin_id']))

{
	$id_admin=$_SESSION['s_admin_id'];
	$query0 = "SELECT * FROM akun_admin WHERE id_admin='$id_admin'";
	$results0 = mysqli_query($db, $query0) or die (mysqli_error());
	$data=mysqli_fetch_array($results0);

	$query10 = "SELECT * FROM log_tabungan WHERE status='belum_diverifikasi' ORDER BY id DESC";
	$results10 = mysqli_query($db, $query10) or die (mysqli_error());
	$lenght10=mysqli_num_rows($results10);

	$query11 = "SELECT * FROM log_tabungan WHERE status='belum_diverifikasi' ORDER BY id DESC";
	$results11 = mysqli_query($db, $query11) or die (mysqli_error());
	$lenght111=mysqli_num_rows($results11);


	$query2 = "SELECT * FROM log_tabungan WHERE status='sudah_diverifikasi' ORDER BY id DESC";
	$results2 = mysqli_query($db, $query2) or die (mysqli_error());
	$lenght2=mysqli_num_rows($results2);

	$query21 = "SELECT * FROM log_tabungan WHERE status='sudah_diverifikasi' ORDER BY id DESC";
	$results21 = mysqli_query($db, $query21) or die (mysqli_error());
	$lenght21=mysqli_num_rows($results21);

	$query3 = "SELECT SUM(`jumlah_transaksi_beras`) as total FROM log_tabungan WHERE status='sudah_diverifikasi'";
	$results3 = mysqli_query($db, $query3) or die (mysqli_error());
	$row3=mysqli_fetch_array($results3);
	$totaltabungan = round($row3['total'], 2);

	include '../function/fungsi.php';
	$konversi = new konversi;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Notifikasi</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="icon" href="favicon/favicon.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon"/>
	<meta name="theme-color" content="#4AB616">
	<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
	<?php include('../partials/css.php'); ?>
	<link rel="stylesheet" type="text/css" href="../asset/css/admin.css">
	<script type="text/javascript" src="../partials/jquery-3.2.1.min.js"></script>
	<script>
		$(document).ready(function() {
				$('#redx').DataTable();
		} );

		$(document).ready(function() {
				$('#redx2').DataTable();
		} );
	</script>
</head>

<Style>

	.value {
	border: 4px dashed #bdc3c7;
	text-align: center;
	/* font-weight: bold; */
	font-size: 5em;
	width: 300px; 
	height: 120px;
	line-height: 100px;
	margin: 0 auto;
	letter-spacing: -.07em;
	/* text-shadow: white 2px 2px 2px; */
	}

	.valuetext
	{
		/* font-weight: bold; */
		text-align: center;
		font-size: 1.5em;
	}

	.switch {
    position: relative;
    width: 100%;
    height: 40px;
    border: 3px solid #4AB616;
    color: #4AB616;
    font-size: 17px;
    border-radius: 10px;
	}

	.quality {
		position: relative;
		display: inline-block;
		width: 50%;
		height: 100%;
		line-height: 25px;
	}
	.quality:first-child label {
		border-radius: 5px 0 0 5px;
	}
	.quality:last-child label {
		border-radius: 0 5px 5px 0;
	}
	.quality label {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		cursor: pointer;
		text-align: center;
		transition: transform 0.8s, color 0.4s, background-color 0.4s;
		min-height: 100%;
		display: table-cell;
		vertical-align: middle;
	}
	#iconswitch, #iconswitch2
	{
		top: 25%;
		left: 0;
		position: absolute;
		width: 100%;
		height: 100%;
		cursor: pointer;
		text-align: center;
		min-height: 100%;
		display: table-cell;
		vertical-align: middle;
	}
	.quality input[type="radio"] {
		appearance: none;
		width: 0;
		height: 0;
		opacity: 0;
	}
	.quality input[type="radio"]:focus {
		outline: 0;
		outline-offset: 0;
		
	}
	.quality input[type="radio"]:checked ~ label {
		background-color: #4AB616;
		color: white;
		display: table-cell;
		vertical-align: middle
	}
	.quality input[type="radio"]:active ~ label {
		transform: scale(1.05);
		display: table-cell;
		vertical-align: middle
	}





</Style>



<body id="page-top">

<div id="wrapper">

    <ul class="navbar-nav sidebar sidebar-dark accordion background-color-1" id="accordionSidebar">

      <?php include('partials/logo-nav.php'); ?>

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

      <li class="nav-item active">

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
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3 p-0">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav">
            <li class="nav-item"><h4 class="nav-link font-weight-bold font-color m-0">Notifikasi</h4></li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                <img width="25" class="rounded-circle border" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXXmBvHF1K3QQ0cbaznD0yfSqNizuv3rOrcQKW43gWgQ8ujiyg'); background-size: cover; background-repeat: no-repeat; background-position: center;">
              </a>
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
        	<section class="mb-4">
				<div class="row">
					<div class="col-lg-4 col-md-12">
						<img class="img-fluid" src="../asset/image/undraw_wallet_aym5.svg">
					</div>
					<div class="col-lg-8 col-md-12">
					<h5 class="mt-0 font-weight-bold">Saldo Tabungan Beras</h5>
					<span>Kamu bisa mengecek total keseluruhan saldo beras disini, angka dapat berubah setiap pengguna menyelesaikan transaksi.</span><br>
					<span>Total keseluruhan saldo tabungan beras saat ini adalah :</span>
					<h1 style="font-size: 80px" class="font-color"><?php echo $konversi->normal($totaltabungan) ?> Kg</h1>
					</div>
				</div>

        	</section>

        	<section>



	<!-- //////////////////////////////////////////////////////////////////////// -->

        <?php if (isset($_POST["detail"])){

					$nama = $_POST['nama'];
					$beras = $_POST['beras'];
					$uang = $_POST['uang'];
					$nohp = $_POST['nohp'];
					$alamat = $_POST['alamat'];
					$jenis_pembayaran = $_POST['jenis_pembayaran'];
					$bukti_tf= $_POST['bukti_tf'];
					$lat = $_POST['lat'];
					$lng = $_POST['lng'];
					$fotop = $_POST['fotop'];
					$linkmapsx = $_POST['linkmaps']
					?>

				
				<div class="card mb-4">
					<div class="card-header">
						<div class="row">
							<div class="col d-flex">
								<?php if($fotop != null) { ?>
									<img width="65" class="rounded-circle border mr-3" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" style="background-image: url('../asset/image/user_profile_pic/<?php echo $fotop ?>'); background-size: cover; background-repeat: no-repeat; background-position: initial;">
								<?php } else {?>
									<img class="mr-3" width="65" src="https://image.flaticon.com/icons/svg/145/145852.svg" alt="Generic placeholder image">
								<?php } ?>
								<h5 class="mb-0 font-weight-bold" style="align-self: center;"><?php echo $nama ?></h5>
							</div>
							<div class="col-auto">
								<form method="post" action="">
									<button class="btn btn-color m-0" name="kembali" >Kembail</button>
								</form>
							</div>
						</div>
					</div>
					<div class="card-body">
						<p class="font-weight-bold font-color">Jumlah :</p>
						<h1><?php echo $beras ?></h1>
						<p class="font-weight-bold font-color">Nomor Telepon :</p>
						<p><?php echo $nohp ?></p>
						<p class="font-weight-bold font-color">Alamat Lengkap :</p>
						<p><?php echo $alamat ?></p>
						<?php if ($jenis_pembayaran == 'transfer')
						{ ?>
							<p class="font-weight-bold font-color">Bukti Transfer :</p>
							<img width="400" class="border mr-3" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" style="background-image: url('../asset/image/log_transfer_tabungan/<?php echo $bukti_tf ?>'); background-size: cover; background-repeat: no-repeat; background-position: initial;">
						<?php } ?>
						<p class="font-weight-bold font-color">Peta :</p>
						<a href="<?php echo $linkmapsx ?>" target="_blank" class="btn btn-color m-0 mb-3">Buka dengan google maps</a>
						<!-- <div id="map" class="rounded" style="height: 400px; width: 100%"></div> -->
						<?php include('../maps/maps-in-data2.php'); ?>
					</div>
				</div>
		<!-- //////////////////////////////////////////////////////////////////////// -->

				<?php } else {?>
				<div class="card mb-4">
					<div class="card-header">
						<h5 class="mb-0 font-weight-bold">Tabungan</h5>
					</div>
					<div class="card-body p-0">
						<ul class="nav nav-tabs grey lighten-3 border-0" id="myTab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link font-color active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
						      aria-selected="true"><i class="fa fa-times-circle"></i> Belum Di Ambil</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link font-color" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
						      aria-selected="false"><i class="fa fa-history"></i> Riwayat</a>
						  </li>
						</ul>
						<div class="tab-content p-3" id="myTabContent">

<!-- /////////////////////////// riwayat belum terverifikasi /////////////////////////// -->
						
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


							<?php if($lenght10 > 0){ ?>

								<div class='switch mb-4'><div class='quality'>
									<input type="radio" id="tabel" name="radiob" checked value="tabel">
									<label for='tabel'><i id="iconswitch" class="fas fa-bars"></i></label>
								</div><div class='quality'>
									<input type="radio" id="block" name="radiob" value="block">
									<label for='block'><i id="iconswitch2" class="fas fa-th"></i></label>
								</div>
								</div>

							<!-- /////////////// display non tabel /////////////// -->
						  	<div class="row" id="block1" style="display:none;">
								<?php	while ($row=mysqli_fetch_array($results10))
										{
											$id_u =	$row['id_user'];
											$queryx = "SELECT * FROM akun_user WHERE id_user='$id_u'";
											$resultsx = mysqli_query($db, $queryx) or die (mysqli_error());
											$datax=mysqli_fetch_array($resultsx);
											$nama=$datax['nama'];
											$nohp=$datax['no_hp'];
											$fotx=$datax['fotoprofil'];
											$saldo=$datax['saldo'];
											$lat=$row['lat'];
											$lng=$row['lng'];

											$useragent=$_SERVER['HTTP_USER_AGENT'];
											$mobile = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));
											if($mobile)
											{
												$linkmaps="google.navigation:q=$lat,$lng&mode=d";
											}
											else
											{
												$linkmaps="http://www.google.com/maps/place/$lat,$lng";
											}

											$rupiah = $konversi->normal($row['jumlah_transaksi_beras']);
											$beras = $konversi->normal($row['jumlah_transaksi_beras'])." Kg";
											
									?>

									<div class="col-lg-6 col-sm-12 mb-3">
										<div class="media">
											<?php if($fotx != null) { ?>
												<img width="65" class="rounded-circle border mr-2 mb-3" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" style="background-image: url('../asset/image/user_profile_pic/<?php echo $fotx ?>'); background-size: cover; background-repeat: no-repeat; background-position: initial;">
											<?php } else {?>
											<img class="d-flex mr-3 mb-3" width="55" src="https://image.flaticon.com/icons/svg/145/145852.svg" alt="Generic placeholder image">
											<?php } ?>
											<div class="media-body">
											<h5 class="mt-0 font-weight-bold"><?php echo $nama ?></h5>

												<p class="m-0"><span class="font-weight">Jumlah Uang:</span> Rp. <?php echo $rupiah ?></p>

												<p class="m-0"><span class="font-weight">Jumlah Beras:</span> <?php echo $beras ?></p>
													<p class="m-0" ><span class="font-weight">Tanggal Transaksi:</span> <?php echo $row['tanggal_transaksi'] ?></p>
													<p class="m-0"><span class="font-weight">Alamat:</span> <?php echo $row['alamat'] ?></p>
												<div class="mt-3">
													<span>Keterangan:</span>
													<div class="d-flex">
														<?php if($row['jenis_transaksi'] == 'beras')
															{ ?>
																<span class="badge badge-danger p-2 mr-2" data-toggle="tooltip" title="Jenis transaksi yang di gunakan"> Beras</span>
															<?php } else if ($row['jenis_transaksi'] == 'uang') { ?> 
																<span class="badge badge-danger p-2 mr-2" data-toggle="tooltip" title="Jenis pembayaran yang di gunakan"> Uang</span>
																<span class="badge badge-info p-2 mr-2" data-toggle="tooltip" title="Jenis pembayaran yang di gunakan"> <?php echo $row['jenis_pembayaran'] ?></span>
															<?php }?>
													</div>
												</div>									
												<hr>
											<div class="row">
													<div class="col-md-4 col-lg-6 col-xl-auto col-sm-auto">
														<form method="post" action="">
																<input type="hidden" name="nama" value="<?php echo $nama ?>" type="text" /> <!-- hidden -->
																<input type="hidden" name="beras" value="<?php echo $beras ?>" type="text" /> <!-- hidden -->
																<input type="hidden" name="uang" value="<?php echo $rupiah ?>" type="text" /> <!-- hidden -->
																<input type="hidden" name="nohp" value="<?php echo $nohp ?>" type="text" /> <!-- hidden -->
																<input type="hidden" name="alamat" value="<?php echo $row['alamat']	 ?>" type="text" /> <!-- hidden -->
																<input type="hidden" name="jenis_pembayaran" value="<?php echo $row['jenis_pembayaran'] ?>" type="text" /> <!-- hidden -->
																<input type="hidden" name="bukti_tf" value="<?php echo $row['bukti_tf'] ?>" type="text" /> <!-- hidden -->
																<input type="hidden" name="lat" value="<?php echo $row['lat'] ?>" type="text" /> <!-- hidden -->
																<input type="hidden" name="lng" value="<?php echo $row['lng'] ?>" type="text" /> <!-- hidden -->
																<input type="hidden" name="linkmaps" value="<?php echo $linkmaps?>" type="text" /> <!-- hidden -->
																<input type="hidden" name="fotop" value="<?php echo $fotx ?>" type="text" /> <!-- hidden -->
															<button class="btn btn-sm btn-warning m-0 mt-3 mt-xl-0 mr-3" value="<?php $idx ?>" name="detail"><i class="fa fa-list"></i> Lihat Detail</button>							
														</form>
													</div>
												<div class="col-md-4 col-lg-6 col-xl-auto col-sm-auto">
													<form method="post" action="prosespengaturan.php">
														<input type="hidden" name="id_user" value="<?php echo $id_u ?>" type="text" /> <!-- hidden -->
														<input type="hidden" name="jumlah_transaksi" value="<?php echo $row['jumlah_transaksi_beras'] ?>" type="text" /> <!-- hidden -->
														<input type="hidden" name="saldo" value="<?php echo $saldo ?>" type="text" /> <!-- hidden -->
														<button class="btn btn-sm btn-color m-0 mt-3 mt-xl-0 mr-3" name="konfirmasi_tabungan" value="<?php echo $row['id_transaksi']; ?>" onclick="return confirm('Apakah anda yakin akan mengkonfirmasi transaksi ini ?')" ><i class="fa fa-check-circle"></i> Konfirmasi</button>
													</form>
												</div>
												<div class="col-md-4 col-lg-6 col-xl-auto col-sm-auto"> 
													<a class="btn btn-info btn-sm m-0 mt-3 mt-xl-0" href="<?php echo $linkmaps ?>" target="_blank"><i class="fa fa-map-marker" ></i> Buka Peta</a> 
												</div>
											</div>
										</div>
										</div>
										<hr>
									</div>
										<?php } ?> 
							</div>
							<!-- /////////////// display tabel /////////////// -->
							<div class="" id="tabel1" >
								<div class="table-responsive">
									<table class="table table-bordered" id="redx" width="100%" cellspacing="0">
										<thead>
											<tr style="text-align:center">
												<th>No</th>
												<th width="150">Nama</th>
												<th>Jenis tabungan</th>
												<th>Jumlah Uang</th>
												<th>Jumlah Beras</th>
												<th>Jenis Pembayaran</th>
												<th width="200">Alamat</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tfoot>
											<tr style="text-align:center">
												<th>No</th>
												<th>Nama</th>
												<th>Jenis tabungan</th>
												<th>Jumlah Uang</th>
												<th>Jumlah Beras</th>
												<th>Jenis Pembayaran</th>
												<th>Alamat</th>
												<th>Aksi</th>
											</tr>
										</tfoot>
										<tbody>
										
										<?php	$no = 0;
										while ($row23=mysqli_fetch_array($results11))
										{
											$id_u =	$row23['id_user'];
											$queryx = "SELECT * FROM akun_user WHERE id_user='$id_u'";
											$resultsx = mysqli_query($db, $queryx) or die (mysqli_error());
											$datax=mysqli_fetch_array($resultsx);
											$nama=$datax['nama'];
											$saldo=$datax['saldo'];
											$lat=$row23['lat'];
											$lng=$row23['lng'];

											$useragent=$_SERVER['HTTP_USER_AGENT'];
											$mobile = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));
											if($mobile)
											{
												$linkmaps="google.navigation:q=$lat,$lng&mode=d";
											}
											else
											{
												$linkmaps="http://www.google.com/maps/place/$lat,$lng";
											}

											$rupiah = $konversi->normal($row23['jumlah_transaksi_uang']);
											$beras = $konversi->normal($row23['jumlah_transaksi_beras'])." Kg";

											?>
											<tr style="text-align:center">
												<td><?php echo ++$no ?></td>
												<td><?php echo $nama ?></td>
												<td><?php echo $row23['jenis_transaksi'] ?></td>
												<td><?php echo $rupiah ?></td>
												<td><?php echo $beras ?></td>
												<td><?php 
														echo $row23['jenis_pembayaran'];
														if($row23['jenis_pembayaran'] == "transfer")
														{ ?>
															<br>
																<a class="btn btn-sm btn-warning m-0 image-popup-no-margins" href="../asset/image/log_transfer_tabungan/<?php echo $row23['bukti_tf'] ?>">Cek Bukti Transfer
																	<img src="../asset/image/log_transfer_tabungan/<?php echo $row23['bukti_tf'] ?>" class="d-none" width="227">
																</a>																
														<?php } 
												?>													
											</td>
												<td>
													<?php echo $row23['alamat'] ?>
												</td>
												<td class="text-center">
													<a class="btn btn-sm btn-primary m-0"  href="<?php echo $linkmaps ?>" target="_blank" >Buka Peta</a>
													<form action="prosespengaturan.php" method="POST">
														<input type="hidden" name="id_user" value="<?php echo $id_u ?>" type="text" /> <!-- hidden -->
														<input type="hidden" name="jumlah_transaksi" value="<?php echo $row23['jumlah_transaksi_beras'] ?>" type="text" /> <!-- hidden -->
														<input type="hidden" name="saldo" value="<?php echo $saldo ?>" type="text" /> <!-- hidden -->
														<button name="konfirmasi_tabungan" value="<?php echo 	$row23['id_transaksi']; ?>" onclick="return confirm('Apakah anda yakin akan mengkonfirmasi transaksi ini ?')"  class="btn btn-sm btn-success m-0 mt-3">Konfirmasi</button>
													</form>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<?php } else {?>
										<div class="card-body text-center">
											<img width="100" src="https://image.flaticon.com/icons/svg/1634/1634836.svg">
											<h5 class="m-0 mt-3">Tidak ada transaksi yang belum dikonfirmasi</h5>
										</div>
									<?php } ?>
						  </div>



<!-- /////////////////////////// riwayat terverifikasi /////////////////////////// -->

						  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								<?php if($lenght2 > 0){ ?>

									<div class='switch mb-4'><div class='quality'>
										<input type="radio" id="tabelver" name="radiobx" checked>
										<label for='tabelver'><i id="iconswitch" class="fas fa-bars"></i></label>
									</div><div class='quality'>
										<input type="radio" id="blockver" name="radiobx">
										<label for='blockver'><i id="iconswitch2" class="fas fa-th"></i></label>
									</div>
									</div>

							<!-- /////////////// display non tabel /////////////// -->
						  	<div class="row" id="block1ver" style="display:none;">
								<!-- /////////////////// -->
								<?php	while ($row=mysqli_fetch_array($results2))
										{
											$id_u =	$row['id_user'];
											$queryy = "SELECT * FROM akun_user WHERE id_user='$id_u'";
											$resultsy = mysqli_query($db, $queryy) or die (mysqli_error());
											$datay=mysqli_fetch_array($resultsy);
											$nama=$datay['nama'];
											$nohp=$datay['no_hp'];
											$fotx=$datay['fotoprofil'];
											$saldo=$datay['saldo'];

											/////////////// konversi beras ke angka
											$finaltotalsaldo = $konversi->normal($row['jumlah_transaksi_beras'])." Kg";

											/////////////// konversi uang ke angka
											if($row['jenis_transaksi'] == 'uang') {
												$uang = $row['jumlah_transaksi_uang']; 
												$rupiah = number_format($uang,0,'','.');
											}
											else
											{
												$rupiah = "-";
											}
									?>

								<div class="col-lg-6 col-sm-12 mb-3">
								  	<div class="media">
										<?php if($fotx != null) { ?>
											<img width="65" class="rounded-circle border mr-2 mb-3" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" style="background-image: url('../asset/image/user_profile_pic/<?php echo $fotx ?>'); background-size: cover; background-repeat: no-repeat; background-position: initial;">
										<?php } else {?>
									  	<img class="d-flex mr-3 mb-3" width="55" src="https://image.flaticon.com/icons/svg/145/145852.svg" alt="Generic placeholder image">
										<?php } ?>
										<div class="media-body">
									    <h5 class="mt-0 font-weight-bold"><?php echo $nama ?></h5>
											<p class="m-0"><span class="font-weight">Jumlah Uang:</span> Rp. <?php echo $rupiah ?></p>
									    	<p class="m-0"><span class="font-weight">Jumlah Beras:</span> <?php echo $finaltotalsaldo ?></p>
											<p class="m-0" ><span class="font-weight">Tanggal Transaksi:</span> <?php echo $row['tanggal_transaksi'] ?></p>
									    	<p class="m-0"><span class="font-weight">Alamat:</span> <?php echo $row['alamat'] ?></p>									
												<div class="mt-3">
													<span>Keterangan:</span>
													<div class="d-flex">
														<?php if($row['jenis_transaksi'] == 'beras')
														{ ?>
															<span class="badge badge-danger p-2 mr-2" data-toggle="tooltip" title="Jenis transaksi yang di gunakan"> Beras</span>
														<?php } else if ($row['jenis_transaksi'] == 'uang') { ?> 
															<span class="badge badge-info p-2 mr-2" data-toggle="tooltip" title="Jenis pembayaran yang di gunakan"> Uang</span>
														<?php }?>
													</div>
												</div>
												<div class="d-flex">
										    <form method="post" action="">
														<input type="hidden" name="nama" value="<?php echo $nama ?>" type="text" /> <!-- hidden -->
														<input type="hidden" name="beras" value="<?php echo $finaltotalsaldo ?>" type="text" /> <!-- hidden -->
														<input type="hidden" name="uang" value="<?php echo $rupiah ?>" type="text" /> <!-- hidden -->
														<input type="hidden" name="nohp" value="<?php echo $nohp ?>" type="text" /> <!-- hidden -->
														<input type="hidden" name="alamat" value="<?php echo $row['alamat']	 ?>" type="text" /> <!-- hidden -->
														<input type="hidden" name="lat" value="<?php echo $row['lat'] ?>" type="text" /> <!-- hidden -->
														<input type="hidden" name="lng" value="<?php echo $row['lng'] ?>" type="text" /> <!-- hidden -->
														<input type="hidden" name="linkmaps" value="<?php echo $linkmaps?>" type="text" /> <!-- hidden -->
														<input type="hidden" name="fotop" value="<?php echo $fotx ?>" type="text" /> <!-- hidden -->
														<input type="hidden" name="jenis_pembayaran" value="<?php echo $row['jenis_pembayaran'] ?>" type="text" /> <!-- hidden -->
															<input type="hidden" name="bukti_tf" value="<?php echo $row['bukti_tf'] ?>" type="text" /> <!-- hidden -->
										    	<button class="btn btn-sm btn-warning m-0 mt-3 mr-3" value="<?php $idx ?>" name="detail"><i class="fa fa-list"></i> Lihat Detail</button>								
											</form>									
										</div>
									  </div>
									</div>
									<hr>
								</div>
								<?php } ?>

								<!-- /////////////////// --> 
							</div>
							<div id="tabel1ver">

								<div class="table-responsive">
									<table class="table table-bordered" id="redx2" width="100%" cellspacing="0">
										<thead>
											<tr style="text-align:center">
												<th>No</th>
												<th width="150">Nama</th>
												<th>Jenis tabungan</th>
												<th>Jumlah Uang</th>
												<th>Jumlah Beras</th>
												<th>Jenis Pembayaran</th>
												<th width="200">Alamat</th>
											</tr>
										</thead>
										<tfoot>
											<tr style="text-align:center">
												<th>No</th>
												<th>Nama</th>
												<th>Jenis tabungan</th>
												<th>Jumlah Uang</th>
												<th>Jumlah Beras</th>
												<th>Jenis Pembayaran</th>
												<th>Alamat</th>
											</tr>
										</tfoot>
										<tbody>
										
										<?php	$no = 0;
										while ($row23=mysqli_fetch_array($results21))
										{
											$id_u =	$row23['id_user'];
											$queryx = "SELECT * FROM akun_user WHERE id_user='$id_u'";
											$resultsx = mysqli_query($db, $queryx) or die (mysqli_error());
											$datax=mysqli_fetch_array($resultsx);
											$nama=$datax['nama'];
											$saldo=$datax['saldo'];
											$lat=$row23['lat'];
											$lng=$row23['lng'];
											$useragent=$_SERVER['HTTP_USER_AGENT'];
											$mobile = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));
											if($mobile)
											{
												$linkmaps="google.navigation:q=$lat,$lng&mode=d";
											}
											else
											{
												$linkmaps="http://www.google.com/maps/place/$lat,$lng";
											}

											$finaltotalsaldo = $konversi->normal($row23['jumlah_transaksi_beras'])." Kg";

											/////////////// konversi uang ke angka
											if($row23['jenis_transaksi'] == 'uang') {
												$uang = $row23['jumlah_transaksi_uang']; 
												$x= number_format($uang,0,'','.');
												$rupiah = "Rp. ".$x;
											}
											else
											{
												$rupiah = "Rp. -";
											}

											?>
											<tr style="text-align:center">
												<td><?php echo ++$no ?></td>
												<td><?php echo $nama ?></td>
												<td><?php echo $row23['jenis_transaksi'] ?></td>
												<td><?php echo $rupiah ?></td>
												<td><?php echo $finaltotalsaldo ?></td>
												<td><?php 
														echo $row23['jenis_pembayaran'];
														if($row23['jenis_pembayaran'] == "transfer")
														{ ?>
															<br>
																<a class="btn btn-sm btn-warning m-0 image-popup-no-margins" href="../asset/image/log_transfer_tabungan/<?php echo $row23['bukti_tf'] ?>">Cek Bukti Transfer
																	<img src="../asset/image/log_transfer_tabungan/<?php echo $row23['bukti_tf'] ?>" class="d-none" width="227">
																</a>																
														<?php } 
												?>													
												</td>
												<td>
													<?php echo $row23['alamat'] ?>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<?php } else {?>
									<div class="card-body text-center">
										<img width="100" src="https://image.flaticon.com/icons/svg/1634/1634836.svg">
										<h5 class="m-0 mt-3">Tidak ada transaksi</h5>
									</div>
								<?php } ?>
						  </div>
						</div>
					</div>
				</div>
				<?php } ?>
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



<?php include('../partials/js.php'); ?>
<script src="../asset/js/javascript.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>	

<script>




		if (isset($_POST["kembali"])){

			unset($_POST['detail']);

		}

</script>

<script>

	$(function () {

	$('[data-toggle="tooltip"]').tooltip()

	})

</script>

<style>

	@media (max-width: 991px) {

		.media {display: block;}

	}

</style>


</body>
</html>

<script>

	$(document).ready(function() {
	$('input[type="radio"]').click(function() {
	if($(this).attr('id') == 'block') {
		$('#tabel1').hide();
		$('#block1').show();      
        
	}
	if($(this).attr('id') == 'tabel') {
		$('#tabel1').show(); 
		$('#block1').hide();         
	}
	});
	});

	$(document).ready(function() {
	$('input[type="radio"]').click(function() {
	if($(this).attr('id') == 'blockver') {
		$('#tabel1ver').hide();
		$('#block1ver').show();      
        
	}
	if($(this).attr('id') == 'tabelver') {
		$('#tabel1ver').show(); 
		$('#block1ver').hide();         
	}
	});
	});
</script>

<?php 

}

else

{

	header('Location:../login/index.php') ;

}

?>