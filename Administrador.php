<?php 
	session_start();
	if( !isset($_SESSION['nombre']) )
		header("Location: Acceso.html");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Administrador</title>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">


	<script>
	function funcBorrar(id){
		

		if( confirm("Desea borrar el elemento seleccionado") )
			$.post("control/DeleteContact.php",{ id: id },
				function(data){
					if (data == "success") {
						window.location = "";
					};
				});
	}

	function funcEditar(id){
		$(".edit-container").css("display","block");

		$.post("control/EditContact.php",{ 
			id: id,
			nombre: '',
			peticion: 'get',
			numero: '',
			descripcion:""
		}, function(data){
			
			$('.formEdit').html(data);
		});

	}

	$(function () {

		$.post("control/SearchContact.php",{ data: "", type: "*"},
			function(data){
				$("#img-container").html(data);
		});
		
		$("#close").click(function(){
			window.location = "control/CloseAdm.php";
		});

		$("#search").click(function(){
			
			var values = $('#formSearch :input');
			var data = values[0].value;

			if( data + 0 > 0 )
				$.post("control/SearchContact.php",{ data: data, type: "id" },
				function(data){
					$("#img-container").html(data);
				});
			else
				$.post("control/SearchContact.php",{ data: data, type: "nombre" },
				function(data){
					$("#img-container").html(data);
				});

		});

		$("#searchAll").click(function(){
			$.post("control/SearchContact.php",{ data: "", type: "*"},
			function(data){
				$("#img-container").html(data);
			});
		});


	});
	</script>
</head>
<body>

	<nav class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container">
			<div class="collapse navbar-collapse" id="navegacion-fm">
				<button id="close" class="btn btn-warning navbar-form navbar-right form-control" ><span class="glyphicon glyphicon-off"></span> Cerrar Session</button>
			</div>
		</div>
	</nav>


	<div class="container">
		
		<div class="jumbotron">
			<h3>Bienvenido <?php echo $_SESSION['nombre']; ?></h3>
		</div>

		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingOne">
		      <h4 class="panel-title">
		        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		          Agregar Contacto
		        </a>
		      </h4>
		    </div>
		    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		      <div class="panel-body">
       			<form action="Control/SaveContact.php" method="post" class="form" enctype="multipart/form-data">
					<div class="form-group"><input type="text" class="form-control"name="nombre" placeholder="Nombre"></div>
					<div class="form-group"><input type="text" class="form-control"name="numero" placeholder="Numero"></div>
					<div class="form-group"><textarea name="descripcion" class="form-control" rows="3" placeholder="Descripcion"></textarea></div>
					<div class="form-group"><input type="file" class="form-control btn" name="archivo" ></div>
					<div class="form-group"><input type="submit" class="btn btn-primary pull-right" value="Guardar"></div>
				</form>	
		       </div>
		    </div>
		  </div>
		  <!-- SEGUNDO PANEL-->
		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          Buscar Contacto
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
		    	<div class="panel-body">

		    		<form id="formSearch" class="formSearch form-inline">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Nombre del Contacto">
							<input type="button" class="form-control btn btn-primary" value="Buscar" id="search">
							<input type="button" class="form-control btn btn-primary" value="Todos" id="searchAll">
						</div>
					</form>
					<br>

					<div id="img-container" class="row"></div>

		    	</div>
		    </div>
		  </div>
		  <!-- TERCER PANEL-->
		 <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTr">
		      <h4 class="panel-title">
		        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTr" aria-expanded="true" aria-controls="collapseTr">
		          Editar Contacto
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTr" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTr">
		      <div class="panel-body">
       				<div class="edit-container">
						<form action="control/EditContact.php" method="post" class="formEdit col-md-12" enctype="multipart/form-data">
						</form>
					</div>
		       </div>
		    </div>
		  </div>
		</div>

	</div>

	 <br>
    <footer class="footer navbar-default">
      <div class="container">

      	<div class="row">
      		
      		<div class="col-md-6">
      			<br>
      			<address>
				  <strong>BUAP Facultad de Computación</strong><br>
				  México. Puebla, Pue.<br>
				  Lucero Rojas Santiago <br>
				  Telefono: +52 (044) 2271001401<br>
				</address>

				<address>
				  <strong>E-mail</strong><br>
				  <a href="mailto:#">lucero_mlaurc@hotmail.es</a>
				</address>

				<ul class="list-inline">
		      		<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
		      		<li><a  href="mailto:#"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a></li>
		      		<li><a href="administrador.php"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></li>
		      	</ul>
      		</div>

      		<div class="col-md-6">
      			<br>
      			<ul class="list-inline text-right">
		      		<li><a href="https://es-la.facebook.com/"><img src="icons/facebook-icon.png" alt=""></a></li>
		      		<li><a href="https://www.google.com.mx/"><img src="icons/google-plus-icon.png" alt=""></a></li>
		      		<li><a href="https://twitter.com/?lang=es"><img src="icons/Instagram-icon.png" alt=""></a></li>
		      	</ul>
		      	
      		</div>

      	</div>
      	
      </div>
    </footer>

	<script src ="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>