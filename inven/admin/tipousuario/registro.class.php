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
	$descripcion = $_POST['descripcion'];


	// Validar cada una de las variables enviadas al servidor
	if (isset($codigo) && !empty($codigo) && isset($descripcion) && !empty($descripcion)){

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
	$descripcion = $_POST['descripcion'];


	// Validar cada una de las variables enviadas al servidor
	if (isset($codigo) && !empty($codigo) && isset($descripcion) && !empty($descripcion)){


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
		$descripcion = $_POST['descripcion'];
		
					
		// Cadena de conexión al Servidor
		if (!($cn = mysql_connect($this->localhost, $this->user,$this->password))) 
		 	die("ERROR, no se puede conextar al servidor");	 		 


		// Conectar a la Dase de Datos
		if(!mysql_select_db($this->db, $cn))
			die("ERROR, no se puede conectar a la base de datos");	


		// Insertar registro a la base de datos
		$insert = mysql_query("INSERT INTO tipo_usuarios () VALUES ('$codigo', '$descripcion')", $cn);

		
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
		$descripcion = $_POST['descripcion'];
		
				
		// Cadena de conexión al Servidor
		if (!($cn = mysql_connect($this->localhost, $this->user,$this->password))) 
		 	die("ERROR, no se puede conextar al servidor");	 		 


		// Conectar a la Dase de Datos
		if(!mysql_select_db($this->db, $cn))
			die("ERROR, no se puede conectar a la base de datos");	


		// Actualizar registro a la base de datos
		$update = mysql_query("UPDATE  tipo_usuarios SET descripcion='".$descripcion."' WHERE id_tipo_usuario = '".$codigo."' ", $cn);
		
		
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