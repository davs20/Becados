<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
$user=$_GET['idup'];
$horas=$_POST['horas'];
$fecha=$_POST['fechac'];
$fecha2=$_POST['fechac2'];
$fecha_vieja=$_POST['fechacx'];
$departamento=$_POST['deup'];
 $comentarios=$_POST['comentarios'];
 $select=ejecutarSQL::consultar("SELECT DepartamentoID FROM departamento WHERE Nombre='".$departamento."'");
 $data1=mysql_fetch_array($select);
 if($fecha==$fecha_vieja){
 $fields="Horas_Cumplidas='$horas',Comentario='$comentarios',DepartamentoID='$data1[DepartamentoID]'";
 }else {
 $fields="Horas_Cumplidas='$horas',Fecha_Inicio='$fecha',Fecha_FinalReal='$fecha2',Comentario='$comentarios',DepartamentoID='$data1[DepartamentoID]'";
 }
if($horas==0){
  echo '<script type="text/javascript">
      swal({
          title:"¡No puede actualizar un registro con 0 horas!",
          text:"No hemos podido actualizar los datos del estudiante, por favor intenta nuevamente",
          type: "error",
          confirmButtonText: "Aceptar"
      });
  </script>';
}else{
        if(consultasSQL::UpdateSQL("horas_laboradas", $fields , "ID_Usuario='".$user."' AND Fecha_Inicio='".$fecha_vieja."'")){
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
?>
