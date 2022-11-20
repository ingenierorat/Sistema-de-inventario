
// Variable globales a utilizar
	var id_factura; 
	var nombre_cli;  
	var id_producto; 
	var id_cliente;
	var cantidad; 
	var precio;
	var precio_ingreso; 
	var porciento_venta;
	var importe;	
	var noregistro = 1;
	var subtotal = 0;
	var itebis = 0;	 
	var total = 0;
	var stock;
	var monto;
	var cambio; 
	var devuelta; 
	
	
	
	

$(document).ready(function(){	
	
	// Deshabilitar o habilitar los siguiente botones
	$("#pagar").attr("disabled", true);	
	$('#telefono').attr("disabled", false);
	$('#nombre_cliente').attr("disabled", false);
	$('#telefono').focus();	
	$("#anadir_items").attr("disabled", true);
	$("#monto").attr("disabled", true);
	$("#devuelta").attr("disabled", true);
	$("#nuevo_cliente").attr("disabled", false);
	//Ocultar la caja de imprimir	
	$("#caja_imprimir").css("display", "none");
	//Obtener el nombre completo del cliente
	nombre_cli = $('#nombre_cliente').val(); 
	
	
	
    

	// Manejador del evento blur de campo cantidad a ordenar
	$("#cantidad_ordenar").blur(function(){
		
		// Fucnión que calcula el importe 
		$("#importe").text(calcularImporte());
		
	
	});


	// Manejador del evento click del button buscar cliente
	$("#telefono").blur(function(){

		// Varable de datos a utilizar
		var telefono = $("#telefono").val();
			
		if (telefono != "") { 
				
			// Array de tipo json para ser enviado
			var dato = {telefono: telefono};				

			$.ajax({
				type: "POST",
				url: "cargarCliente.php",		
				data: dato,
				
			})
			.done(function(dato){
					
				// Crear un objeto Json
				var json = JSON.parse(dato);
				// Obtener el tamaño del Json
				var num = parseInt(json.length);
				// Preguntar cual numero retornó
				if (num == 2) {

					$("#nuevo_cliente").attr("disabled", true);	
					// Manda el focus al campo de producto
					$('#producto').focus();					
					
					// Extraer los campo del objeto
					$.each(json, function(i, item){

						// Asignar los valores retornado a cada objeto
						$('#nombre_cliente').val(item.nombre + " " + item.apellidos);
						//Deshabilitar los campo solo para lectura
						$('#telefono').attr("disabled", true);
						$('#nombre_cliente').attr("disabled", true);
						//Variable utilizada de manera global
						id_cliente = item.id_cliente;
																							

					});


				}else{
										
					// Mensaje a mostrar si el código a buscar no existe
					$("#msj").html("El teléfono no existe");
					$("#msj").css('color','red');
					$('#telefono').focus();

					setTimeout(function(){
						// Elimina el mensaje de error transcurrido el tiempo asignado
						$("#msj").html("");

					},2000);				

				}	


			})			
			.fail(function(){

				$("#msj").html("Error de conexión");

				setTimeout(function(){
					// Elimina el mensaje de error transcurrido el tiempo asignado
					$("#msj").html("");

				},2000);
				
			})
			.always(function(){
				// Siempre se ejecuta
			});



		 }else{

		 	//Poner el focues si el campo esta vacío
		 	$("#telefono").focus();
		 }

			 
			
	});


	// Manejador del evento click del button buscar producto
	$("#producto").blur(function(){

		// Varable de datos a utilizar
		var codigo = $("#producto").val();
			
		if (codigo != "") { 
				
			// Array de tipo json para ser enviado
			var dato = {codigo: codigo};				

			$.ajax({
				type: "POST",
				url: "cargarProducto.php",		
				data: dato,
				
			})
			.done(function(dato){

				// Crear un objeto Json
				var json = JSON.parse(dato);
				// Obtener el tamaño del Json
				var num = parseInt(json.length);
				// Preguntar cual numero retornó
				if (num == 2) {

					// Habilitar el button añadir items
					$("#anadir_items").attr("disabled", false);
					
					// Extrael los campo del objeto
					$.each(json, function(i, item){

						// Asignar los valores retornado a cada objeto
						$('#nombre_pro').text(item.nombre);
						$('#stock').text(item.disponibilidad);
						$('#precio').text(item.precio_venta);
						id_producto = item.id_producto;	
						precio = parseFloat(item.precio_venta);
						precio_ingreso = parseFloat(item.precio_ingreso);
						porciento_venta = parseFloat(item.porciento_venta);
						itebis = parseInt(item.itebis);
						stock = parseInt(item.disponibilidad);

						/*
						 Si el valor es igual 0000, es que aún la factura no se ja generado y se proccede a generarla
						 De lo contrario no hacer nada
						*/
						if ($('#no').text() == 0000) {
							// Genera el id de la factura
							generarIdFactura();

						}				
																	

					});


				}else{
										
					// Mensaje a mostrar si el código a buscar no existe
					$("#msj").html("El producto no existe");					
					$("#producto").focus();
					// Habilitar el button añadir items
					$("#anadir_items").attr("disabled", true);
					limpiarCampProducto();
										
					setTimeout(function(){				
						// Elimina el mensaje de error transcurrido el tiempo asignado
						$("#msj").html("");

					},2000);				

				}	


			})			
			.fail(function(){

				$("#msj").html("Error de conexión");

				setTimeout(function(){					
					// Elimina el mensaje de error transcurrido el tiempo asignado
					$("#msj").html("");

				},2000);
				
			})
			.always(function(){
				// Siempre se ejecuta
			});



		}else{
		 	$("#msj").text('El campo está en blanco');
		 	$("#msj").css('color','red');
	 		//$("#producto").focus();	
			setTimeout(function(){					
									
				$("#msj").text("");					
						
			},2000);

	 	 }

			
	});

	// Menejador el evento change del select
	$("#opcion_pago").change(function(){
		// Variables a utilizar
		var texto = $("#opcion_pago option:selected").text();
		// Switch de comprabación
		switch(texto) {				

			case 'Tarjeta Crédito':

				if ($("#no").text() != 0000) {

					$("#monto").attr("disabled", false);
					$("#pagar").attr("disabled", false);					
					$("#monto").focus();
				}
															
				break;					
					
			case 'Efectivo':

				if ($("#no").text() != 0000) {

					$("#monto").attr("disabled", false);
					$("#pagar").attr("disabled", false);					
					$("#monto").focus();
				}
																
				break;							
					
			case 'Cheques':				
				
				if ($("#no").text() != 0000) {

					$("#monto").attr("disabled", false);
					$("#pagar").attr("disabled", false);					
					$("#monto").focus();
				}
																
				break;

			default:			
			$("#pagar").attr("disabled", true);	
			$("#monto").attr("disabled", true);
			$("#devuelta").text("");
			$("#monto").val("");
				
				
		}


	});


	$("#pagar").click(function(){



		// Añadir pago a la base de datos
		anadirPago();
		//Obtener el nombre completo del cliente
		nombre_cli = $('#nombre_cliente').val();
		// Limpia todos los campos de la factura
		limpiarTodosCampos();
		// Deshabilitar en button pagar
		$("#pagar").attr("disabled", true);	
		$("#monto").attr("disabled", true);
		$('#telefono').attr("disabled", false);
		$('#nombre_cliente').attr("disabled", false);
		$("#telefono").focus();
		//Muestra el boton imprimir
		$("#caja_imprimir").css("display", "block");
		// Reiniciar la variable
		total = 0;
		noregistro = 1;

		

	});
	

	$("#anadir_items").click(function(){

		// Variables locales a utilizar
		var roud;
		var roud1;
		


		if ($("#cantidad_ordenar").val() != "") { 

			if (stock > 0) {

				// Fucnion que añade el registro a la base de datos
				anadirItem();
			
				// Actualizar el panel facturación				
				subtotal = precio;

				// Preguntar si el producto tiene itebis 
				if (itebis > 0) {
					// Calcular el precio final del producto
					var precio_final = (precio_ingreso * porciento_venta / 100) + precio_ingreso;
					// Calcular el itebis a dicho producto
					var _itebis = parseFloat(precio_final * itebis / 100);
					// Redondear la salida a dos decimales
					roud1 = _itebis.toFixed(2);
					// Añadir al campo itebis el resultado de la operación
					$("#itebis").text(roud1);


				}else{
					// Añadir al campo itebis el resultado de la operación
					$("#itebis").text(itebis);

				}

				// Variable que se irá incrementado segun items vayan agregandose
				total += parseFloat(importe);
				// Redondear la salida a dos decimales
				roud = total.toFixed(2);
				// Colocar en cada items los resultados			
				$("#subtotal").text(subtotal);
				$("#total").text(roud);
				// Poner el focus al campo producto
				$('#producto').focus();
				$("#anadir_items").attr("disabled", true);	

			}else{

				$("#msj").html("El producto no tiene stock");
				$("#msj").css("color","red");
				setTimeout(function(){

					$("#msj").html("");
					$("#msj").css("color","");

				},2000);
				
			}


		}else{

			$("#msj").text("Debes elegir la cantidad");			
			$("#msj").css("color","red");
			setTimeout(function(){

				$("#msj").html("");
				$("#msj").css("color","");
				// Poner el focus al campo producto
				$('#cantidad_ordenar').focus();	

			},2000);
		}	
											

	});


	// Cailcular la devuelta al cliente
	$("#monto").blur(function(){

		// Asignar a este campo la devolución correspondiente al cliente
		$("#devuelta").text(calcularDevuelta());


	});

	
	// Manejador de evento para ingresar nuevos clientes
	$("#nuevo_cliente").click(function(){

		showDialogModal();
		
	});
	

	$("#cerrar").click(function(){

		closeDialog();

	});


	$("#ingresar").click(function(){
		// Función para ingresar nuevo cliente al sistema
		nuevoCliente();		
		// Borrar los campos rellenados previamente
		limpiarCampoCliente();
		
	});

	






});





