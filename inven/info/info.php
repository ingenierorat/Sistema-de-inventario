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
  <meta charset="utf-8">
  <title>Informacón</title>
  <link rel="stylesheet" href="jqueryUI/jquery-ui.css">
  <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
  <script src="jqueryUI/jquery-ui.js"></script>  
  <link rel="stylesheet" href="info.css">
  <script type="text/javascript" src="info.js"></script>

</head> 
<body>

	<div id="contenedorGeneral">
 
		<div id="tabs">
		  <ul>
		    <li><a href="#tabs-1">Info personal</a></li>
		    <li><a href="#tabs-2">Info de contacto</a></li>
		    <li><a href="#tabs-3">Info del sistema</a></li>
		  </ul>
		  <div id="tabs-1">
		    <p>Información personal</p>
		  </div>
		  <div id="tabs-2">
		    <p>Informacón de contacto</p>
		  </div>
		  <div id="tabs-3">
		    <p>Información del sistema</p>
		  </div>


    </div>
 
</body>
</html>