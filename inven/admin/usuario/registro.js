$(document).ready(function(){	

	// Manejador del evento click del button nuevo
	$("#nuevo").click(function(){ 
		// Llamar la funcion que creará la tabla para infresar los nuevo Pro
		nuevoUsua();
		// Poner el focus el primer campo
		$("#did").focus(); 
		// Cambiar el texto de este DIV
		$("#ingreso").text("Registrar Usuario al Sistema");

		$("#ingresar").click(function(){  
			
			// Varable de datos a utilizar
			var codigo = $('#did').val();
			var id_tipo_usuario = $('#did_tipo_usuario').val();
		 	var nombre = $('#dnombre').val();
			var apellidos = $('#dapellidos').val();
			var usuario = $('#dusuario').val();
			var clave = $('#dclave').val();						
	 		var fecha_ingreso = $('#dfecha_ingreso').val();
						
			
			
			// Variable que controla el tipo de acción a ejecutar
			var nuevo = "nuevo";					

			// Array de tipo json para ser enviado
			var dato = {nuevo: nuevo, codigo: codigo, id_tipo_usuario: id_tipo_usuario, nombre: nombre, apellidos: apellidos, usuario: usuario,
						 clave: clave, fecha_ingreso: fecha_ingreso };				

			$.ajax({
				type: "POST",
				url: "registro.class.php",		
				data: dato,
			})
			.done(function(dato){

				// Si es que si el registro se inserto correctamente
				if (dato =='si') {

					$("#msj").html("Registro insertado");
					setTimeout(function(){

						// Elimina el mensaje de error transcurrido el tiempo asignado
						$("#msj").html("");
						limpiar_campo();
						$('#did').focus();

					},2000);


				 }else{

				 	$("#msj").html('Registro no insertado por varias razones');
				 	setTimeout(function(){

						// Elimina el mensaje de error transcurrido el tiempo asignado
						$("#msj").html("");
						$('#did').focus();
						

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
			$("#did").focus();

		});


	});

	// Manejador del evento click del button editar
	$("#editar").click(function(){				
		// Llamar el método que nos permitira editar los Pro
		editarUsua();
		// Poner el focus en el campo nombre
		$("#did").focus();
		// Cambiar el texto de este DIV
		$("#ingreso").text("Editar cliente del Sistema");

		// Hacer una consulta despues den evento onblur del campo código
		$("#did").blur(function(){
			
			// Código a buscar el la base de datos
			var codigo = $('#did').val();
			// Array de tipo Json para ser enviado al servidor
			var dato = {codigo: codigo};

			$.ajax({
				type: "POST",
				url: "cargarUsua.php",		
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
					$("#did").attr("disabled", true);
					// Poner el focus a este elemento
					$('#did_tipo_usuario').focus();					
					// Extrael los campo del objeto
					$.each(json, function(i, item){

						// Asignar los valores retornado a cada objeto
						$('#did').val(item.id_usuario);
						$('#did_tipo_usuario').val(item.id_tipo_usuario);
						$('#dnombre').val(item.nombre);
						$('#dapellidos').val(item.apellidos);
						$('#dusuario').val(item.usuario);
						$('#dclave').val(item.clave);											
						$('#dfecha_ingreso').val(item.fecha_ingreso);						
											

					});


				}else{
					// Acciones a realizar si el resultado es negativo
					$('#did').val("");
					$('#did').focus();
					// Mensaje a mostrar si el código a buscar no existe
					$("#msj").html("Código incorrecto");

					setTimeout(function(){

						// Elimina el mensaje de error transcurrido el tiempo asignado
						$("#msj").html("");

					},3000);				

				}						

				
			})
			.fail(function(){

				$("#msj").html("Error, favor verificar la conexión al servidor");

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
			var codigo = $('#did').val();
			var id_tipo_usuario = $('#did_tipo_usuario').val();
			var nombre = $('#dnombre').val();
			var apellidos = $('#dapellidos').val();
			var usuario = $('#dusuario').val();
			var clave = $('#dclave').val();						
			var fecha_ingreso = $('#dfecha_ingreso').val();
			
			// Variable que controla el tipo de acción a ejecutar
			var editar = "editar";

			// Poner el focus al campo nombre
			$("#did").focus();			

			// Array de tipo json para ser enviado
			var dato = {editar : editar, codigo: codigo, id_tipo_usuario: id_tipo_usuario, nombre: nombre, apellidos: apellidos, usuario: usuario,
						 clave: clave, fecha_ingreso: fecha_ingreso };				

			$.ajax({
				type: "POST",
				url: "registro.class.php",		
				data: dato,
			})
			.done(function(dato){

				// Si es que si el registro se inserto correctamente
				if (dato =='si') {

					$("#msj").html('Registro actualizado');
					setTimeout(function(){

						$("#did").attr("disabled", false);						
						$("#did").focus();
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

		$("#cancelar").click(function(){

			$("#did").attr("disabled", false);			
			$("#did").focus();
			// Cancela la edición limpiando todos los campos
			limpiar_campo();



		});

		
	});

	// Manejador del evento click del button eliminar
	$("#eliminar").click(function(){
			
		eliminarUsua();	
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
					url: "eliminarUsua.php",		
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
function nuevoUsua(){

	// Variables a utilizar
	var tabla;
	var buttones;	
	
	
	// Creación de la tabla Usuario
	tabla += "<tr><td><label class='lbl_registro'>Id: </label><input type='number' name='id' id='did' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Tipo Usuario: </label><input type='number' name='id_tipo_usuario' id='did_tipo_usuario' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Nombre: </label><input type='text' name='nombre' id='dnombre' /></td></tr>";	
	tabla += "<tr><td><label class='lbl_registro'>Apellidos: </label><input type='text' name='apellidos' id='dapellidos' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Usuario: </label><input type='text' name='usuario' id='dusuario' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Clave: </label><input type='text' name='clave' id='dclave' /></td></tr>";	
	tabla += "<tr><td><label class='lbl_registro'>Fecha Ingreso: </label><input type='date' name='fecha_ingreso' id='dfecha_ingreso' /></td></tr>";
		
	
	
	// Escribir la tabla creada en la página que la llamó
	$("#tablaRegistroUsua").html(tabla);
	// Borra el contenido que haya escrito en el panel
	$("#tablaRegistroEliminar").html("");	

	// Crear los buttones
	buttones = "<input type='button' value='Ingresar Usua.' id='ingresar' />";
	buttones += "<input type='button' value='Limpiar Camp.' id='limpiar' />";
	buttones += "<label id='msj'></label>";	
	// Escribir los buttones en el Div botones despues de la tabla ya creada
	$("#botones").html(buttones);
	

}

// Editar producto del Sistema
function editarUsua(){

	// Variables a utilizar
	var tabla;
	var buttones;

	// Creación de la tabla Usuario
	tabla += "<tr><td><label class='lbl_registro'>Id: </label><input type='number' name='id' id='did' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Tipo Usuario: </label><input type='number' name='id_tipo_usuario' id='did_tipo_usuario' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Nombre: </label><input type='text' name='nombre' id='dnombre' /></td></tr>";	
	tabla += "<tr><td><label class='lbl_registro'>Apellidos: </label><input type='text' name='apellidos' id='dapellidos' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Usuario: </label><input type='text' name='usuario' id='dusuario' /></td></tr>";
	tabla += "<tr><td><label class='lbl_registro'>Clave: </label><input type='text' name='clave' id='dclave' /></td></tr>";	
	tabla += "<tr><td><label class='lbl_registro'>Fecha Ingreso: </label><input type='date' name='fecha_ingreso' id='dfecha_ingreso' /></td></tr>";
		
	
	
	// Escribir la tabla creada en la página que la llamó
	$("#tablaRegistroUsua").html(tabla);
	// Borra el contenido que haya escrito en el panel
	$("#tablaRegistroEliminar").html("");	
	

	// Crear el button Editar
	buttones = "<input type='button' value='Guardar Camb.' id='guardar' />";
	buttones += "<input type='button' value='Limpiar Camp.' id='limpiar' />";
	buttones += "<label id='msj'></label>";
	
	// Escribir el button en el Div botones despues de la tabla ya creada
	$("#botones").html(buttones);
	

}

// Eliminar usuario del Sistema
function eliminarUsua(){

	// Variables a utilizar
	var tabla;
	var buttones;	
	
	
	// Creación de la tabla Pro
	tabla += "<tr><td><input type='number' name='codigo' id='decodigo' placeholder='Intoduzca el código aquí' /></td></tr>";
	tabla += "<tr><td><input type='button' name='eliminar' id='deeliminar' value='Eliminar Usua' /><label id='msj'></label></td></tr>";	
		
	// Escribir la tabla creada en la página que la llamó
	$("#tablaRegistroEliminar").html(tabla);	
	// Borra el contenido que haya en el panel
	$("#tablaRegistroUsua").html("");

	$("#botones").html("");	

	
}

// Borrar todos los campos de textto
function limpiar_campo(){

	$("#did").val("");
	$("#did_tipo_usuario").val("");
	$("#dnombre").val("");
	$("#dapellidos").val("");
	$("#dusuario").val("");
	$("#dclave").val("");	
	$("#dfecha_ingreso").val("");	
	$("#msj").text("");


}