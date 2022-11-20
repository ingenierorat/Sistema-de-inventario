<?php


// Validar cada una de las variables enviadas al servidor
if (isset($_POST['id_pedido']) && !empty($_POST['id_pedido']) or isset($_POST['id_producto']) && !empty($_POST['id_producto']) or isset($_POST['limite'])) {

	// Comprobar la igualdad de cada variable enviada
	if (isset($_POST['id_pedido']) == "id_pedido") {  

		$miConsulta = new Consulta();
	    $miConsulta->consultarIdPedido();
		 
	}elseif (isset($_POST['id_producto']) == "id_producto") {

		$miConsulta = new Consulta();
	    $miConsulta->consultarIdProducto();

	}elseif (isset($_POST['limite']) == "limite") {

		$miConsulta = new Consulta();
	    $miConsulta->consultarTodo();
		
	} 

	else{
		echo "Las variables no coinciden";
	}



	
}else{
	echo "Error, verifica los parametros enviados";
}

	



class Consulta{	


	// Constructor de la clase
	function __construct(){		


	}


	function consultarIdPedido(){

		/*Incluir el archivo de conexión a este módulo */
		require_once('../libreria/db_conexion.php');
		
		// Codigo para ser buscado en la bd
		$id_pedido = $_POST['id_pedido'];			 


		// Consulta a la base de datos
		$query = "select pedidos.id_pedido,productos.codigo_barra,detalles_pedidos.cantidad,detalles_pedidos.precio,productos.nombre,proveedores.nombre,detalles_pedidos.importe,detalles_pedidos.estatus,pedidos.fecha
									from pedidos  
									inner join detalles_pedidos on pedidos.id_pedido = detalles_pedidos.id_pedido
									inner join proveedores on pedidos.id_proveedor = proveedores.id_proveedor
									inner join productos on detalles_pedidos.id_producto = productos.id_producto
									WHERE pedidos.id_pedido ='".$id_pedido."'";

	$query_db = mysqli_query($cn,$query);

		if(!$query_db)
			die("Error en la consulta sql");

		// Validar si la consulta trajo resultados
		if (mysqli_num_rows($query_db) > 0){
			
			echo '<table id="tablaStatped">';					
			echo '<tr>';
			echo '<th><input type="text" name="id_pedido" id="id_pedido" value="Id Pedido" readonly /></th>';			
			echo '<th><input type="text" name="codigo_barra" id="codigo_barra" value="Codigo Barra" readonly /></th>';
			echo '<th><input type="text" name="cantidad" id="cantidad" value="Cantidad" readonly /></th>';
			echo '<th><input type="text" name="precio" id="precio" value="Precio" readonly /></th>';
			echo '<th><input type="text" name="nombre_pro" id="nombre_pro" value="Nombre" readonly /></th>';
			echo '<th><input type="text" name="nombre_provee" id="nombre_provee" value="Proveedor" readonly /></th>';
			echo '<th><input type="text" name="importe" id="importe" value="Importe" readonly /></th>';
			echo '<th><input type="text" name="estatus" id="estatus" value="Estatus" readonly /></th>';
			echo '<th><input type="text" name="fecha" id="fecha" value="Fecha" readonly /></th>';													
			echo '</tr>';

		
			while ($fila = mysqli_fetch_array($query_db)) {

				echo '<tr>'; 
			    echo '<td><input type="text" name="did_pedido" id="did_pedido" value="'.$fila['id_pedido'].'" readonly /></td>';			   
			    echo '<td><input type="text" name="dcodigo_barra" id="dcodigo_barra" value="'.$fila['codigo_barra'].'" readonly /></td>';
			    echo '<td><input type="text" name="dcantidad" id="dcantidad" value="'.$fila['cantidad'].'" readonly /></td>';
			    echo '<td><input type="text" name="dprecio" id="dprecio" value="'.$fila['precio'].'" readonly /></td>';	
			    echo '<td><input type="text" name="dnombre_pro" id="dnombre_pro" value="'.$fila['nombre'].'" readonly /></td>';	
			    echo '<td><input type="text" name="dnombre_provee" id="dnombre_provee" value="'.$fila['nombre'].'" readonly /></td>'; 
			    echo '<td><input type="text" name="dimporte" id="dimporte" value="'.$fila['importe'].'" readonly /></td>';
			    echo '<td><input type="text" name="destatus" id="destatus" value="'.$fila['estatus'].'" readonly /></td>'; 
			    echo '<td><input type="text" name="dfecha" id="dfecha" value="'.$fila['fecha'].'" readonly /></td>';  
			    echo '</tr>'; 	
			}

			echo '</table>';

			// Libera la memoria del resultado
			  mysqli_free_result($query_db);

			 // Cierra la conexión con la base de datos 
			  mysqli_close($cn); 


		}else{
			echo -1;
		}			


	}


