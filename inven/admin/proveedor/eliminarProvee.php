<?php
// Variables de conexión al servidor
	$localhost = "localhost";
	$user = "root";
	$password = "2678";
	$db = "inventario"; 

	// Variable que se espera que llegue
	$codigo = $_POST['codigo']; 
	
	if (isset($codigo) && !empty($codigo)) {

		// Cadena de conexión al Servidor
		if (!($cn = mysql_connect($localhost, $user,$password))) 
		 	die("Error de conexiíon");	 	 	 


		// Conectar a la Dase de Datos
		if(!mysql_select_db($db, $cn))
			die("Error al conectar a la BD");



		// Seleccionar registro de la base de datos
		$select = mysql_query("SELECT * FROM proveedores where id_proveedor = '".$codigo."'", $cn);

		// Validar que la consulta no tenga error de sintaxis
		if (!$select)
			die("Error en la consulta");


		if (mysql_num_rows($select) > 0) {

			// Borra el registro de la bd
			mysql_query("DELETE FROM proveedores where id_proveedor = '".$codigo."'", $cn);
			// Devuelve si la confirmación del registro		
			echo "si";

		}else{
			// Devuelve no si el registro no existe
			echo "no";
		}

		
		// Cierra la conexión con la base de datos 
		mysql_close($cn);



	}else{
		// En caso de que el parametro no haya sido recido, enviar el siguiente mensaje
		
		echo "El valor enviado no fue recibido";
	}
	



?>