// Función que permite generar el id de la factura
function generarIdFactura(){

		// Obtener la fecha del sistema
		var hoy = new Date();
		var dd = hoy.getDate();
		var mm = hoy.getMonth() + 1;
		var yyyy = hoy.getFullYear();
		var fecha = yyyy +"/"+ mm + "/"+ dd;
		
				
		// Array de tipo json para ser enviado
		var dato = {fecha: fecha};				

		$.ajax({
				type: "POST",
				url: "generarFactura.php",		
				data: dato,
				
		})
		.done(function(dato){

				// Crear un objeto Json
				var json = JSON.parse(dato);
				// Obtener el tamaño del Json
				var num = parseInt(json.length);
				// Preguntar cual numero retornó
				if (num == 2) {
					
					// Extrael los campo del objeto
					$.each(json, function(i, item){
						
						// Asignar el valor retornado al label No. Factura
						$('#no').text(item.valor_maximo);						
						id_factura = item.valor_maximo;																
																	

					});

				}

		})			
		.fail(function(){

				$("#msj").html("Error de conexión");

				setTimeout(function(){					
					// Elimina el mensaje de error transcurrido el tiempo asignado
					$("#msj").html("");

				},2000);
				
		})
		.always(function(){			
			// Siempre se ejecuta

		});		


}

