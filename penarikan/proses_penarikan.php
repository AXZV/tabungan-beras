<?php 

include('../db_con.php');
// REGISTER USER
if (isset($_POST['penarikan'])) {
    $id_user= $_SESSION['s_user_id'];

    $date = date("dm");
    $rand = substr(md5(microtime()),rand(0,26),6);
    $id_transaksi = $date.$id_user.$rand."_penarikan";


    $radiobutton = mysqli_real_escape_string($db, $_POST['radiob']);
    $jumlah_transaksi = mysqli_real_escape_string($db, $_POST['jumlah_transaksi']);
    $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
    $lat = mysqli_real_escape_string($db, $_POST['lat2']);
    $lng = mysqli_real_escape_string($db, $_POST['lng2']);
    $tanggal_transaksi = date("d M Y");
    $status = "belum_diverifikasi";

    if($radiobutton == "cod")
    {
        $jenis_transaksi="COD";
    }
    else if($radiobutton == "noncod")
    {
        $jenis_transaksi="Ambil di kantor";
    }


    $sql="INSERT INTO log_penarikan(
        id_transaksi,
        id_user,
        jenis_transaksi,
        jumlah_transaksi,
        alamat,
        lat,
        lng,
        tanggal_transaksi,
        status) 
    VALUES (
        '$id_transaksi',
        '$id_user',
        '$jenis_transaksi',
        '$jumlah_transaksi',
        '$alamat',
        '$lat',
        '$lng',
        '$tanggal_transaksi',
        '$status')";
    $query=mysqli_query($db,$sql);
    if($query)
        {
            $sql2="UPDATE log_status SET
            s_penarikan='notclear',
            id_transaksi_penarikan='$id_transaksi'
            WHERE id_user='$id_user'";
            $query2=mysqli_query($db,$sql2);
            if ($query2) 
            {
                header('Location:../profile/index.php');
                $_SESSION['jenistransaksi'] = $jenis_transaksi;
                $_SESSION['penarikan'] = 1;
            }
        }

}




?>