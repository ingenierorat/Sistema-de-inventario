<?php


// Validar la variable enviadas al servidor
if (isset($_POST['buscar']) && isset($_POST['limite'])) { 

	//Variables a utilizar
	$limite = $_POST['limite'];
	//Instanciar el Objeto
	$abastecer = new Abastecimiento();
	//Llamar a la función dia
	$abastecer->materiales($limite);

	
}elseif (isset($_POST['limite'])) {

	//Variables a utilizar
	$limite = $_POST['limite'];
	//Instanciar el Objeto
	$abastecer = new Abastecimiento();
	//Llamar a la función dia
	$abastecer->materiales($limite);

}else{
	echo "Error, verifica los parametros enviados";
}

	



class Abastecimiento{

	// Variables de conexión al servidor
	private $localhost = "localhost";
	private $user = "root";
	private $password = "2678";
	private $db = "inventario";


	// Constructor de la clase
	function __construct(){	


	}



	function materiales($limite){
		

		if (!($cn = mysql_connect($this->localhost, $this->user,$this->password))) 
	 	die("Error de conexión");	 


		// Conectar a la Dase de Datos
		if(!mysql_select_db($this->db,$cn))
			die("Error en la conexión a la bd ");	


		// Primera consulta de tipo Join la cual mostrará los datos al usuario
		$query = "select productos.id_producto, productos.codigo_barra, productos.nombre, productos.descripcion, empresas.nombre as suplidor,
                  productos.disponibilidad_min as stock_min, productos.disponibilidad as stock
                  from productos
                  inner join empresas on productos.id_empresa = empresas.id_empresa
                  where productos.disponibilidad <= productos.disponibilidad_min
				  limit $limite, 15";
		//Guardar el resultado en una variable
		$resultado = mysql_query($query, $cn);


		// Saber cuento registros tiene la consulta join
		$reg = mysql_query("select disponibilidad_min, disponibilidad
		                    from productos
                            where disponibilidad <= disponibilidad_min", $cn);

		//Calcular el total de los registros
		$totalReg = mysql_num_rows($reg);
		

		if(!$resultado)
			die("Error en la consulta sql");			
		

		// Validar si la consulta trajo resultados
		if (mysql_num_rows($resultado) > 0)
		{
			echo '<table id="tb_detalles_abst">';					
			echo '<tr>';
			echo '<th><input type="text" id="hid_producto" value="Id Producto" readonly /></th>';
			echo '<th><input type="text" id="hcodigo_barra" value="Código Barra" readonly /></th>';
			echo '<th><input type="text" id="hnombre" value="Nombre" readonly /></th>';
			echo '<th><input type="text" id="hdescripcion" value="Descripción" readonly /></th>';
			echo '<th><input type="text" id="hsuplidor" value="Suplidor" readonly /></th>';
			echo '<th><input type="text" id="hstock_min" value="Stock Min" readonly /></th>';
			echo '<th><input type="text" id="hstock" value="Stock" readonly /></th>';
			echo '</tr>';

		
			while ($fila = mysql_fetch_array($resultado)) {

				echo '<tr>'; 
			    echo '<td><input type="text" id="did_producto" value="'.$fila['id_producto'].'" readonly /></td>';
			    echo '<td><input type="text" id="dcodigo_barra" value="'.$fila['codigo_barra'].'" readonly /></td>';
			    echo '<td><input type="text" id="dnombre" value="'.$fila['nombre'].'" readonly /></td>';
			    echo '<td><input type="text" id="ddescripcion" value="'.$fila['descripcion'].'" readonly /></td>';
			    echo '<td><input type="text" id="dsuplidor" value="'.$fila['suplidor'].'" readonly /></td>';
			    echo '<td><input type="text" id="dstock_min" value="'.$fila['stock_min'].'" readonly /></td>';
			    echo '<td><input type="text" id="dstock" value="'.$fila['stock'].'" readonly /></td>';			     
			    echo '</tr>'; 	
			}

			echo '</table>';


			// Cálculo para navegar en los registros de la tabla
			if ($limite > 0) {	
				
				$limit = $limite -15;
				echo '<div id="anterior" onclick= "detalle_abst_paginar('.$limit.')"><span class="flecha_anterior"></span>Anterior</div>';
										
			}

			if($limite < $totalReg -15){
				
				$limit = $limite + 15;
				echo '<div id="siguiente" onclick="detalle_abst_paginar('.$limit.')">Siguiente<span class="flecha_siguiente"></span></div>';			

			}


		}else{
			
			//Devolver no si no se ha encontrado nunguna coincidencia
			echo "no";
		}






	}




}

?>