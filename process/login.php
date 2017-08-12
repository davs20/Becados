<?php
session_start();
$conectar=mysqli_connect("localhost","root","");
if(!$conectar){
	die('La conexion ha fallado por:'.mysqli_error());
}
mysqli_select_db($conectar,"becados2");
$loginName=$_POST['loginName'];
$loginPassword=$_POST['loginPassword'];
$checkuser=mysqli_query($conectar,"SELECT Tipo_Usuario FROM usuarios WHERE ID_Usuario='".$loginName."' AND Contrasena='".$loginPassword."'");
$checkuser2=mysqli_query($conectar,"SELECT COUNT(Tipo_Usuario) FROM usuarios WHERE ID_Usuario='".$loginName."' AND Contrasena='".$loginPassword."'");
$s=mysqli_fetch_array($checkuser);
$s2=mysqli_fetch_array($checkuser2);
 if ($s2['COUNT(Tipo_Usuario)']==1) {
header("Location: home.php");
// echo '<script type="text/javascript"> window.location="catalog.php"; </script>';
// //echo $s;
}else{
  echo "Los Datos son Incorrectos";
 }

?>


<?php
// if($UserType=="Student"){
//     $key="NIE";
//     $table="estudiante";
//     $userN="Estudiante";
// }
// if($UserType=="Student" || $UserType=="Teacher" || $UserType=="Personal"){
//     $consult="SELECT * FROM ".$table." WHERE NombreUsuario COLLATE latin1_bin='$loginName' AND Clave COLLATE latin1_bin='$pass'";
//     $urlLocation='<script type="text/javascript"> window.location="catalog.php"; </script>';
//
// }
// if($UserType=="Admin"){
//     $key="CodigoAdmin";
//     $userN="Administrador";
//     $consult="SELECT * FROM administrador WHERE NombreUsuario COLLATE latin1_bin='$loginName' AND Clave COLLATE latin1_bin='$pass' AND Estado='Activo'";
  //  $urlLocation='<script type="text/javascript"> window.location="home.php"; </script>';
//
// }
// if($UserType!=""){
//     $checkUser=ejecutarSQL::consultar($consult);
//     $fila=mysql_fetch_array($checkUser);
//     if(mysql_num_rows($checkUser)>0){
//         $selectBit=ejecutarSQL::consultar("SELECT * FROM bitacora");
//         $total=mysql_num_rows($selectBit)+1;
//         $longitud=4;
//         for ($i=1; $i<=$longitud; $i++){
//             $numero = rand(0,9);
//             $codigo .= $numero;
//           }
//         mysql_free_result($selectBit);
//         $codeBit="UK".$fila[$key]."N".$codigo."-".$total."";
//         if(consultasSQL::InsertSQL("bitacora", "Codigo,CodigoUsuario,Tipo,Fecha,Entrada,Salida", "'".$codeBit."','".$fila[$key]."','$userN','$fecha','$hora','Sin registrar'")){
//             $_SESSION['UserName']=$fila['NombreUsuario'];
//             $_SESSION['UserPrivilege']=$UserType;
//             $_SESSION['primaryKey']=$fila[$key];
//             $_SESSION['codeBit']=$codeBit;
//             $_SESSION['SessionToken']=md5(uniqid(mt_rand(), true));
//             if($UserType=="Admin"){
//                 $_SESSION['CheckConfig']='unrevised';
//             }
//             echo $urlLocation;
//
//         }else{
//             echo '<script type="text/javascript">
//                 swal({
//                     title:"¡Ocurrió un error inesperado!",
//                     text:"No se pudo iniciar la sesión, por favor intenta nuevamente",
//                     type: "error",
//                     confirmButtonText: "Aceptar"
//                 });
//             </script>';
//         }
//     }else{
//         echo '<script type="text/javascript">
//             swal({
//                 title:"¡Datos invalidos o cuenta desactivada!",
//                 text:"Verifique sus datos e intente nuevamente, o póngase en contacto con el administrador de la biblioteca",
//                 type: "error",
//                 confirmButtonText: "Aceptar"
//             });
//         </script>';
//     }
// }else{
//     echo '<script type="text/javascript">
//         swal({
//             title:"Selecciona el tipo de usuario",
//             text:"Debes de seleccionar el tipo de usuario para iniciar sesión en el sistema",
//             type: "error",
//             confirmButtonText: "Aceptar"
//         });
//     </script>';
// }
//mysql_free_result($checkUser);
 ?>
