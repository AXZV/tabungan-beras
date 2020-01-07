<?php
  include('../db_con.php');

if (isset($_SESSION['s_admin_id']))
{
	$id_admin=$_SESSION['s_admin_id'];

	$query0 = "SELECT * FROM akun_admin WHERE id_admin='$id_admin'";
	$results0 = mysqli_query($db, $query0) or die (mysqli_error());
	$data=mysqli_fetch_array($results0);
  
	$query = "SELECT * FROM akun_user";
	$results = mysqli_query($db, $query) or die (mysqli_error());
	$lenght1=mysqli_num_rows($results); 

	$query3 = "SELECT count(`id_user`) as total FROM akun_user";
	$results3 = mysqli_query($db, $query3) or die (mysqli_error());
	$row3=mysqli_fetch_array($results3);
	$totaluser = round($row3['total'], 2);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Pengguna</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="icon" href="favicon/favicon.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon"/>
	<meta name="theme-color" content="#4AB616">
	<?php include('../partials/css.php'); ?>
	<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../asset/css/admin.css">
</head>
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
			<li class="nav-item">
        <a class="nav-link" href="penarikan">
					<i class="fab fa-get-pocket"></i>
          <span>Penarikan</span></a>
      </li>
      <li class="nav-item active">
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
            <li class="nav-item"><h4 class="nav-link font-weight-bold font-color m-0">Pengguna</h4></li>
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
				<div class="row d-none">
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
				<div class="row">
					<div class="col-lg-4 col-md-12">
						<img class="img-fluid" src="../asset/image/undraw_people_tax5.svg">
					</div>
					<div class="col-lg-8 col-md-12">
					<h5 class="mt-0 font-weight-bold">Pengguna</h5>
					<span>Kamu bisa mengecek total keseluruhan pengguna, angka dapat berubah setiap pengguna menyelesaikan pendaftaran akun baru.</span><br>
					<span>Total keseluruhan pengguna saat ini adalah :</span>
					<h1 style="font-size: 80px" class="font-color"><?php echo $totaluser ?> Pengguna</h1>
					</div>
				</div>
        	</section>
        	<section>
	          <div class="card shadow border-0 mb-4">
	            <div class="card-header py-3">
	              <h5 class="m-0 font-weight-bold">Daftar Pengguna</h5>
	            </div>
	            <div class="card-body">

							<?php if($lenght1 > 0){ ?>

	              <div class="table-responsive">
	                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	                  <thead>
	                    <tr style="text-align:center">
						  <th>No</th>
	                      <th>Nama</th>
	                      <th>Nama Pengguna</th>
	                      <th>Nomor KTP</th>
	                      <th>Nomor Telepon</th>
	                      <th width="250">Alamat</th>
	                      <th>Jumlah Tabungan</th>
	                      <th>Aksi</th>
	                    </tr>
	                  </thead>
	                  <tfoot>
	                    <tr style="text-align:center">
						  <th>No</th>
	                      <th>Nama</th>
	                      <th>Nama Pengguna</th>
	                      <th>Nomor KTP</th>
	                      <th>Nomor Telepon</th>
	                      <th width="250">Alamat</th>
	                      <th>Jumlah Tabungan</th>
	                      <th>Aksi</th>
	                    </tr>
	                  </tfoot>
	                  <tbody>
						<?php $no=1;
							  while ($row=mysqli_fetch_array($results))
							  { ?>
	                    <tr>
						  <td style="text-align:center"><?php echo $no++;?></td>
	                      <td><?php echo $row['nama'];?></td>
	                      <td><?php echo $row['username'];?></td>
	                      <td><?php echo $row['no_ktp'];?></td>
	                      <td><?php echo $row['no_hp'];?></td>
	                      <td width="250"><?php echo $row['alamat'];?></td>
	                      <td><?php echo $row['saldo'];?></td>
	                      <td class="text-center">
                          <form action="prosespengaturan.php" method="POST">
						  	<button class="btn btn-sm btn-danger m-0" name="hapus_user" value="<?php echo $row['id_user'];?>"  onclick="return confirm('apakah anda yakin akan menghapus akun ini ?')">Hapus</button></td>
                          </form>
						</tr>
						<?php } ?>
	                  </tbody>
	                </table>
					</div>
					<?php } else {?>
						<div class="card-body text-center">
							<img width="100" src="https://image.flaticon.com/icons/svg/1634/1634836.svg">
							<h5 class="m-0 mt-3">Belum ada Nasabah</h5>
						</div>
					<?php } ?>
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



</body>
</html>

<?php 
}
else
{
	header('Location:../login/index.php') ;
}
?>