<?php
include('../db_con2.php');
if (isset($_SESSION['s_user_id']))
{
  $id_user= $_SESSION['s_user_id'];
  echo("<script>console.log('PHP: " . "session id : ". $id_user . "');</script>");

  //// ambil nama depan pengguna
    $query = "SELECT * FROM akun_user WHERE id_user='$id_user'";
    $results = mysqli_query($db, $query) or die (mysqli_error());
    $data=mysqli_fetch_array($results);

    $namalkp = $data['nama'];
    $namapengguna = strtok($namalkp, " ");

}
else
{
  $id_user = null;
  echo("<script>console.log('PHP: " . "session id : ". "null" . "');</script>");
}

?>
    <nav class="navbar navbar-expand-lg navbar-dark transparent sticky-top background-color-1" style="z-index: 100">
    <a class="navbar-brand" href="../index"><!-- <i class="fas fa-balance-scale"></i> --><span style="font-family: 'Righteous', cursive; letter-spacing: 1px"> Tabungan Beras</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
      aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
      <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="../tabungan/beras"><i class="fas fa-money-bill-wave"></i> Tabungan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../penarikan/beras"><i class="fab fa-get-pocket"></i> Penarikan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../sedekah/beras"><i class="fas fa-donate"></i> Sedekah</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../tentang"><i class="fa fa-address-card"></i> Tentang Kami</a>
      </li>
      <?php
      if($id_user == null) { ?>
        <li class="nav-item">
          <a class="nav-link" href="../login"><i class="fa fa-sign-in-alt"></i> Masuk</a>
        </li>
      <?php }
      if ($id_user != null) {?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?php echo $namapengguna ?></a>
          <div class="dropdown-menu dropdown-primary dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="../profile"><i class="fa fa-user grey-text"></i> Profile</a>
            <a class="dropdown-item" data-toggle="modal" data-target="#basicExampleModal"><i class="fa fa-sign-out-alt grey-text"></i> Keluar</a>
          </div>
        </li>
      <?php } ?>
    </ul>
  </div>
</nav>

<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Keluar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span>Apakah anda yakin akan keluar?</span>
      </div>
      <div class="modal-footer">
        <a class="btn btn-color" data-dismiss="modal">Batal</a>
        <a href="../login/logout" class="btn btn-danger">Keluar</a>
      </div>
    </div>
  </div>
</div>