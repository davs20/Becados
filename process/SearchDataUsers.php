<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
$userType=consultasSQL::CleanStringText($_GET['userType']);
$Name=consultasSQL::CleanStringText($_GET['Name']);
if($userType=="Student"){
	$errorMsj="No hay estudiantes registrados en el sistema con el nombre ".$Name;
	$key="NIE";
	$table="estudiante";
	$data_id="formStudents";
	$data_input="inputStudents";
}
if($userType=="Teacher"){
	$errorMsj="No hay docentes registrados en el sistema con el nombre ".$Name;
	$key="DUI";
	$table="docente";
	$data_id="formTeachers";
	$data_input="inputTeachers";
}
if($userType=="Personal"){
	$errorMsj="No hay personal ad. registrado en el sistema con el nombre ".$Name;
	$key="DUI";
	$table="personal";
	$data_id="formPersonals";
	$data_input="inputPersonals";
}
if($Name!=""){
	$SelectData=ejecutarSQL::consultar("SELECT * FROM ".$table." WHERE Nombre LIKE '%".$Name."%' ORDER BY Nombre ASC");
	if(mysql_num_rows($SelectData)>0){
		while ($fila=mysql_fetch_array($SelectData)) {
			if($userType=="Personal"){
				echo '<div class="fileUserSearch" data-key="'.$fila[$key].'" data-input="'.$data_input.'" data-id="'.$data_id.'">'.$fila[$key].'-'.$fila['Nombre'].' '.$fila['Apellido'].'</div>';
			}else{
				$SelectDataSec=ejecutarSQL::consultar("SELECT * FROM seccion WHERE CodigoSeccion='".$fila['CodigoSeccion']."'");
				$dataSec=mysql_fetch_array($SelectDataSec);
				if($userType=="Student"){
					echo '<div class="fileUserSearch" data-key="'.$fila[$key].'" data-input="'.$data_input.'" data-id="'.$data_id.'">'.$fila[$key].' - '.$fila['Nombre'].' '.$fila['Apellido'].' ('.$dataSec['Nombre'].')</div>';
				}else{
					echo '<div class="fileUserSearch" data-key="'.$fila[$key].'" data-input="'.$data_input.'" data-id="'.$data_id.'">'.$fila[$key].' '.$fila['Nombre'].' '.' ('.$dataSec['Nombre'].')</div>';
				}
				mysql_free_result($SelectDataSec);
			}
		}
		echo '
			<script>
				$(".fileUserSearch").on("click", function(){
	                var DataId="#"+$(this).attr("data-id");
	                var DataInput="#"+$(this).attr("data-input");
	                var DataKey=$(this).attr("data-key");
	                $(DataInput).val(DataKey);
	                $(DataId).fadeOut();
	            });
	        </script>
		';
	}else{
		echo $errorMsj;
	}
	mysql_free_result($SelectData);
}