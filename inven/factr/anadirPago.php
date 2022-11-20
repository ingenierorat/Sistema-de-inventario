<?php

// Variable para capturar los datos enviados
$id_cliente = $_POST['id_cliente'];
$id_factura = $_POST['id_factura'];
$monto_pagado = $_POST['monto_pagado'];
$monto_suministrado = $_POST['monto_suministrado'];
$devuelta = $_POST['devuelta'];
$modo_pago = $_POST['modo_pago'];

  

// Validar cada una de las variables enviadas al servidor
if (isset($id_cliente) &&  !empty($id_cliente) && 
	isset($id_factura) && !empty($id_factura) &&
	isset($monto_pagado) && !empty($monto_pagado) &&
	isset($monto_suministrado) && !empty($monto_suministrado) &&
	isset($devuelta) && !empty($devuelta) &&
	isset($modo_pago) &&  !empty($modo_pago)  
	
	
	){  

	
 	// Instanciar el objeto
	$miConsulta = new Consulta(); 
	// Inserta item en la bd 
	$miConsulta->insertarPago();
		

	
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


	function insertarPago(){

		// Variable para capturar el nombre a buscar
		$id_cliente = $_POST['id_cliente'];
		$id_factura = $_POST['id_factura'];
		$monto_pagado = $_POST['monto_pagado'];
		$monto_suministrado = $_POST['monto_suministrado'];
		$devuelta = $_POST['devuelta'];
		$modo_pago = $_POST['modo_pago'];

		
		// Cadena de conexión al Servidor
		if (!($cn = mysql_connect($this->localhost, $this->user,$this->password))) 
		 	die("Error en la conexión");	 

		// Conectar a la Dase de Datos
		if(!mysql_select_db($this->db,$cn))
			die("Error en la conexión a la bd"); 		

		// Consulta a la base de datos
		$insert = mysql_query("INSERT INTO pagos () VALUE(null,'$id_cliente','$id_factura', '$monto_pagado', '$monto_suministrado',
														  '$devuelta', '$modo_pago')", $cn);


		if(!$insert)
			die("Error en la consulta");
		
		echo "Pago realizado con èxito";
			
		// Cierra la conexión con la base de datos 
		 mysql_close($cn); 

		
	}

	

}

?>