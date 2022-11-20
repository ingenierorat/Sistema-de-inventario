<?php
  
// Validar cada una de las variables enviadas al servidor
if (isset($_POST['nuevo']) && !empty($_POST['nuevo']) or isset($_POST['detalle']) && !empty($_POST['detalle'])) {

	// Comprobar la igualdad de cada variable enviada
	if (isset($_POST['nuevo']) == "nuevo") { 
		
		// Función que evalua cada campo enviado
		registroValidarNuevo();		
		
	}elseif (isset($_POST['detalle']) == "detalle") { 

		// Función que evalua cada campo enviado
		registroValidarDetalle();		

	}else{
		echo "Parametros evaluados incorrectos";
	}





	
}else{
	echo "Error, verifica los parametros enviados";
}

function registroValidarNuevo(){	

	$id_pedido = $_POST['id_pedido'];		
	$id_proveedor = $_POST['id_proveedor'];
	$fecha = $_POST['fecha'];



	// Validar cada una de las variables enviadas al servidor
	if (isset($id_pedido) && !empty($id_pedido) && isset($id_proveedor) && !empty($id_proveedor) && isset($fecha) && !empty($fecha)){


		// Instanciar un objeto registro
		$registro = new Registro();
		// Llamar uno de sus métodos
		$registro->registroNuevo();
		

			
	}else{
		echo "Error, los campos no pueden estar vacios";
	}

}


// Validar campos de cada petición del usuario
function registroValidarDetalle(){

	$id_pedido_detalle = $_POST['id_pedido_detalle'];		
	$id_producto = $_POST['id_producto'];
	$cantidad = $_POST['cantidad'];
	$precio = $_POST['precio'];
	$descuento = $_POST['descuento'];
	$importe = $_POST['importe'];
	$estatus = $_POST['estatus'];


	// Validar cada una de las variables enviadas al servidor
	if (isset($id_pedido_detalle) && !empty($id_pedido_detalle) && isset($id_producto) && !empty($id_producto) &&
		isset($cantidad) && !empty($cantidad) && isset($precio) && !empty($precio) && isset($descuento) &&
		isset($importe) && !empty($importe) && isset($estatus) && !empty($estatus)){

		// Instanciar un objeto registro
		$registro = new Registro();
		// Llamar uno de sus métodos
		$registro->registroDetalle();
		

			
	}else{
		echo "Error, los campos no pueden estar vacios";
	}

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

	// Ingresa registro nuevo al sistema
	function registroNuevo(){
		
		$id_pedido = $_POST['id_pedido'];		
		$id_proveedor = $_POST['id_proveedor'];
		$fecha = $_POST['fecha'];
			
					
		// Cadena de conexión al Servidor
		if (!($cn = mysql_connect($this->localhost, $this->user,$this->password))) 
		 	die("ERROR, no se puede conextar al servidor");	 		 


		// Conectar a la Dase de Datos
		if(!mysql_select_db($this->db, $cn))
			die("ERROR, no se puede conectar a la base de datos");	


		// Insertar registro a la base de datos
		$insert = mysql_query("INSERT INTO pedidos () VALUES ('$id_pedido', '$id_proveedor', '$fecha')", $cn);

		
		// Preguntar se fue correcta la insercción de datos
		if(!$insert)
			die("Error de insercción");	

		// Si el registro se inserta correctamente lanza este mensaje
		echo "si";			
		

		 // Cierra la conexión con la base de datos 
		  mysql_close($cn); 
		
			

	}

	// Ingresa registro nuevo al sistema
	function registroDetalle(){
		
		$id_pedido_detalle = $_POST['id_pedido_detalle'];		
		$id_producto = $_POST['id_producto'];
		$cantidad = $_POST['cantidad'];
		$precio = $_POST['precio'];
		$descuento = $_POST['descuento'];
		$importe = $_POST['importe'];
		$estatus = $_POST['estatus'];
			 
					
		// Cadena de conexión al Servidor
		if (!($cn = mysql_connect($this->localhost, $this->user,$this->password))) 
		 	die("ERROR, no se puede conextar al servidor");	 		 


		// Conectar a la Dase de Datos
		if(!mysql_select_db($this->db, $cn))
			die("ERROR, no se puede conectar a la base de datos");	


		// Insertar registro a la base de datos
		$insert = mysql_query("INSERT INTO detalles_pedidos () VALUES ('$id_pedido_detalle', '$id_producto', '$cantidad', '$precio',
															  '$descuento', '$importe', '$estatus')", $cn);

		
		// Preguntar se fue correcta la insercción de datos
		if(!$insert)
			die("Error de insercción");	
 
		// Si el registro se inserta correctamente lanza este mensaje
		echo "si";			
		

		 // Cierra la conexión con la base de datos 
		  mysql_close($cn); 
		
			

	}



	

}

?>