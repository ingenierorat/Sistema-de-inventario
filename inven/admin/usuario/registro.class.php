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
	$id_tipo_usuario = $_POST['id_tipo_usuario'];
	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$usuario = $_POST['usuario'];
	$clave = $_POST['clave'];	
	$fecha_ingreso = $_POST['fecha_ingreso'];
	



	// Validar cada una de las variables enviadas al servidor
	if (isset($codigo) && !empty($codigo) && isset($id_tipo_usuario) && !empty($id_tipo_usuario) && isset($nombre) && !empty($nombre) &&
		 isset($apellidos) && !empty($apellidos) && isset($usuario) && !empty($usuario) && isset($clave) && !empty($clave) &&
		 isset($fecha_ingreso) && !empty($fecha_ingreso)){

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
	$id_tipo_usuario = $_POST['id_tipo_usuario'];
	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$usuario = $_POST['usuario'];
	$clave = $_POST['clave'];	
	$fecha_ingreso = $_POST['fecha_ingreso'];
	

	// Validar cada una de las variables enviadas al servidor
	if (isset($codigo) && !empty($codigo) && isset($id_tipo_usuario) && !empty($id_tipo_usuario) && isset($nombre) && !empty($nombre) &&
		 isset($apellidos) && !empty($apellidos) && isset($usuario) && !empty($usuario) && isset($clave) && !empty($clave) &&
		 isset($fecha_ingreso) && !empty($fecha_ingreso)){


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
		$id_tipo_usuario = $_POST['id_tipo_usuario'];
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];
		$usuario = $_POST['usuario'];
		$clave = $_POST['clave'];	
		$fecha_ingreso = $_POST['fecha_ingreso'];
				
		// Cadena de conexión al Servidor
		if (!($cn = mysql_connect($this->localhost, $this->user,$this->password))) 
		 	die("ERROR, no se puede conextar al servidor");	 		 


		// Conectar a la Dase de Datos
		if(!mysql_select_db($this->db, $cn))
			die("ERROR, no se puede conectar a la base de datos");	


		// Insertar registro a la base de datos
		$insert = mysql_query("INSERT INTO usuarios () VALUES ('$codigo', '$id_tipo_usuario','$nombre','$apellidos','$usuario',
															   '$clave', '$fecha_ingreso')", $cn);

		
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
		$id_tipo_usuario = $_POST['id_tipo_usuario'];
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];
		$usuario = $_POST['usuario'];
		$clave = $_POST['clave'];	
		$fecha_ingreso = $_POST['fecha_ingreso'];
			
		// Cadena de conexión al Servidor
		if (!($cn = mysql_connect($this->localhost, $this->user,$this->password))) 
		 	die("ERROR, no se puede conextar al servidor");	 		 


		// Conectar a la Dase de Datos
		if(!mysql_select_db($this->db, $cn))
			die("ERROR, no se puede conectar a la base de datos");	


		// Actualizar registro a la base de datos
		$update = mysql_query("UPDATE  usuarios SET id_tipo_usuario='".$id_tipo_usuario."',nombre='".$nombre."',apellidos='".$apellidos."',
		                      usuario='".$usuario."',clave='".$clave."',fecha_ingreso='".$fecha_ingreso."' WHERE id_usuario= '".$codigo."' ", $cn);
		
		
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