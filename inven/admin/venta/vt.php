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
	<title>Reportes Vetas</title>

	<link rel="stylesheet" type="text/css" href="vt.css">
	<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="vt.js"></script>
	

</head>
 
<body>

	<div id="contenedorGeneral">

	<label for="dia" id="lbl_opcion">Elegir el tipo de consulta</label>
	<select name="opcion_venta" id="opcion_venta">
		<option value="dia" selected>Día</option>
		<option value="mes">Mes</option>
	</select>
	<input type="date" id="dia">
	<input type="date" id="mes">
	<input type="button" id="buscar" value="Buscar">
	<label for="" id="msj"></label>

	<table id="tb_descripcion">
		<tr><td><label class='lbl_descripcion'>Fecha Venta</label><label for="" class="lbl_cantidades" id="fecha"></label></td></tr>
		<tr><td><label class='lbl_descripcion'>Cantidad Material</label><label for="" class="lbl_cantidades" id="cantidad"></label></td></tr>
		<tr><td><label class='lbl_descripcion'>Importe Total</label><label for="" class="lbl_cantidades" id="monto_total"></label></td></tr>
		<tr><td><label class='lbl_descripcion'>Ganancias Neta</label><label for="" class="lbl_cantidades" id="ganancia"></label></td></tr>
	</table>

	<fieldset id='fset_detalle_venta'>
		<legend id='inf_detalle_venta'>Detalles Ventas</legend>
		<table id="tb_detalles_venta">
		</table>
	</fieldset>
	
	


	</div>	

</body>
</html>