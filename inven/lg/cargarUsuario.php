<?php

/*Reportar cualquier error encontrado en la depuración de este código*/
error_reporting(E_ALL);
ini_set('display_errors', '1');

/*Iniciar la sessión para guaradar en ella las varibles de ususario*/
session_start();

/*Incluir el archivo de conexión a este módulo */
require_once('../libreria/db_conexion.php');

/*Variable que se espera que lleguen desde el cliente*/
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$tipo = $_POST['tipo'];

if (isset($usuario) && !empty($usuario) && isset($clave) && !empty($clave) && isset($tipo) && !empty($tipo)) {

	/*Definir consulta a la db textual*/
	$query = "SELECT * FROM usuarios where usuario = '".$usuario."' && clave='".$clave."' && id_tipo_usuario='".$tipo."'";
	/*Realizar la consulta a la db*/
	$query_db = mysqli_query($cn,$query);

	/*Validar que la consulta no tenga errores de sintaxis*/
	if (!$query_db)
		die("Error en la consulta, favor revisarla");

		/*Preguntar si trajo datos la consulta*/
		if(mysqli_num_rows($query_db) > 0) 
		{

			/*Crear un array de datos*/
			$datos[] = array();

			/*Recorre el resultado del query_db*/
			while ($fila = mysqli_fetch_array($query_db)) {

				/*Agregar al array la fila encontrada*/
				$datos[] = $fila;

				/*Crear las variables de sessión correspondientes*/
				$_SESSION["usuario"] = $fila["usuario"];
				$_SESSION["nombre"] = $fila["nombre"];
				$_SESSION["apellidos"] = $fila["apellidos"];
				$_SESSION["id_tipo_usuario"] = $fila["id_tipo_usuario"];

			}

			/*Enviarle un objeto Json con los datos obtenido al cliente*/
			echo json_encode($datos);


		}

		/*Liberar la memoria de la consulta*/
		mysqli_free_result($query_db);

		/*Cierra la conexión al servidor*/
		 mysqli_close($cn);

}


?>