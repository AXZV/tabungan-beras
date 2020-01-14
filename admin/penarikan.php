<?php
	include('../db_con.php');
if (isset($_SESSION['s_admin_id']))
{
	$id_admin=$_SESSION['s_admin_id'];
	$query0 = "SELECT * FROM akun_admin WHERE id_admin='$id_admin'";
	$results0 = mysqli_query($db, $query0) or die (mysqli_error());
	$data=mysqli_fetch_array($results0);


	$query = "SELECT * FROM log_penarikan WHERE status='belum_diverifikasi'";
	$results = mysqli_query($db, $query) or die (mysqli_error());
	$lenght11=mysqli_num_rows($results);


	$query2 = "SELECT * FROM log_penarikan WHERE status='sudah_diverifikasi'";
	$results2 = mysqli_query($db, $query2) or die (mysqli_error());
	$lenght22 = mysqli_num_rows($results2);

	include '../function/fungsi.php';
	$konversi = new konversi;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Penarikan</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
	<link rel="manifest" href="../favicon/site.webmanifest">
	<meta name="theme-color" content="#4AB616">
	<?php include('../partials/css.php'); ?>
	<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
	<link rel="stylesheet" type="text/css" href="../asset/css/admin.css">
	<script type="text/javascript" src="../partials/jquery-3.2.1.min.js"></script>
	
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
      <li class="nav-item">
        <a class="nav-link" href="notifikasi">
          <i class="fa fa-bell"></i>
          <span>Notifikasi</span></a>
      </li>
	  <li class="nav-item active">
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
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3 p-0">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav">
            <li class="nav-item"><h4 class="nav-link font-weight-bold font-color m-0">Penarikan</h4></li>
          </ul>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                <img width="25" class="rounded-circle border" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" style="background-image: url('../asset/image/icon/usr-2.svg'); background-size: cover; background-repeat: no-repeat; background-position: center;">
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
        	<section class="mb-4">
				<div class="row d-none">
					<div class="col-lg-8 col-sm-12">
						<div class="card-body">
							<div class="media">
							  <img class="d-flex mr-3" width="55" src="../asset/image/icon/usr-2.svg" alt="Generic placeholder image">
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
				<div class="row">
					<div class="col-lg-4 col-md-12">
						<img class="img-fluid" src="../asset/image/undraw_wallet_aym5.svg">
					</div>
					<div class="col-lg-8 col-md-12">
					<h5 class="mt-0 font-weight-bold">Penarikan Tabungan</h5>
					<span>Kamu bisa mengecek daftar pengguna yang akan melakukan penarikan tabungan.<br>Note: pilih konfirmasi setelah transaksi selesai, pengguna yang telah di konfirmasi bisa di lihat pada riwayat.</span><br>
					</div>
				</div>
        	</section>
        	<section>
	          <div class="card shadow border-0 mb-4">
	            <div class="card-header py-3">
	              <h5 class="m-0 font-weight-bold">Daftar Riwayat Penarikan</h5>
	            </div>
	            <div class="card-body p-0">
						<ul class="nav nav-tabs grey lighten-3 border-0" id="myTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link font-color active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
										aria-selected="true"><i class="fa fa-times-circle"></i> Belum Di Konfirmasi</a>
								</li>
								<li class="nav-item">
									<a class="nav-link font-color" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
										aria-selected="false"><i class="fa fa-history"></i> Riwayat Konfirmasi Penarikan</a>
								</li>
							</ul>

									

	<!-- //////////////////////////////// SEDEKAH BELUM DI KONFIRMASI  /////////////////////////////////// -->

							<div class="tab-content p-3" id="myTabContent"> <!-- myTabContent -->
						  	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<?php if($lenght11 > 0){ ?>
						  		<div class="">							
										<div class="table-responsive">
											<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
												<thead>
													<tr style="text-align:center">
														<th>No</th>
														<th width="150">Nama</th>
														<th>Jumlah Transaksi</th>
														<th>Jenis Transaksi</th>
														<th>Tanggal Transaksi</th>
														<th width="200">Alamat</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tfoot>
													<tr style="text-align:center">
														<th>No</th>
														<th width="150">Nama</th>
														<th>Jumlah Transaksi</th>
														<th>Jenis Transaksi</th>
														<th>Tanggal Transaksi</th>
														<th width="200">Alamat</th>
														<th>Aksi</th>
													</tr>
												</tfoot>
												<tbody>
												<?php	$no=0;
												while ($row=mysqli_fetch_array($results))
												{
													$id_u =	$row['id_user'];
													$queryx = "SELECT * FROM akun_user WHERE id_user='$id_u'";
													$resultsx = mysqli_query($db, $queryx) or die (mysqli_error());
													$datax=mysqli_fetch_array($resultsx);
													$nama=$datax['nama'];
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

													$finaltotalsaldo = $konversi->normal($row['jumlah_transaksi'])." Kg";
													?>
													<tr  style="text-align:center">									
														<td><?php echo ++$no ?></td>
														<td><?php echo $nama ?></td>
														<td><?php echo $finaltotalsaldo ?></td>
														<td><?php echo $row['jenis_transaksi'] ?></td>
														<td><?php echo $row['tanggal_transaksi'] ?></td>
														<td><?php echo $row['alamat'] ?></td>
														<td class="text-center">
															<a class="btn btn-sm btn-primary m-0"  href="<?php echo $linkmaps ?>" target="_blank" >Buka Peta</a>
															<form action="prosespengaturan.php" method="POST">
																<input type="hidden" name="id_user" value="<?php echo $id_u ?>" type="text" /> <!-- hidden -->
																<input type="hidden" name="saldo" value="<?php echo $saldo ?>" type="text" /> <!-- hidden -->
																<input type="hidden" name="jumlah_transaksi" value="<?php echo $row['jumlah_transaksi'] ?>" type="text" /> <!-- hidden -->
																<button name="konfirmasipenarikan" value="<?php echo 	$row['id_transaksi']; ?>" onclick="return confirm('Apakah anda yakin akan mengkonfirmasi transaksi ini ?')"  class="btn btn-sm btn-success m-0 mt-3">Konfirmasi</button>
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
											<img width="100" src="../asset/image/icon/hstry.svg">
											<h5 class="m-0 mt-3">Tidak ada transaksi penarikan yang belum dikonfirmasi</h5>
										</div>
									<?php } ?>
								</div>


		<!-- //////////////////////////////// RIWAYAT SEDEKAH  /////////////////////////////////// -->

								<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
									
								<?php 
								if($lenght22 > 0){ ?>
									<div class="table-responsive">
											<table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
												<thead>
													<tr style="text-align:center">
														<th>No</th>
														<th width="150">Nama</th>
														<th>Jumlah Transaksi</th>
														<th>Jenis Transaksi</th>
														<th>Tanggal Transaksi</th>
														<th width="200">Alamat</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tfoot>
													<tr style="text-align:center">
														<th>No</th>
														<th width="150">Nama</th>
														<th>Jumlah Transaksi</th>
														<th>Jenis Transaksi</th>
														<th>Tanggal Transaksi</th>
														<th width="200">Alamat</th>
														<th>Aksi</th>
													</tr>
												</tfoot>
												<tbody>
												<?php
												$no=0; 	
												while ($row2=mysqli_fetch_array($results2))
												{
													$id_u =	$row2['id_user'];
													$queryx = "SELECT * FROM akun_user WHERE id_user='$id_u'";
													$resultsx = mysqli_query($db, $queryx) or die (mysqli_error());
													$datax=mysqli_fetch_array($resultsx);
													$nama=$datax['nama'];
													$saldo=$datax['saldo'];
													$lat=$row2['lat'];
													$lng=$row2['lng'];
													
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
													
													$finaltotalsaldo = $konversi->normal($row2['jumlah_transaksi'])." Kg";

													?>
													<tr  style="text-align:center">
														<td><?php echo ++$no ?></td>
														<td><?php echo $nama ?></td>
														<td><?php echo $finaltotalsaldo ?></td>
														<td><?php echo $row2['jenis_transaksi'] ?></td>
														<td><?php echo $row2['tanggal_transaksi'] ?></td>

														<td><?php echo $row2['alamat'] ?></td>
														<td><a class="btn btn-sm btn-primary m-0"  href="<?php echo $linkmaps ?>" target="_blank" >Buka Peta</a></td>
													</tr>
												<?php } ?>
												</tbody>
											</table>
										</div>
									<?php } else {?>
									<div class="card-body text-center">
										<img width="100" src="../asset/image/icon/hstry.svg">
										<h5 class="m-0 mt-3">Tidak ada transaksi Penarikan</h5>
									</div>
								<?php } ?>
								</div>
							</div><!-- myTabContent -->
	            </div>
	          </div>
	        </section>
        </div>
      <!-- Footer -->
      <?php include('partials/footer.php') ?>
      <!-- End of Footer -->
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

							echo "<script>window.location.href='profil';</script>";	

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

<!-- /////////////////////// Modal Pengaturan /////////////////////////////// -->



<?php include('../partials/js.php'); ?>

<script src="../asset/js/javascript.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha256-P93G0oq6PBPWTP1IR8Mz/0jHHUpaWL0aBJTKauisG7Q=" crossorigin="anonymous"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
	$(document).ready(function() {

	$('.image-popup-vertical-fit').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		mainClass: 'mfp-img-mobile',
		image: {
			verticalFit: true
		}

		

	});



	$('.image-popup-fit-width').magnificPopup({

		type: 'image',

		closeOnContentClick: true,

		image: {

			verticalFit: false

		}

	});



	$('.image-popup-no-margins').magnificPopup({

		type: 'image',

		closeOnContentClick: true,

		closeBtnInside: false,

		fixedContentPos: true,

		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side

		image: {

			verticalFit: true

		},

		zoom: {

			enabled: true,

			duration: 300 // don't foget to change the duration also in CSS

		}

	});



	});

</script>

<style>

	/* padding-bottom and top for image */
	.mfp-no-margins img.mfp-img {
		padding: 0;
	}
	/* position of shadow behind the image */
	.mfp-no-margins .mfp-figure:after {
		top: 0;
		bottom: 0;
	}
	/* padding for main container */

	.mfp-no-margins .mfp-container {
		padding: 0;
	}
	.mfp-with-zoom .mfp-container,
	.mfp-with-zoom.mfp-bg {
		opacity: 0;
		-webkit-backface-visibility: hidden;
		-webkit-transition: all 0.3s ease-out; 
		-moz-transition: all 0.3s ease-out; 
		-o-transition: all 0.3s ease-out; 
		transition: all 0.3s ease-out;
	}
	.mfp-with-zoom.mfp-ready .mfp-container {
			opacity: 1;
	}
	.mfp-with-zoom.mfp-ready.mfp-bg {
			opacity: 0.8;
	}
	.mfp-with-zoom.mfp-removing .mfp-container, 
	.mfp-with-zoom.mfp-removing.mfp-bg {
		opacity: 0;
	}


</style>
</body>
</html>


<?php 
}
else
{
	header('Location:../login') ;
}
?>