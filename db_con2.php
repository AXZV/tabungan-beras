<?php
include 'env.php';
$db=mysqli_connect($host,$username,$password) or die ("koneksi salah");
$db_select=mysqli_select_db($db,$databasename) or die ("database salah");
?>