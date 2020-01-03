<?php 
include('../db_con.php');
if (isset($_SESSION['s_admin_id']))
{
	header('Location:../admin/index.php') ;
}
else if (isset($_SESSION['s_user_id']))
{
	header('Location:../profile/index.php') ;
}
else
{

?>
<!DOCTYPE html>
<html>
<head>
	<title>Masuk</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="icon" href="favicon/favicon.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon"/>
	<script type="text/javascript" src="../partials/jquery-3.2.1.min.js"></script>
	<meta name="theme-color" content="#4AB616">
	<?php include('../partials/css.php'); ?>
</head>
<body>
<?php
if(isset($_GET['error'])==1)
{
	echo 
	"<script> 
		$(window).on('load', function(){
			alert('Nama Pengguna dan password tidak cocok'); 
		});
	</script>";
}
?>
<?php
 include('../partials/navbar.php'); ?>
<section class="container">
	<div style="margin: 5rem 0 5rem 0">
		<div class="row">
			<div class="col-lg-6 col-sm-12 py-5 px-0 px-sm-0 px-md-0 px-lg-3 px-xl-3">
				<div class="card">
					<div class="card-header">
						<h5 class="mb-0 font-weight-bold">Masuk</h5>
					</div>
					<div class="card-body">
				        <form method="post" action="proses_login.php">
						    <input type="text" id="username" class="form-control mb-4" placeholder="Nama Pengguna" name="username" required="">
						    <input class="form-control mb-4" type="password" name="password" id="password" placeholder="Password" required="">
				            <!-- <div class="custom-control custom-checkbox d-flex justify-content-between mb-3">
				                <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
				                <label class="custom-control-label" for="defaultLoginFormRemember">Ingat Saya</label>
				            </div> -->
						    <button class="btn btn-color white-text btn-block m-0 mb-3 border-0" name="login_user" type="submit">Masuk</button>
						</form>
					    <p>Tidak Punya Akun?
					        <a href="../register">Daftar Sekarang</a>
					    </p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-sm-12" style="background: url(../asset/image/undraw_complete_task_u2c3.svg); background-size: contain; background-repeat: no-repeat; background-position: center;">
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
?>
