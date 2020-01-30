<?php
include('../db_con2.php');

include '../function/fungsi.php';
include '../function/midtrans.php';
$midtrans = new Midtrans\midtransx;
$crud = new crud;

// $red = $midtrans->get_status_transaction();
// // echo $red;
// var_dump ($red);
// echo $red['store'];

if (isset($_SESSION['s_user_id']))
{
	$id_user = $_SESSION['s_user_id'];

	$data=$crud->get('akun_user', 'id_user', $id_user);

	$alamat=$data['alamat'];
	$lat=$data['lat'];
	$lng=$data['lng'];
	$nama=$data['nama'];
	$tlp=$data['no_hp'];
	if ($data['user_email'] == null)
	{
		$email=null;
	}
	else
	{
		$email=$data['user_email'];
	}


	$data2=$crud->get('harga_beras', 'id', 1);
	$harga=$data2['harga_beras'];
	echo("<script>console.log('xxx: " . $harga. "');</script>");
	function harga($harga){
		$hasil_rupiah = number_format($harga,2,',','.');
		return $hasil_rupiah;
	}

	$data21=$crud->get('log_status', 'id_user', $id_user);

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tabungan Uang</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="icon" href="favicon/favicon.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon"/>
	<meta name="theme-color" content="#4AB616">
	<script type="text/javascript" src="../partials/jquery-3.2.1.min.js"></script>
	<?php include('../partials/css.php'); ?>
	<link rel="stylesheet" type="text/css" href="../asset/css/radiobuttontabungan.css">
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
						  <img class="d-flex mr-3" width="70" src="https://image.flaticon.com/icons/svg/306/306670.svg" alt="Generic placeholder image">
						  <div class="media-body">
						    <h5 class="mt-0 font-weight-bold font-color">Tabungan Beras</h5>
						    Anda dapat menabungkan beras anda disini.
						  </div>
						</div>
					</a>
					<hr>
					<a href="../tabungan/uang" class="black-text active-tab-2">
						<div class="media mb-3">
						  <img class="d-flex mr-3 border rounded p-1 grey lighten-3" width="70" src="https://image.flaticon.com/icons/svg/1138/1138548.svg" alt="Generic placeholder image">
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
						<h5 class="mb-0 font-weight-bold">Tabungan Uang</h5>
					</div>
					<?php
					if (isset($_SESSION['s_user_id']))
					{
						if($data21['s_tabungan'] == 'notclear')
						{	 
							include('detail_transaksi.php');
						} 
						else
						{
					?>
							<div class="card-body">
								<form method="post" action="proses_tabungan_beras.php" enctype="multipart/form-data">

								<div class='switch mb-4 d-flex'>
									<div class='quality'>
										<input type="radio" id="radiononcod" name="radiob" value="noncod">
										<label for='radiononcod'>Antar Ke Kantor</label>
									</div>
									<div class='quality'>
										<input type="radio" id="radiocod" name="radiob" checked  value="cod">
										<label for='radiocod'>Cash On Delivery (COD)</label>
									</div>
									<div class='quality'>
										<input type="radio" id="radiotransfer" name="radiob"  value="transfer">
										<label for='radiotransfer'>Non Tunai</label>
									</div>
								</div>

									<label>Jumlah :</label>
									<div class="input-group mb-1" id="jmlhdiv">
										<div class="input-group-prepend">
											<span class="input-group-text">Rp.</span>
										</div>
										<input type="text" id="jumlah_uang" name="jumlah" placeholder="Jumlah" required="" class="form-control">
									</div>
									<div class="mb-4" id="keterangan">
										<small style="color:red;">  " Untuk menggunakan layanan COD minimal transaksi penabungan Rp. 500.000 (lima ratus ribu rupiah) "</small>
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

									<div id="transferdiv" style="display:none;" >
										<input type="hidden" name="nama" id="nama" value="<?php echo $nama; ?>" class="form-control">
										<input type="hidden" name="tlp" id="tlp" value="<?php echo $tlp; ?>" class="form-control">

										<label>Alamat Email :</label>
										<div class="input-group mb-4" >
											<div class="input-group-prepend">
												<span class="input-group-text">@</span>
											</div>
											<input type="email" name="email" id="email" value="<?php echo $email; ?>" class="form-control">
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

									<button class="btn btn-color btn-block m-0" disabled id="kirim" name="uangtabungan" type="submit">Selesai</button>
									<button class="btn btn-color btn-block m-0" style="display:none;" id="kirim2" name="uangtabungan" type="submit">Selesai</button>
									<button class="btn btn-color btn-block m-0" style="display:none;" id="kirim3" name="nontunai" type="submit">Metode Pembayaran</button>

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

<!-- ////// konversi beras -->
<script>
	$('input').keyup(function(){
		// var jumlah_uang = parseFloat($('#jumlah_uang').val());
		var jumlah_uang = $('#jumlah_uang').val();
		var b = jumlah_uang.split('.').join("");

		$('#jumlah_beras').html(b/10000);
		var hargaberas = <?php echo json_encode($harga);  ?>;
		var totalharga = ((b/hargaberas).toFixed(2));

		document.getElementById('jumlah_beras2').value = rubahangka(totalharga);

		$('#jumlah_uang').on('keyup',function() {
			var xx = $(this).val();
			mincod(xx, 500000);
		});

	})
</script>

<script>

	$(document).ready(function() {

	$('input[type="radio"]').click(function() {
	if($(this).attr('id') == 'radiononcod') {
		$('#kirim2').attr('disabled', false);  

		$('#coddiv').hide();
		$('#coddiv2').show();
		$('#map')
		$('#transferdiv').hide();
		// $('#transferdiv2').hide();
		$('#keterangan').hide();
		$('#kirim').hide();
		$('#kirim2').show();
		$('#kirim3').hide();
		$("#jmlhdiv").addClass("mb-4");
		$("#jmlhdiv").removeClass("mb-1");
		// document.getElementById("buktitf").required = false;
		document.getElementById("email").required = false;

		$('#jumlah_uang').on('keyup',function() {
			var xx = $(this).val();
			mincod(xx, 1);
		});
		            
	}
	if($(this).attr('id') == 'radiocod') {
		
		$('#coddiv').show();
		$('#coddiv2').show();
		$('#transferdiv').hide();
		// $('#transferdiv2').hide();
		$('#keterangan').show();
		$('#kirim2').hide();
		$('#kirim').show();
		$('#kirim3').hide();
		$("#jmlhdiv").addClass("mb-1");
		$("#jmlhdiv").removeClass("mb-4");
		// document.getElementById("buktitf").required = false;
		document.getElementById("email").required = false;
		$('#kirim').attr('disabled', true); 

		$('#jumlah_uang').on('keyup',function() {
			var xx = $(this).val();
			mincod(xx, 500000);
		});

	}
	if($(this).attr('id') == 'radiotransfer') {
		$('#kirim2').attr('disabled', false);  

		$('#coddiv').hide();
		$('#coddiv2').hide();
		$('#transferdiv').show();
		// $('#transferdiv2').show();
		$('#keterangan').hide();
		$('#kirim').hide();
		$('#kirim2').hide();
		$('#kirim3').show();
		$("#jmlhdiv").addClass("mb-4");
		$("#jmlhdiv").removeClass("mb-1");
		// document.getElementById("buktitf").required = true;
		document.getElementById("email").required = true;
		$('#jumlah_uang').on('keyup',function() {
			var xx = $(this).val();
			mincod(xx, 1);
		});
          
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
	rupiah.value = formatRupiah(this.value, "Rp. ");
	});
</script>




</body>
</html>