<?php
// Variables de conexión al servidor
	$localhost = "localhost"; 
	$user = "root"; 
	$password = "2678";   
	$db = "inventario";   

	// Variable que se espera que llegue
	$fecha = $_POST['fecha']; 
	 
	if (isset($fecha) && !empty($fecha)) { 

		// Cadena de conexión al Servidor
		if (!($cn = mysql_connect($localhost, $user,$password))) 
		 	die("Error de conexíon");	 		 


		// Conectar a la Dase de Datos
		if(!mysql_select_db($db, $cn))
			die("Error al conectar a la BD");	


		// Seleccionar registro de la base de datos
		$insert = mysql_query("INSERT INTO facturas () VALUES (null,'$fecha')", $cn);

		// Validar que la consulta no tenga error de sintaxis
		if (!$insert)
			die("Error en la consulta insert");

		// Seleccionar el id_factura generado automaticamente para el cliente que lo solicitó
		$select = mysql_query("SELECT max(id_factura) as valor_maximo FROM facturas ", $cn);

			
		// Preguntar si trajo datos la consulta
		if(mysql_num_rows($select) > 0)
		{
			// Crear un array 
			$datos[] = array();
			// Recorrer el resultado de la consulta
			while ($fila = mysql_fetch_array($select)) {

				// Agragar al array la fila encontrada
				$datos[] = $fila;
				
			}
			// Enviarle un objeto Json con los datos obtenido al cliente
			echo json_encode($datos);

		}else{
			// Asignarle un valor al array para confirmar que no hubo resultado en la consulta
			$datos[]= -1;
			echo json_encode($datos);
		}


		// Liberar la memoria de la consulta
		mysql_free_result($select);		

		 // Cierra la conexión con la base de datos 
		  mysql_close($cn);



	}else{
		// En caso de que el parametro no haya sido recido, enviar el siguiente mensaje
		$datos[]= -1;
		echo json_encode($datos);
	}


	



?>