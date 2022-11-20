<?php  
// Iniciar la sessión   
session_start();
// Controlar quien puede entrar a este panel
if (isset($_SESSION["usuario"]) && isset($_SESSION["nombre"]) && isset($_SESSION["apellidos"]) && isset($_SESSION["id_tipo_usuario"])) {
	
	// Preguntar por el tipo de usuario logeado
	if ($_SESSION["id_tipo_usuario"] == 1) {
		$admin = "Aministrador";

	}else{
		// Desplegar mensaje al usuario en caso de no ser una Admin
		echo "<script> alert('Usted no tiene permiso para esta Panel Administrativo'); </script>";
		// Dejarlo en la página actual
		echo "<script> window.location='../index.php'; </script>";
	}
	 
	
}else{
	// Si el usuario no se ha logeado; enviarlo al logearse
	echo "<script> window.location='../lg/login.php'; </script>";

	 
}


?>


<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">	
	<link rel="stylesheet" type="text/css" href="css/cpanel.css">
	<link rel="stylesheet" type="text/css" href="icomoon/style.css">
	<script src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/cpanel.js"></script>

	<title>cPanel</title>	

</head>  

<body>

	<div id="contenedorGeneral">

		<header>
			<div id="fecha">25/01/2016 08/44 00</div>
			<div id="panelUser">

				<p><label class="bienvenido">Bienvenid@: <?php echo $_SESSION['nombre']. " ".$_SESSION['apellidos'];?></label></p>
				<div class="hr"><hr /></div>
				<label class="sesion">Tipo Usuario: <?php echo $admin; ?> </label>

			</div>
		</header>		
		
		<nav>

				<div id="a_menu">
					<a href="../index.php" id="a_inicio"><span class="icon-home"></span>Inicio</a>
					<a href="mnu/mnu.php" id="a_limpiar" target="contenido"><span class="icon-trash"></span>Borrar e Inicio</a>
				
				</div>

				<div id="tituloMenu"><label id="lbl_menu">Menú</label></div>

				<ul>
					<li><a href="#" target="">Administrar<span class="flecha"></span></a>
						<ul>
							<li><a href="producto/registro.php" target="contenido">Productos</a></li>						
							<li><a href="cliente/registro.php" target="contenido">Clientes</a></li>
							<li><a href="usuario/registro.php" target="contenido">Usuarios</a></li>
							<li><a href="proveedor/registro.php" target="contenido">Proveedor</a></li>
							<li><a href="empresa/registro.php" target="contenido">Empresa</a></li>
							<li><a href="categoria/registro.php" target="contenido">Categoría</a></li>
							<li><a href="pago/registro.php" target="contenido">Pago</a></li>
							<li><a href="tipousuario/registro.php" target="contenido">Tipo Usuario</a></li>
							<li><a href="pedido/registro.php" target="contenido">Pedido</a></li>												

						</ul>

					</li>				

				</ul>
			
		</nav>

		<iframe name="contenido" src="mnu/mnu.php" frameborder=0 marginheight= 15>Tu navegador no soporta frames, lo siento</iframe>

	</div>
	
	<footer>
		<div id="copyright">Copyright &copy; 2016 - Rafael A. Torres Paulino - Todos los derechos reservados</div>
	</footer>

</body>

</html>