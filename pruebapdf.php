<?php
require_once('../mpdf/mpdf.php');
require 'Conexion_Para_Grafico.php';
  $html='<head>
<script src="js/sweet-alert.min.js"></script>
<link rel="stylesheet" href="css/sweet-alert.css">
<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">

<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/modernizr.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/main.js"></script>
  </head>
  <header>
  <img src="assets/img/logo3.png" style="width: 20%; height: 20%; float:left;">
  <h2 class="text-center all-tittles" style="clear: both; ">Control De Becados Unicah</h2>

  </header>
  <hr>
<div class="container-fluid">
<h3 class="text-center all-tittles" style="clear: both; ">Listado De Estudiantes</h3>
<div style="overflow-x:auto;">
  <div class="table-responsive ">

      <div class="div-table " style="margin:0 !important;">
          <div class="div-table-row div-table-row-list" style="background-color:#DFF0D8; font-weight:bold;">
              <div class="div-table-cell" style="width: 6%; float: left;">#</div>
              <div class="div-table-cell" style="width: 15%; float: left;">ID</div>
              <div class="div-table-cell" style="width: 30%; float: left;">Nombre Comleto</div>
              <div class="div-table-cell" style="width: 15%; float: left;">Teléfono</div>
              <div class="div-table-cell" style="width: 30%; float: left;">Correo Electronico</div>
          </div>
      </div>
  </div>';
  $c=1;
  $consulta=mysqli_query($conectar,"SELECT estudiantes.ID_Usuario,estudiantes.Nombre_Completo,carreras.Nombre_Carrera,estudiantes.Correo_Electronico,estudiantes.Numero_Telefono FROM estudiantes INNER JOIN carreras ON carreras.ID_Carrera=estudiantes.ID_Carrera");
$html.='<ul id="itemContainer" class="list-unstyled">';
  while($tabla=mysqli_fetch_assoc($consulta)){
     $html.='
     <table class="table table-hover text-center">
<tr>
                    <th style="width: 6%;">&nbsp;&nbsp;&nbsp;&nbsp;'.$c.'</th>
                    <th style="width: 19%;">'.$tabla['ID_Usuario'].'</th>
                    <th style="width: 30%;">'.$tabla['Nombre_Completo'].'</th>
                    <th style="width: 15%;">'.$tabla['Numero_Telefono'].'</th>
                    <th style="width: 30%;">'.$tabla['Correo_Electronico'].'</th>

</tr>

    </table>
    ';
    $c++;
  }
  $html.='</ul>';
$mpdf=new mPDF('c','A4-L');
//   $css=file_get_contents('css/style.css');
//   $css2=file_get_contents('css/bootstrap.min.css');
//   $css3=file_get_contents('css/normalize.css');
//   $css4=file_get_contents('css/jquery.mCustomScrollbar.css');
//   $mpdf->writeHTML($css4,1);
//   $mpdf->writeHTML($css3,1);
//   $mpdf->writeHTML($css2,1);
//   $mpdf->writeHTML($css,1);
 $mpdf->writeHTML($html);
 $mpdf->Output('ReporteGeneral.pdf','I');
// // Títulos de las columnas

 ?>
