<?php

    $crud = new crud;
    $konvrs = new konversi;
    
	$data2=$crud->get('log_status', 'id_user', $id_user);

	if ($data2['s_tabungan'] == 'notclear')
	{
		$id_trans = $data2['id_transaksi_tabungan'];
		$data3=$crud->get('log_tabungan', 'id_transaksi', $id_trans);

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
    <div class="alert alert-warning" role="alert">
        <span>Maaf anda belum bisa melakukan transaksi tabungan dikarenakan transkasi anda dengan detail sebagai berikut belum diproses, silahkan hubungi admin jika mengalami kendala.</span>
    </div>
<div class="form-row">
    <div class="col-sm-12 col-lg-6 mb-3 mb-lg-0 mb-xl-0">
        <label>Nomor Transaksi :</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">No.</span>
            </div>
            <input type="text"  readonly="" value="<?php echo $data2['id_transaksi_tabungan']; ?>" class="form-control" >
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
                <input type="text"  readonly="" value="<?php echo  $konvrs->normal($jumlah_transaksi) ?>" class="form-control" >
            <?php if($data3['jenis_transaksi'] == 'beras')
            { ?>
            <div class="input-group-append">
                <span class="input-group-text">Kg</span>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php 

if($data3['jenis_pembayaran'] == 'Transfer') 
{ 
    $data_transaksi = $data3['id_transaksi'];
    $status_transaksi = $midtrans->get_status_transaction($data_transaksi);

    $data4=$crud->get('log_transaksi_nontunai', 'id_transaksi',  $data_transaksi);
    $expire_day = date('d F Y H:i:s', strtotime($data4['tanggal_expired']));

    ?>
    <div class="alert alert-danger" role="alert">
        <span>Segera lakukan pembayaran sebelum <?php echo $expire_day ?></span>
    </div>
        <a class="btn btn-color btn-block m-0" id="myLink" href="<?php echo $data4['detail_pembayaran']; ?>" target="_blank">Cara membayar</a>
    </div>
<?php } ?>