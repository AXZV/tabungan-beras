<?php 
include('../db_con.php');
// REGISTER USER
if (isset($_POST['reguser'])) {

$username = mysqli_real_escape_string($db, $_POST['username']);
$password = mysqli_real_escape_string($db, $_POST['password']);
$password2 = mysqli_real_escape_string($db, $_POST['password2']);
$nohp = mysqli_real_escape_string($db, $_POST['nohp']);
$namalengkap = mysqli_real_escape_string($db, $_POST['namalengkap']);
$noktp = mysqli_real_escape_string($db, $_POST['noktp']);
$alamat = mysqli_real_escape_string($db, $_POST['alamat']);
$lat = mysqli_real_escape_string($db, $_POST['lat2']);
$lng = mysqli_real_escape_string($db, $_POST['lng2']);
$email = mysqli_real_escape_string($db, $_POST['email']);

////// check validasi pass
if ($password == $password2)
{
    $passwordbetul = 1;
    $_SESSION['passwordbetul1'] = $passwordbetul;

    $passmd5 = md5($password);
}
else
{
    $passwordbetul = 0;
    $_SESSION['passwordbetul1'] = $passwordbetul;
}
////// check duplikasi username dan no tlp
    $user_check_query = "SELECT * FROM akun_user WHERE username='$username'";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user['username'] === $username) 
    {
        $_SESSION['errorusername1'] = 1;
        $username_betul = 0;
    }
    else
    {
        $_SESSION['errorusername1'] = 0;
        $username_betul = 1;
    }

////// check duplikasi  no tlp
$usernohp_check_query = "SELECT * FROM akun_user WHERE no_hp='$nohp'";
$resultnohp = mysqli_query($db, $usernohp_check_query);
$usernohp = mysqli_fetch_assoc($resultnohp);

    if ($usernohp['no_hp'] === $nohp) 
    {
        $_SESSION['errornohp1'] = 1;
        $notpl_betul = 0;
    }
    else
    {
        $_SESSION['errornohp1'] = 0;
        $notpl_betul = 1;
    }
    

/// input data ke DB
if ($passwordbetul == 1 && $notpl_betul == 1 && $username_betul == 1)
{
    session_unset();

    $_SESSION['formerror1'] = 0;
    // user_id
    $date = date("dm");
    $newhp = substr($nohp,-2);
    $rand = substr(md5(microtime()),rand(0,26),4);
    $id_user = $date.$rand.$newhp;
    // date_create
    $datecreate = date("d M Y");
    // no_tabungan
    $seed = str_split('0123456789');
    shuffle($seed);
    $randseed = '';
    foreach (array_rand($seed, 5) as $k) $randseed.= $seed[$k];
    $notabungan = $randseed.$date.$newhp;
    // saldo
    $saldo = 0;
    // role
    $role = "user";

    $sql="INSERT INTO akun_user(
        id_user,
        username,
        password,
        user_email,
        nama,
        no_hp,
        date_create,
        no_tabungan,
        saldo,
        alamat,
        lat,
        lng,
        no_ktp,
        role) 
    VALUES (
        '$id_user',
        '$username',
        '$passmd5',
        '$email',
        '$namalengkap',
        '$nohp',
        '$datecreate',
        '$notabungan',
        '$saldo',
        '$alamat',
        '$lat',
        '$lng',
        '$noktp',
        '$role'
        )";
    $query=mysqli_query($db,$sql);
    if($query)
        {
            $f= null;
            $sql2="INSERT INTO log_status(
                id_user,
                s_tabungan,
                id_transaksi_tabungan,
                s_sedekah,
                id_transaksi_sedekah,
                s_penarikan,
                id_transaksi_penarikan) 
            VALUES (
                '$id_user',
                'clear',
                '$f',
                'clear',
                '$f',
                'clear',
                '$f'
                )";
            $query2=mysqli_query($db,$sql2);
            if($query2)
            {
                $_SESSION['s_user_id'] = $id_user;
                header('Location:../profile/index.php');
            }
        }
    else
        {
            echo "gagal";
        }
        $_SESSION['formerror1']=0;
}
else
{
    $_SESSION['formerror1']=1;
    
    $_SESSION['username1'] = $username;
    $_SESSION['password1'] = $password;
    $_SESSION['password21'] = $password2;
    $_SESSION['nohp1'] = $nohp;
    $_SESSION['namalengkap1'] = $namalengkap;
    $_SESSION['noktp1'] = $noktp;
    $_SESSION['alamat1'] = $alamat;
    $_SESSION['email1'] = $email;

    header('Location:index.php') ;
}

}


 ?>