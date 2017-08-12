<?php
//error_reporting(0);
session_start();
 $depar=$_POST['depar'];
$conexion=mysqli_connect("localhost","root","admin");
if(!$conexion){
	die('La conexion ha fallado por:'.mysqli_error());
}
mysqli_select_db($conexion,"becados2");
             $cont=0;
             $id;
               while ($cont <= (count($depar)-1)) {
                 if($depar[$cont][0]!='' && $depar[$cont][1]!=''){
                 $preguntar=mysqli_query($conexion,"SELECT COUNT(*) FROM horas_laboradas WHERE ID_Usuario='".$_GET['id']."' AND  ((Fecha_Inicio  BETWEEN '".$depar[$cont][0]."' AND '".$depar[$cont][1]."') OR (Fecha_FinalReal BETWEEN  '".$depar[$cont][0]."' AND '".$depar[$cont][1]."'))");
                 $respuesta=mysqli_fetch_assoc($preguntar);
                 $paso=1;
                 }else{
                 $paso=0;
                 }
                  if($respuesta['COUNT(*)']==0 && $paso==1){
                  $id=$cont+1;
                 $insertar=mysqli_query($conexion,"INSERT INTO horas_laboradas (ID_Usuario,DepartamentoID,Comentario,Fecha_Inicio,Fecha_FinalReal) VALUES('".$_GET['id']."','$id','".$depar[$cont][2]."','".$depar[$cont][0]."','".$depar[$cont][1]."')");
                 $update=mysqli_query($conexion,"UPDATE  horas_laboradas  SET Horas_Cumplidas=(TIMESTAMPDIFF (MINUTE,Fecha_Inicio,Fecha_FinalReal)/60)  Where ID_Usuario='".$_GET['id']."' AND Fecha_Inicio='".$depar[$cont][0]."'");

                  }
                 $cont=$cont+1;
              }
          //header("Location: ../admin/adminlistteacher%20-%20copia.php");
                        // if($error==0){
                        //   echo '<script type="text/javascript">
                        //       swal({
                        //          title:"¡Horas Registradas!",
                        //          text:"Los datos del estudiante se registraron exitosamente",
                        //          type: "success",
                        //          confirmButtonText: "Aceptar"
                        //       });
                        //       $(".form_SRCB")[0].reset();
                        //   </script>';
                        //
                        // }else{
                        //     echo '<script type="text/javascript">
                        //         swal({
                        //             title:"¡Ocurrió un error inesperado!",
                        //             text:"No se pudo registrar el estudiante, por favor intenta nuevamente",
                        //             type: "error",
                        //             confirmButtonText: "Aceptar"
                        //         });
                        //     </script>';
                        // }

mysqli_close($conexion);
?>
