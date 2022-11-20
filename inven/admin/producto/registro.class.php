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

	$no = $_POST['no'];
	$categoria = $_POST['categoria'];
	$empresa = $_POST['empresa'];
	$codigo = $_POST['codigo'];
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$precio_ingreso = $_POST['precio_ingreso'];
	$porciento_venta = $_POST['porciento_venta'];
	$itebis = $_POST['itebis'];
	$precio_venta = $_POST['precio_venta'];
	$disponibilidad_min = $_POST['disponibilidad_min'];
	$disponibilidad = $_POST['disponibilidad'];
	$fecha_ingreso = $_POST['fecha_ingreso'];
	



	// Validar cada una de las variables enviadas al servidor
	if (isset($no) && !empty($no)  && isset($categoria) && !empty($categoria) && isset($empresa) && !empty($empresa) &&
		isset($codigo) && !empty($codigo) && isset($nombre) && !empty($nombre) && isset($descripcion) && !empty($descripcion) && 
		isset($precio_ingreso) && !empty($precio_ingreso) && isset($porciento_venta) && !empty($porciento_venta) &&
		isset($itebis) && isset($itebis) && isset($precio_venta) && !empty($precio_venta) && isset($disponibilidad_min) && !empty($disponibilidad_min) &&
		isset($disponibilidad) && !empty($disponibilidad) && isset($fecha_ingreso) && !empty($fecha_ingreso)){

		// Instanciar un objeto registro
		$registro = new Registro();
		// Llamar uno de sus métodos
		$registro->registroNuevo();
		

			
	}else{
		echo "Error, los campos no pueden estar vacios";
	}

}

function registroValidarEdicion(){	

	$no = $_POST['no'];
	$categoria = $_POST['categoria'];
	$empresa = $_POST['empresa'];
	$codigo = $_POST['codigo'];
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$precio_ingreso = $_POST['precio_ingreso'];
	$porciento_venta = $_POST['porciento_venta'];
	$itebis = $_POST['itebis'];
	$precio_venta = $_POST['precio_venta'];
	$disponibilidad_min = $_POST['disponibilidad_min'];
	$disponibilidad = $_POST['disponibilidad'];
	$fecha_ingreso = $_POST['fecha_ingreso'];


	// Validar cada una de las variables enviadas al servidor
	if (isset($no) && !empty($no)  && isset($categoria) && !empty($categoria) && isset($empresa) && !empty($empresa) &&
		isset($codigo) && !empty($codigo) && isset($nombre) && !empty($nombre) && isset($descripcion) && !empty($descripcion) && 
		isset($precio_ingreso) && !empty($precio_ingreso) && isset($porciento_venta) && !empty($porciento_venta) &&
		isset($itebis) && isset($itebis) && isset($precio_venta) && !empty($precio_venta) && isset($disponibilidad_min) && !empty($disponibilidad_min) &&
		isset($disponibilidad) && !empty($disponibilidad) && isset($fecha_ingreso) && !empty($fecha_ingreso)){


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

	

	// Constructor de la clase
	function __construct(){
		
	}

	// Ingresa registro nuevo al sistema
	function registroNuevo(){
		
		/*Incluir el archivo de conexión a este módulo */
	    requireonce('../libreria/db_conexion.php');

		$no = $_POST['no'];
		$categoria = $_POST['categoria'];
		$empresa = $_POST['empresa'];
		$codigo = $_POST['codigo'];
		$nombre = $_POST['nombre'];
		$descripcion = $_POST['descripcion'];
		$precio_ingreso = $_POST['precio_ingreso'];
		$porciento_venta = $_POST['porciento_venta'];
		$itebis = $_POST['itebis'];
		$precio_venta = $_POST['precio_venta'];
		$disponibilidad_min = $_POST['disponibilidad_min'];
		$disponibilidad = $_POST['disponibilidad'];
		$fecha_ingreso = $_POST['fecha_ingreso'];	


		// Insertar registro a la base de datos
		$query = "INSERT INTO productos () VALUES ('$no', '$categoria', '$empresa', '$codigo','$nombre', '$descripcion', '$precio_ingreso',
																'$porciento_venta', '$itebis', '$precio_venta', '$disponibilidad_min', '$disponibilidad',
																'$fecha_ingreso')";
		$query_db = mysqli_query($cn,$query);

		
		// Preguntar se fue correcta la insercción de datos
		if(!$query_db)
			die("Error al ingresar el registro");	

		// Si el registro se inserta correctamente lanza este mensaje
		echo "si";			
		
		  
		// Libera la memoria del resultado
		 mysqli_free_result($query_db);

		// Cierra la conexión con la base de datos 
		mysqli_close($cn); 
		
			

	}


	function registroEditar(){

		$no = $_POST['no'];
		$categoria = $_POST['categoria'];
		$empresa = $_POST['empresa'];
		$codigo = $_POST['codigo'];
		$nombre = $_POST['nombre'];
		$descripcion = $_POST['descripcion'];
		$precio_ingreso = $_POST['precio_ingreso'];
		$porciento_venta = $_POST['porciento_venta'];
		$itebis = $_POST['itebis'];
		$precio_venta = $_POST['precio_venta'];
		$disponibilidad_min = $_POST['disponibilidad_min'];
		$disponibilidad = $_POST['disponibilidad'];
		$fecha_ingreso = $_POST['fecha_ingreso'];
		
		// Cadena de conexión al Servidor
		if (!($cn = mysql_connect($this->localhost, $this->user,$this->password))) 
		 	die("ERROR, no se puede conextar al servidor");	 		 


		// Conectar a la Dase de Datos
		if(!mysql_select_db($this->db, $cn))
			die("ERROR, no se puede conectar a la base de datos");	


		// Actualizar registro a la base de datos
		$update = mysql_query("UPDATE  productos SET id_categoria='".$categoria."', id_empresa='".$empresa."', nombre='".$nombre."', descripcion='".$descripcion."',
		                      precio_ingreso='".$precio_ingreso."', porciento_venta='".$porciento_venta."', itebis='".$itebis."', precio_venta='".$precio_venta."',
		                      disponibilidad_min='".$disponibilidad_min."', disponibilidad='".$disponibilidad."', fecha_ingreso='".$fecha_ingreso."' WHERE id_producto= '".$no."' ", $cn);
		
		
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