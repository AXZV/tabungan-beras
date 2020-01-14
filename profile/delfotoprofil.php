<?php
        include('../db_con.php');
        $id_user= $_SESSION['s_user_id'];

        $imgnamepng=$id_user.".png";
        $imgnamejpeg=$id_user.".jpeg";
        $imgnamejpg=$id_user.".jpg";

        if (file_exists('../asset/image/user_profile_pic/'.$imgnamepng ))
        {
            echo("<script>console.log('PHP: " . "ffff png". "');</script>");
            chmod('../asset/image/user_profile_pic/'.$imgnamepng,0755);
            unlink('../asset/image/user_profile_pic/'.$imgnamepng);
            delimage();
        }
        elseif (file_exists("../asset/image/user_profile_pic/".$imgnamejpeg ))
        {
            echo("<script>console.log('PHP: " . "ffff jpeg". "');</script>");
            chmod('../asset/image/user_profile_pic/'.$imgnamejpeg,0755);
            unlink('../asset/image/user_profile_pic/'.$imgnamejpeg);
            delimage();

        }
        elseif (file_exists("../asset/image/user_profile_pic/".$imgnamejpg ))
        {
            echo("<script>console.log('PHP: " . "ffff jpg". "');</script>");
            chmod('../asset/image/user_profile_pic/'.$imgnamejpg,0755);
            unlink('../asset/image/user_profile_pic/'.$imgnamejpg);
            delimage();
        }

    function delimage()
    {
        include('../db_con.php');
        $id_user= $_SESSION['s_user_id'];
        $sql="UPDATE akun_user SET fotoprofil=null WHERE id_user='$id_user'";
        $query=mysqli_query($db,$sql) or die (mysqli_error());
        if ($query) 
        {
            header("location:index");
        }
        
    };

?>