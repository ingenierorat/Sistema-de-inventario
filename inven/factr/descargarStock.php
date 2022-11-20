<?php

// Variable para capturar los datos enviados
$id_producto = $_POST['id_producto'];
$cantidad = $_POST['cantidad'];


  

// Validar cada una de las variables enviadas al servidor
if (isset($id_producto) && !empty($id_producto) &&	  
	isset($cantidad) &&    !empty($cantidad)
		
	){ 

	
 	// Instanciar el objeto
	$miConsulta = new Consulta(); 
	// Inserta item en la bd 
	$miConsulta->descargarStock();
		

	
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


	function descargarStock(){

		// Variable para capturar el nombre a buscar		
		$id_producto = $_POST['id_producto'];		
		$cantidad = $_POST['cantidad'];	
		

		
		// Cadena de conexión al Servidor
		if (!($cn = mysql_connect($this->localhost, $this->user,$this->password))) 
		 	die("Error en la conexión");	 

		// Conectar a la Dase de Datos
		if(!mysql_select_db($this->db,$cn))
			die("Error en la conexión a la bd"); 		

		// Consulta a la base de datos
		$update = mysql_query("UPDATE  productos SET disponibilidad = disponibilidad - $cantidad WHERE id_producto='".$id_producto."'", $cn);

		if(!$update)
			die("Error en la consulta");

		echo $update;
		
			
		// Cierra la conexión con la base de datos 
		 mysql_close($cn); 

		
	}

	

}

?>