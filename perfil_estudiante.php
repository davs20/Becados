<!DOCTYPE html>
<html lang="es">
<head>

    <title>Perfil Estudiante</title>
    <script src="js/sweetalert2.min.js"></script>
<link rel="stylesheet" href="js/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <?php
        session_start();
        $LinksRoute="./";
        include './inc/links.php';
    ?>
    <!-- <script type="text/javascript" src="js/jPages.js"></script>
    <script>
        $(document).ready(function(){
            $(function(){
              $("div.holder").jPages({
                containerID : "itemContainer",
                perPage: 20
              });
            });
           $('.btn-info-book').click(function(){
               window.location ="infobook.php?codeBook="+$(this).attr("data-code-book");
           });
           $('.list-catalog-container li').click(function(){
               window.location="catalog.php?CategoryCode="+$(this).attr("data-code-category");
           });
        });
    </script> -->
</head>
<body>
    <?php
        include './library/configServer.php';
        include './library/consulSQL.php';
        include './inc/NavLateral.php';

    ?>
    <div class="content-page-container full-reset custom-scroll-containers">
        <?php
            include './inc/NavUserInfo.php';
        ?>
        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">Sistema becario <small>Perfil Personal</small></h1>
            </div>
        </div>
        <div class="container-fluid"  style="margin: 40px 0;">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-3">
                  <?php
                  $select=ejecutarSQL::consultar("SELECT Foto FROM estudiantes WHERE ID_Usuario='".$_SESSION['id']."'");
                  $data1=mysql_fetch_array($select);
                    echo '<img src="'.$data1['Foto'].'" alt="pdf" class="img-responsive center-box" style="max-width: 110px;">';
                    ?>
                </div>

<?php
                // echo'<div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                //     Bienvenido(a) ,'.$_SESSION[Estudiante].' aqui podras ver o actualizar tus datos de perfil<i class="zmdi zmdi-search"></i>
                // </div>';
                 ?>
                 <br>
                 <br>
                 <br>
                 <br>
                 <br>
                 <?php
                 $pregunta=ejecutarSQL::consultar("SELECT * From estudiantes Where ID_Usuario='".$_SESSION['id']."'");
                 $pregunta2=mysql_fetch_array($pregunta);
                 ?>
                 <?php  ?>
                 <br>
                  <br>
                  <br>
                 <center><form class="busqueda" style="width: 50% !important;" action="valida_foto.php" method="post" enctype="multipart/form-data">
                 <div class="group-material">
                     <input type="file" name="foto" class="material-control tooltips-general"   data-toggle="tooltip" data-placement="top" title="Foto">
                     <span class="highlight"></span>
                     <span class="bar"></span>
                     <label>Foto De Alumno</label>
                     <input type="submit" name="Guardar" value="Guardar">
                 </div>
               </form></center>
                 <center><form class="busqueda" style="width: 50% !important;"  autocomplete="off" method="POST" action="update_estudiante.php">
                     <div class="group-material">
                         <input type="phone" required="" style="display: inline-block !important;"  value="<?php echo $pregunta2['Numero_Telefono']; ?>" class="material-control tooltips-general"  name="telefono"   maxlength="8" data-toggle="tooltip" data-placement="top"   title="Escribe el nuevo numero de Telefono"/>
                         <label>Telefono</label>
                       </div>
                     <div class="group-material">
                         <input type="email" required="" style="display: inline-block !important;"  value="<?php echo $pregunta2['Correo_Electronico']; ?>" class="material-control tooltips-general"  name="correo"   maxlength="50" data-toggle="tooltip" data-placement="top"   title="Escribe el nuevo numero de Telefono">
                        <label>Correo Electronico</label>
                     </div>

                     <div class="group-material">
                         <input type="password"  style="display: inline-block !important;" class="material-control tooltips-general"  name="contrasena4"   maxlength="8" data-toggle="tooltip" data-placement="top"   title="Escribe el nuevo numero de Telefono">
                        <label>Contrasena</label>
                     </div>
                     <br><br>
                     <h2>Cambio de Contrasena</h2>
                     <bold><small>Llene estos campos si desea cambiar de contrasena si no es asi puede dejarlos vacios</small></bold><br>
                     <br>
                     <div class="group-material">
                         <input type="password"  style="display: inline-block !important;" class="material-control tooltips-general"  name="contrasena1"   maxlength="8" data-toggle="tooltip" data-placement="top"   title="Escribe el nuevo numero de Telefono">
                        <label>Contrasena Actual</label>
                     </div>
                     <div class="group-material">
                         <input type="password"  style="display: inline-block !important;" class="material-control tooltips-general"  name="Contrasena2"   maxlength="8" data-toggle="tooltip" data-placement="top"   title="Escribe el nuevo numero de Telefono">
                        <label>Contrasena Nueva</label>
                     </div>

                     <div class="group-material">
                         <input type="submit" class="material-control tooltips-general"  name="Guardar" >
                     </div>

                   </form></center>

            </div>
            <div class="table-responsive">
            </div>
            <br>
          </br>
          <br>
        </br>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">ayuda del sistema</h4>
                </div>
                <div class="modal-body">
                    <?php include './help/help-catalog.php'; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> &nbsp; De acuerdo</button>
                </div>
            </div>
          </div>
        </div>
        <?php include './inc/footer.php'; ?>

    </div>

<?php
if(!is_null($_GET['a'])){
  if($_GET['a']==0){
    echo '<script type="text/javascript">
        swal({
           title:"¡Foto Actualizada!",
           text:"La Foto Se ha Actualizado Exitosamente",
           type: "success",
           confirmButtonText: "Aceptar"
        });
    </script>';
  }elseif ($_GET['a']=1){
    echo '<script type="text/javascript">
        swal({
           title:"¡Ops!",
           text:"No Se ha Podido Subir la Foto recuerda que solo puedes subir fotos inferiores a 20mb, asegurate de que la imagen este en formato JPG o GIF",
           type: "error",
           confirmButtonText: "Aceptar"
        });

    </script>';
  }
}
if(!is_null($_GET['b'])){
  if ($_GET['b']==1) {
    echo '<script type="text/javascript">
        swal({
           title:"¡Informacion Personal Actualizada!",
           text:"Se ha Actualizado su infor Exitosamente",
           type: "success",
           confirmButtonText: "Aceptar"
        });

    </script>';

  }elseif ($_GET['b']==2) {
    echo '<script type="text/javascript">
        swal({
           title:"¡Ops!",
           text:"Contrasena Incorrecta Vuelva a Intentarlo, Recuerde que Ingresar la contrasena actual es nesesario para modificar tus datos, esto es por tu seguridad",
           type: "error",
           confirmButtonText: "Aceptar"
        });

    </script>';
  }elseif ($_GET['b']==3) {
    echo '<script type="text/javascript">
        swal({
           title:"¡Ops!",
           text:"Error Inesperado Contactese Con el Administrador",
           type: "error",
           confirmButtonText: "Aceptar"
        });

    </script>';
  }

}
 ?>
</body>
</html>
