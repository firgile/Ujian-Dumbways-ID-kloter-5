<?php
session_start();
include 'koneksi.php';
if (!$_SESSION['no']) {
  header('location: login.php');
}
$no = $_SESSION['no'];
$data = mysql_fetch_array(mysql_query("SELECT * FROM `tb_user` WHERE `no_user`='" . $_SESSION['no'] . "'"));
if (isset($_POST['ubah'])) {
  if (($_POST['oldpass']=='') or ($_POST['newpass']=='') or ($_POST['connewpass']=='')) {
    echo '<script>alert(\'Pastikan sandi tidak ada yang kosong!\');history.go(-1);</script>';
  } else {
    $oldpass = md5($_POST['oldpass']);
    $newpass = md5($_POST['newpass']);
    $connewpass = md5($_POST['connewpass']);
    if ($data['sandi'] == $oldpass) {
      if ($newpass == $connewpass) {
        mysql_query("UPDATE `tb_user` SET `sandi`='$newpass' WHERE `no_user`='$no'");
        session_destroy();
        echo '<script>alert(\'Kata sandi berhasil diubah. Silahkan login kembali!\');history.go(-1);</script>';
      } else {
        echo '<script>alert(\'Kata sandi baru tidak cocok!\');history.go(-1);</script>';
      }
    } else {
      echo '<script>alert(\'Kata sandi salah!\');history.go(-1);</script>';
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
  <title>Edit Sandi - Pemula Belajar</title>
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
  <p>Ganti Sandi | <a href="edit_profile.php">Edit Profile ?</a></p>
  <hr />
    <form method="post">
    <?php
      $data = mysql_fetch_assoc(mysql_query("SELECT * FROM `tb_user` WHERE `no_user`='$no'"));
        echo '<p>Sandi Lama :</p>';
        echo '<input type="password" name="oldpass" placeholder="Sandi Lama" />';
        echo '<p>Sandi Baru :</p>';
        echo '<input type="password" name="newpass" placeholder="Sandi Baru" />';
        echo '<p>Ulangi Sandi Baru :</p>';
        echo '<input type="password" name="connewpass" placeholder="Ulangi Sandi Baru" />';
      ?>
      <p><button type="submit" name="ubah">Ubah Sandi</button> <a href="profile.php?id=<?php echo $_SESSION['no']?>">Batal</a></p>
    </form>
  </div>
</body>
</html>