// Función que nos permite calcular el importe
function calcularImporte(){

	var cantidad_ordenar = $("#cantidad_ordenar").val();
	var imp = parseFloat(cantidad_ordenar * precio);
	importe = imp.toFixed(2);
	
	return importe;


}

function anadirItem(){

	// Obtiener el valor de la variable cantidad
	var cantidad = $("#cantidad_ordenar").val();

	// Json para ser enviado al servidor
	var dato = {
		id_factura: id_factura,
		id_producto: id_producto,
		id_cliente: id_cliente,
		cantidad: cantidad,
		precio: precio,
		importe: importe,
				
	};

	$.ajax({
		type: "POST",
		url: "anadirItem.php",		
		data: dato, 
	})
	.done(function(data){			

		$("#noregistro").html(noregistro);
		noregistro += 1;				
		// Descargar el inventario vendido del almacen
		descargarStock();
		// Limpiar los campos
		limpiarCampProducto();		
		// Buscar todos los items	
		buscarTodo(0);
		

	})
	.fail(function(){

		$("#msj").html("Error de conexión");
		$("#msj").css("color","red");
		setTimeout(function(){

			$("#msj").html("");
			$("#msj").css("color","");

		},2000);

	})
	.always(function(){
		// Siempre se ejecuta
	});


}

function buscarTodo(limite){

		
	// Json para ser enviado al servidor
	var dato = {
		id_factura: id_factura,
		limite: limite,
				
	};

	$.ajax({
		type: "POST",
		url: "consultarItem.php",		
		data: dato, 
	})
	.done(function(data){

		// Llenar la tabla con la información obtenida
		$("#tdetalle_factura").html(data);	
		

	})
	.fail(function(){

		$("#msj").html("Error de conexión");
		$("#msj").css("color","red");
		setTimeout(function(){

			$("#msj").html("");
			$("#msj").css("color","");

		},2000);

	})
	.always(function(){
		// Siempre se ejecuta
	});


}


function descargarStock(){

	// Obyener el valor de la variable cantidad
	var cantidad = $("#cantidad_ordenar").val();

	// Json para ser enviado al servidor
	var dato = {		
		id_producto: id_producto,		
		cantidad: cantidad,				
	};

	$.ajax({
		type: "POST",
		url: "descargarStock.php",		
		data: dato, 
	})
	.done(function(data){	
		
		// Delvolover datos aquí		

	})
	.fail(function(){

		$("#msj").html("Error de conexión");
		$("#msj").css("color","red");
		setTimeout(function(){

			$("#msj").html("");
			$("#msj").css("color","");

		},2000);

	})
	.always(function(){
		// Siempre se ejecuta
	});


}

function limpiarCampProducto(){

	// Limpiar todos los campo añadidos aqui
	$("#nombre_pro").text("");
	$("#stock").text("");
	$("#precio").text("");
	$("#importe").text("");
	$("#producto").val("");
	$("#cantidad_ordenar").val("");


}

