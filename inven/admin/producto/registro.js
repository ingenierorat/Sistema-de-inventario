

$(document).ready(function(){	    

	// Manejador del evento click del button nuevo
	$("#nuevo").click(function(){
		// Llamar la funcion que creará la tabla para infresar los nuevo Pro
		nuevoPro();
		// Poner el focus el primer campo
		$("#dno").focus();
		// Cambiar el texto de este DIV
		$("#ingreso").text("Registrar producto al Sistema");

		$("#ingresar").click(function(){     
    
		 	// Varable de datos a utilizar
			var no = $('#dno').val(); 
			var categoria = $('#dcategoria').val();
			var empresa = $('#dempresa').val();
			var codigo = $('#dcodigo').val();
			var nombre = $('#dnombre').val();
			var descripcion = $('#ddescripcion').val();
			var precio_ingreso = $('#dprecio_ingreso').val();
			var porciento_venta = $('#dporciento_venta').val();
			var itebis = $('#ditebis').val();
			var precio_venta = $('#dprecio_venta').val();
			var disponibilidad_min = $('#ddisponibilidad_min').val();
			var disponibilidad = $('#ddisponibilidad').val();
			var fecha_ingreso = $('#dfecha_ingreso').val();


			
			
			// Variable que controla el tipo de acción a ejecutar
			var nuevo = "nuevo";

			// Poner el focus el primer campo
			$("#dno").focus();			

			// Array de tipo json para ser enviado
			var dato = {nuevo : nuevo, no: no, categoria: categoria, empresa: empresa, codigo: codigo, nombre: nombre, descripcion: descripcion,
						precio_ingreso: precio_ingreso, porciento_venta: porciento_venta, itebis: itebis, precio_venta: precio_venta, disponibilidad_min: disponibilidad_min,
					    disponibilidad: disponibilidad, fecha_ingreso: fecha_ingreso};				

			$.ajax({
				type: "POST",
				url: "registro.class.php",		
				data: dato,
			})
			.done(function(dato){

				// Si es que si el registro se inserto correctamente
				if (dato =='si') {

					$("#msj").html('Registro insertado correctamente');
					setTimeout(function(){

						// Elimina el mensaje de error transcurrido el tiempo asignado
						$("#msj").html("");
						limpiar_campo();

					},2000);


				 }else{

				 	$("#msj").html('Registro no insertado por varias razones');
				 	setTimeout(function(){

						// Elimina el mensaje de error transcurrido el tiempo asignado
						$("#msj").html("");
						

					},2000);
				 }


			})
			.fail(function(){
				$("#msj").html("Error, favor verificar la conexión al servidor");

				setTimeout(function(){

					// Elimina el mensaje de error transcurrido el tiempo asignado
					$("#msj").html("");

				},2000);
			})
			.always(function(){
				// Siempre se ejecuta
			});
		
					
		});


		$("#limpiar").click(function(){

			// Funcion que se encarga de limpiar todos los campos
			limpiar_campo();
			// Poner el focus el primer campo
			$("#dno").focus();


		});

		$("#ditebis").blur(function(){ 

			$("#dprecio_venta").val(calcular_precio_final()); 
   			

		});


	});


	// Manejador del evento click del button editar
	$("#editar").click(function(){				
		// Llamar el método que nos permitira editar los Pro
		editarPro();
		// Poner el focus en el campo nombre
		$("#dcodigo").focus();
		// Cambiar el texto de este DIV
		$("#ingreso").text("Editar producto del Sistema");

		// Hacer una consulta despues den evento onblur del campo código
		$("#dcodigo").blur(function(){
			
			// Código a buscar el la base de datos
			var codigo = $('#dcodigo').val();
			// Array de tipo Json para ser enviado al servidor
			var dato = {codigo: codigo};

			$.ajax({
				type: "POST",
				url: "cargarProductos.php",	 	
				data: dato,
			})
			.done(function(dato){
				
				// Crear un objeto Json
				var json = JSON.parse(dato);
				// Obtener el tamaño del Json
				var num = parseInt(json.length);
				// Preguntar cual numero retornó
				if (num == 2) {

					// Deshabiltar el campo código, para que no pueda ser modificado
					$("#dno").attr("disabled", true);
					$("#dcodigo").attr("disabled", true);
					// Extrael los campo del objeto
					$.each(json, function(i, item){

						// Asignar los valores retornado a cada objeto
						$('#dno').val(item.id_producto);
						$('#dcategoria').val(item.id_categoria);
						$('#dempresa').val(item.id_empresa);
						$('#dcodigo').val(item.codigo_barra);
						$('#dnombre').val(item.nombre);
						$('#ddescripcion').val(item.descripcion);
						$('#dprecio_ingreso').val(item.precio_ingreso);
						$('#dporciento_venta').val(item.porciento_venta);
						$('#ditebis').val(item.itebis);
						$('#dprecio_venta').val(item.precio_venta);
						$('#ddisponibilidad_min').val(item.disponibilidad_min);
						$('#ddisponibilidad').val(item.disponibilidad);
						$('#dfecha_ingreso').val(item.fecha_ingreso);
						
						
						

					});


				}else{
					// Acciones a realizar si el resultado es negativo
					$('#dcodigo').val("");
					$('#dcodigo').focus();
					// Mensaje a mostrar si el código a buscar no existe
					$("#msj").html("Código incorrecto");

					setTimeout(function(){

						// Elimina el mensaje de error transcurrido el tiempo asignado
						$("#msj").html("");

					},2000);				

				}						

				
			})
			.fail(function(){

				$("#msj").html("ERROR, favor verificar la conexión al servidor");

				setTimeout(function(){

					// Elimina el mensaje de error transcurrido el tiempo asignado
					$("#msj").html("");

				},3000);
			})
			.always(function(){
				// Siempre se ejecuta
			});

			

		});

		$("#guardar").click(function(){	

			// Varable de datos a utilizar
			var no = $('#dno').val();
			var categoria = $('#dcategoria').val();
			var empresa = $('#dempresa').val();
			var codigo = $('#dcodigo').val();
			var nombre = $('#dnombre').val();
			var descripcion = $('#ddescripcion').val();
			var precio_ingreso = $('#dprecio_ingreso').val();
			var porciento_venta = $('#dporciento_venta').val();
			var itebis = $('#ditebis').val();
			var precio_venta = $('#dprecio_venta').val();			
			var disponibilidad_min = $('#ddisponibilidad_min').val();
			var disponibilidad = $('#ddisponibilidad').val();
			var fecha_ingreso = $('#dfecha_ingreso').val();
			
			// Variable que controla el tipo de acción a ejecutar
			var editar = "editar";

			// Poner el focus al campo nombre
			$("#dcodigo").focus();			

			// Array de tipo json para ser enviado
			var dato = {editar : editar, no: no, categoria: categoria, empresa: empresa, codigo: codigo, nombre: nombre, descripcion: descripcion,
						 precio_ingreso: precio_ingreso, porciento_venta: porciento_venta, itebis: itebis, precio_venta: precio_venta,
						 disponibilidad_min: disponibilidad_min, disponibilidad: disponibilidad, fecha_ingreso: fecha_ingreso};				

			$.ajax({
				type: "POST",
				url: "registro.class.php",		
				data: dato,
			})
			.done(function(dato){

				// Si es que si el registro se inserto correctamente
				if (dato=='si') {

					$("#msj").html('Registro actualizado');
					setTimeout(function(){

						$("#dcodigo").attr("disabled", false);
						$("#dno").attr("disabled", false);
						$("#dcodigo").focus();
						// Cancela la edición limpiando todos los campos
						limpiar_campo();

					},2000);


				 }else{

				 	$("#msj").html('Registro no actualizado por varias razones');
				 	setTimeout(function(){

						// Elimina el mensaje de error transcurrido el tiempo asignado
						$("#msj").html("");
						

					},2000);

				 }


				 	



			        

				








			})
			.fail(function(){

				$("#msj").html("ERROR, favor verificar la conexión al servidor");

				setTimeout(function(){

					// Elimina el mensaje de error transcurrido el tiempo asignado
					$("#msj").html("");

				},3000);
			})
			.always(function(){
				// Siempre se ejecuta
			});

			
		});

		$("#cancelar").click(function(){

			$("#dcodigo").attr("disabled", false);
			$("#dno").attr("disabled", false);
			$("#dcodigo").focus();
			// Cancela la edición limpiando todos los campos
			limpiar_campo();



		});

		
	});

	// Manejador del evento click del button eliminar
	$("#eliminar").click(function(){
			
		eliminarPro();	
		// Poner el focus en el campo código
		$("#decodigo").focus();
		// Cambiar el texto de este DIV
		$("#ingreso").text("Eliminar material del Sistema");	
		
		$("#deeliminar").click(function(){	

			// Varable de datos a utilizar
			var codigo = $("#decodigo").val();
			
			if (codigo != "") {
				
				// Array de tipo json para ser enviado
				var dato = {codigo: codigo};				

				$.ajax({
					type: "POST",
					url: "eliminarProducto.php",		
					data: dato,
				
				})
				.done(function(dato){
					
					// Condición que evalua el resultado devuelto por el servidor
					if (dato =='si') {

						$("#msj").html('Registro eliminado');
						
						setTimeout(function(){
							
							// Limpia el campo
							$("#decodigo").val("");
							// Pone el focu al campo
							$("#decodigo").focus();	
							$("#msj").text("");
							

						},2000);


					 }else{

					 	$("#msj").html('Registro no encontrado');
					 	
					 	setTimeout(function(){

							// Elimina el mensaje de error transcurrido el tiempo asignado
							$("#msj").html("");	
							// Poner el focus en el campo código
							$("#decodigo").focus();					

						},2000);

					 }

				})			
				.fail(function(){

					$("#msj").html("Error de conexión al servidor");

					setTimeout(function(){

						// Elimina el mensaje de error transcurrido el tiempo asignado
						$("#msj").html("");

					},2000);
				
				})
				.always(function(){
					// Siempre se ejecuta
				});



			 }else{

			 	$("#msj").text('El campo no debe estar vacío');
						
						setTimeout(function(){
							// Limpia el campo
							$("#decodigo").val("");
							// Pone el focu al campo
							$("#decodigo").focus();	
							$("#msj").text("");					
							
						},2000);
			 }


			
		});



	});

	
	


});





