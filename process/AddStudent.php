<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
 $id=$_POST['identidad'];
 $nombre=$_POST['nombre'];
 $tel=$_POST['tel'];
 $email=$_POST['email'];
 $f=$_POST['fecha'];
$carrera=$_POST['carrera'];
 $tipo=$_POST['tipo'];
 $Pass=$_POST['pass'];
 $Pass2=$_POST['pass2'];
$foto=$_FILES['imagen']['name'];
$ruta=$_FILES['imagen']['tmp_name'];
$destino="FOTOS_CARNETS/".$foto;
copy($ruta,$destino);
$convertir=ejecutarSQL::consultar("SELECT ID_Carrera as ad FROM carreras WHERE Nombre_Carrera='".$carrera."'");
     $checkRStudent=ejecutarSQL::consultar("SELECT COUNT(*) as cant FROM estudiantes WHERE Nombre_Completo='".$nombre."' AND ID_Usuario='".$id."'");
    $cone=mysql_fetch_array($convertir);
    $cone2=mysql_fetch_array($checkRStudent);

    if($cone2['cant']==0){
                    if($Pass==$Pass2){
                if($tipo=='Estudiante'){
                  $tipo='0';
                }else{
                 $tipo='1';
                }

                        if(consultasSQL::InsertSQL("estudiantes", "ID_Usuario,Contrasena,Invitado,Correo_Electronico,Fecha_Ingreso,Nombre_Completo,Numero_Telefono,ID_Carrera,Foto", "'$id','$Pass','$tipo','$email','$f','$nombre','$tel','$cone[ad]','$destino'")){
                                echo '<script type="text/javascript">
                                    swal({
                                       title:"¡Estudiante registrado!",
                                       text:"Los datos del estudiante se registraron exitosamente",
                                       type: "success",
                                       confirmButtonText: "Aceptar"
                                    });
                                    $(".form_SRCB")[0].reset();
                                </script>';
                        }else{
                            echo '<script type="text/javascript">
                                swal({
                                    title:"¡Ocurrió un error inesperado!",
                                    text:"No se pudo registrar el estudiante, por favor intenta nuevamente",
                                    type: "error",
                                    confirmButtonText: "Aceptar"
                                });
                            </script>';
                        }
}
}
mysqli_close($conexion);
