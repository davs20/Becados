<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
$primaryKey=consultasSQL::CleanStringText($_POST['primaryKey']);

           
       

            if($borrar=consultasSQL::DeleteSQL("estudiantes", "ID_Usuario='".$primaryKey."'")){
                    echo '<script type="text/javascript">
                        swal({
                            title:"¡Alumno eliminado!",
                            text:"Todos los datos del Alumno y sus Horas asociadas han sido eliminadas del sistema exitosamente",
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
                            text:"No hemos podido eliminar los datos del docente, por favor intenta nuevamente",
                            type: "error",
                            confirmButtonText: "Aceptar"
                        });
                    </script>';
                }
