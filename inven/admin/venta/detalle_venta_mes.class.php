<?php
  
//Variables a utilizar
$limite = $_POST['limite'];
$fecha_dia = $_POST['fecha_dia'];
$fecha_mes = $_POST['fecha_mes']; 

// Validar cada una de las variables enviadas al servidor
if (isset($fecha_dia) && !empty($fecha_dia) && 
	isset($fecha_mes) && !empty($fecha_mes) &&
	isset($limite)) {

	//Instanciar el Objeto
	$venta = new Consulta();
	//Llamar a la función dia
	$venta->mes($limite, $fecha_dia, $fecha_mes);



	
}else{
	echo "Error, verifica los parametros enviados";
}

	


//Clase Consulta
class Consulta{

	

	//Constructor de la clase
	function __construct(){	


	}


	//Extrae la venta de un intervalo de fecha establecido por el usuario
	function mes($limite, $fecha_dia, $fecha_mes){

		
		//Incluir datos de la conexión a traves de un archivo externo.
        require('../../libreria/bd_conexion.php');


		// Primera consulta de tipo Join la cual mostrará los datos al usuario
		$query = "select facturas.id_factura, productos.codigo_barra, productos.descripcion, productos.itebis, productos.porciento_venta, 
		          productos.precio_ingreso, productos.precio_venta, 
		          detalles_facturas.cantidad, detalles_facturas.importe from detalles_facturas
				  inner join facturas
                  on detalles_facturas.id_factura = facturas.id_factura
                  inner join productos
                  on detalles_facturas.id_producto = productos.id_producto
				  where facturas.fecha between '".$fecha_dia."' and '".$fecha_mes."'
				  limit $limite, 15";
		//Guardar el resultado en una variable
		$resultado = mysqli_query($conexion, $query);


		// Saber cuento registros tiene la consulta join
		$reg = mysqli_query($conexion, "select * from detalles_facturas
							inner join facturas
							on detalles_facturas.id_factura = facturas.id_factura
							where facturas.fecha between '".$fecha_dia."' and '".$fecha_mes."'");

		//Calcular el total de los registros
		$totalReg = mysqli_num_rows($reg);

		

		if(!$resultado)
			die("Error en la consulta sql");		
		
		

		// Validar si la consulta trajo resultados
		if (mysqli_num_rows($resultado) > 0)
		{
			echo '<table id="tb_detalles_venta">';					
			echo '<tr>';
			echo '<th><input type="text" id="hid_factura" value="Id Factura" readonly /></th>';
			echo '<th><input type="text" id="hcodigo_barra" value="Código Barra" readonly /></th>';
			echo '<th><input type="text" id="hdescripcion" value="Descripción" readonly /></th>';
			echo '<th><input type="text" id="hitebis" value="Itebis" readonly /></th>';
			echo '<th><input type="text" id="hporciento_venta" value="% Venta" readonly /></th>';
			echo '<th><input type="text" id="hprecio_ingreso" value="Precio Ingreso" readonly /></th>';
			echo '<th><input type="text" id="hprecio_venta" value="Precio Venta" readonly /></th>';
			echo '<th><input type="text" id="hcantidad" value="Cantidad" readonly /></th>';
			echo '<th><input type="text" id="himporte" value="Importe" readonly /></th>';												
			echo '</tr>';

		
			while ($fila = mysqli_fetch_array($resultado)) {

				echo '<tr>'; 
			    echo '<td><input type="text" id="did_factura" value="'.$fila['id_factura'].'" readonly /></td>';
			    echo '<td><input type="text" id="dcodigo_barra" value="'.$fila['codigo_barra'].'" readonly /></td>';
			    echo '<td><input type="text" id="ddescripcion" value="'.$fila['descripcion'].'" readonly /></td>';
			    echo '<td><input type="text" id="ditebis" value="'.$fila['itebis'].'" readonly /></td>';
			    echo '<td><input type="text" id="dporciento_venta" value="'.$fila['porciento_venta'].'" readonly /></td>';
			    echo '<td><input type="text" id="dprecio_ingreso" value="'.$fila['precio_ingreso'].'" readonly /></td>';
			    echo '<td><input type="text" id="dprecio_venta" value="'.$fila['precio_venta'].'" readonly /></td>';
			    echo '<td><input type="text" id="dcantidad" value="'.$fila['cantidad'].'" readonly /></td>';
			    echo '<td><input type="text" id="dimporte" value="'.$fila['importe'].'" readonly /></td>';  
			    echo '</tr>'; 	
			}

			echo '</table>';


			// Cálculo para navegar en los registros de la tabla
			if ($limite > 0) {	
				
				$limit = $limite -15;
				echo '<div id="anterior" onclick= "detalle_venta_mes('.$limit.')"><span class="flecha_anterior"></span>Anterior</div>';
										
			}

			if($limite < $totalReg -15){
				
				$limit = $limite + 15;
				echo '<div id="siguiente" onclick="detalle_venta_mes('.$limit.')">Siguiente<span class="flecha_siguiente"></span></div>';			

			}


		}


	}


}


?>