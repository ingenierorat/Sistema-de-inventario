$(document).ready(function(){ 

	/*Poner el focus al campo usuario*/
	$("#usuario").focus(); 
	
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



});