	function consultarIdProducto(){

		/*Incluir el archivo de conexión a este módulo */
		require_once('../libreria/db_conexion.php');

		// Variable para capturar la descripción a buscar
		$id_producto = $_POST['id_producto'];
		
			

		// Consulta a la base de datos
		$query = "select productos.codigo_barra,pedidos.id_pedido,detalles_pedidos.cantidad,detalles_pedidos.precio,productos.nombre,proveedores.nombre,detalles_pedidos.importe,detalles_pedidos.estatus,pedidos.fecha
									from pedidos  
									inner join detalles_pedidos on pedidos.id_pedido = detalles_pedidos.id_pedido
									inner join proveedores on pedidos.id_proveedor = proveedores.id_proveedor
									inner join productos on detalles_pedidos.id_producto = productos.id_producto
									WHERE productos.codigo_barra ='".$id_producto."'";

		$query_db = mysqli_query($cn,$query);

		if(!$query_db)
			die("Error en la consulta sql");

		// Validar si la consulta trajo resultados
		if (mysqli_num_rows($query_db) > 0){

			echo '<table id="tablaStatped">';					
			echo '<tr>';						
			echo '<th><input type="text" name="codigo_barra" id="codigo_barra" value="Codigo Barra" readonly /></th>';
			echo '<th><input type="text" name="id_pedido" id="id_pedido" value="Id Pedido" readonly /></th>';
			echo '<th><input type="text" name="cantidad" id="cantidad" value="Cantidad" readonly /></th>';
			echo '<th><input type="text" name="precio" id="precio" value="Precio" readonly /></th>';
			echo '<th><input type="text" name="nombre_pro" id="nombre_pro" value="Nombre" readonly /></th>';
			echo '<th><input type="text" name="nombre_provee" id="nombre_provee" value="Proveedor" readonly /></th>';
			echo '<th><input type="text" name="importe" id="importe" value="Importe" readonly /></th>';
			echo '<th><input type="text" name="estatus" id="estatus" value="Estatus" readonly /></th>';
			echo '<th><input type="text" name="fecha" id="fecha" value="Fecha" readonly /></th>';													
			echo '</tr>';

		
			while ($fila = mysqli_fetch_array($query_db)) {

				echo '<tr>'; 
				echo '<td><input type="text" name="dcodigo_barra" id="dcodigo_barra" value="'.$fila['codigo_barra'].'" readonly /></td>';
			    echo '<td><input type="text" name="did_pedido" id="did_pedido" value="'.$fila['id_pedido'].'" readonly /></td>';			    
			    echo '<td><input type="text" name="dcantidad" id="dcantidad" value="'.$fila['cantidad'].'" readonly /></td>';
			    echo '<td><input type="text" name="dprecio" id="dprecio" value="'.$fila['precio'].'" readonly /></td>';	
			    echo '<td><input type="text" name="dnombre_pro" id="dnombre_pro" value="'.$fila['nombre'].'" readonly /></td>';	
			    echo '<td><input type="text" name="dnombre_provee" id="dnombre_provee" value="'.$fila['nombre'].'" readonly /></td>'; 
			    echo '<td><input type="text" name="dimporte" id="dimporte" value="'.$fila['importe'].'" readonly /></td>';
			    echo '<td><input type="text" name="destatus" id="destatus" value="'.$fila['estatus'].'" readonly /></td>'; 
			    echo '<td><input type="text" name="dfecha" id="dfecha" value="'.$fila['fecha'].'" readonly /></td>';  
			    echo '</tr>'; 	
			}

			echo '</table>';

			// Libera la memoria del resultado
			  mysqli_free_result($query_db);

			 // Cierra la conexión con la base de datos 
			  mysqli_close($cn); 


		}else{
			echo -1;
		}	

		
	}