// Ingresar nuevo producto al Sistema
function nuevoPro(){

	// Variables a utilizar
	var tabla;
	var buttones;	
	
	
	// Creación de la tabla Pro
	tabla += "<tr><td><label class='lbl_registro'>No.: </label><input type='number' name='no' id='dno' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Categoría: </label><input type='number' name='categoria' id='dcategoria' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Empresa: </label><input type='number' name='empresa' id='dempresa' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Código: </label><input type='number' name='codigo' id='dcodigo' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Nombre: </label><input type='text' name='nombre' id='dnombre' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Descripción: </label><textarea name='descripcion' id='ddescripcion' /></td></tr>";	
	tabla += "<tr><td><label class='lbl_registro'>Precio Ingreso: </label><input type='number' name='precio_ingreso' id='dprecio_ingreso' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>% Venta: </label><input type='number' name='porciento_venta' id='dporciento_venta' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Itebis: </label><input type='number' name='itebis' id='ditebis' placeholder='Poner 0 si va anulado' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Precio Venta: </label><input type='number' name='precio_venta' id='dprecio_venta' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Disponibilidad Min: </label><input type='number' name='disponibilidad_min' id='ddisponibilidad_min' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Disponibilidad: </label><input type='number' name='disponibilidad' id='ddisponibilidad' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Fecha Ingreso: </label><input type='date' name='fecha_ingreso' id='dfecha_ingreso' /></td></tr>";
		
	


	
	// Escribir la tabla creada en la página que la llamó
	$("#tablaRegistroPro").html(tabla);	

	// Borra el contenido que haya escrito en el panel
	$("#tablaRegistroEliminar").html("");

	// Crear los buttones
	buttones = "<input type='button' value='Ingresar Pro.' id='ingresar' />";
	buttones += "<input type='button' value='Limpiar Camp.' id='limpiar' />";
	buttones += "<label id='msj'></label>";	
	// Escribir los buttones en el Div botones despues de la tabla ya creada
	$("#botones").html(buttones);
	

}

