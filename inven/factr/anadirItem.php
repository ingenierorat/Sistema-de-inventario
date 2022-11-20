<?php

// Variable para capturar los datos enviados
$id_factura = $_POST['id_factura'];
$id_producto = $_POST['id_producto'];
$id_cliente = $_POST['id_cliente'];
$cantidad = $_POST['cantidad']; 
$precio = $_POST['precio'];
$importe = $_POST['importe'];

  

// Validar cada una de las variables enviadas al servidor
if (isset($id_factura) &&  !empty($id_factura) && 
	isset($id_producto) && !empty($id_producto) &&
	isset($id_cliente) &&  !empty($id_cliente) &&  
	isset($cantidad) &&    !empty($cantidad) && 
	isset($precio) &&      !empty($precio) &&                                                                                  
	isset($importe) &&     !empty($importe)
	
	){  

	
 	// Instanciar el objeto
	$miConsulta = new Consulta(); 
	// Inserta item en la bd 
	$miConsulta->insertarItem();
		

	
}else{
	echo "Error de parametros";
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


	function insertarItem(){

		// Variable para capturar el nombre a buscar
		$id_factura = $_POST['id_factura'];
		$id_producto = $_POST['id_producto'];
		$id_cliente = $_POST['id_cliente'];
		$cantidad = $_POST['cantidad'];
		$precio = $_POST['precio'];
		$importe = $_POST['importe'];

		
		// Cadena de conexión al Servidor
		if (!($cn = mysql_connect($this->localhost, $this->user,$this->password))) 
		 	die("Error en la conexión");	 

		// Conectar a la Dase de Datos
		if(!mysql_select_db($this->db,$cn))
			die("Error en la conexión a la bd"); 		

		// Consulta a la base de datos
		$insert = mysql_query("INSERT INTO detalles_facturas () VALUE('$id_factura','$id_producto','$id_cliente','$cantidad','$precio','$importe')", $cn);

		if(!$insert)
			die("Error en la consulta");
		
			
		// Cierra la conexión con la base de datos 
		 mysql_close($cn); 

		
	}

	

}

?>