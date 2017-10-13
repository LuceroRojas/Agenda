<?php 

	require_once("DBConfig.php");

	$nombre = $_POST["nombre"];
	$numero = $_POST["numero"];
	$descripcion = $_POST["descripcion"];

	$img = $_FILES["archivo"]["tmp_name"];
	$imgnom = $_FILES["archivo"]["name"];

	$DataBase = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$result = $DataBase->query("INSERT INTO contactos (nombre, numero, descripcion) VALUES ('".$nombre."','".$numero."','".$descripcion."')");

	if( $result == null )
		echo "error";
	else{
			
		$id_producto = $DataBase->insert_id;
		$ruta = "contactos/contacto_".$id_producto.".png";
		$result = $DataBase->query("UPDATE contactos SET img='".$ruta."' WHERE id='".$id_producto."' ");

		if( $result != null && move_uploaded_file($img, "../".$ruta))
			header("Location: ../Administrador.php");
	}
?>