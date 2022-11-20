<?php


// Validar cada una de las variables enviadas al servidor
if (isset($_POST['id']) && !empty($_POST['id']) or isset($_POST['nombre']) && !empty($_POST['nombre']) or isset($_POST['limite'])) {

	// Comprobar la igualdad de cada variable enviada
	if (isset($_POST['id']) == "id") {

		$miConsulta = new Consulta();
	    $miConsulta->consultarCodigo();
		
	}elseif (isset($_POST['nombre']) == "nombre") {

		$miConsulta = new Consulta();
	    $miConsulta->consultarNombre();

	}elseif (isset($_POST['limite']) == "limite") {

		$miConsulta = new Consulta();
	    $miConsulta->consultarTodo();
		
	} 

	else{
		echo "Las variables no coinciden";
	}



	
}else{
	echo "Error, verifica los parametros enviados";
}



class Consulta{

	// Constructor de la clase
	function __construct(){	

	}


	function consultarCodigo(){

		/*Incluir el archivo de conexión a este módulo */
		require_once('../libreria/db_conexion.php');
		
		// Codigo para ser buscado en la bd
		$id = $_POST['id'];	

		// Consulta a la base de datos
		$query = "SELECT * FROM usuarios WHERE id_usuario ='".$id."'";

		/*Realizar la consulta a la db*/
		$query_db = mysqli_query($cn,$query);

		if(!$query_db)
			die("Error en la consulta a Base de Datos");


		// Validar si la consulta trajo resultados
		if (mysqli_num_rows($query_db) > 0){
			
			echo '<table id="tablaUs">';					
			echo '<tr>';
			echo '<th><input type="text" name="codigo" id="codigo" value="Código" readonly /></th>';			
			echo '<th><input type="text" name="id_tipo_usuario" id="id_tipo_usuario" value="Tipo Usua" readonly /></th>';			
			echo '<th><input type="text" name="nombre" id="nombre" value="Nombre" readonly /></th>';
			echo '<th><input type="text" name="apellidos" id="apellidos" value="Apellidos" readonly /></th>';
			echo '<th><input type="text" name="usuario" id="usuario" value="Usuario" readonly /></th>';
			echo '<th><input type="text" name="clave" id="clave" value="Clave" readonly /></th>';						
			echo '<th><input type="text" name="fecha_ingreso" id="fecha_ingreso" value="Fecha" readonly /></th>';									
			echo '</tr>';

		
			while ($fila = mysqli_fetch_array($query_db)) {

				echo '<tr>'; 
			    echo '<td><input type="text" name="dcodigo" id="dcodigo" value="'.$fila['id_usuario'].'" readonly /></td>';			    
			    echo '<td><input type="text" name="did_tipo_usuario" id="did_tipo_usuario" value="'.$fila['id_tipo_usuario'].'" readonly /></td>';			    
			    echo '<td><input type="text" name="dnombre" id="dnombre" value="'.$fila['nombre'].'" readonly /></td>';
			    echo '<td><input type="text" name="dapellidos" id="dapellidos" value="'.$fila['apellidos'].'" readonly /></td>';
			    echo '<td><input type="text" name="dusuario" id="dusuario" value="'.$fila['usuario'].'" readonly /></td>';
			    echo '<td><input type="text" name="dclave" id="dclave" value="'.$fila['clave'].'" readonly /></td>';			    
			    echo '<td><input type="text" name="dfecha_ingreso" id="dfecha_ingreso" value="'.$fila['fecha_ingreso'].'" readonly /></td>';
			    echo '</tr>'; 	
			}

			echo '</table>';


			// Libera la memoria del resultado
			  mysqli_free_result($query_db);

			 // Cierra la conexión con la base de datos 
			  mysqli_close($cn); 


		}else{
			echo -1;
		}			


	}


