<?php
include 'koneksi.php';
if (isset($_POST['daftar'])) {
  if (($_POST['nama']=='') or ($_POST['email']=='') or ($_POST['sandi']=='') or ($_POST['alamat']=='') or ($_POST['tentang']=='')) {
    echo '<script>alert(\'Pastikan data diri tidak ada yang kosong!\');history.go(-1);</script>';
  } else {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $sandi = md5($_POST['sandi']);
    $alamat = $_POST['alamat'];
    $tentang = $_POST['tentang'];
    
    if (mysqli_num_rows($email) == 0 ) {
      $sql = "INSERT INTO `tb_user`(`nama`, `email`, `sandi`, `alamat`, `tentang`) VALUES ('$nama','$email','$sandi','$alamat','$tentang')";
      $tambahdata = mysqli_query($sql);
      echo '<script>alert(\'Berhasil mendaftar silahkan login!\');</script>';
    } else {
      echo '<script>alert(\'Email sudah pernah didaftarkan!\');</script>';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrasi di mediasosialku.com</title>
  <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
  <div class="header">
    Registrasi
  </div>
  <div class="navigasi">
    <li><a href="index.php">Home</a></li>
  </div>
  <div class="sidebar">
    <p>Anda diwajibkan untuk registrasi terlebih dahulu untuk bisa mengakses beranda sosialmediaku.com ini. Terima Kasih</p>
  </div>
  <div class="content">
    <div class="title-form-daftar">Masukkan data diri</div>
    <form method="post">
      <p>Nama Lengkap :</p>
      <input type="text" name="nama" placeholder="Nama Lengkap" />
      <p>Email :</p>
      <input type="email" name="email" placeholder="Email" />
      <p>Sandi :</p>
      <input type="password" name="sandi" placeholder="Password" />
      <p>Alamat :</p>
      <textarea name="alamat" placeholder="Alamat Lengkap"></textarea>
      <p>Tentang Saya :</p>
      <textarea name="tentang" placeholder="Tentang Saya"></textarea>
      <p><button type="submit" name="daftar">Daftar</button> Sudah memiliki akun ? <a href="login.php">Masuk</a></p>
    </form>
  </div>
</body>
</html>
