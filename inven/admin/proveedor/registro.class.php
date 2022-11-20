<?php 

// Validar cada una de las variables enviadas al servidor
if (isset($_POST['nuevo']) && !empty($_POST['nuevo']) or isset($_POST['editar']) && !empty($_POST['editar'])) {

	// Comprobar la igualdad de cada variable enviada
	if (isset($_POST['nuevo']) == "nuevo") {
		
		// Función que evalua cada campo enviado
		registroValidarNuevo();		
		
	}elseif (isset($_POST['editar']) == "editar") {

		// Función que evalua cada campo enviado
		registroValidarEdicion();		

	}else{
		echo "Parametros evaluados incorrectos";
	}





	
}else{
	echo "ERROR, verifica los parametros enviados";
}




// Validar campos de cada petición del usuario
function registroValidarNuevo(){

	$codigo = $_POST['codigo'];
	$id_empresa = $_POST['id_empresa'];
	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$telefono = $_POST['telefono'];
	$mail = $_POST['mail'];
	$cedula = $_POST['cedula'];
	$sexo = $_POST['sexo'];		
	$fecha_ingreso = $_POST['fecha_ingreso'];
	



	// Validar cada una de las variables enviadas al servidor
	if (isset($codigo) && !empty($codigo) && isset($id_empresa) && !empty($id_empresa) && isset($nombre) && !empty($nombre) &&
		 isset($apellidos) && !empty($apellidos) && isset($telefono) && !empty($telefono) && isset($mail) && !empty($mail) &&
		 isset($cedula) && !empty($cedula) && isset($sexo) && !empty($sexo) && isset($fecha_ingreso) && !empty($fecha_ingreso)){

		// Instanciar un objeto registro
		$registro = new Registro();
		// Llamar uno de sus métodos
		$registro->registroNuevo();
		

			
	}else{
		echo "Error, los campos no pueden estar vacios";
	}

}

function registroValidarEdicion(){	

	$codigo = $_POST['codigo'];
	$id_empresa = $_POST['id_empresa'];
	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$telefono = $_POST['telefono'];
	$mail = $_POST['mail'];
	$cedula = $_POST['cedula'];
	$sexo = $_POST['sexo'];		
	$fecha_ingreso = $_POST['fecha_ingreso'];
	

	// Validar cada una de las variables enviadas al servidor
	if (isset($codigo) && !empty($codigo) && isset($id_empresa) && !empty($id_empresa) && isset($nombre) && !empty($nombre) &&
		 isset($apellidos) && !empty($apellidos) && isset($telefono) && !empty($telefono) && isset($mail) && !empty($mail) && 
		 isset($cedula) && !empty($cedula) && isset($sexo) && !empty($sexo) && isset($fecha_ingreso) && !empty($fecha_ingreso)){


		// Instanciar un objeto registro
		$registro = new Registro();
		// Llamar uno de sus métodos
		$registro->registroEditar();
		

			
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
		
		$codigo = $_POST['codigo'];
		$id_empresa = $_POST['id_empresa'];
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];
		$telefono = $_POST['telefono'];
		$mail = $_POST['mail'];
		$cedula = $_POST['cedula'];
		$sexo = $_POST['sexo'];	
		$fecha_ingreso = $_POST['fecha_ingreso'];
				
		// Cadena de conexión al Servidor
		if (!($cn = mysql_connect($this->localhost, $this->user,$this->password))) 
		 	die("ERROR, no se puede conextar al servidor");	 		 


		// Conectar a la Dase de Datos
		if(!mysql_select_db($this->db, $cn))
			die("ERROR, no se puede conectar a la base de datos");	


		// Insertar registro a la base de datos
		$insert = mysql_query("INSERT INTO proveedores () VALUES ('$codigo', '$id_empresa','$nombre','$apellidos','$telefono',
															   '$mail', '$cedula', '$sexo', '$fecha_ingreso')", $cn);

		
		// Preguntar se fue correcta la insercción de datos
		if(!$insert)
			die("Error de insercción");	

		// Si el registro se inserta correctamente lanza este mensaje
		echo "si";			
		

		 // Cierra la conexión con la base de datos 
		  mysql_close($cn); 
		
			

	}


	function registroEditar(){

		$codigo = $_POST['codigo'];
		$id_empresa = $_POST['id_empresa'];
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];
		$telefono = $_POST['telefono'];
		$mail = $_POST['mail'];
		$cedula = $_POST['cedula'];
		$sexo = $_POST['sexo'];	
		$fecha_ingreso = $_POST['fecha_ingreso'];
			
		// Cadena de conexión al Servidor
		if (!($cn = mysql_connect($this->localhost, $this->user,$this->password))) 
		 	die("ERROR, no se puede conextar al servidor");	 		 


		// Conectar a la Dase de Datos
		if(!mysql_select_db($this->db, $cn))
			die("ERROR, no se puede conectar a la base de datos");	


		// Actualizar registro a la base de datos
		$update = mysql_query("UPDATE  proveedores SET id_empresa='".$id_empresa."',nombre='".$nombre."',apellidos='".$apellidos."',
		                      telefono='".$telefono."',mail='".$mail."', cedula='".$cedula."',
		                      sexo='".$sexo."', fecha_ingreso='".$fecha_ingreso."' WHERE id_proveedor= '".$codigo."' ", $cn);
		
		
		// Preguntar se fue correcta la insercción de datos
		if(!$update)
			die("Error de actualización");	

		// Si el registro se inserta correctamente lanza este mensaje
		echo "si";			
		
		 // Cierra la conexión con la base de datos 
		  mysql_close($cn); 

			
	}

	



}

?>