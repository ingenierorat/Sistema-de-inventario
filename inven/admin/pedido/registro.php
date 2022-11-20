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
	<title>Generar Pedido</title>

	<link rel="stylesheet" type="text/css" href="registro.css">
	<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="registro.js"></script>
	

</head>   
 
<body>

	<div id="contenedorGeneral">

		<div id="ingreso"></div>
		<div id="frmRegistro">		
				<fieldset id='fset_pedido'>				
					<legend id='inf_pedido'>Información del Pedido</legend>
					<table id="tablaRegistroCrearpedinf">
					</table>

				</fieldset>

				<fieldset id='fset_detalle'>				
					<legend id='inf_detalle'>Detalles</legend>
					<table id="tablaRegistroCrearpeddet">
					</table>

				</fieldset>

				<table id="tablaRegistroEliminar">
				</table>

				<table id="tablaRegistroIngresar">
				</table>

			
						

			<div id="botones"></div>			

		</div>		

		<div class="hr"><hr /></div>

			<div id="opciones">
				<input type="button" value="Crear Ped." id="nuevo" class="opcion" />
				<input type="button" value="Ingr Ped. Sistema" id="ingresar_pedido_sistema" class="opcion" />				
				<input type="button" value="Eliminar Ped." id="eliminar" class="opcion" />		
				
			</div>		


	</div>	




</body>
</html>