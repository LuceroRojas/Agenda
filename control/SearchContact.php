<?php 

	require_once("DBConfig.php");

	$data = $_POST['data'];
	$type = $_POST['type'];

	$conexion = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME );

	switch ($type) {
		case '*':
			$query = $conexion->query("SELECT * FROM contactos ORDER BY nombre");
			break;
		
		case 'nombre': 

			$query = $conexion->query("SELECT * FROM contactos ORDER BY nombre WHERE nombre='".$data."'");
			break;

		case 'id':
			$query = $conexion->query("SELECT * FROM contactos WHERE id='".$data."'");
			break;
	}
	

	$data = "";
	while( $contacto = mysqli_fetch_array($query) ){

		$id = $contacto['id'];
		
		$borrar = 'funcBorrar("'.$id.'")';
		$editar = 'funcEditar("'.$id.'")';

		$data .= "<div class='col-sm-6 col-md-4' id='".$id."'>";
		$data .= "<div class='thumbnail'>";
		$data .= "<img src='".$contacto['img']."' alt='".$contacto['nombre']."' id='".$contacto['id']."'>";
		$data .= "<h3>".$contacto['nombre'];
		$data .= "<p>".$contacto['descripcion']." <br><h5>".$contacto['numero']."</h5> </p> ";
		$data .= "<div class='btn-group btn-group-xs'>";
		$data .= "<button class='btn btn-default ' onclick='".$editar."'  role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseTr' aria-expanded='true' aria-controls='collapseTr' >Editar</button>";
		$data .= "<button class='btn btn-danger ' onclick='".$borrar."'>Borrar</button>";
		$data .= "</div>"; 
		$data .= "</div>"; 
		$data .= "</div>";
	}

	echo $data;

?>