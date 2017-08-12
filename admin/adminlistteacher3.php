<!DOCTYPE html>
<html lang="es">
<head>
  <link rel="stylesheet" href="fonts/style.css">
    <title>Editar Horas</title>
    <?php
        session_start();
        $LinksRoute="../";
        include '../inc/links.php';
    ?>
    <script src="../js/jPages.js"></script>
    <script src="../js/SendForm.js"></script>
    <script>
        $(document).ready(function(){
            $(function(){
                $("div.holder").jPages({
                    containerID : "itemContainer",
                    perPage: 20
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
        $TeacherN=consultasSQL::CleanStringText($_GET['idedit']);
    ?>
    <div class="content-page-container full-reset custom-scroll-containers">
        <?php
            include '../inc/NavUserInfo.php';
        ?>
        <div class="container">
            <div class="page-header">
                  <h1 class="all-tittles">Becados UNICAH SI<small>     Administración > Ingresar Horas</small></h1>
            </div>
        </div>
        <div class="conteiner-fluid">
            <ul class="nav nav-tabs nav-justified"  style="font-size: 17px;">

                <li role="presentation" ><a href="adminlistteacher%20-%20copia.php">Ingresar Horas</a></li>
                <li role="presentation" class="active"><a href="adminlistteacher2.php">Editar Horas</a></li>
            </ul>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/user02.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido, en esta sección podra INGRESAR las horas realizadas por el estudiante. <br>

                </div>
            </div>
        </div>

        <div class="container-fluid">
          <form class="busqueda" style="width: 30% !important;" action="adminlistteacher - copia.php" method="get" autocomplete="off">
              <div class="group-material">
                  <input type="search" style="display: inline-block !important; width: 70%; background-color: rgba(8, 236, 130, 0.44)" class="material-control tooltips-general" placeholder="Buscar Horas" name="TeacherN" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚ ]{1,50}" maxlength="50" data-toggle="tooltip" data-placement="top"   title="Escribe los nombres, sin los apellidos">
                  <button class="btn" style="margin: 0; height: 43px; background-color: rgba(8, 186, 103, 0.67) !important;">
                      <i class="icon-binoculars" style="font-size: 25px;"></i>
                  </button>
              </div>

          </form>
          <?php
          if(!is_null($_GET['idedit'])){
            echo'<h2 class="text-center all-tittles" style="clear: both; margin: 25px 0;">Detalle de Horas Cumplidas</h2>';
          }else{
            echo'<h2 class="text-center all-tittles" style="clear: both; margin: 25px 0;">Listado de Estudiantes</h2>';
          }
            ?>
            <div class="table-responsive">
                <div class="div-table" style="margin:0 !important;">
                    <div class="div-table-row div-table-row-list" style="background-color:#DFF0D8; font-weight:bold;">
                        <div class="div-table-cell" style="width: 6%;">#</div>
                        <div class="div-table-cell" style="width: 15%;">ID Usuario</div>
                        <div class="div-table-cell" style="width: 15%;">Departamento</div>
                        <div class="div-table-cell" style="width: 15%;">Fecha Inicio</div>
                        <div class="div-table-cell" style="width: 15%;">Fecha Fin</div>
                        <div class="div-table-cell" style="width: 15%;">Horas_laboradas</div>

                        <div class="div-table-cell" style="width: 9%;">Horas</div>
                        <div class="div-table-cell" style="width: 9%;">Eliminar</div>
                    </div>
                </div>
            </div>
            <?php
                if(!$TeacherN==""){
                    $selectTeacherByName=ejecutarSQL::consultar("SELECT * FROM horas_laboradas INNER JOIN departamento ON horas_laboradas.DepartamentoID=departamento.DepartamentoID WHERE horas_laboradas.ID_Usuario='".$TeacherN."'");
                    if(mysql_num_rows($selectTeacherByName)>=1){
                        echo '<ul id="itemContainer" class="list-unstyled">';
                        $c=1;
                        while($dataT=mysql_fetch_array($selectTeacherByName)){
                            echo '<li>
                                <div class="table-responsive">
                                    <div class="div-table" style="margin:0 !important;">
                                        <div class="div-table-row div-table-row-list">
                                            <div class="div-table-cell" style="width: 6%;">'.$c.'</div>
                                            <div class="div-table-cell" style="width: 15%;">'.$dataT['ID_Usuario'].'</div>
                                            <div class="div-table-cell" style="width: 15%;">'.$dataT['Nombre'].'</div>
                                            <div class="div-table-cell" style="width: 15%;">'.$dataT['Fecha_Inicio'].'</div>
                                            <div class="div-table-cell" style="width: 15%;">'.$dataT['Fecha_FinalReal'].'</div>
                                            <div class="div-table-cell" style="width: 15%;">'.$dataT['Horas_Cumplidas'].'</div>
                                            <div class="div-table-cell" style="width: 9%;"><button class="btn btn-success btn-update"  data-url="../process/SelectDataTeacher2.php?f='.$dataT['Fecha_Inicio'].' && idr='.$dataT['ID_Usuario'].' && dep='.$dataT['DepartamentoID'].'"><i class="zmdi zmdi-refresh"></i></button></div>
                                            <form class="div-table-cell form_SRCB" action="../process/DeleteTeacher2.php?dep='.$dataT['Fecha_Inicio'].' && f='.$dataT['Fecha_Inicio'].'" method="post" data-type-form="delete" style="width: 9%;">
                                                <input value="'.$dataT['ID_Usuario'].'" type="hidden" name="primaryKey">
                                                <button type="submit" class="btn btn-danger"><i class="zmdi zmdi-delete"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>';
                            mysql_free_result($seletSectt);
                            $c++;
                        }
                        echo '</ul><div class="holder"></div>';
                    }else{
                        echo '<br><br><br><h2 class="text-center all-tittles">No Registros de Horas Cumplidas en el sistema "'.$TeacherN.'"</h2><br><br><br>';
                    }
                    mysql_free_result($selectTeacherByName);
                }else{
                    $selectAllTeachers=ejecutarSQL::consultar("SELECT * FROM estudiantes ORDER BY Nombre_Completo");
                    if(mysql_num_rows($selectAllTeachers)>=1){
                        echo '<ul id="itemContainer" class="list-unstyled">';
                        $c=1;
                        while($data=mysql_fetch_array($selectAllTeachers)){
                            $seletSect=ejecutarSQL::consultar("SELECT * FROM estudiantes  where Nombre_Completo='".$data['Nombre_Completo']."'");
                            $dataS=mysql_fetch_array($seletSect);
                            echo '<li>
                                <div class="table-responsive">
                                    <div class="div-table" style="margin:0 !important;">
                                        <div class="div-table-row div-table-row-list">
                                            <div class="div-table-cell" style="width: 6%;">'.$c.'</div>
                                            <div class="div-table-cell" style="width: 15%;">'.$data['ID_Usuario'].'</div>
                                            <div class="div-table-cell" style="width: 15%;"><a href="../adminlistteacher3.php?idedit='.$data['ID_Usuario'].'">'.$data['Nombre_Completo'].'</div></a>
                                            <div class="div-table-cell" style="width: 15%;">'.$data['Numero_Telefono'].'</div>
                                            <div class="div-table-cell" style="width: 15%;">'.$data['Correo_Electronico'].'</div>
                                            <div class="div-table-cell" style="width: 9%;"><button class="btn btn-success btn-update"  data-url="../process/SelectDataTeacher2.php?f='.$data['Fecha_Inicio'].' && idr='.$data['ID_Usuario'].' && dep='.$data['DepartamentoID'].'"><i class="zmdi zmdi-refresh"></i></button></div>
                                            <form class="div-table-cell form_SRCB" action="../process/DeleteTeacher2.php?dep='.$data['DepartamentoID'].' && f='.$data['Fecha_Inicio'].'" method="post" data-type-form="delete" style="width: 9%;">
                                                <input value="'.$data['ID_Usuario'].'" type="hidden" name="primaryKey">
                                                <button type="submit" class="btn btn-danger"><i class="zmdi zmdi-delete"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>';
                            mysql_free_result($seletSect);
                            $c++;
                        }
                        echo '</ul><div class="holder"></div>';
                    }else{
                        echo '<br><br><br><h2 class="text-center all-tittles">No Registros de Horas Cumplidas en el sistema</h2><br><br><br>';
                    }
                    mysql_free_result($selectAllTeachers);
                }
            ?>


        </div>

        <div class="msjFormSend"></div>
        <div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <?php
           echo'<form class="form_SRCB modal-content" action="../process/UpdateTeacher - copia.php?idup='.$_GET['idedit'].'" method="post" data-type-form="update"  autocomplete="off">';
           //echo $_GET['idedit'];
               ?>
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center all-tittles">Actualizar Horas Cumplidas</h4>
              </div>
              <div class="modal-body" id="ModalData"></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success"><i class="zmdi zmdi-refresh"></i> &nbsp;&nbsp; Guardar cambios</button>
              </div>
            </form>
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
                    <?php include '../help/help-adminlistteacher.php'; ?>
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
