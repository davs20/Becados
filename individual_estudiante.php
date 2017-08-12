<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mi Cuenta</title>
    <meta charset="UTF-8">
    </head>
<body>
  <?php
  include './library/configServer.php'; /// conexion
  include './library/consulSQL.php'; //// consulta
  if (!$_SESSION['UserPrivilege']=='Estudiante') {
      header("Location: process/logout.php");
      exit();
  }
  include './inc/NavLateral.php';
  ?>
    <div class="content-page-container full-reset custom-scroll-containers">
        <nav class="navbar-user-top full-reset">
            <ul class="list-unstyled full-reset">
                <figure>
                   <img src="assets/img/user01.png" alt="user-picture" class="img-responsive img-circle center-box">
                </figure>
                <li style="color:#fff; cursor:default;">
                    <span class="all-tittles">Admin Name</span>
                </li>
                <li  class="tooltips-general exit-system-button" data-href="index.html" data-placement="bottom" title="Salir del sistema">
                    <i class="zmdi zmdi-power"></i>
                </li>
                <li  class="tooltips-general search-book-button" data-href="searchbook.html" data-placement="bottom" title="Buscar libro">
                    <i class="zmdi zmdi-search"></i>
                </li>
                <li  class="tooltips-general btn-help" data-placement="bottom" title="Ayuda">
                    <i class="zmdi zmdi-help-outline zmdi-hc-fw"></i>
                </li>
                <li class="mobile-menu-button visible-xs" style="float: left !important;">
                    <i class="zmdi zmdi-menu"></i>
                </li>
            </ul>
        </nav>
        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">Becados UNICAH SI<small>     Perfil Personal, <?php  echo $_SESSION['Estudiante']; ?></small></h1>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-justified" >
                <li role="presentation"><a href="report.php" >Informe Grupal</a></li>
                <li role="presentation" class="active"><a href="individual.html" role="tab" data-toggle="tab">Informe Individual</a></li>

            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="statistics">
                    <div class="container-fluid"  style="margin: 50px 0;">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <img src="assets/img/chart.png" alt="chart" class="img-responsive center-box" style="max-width: 120px;">
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                                Bienvenido al área de estadísticas, aquí puedes ver el avance de horas por alumno.
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                      <right><form class="busqueda" style="width: 30% !important;" action="individual.php" method="get" autocomplete="off">
                          <div class="group-material">
                              <input type="search" style="display: inline-block !important; width: 70%; background-color: rgba(8, 236, 130, 0.44)" class="material-control tooltips-general" placeholder="Buscar estudiante" name="alumno"   maxlength="50" data-toggle="tooltip" data-placement="top"   title="Escribe los nombres, sin los apellidos">
                              <button class="btn" style="margin: 0; height: 43px; background-color: rgba(8, 186, 103, 0.67) !important;">
                                  <i class="icon-binoculars" style="font-size: 25px;"></i>
                              </button><label>Nombre</label>
                          </div>
                          </form>
                          <right><form class="busqueda" style="width: 30% !important;" action="individual.php" method="get" autocomplete="off">
                          <div class="group-material">
                              <input type="search" style="display: inline-block !important; width: 70%; background-color: rgba(8, 236, 130, 0.44)" class="material-control tooltips-general" placeholder="Buscar estudiante" name="alumnoid"   maxlength="50" data-toggle="tooltip" data-placement="top"   title="Escribe los nombres, sin los apellidos">
                              <button class="btn" style="margin: 0; height: 43px; background-color: rgba(8, 186, 103, 0.67) !important;">
                                  <i class="icon-binoculars" style="font-size: 25px;"></i>
                              </button><label>Identidad</label>
                          </div>
                        </form>

                      <div class="row">
                        <div class="col-xs-12">
                          <h3 class="text-center all-tittles">Detalle Del Alumno</h3>
                            <div id="divl">

                          </div>
                        </div>
                      </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h3 class="text-center all-tittles">Detalle De Horas Cumplidas</h3>
                                 <center><div id="divl">
                        </div>
