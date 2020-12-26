<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		.kotak{
			width: 50px;
			heigth: 50px;
			border-style: groove;
			text-align: center;
			limit-height: 50px;
			float: left;
		}
		.clear{
			clear:both;
		}
	</style>
</head>
<body>
<?php
	$angka = [
	[2,8,14,20,26],
	[32,38,44,50,56],
	[62,68,74,80,86]
	];
?>
<?php foreach($angka as $a):?>
	<?php foreach($a as $b):?>
		<div class = "kotak"><?=$b;?></div>
	<?php endforeach;?>
	<div class="clear"></div>
<?php endforeach;?>
</body>
</html>