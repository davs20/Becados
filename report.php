
<?php
include 'Conexion_Para_Grafico.php';
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php
      session_start();
      $LinksRoute="./";
      include './inc/links.php';
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
  <script type="text/javascript" src="grafico.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Trabajo', 'Horas por Dia'],
        <?php
        $x=1;
        while ($x <=$resultado['COUNT(*)']) {
          $nombref=mysqli_query($conectar,"SELECT Nombre_Carrera FROM carreras WHERE ID_Carrera='".$x."'");
          $resultadonomb=mysqli_fetch_array($nombref);
          if($x==$resultado['COUNT(*)']){
           echo"['$resultadonomb[Nombre_Carrera]',$cant_car[$x]]";
         }else{
        echo"['$resultadonomb[Nombre_Carrera]',$cant_car[$x]],";
        }
            $x=$x+1;
        }
        ?>
      ]);
      var options = {
        title: 'Cantidad De Horas Por Facultad',
        is3D: true,
      };
      var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
      chart.draw(data, options);
    }
  </script>



    <title>Reportes</title>
</head>
<body>
  <?php
  include './library/configServer.php';
  include './library/consulSQL.php';
  if (!$_SESSION['UserPrivilege']=='Administrador') {
       header("Location: process/logout.php");
       exit();
  }
  include './inc/NavLateral.php';
  ?>

    <div class="content-page-container full-reset custom-scroll-containers">
      <?php
          include './inc/NavUserInfo.php';
      ?>

        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">Sistema becario <small>Reportes y estadísticas</small></h1>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation" class="active"><a href="report.htm" >Informe Grupal</a></li>
                <li role="presentation"><a href="individual.php">Informe Individual</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="statistics">
                    <div class="container-fluid"  style="margin: 50px 0;">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <img src="assets/img/chart.png" alt="chart" class="img-responsive center-box" style="max-width: 120px;">
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                                Bienvenido al área de estadísticas, aquí puedes ver los alumnos becados por Carrera.

                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="page-header">
                          <h2 class="all-tittles">Reporte <small> general</small></h2>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h3 class="text-center all-tittles">Total de Alumnos</h3>
                                <div class="table-responsive">
                                  <?php
                                  $a=1;
                                  $sql=ejecutarSQL::consultar("SELECT estudiantes.ID_Usuario,estudiantes.Nombre_Completo,carreras.Nombre_Carrera,estudiantes.Correo_Electronico,estudiantes.Numero_Telefono,IF(SUM(horas_laboradas.Horas_Cumplidas) IS NULL,0,SUM(horas_laboradas.Horas_Cumplidas)) AS Horas_Cumplidas FROM estudiantes INNER JOIN carreras ON carreras.ID_Carrera=estudiantes.ID_Carrera LEFT JOIN horas_laboradas ON horas_laboradas.ID_Usuario=estudiantes.ID_Usuario GROUP BY horas_laboradas.ID_Usuario,estudiantes.Nombre_Completo,estudiantes.ID_Usuario");
                                  if($sql){
                                    echo '<ul id="itemContainer" class="list-unstyled">';
                                      echo "<table class='table table-hover text-center'>";
                                        echo "<tr>";
                                          echo "<th>#</th>";
                                          echo "<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre Completo</th>";
                                          echo "<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ID</th>";
                                          echo "<th>Carrera</th>";
                                          echo "<th>Horas Completadas</th>";
                                        echo "</tr>";
                                      while($row = mysql_fetch_array($sql)){
                                          if(is_null($row['Meta']) && $row['SUM(horas_laboradas.Horas_Cumplidas)']==900){
                                             require 'PHPMailerAutoload.php';
                                              $mail = new PHPMailer;
                                               $mail->isSMTP();                                      // Set mailer to use SMTP
                                               $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                                               $mail->SMTPAuth = true;                               // Enable SMTP authentication
                                               $mail->Username = 'franando14@gmail.com';                 // SMTP username
                                               $mail->Password = '09dejulio';                           // SMTP password
                                               $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                                               $mail->Port = 587;                                    // TCP port to connect to
                                                 $mail->setFrom('franando14@gmail.com', 'DAVID DELCID');
                                                 $mail->addAddress($row['Correo_Electronico'],$row['Nombre_Completo']);     // Add a recipient
                                                 $mail->isHTML(true);                                  // Set email format to HTML
                                                 $mail->Subject = 'Control De horas Para Becados UNICAH';
                                                 $mail->Body    = 'Felicidaddes ha alcanzado la meta de 900 horas ingrese a la pagina para saber mas detalles ';
                                                 $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                                                if(!$mail->send()) {
                                                  echo 'No se pudo mandar el correo.';
                                                  echo 'Mailer Error: ' . $mail->ErrorInfo;
                                                 } else {
                                                    echo '<script type="text/javascript">
                                                    swal({
                                                    title:"¡Mensaje de Notificacion ha sido enviada!",
                                                    text:"Para Ver el detalle de los alumnos que han alcanzado la meta Acceda Aqui ,
                                                    type: "success",
                                                    confirmButtonText: "Aceptar"
                                                    });
                                                    </script>';
                                                    $fields="Meta=1";
                                                    consultasSQL::UpdateSQL("estudiantes", $fields, "ID_Usuario='".$row['ID_Usuario']."'");

                                                        }

                                      }

                                        echo "<tr>";
                                          echo "<td>" . $a. "</td>";
                                          echo "<td><a href='individual.php?id=$row[ID_Usuario]&nom=$row[Nombre_Completo]&tel=$row[Numero_Telefono]&co=$row[Correo_Electronico]&car=$row[Nombre_Carrera]&h=$row3[horas]'>" . $row['Nombre_Completo'] . "</a></td>";
                                          echo "<td>" . $row['ID_Usuario'] . "</td>";
                                          echo "<td>" . $row['Nombre_Carrera'] . "</td>";
                                          echo "<td>" . $row['Horas_Cumplidas'] . "</td>";
                                        echo "</tr>";
                                       $a=$a+1;
                                      }

                                      echo "</table></center>";
                                        echo '</ul><div class="holder"></div>';
                                      mysqli_free_result($result);
                                  }else{
                                    echo "Error no se puede ejecutar sentencia $sql. " .mysqli_error($link);
                                  }

                                  ?>
                          </div>
                                    <div id="piechart_3d" style="width: auto; height: 350px;"></div>
                                    <p>Este grafico muestra el Avance de horas de becados  por facultad</p>
                                    <a href="reporte_general.php"><input  class="btn" style="margin: 0; height: 43px; background-color: transparent !important;" type="button" value="Imprimir Reporte"></a>
                                </div>
                               <div>
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

        <?php include './inc/footer.php'; ?>
</div>
</body>
</html>
