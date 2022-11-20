<?php
// Iniciar la sessión
session_start();
if (isset($_SESSION["usuario"]) && isset($_SESSION["nombre"]) && isset($_SESSION["apellidos"]) && isset($_SESSION["id_tipo_usuario"])) {
	
	echo "";
	
}else{
	echo "<script> window.location='../lg/login.php'; </script>";
}

 
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">	
	<link rel="stylesheet" type="text/css" href="tusua.css">	
	<script src="jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="tusua.js"></script>
	
	<title>Consultar Tipo Usuario</title>

</head>
<body>

<div id="contenedorGeneral">

		<div id="consulta">	

		<div id ="titulo_panel">Panel tipo usuario</div>		

			<p><label id="lblopcion">Eliga la opción a consulta</label></p>			
			<select id="opcion">
				<option value="codigo">Código</option>
				<option value="descripcion">Descripción</option>
				<option value="todos">Cargar Tod.</option>
			</select>

			<input type="text" class="buscar" name="txtbuscar" id="txtbuscar" />
			<input type="button" class="buscar" name="btnbuscar" id="btnbuscar" value="Buscar" />
			<input type="button" class="limpiar" name="btnlimpiar" id="btnlimpiar" value="Limpiar" />
					

		</div>

		<div id="contenedorTablaTUsua">
			
		</div>


</div>

	
</body>
</html>