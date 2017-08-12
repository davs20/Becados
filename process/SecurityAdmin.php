<?php
if ($_SESSION['UserPrivilege']=='Administrador'|| isset($_SESSION['UserPrivilege']) ) {
 }else{
    header("Location: ../process/logout.php");
    exit();
  }
