<!DOCTYPE html>
<html lang="es">
<head>
    <title>Administradores</title>
    <?php
        session_start();
        $LinksRoute="../";
        include '../inc/links.php';
    ?>
    <script src="../js/SendForm.js"></script>
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
                <h1 class="all-tittles">Becados UNICAH SI <small>Administración>Estudiantes</small></h1>
            </div>
        </div>
        <div class="container-fluid">
          <ul class="nav nav-tabs nav-justified"  style="font-size: 17px;">
            <li role="presentation"><a href="adminstudent.php">Nuevo Estudiantes</a></li>
            <li role="presentation"><a href="adminteacher.php">Editar Estudiante</a></li>

          </ul>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/user01.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido a la sección para registrar nuevos administradores del sistema, debes de llenar todos los campos del siguiente formulario para registrar un administrador
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 lead">
                    <ol class="breadcrumb">
                      <li class="active">Estudiante</li>
                      <li><a href="adminlistuser.php">Listado de administradores</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">Datos Del Estudiante</div>
                <form action="../process/AddAdmin.php" method="post" class="form_SRCB" data-type-form="save" autocomplete="off">
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <div class="group-material">
                              <div class="group-material">
                                  <input type="search" class="material-control tooltips-general"  required="" maxlength="50 data-toggle="tooltip" data-placement="top" title="Busca A un estudiante por su nombre">
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label>Buscar</label>
                              </div>
                              <div class="group-material">
                                  <input type="text" class="material-control tooltips-general" disabled="disabled" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe los nombres del docente, solamente letras">
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label>ID</label>
                              </div>
                              <div class="group-material">
                                  <input type="text" class="material-control tooltips-general" disabled="disabled" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe los apellidos del docente, solamente letras">
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label>Nombres</label>
                              </div>
                              <div class="group-material">
                                  <input type="text" class="material-control tooltips-general" disabled="disabled" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Solamente 8 números">
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label>Apellidos</label>
                              </div>
                              <div class="group-material">
                                  <input type="text" class="material-control tooltips-general" disabled="disabled" required="" maxlength="8" data-toggle="tooltip" data-placement="top" title="Especialidad del docente">
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label>Teléfono</label>
                                    </div>

                                    <div class="group-material">
                                        <input type="date3" class="material-control tooltips-general" disabled="disabled" required="" maxlength="8" data-toggle="tooltip" data-placement="top" title="Especialidad del docente">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Fecha</label>
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
                    <?php include '../help/help-adminuser.php'; ?>
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
