<?php

include('../db_con.php');

if (isset($_SESSION['s_user_id']))

{

	$id_user = $_SESSION['s_user_id'];

	$query = "SELECT * FROM akun_user WHERE id_user='$id_user'";

	$results = mysqli_query($db, $query) or die (mysqli_error());

	$data=mysqli_fetch_array($results);



	$jumlah_tabungan=$data['saldo'];

	$alamat=$data['alamat'];

	$lat=$data['lat'];

	$lng=$data['lng'];



}

?>

<!DOCTYPE html>

<html>

<head>

	<title>Sedekah Beras</title>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<link rel="icon" href="favicon/favicon.ico" type="image/x-icon"/>

	<link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon"/>

	<meta name="theme-color" content="#4AB616">

	<script type="text/javascript" src="../partials/jquery-3.2.1.min.js"></script>

	<?php include('../partials/css.php'); ?>

	<link rel="stylesheet" type="text/css" href="../asset/css/radiobuttonsedekah.css">

</head>



<body>

<?php include('../partials/navbar.php'); ?>

<section>

	<div class="container mt-3">

		<div class="row">

			<div class="col-lg-4 col-sm-12">

				<div class="sticky-top mb-3 mb-lg-0" style="top: 5rem; z-index: 1">

					<div class="heading mb-5">

						<h5 class="font-weight-bold font-color">Kategori</h5>

						<hr>

					</div>

					<a href="../sedekah/beras" class="black-text active-tab-2">

						<div class="media mb-3">

						  <img class="d-flex mr-3 border rounded p-1 grey lighten-3" width="70" src="https://image.flaticon.com/icons/svg/306/306670.svg" alt="Generic placeholder image">

						  <div class="media-body">

						    <h5 class="mt-0 font-weight-bold font-color">Sedekah Beras</h5>

						    Anda dapat membantu orang lain dengan menyedekahkan beras yang ingin anda sedekahkan, akan kami salurkan kepada pihak yang membutuhkan dan bekerjasama dengan kami, dan kami konfirmasikan kepada anda setelah penyaluran sedekah telah dilakukan.

						  </div>

						</div>

					</a>

					<hr>

					<a href="../sedekah/uang" class="black-text active-tab-2">

						<div class="media mb-3">

						  <img class="d-flex mr-3" width="70" src="https://image.flaticon.com/icons/svg/1138/1138548.svg" alt="Generic placeholder image">

						  <div class="media-body">

						    <h5 class="mt-0 font-weight-bold font-color">Sedekah Uang</h5>

						    Anda dapat membantu orang lain dengan menyedekahkan uang anda, akan kami salurkan kepada pihak yang membutuhkan dan bekerjasama dengan kami, dan kami konfirmasikan kepada anda setelah penyaluran sedekah telah dilakukan.

						  </div>

						</div>

					</a>

				</div>

			</div>

			<div class="col-lg-8 col-sm-12 px-0 px-sm-0 px-md-0 px-lg-3 px-xl-3">

				<div class="card">

					<div class="card-header">

						<h5 class="mb-0 font-weight-bold">Sedekah Beras</h5>

					</div>

					<?php

					if (isset($_SESSION['s_user_id']))

					{

					?>

					<div class="card-body">

						<form method="post" action="proses_sedekah_beras.php">



						<div class='switch mb-4'><div class='quality'>

							<input type="radio" id="radionontabungan" name="radiob" checked value="nontabungan">

							<label for='radionontabungan'>Cash On Delivery (COD)</label>

						</div><div class='quality'>

							<input type="radio" id="radiotabungan" name="radiob" value="tabungan">

							<label for='radiotabungan'>Ambil dari Tabungan</label>

						</div>

						</div>



						<div id="tabungan" style="display:none;">



							<label>Jumlah Saldo Tabungan Anda :</label>

							<div class="input-group mb-2">

								<input type="text" readonly="" min="0" id="jumlah_tabungan" name="jumlah_saldo" class="form-control" value="<?php echo $jumlah_tabungan ?>" placeholder="Jumlah (Rp)"  >

								<div class="input-group-append">

									<span class="input-group-text">Kg</span>

								</div>

							</div>



							<span id="saldokurang" style="display:none; color:red"> Maaf saldo anda tidak cukup </span></br>



							<label>Jumlah Sedekah :</label>

							<div class="input-group mb-4">

								<input type="number" min="0" step="any" id="jumlah_uang" name="jumlah2" class="form-control" placeholder="Jumlah Sedekah" >								

								<div class="input-group-append">

									<span class="input-group-text">Kg</span>

								</div>

							</div>

								

						</div>



						<div id="nontabungan">

							<label>Jumlah Sedekah :</label>

							<div class="input-group mb-4">

							<input type="number" min="0" step="any" id="jumlah_uang2" name="jumlah" placeholder="Jumlah Sedekah" required="" class="form-control" >

							<div class="input-group-append">

								<span class="input-group-text">Kg</span>

							</div>

							</div>

						</div>

							<label>Alamat : </label>

							<div>

								<small>Geser pin map sesuai alamat</small>

								<div class="mampus">	

									<div class="input-group" id="search">		

										<input type="text" class="form-control" value="" id="addr" placeholder="Cari alamat">

									    <div class="input-group-prepend">

									      <button type="button" class="btn btn-color white m-0 btn-sm z-depth-0" onclick="addr_search();showResult();" style="border-radius: 0 .25rem .25rem 0; z-index: 1">Cari</button>

									    </div>

									</div>

									<div id="results" class="border rounded p-2 grey lighten-4"></div>

									<div class="rounded my-3" id="map" style="z-index: 1"></div>

									<div class="form-group row d-none">

										<div class="col"><input type="text" readonly="" class="form-control" id="lat" name="lat2" value=""></div>

										<div class="col"><input type="text" readonly="" class="form-control" id="lon" name="lng2" value=""></div>

									</div>

									<textarea id="address" class="form-control mb-3" name="alamat" required=""><?php echo $alamat ?></textarea>

									<?php include('../maps/maps-in-data.php'); ?>

								</div>

							</div>



						    <button class="btn btn-color btn-block m-0" name="subsedekah" type="submit">Kirim</button>

						</form>

						

					</div>

					

						<?php

						}

						else

						{	

							include('../partials/silahkan-login.php');

						}

						?>

					

				</div>

			</div>

		</div>

	</div>

