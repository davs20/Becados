<!DOCTYPE html>
<html lang="es">
<head>
  <script>
window.onload = function(){killerSession();}
function killerSession(){
setTimeout("window.open('index.php','_top');",90000);
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
        include './library/configServer.php'; /// conexion
        include './library/consulSQL.php'; //// consulta
        if (!$_SESSION['UserPrivilege']=='Admin' && $_SESSION['SessionToken']=="") {
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
              <h1 class="all-tittles">Sistema de Becados <small>Inicio</small></h1>
            </div>
        </div>
        <div class="row">
 <div class="ih-item circle effect3 left_to_right"><a href="#">
        <div class="img"><img src="images/assets/4.jpg" alt="img"></div>
        <div class="info">
          <h3>Heading here</h3>
          <p>Description goes here</p>
        </div></a></div>
  </div>
        
        <?php
            mysql_free_result($checkAdmins);
            mysql_free_result($checkStudents);
            mysql_free_result($checkTeachers);
            mysql_free_result($checkProviders);
            mysql_free_result($checkBooks);
            mysql_free_result($checkCategories);
            mysql_free_result($checkSections);
            mysql_free_result($checkPersonalA);
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
