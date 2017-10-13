<?php 
	session_start();
	$_SESSION['nombre'] = array();
	session_destroy();
	header("Location: ../Acceso.html");
?>