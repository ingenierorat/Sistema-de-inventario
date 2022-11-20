<?php

// Variables a utilizar
$id_pro = $_POST['id_pro'];
$cant = $_POST['cant'];
$id_ped = $_POST['id_ped'];
$fila;



// Validar cada una de las variables enviadas al servidor
if (isset($id_pro) && !empty($id_pro) && isset($cant) && !empty($cant) && isset($id_ped) && !empty($id_ped)) {

	// Instanciar un objeto registro
	$registro = new Registro();
	// Llamar uno de sus métodos
	$registro->registrarLinea();		 
 
	
}else{
	echo "Error de parametros enviados";
}







// Clase para acceder a la base de datos
class Registro{


	// Variables de conexión al servidor
	private $localhost = "localhost";
	private $user = "root";
	private $password = "2678";
	private $db = "inventario";


	// Constructor de la clase
	function __construct(){	


	}	

	function registrarLinea(){

		$id_pro = $_POST['id_pro'];
		$cant = $_POST['cant'];
		$id_ped = $_POST['id_ped'];
		
		
		// Cadena de conexión al Servidor
		if (!($cn = mysql_connect($this->localhost, $this->user,$this->password))) 
		 	die("Error de conexión al servidor");	 		 


		// Conectar a la Dase de Datos
		if(!mysql_select_db($this->db, $cn))
			die("Error de bd");	

		// Obtener la cantidad actual del material antes de ser actualizada
		$select = mysql_query("SELECT disponibilidad FROM  productos WHERE id_producto='".$id_pro."'", $cn);
		
		if(mysql_num_rows($select) > 0) {
			// Convertir la consulta en un array
			$fila = mysql_fetch_array($select);	

			// Stock actual del material
			$stock = $fila['disponibilidad'];
			// Nuevo stock del material
			$nuevoSctock = $stock + $cant;
			// Actualizar registro a la base de datos
			mysql_query("UPDATE  productos SET disponibilidad= '".$nuevoSctock."' WHERE id_producto='".$id_pro."'", $cn);
			// Actualizar el estatus del pedido.
			mysql_query("UPDATE detalles_pedidos SET estatus = 'Recibido' WHERE id_producto= '".$id_pro."' && estatus = 'En espera'", $cn);	
			// Si el registro se inserta correctamente lanza este mensaje
			echo 1;

		}else{
			echo -1;
		}				
		
		// Liberar la memoria de la consulta
		mysql_free_result($select);	
		// Cierra la conexión con la base de datos 
		 mysql_close($cn); 

			
	}

	
}

?>