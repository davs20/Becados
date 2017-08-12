
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
    <link rel="stylesheet" href="<?php echo $LinksRoute; ?>css/font-awesome.min.css">
</head>
<body>
    <?php
        include './library/configServer.php';
        include './library/consulSQL.php';
        // if (!$_SESSION['UserPrivilege']=='Admin' && $_SESSION['SessionToken']=="") {
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
              <h1 class="all-tittles">Sistema de Becados <small>Inicio</small></h1>
            </div>
        </div>
        <div class="container">

          <div class="row">
          <div class="col-lg-12">
          <?php
          echo"<center><iframe src='../Calendario-Bootstrap-php-mysql-master/index.php?UserPrivilege=$_SESSION[UserPrivilege]' width='100%' height='750px'></iframe></center>";
        ?>
          </div>
        </div>
      </div>
        <?
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
