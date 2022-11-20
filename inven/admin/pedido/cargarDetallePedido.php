<?php
// Variables de conexión al servidor
	$localhost = "localhost"; 
	$user = "root";
	$password = "2678";    
	$db = "inventario"; 

	// Variable que se espera que llegue
	$id_pedido = $_POST['id_pedido'];
	$num = 0;
	$valor;
	$numeros;
	
	if (isset($id_pedido) && !empty($id_pedido)) {

		// Cadena de conexión al Servidor
		if (!($cn = mysql_connect($localhost, $user,$password))) 
		 	die("Error de conexiíon");	 		 


		// Conectar a la Dase de Datos
		if(!mysql_select_db($db, $cn))
			die("Error al conectar a la BD");	


		// Seleccionar registro de la base de datos
		$select = mysql_query("SELECT * FROM detalles_pedidos where id_pedido = '".$id_pedido."' && estatus = 'En espera'", $cn);

		// Validar que la consulta no tenga error de sintaxis
		if (!$select)
			die("Error en la consulta");

			
		// Preguntar si trajo datos la consulta
		if(mysql_num_rows($select) > 0)
		{

			// Declaración de arreglo a utilizar
			$numeros = ["cero","uno","dos","tres","cuatro","cinco","seis","siete","ocho","nueve"];			
			// Columnas de la tabla a crear
			echo '<tr>';
			echo '<th><input type="text" name="id_pedido_detalle" id="hid_pedido_detalle" value="Id Pedido" readonly /></th>';		
			echo '<th><input type="text" name="id_producto" id="hid_producto" value="Id Producto" readonly /></th>';			
			echo '<th><input type="text" name="cantidad" id="hcantidad" value="Cantidad" readonly /></th>';
			echo '<th><input type="text" name="precio" id="hprecio" value="Precio" readonly /></th>';
			echo '<th><input type="text" name="descuento" id="hdescuento" value="Descuento" readonly /></th>';
			echo '<th><input type="text" name="importe" id="himporte" value="Importe" readonly /></th>';
			echo '<th><input type="text" name="estatus" id="hestatus" value="Estatus" readonly /></th>';
			echo '<th><input type="text" name="registrar_linea" id="hregistrar_linea" value="Registrar Linea" readonly /></th>';										
			echo '</tr>';
			
			// Recorrer el resultado de la consulta
			while ($fila = mysql_fetch_array($select)) {

				// Campos de datos de la tabla a crear					
				echo '<tr>';
				echo '<td><input type="text" name="id_pedido" id="diid_pedido_detalle" value="'.$fila['id_pedido'].'" readonly /></td>';			
				echo '<td><input type="text" name="id_producto" id="diid_producto" value="'.$fila['id_producto'].'" readonly /></td>';			
				echo '<td><input type="text" name="cantidad" id="dicantidad" value="'.$fila['cantidad'].'" readonly /></td>';
				echo '<td><input type="text" name="precio" id="diprecio" value="'.$fila['precio'].'" readonly /></td>';
				echo '<td><input type="text" name="descuento" id="didescuento" value="'.$fila['descuento'].'" readonly /></td>';
				echo '<td><input type="text" name="importe" id="diimporte" value="'.$fila['importe'].'" readonly /></td>';
				echo '<td><input type="text" name="estatus" id="diestatus" value="'.$fila['estatus'].'" readonly /></td>';	
				echo '<td><input type="button" name="'.$numeros[$num].'" id="'.$numeros[$num].'" value="Linea '.$num.'" onclick="cargar_pedido_sistema('.$num.','.$fila['id_producto'].','.$fila['cantidad'].','.$fila['id_pedido'].')" readonly /></td>';										
				echo '</tr>';
				// Detiene el bucle si la variable pasa del valor establecido
				if($num == 10) break;
				// Incrementar la variables
				$num += 1;

								
			}

			
			
		}else{
			// Asignarle un valor al array para confirmar que no hubo resultado en la consulta
			echo -1;			
		}


		// Liberar la memoria de la consulta
		mysql_free_result($select);		

		 // Cierra la conexión con la base de datos 
		  mysql_close($cn);



	}else{
		// En caso de que el parametro no haya sido recido, enviar el siguiente mensaje
		echo -1;
	}


	



?>