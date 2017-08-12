<?php
require_once "Conexion_calendario.php";
require_once "Conexion_graduados.php";
require_once "Conexion_Para_Grafico.php";
//system_report(0)
 ?>
 <?php
$m = array("","","","","");
     session_start();
     $LinksRoute="./";
    //include './inc/links.php';
   include 'prueba.php';
   $valores="";
   $definidor="";
$contador=1;
if($_SESSION['id']<>0){
$consule=mysqli_query($link,"SELECT departamento.DepartamentoID,departamento.Nombre,sum(horas_laboradas.Horas_Cumplidas) AS dep1,horas_laboradas.ID_Usuario FROM `departamento`LEFT JOIN horas_laboradas ON horas_laboradas.DepartamentoID=departamento.DepartamentoID AND horas_laboradas.ID_Usuario='".$_SESSION['id']."'  GROUP BY horas_laboradas.DepartamentoID,departamento.DepartamentoID");
while($contado=mysqli_fetch_array($consule)){
  if(is_null($contado['ID_Usuario'])){
    $m[$contado['DepartamentoID']]=0;

  }else{
      $m[$contado['DepartamentoID']]=$contado['dep1'];
    }
    if(!is_null($m[$contado['DepartamentoID']]) && !is_null($contado['Nombre'])){
    $definidor.="'".$contado['Nombre']."'".",";
    $valores.=$m[$contado['DepartamentoID']].",";
  }
  }
  mysqli_free_result($consule);
}

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <script src="js/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="js/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <script type="text/javascript">
  $(document).keydown(function(tecla){
            if (tecla.keyCode == 8) {
            alet("loooo");
            }
        });
  </script>
  <script type="text/javascript" src="grafico.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
      ['Genre', <?php echo $definidor; ?> { role: 'annotation' } ],
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
  <link href="style3.css" rel="stylesheet">
   <script>
window.onload = function(){killerSession();}
function killerSession(){
setTimeout("window.open('process/logout.php','_top');",9000000);
}
</script>

    <title>Inicio</title>
    <?php
        //session_start();
        $LinksRoute="./";
        include './inc/links.php';
    ?>
    <link rel="stylesheet" href="/fonts/style.css">
    <link rel="stylesheet" href="<?php echo $LinksRoute; ?>css/font-awesome.min.css">
</head>
<body class="full-cover-background">

    <?php

        include './library/configServer.php';
        include './library/consulSQL.php';
        include './inc/NavLateral.php';
        $fecha=strftime( "%Y-%m-%d-%H-%M-%S", time() );
    ?>
    <div class="content-page-container full-reset custom-scroll-containers">
        <?php
            include './inc/NavUserInfo.php';
        ?>
        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles" >Sistema de Becados <small>Inicio</small></h1>
            </div>
        </div>
<?php
if ($_SESSION['UserPrivilege']=="Administrador") {
           $checkStudents=ejecutarSQL::consultar("SELECT * FROM estudiantes");
             $checkPersonalA=ejecutarSQL::consultar("SELECT * FROM carreras");
             $checkSections=ejecutarSQL::consultar("SELECT * FROM departamento");
             $checkPersonalb=ejecutarSQL::consultar("SELECT * FROM Meta WHERE Horas_Cumplidas=900");
             $sql = "SELECT * FROM estudiantes";
             $result =mysqli_query($link, $sql);
             while($row = mysqli_fetch_array($result)){
             $sql3=mysqli_query($link,"SELECT SUM(Horas_Cumplidas) AS horas FROM horas_laboradas where ID_Usuario=".$row['ID_Usuario']."");
             $row3=mysqli_fetch_array($sql3);
             if(is_null($row3['horas'])){
               $row3['horas']=0;
             }
           if($row['Meta']==0 && $row3['horas']==900){
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
                          title:"¡Notificacion Enviada!",
                          text:"Uno o mas Estudiantes han alcanzado la Meta puede ver la listado de alumnos",
                          type: "success",
                          confirmButtonText: "Aceptar"
                       });

                   </script>';
                         mysqli_query($link,"UPDATE estudiantes SET Meta=1 WHERE ID_Usuario=".$row['ID_Usuario']."");
                         }

                        }
                         }
