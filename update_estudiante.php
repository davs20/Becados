<?php
session_start();
include 'library/configServer.php';
include 'library/consulSQL.php';
$contrasena1=$_POST['contrasena1'];
$contrasena2=$_POST['contrasena2'];
$contrasena4=$_POST['contrasena4'];
$tel=$_POST['telefono'];
$correo=$_POST['correo'];
$con=ejecutarSQL::consultar("SELECT COUNT(Contrasena) FROM estudiantes WHERE Contrasena='".$contrasena4."' AND ID_Usuario='".$_SESSION['id']."'");
$con2=mysql_fetch_array($con);
$con3=ejecutarSQL::consultar("SELECT COUNT(Contrasena) FROM estudiantes WHERE Contrasena='".$contrasena1."' AND ID_Usuario='".$_SESSION['id']."'");
$con4=mysql_fetch_array($con3);
if($con2['COUNT(Contrasena)']==1){
  $fields="Numero_Telefono='$tel',Correo_Electronico='$correo'";
$consulta=consultasSQL::UpdateSQL("estudiantes", $fields ,"ID_Usuario='".$_SESSION[id]."'");
header("Location: perfil_estudiante.php?b=1");
if(!$consulta){
  header("Location: perfil_estudiante.php?b=2");
}
}elseif ($con4['COUNT(Contrasena)']==1) {
   $fields="Contrasena='$contrasena4'";
$consulta2=consultasSQL::UpdateSQL("estudiantes", $fields ,"ID_Usuario='".$_SESSION[id]."'");
header("Location: perfil_estudiante.php?b=1");
 }else{
  header("Location: perfil_estudiante.php?b=2");
 }
?>
