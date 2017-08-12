<?php
session_start();
$conectar=mysqli_connect("localhost","root","");
if(!$conectar){
	die('La conexion ha fallado por:'.mysqli_error());
}
mysqli_select_db($conectar,"becados2");
$loginName=$_POST['loginName'];
$loginPassword=$_POST['loginPassword'];

$checkuser1=mysqli_query($conectar,"SELECT COUNT(Nombres_Completo),Nombres_Completo FROM administrador WHERE ID_Usuario='".$loginName."' AND Contrasena='".$loginPassword."'");
$checkuser2=mysqli_query($conectar,"SELECT COUNT(Nombre_Completo),Nombre_Completo FROM estudiantes WHERE ID_Usuario='".$loginName."' AND Contrasena='".$loginPassword."'");
$s=mysqli_fetch_array($checkuser1);
$s2=mysqli_fetch_array($checkuser2);////capturo el resultado
 if ($s2['COUNT(Nombre_Completo)']==1) {//// si la consulta encontro un solo registro significa que el usiario existe y es unico por tanto entra al sistema
$sesiones=mysqli_query($conectar,"SELECT sesiones from estudiantes where ID_Usuario='".$loginName."' AND Contrasena='".$loginPassword."'");
$sesiones2=mysqli_fetch_array($sesiones);
    if($sesiones2['sesiones']<=3){
    mysqli_query($link,"UPDATE estudiantes set sesiones=1 where ID_Usuario='".$loginName."' AND Contrasena='".$loginPassword."'");
    $_SESSION['Estudiante']=$s2['Nombre_Completo'];
    $_SESSION['UserPrivilege']='Estudiante';
    $_SESSION['id']=$loginName;
    header("Location: home.php");
  	}else{
    header("Location: logout.php");
		echo'<script type="text/javascript">
		alert("¡Ha Abierto mas de 3 Sesiones Por razones de Seguridad Debe Cerrar estas Sesiones para poder ingresar!");
	   window.location.href="index.php";
		</script>';
	  }
}else if($s['COUNT(Nombres_Completo)']==1){
$sesiones=mysqli_query($conectar,"SELECT sesiones from administrador where ID_Usuario='".$loginName."' AND Contrasena='".$loginPassword."'");
	$sesiones2=mysqli_fetch_array($sesiones);
	   if($sesiones2['sesiones']<=3){
	     mysqli_query($conectar,"UPDATE administrador set sesiones=1 where ID_Usuario='".$loginName."' AND Contrasena='".$loginPassword."'");
       $_SESSION['Administrador']=$s["Nombres_Completo"];
       $_SESSION['UserPrivilege']='Administrador';
	     $_SESSION['id']="0";
    	 header("Location: home.php");
		 }else {
			 header("Location: logout.php");
 			echo'<script type="text/javascript">
 			alert("¡Ha Abierto mas de 3 Sesiones Por razones de Seguridad Debe Cerrar estas Sesiones para poder ingresar!");
 		   window.location.href="index.php";
 			</script>';
		 }
}else {
	echo'<script type="text/javascript">
	alert("¡Contrasena o Numero de Identidad no es correcto!");
   window.location.href="index.php";
	</script>';
}
mysqli_close($conectar);
?>
