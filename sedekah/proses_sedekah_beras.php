<?php 

include('../db_con.php');
include '../function/fungsi.php';
$konvrs = new konversi;

// REGISTER USER
if (isset($_POST['subsedekah'])) {
    $id_user= $_SESSION['s_user_id'];
    $date = date("dm");
    $rand = substr(md5(microtime()),rand(0,26),6);

    $id_transaksi = $date.$id_user.$rand."_sedekah";
    $tanggal_transaksi = date("d M Y");
    $jumlah_uang =null;
    $jenis_transaksi = "beras";

    $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
    $lat = mysqli_real_escape_string($db, $_POST['lat2']);
    $lng = mysqli_real_escape_string($db, $_POST['lng2']);
    $status = "belum_diverifikasi";
    $bukti_tf = null;
    $radiobutton = mysqli_real_escape_string($db, $_POST['radiob']);

    $jmlh = mysqli_real_escape_string($db, $_POST['jumlah']);
    $jumlah_beras  = $konvrs->nonnormal($jmlh);


    $tanggal_penyaluran = "-";
    
    if($radiobutton == "nontabungan")
    {
        $jenis_pembayaran = "COD";
    }
    else if($radiobutton == "noncod")
    {
        $jenis_pembayaran = "Antar ke Kantor";
    }
    else if($radiobutton == "tabungan")
    {
        $jenis_pembayaran = "Ambil dari Tabungan";    
    }

    $sql="INSERT INTO log_sedekah(
        id_transaksi,
        id_user,
        tanggal_transaksi,
        tanggal_penyaluran,
        jumlah_transaksi_beras,
        jumlah_transaksi_uang,
        jenis_transaksi,
        sedekah_dari,
        jenis_pembayaran,
        alamat,
        bukti_tf,
        lat,
        lng,
        status) 
    VALUES (
        '$id_transaksi',
        '$id_user',
        '$tanggal_transaksi',
        '$tanggal_penyaluran',
        '$jumlah_beras',
        '$jumlah_uang',
        '$jenis_transaksi',
        '$radiobutton',
        '$jenis_pembayaran',
        '$alamat',
        '$bukti_tf',
        '$lat',
        '$lng',
        '$status')";
    $query=mysqli_query($db,$sql) or die (mysqli_error($db)); 
    if($query)
        {            
            $sql2="UPDATE log_status SET
            s_sedekah='notclear',
            id_transaksi_sedekah='$id_transaksi'
            WHERE id_user='$id_user'";
            $query2=mysqli_query($db,$sql2);
            if ($query2) 
            {
                header('Location:../profile/index.php');
                $_SESSION['sedekah'] = 1;
            }
        }


}

else if (isset($_POST['uangsedekah'])) {

    $id_user= $_SESSION['s_user_id'];

    $date = date("dm");
    $rand = substr(md5(microtime()),rand(0,26),6);

    $id_transaksi = $date.$id_user.$rand."_sedekah";
    $tanggal_transaksi = date("d M Y");
    $jumlah_beras = mysqli_real_escape_string($db, $_POST['jumlah_beras']);
    $jumlah_uang = mysqli_real_escape_string($db, $_POST['jumlah']);
    $jenis_transaksi = "uang";
    $sedekah_dari= "nontabungan";
    $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
    $lat = mysqli_real_escape_string($db, $_POST['lat2']);
    $lng = mysqli_real_escape_string($db, $_POST['lng2']);
    $status = "belum_diverifikasi";

    $radiobutton = mysqli_real_escape_string($db, $_POST['radiob']);
    $b = str_replace('.', '', $jumlah_uang );

    $tanggal_penyaluran = "-";

    if($radiobutton == "cod")
    {
        $newfilename=null;
        $jenis_pembayaran = "COD";
    }
    if($radiobutton == "noncod")
    {
        $newfilename=null;
        $jenis_pembayaran = "Antar ke Kantor";
    }
    if($radiobutton == "transfer")
    {
        $jenis_pembayaran = "Transfer";
        $temp = explode(".", $_FILES['buktitf']["name"]);
        $newfilename = $id_transaksi.'.'.end($temp);
        move_uploaded_file($_FILES["buktitf"]["tmp_name"],"../asset/image/log_transfer_sedekah/".$newfilename);
    }
    echo("<script>console.log('PHPxx: " . $jenis_pembayaran . "');</script>");
    $sql="INSERT INTO log_sedekah(
        id_transaksi,
        id_user,
        tanggal_transaksi,
        tanggal_penyaluran,
        jumlah_transaksi_beras,
        jumlah_transaksi_uang,
        jenis_transaksi,
        sedekah_dari,
        jenis_pembayaran,
        alamat,
        bukti_tf,
        lat,
        lng,
        status) 
    VALUES (
        '$id_transaksi',
        '$id_user',
        '$tanggal_transaksi',
        '$tanggal_penyaluran',
        '$jumlah_beras',
        '$b',
        '$jenis_transaksi',
        '$sedekah_dari',
        '$jenis_pembayaran',
        '$alamat',
        '$newfilename',
        '$lat',
        '$lng',
        '$status')";
    $query=mysqli_query($db,$sql) or die (mysqli_error($db)); 
    if($query)
    {
        $sql2="UPDATE log_status SET
        s_sedekah='notclear',
        id_transaksi_sedekah='$id_transaksi'
        WHERE id_user='$id_user'";
        $query2=mysqli_query($db,$sql2);
        if ($query2) 
        {
            header('Location:../profile/index.php');
            $_SESSION['sedekah'] = 1;
        }
    }

}


?>