<?php
    if($LinksRoute=="../"){ $LinkRouteAdmin=""; }else{ $LinkRouteAdmin="./admin/"; }
?>
<div class="navbar-lateral full-reset">
    <div class="visible-xs font-movile-menu mobile-menu-button"></div>
    <div class="full-reset container-menu-movile custom-scroll-containers " >
        <div class="logo full-reset all-tittles">
            <i class="visible-xs fa fa-bars pull-left mobile-menu-button" style="line-height: 55px; cursor: pointer; padding: 0 10px; margin-left: 7px;"></i>
            Becados UNICAH SI
        </div>
        <div class="full-reset" style="background-color:#24568e; padding: 10px 0; color:#fff;">
            <figure><br>
                <img src="<?php echo $LinksRoute; ?>assets/img/logo.png" alt="Biblioteca" class="img-responsive center-box" style="width:50%;">
            </figure>
            <p class="text-center" style="padding-top: 15px;">Control de Horas</p>
        </div>
        <div class="full-reset nav-lateral-list-menu">
            <ul class="list-unstyled">
                <?php
                    if($_SESSION['UserPrivilege']=='Estudiante'){
                      echo "<li><a href='home.php'><i class='zmdi zmdi-bookmark-outline'></i>&nbsp;&nbsp;Inicio</a></li>";
                        echo '<li><a href="perfil_estudiante.php"><i class="zmdi zmdi-bookmark-outline "></i>&nbsp;&nbsp; Mi Cuenta</a></li>';
                        echo '<li><a href="individual.php"><i class="class="fa fa-clock-o"></i>&nbsp;&nbsp; Detalle De Horas</a></li>';
                        echo '<li><a href="calendario.php"><i class="zmdi zmdi-bookmark-outline "></i>&nbsp;&nbsp; Eventos</a></li>';
                       }else if($_SESSION['UserPrivilege']=='Administrador'){
                           echo '<li><a href="'.$LinksRoute.'home.php"><i class="fa fa-home"></i>&nbsp;&nbsp; Inicio</a> </li>
                        <li>
                            <div class="dropdown-menu-button"><i class="fa fa-unlock"></i>&nbsp;&nbsp; Administración <i class="fa fa-angle-down pull-right zmdi-hc-fw"></i></div>
                            <ul class="list-unstyled">
                                <li><a href="'.$LinkRouteAdmin.'adminstudent.php"><i class="fa fa-graduation-cap"></i>&nbsp;&nbsp; Nuevo estudiante</a></li>
                                <li><a href="'.$LinkRouteAdmin.'adminlistteacher.php"><i class="fa fa-user-times"></i>&nbsp;&nbsp; Editar estudiante</a></li>
                                <li><a href="'.$LinkRouteAdmin.'adminlistteacher - copia.php"><i class="fa fa-clock-o"></i>&nbsp;&nbsp; Ingresar Horas</a></li>
                                <li><a href="'.$LinkRouteAdmin.'adminlistteacher2.php"><i class="fa fa-pencil"></i>&nbsp;&nbsp; Editar Horas</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="'.$LinksRoute.'calendario.php"><i class="fa fa-calendar" class="dropdown-menu-button"> </i>&nbsp;&nbsp; Eventos </a></i>
                        </li>
                        <li>
                            <div class="dropdown-menu-button"><i class="fa fa-book"></i>&nbsp;&nbsp; Reportes y Estadisticas <i class="fa fa-angle-down pull-right zmdi-hc-fw"></i></div>
                            <ul class="list-unstyled">
                                <li><a href="'.$LinksRoute.'report.php"><i class="fa fa-tags"></i>&nbsp;&nbsp; Informe General</a></li>
                                <li><a href="'.$LinksRoute.'individual.php"><i class="fa fa-bar-chart"></i>&nbsp;&nbsp; Informe Individual</a></li>
                            </ul>
                        </li>';
                   }
                ?>
            </ul>
        </div>
    </div>
</div>