<p>META: 900 HORAS</p>


              <p class="lead text-center"><strong><i class="zmdi zmdi-info-outline"></i>&nbsp; ¡Importante!</strong> Para imprimir esta tabla ve a la sección de reportes y selecciona “Préstamos entregados (por usuarios)”</p>
                            </div>

                        </div>
                    </div>

                </div>

                <div role="tabpanel" class="tab-pane fade" id="bitacora">
                    <div class="container-fluid"  style="margin: 50px 0;">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <img src="assets/img/user-sesion.png" alt="users-sesion" class="img-responsive center-box" style="max-width: 120px;">
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                                Bienvenido al área de bitácora, aquí se muestran los registros de los últimos 15 usuarios (personal administrativo, docentes, administradores y estudiantes) que han iniciado sesión en el sistema. Recuerda eliminar los registros de la bitácora cada año para que el sistema funcione correctamente.
                            </div>
                        </div>
                    </div>
                <div role="tabpanel" class="tab-pane fade" id="reports">
                    <div class="container-fluid"  style="margin: 50px 0;">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <img src="assets/img/pdf.png" alt="pdf" class="img-responsive center-box" style="max-width: 120px;">
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                                Bienvenido al área de reportes, aquí puedes generar fichas de préstamos vacías de estudiantes, docentes o visitantes en formato pdf, también puedes generar reportes de inventario entre otros.
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="page-header">
                              <h2 class="all-tittles">fichas <small>vacías</small></h2>
                            </div><br>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-file-text zmdi-hc-5x"></i>
                                    </p>
                                    <h3 class="text-center">Ficha estudiante</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-file-text zmdi-hc-5x"></i>
                                    </p>
                                    <h3 class="text-center">Ficha docente</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-file-text zmdi-hc-5x"></i>
                                    </p>
                                    <h3 class="text-center">Ficha personal administrativo</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-file-text zmdi-hc-5x"></i>
                                    </p>
                                    <h3 class="text-center">Ficha visitante</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="page-header">
                              <h2 class="all-tittles">reportes <small>generales</small></h2>
                            </div><br>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-trending-up zmdi-hc-5x"></i>
                                    </p>
                                    <h3 class="text-center">Reporte General de Inventario</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-trending-up zmdi-hc-5x"></i>
                                    </p>
                                    <h3 class="text-center">Reporte Libros por Categoría</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-trending-up zmdi-hc-5x"></i>
                                    </p>
                                    <h3 class="text-center">Préstamos entregados (por usuarios)</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-trending-up zmdi-hc-5x"></i>
                                    </p>
                                    <h3 class="text-center">Préstamos entregados (por sección)</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="page-header">
                                <h2 class="all-tittles">reportes <small>devoluciones pendientes</small></h2>
                            </div><br>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-calendar-close zmdi-hc-5x"></i>
                                    </p>
                                    <h3 class="text-center">Docentes</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-calendar-close zmdi-hc-5x"></i>
                                    </p>
                                    <h3 class="text-center">Personal Administrativo</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-calendar-close zmdi-hc-5x"></i>
                                    </p>
                                    <h3 class="text-center">Estudiantes</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-calendar-close zmdi-hc-5x"></i>
                                    </p>
                                    <h3 class="text-center">Visitantes</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">ayuda del sistema</h4>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore dignissimos qui molestias ipsum officiis unde aliquid consequatur, accusamus delectus asperiores sunt. Quibusdam veniam ipsa accusamus error. Animi mollitia corporis iusto.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> &nbsp; De acuerdo</button>
                </div>
            </div>
          </div>
        </div>
        <footer class="footer full-reset">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <h4 class="all-tittles">Acerca de</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam quam dicta et, ipsum quo. Est saepe deserunt, adipisci eos id cum, ducimus rem, dolores enim laudantium eum repudiandae temporibus sapiente.
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <h4 class="all-tittles">Desarrollador</h4>
                        <ul class="list-unstyled">
                            <li><i class="zmdi zmdi-check zmdi-hc-fw"></i>&nbsp; Carlos Alfaro <i class="zmdi zmdi-facebook zmdi-hc-fw footer-social"></i><i class="zmdi zmdi-twitter zmdi-hc-fw footer-social"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright full-reset all-tittles">© 2016 Carlos Alfaro</div>
        </footer>
    </div>
</body>
</html>
