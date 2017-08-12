<!DOCTYPE html>
<html lang="es">
<head>
  <script>
window.onload = function(){killerSession();}
function killerSession(){
setTimeout("window.open('index.php','_top');",900000000);
}
</script>

    <title>Inicio</title>
    <?php
        session_start();
        $LinksRoute="./";
        include './inc/links.php';
        if (!$_SESSION['UserPrivilege']=='Administrador') {
             header("Location: process/logout.php");
             exit();
        }
    ?>
    <link rel="stylesheet" href="<?php echo $LinksRoute; ?>css/font-awesome.min.css">
</head>
<body>
    <?php
        include './library/configServer.php';
        include './library/consulSQL.php';
        // if (!$_SESSION['UserPrivilege']=='Administrador' && $_SESSION['SessionToken']=="") {
        //     header("Location: process/logout.php");
        //     exit();
        // }
        include './inc/NavLateral.php';
    ?>
    <div class="content-page-container full-reset custom-scroll-containers">
        <?php
            include './inc/NavUserInfo.php';
        ?>
        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">Sistema de Becados <small>Ingreso De horas</small></h1>
            </div>
        </div>
        <div class="container">

          <div class="row">
          <div class="col-xs-9">
<?php
$selectTeacher=ejecutarSQL::consultar("SELECT * FROM estudiantes WHERE ID_Usuario='".$_GET['id']."'");
$consudep=ejecutarSQL::consultar("SELECT * FROM `departamento` ORDER BY `departamento`.`DepartamentoID` ASC");
$dataTeacher=mysql_fetch_array($selectTeacher);
$cont=0;
if(mysql_num_rows($selectTeacher)>=1){
  echo'<br>
  <center><form method=POST action="process/AddStudenthoras.php?id='.$_GET['id'].'"  style="margin-left:20%">';
while ($depo=mysql_fetch_array($consudep)) {
  echo'<br>
  <div  class="group-material"  >
      <label>'.$depo['Nombre'].'</label>
  </div><br>
  <div  class="group-material">
      <input type="datetime-local" class="material-control tooltips-general"  name="depar['.$cont.'][]"   maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe los apellidos del docente, solamente letras">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Fecha de Inicio</label>
  </div><br>

  <div  class="group-material">
      <span class="highlight"></span>
      <input type="datetime-local" class="material-control tooltips-general"  name="depar['.$cont.'][]"   maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe los apellidos del docente, solamente letras">
      <span class="bar"></span>
      <label>Fecha de Fin Real</label>
  </div><br>
  <div class="group-material">
  <textarea name="depar['.$cont.'][]" rows="5" cols="66" placeholder="Escribe tus Comentarios"></textarea>
  </div><br><br>';
  $cont++;
}
echo'<p class="text-center">
    <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
    <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>
</p>
';
echo '</form>';
}
?>

 </div></center>
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
