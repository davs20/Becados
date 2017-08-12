<?php
if (isset($_SESSION['UserPrivilege']) || $_SESSION['UserPrivilege']=='Estudiante' ||  $_SESSION['UserPrivilege']=='Invitado') {
echo"hola";
 }else{
    header("Location: process/logout.php"); exit();
  }
