<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
$code=consultasSQL::CleanStringText($_POST['code']);
$selectTeacher=ejecutarSQL::consultar("SELECT * FROM estudiantes WHERE ID_Usuario='".$code."'");
$dataTeacher=mysql_fetch_array($selectTeacher);
if(mysql_num_rows($selectTeacher)>=1){
    echo '
    <legend><strong>Ingrese las Horas Por departamento</strong></legend><br>
    <input type="hidden" value="" name="teachingDUI" >
    <div class="group-material">
        <input type="number" class="material-control tooltips-general" value="0" name="contabilidad"  required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Ingresa la Cantidad de Horas" placeholder="Ingrese la cantidad de las horas">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Contabilidad</label>
    </div>
    <div class="group-material">
    <textarea name="comentariosc" rows="5" cols="66">Escribe aquí tus comentarios</textarea>
    </div>
    <div class="group-material">
        <input type="datetime-local" class="material-control tooltips-general" value="0" name="fc" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe los apellidos del docente, solamente letras">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Fecha de Inicio</label>
    </div><hr></hr><br>

    <div class="group-material">
        <input type="number" class="material-control tooltips-general" value="0" name="pastoral" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Ingresa la Cantidad de Horas" placeholder="Ingrese la cantidad de las horas">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Pastoral</label>
    </div>
    <div class="group-material">
    <textarea name="comentariospa" rows="5" cols="66">Escribe aquí tus comentarios</textarea>
    </div>
    <div class="group-material">
        <input type="datetime-local" class="material-control tooltips-general" value="0" name="fp" pattern="[0-9]{8,8}" required="" maxlength="8" data-toggle="tooltip" data-placement="top" title="Solamente 8 números">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Fecha de inicio</label>
    </div><br>
<hr></hr>
</br>
    <div class="group-material">
        <input type="number" class="material-control tooltips-general" value="0" name="bienestar" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Ingresa la Cantidad de Horas" placeholder="Ingrese la cantidad de las horas">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Bienestar</label>
    </div>
    <div class="group-material">
    <textarea name="comentarios" rows="5" cols="66">Escribe aquí tus comentariosb</textarea>
    </div>
    <div class="group-material">
        <input type="datetime-local" class="material-control tooltips-general" value="0" name="fb" pattern="[0-9]{8,8}" required="" maxlength="8" data-toggle="tooltip" data-placement="top" title="Solamente 8 números">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Fecha de inicio</label>
    </div><br><hr></hr></br>
    <div class="group-material">
        <input type="number" class="material-control tooltips-general" value="0" name="Registro" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Ingresa la Cantidad de Horas" placeholder="Ingrese la cantidad de las horas">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Registro</div>
        <div class="group-material">
        <textarea name="comentariosr" rows="5" cols="66" placeholder="Escribe Aqui Tus comentarios"></textarea>
        </div>
    <div class="group-material">
        <input type="datetime-local" class="material-control tooltips-general" value="0" name="fr" pattern="[0-9]{8,8}" required="" maxlength="8" data-toggle="tooltip" data-placement="top" title="Solamente 8 números">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Fecha de inicio</label>
    </div><br><hr></hr></br>
    <div class="group-material">
        <input type="number" class="material-control tooltips-general" value="0" name="Auditoria"   maxlength="2" data-toggle="tooltip" data-placement="top" title="Ingresa la Cantidad de Horas" placeholder="Ingrese la cantidad de las horas">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Bienestar</label>
    </div>
    <div class="group-material">
    <textarea name="comentariosa" rows="5" cols="66">Escribe aquí tus comentarios</textarea>
    </div>
    <div class="group-material">
        <input type="datetime-local" class="material-control tooltips-general" value="0" name="fa"  required="" maxlength="8" data-toggle="tooltip" data-placement="top" title="Solamente 8 números">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Fecha de inicio</label>
    </div><br></br><hr></hr>
  


    <script>
        $(document).ready(function(){
            $(".input-check-user2").keyup(function(){
                var userType=$(this).attr("data-user");
                var userName=$(this).val();
                $.ajax({
                    url:"../process/check-user.php?userName="+userName+"&&userType="+userType,
                    success:function(data){
                       $(".check-user-bd2").html(data);
                    }
                });
            });
        });
    </script>';
}else{
    echo '<div class="alert alert-danger text-center" role="alert"><strong><i class="zmdi zmdi-alert-triangle"></i> &nbsp; ¡Error!:</strong> Lo sentimos ha ocurrido un error.</div>';
}
mysql_free_result($selectTeacher);
