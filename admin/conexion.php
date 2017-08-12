<?php
$conexion=mysqli_connect("localhost","root","");
if (!$conexion) {
  die("La conexion ha Fallado");
}

$linkeado=mysqli_select_db($conexion,"becados2");
$consulta3=mysqli_query($conexion,"SELECT * FROM carreras");
$fila=mysqli_fetch_array($consulta3);
 ?>