</section>

<?php include('../partials/footer.php'); ?>

<?php include('../partials/js.php'); ?>



<!-- ////// radion button -->

<script>

	$(document).ready(function(){

		$("input[name$='from']").click(function(){

			var test = $(this).val();

			$("div.desc").hide();

			$("#c" + test).show();

		})

	})

</script>



<!-- ////// konversi beras -->

<script>

$('input').keyup(function(){



	var jumlah_uang = parseFloat($('#jumlah_uang').val());

	var saldo = <?php echo json_encode($jumlah_tabungan);  ?>;

	var saldonum = Number(saldo);



	if(jumlah_uang > saldonum)

	{

		console.log("lebih");

		$('#saldokurang').show();

	}

	else

	{

		console.log("kurang");

		$('#saldokurang').hide();

		var tabungan = <?php echo json_encode($jumlah_tabungan);  ?>;

		var totalharga = ((tabungan-jumlah_uang).toFixed(2));

		document.getElementById('jumlah_tabungan').value = totalharga;

	}



})

</script>



<script>



	$(document).ready(function() {

	$('input[type="radio"]').click(function() {

	if($(this).attr('id') == 'radionontabungan') {

		$('#nontabungan').show();

		$('#tabungan').hide();

		document.getElementById("jumlah_uang").required = false; 

		document.getElementById("jumlah_tabungan").required = false; 

		document.getElementById("jumlah").required = true;             

	}

	if($(this).attr('id') == 'radiotabungan') {

		$('#nontabungan').hide();

		$('#tabungan').show();

		document.getElementById("jumlah_uang").required = true; 

		document.getElementById("jumlah_tabungan").required = true;

		document.getElementById("jumlah").required = false; 

	}

	});

	});



</script>



</body>

</html>