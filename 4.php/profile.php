<?php
session_start();
include 'koneksi.php';
if (!$_SESSION['no']) {
  header('location: login.php');
}
$data = mysqli_fetch_array(mysql_query("SELECT * FROM `tb_user` WHERE `no_user`='" . $_SESSION['no'] . "'"));
if (!$_GET) {
  $profile = mysqli_fetch_array(mysql_query("SELECT * FROM `tb_user` WHERE `no_user`='" . $_SESSION['no'] . "'"));
} else {
  $profile = mysqli_fetch_array(mysql_query("SELECT * FROM `tb_user` WHERE `no_user`='" . $_GET['id'] . "'"));
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

 

  <title>Profile <?php echo $data['nama']; ?> - Pemula Belajar</title>
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
  <p>Profile <?php if ((@$_GET['id']==$_SESSION['no']) or (!@$_GET['id'])) { echo '| <a href="edit_profile.php">Edit Profile</a>' ; }?></p>
  <hr />
  <img src="profile.png" width="80px" height="80px" style="float: left; margin: 20px" />
  <p><b>Nama Lengkap</b> : <?php echo $profile['nama'] ?></p>
  <p><b>Alamat Lengkap</b> : <?php echo $profile['alamat'] ?></p>
  <p><b>Tentang</b> : <?php echo $profile['tentang'] ?></p>
  </div>
</body>
</html>
