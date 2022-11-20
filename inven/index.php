<?php
// Iniciar la sessión 
session_start(); 
if (isset($_SESSION["usuario"]) && isset($_SESSION["nombre"]) && isset($_SESSION["apellidos"]) && isset($_SESSION["id_tipo_usuario"])) {
	
	echo "";
	
}else{
	echo "<script> window.location='lg/login.php'; </script>";
}

  
?>
 
<!DOCTYPE html>
<html lang="en"> 
<head>  

	<meta charset="UTF-8">
	<meta name="author" content="Rafael A. Torres P">
	<meta name="description" content="Sistema de Inventario y Facturación">
	<meta name="keywords" content="Sistema que estará operando online">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="icomoon/style.css">
	<script src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/index.js"></script>
	<title>Sistema de Facturación e Inventario</title>	 
 
</head>   
 
<body>
	<div id="contenedorGeneral">

		<header>
			<div id="fecha">25/01/2016 08/44 00</div>
			<div id="panelUser">

				<p><label class="bienvenido">Bienvenid@: <?php echo $_SESSION['nombre']. " ".$_SESSION['apellidos'];?> </label></p>
				<div class="hr"><hr /></div>
				<a id="sesion" class="sesion" href="salir/salir.php">Cerrar Sessión</a>

			</div>
			

		</header>
		<nav>

			<ul>
				<li><a href="" target=""><span class="icon-home"></span>Inicio</a></li>
				<li><a href="factr/factr.php" target="contenido">Facturar</a></li>
				<li><a href="factura/factura.php" target="contenido">Imprimir.Factura</a></li>
				<li><a href="#">Consulta<span class="flecha"></span></a>					
					<ul>
						<li><a href="pro/pro.php" target="contenido">Producto</a></li>
						<li><a href="cl/cli.php" target="contenido">Cliente</a></li>
						<li><a href="provee/provee.php" target="contenido">Proveedor</a></li>
						<li><a href="emp/emp.php" target="contenido">Empresa</a></li>
						<li><a href="us/us.php" target="contenido">Usuario</a></li>
						<li><a href="cat/cat.php" target="contenido">Categoría</a></li>
						<li><a href="tusua/tusua.php" target="contenido">Tipo Usuario</a></li>
						<li><a href="pag/pag.php" target="contenido">Tipo Pago</a></li>
						<li><a href="statped/statped.php" target="contenido">Stat Pedido</a></li>
					</ul>

				</li>
				

				<li><a href="#">Admin<span class="flecha"></span></a>
					<ul>
						<li><a href="admin/cpanel.php">cPanel</a></li>								

					</ul>
				</li>

				<li ><a href="info/info.php" id="info" target="contenido">Info</a></li>
				
			</ul>
			
		</nav>


		<iframe name="contenido" src="mnu/mnu.php" frameborder=0 marginheight= 15></iframe>		

	</div>

	<footer>
		<div id="copyright">Copyright &copy; 2016 - Rafael A. Torres Paulino - Todos los derechos reservados</div>
	</footer>

</body>


</html>