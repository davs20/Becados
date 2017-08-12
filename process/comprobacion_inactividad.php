<?php
session_start();
$fecha_antigua=$_SESSION["ultimo"];
$hora=date("Y-n-j H:i:s");
$tiempo=((strtotime($hora))-(strtotime($fecha_antigua)));
if($tiempo>=300){
  session_destroy();
  require_once("logout.php");
  echo '<script type="text/javascript">alert("Su Sesion ha expirado por razones de seguridad")
  window.location.assign("index.php");</script>';;
}else{
  $_SESSION["ultimo"]=$hora;
}
?>
