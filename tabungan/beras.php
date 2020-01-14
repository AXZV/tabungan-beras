<?php
include('../db_con.php');
if (isset($_SESSION['s_user_id']))
{

	$id_user = $_SESSION['s_user_id'];
	$query = "SELECT * FROM akun_user WHERE id_user='$id_user'";
	$results = mysqli_query($db, $query) or die (mysqli_error());
	$data=mysqli_fetch_array($results);
	$alamat=$data['alamat'];
	$lat=$data['lat'];
	$lng=$data['lng'];


	$query2 = "SELECT * FROM log_status WHERE id_user='$id_user'";
	$results2 = mysqli_query($db, $query2) or die (mysqli_error());
	$data2=mysqli_fetch_array($results2);
	

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tabungan Beras</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="icon" href="favicon/favicon.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon"/>
	<meta name="theme-color" content="#4AB616">
	<script type="text/javascript" src="../partials/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../asset/css/radiobuttonsedekah.css">
	<?php include('../partials/css.php'); ?>
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
					<a href="../tabungan/beras" class="black-text active-tab-2">
						<div class="media mb-3">
						  <img class="d-flex mr-3 border rounded p-1 grey lighten-3" width="70" src="https://image.flaticon.com/icons/svg/306/306670.svg" alt="Generic placeholder image">
						  <div class="media-body">
						    <h5 class="mt-0 font-weight-bold font-color">Tabungan Beras</h5>
						    Anda dapat menabungkan beras anda disini.
						  </div>
						</div>
					</a>
					<hr>
					<a href="../tabungan/uang" class="black-text active-tab-2">
						<div class="media mb-3">
						  <img class="d-flex mr-3" width="70" src="https://image.flaticon.com/icons/svg/1138/1138548.svg" alt="Generic placeholder image">
						  <div class="media-body">
						    <h5 class="mt-0 font-weight-bold font-color">Tabungan Uang</h5>
						    Anda dapat menabungkan uang anda dengan nominal yang ditentukan, yang akan kami konversi ke beras.
						  </div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-8 col-sm-12 px-0 px-sm-0 px-md-0 px-lg-3 px-xl-3">
				<div class="card">
					<div class="card-header">
						<h5 class="mb-0 font-weight-bold">Tabungan Beras</h5>
					</div>
					<?php
					if (isset($_SESSION['s_user_id']))
					{
						if($data2['s_tabungan'] == 'notclear')
						{	 
							include('detail_transaksi.php');
						} 
						else
						{
					?>
					<div class="card-body">
						<form method="post" action="proses_tabungan_beras.php">
							<div class='switch mb-4 d-flex'>
								<div class='quality'>
									<input type="radio" id="radiocod" name="radiob" checked value="cod">
									<label for='radiocod'>Cash On Delivery (COD)</label>
								</div>
								<div class='quality'>
									<input type="radio" id="radiotransfer" name="radiob" value="noncod">
									<label for='radiotransfer'>Antar Ke Kantor</label>
								</div>
							</div>
							<label>Jumlah :</label>
							<div class="input-group mb-1" id="jmlhdiv">
								<input type="text" step="any" id="jumlah" name="jumlah" placeholder="Jumlah" required="" class="form-control" >
								<div class="input-group-append">
									<span class="input-group-text">Kg</span>
								</div>
							</div>
							<div class="mb-4" id="keterangan">
								<small style="color:red">  " Untuk menggunakan layanan COD minimal transaksi penabungan 500 Kg "</small>
							</div>


							<label>Kategori :</label>
							<select class="browser-default custom-select mb-4" name="kategori" required="">
						        <option value="" disabled selected="">Kategori</option>
						        <option value="beras_baru">Beras Baru</option>
						        <option value="beras_lama">Beras Lama</option>
						    </select>
							<div id="coddiv">
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
										<textarea id="address" class="form-control mb-3" name="alamat"><?php echo $alamat ?></textarea>
										<?php include('../maps/maps-in-data.php'); ?>
									</div>
								</div>
							</div>

						    <button class="btn btn-color btn-block m-0" disabled id="kirim" name="subtabungan" type="submit">Kirim</button>
							<button class="btn btn-color btn-block m-0" style="display:none;" id="kirim2" name="subtabungan" type="submit">Kirim</button>

						</form>
					</div>
					<?php
							}
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

<script type="text/javascript" src="../function/fungsi.js"></script>

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

<script>
	$('input').keyup(function(){

		$('#jumlah').on('keyup',function() {
			var xx = $(this).val();
			mincod(xx, 500);
		});

	})
</script>

<script>

	$(document).ready(function() {
	$('input[type="radio"]').click(function() {
	if($(this).attr('id') == 'radiocod') {
		$('#coddiv').show();
		$('#keterangan').show();
		$("#jmlhdiv").removeClass("mb-4");
		$("#jmlhdiv").addClass("mb-1");
		$('#kirim').show();
		$('#kirim2').hide();
		document.getElementById("address").required = true;
		
		$('#jumlah').on('keyup',function() {
			var xx = $(this).val();
			mincod(xx, 500);
		});

	}
	if($(this).attr('id') == 'radiotransfer') {
		$('#coddiv').hide();
		$('#keterangan').hide();
		$("#jmlhdiv").addClass("mb-4");
		$("#jmlhdiv").removeClass("mb-1");
		$('#kirim').hide();
		$('#kirim2').show();
		document.getElementById("address").required = false;
		
		$('#jumlah').on('keyup',function() {
			var xx = $(this).val();
			mincod(xx, 1);
		});
	}
	});
	});
</script>

<!-- ////// Format angka -->
<script>
	var rupiah = document.getElementById("jumlah");
	rupiah.addEventListener("keyup", function(e) {
	rupiah.value = formatRupiah(this.value, "Rp. ");
	});
</script>


</body>
</html>