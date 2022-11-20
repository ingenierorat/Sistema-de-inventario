<!DOCTYPE html>
<html lang="en">    
<head>
	<meta charset="UTF-8"> 
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="login.js"></script>
</head> 
 
<body>    

	<div id="contenedorGeneral"> 		
		<div id="frm">
			<div class="titulo">Login</div>
			
			<div class="hr"><hr /></div>

			<form name="frmLogin" method="" action="#">
				<p><input title="Usuario de acceso" type="text" name="usuario" id="usuario" placeholder="Usuario" required autocomplete="on" /></p>
				<p><input title="Clave de acceso" type="text" name="clave" id="clave" placeholder="Clave" required/></p>				   				    
				<p><select id='tipo_user'>
					<option value="admin">Admin</option>
					<option value="usuario" selected>Usuario</option>									
				</select><p>				
				<p><input type="button" name="validar" id="validar" value="Acceder"/><label id='msj'></label></p>

			</form>
				
	
		</div>		

	</div>	
	
</body>
</html>


