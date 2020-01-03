<?php
session_start(); 
include('../db_con2.php');

	// LOGIN USER
	if (isset($_POST['login_user'])) {
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);

	$passmd5 = md5($password);

		$query = "SELECT * FROM akun_user WHERE username='$username' AND password='$passmd5' AND role='user'";
		$results = mysqli_query($db, $query) or die (mysqli_error());
			if (mysqli_num_rows($results) == 1) {

			while($data=mysqli_fetch_array($results)){
				$_SESSION['s_user_id'] = $data['id_user'];
				}

			header('Location:../profile/index.php');
				
			}	
			else {

				$query2 = "SELECT * FROM akun_admin WHERE username='$username' AND password='$passmd5' AND role='admin'" ;
				$results2 = mysqli_query($db, $query2) or die (mysqli_error());
					if (mysqli_num_rows($results2) == 1) {

						while($data=mysqli_fetch_array($results2)){
							$_SESSION['s_admin_id'] = $data['id_admin'];
							}
			
						header('Location:../admin/index.php');
						}
					else
					{
						header('Location:index.php?error=1');
					}
			}
	
	}

?>