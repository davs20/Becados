<?php
$link = mysqli_connect("localhost","root","");
mysqli_select_db($link,"becados2");
if($link === false){
  die("Error no se puede conectar. " .mysqli_connect_error());
}

 ?>
