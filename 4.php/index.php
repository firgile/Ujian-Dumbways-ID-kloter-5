<?php
session_start();
include 'koneksi.php';
if (!$_SESSION['no']) {
  header('location: login.php');
}
$nouser = $_SESSION['no'];
$data = mysqli_fetch_array(mysql_query("SELECT * FROM `tb_user` WHERE `no_user`='" . $_SESSION['no'] . "'"));
if (isset($_POST['kirim'])) {
  $status = $_POST['status'];
  $tanggal = date('Y-m-d H:i:s');
  mysqli_query("INSERT INTO `tb_timeline`(`no_user`, `status`, `tanggal`) VALUES ('$nouser','$status','$tanggal')");
}
?>
<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<style>
	section{
		min-height:420px;
	}
</style>
<title>4.php</title>
  </head>

  <!---nav--->
  <section id="navbar" class="navbar">
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-danger">
    <a class="navbar-brand" href="index.php">RYS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
	<a class="nav-item nav-link active" href="index.php">Home</a>
    <a class="nav-item nav-link active" href="profile.php?id=<?php echo $_SESSION['no']; ?>">Profile</a>
    <a class="nav-item nav-link active"href="keluar.php">logout</a>
    </div>
  </div>
  </div>
</nav>
</section>

<section id="sidebar" class="sidebar">
<div class="sidebar">
    <p>Profile Saya</p>
    <img src="profile.png" width="60px" height="60px" style="float: left; margin-right: 10px;" />
    <p><?php
    echo '<a href="profile.php?id=' . $_SESSION['no'] . '">' . $data['nama'] . '</a>';
    ?></p><p><?php
    echo $data['tentang'];
    ?></p>
  </div>
  </section>
  
  <section id="content" class="content">
  <div class="content">
    <p>Buat Status</p>
    <form method="post">
      <textarea name="status" placeholder="Apa yang anda pikirkan ?" rows="3" cols="50" maxlength="140"></textarea>
      <br/>
      <button type="submit" name="kirim">Post</button> <span style="color: #555; font-size: 12px">Maximal 140 huruf</span>
    </form>
    <br/>
    <hr />
    <p>Dinding Status</p>
    <?php
    $querystatus = mysqli_query("SELECT `tb_timeline`.*,`tb_user`.`no_user`,`tb_user`.`nama` FROM tb_timeline
    LEFT JOIN `tb_user` ON `tb_timeline`.`no_user` = `tb_user`.`no_user` ORDER BY `tb_timeline`.`id_timeline` DESC");
    while ($data = mysql_fetch_array($querystatus)) {
      echo '<div style="border: 1px solid #555; margin-bottom: 10px; padding: 10px">';
      echo '<img src="profile.png" width="40px" height="40px" style="float: left; margin-right: 10px;" />';
      echo '<a href="profile.php?id=' . $data['no_user'] . '" style="margin-right: 20px">' . $data['nama'] . '</a>' . $data['status'];
      echo '<br /><span style="color: #555; font-size: 12px"><i>' . $data['tanggal'] . '</i></span>';
      echo '<div style="clear: both; margin-bottom: 10px"></div></div>';
    }
    if (mysqli_num_rows($querystatus) == 0) {
      echo "Tidak ada status tersimpan!";
    }
    ?>
  </div>
  </section>
</body>
</html>
