$(document).ready(function(){

	// Atributos del objeto text, que seran cargado al comenzar el DOM
	$("#txtbuscar").focus();
	$("#txtbuscar").attr("type", "number");

	// Menjador el evento click de button buscar
	$('#btnbuscar').click(function(){		
		
		var opcionSelected = $('#opcion option:selected').text();
		
		
			if ($("#txtbuscar").val() != "" || $("#txtbuscar").attr("disabled")){	

				switch(opcionSelected){		 		

					case 'Código':								
						buscarCodigo();								
					    break;

					case 'Descripción':
						buscarDescripcion();
						break;

					case 'Cargar Tod.':
						buscarTodo(0);							
						break;

					default:
						// Mensaje de al usuario en caso de error
						$("#lblopcion").html("opción incorrecta");
						// Limpia la etiqueta en el tiempo determinado
						setTimeout(function(){

							$("#lblopcion").html("Elija la opción a consultar");

						},2000);

				}


			}else{

				// Mensaje de al usuario en caso de error
				$("#lblopcion").css("color","red");
				$("#lblopcion").html("El campo no debe estar vacío");
				// Limpia la etiqueta en el tiempo determinado
				setTimeout(function(){

					$("#lblopcion").html("Elija la opción a consultar");
					$("#lblopcion").css("color","");

				},2000);
								
			}	

    });

    // Menjador el evento click de button limpiar
    $("#btnlimpiar").click(function(){

    	$("#txtbuscar").val("");
    	$("#txtbuscar").focus();    	
    	$("#tablaTUsua").html("");
    	$("#adelante").css("display", "none");
    	$("#siguiente").css("display", "none");

    });

    // Menejador el evento change del select
	$("#opcion").change(function(){
		// Variables a utilizar
		var texto = $("#opcion option:selected").text();
		// Switch de comprabación
		switch(texto) {				

			case 'Código':
				$("#txtbuscar").attr("disabled", false);
				$("#txtbuscar").attr("type", "number");	
				break;					
					
			case 'Descripción':
				$("#txtbuscar").attr("disabled", false);
				$("#txtbuscar").attr("type", "text");
				break;							
					
			case 'Cargar Tod.':
				$("#txtbuscar").val("");
				$("#txtbuscar").attr("disabled", true);								
				break;

			default:

			// Mensaje al usuario en caso de error
			$("#lblopcion").html("opción incorrecta");
			$("#lblopcion").css("color","red");

			// Limpia la etiqueta en el tiempo determinado
			setTimeout(function(){

				$("#lblopcion").html("Elija la opción a consultar");
				$("#lblopcion").css("color","");

			},2000);

				
		}

	});

});




// Función que permite hacer la búsqueda por código del elemento
function buscarCodigo(){

	var txtValor = $('#txtbuscar').val();
	// Array de tipo json para ser enviado
	var dato = {id: txtValor};	
	

	$.ajax({
		type: "POST",
		url: "consulta.class.php",		
		data: dato,
	})
	.done(function(dato){

		if (dato == -1) {

			$("#lblopcion").html("Tipo Usuario no encontrado");
			$("#lblopcion").css("color","red");
			$("#txtbuscar").focus();
			setTimeout(function(){

				$("#lblopcion").html("Elija la opción a consultar");
				$("#lblopcion").css("color","");

			},2000);

		}else{

			$("#contenedorTablaTUsua").html(dato);

		}

		
	})
	.fail(function(){
		
		$("#lblopcion").html("Error en la conexión al Servidor");
		$("#lblopcion").css("color","red");
		setTimeout(function(){

			$("#lblopcion").html("Elija la opción a consultar");
			$("#lblopcion").css("color","");

		},2000);

	})
	.always(function(){
		// Siempre se ejecuta
	});

}

// Función que permite hacer la búsqueda por nombre del elemento
function buscarDescripcion(){

	var txtValor = $('#txtbuscar').val();
	// Array de tipo json para ser enviado
	var dato = {descripcion: txtValor};	

	$.ajax({
		type: "POST",
		url: "consulta.class.php",		
		data: dato,
	})
	.done(function(dato){

		if (dato == -1) {

			$("#lblopcion").html("Tipo Usuario no encontrado");
			$("#lblopcion").css("color","red");
			$("#txtbuscar").focus();
			setTimeout(function(){

				$("#lblopcion").html("Elija la opción a consultar");
				$("#lblopcion").css("color","");

			},2000);

		}else{

			$("#contenedorTablaTUsua").html(dato);

		}

		
	})
	.fail(function(){

		$("#lblopcion").html("Error en la conexión al Servidor");
		$("#lblopcion").css("color","red");
		setTimeout(function(){

			$("#lblopcion").html("Elija la opción a consultar");
			$("#lblopcion").css("color","");

		},2000);
		
	})
	.always(function(){
		// Siempre se ejecuta
	});

}

// Función que permite hacer la búsqueda de todos los elementos
function buscarTodo(limite){
	
	$.ajax({
		type: "POST",
		url: "consulta.class.php",		
		data: {limite: limite},
	})
	.done(function(dato){

		if (dato == -1) {

			$("#lblopcion").html("Tipo Usuario no encontrado");
			$("#lblopcion").css("color","red");
			$("#txtbuscar").focus();
			setTimeout(function(){

				$("#lblopcion").html("Elija la opción a consultar");
				$("#lblopcion").css("color","");

			},2000);

		}else{

			$("#contenedorTablaTUsua").html(dato);

		}
		

	})
	.fail(function(){

		$("#lblopcion").html("Error en la conexión al Servidor");
		$("#lblopcion").css("color","red");
		setTimeout(function(){

			$("#lblopcion").html("Elija la opción a consultar");
			$("#lblopcion").css("color","");

		},2000);
	})
	.always(function(){
		// Siempre se ejecuta
	});

}

