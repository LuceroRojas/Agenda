<?php 

	require_once("DBConfig.php");

	$id = $_POST['id'];
	$peticion = $_POST['peticion'];
	$nombre = $_POST["nombre"];
	$numero = $_POST["numero"];
	$descripcion = $_POST["descripcion"];

	$conexion = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

	switch ($peticion) {
		case 'get':
			$consulta = $conexion->query("SELECT * FROM contactos WHERE id='".$id."'");
			$data = "";
			if( $contacto = mysqli_fetch_array($consulta) ){

				$data .= '<div class="container col-md-8 thumbnail text-center>"';
				$data .= '<div class="caption">';
				$data .= '<h2 class="text-center">Editar Contacto</h2>';
				$data .= '<input class="form-control" type="text" name="nombre" placeholder="Nombre" value="'.$contacto['nombre'].'"><br>';
				$data .= '<input class="form-control" type="file" name="archivo" ><br>';
				$data .= '<input class="form-control" type="text" name="numero" placeholder="Numero" value="'.$contacto['numero'].'"><br>';
				$data .= '<textarea class="form-control" rows="4" name="descripcion" placeholder="Descripcion" >'.$contacto['descripcion'].'</textarea> <br>';
				$data .= '<input class="form-control" type="hidden" name="id" value="'.$id.'" ><br>';
				$data .= '<input class="form-control" type="hidden" name="peticion" value="set" >';
				$data .= '<input class="btn btn-primary btn-lg pull-right" type="submit" value="Guardar">';
				$data .= '</div>';
				$data .= '<div class="col-md-4">';
				$data .= '<img src="'.$contacto['img'].'" class="img-thumbnail">';
				$data .= '</div>';
				$data .= '</div>';

				echo $data;
			}
			break;
		
		case 'set':

			if( $_FILES["archivo"]["name"] != "" ){
				$img = $_FILES["archivo"]["tmp_name"];
				$imgnom = $_FILES["archivo"]["name"];

				$ruta = "contactos/contacto_".$id.".png";
				$consulta = $conexion->query("UPDATE contactos SET nombre='".$nombre."', img='".$ruta."', numero='".$numero."', descripcion='".$descripcion."' WHERE id='".$id."'") or die ("error consulta");
				
				if( $consulta != null && move_uploaded_file($img, "../".$ruta))
					header("Location: ../Administrador.php");
				else
					echo "Error Guardar";

			}else{
				$consulta = $conexion->query("UPDATE contactos SET nombre='".$nombre."', numero='".$numero."', descripcion='".$descripcion."' WHERE id='".$id."'");
				if( $consulta )
					header("Location: ../Administrador.php");
			}
			break;
	}

	

?>