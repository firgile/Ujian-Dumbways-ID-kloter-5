<?php
session_start();
include 'koneksi.php';
if (!$_SESSION['no']) {
  header('location: login.php');
}
$no = $_SESSION['no'];
$data = mysqli_fetch_array(mysqli_query("SELECT * FROM `tb_user` WHERE `no_user`='" . $_SESSION['no'] . "'"));
if (isset($_POST['ubah'])) {
  if (($_POST['nama']=='') or ($_POST['email']=='') or ($_POST['alamat']=='') or ($_POST['tentang']=='')) {
    echo '<script>alert(\'Pastikan data diri tidak ada yang kosong!\');history.go(-1);</script>';
  } else {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $tentang = $_POST['tentang'];
    $update = mysql_query("UPDATE `tb_user` SET `nama`='$nama',`email`='$email',`alamat`='$alamat',`tentang`='$tentang' WHERE `no_user`='" .$_SESSION['no']. "'");
    echo '<script>alert(\'Profile berhasil diubah!\');history.go(-1);</script>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Profile - Pemula Belajar</title>
  <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
  <div class="header">
    Mediasosialku.com
  </div>
  <div class="navigasi">
    <li><a href="index.php">Home</a></li>
    <li><a href="profile.php?id=<?php echo $_SESSION['no']; ?>">Profile</a></li>
    <li><a href="keluar.php">Keluar</a></li>
  </div>
  <div class="sidebar">
    <p>Profile Saya</p>
    <img src="profile.png" width="60px" height="60px" style="float: left; margin-right: 10px;" />
    <p><?php
    echo '<a href="profile.php?id=' . $_SESSION['no'] . '">' . $data['nama'] . '</a>';
    ?></p>
    <p><?php
    $tentang = mysql_fetch_array(mysql_query("SELECT `tentang` FROM `tb_user` WHERE `no_user`='" . $_SESSION['no'] . "'"));
    echo $tentang['tentang'];
    ?></p>
  </div>
  <div class="content">
  <p>Edit Profile | <a href="edit_sandi.php">Ganti Sandi ?</a></p>
  <hr />
    <form method="post">
    <?php
      $data = mysql_fetch_assoc(mysql_query("SELECT * FROM `tb_user` WHERE `no_user`='$no'"));
        echo '<p>Nama Lengkap :</p>';
        echo '<input type="text" name="nama" placeholder="Nama Lengkap" value="' .$data['nama']. '" />';
        echo '<p>Email :</p>';
        echo '<input type="email" name="email" placeholder="Email" value="' .$data['email']. '" />';
        echo '<p>Alamat :</p>';
        echo '<textarea name="alamat" placeholder="Alamat Lengkap">' .$data['alamat']. '</textarea>';
        echo '<p>Tentang Saya :</p>';
        echo '<textarea name="tentang" placeholder="Tentang Saya">' .$data['tentang']. '</textarea>';
      ?>
      <p><button type="submit" name="ubah">Ubah</button> <a href="profile.php?id=<?php echo $_SESSION['no']?>">Batal</a></p>
    </form>
  </div>
</body>
</html>
