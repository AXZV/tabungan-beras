<?php 
$id_user = $_SESSION['s_user_id'];
function matauang($jumlah_transaksi)
	{
		$totaltabungan = $jumlah_transaksi;
		//////////////////////  char dot dot 
		if (strpos($totaltabungan, '.') !== false) {
			$b2=strstr($totaltabungan, '.', true);
			$removecoma2 = str_replace('.', '', $b2 );
			$takedecimal2 =  substr($totaltabungan, strpos($totaltabungan, ".") + 1); 
		}
		else
		{
			$removecoma2 = $totaltabungan;
			$takedecimal2 = null;
		}
		$hasil_rupiah2 = number_format($removecoma2,0,'','.');
		if (strpos($totaltabungan, '.') !== false) {
			$finaltotalsaldo2=$hasil_rupiah2.",".$takedecimal2;
		}
		else
		{
			$finaltotalsaldo2=$hasil_rupiah2;
		}
		// echo("<script>console.log('PHP: " . $finaltotalsaldo2 . "');</script>");
		return $finaltotalsaldo2;
		//////////////////////////////////////
	}

	$query2 = "SELECT * FROM log_status WHERE id_user='$id_user'";
	$results2 = mysqli_query($db, $query2) or die (mysqli_error());
	$data2=mysqli_fetch_array($results2);

	if ($data2['s_sedekah'] == 'notclear')
	{
		$id_trans = $data2['id_transaksi_sedekah'];
		$query3 = "SELECT * FROM log_sedekah WHERE id_transaksi='$id_trans'";
		$results3 = mysqli_query($db, $query3) or die (mysqli_error());
		$data3=mysqli_fetch_array($results3);

		if($data3['jenis_transaksi'] == 'beras')
		{
			$jumlah_transaksi = $data3['jumlah_transaksi_beras'];
		}
		else
		{
			$jumlah_transaksi = $data3['jumlah_transaksi_uang'];
		}

			
    }

?>

<div class="card-body">
    <p>Maaf anda belum bisa melakukan transaksi sedekah dikarenakan transkasi anda dengan detail</p>

    <div class="form-row">
        <div class="col-sm-12 col-lg-6 mb-3 mb-lg-0 mb-xl-0">
            <label>Nomor Transaksi :</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">No.</span>
                </div>
                <input type="text"  readonly="" value="<?php echo $data2['id_transaksi_sedekah']; ?>" class="form-control" >
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <label>Tanggal Transaksi :</label>
            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text">Tgl.</span>
                </div>
                <input type="text"  readonly="" value="<?php echo $data3['tanggal_transaksi']; ?>" class="form-control" >
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-sm-12 col-lg-6 mb-3 mb-lg-0 mb-xl-0">
            <label>Jenis Tabungan :</label>
            <div class="input-group">
                <input type="text"  readonly="" value="<?php echo $data3['jenis_transaksi']; ?>" class="form-control" >
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <label>Jumlah Transaksi :</label>
            <div class="input-group mb-4">

                <?php if($data3['jenis_transaksi'] == 'uang')
                { ?>
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                </div>
                <?php } ?>
                    <input type="text"  readonly="" value="<?php echo  matauang($jumlah_transaksi) ?>" class="form-control" >
                <?php if($data3['jenis_transaksi'] == 'beras')
                { ?>
                <div class="input-group-append">
                    <span class="input-group-text">Kg</span>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <p> belum diproses, silahkan hubungi admin </p>

</div>