<?php


// Validar cada una de las variables enviadas al servidor
if (isset($_POST['id']) && !empty($_POST['id']) or isset($_POST['descripcion']) && !empty($_POST['descripcion']) or isset($_POST['limite'])) {

	// Comprobar la igualdad de cada variable enviada
	if (isset($_POST['id']) == "id") { 

		$miConsulta = new Consulta();
	    $miConsulta->consultarCodigo();
		
	}elseif (isset($_POST['descripcion']) == "descripcion") {

		$miConsulta = new Consulta();
	    $miConsulta->consultarDescripcion();

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
		$query = "SELECT * FROM pagos WHERE id_pago ='".$id."'";
		$query_db = mysqli_query($cn,$query);

		if(!$query_db)
			die("Error en la consulta sql");

		// Validar si la consulta trajo resultados
		if (mysqli_num_rows($query_db) > 0){
			
			echo '<table id="tablaTPag">';					
			echo '<tr>';
			echo '<th><input type="text" name="codigo" id="codigo" value="Código" readonly /></th>';			
			echo '<th><input type="text" name="descripcion" id="descripcion" value="Descripcion" readonly /></th>';													
			echo '</tr>';
		
			while ($fila = mysqli_fetch_array($query_db)) {

				echo '<tr>'; 
			    echo '<td><input type="text" name="dcodigo" id="dcodigo" value="'.$fila['id_pago'].'" readonly /></td>';			   
			    echo '<td><input type="text" name="ddescripcion" id="ddescripcion" value="'.$fila['descripcion'].'" readonly /></td>';		    
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

	function consultarDescripcion(){

		/*Incluir el archivo de conexión a este módulo */
		require_once('../libreria/db_conexion.php');

		// Variable para capturar la descripción a buscar
		$descripcion = $_POST['descripcion'];				

		// Consulta a la base de datos
		$query = "SELECT * FROM pagos WHERE descripcion LIKE '".$descripcion."%'";
		$query_db = mysqli_query($cn,$query);

		if(!$query_db)
			die("Error en la consulta sql");

		// Validar si la consulta trajo resultados
		if (mysqli_num_rows($query_db) > 0){

			echo '<table id="tablaTPag">';					
			echo '<tr>';
			echo '<th><input type="text" name="codigo" id="codigo" value="Código" readonly /></th>';			
			echo '<th><input type="text" name="descripcion" id="descripcion" value="Descripcion" readonly /></th>';													
			echo '</tr>';
		
			while ($fila = mysqli_fetch_array($query_db)) {

				echo '<tr>'; 
			    echo '<td><input type="text" name="dcodigo" id="dcodigo" value="'.$fila['id_pago'].'" readonly /></td>';			   
			    echo '<td><input type="text" name="ddescripcion" id="ddescripcion" value="'.$fila['descripcion'].'" readonly /></td>';		    
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

		// Primera consulta a la tabla Pro
		$query = "SELECT * FROM pagos limit $limite, 18";
		$query_db = mysqli_query($cn,$query);

		// Saber cuento registros tiene la tabla Pro
		$reg = "SELECT * FROM pagos";
		$query_total_rows = mysqli_query($cn,$reg);
		$totalReg = mysqli_num_rows($query_total_rows);		

		if(!$query_db)
			die("Error en la consulta sql");

		// Calcular las paginas totales
		$paginas = ceil ($totalReg/18);
		

		// Validar si la consulta trajo resultados
		if (mysqli_num_rows($query_db) > 0)
		{

			echo '<table id="tablaTPag">';					
			echo '<tr>';
			echo '<th><input type="text" name="codigo" id="codigo" value="Código" readonly /></th>';			
			echo '<th><input type="text" name="descripcion" id="descripcion" value="Descripcion" readonly /></th>';													
			echo '</tr>';

		
			while ($fila = mysqli_fetch_array($query_db)) {

				echo '<tr>'; 
			    echo '<td><input type="text" name="dcodigo" id="dcodigo" value="'.$fila['id_pago'].'" readonly /></td>';			   
			    echo '<td><input type="text" name="ddescripcion" id="ddescripcion" value="'.$fila['descripcion'].'" readonly /></td>';		    
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

		// Liberar y cerrar la conexión
		mysqli_free_result($query_db);
		mysqli_close($cn);

	}




}

?>