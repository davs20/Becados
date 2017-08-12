<?php
$link = mysqli_connect("localhost", "root", "");
if (mysqli_connect_errno()) {
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    exit();
}
mysqli_select_db($link,"eventos");
if ($resultado = mysqli_query($link,"SELECT COUNT(*) AS 'cantidad' FROM eventos")) {
  $res=mysqli_fetch_array($resultado);
    mysqli_free_result($resultado);
}
mysqli_close($link);
?>
