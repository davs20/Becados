<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
$codigoestudiante=consultasSQL::CleanStringText($_POST['code']);
$selectTeacher=ejecutarSQL::consultar("SELECT * FROM estudiantes WHERE ID_Usuario='".$codigoestudiante."'");
$dataTeacher=mysql_fetch_array($selectTeacher);
if(mysql_num_rows($selectTeacher)>=1){
    echo '
    <legend><strong>Ingrese los siguientes Datos</strong></legend><br>
    <input type="hidden" value="'.$dataTeacher["ID_Usuario"].'" name="identidad" >
    <bold><smal>Recuerde que el numero de identidad es permanente solo se debe modificar en caso de algun error al registrar al alumno previamente</small></bold>
    <br></br>
    <div class="group-material">
        <input type="text" pattern="[0-9]{13}" class="material-control tooltips-general" value="'.$dataTeacher["ID_Usuario"].'"  name="identidad1" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe los nombres del docente, solamente letras">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>ID Nueva</label>
    </div>
    <div class="group-material">
        <input type="text" pattern="[0-9]{13}" class="material-control tooltips-general" value="'.$dataTeacher["ID_Usuario"].'"  name="identidad2" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe los nombres del docente, solamente letras">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>ID</label>
    </div>
    <input type="hidden" value="'.$dataTeacher["Nombre_Completo"].'" name="nombre" >
    <div class="group-material">
        <input type="text" class="material-control tooltips-general" value="'.$dataTeacher["Nombre_Completo"].'" name="nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe los nombres del docente, solamente letras">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Nombre Completo</label>
    </div>
    <input type="hidden" value="'.$dataTeacher["Correo_Electronico"].'" name="correo">
    <div class="group-material">
        <input type="email" class="material-control tooltips-general input-check-user2" value="'.$dataTeacher["Correo_Electronico"].'" placeholder="Correo" name="correo" required="" maxlength="20"  data-toggle="tooltip" data-placement="top" title="Escribe un nombre de usuario sin espacios, que servira para iniciar sesión">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Correo Electronico</label>
        <div class="check-user-bd2"></div>
   </div>
    <div class="group-material">
        <input type="text" class="material-control tooltips-general" value="'.$dataTeacher["Numero_Telefono"].'" name="telefono" pattern="[0-9]{8,8}" required="" maxlength="8" data-toggle="tooltip" data-placement="top" title="Solamente 8 números">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Teléfono</label>
    </div>';
 }
mysql_free_result($selectTeacher);
