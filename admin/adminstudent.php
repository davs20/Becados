<!DOCTYPE html>
<html lang="es">
<head>
    <title>Estudiantes</title>
    <?php
        session_start();
        $LinksRoute="../";
        include '../inc/links.php';
    ?>
    <script src="../js/SendForm.js"></script>
    <script>
        $().ready(function(){
            $(".check-representative").keyup(function(){
              $.ajax({
                url:"../process/check-representative.php?DUI="+$(this).val(),
                success:function(data){
                  $(".representative-resul").html(data);
                }
              });
            });
        });
    </script>
</head>
<body>
    <?php
        include '../library/configServer.php';
        include '../library/consulSQL.php';
        include '../process/SecurityAdmin.php';
        include '../inc/NavLateral.php';
    ?>
    <div class="content-page-container full-reset custom-scroll-containers">
        <?php
            include '../inc/NavUserInfo.php';
        ?>
        <div class="container">
            <div class="page-header">
                <h1 class="all-tittles">Becados Unicah Si<small>      Administración</small></h1>
            </div>
        </div>
        <div class="conteiner-fluid">
            <ul class="nav nav-tabs nav-justified"  style="font-size: 17px;">
              <li role="presentation"  class="active"><a href="adminstudent.php">Nuevo Estudiantes</a></li>
              <li role="presentation"><a href="adminlistteacher.php">Editar Estudiante</a></li>

            </ul>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/user03.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido a la sección para registrar nuevos estudiantes, para poder registrar un estudiante deberás de llenar todos los campos del siguiente formulario
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">Registrar un nuevo estudiante</div>
                <form action="../process/AddStudent.php" method="post" class="form_SRCB" data-type-form="save" autocomplete="off" enctype="multipart/form-data">
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                           <?php

                            ?>
                            <legend>Datos del estudiante</legend>
                            <br><br>
                             <div class="group-material">
                                 <input type="text" pattern="[0-9]{1,13}" class="material-control tooltips-general"  placeholder="Escribe aquí el ID del alumno" name="identidad" required="" maxlength="13" data-toggle="tooltip" data-placement="top" title="NIE de estudiante">
                                 <span class="highlight"></span>
                                 <span class="bar"></span>
                                 <label>ID</label>
                             </div>

                             <div class="group-material">
                                <input type="password" name="pass"  class="material-control tooltips-general" placeholder="Escribe aquí su contraseña" required=""  maxlength="50" data-toggle="tooltip" data-placement="top" title="Nombres del estudiante">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Contrasena</label>
                             </div>
                             <div class="group-material">
                                <input type="password" name="pass2"  class="material-control tooltips-general" placeholder="Repita la Contraseña" required=""  maxlength="50" data-toggle="tooltip" data-placement="top" title="Nombres del estudiante">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Contrasena</label>
                             </div>


                              <div class="group-material">
                                 <input type="text" name="nombre" pattern="[A-Za-z]" class="material-control tooltips-general" placeholder="Escribe aquí los nombres del alumno" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}" maxlength="50" data-toggle="tooltip" data-placement="top" title="Nombres del estudiante">
                                 <span class="highlight"></span>
                                 <span class="bar"></span>
                                 <label>Nombre Completo</label>
                             </div>


                             <div class="group-material">
                                 <input type="phone" name="tel"  pattern="[A-Za-z]" class="material-control tooltips-general" placeholder="Escribe aquí el numero de Telefono" required=""  maxlength="8" data-toggle="tooltip" data-placement="top" title="Telefono">
                                 <span class="highlight"></span>
                                 <span class="bar"></span>
                                 <label>Telefono</label>
                             </div>

                             <div class="group-material">
                                 <input type="email" name="email"  class="material-control tooltips-general" placeholder="Escribe aquí el correo electronico" required=""  maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba su Correo Electronico">
                                 <span class="highlight"></span>
                                 <span class="bar"></span>
                                 <label>Email</label>
                             </div>


                             <div class="group-material">
                                 <input type="date" name="fecha" class="material-control tooltips-general"   data-toggle="tooltip" data-placement="top" title="Fecha de Ingreso">
                                 <span class="highlight"></span>
                                 <span class="bar"></span>
                                 <label>Fecha De Ingreso</label>
                             </div>
                        <div>
                                 <select   name="carrera" class="material-control tooltips-general" placeholder="Selecciona la Carrera del Alumno" required=""  data-toggle="tooltip"  title="Carrera del estudiante" >
                                   <option   disabled="" selected="" value="Elija su Carrera">Elija La Carrera</option>
                                   <?php
                                   $consulta2=ejecutarSQL::consultar("SELECT Nombre_Carrera FROM carreras");
                                   while ($resultado=mysql_fetch_array($consulta2)) {
                                          echo'<option value="'.$resultado['Nombre_Carrera'].'">'.$resultado['Nombre_Carrera'].'</option>';
                                           mysql_free_result($resultado);
                                          }
                                           ?>
                                 </select>
                                 <br></br>
<select  name="tipo" class="material-control tooltips-general" placeholder="Selecciona la Carrera del Alumno" required=""  data-toggle="tooltip"  title="Tipo De Usuario"/>
<option    selected="" disabled="disabled" value="Elija el Tipo de Usuario">Elija el tipo de usuario</option>
<option    value="Estudiante">Estudiante</option>
<option     value="Invitados">Invitados</option>

</select>
                         </div><br></br>

                             <!-- <div class="group-material">
                                 <select  class="material-control tooltips-general"  required=""  data-toggle="tooltip" data-placement="top" title="Carrera del estudiante" >
                                   <option   disabled="" selected="" value="Elija su Carrera">Elija El Tipo De Usuario</option>
                                   <option value="hola">Estudiante</option>
                                   <option value="hola">Administrador</option>
                                 <span class="highlight"></span>
                                 <span class="bar"></span>
                             </div> -->

                             <div class="group-material">
                             <p class="text-center">
                                 <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                                 <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>
                             </p>
                            </div>

                       </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="msjFormSend"></div>
        <div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">ayuda del sistema</h4>
                </div>
                <div class="modal-body">
                    <?php include '../help/help-adminstudent.php'; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> &nbsp; De acuerdo</button>
                </div>
            </div>
          </div>
        </div>
        <?php include '../inc/footer.php'; ?>
    </div>
</body>
</html>
