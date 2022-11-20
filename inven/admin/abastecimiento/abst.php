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
	<title>Abastecimiento</title>

	<link rel="stylesheet" type="text/css" href="abst.css">
	<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="abst.js"></script>
	

</head>
 
<body>

	<div id="contenedorGeneral">

	<label for="" id="lbl_opcion">Buscar los materiales que deban ser Reabastecidos</label>	
	<input type="button" id="buscar" value="Buscar">
	<label for="" id="msj"></label>	

	<fieldset id='fset_detalle_abst'>
		<legend id='inf_detalle_abst'>Materiales a Reabastecer</legend>
		<table id="tb_detalles_abst">
		</table>
	</fieldset>
	
	<!-- Comentario-->

	</div>	

</body>
</html>