<!DOCTYPE html>
<html lang="es">
<head>
    <title>Departamentos</title>
    <?php
        session_start();
        $LinksRoute="./";
        include './inc/links.php';
    ?>
    <script type="text/javascript" src="js/jPages.js"></script>
    <script>
        $(document).ready(function(){
            $(function(){
              $("div.holder").jPages({
                containerID : "itemContainer",
                perPage: 20
              });
            });
           $('.btn-info-book').click(function(){
               window.location ="infobook.php?codeBook="+$(this).attr("data-code-book");
           });
           $('.list-catalog-container li').click(function(){
               window.location="catalog.php?CategoryCode="+$(this).attr("data-code-category");
           });
        });
    </script>
</head>
<body>
    <?php
        include './library/configServer.php';
        include './library/consulSQL.php';
        include './process/SecurityUser.php';
        //$VarCategoryCatalog=consultasSQL::CleanStringText($_GET['CategoryCode']);
        include './inc/NavLateral.php';
    ?>
    <div class="content-page-container full-reset custom-scroll-containers">
        <?php
            include './inc/NavUserInfo.php';
        ?>
        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">Sistema becario <small>Listado de Carreras</small></h1>
            </div>
        </div>
         <div class="container-fluid"  style="margin: 40px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="assets/img/checklist.png" alt="pdf" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido al listado de Carreras. &nbsp; <i class="zmdi zmdi-search"></i> &nbsp; que se encuentra en la barra superior
                </div>
            </div>
        </div>
        <?php
        $t=1;
        $sql=ejecutarSQL::consultar("SELECT * FROM departamento");

        if($sql){
          echo '<ul id="itemContainer" class="list-unstyled">';
            echo "<table class='table table-hover text-center'>";
              echo "<tr>";
                echo "<th>Nombre Departamento</th>";
                echo "<th>DepartamentoID</th>";
                echo"<th>Encargado</th>";
              echo "</tr>";
            while($row = mysql_fetch_assoc($sql)){
              echo "<tr>";
                echo "<td>" . $row['Nombre'] . "</td>";
                echo "<td>" . $row['DepartamentoID'] . "</td>";
                echo "<td>" . $row['Encargado'] . "</td>";
              echo "</tr>";
            }
            echo "</table>";
            echo '</ul><div class="holder"></div>';

            mysql_free_result($row);

        }else{
          echo "Error no se puede ejecutar sentencia $sql. " .mysqli_error();
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
                    <?php include './help/help-catalog.php'; ?>
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
