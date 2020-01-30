<?php
	
	$id = $_SESSION['s_user_id'];
		// echo("<script>console.log('PHP: " . $id . "');</script>");
	$query="SELECT * FROM `akun_user` WHERE id_user='$id' ";
	$sql=mysqli_query($db, $query) or die (mysqli_error());
	while($data=mysqli_fetch_array($sql)){ 
		?>
<script type="text/javascript" src="../partials/jquery-3.2.1.min.js"></script>
<div class="col-lg-4 col-sm-12 mb-3 mb-lg-0 px-0 px-sm-0 px-md-0 px-lg-3 px-xl-3">
	<div class="sticky-top" style="top: 4.5rem; z-index: 1">
		<div class="card">
		<div class="card-header text-center">
			<?php if($data['fotoprofil'] == null){ ?>
				<img width="150" class="rounded-circle border mb-2" src="https://image.flaticon.com/icons/svg/145/145867.svg">
			<?php } else { ?>
				<img width="150" height="150" class="rounded-circle border mb-2" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" style="background-image: url('../asset/image/user_profile_pic/<?php echo($data['fotoprofil']) ?>'); background-size: cover; background-repeat: no-repeat; background-position: initial;">
			<?php } ?>
			<h5 class="font-weight-bold"><?php echo $data['nama']?></h5>
			<hr>

				<button name="nav-i" id="uppp" value="upload" class="btn btn-color btn-sm">Ganti Foto</button>
			<?php if($data['fotoprofil'] != null){ ?>
				<button id="deletepp" name="deletepp" data-toggle="modal" data-target="#hapusfoto" class="btn btn-danger btn-sm">Hapus Foto</button>
			<?php } ?>

			<form action="upfotoprofil.php" id="upload_form" method="POST" enctype="multipart/form-data" style="display:none">
				<input type="file" id="ppuser" name="ppuser" accept="image/*" /> 
			</form>

		</div>
		<div class="content card-body">
			<p class="mb-1"><span class="font-weight-bold">Nama Pengguna : </span></span> <?php echo($data['username']) ?></p>
			<p class="mb-1"><span class="font-weight-bold">No.Telepon 	: </span> <?php echo($data['no_hp']) ?> </p>
			<p class="mb-1"><span class="font-weight-bold">No. Tabungan 	: </span> <?php echo($data['no_tabungan']) ?> </p>
			<?php if ($data['user_email'] != null){ ?>
				<p class="mb-1"><span class="font-weight-bold">Email 		: </span> <?php echo($data['user_email']) ?> </p>
			<?php } else { ?>
				<p class="mb-1"><span class="font-weight-bold">Email 		: </span> - </p>
			<?php } ?>
			<p class="mb-1"><span class="font-weight-bold">Alamat 		: </span> <?php echo($data['alamat']) ?> </p>
		</div>
		</div>
	</div>
</div>

<?php

	}

?>

<script>

	document.getElementById("uppp").addEventListener ("click", uploadpp, false);

	function uploadpp(){
			document.getElementById("ppuser").click();

			var tmr = setInterval(function(){
				console.log("111");
				if($('#ppuser').val() !== "")
				{
					// upfoto();
					console.log("222");
					clearInterval(tmr);
					$('#upload_form').submit();

				}
			}, 500)
		};

</script>


<!-- ///////////////////////////// MODAL HAPUS FOTO ////////////////////////////// -->

	<div class="modal fade" id="hapusfoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<span>Apakah anda yakin ingin menghapus foto profil?</span>
		</div>
		<div class="modal-footer">
			<a type="button" class="btn btn-color" data-dismiss="modal">Batal</a>
			<a type="button" href="delfotoprofil.php" class="btn btn-danger">Hapus</a>
		</div>
		</div>
	</div>
	</div>



