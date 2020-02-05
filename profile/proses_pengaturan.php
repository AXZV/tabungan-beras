<?php
include '../db_con.php';

//////////////////////////  PENGETURAN PROFIL.PHP ///////////////////////////////////

    if (isset($_POST['pengaturanprofil'])) {



    $namalengkap = mysqli_real_escape_string($db, $_POST['namalengkap']);

    $noktp = mysqli_real_escape_string($db, $_POST['noktp']);

    $alamat = mysqli_real_escape_string($db, $_POST['alamat']);

    $lat = mysqli_real_escape_string($db, $_POST['lat2']);

    $lng = mysqli_real_escape_string($db, $_POST['lng2']);



    $id_user= $_SESSION['s_user_id'];



    $getdatauser = "SELECT * FROM akun_user WHERE id_user=$id_user";

    $resultdata = mysqli_query($db, $getdatauser);

    $data_user = mysqli_fetch_assoc($resultdata);





    ////// check duplikasi username dan no tlp

        $user_check_query = "SELECT * FROM akun_user WHERE no_ktp='$noktp'";

        $result = mysqli_query($db, $user_check_query);

        $user = mysqli_fetch_assoc($result);

        if ($user) 

        {

            if ( $noktp == $data_user['no_ktp'])

            {

                $_SESSION['errornoktp'] = 0;

                $noktp_betul = true;

                echo("<script>console.log('PHP: " . "ada duplikat no ktp dengan akun" . "');</script>");

            }

            if ( $noktp != $data_user['no_ktp'] )

            {

                $_SESSION['errornoktp'] = 1;

                $noktp_betul = false;

                echo("<script>console.log('PHP: " . "ada duplikat no ktp dengan lain" . "');</script>");   

            }



            echo("<script>console.log('PHP: " . "ada duplikat no ktp" . "');</script>");

        }

        else

        {

            $_SESSION['errornoktp'] = 0;

            $noktp_betul = true;

            echo("<script>console.log('PHP: " . "tidak ada duplikat no ktp" . "');</script>");

        }



    /// input data ke DB

    if ($noktp_betul == true)

    {

        $_SESSION['formerror']=0;

        $_SESSION['formprofilerror']=0;

        $sql="UPDATE akun_user SET

            nama='$namalengkap',

            alamat='$alamat',

            no_ktp='$noktp',

            lat='$lat',

            lng='$lng'

        WHERE id_user='$id_user'";

        $query=mysqli_query($db,$sql);

        if ($query) 

        {

            header("location: pengaturan.php");

        }



        unset($_SESSION['formerror']);

        unset($_SESSION['formprofilerror']);



    }

    else

    {

        $_SESSION['formerror']=1;

        $_SESSION['formprofilerror']=1;



        $_SESSION['username'] = $data_user['username'];

        $_SESSION['password'] = $data_user['password'];

        $_SESSION['password2'] = $data_user['password'];

        $_SESSION['nohp'] = $data_user['no_hp'];

        $_SESSION['namalengkap'] = $namalengkap;

        $_SESSION['noktp'] = $noktp;

        $_SESSION['alamat'] = $alamat;

        $_SESSION['email'] = $data_user['user_email'];



        header('Location:pengaturan.php') ;

    }



    }





