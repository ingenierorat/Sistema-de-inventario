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
	<link rel="stylesheet" type="text/css" href="mnu.css">	
	<script src="jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="mnu.js"></script>
	<title>Menú</title>	 
  
</head> 

<body>

	<div id="contenedorGeneral"> 

		<header>Panel Administrativo</header> 

		<div class="hr"><hr /></div>

		<fieldset id='menu'>				
			<legend id='titulo_menu'>Acceso rapido al Menú</legend>
			<a id="pro" href="../producto/registro.php" target="contenido">Producto</a>
			<a id="cli" href="../cliente/registro.php" target="contenido">Cliente</a>
			<a id="provee" href="../proveedor/registro.php" target="contenido">Proveedor</a>
			<a id="emp" href="../empresa/registro.php" target="contenido">Empresa</a>
			<a id="usua" href="../usuario/registro.php" target="contenido">Usuario</a>
			<a id="cat" href="../categoria/registro.php" target="contenido">Categoría</a>
			<a id="tipo_usua" href="../tipousuario/registro.php" target="contenido">Tipo Usuario</a>
			<a id="tipo_pago" href="../pago/registro.php" target="contenido">Tipo Pago</a>
			<a id="estatu_pedido" href="../pedido/registro.php" target="contenido">Stat Pedido</a>
		</fieldset>	

		<fieldset id='reporte'>				
			<legend id='titulo_reporte'>Acceso rápido a Reportes</legend>
			<a id="venta" href="../venta/vt.php" target="contenido">Venta</a>
			<a id="abastecer" href="../abastecimiento/abst.php" target="contenido">Materiales a Reabastecer</a>					
		</fieldset>		
				

	</div>	

</body>

</html>