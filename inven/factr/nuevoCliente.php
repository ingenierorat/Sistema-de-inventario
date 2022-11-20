<?php 

// Variable para capturar los datos enviados
$id_cliente = $_POST['id_cliente'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$mail = $_POST['mail'];
$direccion = $_POST['direccion'];
$cedula = $_POST['cedula'];
$sexo = $_POST['sexo'];
$fecha_ingreso = $_POST['fecha_ingreso'];

  

// Validar cada una de las variables enviadas al servidor
if (isset($id_cliente) &&  !empty($id_cliente) && 
	isset($nombre) && !empty($nombre) &&
	isset($apellidos) &&  !empty($apellidos) &&  
	isset($telefono) &&    !empty($telefono) && 
	isset($mail) &&      !empty($mail) &&                                                                                  
	isset($direccion) &&     !empty($direccion) &&
	isset($cedula) &&     !empty($cedula) &&
	isset($sexo) &&     !empty($sexo) &&
	isset($fecha_ingreso) &&     !empty($fecha_ingreso)
	
	){  

	
 	// Instanciar el objeto
	$miConsulta = new Consulta(); 
	// Inserta item en la bd 
	$miConsulta->nuevoCliente();
		

	
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


	function nuevoCliente(){

		// Variable para capturar el nombre a buscar
		$id_cliente = $_POST['id_cliente'];
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];
		$telefono = $_POST['telefono'];
		$mail = $_POST['mail'];
		$direccion = $_POST['direccion'];
		$cedula = $_POST['cedula'];
		$sexo = $_POST['sexo'];
		$fecha_ingreso = $_POST['fecha_ingreso'];

		
		// Cadena de conexión al Servidor
		if (!($cn = mysql_connect($this->localhost, $this->user,$this->password))) 
		 	die("Error en la conexión");	 

		// Conectar a la Dase de Datos
		if(!mysql_select_db($this->db,$cn))
			die("Error en la conexión a la bd"); 		

		// Consulta a la base de datos
		$insert = mysql_query("INSERT INTO clientes () VALUE('$id_cliente','$nombre','$apellidos','$telefono','$mail',
															 '$direccion','$cedula','$sexo','$fecha_ingreso')", $cn);

		if(!$insert)
			die("Error en la consulta");


		echo "Cliente insertado correctamente";
		
			
		// Cierra la conexión con la base de datos 
		 mysql_close($cn); 

		
	}

	
}

?>