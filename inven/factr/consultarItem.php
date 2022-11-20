<?php

// Validar cada una de las variables enviadas al servidor
if (isset($_POST['id_factura']) &&  !empty($_POST['id_factura']) && isset($_POST['limite'])){ 

	 
 	// Instanciar el objeto
	$miConsulta = new Consulta(); 
	
	// Consultar todos los items
	$miConsulta->consultarItems();
	

	
}else{
	echo "Error, verifica los parametros enviados";
}


	



class Consulta{

	// Variables de conexión al servidor
	private $localhost = "localhost";
	private $user = "root";
	private $password = "2678";
	private $db = "inventario";


	// Constructor de la clase
	function __construct(){		


	}
	

	function consultarItems(){

		// Variable que contendra la cantidad de registros a consultar
		
		$id_factura = $_POST['id_factura'];
		$limite = $_POST['limite'];

		if (!($cn = mysql_connect($this->localhost, $this->user,$this->password))) 
	 	die("Error de conexión");	 


		// Conectar a la Dase de Datos
		if(!mysql_select_db($this->db,$cn))
			die("Error en la conexión a la bd ");	


		
		// 
		$query = mysql_query("select detalles_facturas.id_factura, productos.codigo_barra, productos.nombre, productos.precio_venta, detalles_facturas.cantidad, detalles_facturas.importe
							  from detalles_facturas inner join productos
							  on detalles_facturas.id_producto = productos.id_producto
							  where id_factura ='".$id_factura."' limit $limite, 10 ", $cn);



		// Saber cuento registros tiene la tabla detalles_factura
		$reg = mysql_query("SELECT * FROM detalles_facturas where id_factura ='".$id_factura."'", $cn);
		$totalReg = mysql_num_rows($reg);
				

		if(!$query)
			die("Error en la consulta");

			

		// Validar si la consulta trajo resultados
		if (mysql_num_rows($query) > 0)
		{
			echo '<table id="tdetalle_factura">';				
			echo '<tr>';
			echo '<th><input type="text" name="hid_factura" id="hid_factura" value="Id Factura" readonly /></th>';
			echo '<th><input type="text" name="hcodigo_barra" id="hcodigo_barra" value="Código Barra" readonly /></th>';
			echo '<th><input type="text" name="hnombre" id="hnombre" value="Nombre" readonly /></th>';
			echo '<th><input type="text" name="hprecio_venta" id="hprecio_venta" value="Precio Venta" readonly /></th>';
			echo '<th><input type="text" name="hcantidad" id="hcantidad" value="Cantidad" readonly /></th>';
			echo '<th><input type="text" name="himporte" id="himporte" value="Importe" readonly /></th>';															
			echo '</tr>';

		
			while ($fila = mysql_fetch_array($query)) {

				echo '<tr>'; 
			    echo '<td><input type="text" name="did_factura" id="did_factura" value="'.$fila['id_factura'].'" readonly /></td>';
			    echo '<td><input type="text" name="dcodigo_barra" id="dcodigo_barra" value="'.$fila['codigo_barra'].'" readonly /></td>';
			    echo '<td><input type="text" name="dnombre" id="dnombre" value="'.$fila['nombre'].'" readonly /></td>';
			    echo '<td><input type="text" name="dprecio_venta" id="dprecio_venta" value="'.$fila['precio_venta'].'" readonly /></td>';
			    echo '<td><input type="text" name="dcantidad" id="dcantidad" value="'.$fila['cantidad'].'" readonly /></td>';
			    echo '<td><input type="text" name="dimporte" id="dimporte" value="'.$fila['importe'].'" readonly /></td>';				    			    
			    echo '</tr>'; 	
			}

			echo '</table>';


			// Cálculo para navegar en los registros de la tabla
			if ($limite > 0) {	
				
				$limit = $limite -10;
				echo '<div id="anterior" onclick= "buscarTodo('.$limit.')"><span class="flecha_anterior"></span>Anterior</div>';
										
			}

			if($limite < $totalReg -10){
				
				$limit = $limite + 10;
				echo '<div id="siguiente" onclick="buscarTodo('.$limit.')">Siguiente<span class="flecha_siguiente"></span></div>';	


			}




		}

		


	}

	



}

?>