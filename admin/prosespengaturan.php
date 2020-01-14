<?php
include '../db_con.php';

$id_admin= $_SESSION['s_admin_id'];

//////////////////////////  PENGETURAN PROFIL.PHP ///////////////////////////////////
if (isset($_POST['pengaturanprofil'])) {

    $nama = mysqli_real_escape_string($db, $_POST['nama']);
    $nohp = mysqli_real_escape_string($db, $_POST['nohp']);

    $sql="UPDATE akun_admin SET
    nama='$nama',
    no_hp='$nohp'
    WHERE id_admin='$id_admin'";
    $query=mysqli_query($db,$sql) or die (mysqli_error($db));
    if ($query) 
    {
        header("location: profil");
    }

}

//////////////////////////  PENGETURAN akun.PHP ///////////////////////////////////
if (isset($_POST['pengaturanakun'])) {

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);

    $sql="UPDATE akun_admin SET
    username='$username',
    email='$email'
    WHERE id_admin='$id_admin'";
    $query=mysqli_query($db,$sql) or die (mysqli_error($db));
    if ($query) 
    {
        header("location: profil");
    }

}

//////////////////////////  PENGETURAN PASSWORD.PHP ///////////////////////////////////
if (isset($_POST['pengaturanpassword'])) {

    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);
    $pasmd5 = md5($password);
    if ($password == $password2)
    {
        $sql="UPDATE akun_admin SET
        password='$pasmd5'
        WHERE id_admin='$id_admin'";
        $query=mysqli_query($db,$sql) or die (mysqli_error($db));
        if ($query) 
        {
            header("location: profil");
        }

    }
    else
    {
        header("location: profil?p=e");
    }

}

//////////////////////////  HAPUS PENGGUNA ///////////////////////////////////
if (isset($_POST['hapus_user'])) {

    $id = $_POST['hapus_user'];

    $query = "DELETE FROM akun_user WHERE id_user='$id'";
    $results = mysqli_query($db, $query) or die (mysqli_error());
    if ($results) 
    {
        header("location:pengguna");
    }
}

//////////////////////////  KONFIRMASI TABUNGAN ///////////////////////////////////
if (isset($_POST['konfirmasi_tabungan'])) {

    $id_transaksi = $_POST['konfirmasi_tabungan'];
    $saldo = $_POST['saldo'];
    $id_userx = $_POST['id_user'];
    $jumlah_transaksi = $_POST['jumlah_transaksi'];

    echo("<script>console.log('PHPRR: " . $saldo ." x ".$jumlah_transaksi. "');</script>");
    $sql="UPDATE log_tabungan SET status='sudah_diverifikasi'WHERE id_transaksi='$id_transaksi'";
    $query=mysqli_query($db,$sql) or die (mysqli_error($db));
    if ($query) 
    {
        echo("<script>console.log('PHPRR: " . " y ". "');</script>");
        $total_saldo_baru = $saldo + $jumlah_transaksi;

        $sql2="UPDATE akun_user SET saldo='$total_saldo_baru' WHERE id_user='$id_userx'";
        $query2=mysqli_query($db,$sql2) or die (mysqli_error($db));
        if ($query2) 
        {

            $n = null;
            $sql3="UPDATE log_status SET
            s_tabungan='clear',
            id_transaksi_tabungan='$n'
            WHERE id_user='$id_userx'";
            $query3=mysqli_query($db,$sql3);
            if ($query3) 
            {
                header("location: notifikasi");
            }
        }
    }

}


//////////////////////////  KONFIRMASI SEDEKAH ///////////////////////////////////
    if (isset($_POST['konfirmasisedekah']))
    {

        $id_transaksi = $_POST['konfirmasisedekah'];
        $sedekah_dari = $_POST['sedekah_dari'];
        $saldo = $_POST['saldo'];
        $id_userx = $_POST['id_user'];
        $jumlah_transaksi_beras = $_POST['jumlah_transaksi'];

        $sql="UPDATE log_sedekah SET status='sudah_diverifikasi' WHERE id_transaksi='$id_transaksi'";
        $query=mysqli_query($db,$sql) or die (mysqli_error($db));
        if ($query) 
        {
            if ($sedekah_dari == "tabungan")
            {


                $total_saldo_baru = $saldo - $jumlah_transaksi_beras;

                echo("<script>console.log('PHPRR: " . " y ". $id_userx . " y ". $total_saldo_baru. "');</script>");

                $sql2="UPDATE akun_user SET saldo='$total_saldo_baru' WHERE id_user='$id_userx'";
                $query2=mysqli_query($db,$sql2) or die (mysqli_error($db));
                if ($query2) 
                {
                    echo("<script>console.log('PHPRR: " . " x " . "');</script>");

                    $n = null;
                    $sql3="UPDATE log_status SET
                    s_sedekah='clear',
                    id_transaksi_sedekah='$n'
                    WHERE id_user='$id_userx'";
                    $query3=mysqli_query($db,$sql3);
                    if ($query3) 
                    {
                        header("location: sedekah");
                    }
                }
            }
            else
            {
                $n = null;
                $sql3="UPDATE log_status SET
                s_sedekah='clear',
                id_transaksi_sedekah='$n'
                WHERE id_user='$id_userx'";
                $query3=mysqli_query($db,$sql3);
                if ($query3) 
                {
                    header("location: sedekah");
                }
            }

        }

    }

//////////////////////////  KONFIRMASI PENARIKAN ///////////////////////////////////
    if (isset($_POST['konfirmasipenarikan']))
    {
        echo("<script>console.log('PHPRR: " . " x ". "');</script>");

        $id_transaksi = $_POST['konfirmasipenarikan'];
        $saldo = $_POST['saldo'];
        $id_userx = $_POST['id_user'];
        $jumlah_transaksi = $_POST['jumlah_transaksi'];

        $sql="UPDATE log_penarikan SET status='sudah_diverifikasi' WHERE id_transaksi='$id_transaksi'";
        $query=mysqli_query($db,$sql) or die (mysqli_error($db));
        if ($query) 
        {

                $total_saldo_baru = $saldo - $jumlah_transaksi;

                $sql2="UPDATE akun_user SET saldo='$total_saldo_baru' WHERE id_user='$id_userx'";
                $query2=mysqli_query($db,$sql2) or die (mysqli_error($db));
                if ($query2) 
                {
                    $n = null;
                    $sql3="UPDATE log_status SET
                    s_penarikan='clear',
                    id_transaksi_penarikan='$n'
                    WHERE id_user='$id_userx'";
                    $query3=mysqli_query($db,$sql3);
                    if ($query3) 
                    {
                        header("location: penarikan");
                    }
                }


        }

    }





?>