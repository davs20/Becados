<nav class="navbar-user-top full-reset">
    <ul class="list-unstyled full-reset">
        <figure>
            <?php
                if($_SESSION['UserPrivilege']=='Estudiante'){
                  $select=ejecutarSQL::consultar("SELECT Foto FROM estudiantes WHERE ID_Usuario='".$_SESSION['id']."'");
                  $data1=mysql_fetch_array($select);
                  echo '<img src="'.$data1['Foto'].'" alt="user-picture" class="img-responsive img-circle center-box">';
                }else if($_SESSION['UserPrivilege']=='Administrador'){
                    $imgUser='user02';
                }
            ?>
        </figure>
        <li style="color:#fff; cursor:default;">
            <span class="all-tittles"><?php
            if($_SESSION['UserPrivilege']=='Administrador'){
              echo $_SESSION['Administrador'];
            }else if($_SESSION['UserPrivilege']=='Estudiante'){
              echo $_SESSION['Estudiante'];
            }
             ?></span>
        </li>
        <li  class="tooltips-general exit-system-button" data-href="<?php echo $LinksRoute; ?>process/logout.php" data-placement="bottom" title="Salir del sistema">
            <i class="fa fa-power-off"></i>
        </li>
        <li  class="tooltips-general search-book-button" data-href="<?php echo $LinksRoute; ?>adminlistteacher - copia.php" data-placement="bottom" title="Buscar estudiantes">

            <i class="fa fa-search"></i>
        </li>
        <li  class="tooltips-general btn-help" data-placement="bottom" title="Ayuda">
            <i class="fa fa-question-circle"></i>
        </li>
        <li class="mobile-menu-button visible-xs" style="float: left !important;">
            <i class="fa fa-bars"></i>
        </li>
    </ul>
</nav>
