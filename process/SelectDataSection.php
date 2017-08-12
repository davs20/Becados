<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
$codeSection=consultasSQL::CleanStringText($_POST['code']);
$selectSection=ejecutarSQL::consultar("SELECT * FROM seccion WHERE CodigoSeccion='".$codeSection."'");
$dataSection=mysql_fetch_array($selectSection);
if(mysql_num_rows($selectSection)>=1){
    echo '
    <legend><strong>Información de la sección</strong></legend><br>
    <input type="hidden" value="'.$codeSection.'" name="sectionCode">
    <div class="group-material">
        <span>Nombre de la sección</span>
        <input type="text" class="material-control" readonly value="'.$dataSection['Nombre'].'">
    </div>
    <div class="group-material">
        <span>Encargado de la sección</span>
        <select class="material-control tooltips-general" name="teacherDUI" data-toggle="tooltip" data-placement="top" title="Elige el docente encargado">';
            $checkCurretTeacher=ejecutarSQL::consultar("SELECT * FROM docente WHERE CodigoSeccion='".$codeSection."'");
            $datCurrent=mysql_fetch_array($checkCurretTeacher);
            if(mysql_num_rows($checkCurretTeacher)>=1){
                echo '<option value="'.$datCurrent['DUI'].'">'.$datCurrent['Nombre'].' '.$datCurrent['Apellido'].'</option>';
                $checkTeacherSection=ejecutarSQL::consultar("SELECT * FROM docente WHERE CodigoSeccion <> '".$codeSection."' ORDER BY Nombre ASC");
                while($row=mysql_fetch_array($checkTeacherSection)){
                    echo '<option value="'.$row['DUI'].'">'.$row['Nombre'].' '.$row['Apellido'].'</option>';
                }
            }else{
                echo '<option value="" disabled="" selected="">Selecciona un docente</option>';
                $checkAllTeachers=ejecutarSQL::consultar("SELECT * FROM docente ORDER BY Nombre ASC");
                while($fila=mysql_fetch_array($checkAllTeachers)){
                    echo '<option value="'.$fila['DUI'].'">'.$fila['Nombre'].' '.$fila['Apellido'].'</option>';
                }
            }
            mysql_free_result($checkTeacherSection);
            mysql_free_result($checkCurretTeacher);
            mysql_free_result($checkAllTeachers);
        echo '</select>
    </div>
    ';

}else{
    echo '<div class="alert alert-danger text-center" role="alert"><strong><i class="zmdi zmdi-alert-triangle"></i> &nbsp; ¡Error!:</strong> Lo sentimos ha ocurrido un error.</div>';
}
mysql_free_result($selectSection);