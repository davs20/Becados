<?php
$conectar=mysqli_connect("localhost","root","");
if (!$conectar) {
  die('La conexion ha fallado por:'.mysqli_error());
}else{
  $contador=1;
$seleccionar=mysqli_select_db($conectar,"becados2");
$cant_dep=mysqli_query($conectar,"SELECT COUNT(*)  FROM carreras");
$resultado=mysqli_fetch_array($cant_dep);
while($contador<=$resultado['COUNT(*)']){
//  $cant_car[$contador]="";
$icc=mysqli_query($conectar,"SELECT SUM(Horas_Cumplidas) as cant FROM horas_laboradas WHERE ID_Usuario IN (SELECT ID_Usuario FROM estudiantes where ID_Carrera='".$contador."')");
$icc2=mysqli_fetch_assoc($icc);
$cant_car[$contador]=$icc2['cant'];

if(is_null($cant_car[$contador])){
  $cant_car[$contador]=0;
 }
$contador=$contador+1;
}
}

 ?>
