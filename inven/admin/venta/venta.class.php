<?php
   
 
// Validar cada una de las variables enviadas al servidor
if (isset($_POST['venta_dia']) && !empty($_POST['venta_dia']) &&
	isset($_POST['fecha_dia']) && !empty($_POST['fecha_dia'])) {

	//Variables a utilizar	
	$fecha_dia = $_POST["fecha_dia"];

	//Instancia el Objeto
	$_venta = new Venta();
	//Llamar a la función
	$_venta->dia($fecha_dia);


	}
	elseif (isset($_POST['venta_mes']) && !empty($_POST['venta_mes']) &&
		    isset($_POST['fecha_dia']) && !empty($_POST['fecha_dia']) &&
		    isset($_POST['fecha_mes']) && !empty($_POST['fecha_mes'])) {

		//Variables a utilizar
		$fecha_dia = $_POST["fecha_dia"];
		$fecha_mes = $_POST["fecha_mes"];

		//Instancia el Objeto
		$_venta = new Venta();
		//Llamar a la función
		$_venta->mes($fecha_dia, $fecha_mes);

		
	}
	


	else{echo "Error, verifica los parametros enviados";}





// Clase para acceder a la base de datos
class Venta{


	
	// Constructor de la clase
	function __construct(){
		


	}

	// Ingresa registro nuevo al sistema
	public function dia($fecha_dia){	

				
					
		//Incluir datos de la conexión a traves de un archivo externo.
        require('../../libreria/bd_conexion.php');


		//Consulta que arrojará la cantidad vendida y el importe de la venta para una fecha en específico
		$select = "select cantidad, (precio_ingreso * cantidad) As neto, importe, facturas.fecha
									from detalles_facturas
									inner join facturas
									on detalles_facturas.id_factura = facturas.id_factura
									inner join productos
									on detalles_facturas.id_producto = productos.id_producto
									where facturas.fecha = '".$fecha_dia."'";


		//Guardar el resultado en una variable
		$select = mysqli_query($conexion, $select);

		
		// Preguntar se fue correcta la insercción de datos
		if(!$select)
			die("Error de la consulta");


		if (mysqli_num_rows($select) > 0) {
			
			// Crear un array
			$datos[] = array();
			// Recorrer el resultado de la consulta
			while ($fila = mysqli_fetch_array($select)) {

				// Agragar al array la fila encontrada
				$datos[] = $fila;
				
			}

			// Enviarle un objeto Json con los datos obtenido de la consulta
			echo json_encode($datos);


		}


		//Liberar la memoria	
		mysqli_free_result($select);

		// Cierra la conexión con la base de datos 
		mysqli_close($conexion); 
					

	}

	public function mes($fecha_dia, $fecha_mes){
		

		//Incluir datos de la conexión a traves de un archivo externo.
        require('../../libreria/bd_conexion.php');


		//Consulta que arrojará la cantidad vendida y el importe de la venta para una fecha en específico
		$select ="select cantidad, (precio_ingreso * cantidad) As neto, importe, facturas.fecha
									from detalles_facturas
									inner join facturas
									on detalles_facturas.id_factura = facturas.id_factura
									inner join productos
									on detalles_facturas.id_producto = productos.id_producto
									where facturas.fecha between '".$fecha_dia."' and '".$fecha_mes."'";

		//Guardar el resultado en una variable
		$select = mysqli_query($conexion, $select);

		
		// Preguntar se fue correcta la insercción de datos
		if(!$select)
			die("Error de la consulta");



		if (mysqli_num_rows($select) > 0) {
			
			// Crear un array
			$datos[] = array();
			// Recorrer el resultado de la consulta
			while ($fila = mysqli_fetch_array($select)) {

				// Agragar al array la fila encontrada
				$datos[] = $fila;
				
			}
			// Enviarle un objeto Json con los datos obtenido de la consulta
			echo json_encode($datos);


		}

		//Liberar la memoria	
		mysqli_free_result($select);

		// Cierra la conexión con la base de datos 
	    mysqli_close($conexion); 
	

	}


}





?>