// Editar producto del Sistema
function editarPro(){

	// Variables a utilizar
	var tabla;
	var buttones;	
	
	// Creación de la tabla Pro
	tabla += "<tr><td><label class='lbl_registro'>No.: </label><input type='number' name='no' id='dno' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Categoría: </label><input type='number' name='categoria' id='dcategoria' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Empresa: </label><input type='number' name='empresa' id='dempresa' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Código: </label><input type='number' name='codigo' id='dcodigo' placeholder='Código a buscar' /></td></tr>";	
	tabla += "<tr><td><label class='lbl_registro'>Nombre: </label><input type='text' name='nombre' id='dnombre' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Descripción: </label><textarea name='descripcion' id='ddescripcion' /></td></tr>";		
	tabla += "<tr><td><label class='lbl_registro'>Precio Ingreso: </label><input type='number' name='precio_ingreso' id='dprecio_ingreso' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>% Venta: </label><input type='number' name='porciento_venta' id='dporciento_venta' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Itebis: </label><input type='number' name='itebis' id='ditebis' placeholder='Poner 0 si va anularlo' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Precio Venta: </label><input type='number' name='precio_venta' id='dprecio_venta' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Disponibilidad Min: </label><input type='number' name='disponibilidad_min' id='ddisponibilidad_min' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Disponibilidad: </label><input type='number' name='disponibilidad' id='ddisponibilidad' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Fecha Ingreso: </label><input type='date' name='fecha_ingreso' id='dfecha_ingreso' /></td></tr>";


	
	// Escribir la tabla creada en la página que la llamó
	$("#tablaRegistroPro").html(tabla);	
	// Borra el contenido que haya escrito en el panel
	$("#tablaRegistroEliminar").html("");	

	// Crear el button Editar
	buttones = "<input type='button' value='Guardar Camb.' id='guardar' />";
	buttones += "<input type='button' value='Limpiar Camp.' id='limpiar' />";
	buttones += "<label id='msj'></label>";
	
	// Escribir el button en el Div botones despues de la tabla ya creada
	$("#botones").html(buttones);
	

}

