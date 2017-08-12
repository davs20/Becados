<!DOCTYPE html>
<html lang="es">
<head>
    <title>Listado</title>
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
        include './process/SecurityAdmin.php';
    //    $VarCategoryCatalog=consultasSQL::CleanStringText($_GET['CategoryCode']);
        include './inc/NavLateral.php';
    ?>
    <div class="content-page-container full-reset custom-scroll-containers">
        <?php
            include './inc/NavUserInfo.php';
        ?>
        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">Sistema becario <small>Listado de Alumnos</small></h1>
            </div>
        </div>
        <div class="container-fluid"  style="margin: 40px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="assets/img/checklist.png" alt="pdf" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido al listado de alumnos, aqui podras ver el en detalle cada alumno &nbsp; <i class="zmdi zmdi-search"></i> &nbsp; que se encuentra en la barra superior
                </div>
            </div>
            <div class="table-responsive">
              <?php
              $link = mysqli_connect("localhost","root","admin");
              if($link === false){
                die("Error no se puede conectar. " .mysqli_connect_error());
              }
              mysqli_select_db($link,"becados2");
              $sql="SELECT *,carreras.Nombre_Carrera FROM estudiantes INNER JOIN carreras ON carreras.ID_Carrera=estudiantes.ID_Carrera";

              if($result =mysqli_query($link, $sql)){
                  echo "<table  class='table table-hover text-center'>";
                    echo "<tr>";
                      echo "<th>Nombre Completo</th>";
                      echo "<th>ID</th>";
                      echo "<th>Numero de Telefono</th>";
                      echo "<th>Correo Electronico</th>";
                      echo "<th>Nombre Carrera</th>";
                      echo "<th>Fecha De Ingreso</th>";
                    echo "</tr>";
                  while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                      echo "<td>" . $row['Nombre_Completo'] . "</td>";
                      echo "<td>" . $row['ID_Usuario'] . "</td>";
                      echo "<td>" . $row['Numero_Telefono'] . "</td>";
                      echo "<td>" . $row['Correo_Electronico'] . "</td>";
                      echo "<td>" . $row['Nombre_Carrera'] . "</td>";
                      echo "<td>" . $row['Fecha_Ingreso'] . "</td>";
                    echo "</tr>";
                  }
                  echo "</table></center>";

                  mysqli_free_result($result);

              }else{
                echo "Error no se puede ejecutar sentencia $sql. " .mysqli_error($link);
              }

              mysqli_close($link);
              ?>
            </div>
            <a href="pruebapdf.php"><button type="button" name="button"> Imprimir PDF</a></button>
            <br>
          </br>
          <br>
        </br>
        </div>
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