	function consultarTodo(){

		/*Incluir el archivo de conexión a este módulo */
		require_once('../libreria/db_conexion.php');

		// Variable que contendra la cantidad de registros a consultar
		$limite = $_POST['limite'];			


		// Primera consulta a la tabla Pro
		$query = "select pedidos.id_pedido,productos.codigo_barra,detalles_pedidos.cantidad,detalles_pedidos.precio,productos.nombre,proveedores.nombre,detalles_pedidos.importe,detalles_pedidos.estatus,pedidos.fecha
					from pedidos  
					inner join detalles_pedidos on pedidos.id_pedido = detalles_pedidos.id_pedido
					inner join proveedores on pedidos.id_proveedor = proveedores.id_proveedor
					inner join productos on detalles_pedidos.id_producto = productos.id_producto
				    limit $limite, 18";
				    
		$query_db = mysqli_query($cn,$query);

		// Saber cuento registros tiene la tabla status pedidos
		$reg = "SELECT * FROM detalles_pedidos";
		$query_total_rows = mysqli_query($cn,$reg);
		$totalReg = mysqli_num_rows($query_total_rows);
		

		if(!$query_db)
			die("Error en la consulta sql");

		// Calcular las paginas totales
		$paginas = ceil ($totalReg/18);
		

		// Validar si la consulta trajo resultados
		if (mysqli_num_rows($query_db) > 0)
		{

			echo '<table id="tablaStatped">';					
			echo '<tr>';
			echo '<th><input type="text" name="id_pedido" id="id_pedido" value="Id Pedido" readonly /></th>';			
			echo '<th><input type="text" name="codigo_barra" id="codigo_barra" value="Codigo Barra" readonly /></th>';
			echo '<th><input type="text" name="cantidad" id="cantidad" value="Cantidad" readonly /></th>';
			echo '<th><input type="text" name="precio" id="precio" value="Precio" readonly /></th>';
			echo '<th><input type="text" name="nombre_pro" id="nombre_pro" value="Nombre" readonly /></th>';
			echo '<th><input type="text" name="nombre_provee" id="nombre_provee" value="Proveedor" readonly /></th>';
			echo '<th><input type="text" name="importe" id="importe" value="Importe" readonly /></th>';
			echo '<th><input type="text" name="estatus" id="estatus" value="Estatus" readonly /></th>';
			echo '<th><input type="text" name="fecha" id="fecha" value="Fecha" readonly /></th>';													
			echo '</tr>';

		
			while ($fila = mysqli_fetch_array($query_db)) {

				echo '<tr>'; 
			    echo '<td><input type="text" name="did_pedido" id="did_pedido" value="'.$fila['id_pedido'].'" readonly /></td>';			   
			    echo '<td><input type="text" name="dcodigo_barra" id="dcodigo_barra" value="'.$fila['codigo_barra'].'" readonly /></td>';
			    echo '<td><input type="text" name="dcantidad" id="dcantidad" value="'.$fila['cantidad'].'" readonly /></td>';
			    echo '<td><input type="text" name="dprecio" id="dprecio" value="'.$fila['precio'].'" readonly /></td>';	
			    echo '<td><input type="text" name="dnombre_pro" id="dnombre_pro" value="'.$fila['nombre'].'" readonly /></td>';	
			    echo '<td><input type="text" name="dnombre_provee" id="dnombre_provee" value="'.$fila['nombre'].'" readonly /></td>'; 
			    echo '<td><input type="text" name="dimporte" id="dimporte" value="'.$fila['importe'].'" readonly /></td>';
			    echo '<td><input type="text" name="destatus" id="destatus" value="'.$fila['estatus'].'" readonly /></td>'; 
			    echo '<td><input type="text" name="dfecha" id="dfecha" value="'.$fila['fecha'].'" readonly /></td>';  
			    echo '</tr>'; 	
			}

			echo '</table>';	

			// Cálculo para navegar en los registros de la tabla
			if ($limite > 0) {	
				
				$limit = $limite -18;
				echo '<div id="anterior" onclick= "buscarTodo('.$limit.')"><span class="flecha_anterior"></span>Anterior</div>';
										
			}

			if($limite < $totalReg -18){
				
				$limit = $limite + 18;
				echo '<div id="siguiente" onclick="buscarTodo('.$limit.')">Siguiente<span class="flecha_siguiente"></span></div>';			

			}


		}

		// Liberar y cerrar conexión
		mysqli_free_result($query_db);
		mysqli_close($cn);


	}




}

?>