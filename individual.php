<!DOCTYPE html>
<html lang="es">
<head>
  <?php
  session_start();
  //error_reporting(0);
  $LinksRoute="./";
 include './inc/links.php';
include 'prueba.php';
   ?>
  <script src="js/jPages.js"></script>
  <script src="js/SendForm.js"></script>
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
  <?php
  $definidor="";
  $valores="";
if(!is_null($_GET['id'])){
$consule=mysqli_query($link,"SELECT departamento.DepartamentoID,departamento.Nombre,sum(horas_laboradas.Horas_Cumplidas) AS dep1,horas_laboradas.ID_Usuario FROM `departamento`LEFT JOIN horas_laboradas ON horas_laboradas.DepartamentoID=departamento.DepartamentoID AND horas_laboradas.ID_Usuario='".$_GET['id']."'  GROUP BY horas_laboradas.DepartamentoID,departamento.DepartamentoID");
}elseif (!is_null($_SESSION['id'])) {
  $consule=mysqli_query($link,"SELECT departamento.DepartamentoID,departamento.Nombre,sum(horas_laboradas.Horas_Cumplidas) AS dep1,horas_laboradas.ID_Usuario FROM `departamento`LEFT JOIN horas_laboradas ON horas_laboradas.DepartamentoID=departamento.DepartamentoID AND horas_laboradas.ID_Usuario='".$_SESSION['id']."'  GROUP BY horas_laboradas.DepartamentoID,departamento.DepartamentoID");
}
while($contado=mysqli_fetch_array($consule)){
  if(is_null($contado['ID_Usuario'])){
    $m[$contado['DepartamentoID']]=0;

  }else{
      $m[$contado['DepartamentoID']]=$contado['dep1'];

    }
    $definidor.="'".$contado['Nombre']."'".",";
    $valores.=$m[$contado['DepartamentoID']].",";
     }
     mysqli_free_result($consule);
  ?>
<script>
</script>
  <script type="text/javascript" src="grafico.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
      ['Genre', <?php echo $definidor;
      ?> { role: 'annotation' } ],
      ['HORAS', <?php echo $valores; ?> '']
    ]);

    var options = {
      legend: { position: 'top', maxLines: 3 },
      bar: { groupWidth: '75%' },
      isStacked: true
    };
      var chart = new google.visualization.BarChart(document.getElementById('piechart_3d'));
      chart.draw(data, options);
      $(window).resize(function(){
drawChart();
// drawChart2();
});
    }
  </script>
    <title>Reportes</title>
    <meta charset="UTF-8">

    </head>
