<?php 

include('../db_con.php');
// REGISTER USER
if (isset($_POST['subtabungan'])) {
    $id_user= $_SESSION['s_user_id'];

    $date = date("dm");
    $rand = substr(md5(microtime()),rand(0,26),6);

    $id_transaksi = $date.$id_user.$rand."_tabungan";
    $tanggal_transaksi = date("d M Y");
    $jumlah_beras = mysqli_real_escape_string($db, $_POST['jumlah']);
    $jumlah_uang =null;
    $jenis_transaksi = "beras";
    $kategori = mysqli_real_escape_string($db, $_POST['kategori']);
    $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
    $lat = mysqli_real_escape_string($db, $_POST['lat2']);
    $lng = mysqli_real_escape_string($db, $_POST['lng2']);
    $status = "belum_diverifikasi";
    $radiobutton = mysqli_real_escape_string($db, $_POST['radiob']);


    if($radiobutton == "cod")
    {
        $jenis_pembayaran = "COD";
    }
    else if($radiobutton == "noncod")
    {
        $jenis_pembayaran = "Antar ke Kantor";
    }
    


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

    $id_user= $_SESSION['s_user_id'];

    $date = date("dm");
    $rand = substr(md5(microtime()),rand(0,26),6);

    $id_transaksi = $date.$id_user.$rand."_tabungan";
    $tanggal_transaksi = date("d M Y");
    $jumlah_beras = mysqli_real_escape_string($db, $_POST['jumlah_beras']);
    $jumlah_uang = mysqli_real_escape_string($db, $_POST['jumlah']);
    $jenis_transaksi = "uang";
    $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
    $lat = mysqli_real_escape_string($db, $_POST['lat2']);
    $lng = mysqli_real_escape_string($db, $_POST['lng2']);
    $status = "belum_diverifikasi";

    $radiobutton = mysqli_real_escape_string($db, $_POST['radiob']);
    $b = str_replace('.', '', $jumlah_uang );

    echo("<script>console.log('PHP: " . $alamat . "');</script>");

    if($radiobutton == "cod")
    {
        $newfilename=null;
        $jenis_pembayaran = "COD";
    }
    else if($radiobutton == "noncod")
    {
        $newfilename=null;
        $jenis_pembayaran = "Antar ke Kantor";
    }
    else if($radiobutton == "transfer")
    {
        $jenis_pembayaran = "Transfer";
        $temp = explode(".", $_FILES['buktitf']["name"]);
        $newfilename = $id_transaksi.'.'.end($temp);
        move_uploaded_file($_FILES["buktitf"]["tmp_name"],"../asset/image/log_transfer_tabungan/".$newfilename);
        
    }

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
        bukti_tf,
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
        '$newfilename',
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


?>