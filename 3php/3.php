<!DOCTYPE html>
<html>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Input <input type="text" name="in">
  <input type="submit">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $i = $_POST['in'];
    if (empty($i)) {
        echo "Name is empty";
    } else {
        echo $i;
    }
}?>
<br>
<?php
echo "<br/>";
for($a=1; $a<=$i; $a++){
    for($c=$i; $c>=$a; $c-=1){
        echo "*";
    }
    echo "<br/>";
}
?>
</body>
</html>