//////////////////////////  PENGETURAN akun.PHP ///////////////////////////////////

    if (isset($_POST['pengaturanakun'])) {

    $username = mysqli_real_escape_string($db, $_POST['username']);

    $nohp = mysqli_real_escape_string($db, $_POST['nohp']);

    $email = mysqli_real_escape_string($db, $_POST['email']);



 

    $id_user= $_SESSION['s_user_id'];



    $getdatauser = "SELECT * FROM akun_user WHERE id_user=$id_user";

    $resultdata = mysqli_query($db, $getdatauser);

    $data_user = mysqli_fetch_assoc($resultdata);



    // echo("<script>console.log('PHP: " . $data_user['username'] . "');</script>");





    ////// check duplikasi username

        $user_check_query = "SELECT * FROM akun_user WHERE username='$username'";

        $result = mysqli_query($db, $user_check_query);

        $user = mysqli_fetch_assoc($result);

        if ($user) 

        {

            if ( $username == $data_user['username'])

            {

                $_SESSION['errorusername'] = 0;

                $username_betul = true;

                echo("<script>console.log('PHP: " . "ada duplikat username dengan akun" . "');</script>");

            }

            if ( $username != $data_user['username'] )

            {

                $_SESSION['errorusername'] = 1;

                $username_betul = false;

                echo("<script>console.log('PHP: " . "ada duplikat username dengan lain" . "');</script>");   

            }



            echo("<script>console.log('PHP: " . "ada duplikat username" . "');</script>");

        }

        else

        {

            $_SESSION['errorusername'] = 0;

            $username_betul = true;

            echo("<script>console.log('PHP: " . "tidak ada duplikat username dengan lain" . "');</script>");

        }



    ////// check duplikasi no tlp

        $usernohp_check_query = "SELECT * FROM akun_user WHERE no_hp='$nohp'";

        $resultnohp = mysqli_query($db, $usernohp_check_query);

        $usernohp = mysqli_fetch_assoc($resultnohp);

        if ($usernohp) 

        {

            if ( $nohp == $data_user['no_hp']) 

            {

                $_SESSION['errornohp'] = 0;

                $notpl_betul = true;//

                echo("<script>console.log('PHP: " . "duplikat no hp dengan akun" . "');</script>");

            }

            if ( $nohp != $data_user['no_hp']) 

            {

                $_SESSION['errornohp'] = 1;

                $notpl_betul = false;

                echo("<script>console.log('PHP: " . "duplikat no hp dengan lain" . "');</script>");

            }

            echo("<script>console.log('PHP: " . "ada duplikat no hp" . "');</script>");

        }

        else

        {

            $_SESSION['errornohp'] = 0;

            $notpl_betul = true;//

            echo("<script>console.log('PHP: " . "tidak ada duplikat no hp" . "');</script>");

        }



    /// input data ke DB
    if ($notpl_betul == true && $username_betul == true)
    {
        $_SESSION['formerror']=0;
        $_SESSION['formakunerror']=0;
        $sql="UPDATE akun_user SET
            username='$username',
            user_email='$email',
            no_hp='$nohp',
        WHERE id_user='$id_user'";
        $query=mysqli_query($db,$sql);
        if ($query) 
        {
            header("location: pengaturan.php");
        }
        unset($_SESSION['formerror']);
        unset($_SESSION['formakunerror']);
    }
    else
    {
        $_SESSION['formerror']=1;
        $_SESSION['formakunerror']=0;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $data_user['password'];
        $_SESSION['password2'] = $data_user['password'];
        $_SESSION['nohp'] = $nohp;
        $_SESSION['namalengkap'] = $data_user['nama'];
        $_SESSION['noktp'] = $data_user['no_ktp'];
        $_SESSION['alamat'] = $data_user['alamat'];
        $_SESSION['email'] = $email;
        header('Location:pengaturan.php') ;
    }

    }





