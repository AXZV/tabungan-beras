<?php

    $konvrs = new konversi;
    $crud = new crud;
    
	$data2=$crud->get('log_status', 'id_user', $id_user);

	if ($data2['s_penarikan'] == 'notclear')
	{
		$id_trans = $data2['id_transaksi_penarikan'];
		$data3=$crud->get('log_penarikan', 'id_transaksi',$id_trans);
        $jumlah_transaksi = $data3['jumlah_transaksi'];
	}
?>


<div class="card-body">
<div class="alert alert-warning" role="alert">
    <span>Maaf anda belum bisa melakukan transaksi penarikan dikarenakan transkasi anda dengan detail sebagai berikut belum diproses, silahkan hubungi admin.</span>
</div>
<div class="form-row">
    <div class="col-sm-12 col-lg-6 mb-3 mb-lg-0 mb-xl-0">
        <label>Nomor Transaksi :</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">No.</span>
            </div>
            <input type="text"  readonly="" value="<?php echo $data2['id_transaksi_penarikan']; ?>" class="form-control" >
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
        <label>Jenis Transaksi :</label>
        <div class="input-group">
            <input type="text"  readonly="" value="<?php echo $data3['jenis_transaksi']; ?>" class="form-control" >
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <label>Jumlah Transaksi :</label>
        <div class="input-group mb-4">

            <input type="text"  readonly="" value="<?php echo $konvrs->normal($jumlah_transaksi) ?>" class="form-control" >
            <div class="input-group-append">
                <span class="input-group-text">Kg</span>
            </div>
        </div>
    </div>
</div>

<p> belum diproses, silahkan hubungi admin </p>

</div>