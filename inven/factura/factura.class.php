<?php
  
   
// Validar la variable enviadas al servidor
if (isset($_POST['id_factura']) && isset($_POST['id_factura'])) {  

	$id_factura = $_POST['id_factura'];
	//Instanciar el Objeto
	$factura = new Factura();
	//Llamar a la función dia
	$factura->buscarCodigo($id_factura);

	
}elseif (isset($_POST['limite'])) {

	//Variables a utilizar
	$limite = $_POST['limite'];
	//Instanciar el Objeto
	$factura = new Factura();
	//Llamar a la función dia
	$factura->buscarTodo($limite);

}else{
	echo "Error, verifica los parametros enviados";
}

	



class Factura{

	
	// Constructor de la clase
	function __construct(){	


	}



	function buscarCodigo($id_factura){
		
		
		//Incluir datos de la conexión a traves de un archivo externo.
        require('../libreria/bd_conexion.php');


		// Primera consulta de tipo Join la cual mostrará los datos al usuario
		$query ="select detalles_facturas.id_factura, productos.codigo_barra, productos.nombre, productos.precio_venta,
		         detalles_facturas.cantidad, productos.itebis, detalles_facturas.importe, facturas.fecha, clientes.nombre as nombre_cliente
                 from detalles_facturas
                 inner join productos
                 on detalles_facturas.id_producto = productos.id_producto
                 inner join clientes
                 on detalles_facturas.id_cliente = clientes.id_cliente
                 inner join facturas
                 on detalles_facturas.id_factura = facturas.id_factura
                 where facturas.id_factura = '".$id_factura."'
                 limit 0, 22";

		//Guardar el resultado en una variable
		$resultado = mysqli_query($conexion, $query);


		// Saber cuento registros tiene la consulta join
		$reg = mysqli_query($conexion, "select *
		                                from detalles_facturas
                                        where detalles_facturas.id_factura ='".$id_factura."'");

		//Calcular el total de los registros
		$totalReg = mysqli_num_rows($reg);
		

		if(!$resultado)
			die("Error en la consulta sql");			
		

		// Validar si la consulta trajo resultados
		if (mysqli_num_rows($resultado) > 0)
		{
			echo '<table id="tb_detalle_factura">';					
			echo '<tr>';
			echo '<th><input type="text" id="hid_factura" value="Id Factura" readonly /></th>';
			echo '<th><input type="text" id="hcodigo_barra" value="Código Barra" readonly /></th>';
			echo '<th><input type="text" id="hnombre" value="Nombre" readonly /></th>';
			echo '<th><input type="text" id="hprecio_venta" value="Precio Venta" readonly /></th>';
			echo '<th><input type="text" id="hcantidad" value="Cantidad" readonly /></th>';
			echo '<th><input type="text" id="hitebis" value="Itebis" readonly /></th>';
			echo '<th><input type="text" id="himporte" value="Importe" readonly /></th>';
			echo '<th><input type="text" id="hcliente" value="Cliente" readonly /></th>';
			echo '<th><input type="text" id="hfecha" value="Fecha" readonly /></th>';
			echo '<th><input type="text" id="hfactura" value="Factura" readonly /></th>';
			echo '</tr>';

		
			while ($fila = mysqli_fetch_array($resultado)) {

				echo '<tr>'; 
			    echo '<td><input type="text" id="did_factura" value="'.$fila['id_factura'].'" readonly /></td>';
			    echo '<td><input type="text" id="dcodigo_barra" value="'.$fila['codigo_barra'].'" readonly /></td>';
			    echo '<td><input type="text" id="dnombre" value="'.$fila['nombre'].'" readonly /></td>';
			    echo '<td><input type="text" id="dprecio_venta" value="'.$fila['precio_venta'].'" readonly /></td>';
			    echo '<td><input type="text" id="dcantidad" value="'.$fila['cantidad'].'" readonly /></td>';
			    echo '<td><input type="text" id="ditebis" value="'.$fila['itebis'].'" readonly /></td>';
			    echo '<td><input type="text" id="dimporte" value="'.$fila['importe'].'" readonly /></td>';	
			    echo '<td><input type="text" id="dcliente" value="'.$fila['nombre_cliente'].'" readonly /></td>';
			    echo '<td><input type="text" id="dfecha" value="'.$fila['fecha'].'" readonly /></td>';			    	
			    echo '</tr>'; 	
			}

			echo '</table>';		
			
			echo '<a id="dfactura" onclick="imprimir_factura('.$id_factura.')">Imprimir</a>';			
			


			//Libera la memoria del resultado
			 mysqli_free_result($resultado);

			//Cierra la conexión con la base de datos 
		 	mysqli_close($conexion);
			

		}else{
			
			//Devolver no si no se ha encontrado nunguna coincidencia
			echo -1;
		}



	}



	function buscarTodo($limite){
		

		//Incluir datos de la conexión a traves de un archivo externo.
        require('../libreria/bd_conexion.php');


		// Primera consulta de tipo Join la cual mostrará los datos al usuario
		$query ="select detalles_facturas.id_factura, productos.codigo_barra, productos.nombre, productos.precio_venta,
		         detalles_facturas.cantidad, productos.itebis, detalles_facturas.importe, facturas.fecha, clientes.nombre as nombre_cliente
                 from detalles_facturas
                 inner join productos
                 on detalles_facturas.id_producto = productos.id_producto
                 inner join clientes
                 on detalles_facturas.id_cliente = clientes.id_cliente
                 inner join facturas
                 on detalles_facturas.id_factura = facturas.id_factura                 
				 limit $limite, 20";

		//Guardar el resultado en una variable
		$resultado = mysqli_query($conexion, $query);


		// Saber cuento registros tiene la consulta join
		$reg = mysqli_query($conexion, "select * from detalles_facturas");

		//Calcular el total de los registros
		$totalReg = mysqli_num_rows($reg);
		

		if(!$resultado)
			die("Error en la consulta sql");			
		

		// Validar si la consulta trajo resultados
		if (mysqli_num_rows($resultado) > 0)
		{
			echo '<table id="tb_detalle_factura">';					
			echo '<tr>';
			echo '<th><input type="text" id="hid_factura" value="Id Factura" readonly /></th>';
			echo '<th><input type="text" id="hcodigo_barra" value="Código Barra" readonly /></th>';
			echo '<th><input type="text" id="hnombre" value="Nombre" readonly /></th>';
			echo '<th><input type="text" id="hprecio_venta" value="Precio Venta" readonly /></th>';
			echo '<th><input type="text" id="hcantidad" value="Cantidad" readonly /></th>';
			echo '<th><input type="text" id="hitebis" value="Itebis" readonly /></th>';
			echo '<th><input type="text" id="himporte" value="Importe" readonly /></th>';
			echo '<th><input type="text" id="hcliente" value="Cliente" readonly /></th>';
			echo '<th><input type="text" id="hfecha" value="Fecha" readonly /></th>';			
			echo '</tr>';

		
			while ($fila = mysqli_fetch_array($resultado)) {

				echo '<tr>'; 
			    echo '<td><input type="text" id="did_factura" value="'.$fila['id_factura'].'" readonly /></td>';
			    echo '<td><input type="text" id="dcodigo_barra" value="'.$fila['codigo_barra'].'" readonly /></td>';
			    echo '<td><input type="text" id="dnombre" value="'.$fila['nombre'].'" readonly /></td>';
			    echo '<td><input type="text" id="dprecio_venta" value="'.$fila['precio_venta'].'" readonly /></td>';
			    echo '<td><input type="text" id="dcantidad" value="'.$fila['cantidad'].'" readonly /></td>';
			    echo '<td><input type="text" id="ditebis" value="'.$fila['itebis'].'" readonly /></td>';
			    echo '<td><input type="text" id="dimporte" value="'.$fila['importe'].'" readonly /></td>';	
			    echo '<td><input type="text" id="dcliente" value="'.$fila['nombre_cliente'].'" readonly /></td>';
			    echo '<td><input type="text" id="dfecha" value="'.$fila['fecha'].'" readonly /></td>';			    	
			    echo '</tr>'; 	
			}

			echo '</table>';			
			

			// Cálculo para navegar en los registros de la tabla
			if ($limite > 0) {	
				
				$limit = $limite -20;
				echo '<div id="anterior" onclick= "buscarTodo('.$limit.')"><span class="flecha_anterior"></span>Anterior</div>';
										
			}

			if($limite < $totalReg -20){
				
				$limit = $limite + 20;
				echo '<div id="siguiente" onclick="buscarTodo('.$limit.')">Siguiente<span class="flecha_siguiente"></span></div>';			

			}

		//Libera la memoria del resultado
		 mysqli_free_result($resultado);

		//Cierra la conexión con la base de datos 
		mysqli_close($conexion);


		}else{
			
			//Devolver no si no se ha encontrado nunguna coincidencia
			echo -1;
		}




	}




}

?>