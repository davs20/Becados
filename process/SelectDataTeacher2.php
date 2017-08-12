<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
//$codeTeacher=consultasSQL::CleanStringText($_POST['code']);
$selectTeacher=ejecutarSQL::consultar("SELECT * FROM horas_laboradas WHERE ID_Usuario='".$_GET['idr']."'");
$dataTeacher=mysql_fetch_array($selectTeacher);
$p=1;
$fecha1 = strftime('%Y-%m-%dT%H:%M:%S', strtotime($_GET['f']));

if(mysql_num_rows($selectTeacher)>=1){
  $selectTeache=ejecutarSQL::consultar("SELECT *  FROM horas_laboradas WHERE Fecha_Inicio='".$fecha1."' &&  ID_Usuario='".$_GET['idr']."'");
  $data=mysql_fetch_array($selectTeache);
  $fecha = strftime('%Y-%m-%dT%H:%M:%S', strtotime($data['Horas_Cumplidas']));
  $fecha2=strftime('%Y-%m-%dT%H:%M:%S', strtotime($data['Fecha_FinalReal']));
  $selectTea=ejecutarSQL::consultar("SELECT COUNT(*) FROM departamento");
  $dataTe=mysql_fetch_array($selectTea);

echo '

<div class="group-material">
        <select  class="material-control tooltips-general" name="deup"  required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe los nombres del docente, solamente letras">
        <span class="highlight"></span>
        <span class="bar"></span>';
        $select=ejecutarSQL::consultar("SELECT Nombre FROM departamento WHERE DepartamentoID='".$_GET['dep']."'");
        $data1=mysql_fetch_array($select);

echo'<option selected>'.$data1['Nombre'].'</option>';
        while ($p<=$dataTe['COUNT(*)']) {
          $selectTeache=ejecutarSQL::consultar("SELECT Nombre FROM departamento WHERE DepartamentoID='".$p."'");
          $dataTeache=mysql_fetch_array($selectTeache);
          if($data1['Nombre']!==$dataTeache['Nombre']){
        echo'<option value='.$dataTeache['Nombre'].'>'.$dataTeache['Nombre'].'</option>';
        }
        $p=$p+1;
        }

      echo'<label>Departamento</label>
      </select>
    </div>';
echo '<br><br>
    <div class="group-material">
        <input type="number" class="material-control tooltips-general" value="'.$data['Horas_Cumplidas'].'"   name="horas" required="" maxlength="2" data-toggle="tooltip" data-placement="top" title="Escribe los nombres del docente, solamente letras">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Horas Cumplidas</label>
    </div>

    <div class="group-material">
        <input type="datetime-local" class="material-control tooltips-general"  value="'.$fecha1.'"  name="fechac" required=""  data-toggle="tooltip" data-placement="top" title="Escribe los nombres del docente, solamente letras">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Fecha Inicio</label>
    </div>
    <div class="group-material">
        <input type="hidden" class="material-control tooltips-general"  value="'.$fecha1.'"  name="fechacx" required=""  data-toggle="tooltip" data-placement="top" title="Escribe los nombres del docente, solamente letras">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Fecha Inicio</label>
    </div>
    <div class="group-material">
        <input type="datetime-local" class="material-control tooltips-general" value="'.$fecha2.'"  name="fechac2" required=""  data-toggle="tooltip" data-placement="top" title="Escribe los nombres del docente, solamente letras">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Fecha Fin</label>
    </div>

    <div class="group-material">
        <input type="texttarea" class="material-control tooltips-general" value="'.$data['Comentario'].'" name="Comentario" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe los nombres del docente, solamente letras">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Comentario</label>
    </div>
    ';
 }
mysql_free_result($selectTeacher);
