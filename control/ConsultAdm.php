<?php 
	require_once("DBConfig.php");

	if( !isset($_POST['nombre']) || !isset($_POST['password']) )
		header("Location: ../Acceso.html");
	else{ 

		$nombreAdm = $_POST['nombre'];
		$passwordAdm = $_POST['password'];

		$conexion = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		$consulta = $conexion->query("SELECT * FROM administrador WHERE nombre='".$nombreAdm."' AND password='".$passwordAdm."'");

		if( $admin =  mysqli_fetch_array($consulta) ){
			session_start();
			$_SESSION['nombre'] = $admin['nombre'];
			echo "access";
		}
		else
			echo "error";
	}

?>