$carreras=mysql_num_rows($checkPersonalA);
$alumno=mysql_num_rows($checkStudents);
$dep=mysql_num_rows($checkSections);
$meta=mysql_num_rows($checkPersonalb);
      echo'<section class="full-reset text-center" style="padding: 40px 0;">
            <article class="tile" data-href="./admin/adminlistuser.php" >
                <div class="tile-icon full-reset"><i class="fa fa-expeditedssl"></i></div>
                <div class="tile-name all-tittles">Administradores</div>
                <div class="tile-num full-reset">1</div>
            </article>

            <article class="tile" data-href="calendario.php" data-num='.$res[cantidad].'>
                <div class="tile-icon full-reset"><i class="fa fa-calendar"></i></div>
                <div class="tile-name all-tittles">Eventos</div>
                <div class="tile-num full-reset">'.$res[cantidad].'</div>
            </article>

            <article class="tile" data-href="Carreras.php" data-num='.$carreras.'>
                <div class="tile-icon full-reset"><i class="fa fa-university"></i></div>
                <div class="tile-name all-tittles" style="width: 90%;">Carreras</div>
                <div class="tile-num full-reset">'.$carreras.'</div>
            </article>
            <article class="tile" data-href="./metas.php" data-num='.$meta.'>
                <div class="tile-icon full-reset"><i class="fa fa-graduation-cap"></i></div>
                <div class="tile-name all-tittles">Metas Alcanzadas</div>
                <div class="tile-num full-reset">'.$meta.'</div>
            </article>
            <article class="tile" data-href="./catalog.php" data-num='.$alumno.'>
                <div class="tile-icon full-reset"><i class="fa fa-user"></i></div>
                <div class="tile-name all-tittles">Alumnos</div>
                <div class="tile-num full-reset"> '.$alumno.'</div>
            </article>
            <article class="tile" data-href="./admin/adminlistcategory.php" >
                <div class="tile-icon full-reset"><i class="fa fa-users"></i></div>
                <div class="tile-name all-tittles">Invitados</div>
                <div class="tile-num full-reset">0</div>
            </article>
            <article class="tile" data-href="departamentos.php" data-num='.$dep.'>
                <div class="tile-icon full-reset"><i class="fa fa-briefcase"></i></div>
                <div class="tile-name all-tittles">Departamentos</div>
                <div class="tile-num full-reset">'.$dep.'</div>
            </article>
        </section>';

        //HO
        while($row = mysqli_fetch_array($result)){
          $sql2=mysqli_query($link,"SELECT Nombre From Departamento WHERE DepartamentoID='".$row['DepartamentoID']."'");
           $row2=mysqli_fetch_array($sql2);
           if(is_null($_GET['id'])){
             $_GET['id']=0;
           }else if (is_null($_GET['alumnoid'])) {
             $_GET['alumnoid']=0;
           }elseif (is_null($_GET['horas'])) {
             $_GET['horas']=0;
           }
           $sql3=mysqli_query($link,"SELECT SUM(Horas_Cumplidas) as total FROM horas_laboradas WHERE ID_Usuario='".$_GET['id']."' OR  ID_Usuario='".$_GET['alumnoid']."' OR ID_Usuario='".$_GET['horas']."' " );
           $row3=mysqli_fetch_array($sql3);
           if($row3['total']==""){
             echo "<h1>No hay registros Para Mostrar</h1>";
           }
          echo "<tr>";
            echo "<td style='padding-left: 100px; '>". $a."</td>";
            echo "<td class='td1'>".$row2['Nombre']."</td>";
            echo "<td class='td1'>".$row['Fecha_Inicio']."</td>";
            echo "<td class='td1'>".$row['Horas_Cumplidas']."</td>";
            echo "</tr>";
            //echo "<th>" . $row3['total'] . "</th>";
            mysqli_free_result($row3);
            mysqli_free_result($row2);
            mysqli_free_result($row);
         $a=$a+1;
       }
        //NO
      }elseif ($_SESSION['UserPrivilege']=='Estudiante') {
        $cop=mysqli_connect("localhost","root","admin");
        $selecr=mysqli_select_db($cop,"eventos");
        $fechaactual = getdate();
        $fecha1=$fechaactual['mday']."/".$fechaactual['mon']."/".$fechaactual['year'];
        $consult1a=mysqli_query($cop,"SELECT * from eventos where class='event-warning'");
        $consult12a=mysqli_fetch_assoc($consult1a);
        $consulta3=mysqli_query($link,"SELECT SUM(Horas_Cumplidas) as hy FROM horas_laboradas WHERE ID_Usuario='".$_SESSION['id']."'");
        $resultadoss=mysqli_fetch_array($consulta3);

        echo "<div class='row'>
          <div class='col-xs-12'><center><h2>Bienvenido(a),$_SESSION[Estudiante]</h2>";
        if(!is_null($consult12a['title'])){
echo $fecha;
        // echo'<article style="width: 60%; height="60%;"" class="col s12">
        //     <h4>AVISOS!</h4>
        //     <hr>
        //     <center><ul class="timeline">
        //         <li>
        //             <div class="timeline-badge bg-info"><i ></i></div>
        //             <div class="timeline-panel">
        //                 <div class="timeline-heading">
        //                     <h4 class="timeline-title">'.$consult12a['title'].'</h4>
        //                     <p><small ><i ></i></small></p>
        //                 </div>
        //                 <div class="timeline-body">
        //                     <p>'.$consult12a['body'].'</p>
        //                 </div>
        //             </div>
        //         </li>
        //     </ul></center>
        // </article>';
      }
         echo"<br>";
         echo"<br>";
         echo"<br>";
        echo "<h3>Grafico Horas Cumplidas<h3></center>
        <center><h4>Total de horas trabajadas:$resultadoss[hy]</h4></center>";

           echo '<br>';

        echo"<div class='col-md-12'>
<div id='piechart_3d' style='width: 100%;
  min-height: 200px; position:relative;'></div>

</div>
</div>
</div>";


      }

       ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">

          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>


                    <h4 class="modal-title text-center all-tittles">ayuda del sistema</h4>
                </div>
                <div class="modal-body">
                    <?php include './help/help-home.php'; ?>
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
