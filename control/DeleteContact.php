<?php 

	require_once("DBConfig.php");

	$id = $_POST['id'];

	$conexion = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$consulta = $conexion->query("DELETE FROM contactos WHERE id='".$id."'");

	if( $consulta )
		echo "success";
	else
		echo "error";

?>