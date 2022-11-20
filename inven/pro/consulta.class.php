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
		$query = "SELECT * FROM productos WHERE id_producto ='".$id."'";
		$query_db = mysqli_query($cn,$query);


		if(!$query_db)
			die("Error en la consulta a Base de Datos");

		// Validar si la consulta trajo resultados
		if (mysqli_num_rows($query_db) > 0){
			
			echo '<table id="tablaPro">';					
			echo '<tr>';
			echo '<th><input type="text" name="codigo" id="codigo" value="Código" readonly /></th>';
			echo '<th><input type="text" name="id_categoria" id="id_categoria" value="Cat" readonly /></th>';
			echo '<th><input type="text" name="id_empresa" id="id_empresa" value="Emp" readonly /></th>';
			echo '<th><input type="text" name="codigo_barra" id="codigo_barra" value="Código Barra" readonly /></th>';
			echo '<th><input type="text" name="nombre" id="nombre" value="Nombre" readonly /></th>';
			echo '<th><input type="text" name="descripcion" id="descripcion" value="Descripción" readonly /></th>';
			echo '<th><input type="text" name="precio_ingreso" id="precio_ingreso" value="Prec Ing" readonly /></th>';
			echo '<th><input type="text" name="porciento_venta" id="porciento_venta" value="% Ven." readonly /></th>';
			echo '<th><input type="text" name="itebis" id="itebis" value="Itebis" readonly /></th>';
			echo '<th><input type="text" name="precio_venta" id="precio_venta" value="Precio" readonly /></th>';
			echo '<th><input type="text" name="disponibilidad_min" id="disponibilidad_min" value="Disp Min" readonly /></th>';
			echo '<th><input type="text" name="disponibilidad" id="disponibilidad" value="Stock" readonly /></th>';
			echo '<th><input type="text" name="fecha_ingreso" id="fecha_ingreso" value="Fecha" readonly /></th>';									
			echo '</tr>';

		
			while ($fila = mysqli_fetch_array($query_db)) {

				echo '<tr>'; 
			    echo '<td><input type="text" name="dcodigo" id="dcodigo" value="'.$fila['id_producto'].'" readonly /></td>';
			    echo '<td><input type="text" name="did_categoria" id="did_categoria" value="'.$fila['id_categoria'].'" readonly /></td>';
			    echo '<td><input type="text" name="did_empresa" id="did_empresa" value="'.$fila['id_empresa'].'" readonly /></td>';
			    echo '<td><input type="text" name="codigo_barra" id="codigo_barra" value="'.$fila['codigo_barra'].'" readonly /></td>';
			    echo '<td><input type="text" name="dnombre" id="dnombre" value="'.$fila['nombre'].'" readonly /></td>';
			    echo '<td><input type="text" name="ddescripcion" id="ddescripcion" value="'.$fila['descripcion'].'" readonly /></td>';
			    echo '<td><input type="text" name="dprecio_ingreso" id="dprecio_ingreso" value="'.$fila['precio_ingreso'].'" readonly /></td>';
			    echo '<td><input type="text" name="dporciento_venta" id="dporciento_venta" value="'.$fila['porciento_venta'].'" readonly /></td>';
			    echo '<td><input type="text" name="ditebis" id="ditebis" value="'.$fila['itebis'].'" readonly /></td>';
			    echo '<td><input type="text" name="dprecio_venta" id="dprecio_venta" value="'.$fila['precio_venta'].'" readonly /></td>';
			    echo '<td><input type="text" name="ddisponibilidad_min" id="ddisponibilidad_min" value="'.$fila['disponibilidad_min'].'" readonly /></td>';
			    echo '<td><input type="text" name="ddisponibilidad" id="ddisponibilidad" value="'.$fila['disponibilidad'].'" readonly /></td>';
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
		$query = "SELECT * FROM productos WHERE nombre LIKE '".$nombre."%'";
		$query_db = mysqli_query($cn,$query);

		if(!$query_db)
			die("Error en la consulta a Base de Datos");

		// Validar si la consulta trajo resultados
		if (mysqli_num_rows($query_db) > 0){

			echo '<table id="tablaPro">';					
			echo '<tr>';
			echo '<th><input type="text" name="codigo" id="codigo" value="Código" readonly /></th>';
			echo '<th><input type="text" name="id_categoria" id="id_categoria" value="Cat" readonly /></th>';
			echo '<th><input type="text" name="id_empresa" id="id_empresa" value="Emp" readonly /></th>';
			echo '<th><input type="text" name="codigo_barra" id="codigo_barra" value="Código Barra" readonly /></th>';
			echo '<th><input type="text" name="nombre" id="nombre" value="Nombre" readonly /></th>';
			echo '<th><input type="text" name="descripcion" id="descripcion" value="Descripción" readonly /></th>';
			echo '<th><input type="text" name="precio_ingreso" id="precio_ingreso" value="Prec Ing" readonly /></th>';
			echo '<th><input type="text" name="porciento_venta" id="porciento_venta" value="% Ven." readonly /></th>';
			echo '<th><input type="text" name="itebis" id="itebis" value="Itebis" readonly /></th>';
			echo '<th><input type="text" name="precio_venta" id="precio_venta" value="Precio" readonly /></th>';
			echo '<th><input type="text" name="disponibilidad_min" id="disponibilidad_min" value="Disp Min" readonly /></th>';
			echo '<th><input type="text" name="disponibilidad" id="disponibilidad" value="Stock" readonly /></th>';
			echo '<th><input type="text" name="fecha_ingreso" id="fecha_ingreso" value="Fecha" readonly /></th>';									
			echo '</tr>';
		
			while ($fila = mysqli_fetch_array($query_db)){

				echo '<tr>'; 
			    echo '<td><input type="text" name="dcodigo" id="dcodigo" value="'.$fila['id_producto'].'" readonly /></td>';
			    echo '<td><input type="text" name="did_categoria" id="did_categoria" value="'.$fila['id_categoria'].'" readonly /></td>';
			    echo '<td><input type="text" name="did_empresa" id="did_empresa" value="'.$fila['id_empresa'].'" readonly /></td>';
			    echo '<td><input type="text" name="codigo_barra" id="codigo_barra" value="'.$fila['codigo_barra'].'" readonly /></td>';
			    echo '<td><input type="text" name="dnombre" id="dnombre" value="'.$fila['nombre'].'" readonly /></td>';
			    echo '<td><input type="text" name="ddescripcion" id="ddescripcion" value="'.$fila['descripcion'].'" readonly /></td>';
			    echo '<td><input type="text" name="dprecio_ingreso" id="dprecio_ingreso" value="'.$fila['precio_ingreso'].'" readonly /></td>';
			    echo '<td><input type="text" name="dporciento_venta" id="dporciento_venta" value="'.$fila['porciento_venta'].'" readonly /></td>';
			    echo '<td><input type="text" name="ditebis" id="ditebis" value="'.$fila['itebis'].'" readonly /></td>';
			    echo '<td><input type="text" name="dprecio_venta" id="dprecio_venta" value="'.$fila['precio_venta'].'" readonly /></td>';
			    echo '<td><input type="text" name="ddisponibilidad_min" id="ddisponibilidad_min" value="'.$fila['disponibilidad_min'].'" readonly /></td>';
			    echo '<td><input type="text" name="ddisponibilidad" id="ddisponibilidad" value="'.$fila['disponibilidad'].'" readonly /></td>';
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

		// Primera consulta a la tabla Pro
		$query = "SELECT * FROM productos limit $limite, 18";
		$query_db = mysqli_query($cn,$query);

		// Saber cuento registros tiene la tabla Pro
		$reg = "SELECT * FROM productos";
		$query_total_rows = mysqli_query($cn,$reg);
		$totalReg = mysqli_num_rows($query_total_rows);		

		if(!$query_db)
			die("Error en la consulta sql");

		// Calcular las paginas totales
		$paginas = ceil ($totalReg/18);
		

		// Validar si la consulta trajo resultados
		if (mysqli_num_rows($query_db) > 0){

			echo '<table id="tablaPro">';					
			echo '<tr>';
			echo '<th><input type="text" name="codigo" id="codigo" value="Código" readonly /></th>';
			echo '<th><input type="text" name="id_categoria" id="id_categoria" value="Cat" readonly /></th>';
			echo '<th><input type="text" name="id_empresa" id="id_empresa" value="Emp" readonly /></th>';
			echo '<th><input type="text" name="codigo_barra" id="codigo_barra" value="Código Barra" readonly /></th>';
			echo '<th><input type="text" name="nombre" id="nombre" value="Nombre" readonly /></th>';
			echo '<th><input type="text" name="descripcion" id="descripcion" value="Descripción" readonly /></th>';
			echo '<th><input type="text" name="precio_ingreso" id="precio_ingreso" value="Prec Ing" readonly /></th>';
			echo '<th><input type="text" name="porciento_venta" id="porciento_venta" value="% Ven." readonly /></th>';
			echo '<th><input type="text" name="itebis" id="itebis" value="Itebis" readonly /></th>';
			echo '<th><input type="text" name="precio_venta" id="precio_venta" value="Precio" readonly /></th>';
			echo '<th><input type="text" name="disponibilidad_min" id="disponibilidad_min" value="Disp Min" readonly /></th>';
			echo '<th><input type="text" name="disponibilidad" id="disponibilidad" value="Stock" readonly /></th>';
			echo '<th><input type="text" name="fecha_ingreso" id="fecha_ingreso" value="Fecha" readonly /></th>';									
			echo '</tr>';
		
			while ($fila = mysqli_fetch_array($query_db)){

				echo '<tr>'; 
			    echo '<td><input type="text" name="dcodigo" id="dcodigo" value="'.$fila['id_producto'].'" readonly /></td>';
			    echo '<td><input type="text" name="did_categoria" id="did_categoria" value="'.$fila['id_categoria'].'" readonly /></td>';
			    echo '<td><input type="text" name="did_empresa" id="did_empresa" value="'.$fila['id_empresa'].'" readonly /></td>';
			    echo '<td><input type="text" name="codigo_barra" id="codigo_barra" value="'.$fila['codigo_barra'].'" readonly /></td>';
			    echo '<td><input type="text" name="dnombre" id="dnombre" value="'.$fila['nombre'].'" readonly /></td>';
			    echo '<td><input type="text" name="ddescripcion" id="ddescripcion" value="'.$fila['descripcion'].'" readonly /></td>';
			    echo '<td><input type="text" name="dprecio_ingreso" id="dprecio_ingreso" value="'.$fila['precio_ingreso'].'" readonly /></td>';
			    echo '<td><input type="text" name="dporciento_venta" id="dporciento_venta" value="'.$fila['porciento_venta'].'" readonly /></td>';
			    echo '<td><input type="text" name="ditebis" id="ditebis" value="'.$fila['itebis'].'" readonly /></td>';
			    echo '<td><input type="text" name="dprecio_venta" id="dprecio_venta" value="'.$fila['precio_venta'].'" readonly /></td>';
			    echo '<td><input type="text" name="ddisponibilidad_min" id="ddisponibilidad_min" value="'.$fila['disponibilidad_min'].'" readonly /></td>';
			    echo '<td><input type="text" name="ddisponibilidad" id="ddisponibilidad" value="'.$fila['disponibilidad'].'" readonly /></td>';
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

		// Limpiar y cerrar la conexión
		mysqli_free_result($query_db);
		mysqli_close($cn);

	}

}

?>