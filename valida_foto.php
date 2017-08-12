<?php
session_start();
include 'library/configServer.php';
include 'library/consulSQL.php';
$foto=$_FILES["foto"]["name"];
$ruta=$_FILES["foto"]["tmp_name"];
$destino="FOTOS_CARNETS/".$foto;
if ($_FILES["foto"]["size"]<20000000 && ($_FILES["foto"]["type"] =="image/jpeg" || $_FILES["foto"]["type"] =="image/gif")){
copy($ruta,$destino);
$fields="Foto='$destino'";
consultasSQL::UpdateSQL("estudiantes", $fields, "ID_Usuario='".$_SESSION['id']."'");
header("Location: perfil_estudiante.php?a=0");
}else {
  header("Location: perfil_estudiante.php?a=1");
}
?>