<body>

  <?php
  include './library/configServer.php'; /// conexion
  include './library/consulSQL.php'; //// consulta
  if (!$_SESSION['UserPrivilege']=='Administrador') {
      header("Location: process/logout.php");
      exit();
  }
  include 'inc/NavLateral.php';
  ?>
  <div class="content-page-container full-reset custom-scroll-containers">
    <?php
        include 'inc/NavUserInfo.php';
        include 'clase_individual.php';
    ?>

        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">Becados Unicah<small>     Reporte  Individual</small></h1>
            </div>
        </div>
        <div class="container-fluid">
        <?php

            echo'<ul class="nav nav-tabs nav-justified" >';
                    if ($_SESSION['UserPrivilege']=='Administrador' && is_null($_GET['idedit'])) {
                echo '<li role="presentation"><a href="report.php" >Informe Grupal</a></li>

                <li role="presentation" class="active"><a href="individual.html" role="tab" data-toggle="tab">Informe Individual</a></li>';
              }elseif ($_SESSION['UserPrivilege']=='Estudiante') {
                echo'<li role="presentation" class="active"><a href="individual.html" role="tab" data-toggle="tab">Informe Individual</a></li>';
              }elseif (!is_null($_GET['idedit']) && !is_null($_SESSION['UserPrivilege']=='Administrador')) {
               echo'<li role="presentation" class="active"><a href="individual.html" role="tab" data-toggle="tab">Informe Individual</a></li>';
             }
             ?>
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
                      <?php


                      if ($_SESSION['UserPrivilege']=='Administrador') {
                      echo'<div class="row">
                      <div class="col-md-8">
                      <right><form class="busqueda" style=" !important;" action="individual.php" method="get" autocomplete="off">
                          <div class="group-material">
                              <input type="search" required="" style="display: inline-block !important;  background-color: rgba(8, 236, 130, 0.44)" class="material-control tooltips-general" placeholder="Buscar estudiante" name="alumno"   maxlength="50" data-toggle="tooltip" data-placement="top"   title="Escribe los nombres, sin los apellidos">
                              <button class="btn" style=" background-color: rgba(8, 186, 103, 0.67) !important;">
                                  <i class="icon-binoculars" style="font-size: 25px;"></i>
                              </button><label>Nombre</label>
                          </div>
                          </form>
                          <right><form class="busqueda"   style=" !important;" action="individual.php" method="get" autocomplete="off">
                          <div class="group-material">
                              <input type="search" required="" style="display: inline-block !important;  background-color: rgba(8, 236, 130, 0.44)" class="material-control tooltips-general" placeholder="Buscar estudiante" name="id"   maxlength="50" data-toggle="tooltip" data-placement="top"   title="Escribe los nombres, sin los apellidos">
                              <button class="btn" style=" background-color: rgba(8, 186, 103, 0.67) !important;">
                                  <i class="icon-binoculars" style="font-size: 25px;"></i>
                              </button><label>Identidad</label>
                          </div>
                        </form></div></div>';
                      }elseif($_SESSION['UserPrivilege']='Estudiante'){
                        echo '
                        <div class="row">
                        <div class="col-md-8">
                        <right><form class="busqueda"   style="width: 30% !important;" action="individual.php" method="get" autocomplete="off"></form>
                      </div>
                      </div>';
                      echo '
                      <div class="row">
                      <div class="col-md-4">
                      <right><form class="busqueda"   style="!important;" action="individual.php" method="get" autocomplete="off">
                      <div class="group-material">
                          <input type="date" required=""  name="fecha" style="display: inline-block !important; width: 70%; background-color: rgba(8, 236, 130, 0.44)" class="material-control tooltips-general" placeholder="Buscar estudiante" name="dep"   maxlength="50" data-toggle="tooltip" data-placement="top"   title="Escribe los nombres, sin los apellidos">
                          <button class="btn" style="margin: 0; height: 43px; background-color: rgba(8, 186, 103, 0.67) !important;">
                              <i class="icon-binoculars" style="font-size: 25px;"></i>
                          </button><label>Fecha</label>
                      </div>
                    </form>
                    </div>
                    </div>';
                      }
                        ?>
                      <div class="row">
                        <div class="col-xs-12">
                          <?php
                          if($_SESSION['UserPrivilege']=='Administrador'){
                          echo '<h3 class="text-center all-tittles">Detalle Del Alumno</h3>';

                           }

                          ?>
                            <div class="table-responsive">
                         <?php
                         $a=1;
                        if(!is_null($_GET['alumno'])){
                           $sql="SELECT estudiantes.ID_Usuario,estudiantes.Nombre_Completo,estudiantes.Correo_Electronico,estudiantes.Numero_Telefono,carreras.Nombre_Carrera,estudiantes.Foto FROM estudiantes INNER JOIN carreras on estudiantes.ID_Carrera=carreras.ID_Carrera Where estudiantes.Nombre_Completo LIKE '%".$_GET['alumno']."%' ORDER By estudiantes.Nombre_Completo ASC";

                       }else if(!is_null($_GET['id'])){
                         $sql="SELECT estudiantes.ID_Usuario,estudiantes.Nombre_Completo,estudiantes.Correo_Electronico,estudiantes.Numero_Telefono,carreras.Nombre_Carrera,estudiantes.Foto FROM estudiantes INNER JOIN carreras on estudiantes.ID_Carrera=carreras.ID_Carrera Where estudiantes.ID_Usuario='".$_GET['id']."' ORDER By estudiantes.Nombre_Completo ASC";

                         $foto=mysqli_query($link,$sql);
                         if(mysqli_num_rows($foto)==1){
                         $foto1=mysqli_fetch_array($foto);
                          echo '<center><img src="'.$foto1['Foto'].'"  style="width: 120px; height: 120px%;"></center>';
                          mysqli_free_result($foto);
                      }
                     }
                       if($_SESSION['UserPrivilege']=='Administrador'){
                         $sqlcont=mysqli_query($link,"SELECT COUNT(*) FROM estudiantes WHERE ID_Usuario='".$_GET['id']."' OR ID_Usuario='".$_GET['alumno']."'");
                         $ad=mysqli_fetch_array($sqlcont);
                         if($ad['COUNT(*)']==0 && is_null($_GET['alumno'])){
                          echo "<center><h1>No hay registros de Alumnos Para Mostrar</h1><center>";
                        }else{
                         if($result =mysqli_query($link, $sql)){
                        echo '<ul id="itemContainer" class="list-unstyled">';
                             echo "<table class='table table-hover text-center'>";
                               echo "<tr>";
                                 echo "<th>#</th>";
                                 echo "<th>Nombre Completo</th>";
                                 echo "<th>ID</th>";
                                 echo "<th>Carrera</th>";
                                 echo "<th>Correo Electronico</th>";
                                 echo "<th>Telefono</th>";
                               echo "</tr>";
                                while ($t=mysqli_fetch_array($result)){
                                   echo "<tr>";
                                   echo "<td>". $a."</td>";
                                   echo "<td class='td1'><a href='individual.php?id=".$t['ID_Usuario']."'>".$t['Nombre_Completo']."</td></a>";
                                   echo "<td class='td1'>".$t['ID_Usuario']."</td>";
                                   echo "<td class='td1'>".$t['Nombre_Carrera']."</td>";
                                   echo "<td class='td1'>".$t['Correo_Electronico']."</td>";
                                   echo "<td class='td1'>".$t['Numero_Telefono']."</td>";
                                   //echo "<td class='td1'><form method='GET' action='individual.php'><input type='submit' name='id' value='$t[ID_Usuario]'></input></form></td>";
                                   echo "</tr>";
                                $a=$a+1;
                                 }
                                 mysqli_free_result($result);
                                 mysqli_free_result($sqlcont);
                                echo "</table>";
                                echo '</ul><div class="holder"></div>';
                                echo '<br><hr style="background-color:rgb(93, 210, 140);"></hr>';

                              }
                            }
                          }
                          ?>

                          </div>
                        </div>
                      </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h3 class="text-center all-tittles">Detalle De Horas Cumplidas</h3>
                                 <div class="table-responsive">
                                  <center><p>META: 900 HORAS</p><center>
                        <?php
                        if($_SESSION['UserPrivilege']=='Administrador'){
                        $sqlhoras=mysqli_query($link,"SELECT COUNT(*) FROM horas_laboradas WHERE ID_Usuario='".$_GET['id']."' OR ID_Usuario='".$_GET['alumno']."' OR ID_Usuario='".$_SESSION['id']."'");
                        $d=mysqli_fetch_array($sqlhoras);
                        $a=1;
                        if(!is_null($_GET['id'])){
                        $sql = "SELECT *,departamento.Nombre FROM horas_laboradas INNER JOIN departamento on departamento.DepartamentoID=horas_laboradas.DepartamentoID Where horas_laboradas.ID_Usuario='".$_GET['id']."'";
                        mysqli_real_escape_string($sql);
                      }else {
                       $sql = "SELECT *,departamento.Nombre FROM horas_laboradas INNER JOIN departamento on departamento.DepartamentoID=horas_laboradas.DepartamentoID Where horas_laboradas.ID_Usuario='0'";
                       mysqli_real_escape_string($sql);
                      }
                        if($result =mysqli_query($link, $sql)){
                          if($d['COUNT(*)']==0 ){
                           echo "<h1>No hay registros de Horas Cumplidas</h1>";
                           }else{
                           $departamento=new individual();
                           $departamento->horas();
                           $departamento->ciclo_detallehora($result);
                           mysqli_free_result($result);
                           mysqli_free_result($sql3);
                           }
                        }else{
          //               echo "Error no se puede ejecutar sentencia $sql. " .mysqli_error($link);
                        }
                        mysqli_close($link);
                    }elseif ($_SESSION['UserPrivilege']=='Estudiante') {
                      $sqlhoras=mysqli_query($link,"SELECT COUNT(*) FROM horas_laboradas WHERE ID_Usuario='".$_SESSION['id']."'");
                      $d=mysqli_fetch_array($sqlhoras);
                      $a=1;
                      $sql = "SELECT *,departamento.Nombre FROM horas_laboradas INNER JOIN departamento on departamento.DepartamentoID=horas_laboradas.DepartamentoID Where horas_laboradas.ID_Usuario='".$_SESSION['id']."'";
                      if($result =mysqli_query($link, $sql)){
                        if($d['COUNT(*)']==0 ){
                         echo "<h1>No hay registros de Horas Cumplidas</h1>";
                         }else{
                         $departamento=new individual();
                         $departamento->horas();
                         $departamento->ciclo_detallehora($result);
                         mysqli_free_result($result);
                         mysqli_free_result($sql3);
                         }
                      }else{
                        echo "Error no se puede ejecutar sentencia $sql. " .mysqli_error($link);
                      }
                      mysqli_close($link);
                    }
                        ?>
                      </div>
                    <br><div class='col-md-12'>
                      <center><p>Grafico De horas Cumplidas Por Departamento</p></center>
                               <div id="piechart_3d"   style="style='width: 100%;
                                 min-height: 280px; position:relative;"></div>
                                                                <!-- <p class="lead text-center"><strong><i class="zmdi zmdi-info-outline"></i>&nbsp; ¡Importante!</strong> Para imprimir esta tabla ve a la sección de reportes y selecciona “Préstamos entregados (por usuarios)”</p> -->
                             </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div role="tabpanel" class="tab-pane fade" id="bitacora">
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
        <?php include './inc/footer.php'; ?>
    </div>
</body>
</html>
