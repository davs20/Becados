
<?php
$conexion=mysqli_connect("localhost","root","");
if (!$conexion) {
  die("La conexion ha Fallado");
}

$linkeado=mysqli_select_db($conexion,"becados2");
$consulta2=mysqli_query($conexion,"SELECT COUNT(*) as cantidad FROM carreras");
$resultado=mysqli_fetch_array($consulta2);
$b=1;
while ($b <= $resultado['cantidad']) {
$consulta3=mysqli_query($conexion,"SELECT Nombre_Carrera FROM carreras where ID_Carrera='".$b."'");
$resultado2=mysqli_fetch_array($consulta3);
$fila[$b]=$resultado2['Nombre_Carrera'];
$b=$b+1;
}

 foreach ($fila as $key) {
 echo $key ;
 echo "<br>";
 }
 ?>
