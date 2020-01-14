<?php
include('../db_con.php');
include '../function/fungsi.php';
$konv = new konversi;
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

	$finaltotalsaldo = $konv->normal($jumlah_tabungan);


	$query4 = "SELECT SUM(`jumlah_transaksi`) as total FROM log_penarikan WHERE status='belum_diverifikasi' AND id_user='$id_user'";
	$results4 = mysqli_query($db, $query4) or die (mysqli_error());
	$row4=mysqli_fetch_array($results4);
	$totaltabungan = round($row4['total'], 2);
	
	$finaltotalsaldo2 = $konv->normal($totaltabungan);

	
	$query21 = "SELECT * FROM log_status WHERE id_user='$id_user'";
	$results21 = mysqli_query($db, $query21) or die (mysqli_error());
	$data21=mysqli_fetch_array($results21);

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Penarikan Tabungan</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
	<link rel="manifest" href="../favicon/site.webmanifest">
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
					<div class="heading">
						<h5 class="font-weight-bold font-color">Kategori</h5>
						<hr>
					</div>
					<a href="#" class="black-text active-tab-2">
						<div class="media mb-3">
						  <img class="d-flex mr-3 border rounded p-1 grey lighten-3" width="70" src="../asset/image/icon/mny-1.svg" alt="Generic placeholder image">
						  <div class="media-body desk">
						    <h5 class="mt-0 font-weight-bold font-color">Penarikan Tabungan</h5>
						    Anda dapat melakukan penarikan pada tabungan anda.
						  </div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-8 col-sm-12 px-0 px-sm-0 px-md-0 px-lg-3 px-xl-3">
				<div class="card">
					<div class="card-header">
						<h5 class="mb-0 font-weight-bold">Penarikan Tabungan</h5>
					</div>
					<?php
					if (isset($_SESSION['s_user_id']))
					{
						if($data21['s_penarikan'] == 'notclear')
						{
							include('detail_transaksi.php');
						} 
						else 
						{
					?>
							<div class="card-body">
								<form method="post" id="formfield" action="proses_penarikan.php">
								<div class="mb-2">
									<p class="mb-2">Metode Transaksi :</p>
									<div class="alert alert-warning" role="alert">
										<small>* Pilih COD untuk mengambil tabungan di rumah atau di tempat lain</small><br>
										<small>* Pilih Kantor untuk mengambil tabungan langsung ke kantor</small>
									</div>
								</div>
								<div class='switch mb-4'><div class='quality'>
									<input type="radio" id="radionontabungan" name="radiob" checked value="cod">
									<label for='radionontabungan'>COD</label>
								</div><div class='quality'>
									<input type="radio" id="radiotabungan" name="radiob" value="noncod">
									<label for='radiotabungan'>Kantor</label>
								</div>
								</div>
								<div>
									<label>Jumlah Saldo Tabungan Anda :</label>
									<div class="input-group mb-2">
										<input type="text" readonly="" min="0" id="jumlah_tabungan" name="jumlah_saldo" class="form-control" value="<?php echo $finaltotalsaldo ?>" placeholder="Jumlah (Rp)"  >
										<div class="input-group-append">
											<span class="input-group-text">Kg</span>
										</div>
									</div>
									<span id="saldokurang" style="display:none; color:red"> Maaf saldo anda tidak cukup </span></br>
									<label>Jumlah Penarikan:</label>
									<div class="input-group mb-4">
										<input type="text" required="" id="jumlah_transaksi" name="jumlah_transaksi" class="form-control" placeholder="Jumlah Penarikan" >								
										<div class="input-group-append">
											<span class="input-group-text">Kg</span>
										</div>
									</div>
								</div>
								<div id="nontabungan">
									<label>Alamat : </label>
									<div>
										<small><span class="red-text font-weight-bold">*</span> Geser pin map sesuai alamat</small>
										<div class="mampus">	
											<div class="input-group" id="search">		
												<input type="text" class="form-control" value="" id="addr" placeholder="Cari alamat" >
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
											<textarea id="address" class="form-control mb-3" name="alamat" ><?php echo $alamat ?></textarea>
											<?php include('../maps/maps-in-data.php'); ?>
										</div>
									</div>
								</div>
									<!-- <input type="button" id="btnmdl" value="kirim" class="btn-color form-control"  data-toggle="modal" data-target="#modalpengaturanadmin"></input> -->
									<button class="btn btn-color btn-block m-0" id="bpenarikan" name="penarikan" type="submit">Kirim</button>
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
	var rupiah = document.getElementById("jumlah_transaksi");
	rupiah.addEventListener("keyup", function(e) {

		var jmlh_uang = this.value;
		var vals = jmlh_uang.replace(/\./g,''); /// hapus .
    	var vals2 = vals.replace(/\,/g,'.'); /// ganti , menjadi .
		var jmlh_uangnum = Number(vals2);

		var saldo = <?php echo json_encode($jumlah_tabungan);  ?>;
		var saldonum = Number(saldo);
		
		if(jmlh_uangnum > saldonum)
		{
			$('#saldokurang').show();
			$('#bpenarikan').attr('disabled', true);
		}
		else
		{
			$('#saldokurang').hide();
			var totalharga = ((saldo-jmlh_uangnum).toFixed(2));
			document.getElementById('jumlah_tabungan').value = rubahangka(totalharga);
			$('#bpenarikan').attr('disabled', false);
		}

	});
</script>
<!-- ////// konversi beras -->
<script>
	$(document).ready(function() {
	$('input[type="radio"]').click(function() {
	if($(this).attr('id') == 'radionontabungan') {
		$('#nontabungan').show();
		document.getElementById("address").required = true; 
		// $('#tabungan').hide();
		// document.getElementById("jumlah_uang").required = false; 
		// document.getElementById("jumlah_tabungan").required = false; 
		// document.getElementById("jumlah").required = true;             
	}

	if($(this).attr('id') == 'radiotabungan') {
		$('#nontabungan').hide();
		document.getElementById("address").required = false; 
		// $('#tabungan').show();
		// document.getElementById("jumlah_uang").required = true; 
		// document.getElementById("jumlah_tabungan").required = true;
		// document.getElementById("jumlah").required = false; 
	}
	});
	});
</script>

<!-- ////// Format angka -->
<script>
	var rupiah = document.getElementById("jumlah_transaksi");
	rupiah.addEventListener("keyup", function(e) {
	rupiah.value = formatRupiah(this.value, "Rp. ");
	});
</script>

</body>
</html>	