<?php
require_once "Conexion_calendario.php";
require_once "Conexion_graduados.php";
require_once "Conexion_Para_Grafico.php";
 ?>
 <?php
$m = array("","","","","");
     session_start();
     $LinksRoute="./";
    //include './inc/links.php';
   include 'prueba.php';
$contador=1;
$contar=mysqli_query($link,"SELECT COUNT(*) FROM Departamento");
$con=mysqli_fetch_array($contar);
while($contador<=$con['COUNT(*)']){
     $consulta=mysqli_query($link,"SELECT SUM(Horas_Cumplidas) as dep1 FROM horas_laboradas Where ID_Usuario='".$_SESSION['id']."' AND DepartamentoID='".$contador."'");
     $dep1=mysqli_fetch_array($consulta);
     $m[$contador]=$dep1['dep1'];
     if(is_null($m[$contador])){
       $m[$contador]=0;
     }
    $contador=$contador+1;
    }
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <script type="text/javascript" src="grafico.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
      ['Genre', 'Contabilidad', 'Pastoral', 'Bienestar', 'Registro',
       'Auditoria', { role: 'annotation' } ],
      ['HORAS', <?php echo $m[1]; ?>,<?php echo $m[2]; ?>,<?php echo $m[3]; ?>,<?php echo $m[4]; ?>,<?php echo $m[5]; ?>, '']
    ]);

    var options = {
      width: 1000,
      height: 200,
      legend: { position: 'top', maxLines: 3 },
      bar: { groupWidth: '75%' },
      isStacked: true
    };
      var chart = new google.visualization.BarChart(document.getElementById('piechart_3d'));
      chart.draw(data, options);
    }
  </script>
  <!-- <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> -->
   <script>
window.onload = function(){killerSession();}
function killerSession(){
setTimeout("window.open('process/logout.php','_top');",9000000);
}
</script>

    <title>Inicio</title>
    <?php
        session_start();
        $LinksRoute="./";
        include './inc/links.php';
    ?>
    <link rel="stylesheet" href="/fonts/style.css">
    <link rel="stylesheet" href="<?php echo $LinksRoute; ?>css/font-awesome.min.css">
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
              <h1 class="all-tittles" >Sistema de Becados <small>Inicio</small></h1>
            </div>
        </div>
<?php
if ($_SESSION['UserPrivilege']=="Administrador") {
           $checkStudents=ejecutarSQL::consultar("SELECT * FROM estudiantes");
             $checkPersonalA=ejecutarSQL::consultar("SELECT * FROM carreras");
             $checkSections=ejecutarSQL::consultar("SELECT * FROM departamento");
             $checkPersonalb=ejecutarSQL::consultar("SELECT * FROM estudiantes WHERE Meta=1");
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
            <article class="tile" data-href="./admin/adminliststudent.php">
                <div class="tile-icon full-reset"><i class="fa fa-forumbee"></i></div>
                <div class="tile-name all-tittles">Foro</div>
                <div class="tile-num full-reset">0</div>
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
            <article class="tile" data-href="./admin/adminlistsection.php" data-num='.$dep.'>
                <div class="tile-icon full-reset"><i class="fa fa-briefcase"></i></div>
                <div class="tile-name all-tittles">Departamentos</div>
                <div class="tile-num full-reset">'.$dep.'</div>
            </article>
        </section>';
      }elseif ($_SESSION['UserPrivilege']=='Estudiante') {
        echo "<center><h1>Bienvenido(a),$_SESSION[Estudiante]</h1>";
        echo "<h2>Grafico Horas Cumplidas<h2></center>";
        echo"<center><div id='piechart_3d'   style='width: auto; height: auto;'></div></center>";
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
