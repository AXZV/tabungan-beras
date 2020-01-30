<?php 

include('../db_con2.php');
include '../function/fungsi.php';
include '../function/midtrans.php';
$konvrs = new konversi;
$midtrans = new Midtrans\midtransx;
$crud   = new crud;

    $id_user= $_SESSION['s_user_id'];
    $tanggal_transaksi = date("d M Y");

    function jenis_pembayaran($radiobutton)
    {
        if($radiobutton == "cod")
        {
            return "COD";
        }
        else if($radiobutton == "noncod")
        {
            return "Antar ke Kantor";
        }
        else if($radiobutton == "transfer")
        {
            return "Transfer";
        }
    }

// REGISTER USER
if (isset($_POST['subtabungan'])) {

    $jmlh = mysqli_real_escape_string($db, $_POST['jumlah']);
    $jumlah_beras = $konvrs->nonnormal($jmlh);

    $jumlah_uang =null;//
    $jenis_transaksi = "beras";//
    $kategori = mysqli_real_escape_string($db, $_POST['kategori']);
    $alamat = mysqli_real_escape_string($db, $_POST['alamat']);//
    $lat = mysqli_real_escape_string($db, $_POST['lat2']);//
    $lng = mysqli_real_escape_string($db, $_POST['lng2']);//
    $status = "belum_diverifikasi";
    $radiobutton = mysqli_real_escape_string($db, $_POST['radiob']);//

    $jenis_pembayaran = jenis_pembayaran($radiobutton);//
    


    $sql="INSERT INTO log_tabungan(
        id_transaksi,
        id_user,
        tanggal_transaksi,
        jumlah_transaksi_beras,
        jumlah_transaksi_uang,
        kategori,
        jenis_transaksi,
        jenis_pembayaran,
        alamat,
        lat,
        lng,
        status) 
    VALUES (
        '$id_transaksi',
        '$id_user',
        '$tanggal_transaksi',
        '$jumlah_beras',
        '$jumlah_uang',
        '$kategori',
        '$jenis_transaksi',
        '$jenis_pembayaran',
        '$alamat',
        '$lat',
        '$lng',
        '$status')";
    $query=mysqli_query($db,$sql);
    if($query)
        {
            $sql2="UPDATE log_status SET
            s_tabungan='notclear',
            id_transaksi_tabungan='$id_transaksi'
            WHERE id_user='$id_user'";
            $query2=mysqli_query($db,$sql2);
            if ($query2) 
            {
                header('Location:../profile/index.php');
                $_SESSION['tabungan'] = 1;
            }
        }

}

else if (isset($_POST['uangtabungan'])) {

    $jmlh = mysqli_real_escape_string($db, $_POST['jumlah_beras']);
    $jumlah_beras = $konvrs->nonnormal($jmlh);

    $jumlah_uang = mysqli_real_escape_string($db, $_POST['jumlah']);
    $jenis_transaksi = "uang";
    $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
    $lat = mysqli_real_escape_string($db, $_POST['lat2']);
    $lng = mysqli_real_escape_string($db, $_POST['lng2']);
    $status = "belum_diverifikasi";

    $radiobutton = mysqli_real_escape_string($db, $_POST['radiob']);
    $b = str_replace('.', '', $jumlah_uang );

    $jenis_pembayaran = jenis_pembayaran($radiobutton);


    $sql="INSERT INTO log_tabungan(
        id_transaksi,
        id_user,
        tanggal_transaksi,
        jumlah_transaksi_beras,
        jumlah_transaksi_uang,
        kategori,
        jenis_transaksi,
        jenis_pembayaran,
        alamat,
        lat,
        lng,
        status) 
    VALUES (
        '$id_transaksi',
        '$id_user',
        '$tanggal_transaksi',
        '$jumlah_beras',
        '$b',
        '$kategori',
        '$jenis_transaksi',
        '$jenis_pembayaran',
        '$alamat',
        '$lat',
        '$lng',
        '$status')";
    $query=mysqli_query($db,$sql);
    if($query)
    {
        $sql2="UPDATE log_status SET
        s_tabungan='notclear',
        id_transaksi_tabungan='$id_transaksi'
        WHERE id_user='$id_user'";
        $query2=mysqli_query($db,$sql2);
        if ($query2) 
        {
            header('Location:../profile/index.php');
            $_SESSION['tabungan'] = 1;
        }
    }

}

else if (isset($_POST['nontunai']))
{

    $id_transaksi = $crud->id_transaksi($id_user)."_tabungan";

    $jmlh = mysqli_real_escape_string($db, $_POST['jumlah_beras']);
    $jumlah_beras = $konvrs->nonnormal($jmlh);

    $jumlah_uang1 = mysqli_real_escape_string($db, $_POST['jumlah']);
    $jumlah_uang = str_replace('.', '', $jumlah_uang1 );

    $jenis_transaksi = "uang";
    $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
    $lat = mysqli_real_escape_string($db, $_POST['lat2']);
    $lng = mysqli_real_escape_string($db, $_POST['lng2']);
    $status = "belum_diverifikasi";

    $radiobutton = mysqli_real_escape_string($db, $_POST['radiob']);

    $nama = mysqli_real_escape_string($db, $_POST['nama']);
    $tlp = mysqli_real_escape_string($db, $_POST['tlp']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    
    $jenis_pembayaran = jenis_pembayaran($radiobutton);

    $data_transaksi = array(
        'nama'                 => $nama,
        'tlp'                  => $tlp,
        'email'                => $email,
        'id_transaksi'         => $id_transaksi,
        'id_user'              => $id_user,
        'tanggal_transaksi'    => $tanggal_transaksi,
        'jumlah_beras'         => $jumlah_beras,
        'jumlah_uang'          => $jumlah_uang,
        'jenis_transaksi'      => $jenis_transaksi,
        'jenis_pembayaran'     => $jenis_pembayaran,
        'alamat'               => $alamat,
        'lat'                  => $lat,
        'lng'                  => $lng,
        'status'               => $status
    );
    $midtrans->snap_pay($data_transaksi);

}



?>