	function consultarNombre(){

		/*Incluir el archivo de conexión a este módulo */
		require_once('../libreria/db_conexion.php');

		// Variable para capturar el nombre a buscar
		$nombre = $_POST['nombre'];			

		// Consulta a la base de datos
		$query ="SELECT * FROM usuarios WHERE nombre LIKE '".$nombre."%'";

		$query_db = mysqli_query($cn,$query);

		if(!$query_db)
			die("Error en la consulta sql");

		// Validar si la consulta trajo resultados
		if (mysqli_num_rows($query_db) > 0){

			echo '<table id="tablaUs">';					
			echo '<tr>';
			echo '<th><input type="text" name="codigo" id="codigo" value="Código" readonly /></th>';			
			echo '<th><input type="text" name="id_tipo_usuario" id="id_tipo_usuario" value="Tipo Usua" readonly /></th>';			
			echo '<th><input type="text" name="nombre" id="nombre" value="Nombre" readonly /></th>';
			echo '<th><input type="text" name="apellidos" id="apellidos" value="Apellidos" readonly /></th>';
			echo '<th><input type="text" name="usuario" id="usuario" value="Usuario" readonly /></th>';
			echo '<th><input type="text" name="clave" id="clave" value="Clave" readonly /></th>';						
			echo '<th><input type="text" name="fecha_ingreso" id="fecha_ingreso" value="Fecha" readonly /></th>';									
			echo '</tr>';

		
			while ($fila = mysqli_fetch_array($query_db)) {

				echo '<tr>'; 
			    echo '<td><input type="text" name="dcodigo" id="dcodigo" value="'.$fila['id_usuario'].'" readonly /></td>';			    
			    echo '<td><input type="text" name="did_tipo_usuario" id="did_tipo_usuario" value="'.$fila['id_tipo_usuario'].'" readonly /></td>';			    
			    echo '<td><input type="text" name="dnombre" id="dnombre" value="'.$fila['nombre'].'" readonly /></td>';
			    echo '<td><input type="text" name="dapellidos" id="dapellidos" value="'.$fila['apellidos'].'" readonly /></td>';
			    echo '<td><input type="text" name="dusuario" id="dusuario" value="'.$fila['usuario'].'" readonly /></td>';
			    echo '<td><input type="text" name="dclave" id="dclave" value="'.$fila['clave'].'" readonly /></td>';			    
			    echo '<td><input type="text" name="dfecha_ingreso" id="dfecha_ingreso" value="'.$fila['fecha_ingreso'].'" readonly /></td>';
			    echo '</tr>'; 	
			}
			echo '</table>';

			// Libera la memoria del resultado
			  mysqli_free_result($query_db);

			 // Cierra la conexión con la base de datos 
			  mysqli_close($cn); 


		}else{
			echo -1;
		}	

		
	}

	function consultarTodo(){

		/*Incluir el archivo de conexión a este módulo */
		require_once('../libreria/db_conexion.php');

		// Variable que contendra la cantidad de registros a consultar
		$limite = $_POST['limite'];

		// Primera consulta a la tabla Usuarios
		$query = "SELECT * FROM usuarios limit $limite, 18";
		$query_db = mysqli_query($cn,$query);

		// Saber cuento registros tiene la tabla Usuarios
		$reg = "SELECT * FROM usuarios";
		$query_total_rows = mysqli_query($cn,$reg);
		$totalReg = mysqli_num_rows($query_total_rows);	

		// Calcular las paginas totales
		$paginas = ceil ($totalReg/18);
		

		// Validar si la consulta trajo resultados
		if (mysqli_fetch_array($query_db) > 0){

			echo '<table id="tablaUs">';					
			echo '<tr>';
			echo '<th><input type="text" name="codigo" id="codigo" value="Código" readonly /></th>';			
			echo '<th><input type="text" name="id_tipo_usuario" id="id_tipo_usuario" value="Tipo Usua" readonly /></th>';			
			echo '<th><input type="text" name="nombre" id="nombre" value="Nombre" readonly /></th>';
			echo '<th><input type="text" name="apellidos" id="apellidos" value="Apellidos" readonly /></th>';
			echo '<th><input type="text" name="usuario" id="usuario" value="Usuario" readonly /></th>';
			echo '<th><input type="text" name="clave" id="clave" value="Clave" readonly /></th>';						
			echo '<th><input type="text" name="fecha_ingreso" id="fecha_ingreso" value="Fecha" readonly /></th>';									
			echo '</tr>';
		
			while ($fila = mysqli_fetch_array($query_db)) {

				echo '<tr>'; 
			    echo '<td><input type="text" name="dcodigo" id="dcodigo" value="'.$fila['id_usuario'].'" readonly /></td>';			    
			    echo '<td><input type="text" name="did_tipo_usuario" id="did_tipo_usuario" value="'.$fila['id_tipo_usuario'].'" readonly /></td>';			    
			    echo '<td><input type="text" name="dnombre" id="dnombre" value="'.$fila['nombre'].'" readonly /></td>';
			    echo '<td><input type="text" name="dapellidos" id="dapellidos" value="'.$fila['apellidos'].'" readonly /></td>';
			    echo '<td><input type="text" name="dusuario" id="dusuario" value="'.$fila['usuario'].'" readonly /></td>';
			    echo '<td><input type="text" name="dclave" id="dclave" value="'.$fila['clave'].'" readonly /></td>';			    
			    echo '<td><input type="text" name="dfecha_ingreso" id="dfecha_ingreso" value="'.$fila['fecha_ingreso'].'" readonly /></td>';
			    echo '</tr>'; 	
			}

			echo '</table>';	

			// Cálculo para navegar en los registros de la tabla
			if ($limite > 0) {	
				
				$limit = $limite -18;
				echo '<div id="anterior" onclick= "buscarTodo('.$limit.')"><span class="flecha_anterior"></span>Anterior</div>';
										
			}

			if($limite < $totalReg -18){
				
				$limit = $limite + 18;
				echo '<div id="siguiente" onclick="buscarTodo('.$limit.')">Siguiente<span class="flecha_siguiente"></span></div>';			

			}

		}

		mysqli_free_result($query_db);
		mysqli_close($cn);

	}


}

?>