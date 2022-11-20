<?php
// Iniciar la sessión
session_start();
if (isset($_SESSION["usuario"]) && isset($_SESSION["nombre"]) && isset($_SESSION["apellidos"]) && isset($_SESSION["id_tipo_usuario"])) {
	
	
	// Preguntar por el tipo de usuario logeado
	if ($_SESSION["id_tipo_usuario"] == 1) {
		
		echo "";

	}else{
		
		// Dejarlo en la página actual
		echo "<script> window.location='../../index.php'; </script>";
	}

	
}else{
	echo "<script> window.location='../../lg/login.php'; </script>";
}

 
?>






<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro de Empresa.</title>

	<link rel="stylesheet" type="text/css" href="registro.css">
	<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="registro.js"></script>
	

</head> 

<body>

	<div id="contenedorGeneral">

		<div id="ingreso"></div>
		<div id="frmRegistro">
			
			<table id="tablaRegistroEmp">
			</table>

			<table id="tablaRegistroEliminar">
			</table>			

			<div id="botones"></div>			

		</div>		

		<div class="hr"><hr /></div>

			<div id="opciones">
				<input type="button" value="Nueva Emp." id="nuevo" class="opcion" />
				<input type="button" value="Editar Emp." id="editar" class="opcion" />
				<input type="button" value="Elimin Emp." id="eliminar" class="opcion" />		
				
			</div>		


	</div>	

</body>
</html>