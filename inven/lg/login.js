$(document).ready(function(){

	/*Variables a utilizar en el módulo*/
	var server_all;

	/*Poner el focus al campo usuario*/
	$("#usuario").focus();  

	/*Llamar a la función que comprobará el estatus del servidor*/
	status_server();
	
	/*Evento click del button validar datos para acceder al sistema*/
	$("#validar").click(function(){ 

		if ($("#usuario").val()!="" && $("#clave").val()!="") {
 		
			/*Varables de datos a utilizar*/
		 	var usuario = $('#usuario').val();			
			var clave = $('#clave').val();
			var valor = $('#tipo_user option:selected').text();
			var tipo = 0;
			

			/*Eligir el tipo de usuario seleccionado que accederá al sistema*/
			switch(valor) {

				case 'Usuario':
				tipo = 2;
				break; 

				case 'Admin':
				tipo = 1;
				break;

				default:
				alert("Tipo de usuario incorrecto");

			}		
				
								
			/*Array de tipo json para ser enviado al servidor*/
			var dato = {usuario: usuario, clave: clave, tipo: tipo};				

			$.ajax({
				type: "POST",
				url: "cargarUsuario.php",		
				data: dato,
			})
			.done(function(data){					
													
				/*Evalúa si contine información retornada el json desde el servidor*/
				if (jQuery.isEmptyObject(data)) {

					/*Mensaje a mostrar si el usuario a buscar no existe*/
					$("#msj").html("Datos de accesos incorrecto");
					$("#msj").css({"color":"red"});
						setTimeout(function(){
						/*Elimina el mensaje de error transcurrido el tiempo asignado*/
						$("#msj").html("");
						/*Elimina el color de id msj*/
						$("#msj").css({"color":""});

						/*Tiempo establecido que tardará en ejecutarse esta sección de código*/
						},2000);				
			
				}else{

					/*El usuario se a logeado correctamente y, llama al index.php*/
					window.location='../index.php';					
				}	
			
			})
			.fail(function(){

				$("#msj").html("Error de conexión a la DB");
				$("#msj").css({"color":"red"});
				setTimeout(function(){
					// Elimina el mensaje de error transcurrido el tiempo asignado
					$("#msj").html("");
					/*Elimina el color de id msj*/
					$("#msj").css({"color":""});

				},2000);
			
			})
			.always(function(){

				/*Escribir aquí*/
										
				
			});
	

	    }else{

		$("#msj").html("Todos los campos deben ser llenados");
		$("#msj").css({"color":"red"});
		setTimeout(function(){

			/*Elimina el mensaje de error transcurrido el tiempo asignado*/
			$("#msj").html("");
			/*Elimina el color de id msj*/
			$("#msj").css({"color":""});

			},3000);


	    }


    });

	/*función que comprobará el estatus del servidor*/
    function status_server(){

    	/*Array de tipo json para ser enviado al servidor, el mismo es solo para completar el requisito ya
		  no sera usado.
		*/
		var dato = {server_all: server_all};				

		$.ajax({
				type: "POST",
				url: "status_conexion.php",		
				data: dato,
		})
		.done(function(data){

			/*Formatear el objeto recibido a un json*/
			var json = JSON.parse(data);			

			/*Preguntar la respuesta recibida del servidor y, luego tomar decisiones*/
			if (json == 'Activo') {

				$("#status_server").html('Status del Servidor' + ": " + json);

			}else if (json == 'Inactivo'){

				$("#status_server").html('Status del Servidor' + ": " + json);

			}else if (json == 'Error'){

				$("#status_server").html('Status del Servidor' + ": " + json);

			}										
												
					
		})
		.fail(function(){

			$("#msj").html("Error en la conexión a la DB");
			$("#msj").css({"color":"red"});
			setTimeout(function(){
				// Elimina el mensaje de error transcurrido el tiempo asignado
				$("#msj").html("");
				/*Elimina el color de id msj*/
				$("#msj").css({"color":""});

			},2000);
			

		})
		.always(function(){

			/*Escribir aquí*/										
				
		});
    	

    }



});