function limpiarCampoCliente(){
	// Limpiar todos los campo añadidos aqui
	$("#id_cliente").val("");
	$("#nombre_cli").val("");
	$("#apellidos_cliente").val("");
	$("#telefono_cliente").val("");
	$("#mail_cliente").val("");
	$("#direccion_cliente").val("");
	$("#cedula_cliente").val("");
	$("#sexo_cliente").val("");
	$("#fecha_ingreso_cliente").val("");
 

}

function calcularDevuelta(){

	// Variable locales a utilizar
	var dev;


	// Obtener el monto suministrado por el cliente
	monto = $("#monto").val();
	// Hacel el calculo de la devuelta
	dev = monto - total;
	// Asignar dos decimales al resultado
	devuelta = dev.toFixed(2);
	// Devolver el resultado redondeado
	return devuelta;
	

}

function anadirPago(){

	// Obtener el valor de la variable cantidad
	var modo_pago = $("#opcion_pago option:selected").text();
	var monto_pagado = total;
	var monto_suministrado = $("#monto").val();
	var devuelta = $("#devuelta").text();

	// Json para ser enviado al servidor
	var dato = {		
		id_cliente: id_cliente,
		id_factura: id_factura,
		monto_pagado: monto_pagado,
		monto_suministrado: monto_suministrado,
		devuelta: devuelta,
		modo_pago: modo_pago,
				
	};

	$.ajax({
		type: "POST",
		url: "anadirPago.php",		
		data: dato, 
	})
	.done(function(data){
		//Mostrar el resultado de la operación		
		alert(data);		
				

	})
	.fail(function(){

		$("#msj").html("Error de conexión");
		$("#msj").css("color","red");
		setTimeout(function(){

			$("#msj").html("");
			$("#msj").css("color","");

		},2000);

	})
	.always(function(){
		// Siempre se ejecuta

	});


}

function limpiarTodosCampos(){

	// Limpiar todos los campo añadidos aqui
	$("#telefono").val("");
	$("#nombre_cliente").val("");	
	$("#nombre_pro").text("");
	$("#stock").text("");
	$("#precio").text("");
	$("#importe").text("");
	$("#producto").val("");
	$("#cantidad_ordenar").val("");
	$("#tdetalle_factura").html("");
	$("#no").text("0000");
	$("#subtotal").text("");
	$("#itebis").text("");
	$("#total").text("");
	$("#monto").val("");
	$("#devuelta").text("");
	$("#noregistro").text("");
	$("#anadir_items").attr('disabled', true);


}


function nuevoCliente(){

	// Asignación de valores
	var id_cliente = $("#id_cliente").val();
	var nombre = $("#nombre_cli").val();
	var apellidos = $("#apellidos_cliente").val();
	var telefono = $("#telefono_cliente").val();
	var mail = $("#mail_cliente").val();
	var direccion = $("#direccion_cliente").val();
	var cedula = $("#cedula_cliente").val();
	var sexo = $("#sexo_cliente option:selected").text();
	var fecha_ingreso = $("#fecha_ingreso_cliente").val();

	
	// Json para ser enviado al servidor
	var dato = {
		id_cliente: id_cliente,
		nombre: nombre,
		apellidos: apellidos,
		telefono: telefono,
		mail: mail,
		direccion: direccion,
		cedula: cedula,
		sexo: sexo,
		fecha_ingreso: fecha_ingreso,

				
	};

	$.ajax({
		type: "POST",
		url: "nuevoCliente.php",		
		data: dato, 
	})
	.done(function(data){

		$("#msj_nuevo_cliente").html(data);		
		$("#msj_nuevo_cliente").css("color","red");
		setTimeout(function(){

			$("#msj_nuevo_cliente").html("");
			$("#msj_nuevo_cliente").css("color","");

		},2000);			

				

	})
	.fail(function(){

		$("#msj_nuevo_cliente").html("Error de conexión");
		$("#msj_nuevo_cliente").css("color","red");
		setTimeout(function(){

			$("#msj_nuevo_cliente").html("");
			$("#msj_nuevo_cliente").css("color","");

		},2000);

	})
	.always(function(){
		// Siempre se ejecuta
	});


}


function showDialogModal(){
	// Instanciar el objecto dialog
	dialog = document.getElementsByTagName('dialog')[0];
	// Abrir el dialog de tipo modal	
	dialog.showModal();


}

function closeDialog() {
	// Instanciar el objecto dialog
	dialog = document.getElementsByTagName('dialog')[0];
	// Cerrar el dialogo
	dialog.close();
                   

}


function pasarVariableAPhp(){
	
	location.href= "../factrimpr/factrimpr.php?id_factura="+id_factura+"&nombre_cli="+nombre_cli+"";


}

