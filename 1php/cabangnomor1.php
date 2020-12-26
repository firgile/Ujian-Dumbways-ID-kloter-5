<?php
$nama=$_POST['nama'];
$bulan=$_POST['bulan'];
$gaji =$_POST['gaji'];
$tunjangan=$_POST['tunjangan'];
$bpjs= $gaji*0.03;
$pajak = $gaji*0.05;
$gajiperbulan = ($gaji+$tunjangan)-($bpjs+$pajak);
$gajitotal = $gajiperbulan * $bulan;
echo "========================================== <br>";
echo "Nama Karyawan : ".$nama."<br>";
echo "Gaji Pokok	: Rp".$gaji."<br>";
echo "Tunjangan : Rp".$tunjangan."<br>";
echo "BPJS      : Rp".$bpjs."<br>";
echo "Pajak      : Rp".$pajak."<br>";
echo "========================================== <br>";
echo "Total Gaji perbulan : Rp".$gajiperbulan."/bulan <br>";
echo "========================================== <br>";
echo "Total Gaji : Rp".$gajitotal."<br>";

?>