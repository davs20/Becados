<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
 $user=consultasSQL::CleanStringText($_POST['identidad1']);
$olduser=consultasSQL::CleanStringText($_POST['identidad2']);
 $nombre=consultasSQL::CleanStringText($_POST['nombre']);
 $tel=consultasSQL::CleanStringText($_POST['telefono']);
 $email=consultasSQL::CleanStringText($_POST['correo']);
$Password1=consultasSQL::CleanStringText($_POST['Password1']);
$Password2=consultasSQL::CleanStringText($_POST['Password2']);

if($_SESSION['UserPrivilege']=='Estudiante'){
  $confirmacion=ejecutarSQL::consultar("SELECT Contrasena FROM estudiantes Where ID_Usuario='".$_SESSION['id']."'");
  $confirmacion2=mysql_fetch_array($confirmacion);
  if ($_POST['Password1']==$confirmacion2['Contrasena']) {
  $fields="Contrasena='$Password2',Numero_Telefono='$tel',Correo_Electronico='$email'";
  }
}
  $fields="Nombre_Completo='$nombre',Numero_Telefono='$tel',Correo_Electronico='$email'";

        if(consultasSQL::UpdateSQL("estudiantes", $fields, "ID_Usuario='".$_SESSION['Estudiante']."'")){
            echo '<script type="text/javascript">
                swal({
                    title:"¡Estudiante actualizado!",
                    text:"Los datos del estudiante se actualizaron correctamente, recuerda que si cambiaste la sección encargada del estudiante los estudiantes de la sección anterior no tendrán encargado y deberás asignarle uno.",
                    type: "success",
                    confirmButtonText: "Aceptar"
                },
                function(isConfirm){
                    if (isConfirm) {
                        location.reload();
                    } else {
                        location.reload();
                    }
                });
            </script>';
        }else{
            echo '<script type="text/javascript">
                swal({
                    title:"¡Ocurrió un error inesperado!",
                    text:"No hemos podido actualizar los datos del estudiante, por favor intenta nuevamente",
                    type: "error",
                    confirmButtonText: "Aceptar"
                });
            </script>';
}
//         }else{
//         echo '<script type="text/javascript">
//             swal({
//                 title:"¡Ocurrió un error inesperado!",
//                 text:"Has introducido un nombre de usuario que ya esta siendo utilizado, por favor ingresa otro nombre",
//                 type: "error",
//                 confirmButtonText: "Aceptar"
//             });
//         </script>';
//     }else{
//     echo '<script type="text/javascript">
//         swal({
//             title:"¡Ocurrió un error inesperado!",
//             text:"Las contraseñas no coinciden, por favor verifica e intenta nuevamente",
//             type: "error",
//             confirmButtonText: "Aceptar"
//         });
//     </script>';
// }
mysql_free_result($checkUserName);
