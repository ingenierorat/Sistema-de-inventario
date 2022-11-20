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
	<title>Factura</title>

	<link rel="stylesheet" type="text/css" href="factura.css">
	<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="factura.js"></script>
	

</head>
 
<body>

	<div id="contenedorGeneral">

	<p><label for="" id="lbl_opcion">Panel de factura, Elija la búsqueda</label></p>
		<select id="opcion">
			<option value="codigo" selected>Código</option>
			<option value="todos">Cargar Tod.</option>
		</select>

	<input type="text" id="txtbuscar"  />
	
	<div>
		
	</div>


	<input type="button" id="buscar" value="Buscar">
	<label for="" id="msj"></label>	

	<fieldset id='fset_detalle_factura'>
		<legend id='inf_detalle_factura'>Facturas</legend>
		<table id="tb_detalle_factura">
		</table>
	</fieldset>
	
	<!-- Comentario-->

	</div>	

</body>
</html>