//////////////////////////  PENGETURAN PASSWORD.PHP ///////////////////////////////////

 if (isset($_POST['pengaturanpassword'])) {



    $password = mysqli_real_escape_string($db, $_POST['password']);

    $password2 = mysqli_real_escape_string($db, $_POST['password2']);



    $id_user= $_SESSION['s_user_id'];



    $getdatauser = "SELECT * FROM akun_user WHERE id_user=$id_user";

    $resultdata = mysqli_query($db, $getdatauser);

    $data_user = mysqli_fetch_assoc($resultdata);



    // echo("<script>console.log('PHP: " . $data_user['username'] . "');</script>");



    ////// check validasi pass

    if ($password == $password2)

    {

        $passwordbetul = true;

        $passmd5 = md5($password);

        // $_SESSION['passwordbetul'] = $passwordbetul;

        unset($_SESSION['passwordbetul']);

    }

    else

    {

        $passwordbetul = false;

        $_SESSION['passwordbetul'] = $passwordbetul;

    }



    /// input data ke DB

    if ($passwordbetul == true)

    {

        $_SESSION['formerror']=0;

        $_SESSION['formpassworderror']=0;

        $sql="UPDATE akun_user SET password='$passmd5' WHERE id_user='$id_user'";

        $query=mysqli_query($db,$sql);

        if ($query) 

        {

            header("location: pengaturan.php");

        }



        unset($_SESSION['formerror']);

        unset($_SESSION['formpassworderror']);



    }

    else

    {

        $_SESSION['formerror']=1;

        $_SESSION['formpassworderror']=1;

        

        $_SESSION['username'] = $data_user['username'];

        $_SESSION['password'] = $password;

        $_SESSION['password2'] = $password2;

        $_SESSION['nohp'] = $data_user['no_hp'];

        $_SESSION['namalengkap'] = $data_user['nama'];

        $_SESSION['noktp'] = $data_user['no_ktp'];

        $_SESSION['alamat'] = $data_user['alamat'];

        $_SESSION['email'] = $data_user['user_email'];



        header('Location:pengaturan.php') ;

    }



    }

//////////////////////////  hapus_transaksi_penarikan ///////////////////////////////////
    if (isset($_POST['hapus_transaksi_penarikan'])) {

        $id = $_POST['hapus_transaksi_penarikan'];
        $id_userrr=$_POST['iduser'];
        $query = "DELETE FROM log_penarikan WHERE id_transaksi='$id'";
        $results = mysqli_query($db, $query) or die (mysqli_error());
        if ($results) 
        {
            $n = null;
            $sql3="UPDATE log_status SET
            s_penarikan='clear',
            id_transaksi_penarikan='$n'
            WHERE id_user='$id_userrr'";
            $query3=mysqli_query($db,$sql3);
            if ($query3) 
            {
                header("location:riwayat_penarikan.php");
            }
        }
    }
//////////////////////////  hapus_transaksi_tabungan ///////////////////////////////////
    if (isset($_POST['hapus_transaksi_tabungan'])) {

        $id = $_POST['hapus_transaksi_tabungan'];
        $id_userrr=$_POST['iduser'];
        $query = "DELETE FROM log_tabungan WHERE id_transaksi='$id'";
        $results = mysqli_query($db, $query) or die (mysqli_error());
        if ($results) 
        {
            $n = null;
            $sql3="UPDATE log_status SET
            s_tabungan='clear',
            id_transaksi_tabungan='$n'
            WHERE id_user='$id_userrr'";
            $query3=mysqli_query($db,$sql3);
            if ($query3) 
            {
                header("location:riwayat_tabungan.php");
            }

            $queryx = "DELETE FROM log_transaksi_nontunai WHERE id_transaksi='$id'";
            $resultsx = mysqli_query($db, $queryx) or die (mysqli_error());
            if ($resultsx) 
            {  
            }

        }
    }
//////////////////////////  hapus_transaksi_tabungan ///////////////////////////////////
    if (isset($_POST['hapus_transaksi_sedekah'])) {

        $id = $_POST['hapus_transaksi_sedekah'];
        $id_userrr=$_POST['iduser'];
        $query = "DELETE FROM log_sedekah WHERE id_transaksi='$id'";
        $results = mysqli_query($db, $query) or die (mysqli_error());
        if ($results) 
        {
            $n = null;
            $sql3="UPDATE log_status SET
            s_sedekah='clear',
            id_transaksi_sedekah='$n'
            WHERE id_user='$id_userrr'";
            $query3=mysqli_query($db,$sql3);
            if ($query3) 
            {
                header("location:riwayat_sedekah.php");
            }
        }
    }





?>