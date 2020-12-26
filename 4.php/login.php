<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $sandi = md5($_POST['sandi']);

 
  $login = mysqli_query($login,"SELECT `no_user`, `nama` FROM `tb_user` WHERE `email`='$email' and `sandi`='$sandi'");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
  <div class="navigasi">
    <li><a href="index.php">Home</a></li>
  </div>
  <div class="sidebar">
    <p>Anda diwajibkan untuk login terlebih dahulu sebelum mengakses beranda sosialmediaku.com</p>
  </div>
  <div class="content">
    <p>Form Login User</p>
    <form method="post">
      <p>Email :</p>
      <input name="email" type="email" placeholder="Masukkan Email" />
      <p>Sandi :</p>
      <input name="sandi" type="password" placeholder="Masukkan Sandi"/>
      <p><button type="submit" name="login">Login</button> Belum mempunyai akun ? <a href="daftar.php">Daftar</a></p>
    </form>
  </div>
   <?php if(mysqli_num_rows($login)=='0'){
    echo '<script>alert(\'Email dan kata sandi salah!\');</script>';
  } else {
    $data = mysqli_fetch_array($login);
    $_SESSION['no'] = $data['no_user'];
    header('location: index.php');
  }
}
?>
</body>
</html>