// Eliminar producto del Sistema
function eliminarPro(){

	// Variables a utilizar
	var tabla;
	var buttones;	
	
	
	// Creación de la tabla Pro
	tabla += "<tr><td><input type='number' name='codigo' id='decodigo' placeholder='Intoduzca el código aquí' /></td></tr>";
	tabla += "<tr><td><input type='button' name='eliminar' id='deeliminar' value='Eliminar Pro' /><label id='msj'></label></td></tr>";	
		
	// Escribir la tabla creada en la página que la llamó
	$("#tablaRegistroEliminar").html(tabla);	
	// Borra el contenido que haya en el panel
	$("#tablaRegistroPro").html("");

	$("#botones").html("");	

	
} 


// Borrar todos los campos de textto
function limpiar_campo(){


	$("#dno").val("");	
	$("#dcategoria").val("");
	$("#dempresa").val("");
	$("#dcodigo").val("");
	$("#dnombre").val("");
	$("#ddescripcion").val("");
	$("#dprecio_ingreso").val("");
	$("#dporciento_venta").val("");
	$("#ditebis").val("");
	$("#dprecio_venta").val("");
	$("#ddisponibilidad_min").val("");
	$("#ddisponibilidad").val("");
	$("#dfecha_ingreso").val("");	
	$("#msj").text("");


}


// Calcular el precio final del producto
function calcular_precio_final(){
		
	var precio = parseFloat($("#dprecio_ingreso").val());
	var porciento = parseFloat($("#dporciento_venta").val());
	var itebis = parseFloat($("#ditebis").val());
	var precio_sin_itebis;
	var precio_con_itebis;
	

	// Sacar el porciento
	_porciento = precio * porciento / 100;
	// Agregar el porciento al precio
	precio_sin_itebis = parseFloat(precio + _porciento);

	// Si posee itebis hacer el cálculo correspondiente 
	if (itebis > 0) {

		// Sacar el itebis
		_itebis = precio_sin_itebis * itebis / 100;
		// Agragar el itebis al precio
		precio_con_itebis = parseFloat(precio_sin_itebis + _itebis);
		// Retornar el precio calculado
		return precio_con_itebis;


	}
	
	// Retornar el precio calculado
	return precio_sin_itebis;



}