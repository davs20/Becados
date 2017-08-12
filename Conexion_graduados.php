
<?php
$l = mysqli_connect("localhost","root","");
if (mysqli_connect_errno()) {
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    exit();
}
mysqli_select_db($l,"becados2");
if ($result = mysqli_query($l,"SELECT count(*) FROM `new_view` WHERE h=900")) {
  $re=mysqli_fetch_array($result);

    mysqli_free_result($result);
}
mysqli_close($l);
?>
