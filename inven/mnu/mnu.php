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
	<link rel="stylesheet" type="text/css" href="mnu.css">	
	<script src="jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="mnu.js"></script>
	<title>Menú</title>	 
  
</head> 

<body>

	<div id="contenedorGeneral">

		<header>Sistema de Facturacón e Inventario</header> 

		<div class="hr"><hr /></div>

		<fieldset id='consulta'>				
			<legend id='titulo_consulta'>Acceso rápido a Consulta</legend>
			<a id="pro" href="../pro/pro.php" target="contenido">Producto</a>
			<a id="cli" href="../cl/cli.php" target="contenido">Cliente</a>
			<a id="provee" href="../provee/provee.php" target="contenido">Proveedor</a>
			<a id="usua" href="../us/us.php" target="contenido">Usuario</a>
			<a id="emp" href="../emp/emp.php" target="contenido">Empresa</a>
			<a id="cat" href="../cat/cat.php" target="contenido">Categoría</a>
			<a id="tipo_usua" href="../tusua/tusua.php" target="contenido">Tipo Usuario</a>
			<a id="tipo_pago" href="../pag/pag.php" target="contenido">Tipo Pago</a>
			<a id="estatu_pedido" href="../statped/statped.php" target="contenido">Stat Pedido</a>
		</fieldset>

						

	</div>	

</body>

</html>