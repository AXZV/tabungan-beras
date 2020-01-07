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

	$query2 = "SELECT * FROM harga_beras WHERE id=1";
	$results2 = mysqli_query($db, $query2) or die (mysqli_error());
	$data2=mysqli_fetch_array($results2);

	$harga=$data2['harga_beras'];
	$query2 = "SELECT * FROM harga_beras WHERE id=1";
	$results2 = mysqli_query($db, $query2) or die (mysqli_error());
	$data2=mysqli_fetch_array($results2);

	$harga=$data2['harga_beras'];


	function harga($harga){
		
		$hasil_rupiah = number_format($harga,2,',','.');
		return $hasil_rupiah;
	 
	}
	
	$query3 = "SELECT * FROM akun_admin WHERE id_admin='99'";
	$results3 = mysqli_query($db, $query3) or die (mysqli_error());
	$data3=mysqli_fetch_array($results3);

	$norek=$data3['nomor_rekening'];
	$bank=$data3['bank'];
	$pemilik_rek=$data3['pemilik_rekening'];

	$query21 = "SELECT * FROM log_status WHERE id_user='$id_user'";
	$results21 = mysqli_query($db, $query21) or die (mysqli_error());
	$data21=mysqli_fetch_array($results21);

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sedekah Uang</title>
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
						  <img class="d-flex mr-3" width="70" src="https://image.flaticon.com/icons/svg/306/306670.svg" alt="Generic placeholder image">
						  <div class="media-body">
						    <h5 class="mt-0 font-weight-bold font-color">Sedekah Beras</h5>
						    Anda dapat membantu orang lain dengan menyedekahkan beras yang ingin anda sedekahkan, akan kami salurkan kepada pihak yang membutuhkan dan bekerjasama dengan kami, dan kami konfirmasikan kepada anda setelah penyaluran sedekah telah dilakukan.
						  </div>
						</div>
					</a>
					<hr>
					<a href="../sedekah/uang" class="black-text active-tab-2">
						<div class="media mb-3">
						  <img class="d-flex mr-3 border rounded p-1 grey lighten-3" width="70" src="https://image.flaticon.com/icons/svg/1138/1138548.svg" alt="Generic placeholder image">
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
						<h5 class="mb-0 font-weight-bold">Sedekah Uang</h5>
					</div>
					<?php
					if (isset($_SESSION['s_user_id']))
					{
					if($data21['s_sedekah'] == 'notclear')
						{	
							include('detail_transaksi.php');
						 } else { ?>
							<div class="card-body">
								<form method="post" action="proses_sedekah_beras.php" enctype="multipart/form-data">
									
									<div class='switch mb-4 d-flex'>
										<div class='quality'>
											<input type="radio" id="radiononcod" name="radiob" value="noncod">
											<label for='radiononcod'>Antar Ke Kantor</label>
										</div>
										<div class='quality'>
											<input type="radio" id="radiocod" name="radiob" checked value="cod">
											<label for='radiocod'>Cash On Delivery (COD)</label>
										</div>
										<div class='quality'>
											<input type="radio" id="radiotransfer" name="radiob" value="transfer">
											<label for='radiotransfer'>Transfer</label>
										</div>
									</div>

									<div id="transferdiv" style="display:none;">
										<label>Nomor Rekening :</label>
										<div class="input-group mb-1">
											<div class="input-group-prepend">
												<span class="input-group-text" style="text-transform: uppercase;"><?php echo $bank ?></span>
											</div>
											<input type="text" readonly="" min="0" id="norek" name="norek" class="form-control" value="<?php echo $norek ?>"  required="">
											<div class="input-group-append">
												<span class="input-group-text">an. <?php echo $pemilik_rek ?></span>
											</div>
										</div>
										<small class=" mb-4"> * Silahkan lakukan transfer ke nomor rekening diatas, lalu upload bukti transfer pada form dibawah ini</small><br><br>
									</div>

									<label>Jumlah Sedekah :</label>
									<div class="input-group mb-4">
										<input type="text" id="jumlah_uang" name="jumlah" class="form-control" placeholder="Jumlah Sedekah" required="" >
										<div class="input-group-append">
											<span class="input-group-text">Kg</span>
										</div>
									</div>

									
									<div class="form-row">
										<div class="col-sm-12 col-lg-6 mb-3 mb-lg-0 mb-xl-0">
											<label>Harga Patokan Beras :</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">Rp.</span>
												</div>
												<input type="text" id="harga" readonly="" value="<?php echo harga($harga); ?>" class="form-control" placeholder="First name">
												<div class="input-group-append">
													<span class="input-group-text">/Kg</span>
												</div>
											</div>
										</div>
										<div class="col-sm-12 col-lg-6">
											<label>Hasil Konfersi Ke Beras :</label>
											<div class="input-group mb-4">
												<input type="text" readonly="" min="0" id="jumlah_beras2" name="jumlah_beras" class="form-control" placeholder="Jumlah" required="">
											<div class="input-group-append">
												<span class="input-group-text">Kg</span>
											</div>
											</div>
										
										</div>
									</div>
									
									<div id="transferdiv2" style="display:none;">
										<p class="mb-0">Bukti Transfer : </p>
										<img class="img-fluid mb-3 rounded" style="max-height: 150px;" id="img-upload">
										<div class="input-group mb-3">
										<div class="custom-file">
											<input type="file" class="custom-file-input btn-file" id="buktitf"
											aria-describedby="inputGroupFileAddon01" name="buktitf">
											<label class="custom-file-label" for="buktitf">Choose file</label>
										</div>
										</div>
									</div>
									
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
												<textarea id="address" class="form-control mb-3" name="alamat" required=""><?php echo $alamat ?></textarea>
												<?php include('../maps/maps-in-data.php'); ?>
											</div>
										</div>
									</div>

									<button class="btn btn-color btn-block m-0" name="uangsedekah" type="submit">Kirim</button>
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

<!-- ////// konversi beras -->
<script>
	$('input').keyup(function(){
		// var jumlah_uang = parseFloat($('#jumlah_uang').val());
		var jumlah_uang = $('#jumlah_uang').val();
		var b = jumlah_uang.split('.').join("");

		$('#jumlah_beras').html(b/10000);
		var hargaberas = <?php echo json_encode($harga);  ?>;
		var totalharga = ((b/hargaberas).toFixed(2));
		document.getElementById('jumlah_beras2').value = totalharga;
	})


</script>

<script>

	$(document).ready(function() {
	$('input[type="radio"]').click(function() {
	if($(this).attr('id') == 'radiocod') {
		$('#coddiv').show();
		$('#coddiv2').show();
		$('#transferdiv').hide();
		$('#transferdiv2').hide();
		
		document.getElementById("address").required = true;  
		document.getElementById("buktitf").required = false;              
	}
	if($(this).attr('id') == 'radiononcod') {
		$('#coddiv').hide();
		$('#coddiv2').show();
		$('#transferdiv').hide();
		$('#transferdiv2').hide();
		document.getElementById("address").required = false;  
		document.getElementById("buktitf").required = false;              
	}
	if($(this).attr('id') == 'radiotransfer') {
		$('#coddiv').hide();
		$('#coddiv2').hide();
		$('#transferdiv').show();
		$('#transferdiv2').show();
		document.getElementById("address").required = false;  
		document.getElementById("buktitf").required = true;           
	}
	});
	});

</script>
<!-- img upload -->
<script type="text/javascript">
  $(document).ready( function() {
      $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
      
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#buktitf").change(function(){
        readURL(this);
    });   
  });
</script>

<script>
	var rupiah = document.getElementById("jumlah_uang");
	rupiah.addEventListener("keyup", function(e) {
	// tambahkan 'Rp.' pada saat form di ketik
	// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
	rupiah.value = formatRupiah(this.value, "Rp. ");
	});

	/* Fungsi formatRupiah */
	function formatRupiah(angka, prefix) {
	var number_string = angka.replace(/[^,\d]/g, "").toString(),
		split = number_string.split(","),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if (ribuan) {
		separator = sisa ? "." : "";
		rupiah += separator + ribuan.join(".");
	}

	rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
	return prefix == undefined ? rupiah : rupiah ? rupiah : "";
	}

</script>
</body>
</html>