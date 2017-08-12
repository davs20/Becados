<?php
include '../library/configServer.php';
include '../library/consulSQL.php';
session_start();
if(isset($_SESSION['UserPrivilege'])){
		session_unset();
		session_destroy();
		header("Location: ../index.php");
}else{
	header("Location: ../index.php");
}
?>
