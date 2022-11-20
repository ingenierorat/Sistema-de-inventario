$(document).ready(function(){	
 
	// Variable golbales 
	var id_pedido; 
	
	// Manejador del evento click del button nuevo
	$("#nuevo").click(function(){ 
		// Llamar la funcion que creará la tabla para infresar los nuevo Pro
		crearPedido();
		// Deshabilita los campos Detalles
		deshabitar_campo();
		// Poner el focus el primer campo  
		$("#did_pedido").focus();
		// Cambiar el texto de este DIV
		$("#ingreso").text("Crear pedido");
 
 
		// Crear el pedido
		$("#dfecha").blur(function(){

			// Varable de datos a utilizar
			    id_pedido = $('#did_pedido').val();			
			var id_proveedor = $('#did_proveedor').val();
			var fecha = $('#dfecha').val();		
					
			
			// Variable que controla el tipo de acción a ejecutar
			var nuevo = "nuevo";					

			// Array de tipo json para ser enviado
			var dato = {nuevo: nuevo, id_pedido: id_pedido, id_proveedor: id_proveedor, fecha: fecha};				

			$.ajax({
				type: "POST",
				url: "registro.class.php",		
				data: dato,
			})
			.done(function(dato){

				// Si es que si el registro se inserto correctamente
				if (dato =='si') {

					$("#msj").html("Registro insertado");
					// Deshabilitar panel de Pedido
					deshabilita_campo_pedido();
					

					setTimeout(function(){

						// Elimina el mensaje de error y limpia los campos transcurrido el tiempo asignado
						$("#msj").html("");						
						$("#did_pedido_detalle").val(id_pedido);						
						// Hibilita los campos Detalles
						habitar_campo();
						$("#did_producto").focus();

					},2000);


				 }else{

				 	$("#msj").html('Registro no insertado por varias razones');
				 	setTimeout(function(){

						// Elimina el mensaje de error transcurrido el tiempo asignado
						$("#msj").html("");
						$('#did_pedido').focus();
						

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

		// Cargar producto
		$("#did_producto").blur(function(){

			// Varable de datos a utilizar
			var id_producto = $('#did_producto').val();	
						

			// Array de tipo json para ser enviado
			var dato = {id_producto: id_producto};				

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
					
					$.each(json, function(i, item){

						// Asignar los valores retornado a cada objeto
						$('#dprecio').val(item.precio_ingreso);
								 				
					});


				}else{
					
					// Acciones a realizar si el resultado es negativo
					$('#did_producto').val("");
					$('#did_producto').focus();
					$("#msj").html("Producto no encontrado");

					setTimeout(function(){

						// Elimina el mensaje de error transcurrido el tiempo asignado
						$("#msj").html("");

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

		});

		
		
		// Hacer los calculo del importe del pedido
		$("#ddescuento").blur(function(){ 
			// Llamada a la funcción
			$("#dimporte").val(calcularImporte());
			// Preguntar si hay descuento o no
			if ($("#ddescuento").val() == "" ){
				// Asigna a cero su valor
				$("#ddescuento").val(0);

			}
				

		});



		$("#ingresar").click(function(){ 
			
			// Varable de datos a utilizar
			var id_pedido_detalle = $('#did_pedido_detalle').val();			
			var id_producto = $('#did_producto').val();
			var cantidad = $('#dcantidad').val();
			var precio = $('#dprecio').val();
			var descuento = $('#ddescuento').val();
			var importe = $('#dimporte').val();
			var estatus = $('#destatus option:selected').text();
			


			
			// Variable que controla el tipo de acción a ejecutar
			var detalle = "detalle";					

			// Array de tipo json para ser enviado
			var dato = {detalle: detalle, id_pedido_detalle: id_pedido_detalle, id_producto: id_producto, cantidad: cantidad,
			            precio: precio, descuento: descuento, importe: importe, estatus: estatus};				

			$.ajax({
				type: "POST",
				url: "registro.class.php",		
				data: dato,
			})
			.done(function(dato){

				// Si es que si el registro se inserto correctamente
				if (dato =='si') {

					$("#msj").html("Registro insertado");
					$('#did_producto').focus();
						
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
						$('#did_producto').focus();
						

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
			
			// Variable para controlar las preguntas
			var id_pedido_detalle = $("#did_pedido_detalle").val();	
				

			if (id_pedido_detalle != "") {
				// Limpaiar los campos si la condición se cumple
				$("#did_producto").val("");	
				$("#dcantidad").val("");
				$("#dprecio").val("");
				$("#ddescuento").val("0");
				$("#dimporte").val("");
				$("#destatus").val("");
				$("#did_producto").focus();
				

			}else{
				// Limpia los campos si la condición no se cumple
				$("#did_pedido").val("");
				$("#did_proveedor").val("");
				$("#dfecha").val("");
				$("#did_pedido").focus();

				
			}
			

		});

 
	});

	

	// Manejador del evento click del button eliminar
	$("#eliminar").click(function(){

		eliminarPedido();	
		// Poner el focus en el campo código
		$("#decodigo").focus();
		// Cambiar el texto de este DIV
		$("#ingreso").text("Eliminar pedido");	
		
		$("#deeliminar").click(function(){	

			// Varable de datos a utilizar
			var codigo = $("#decodigo").val();
			
			if (codigo != "") {
				
				// Array de tipo json para ser enviado
				var dato = {codigo: codigo};				

				$.ajax({
					type: "POST",
					url: "eliminarPedido.php",		
					data: dato,
				
				})
				.done(function(dato){
					
					// Condición que evalua el resultado devuelto por el servidor
					if (dato == 'si') {

						$("#msj").html('Pedido eliminado');						
						$("#msj").css("color","red");						
						
						setTimeout(function(){
							
							// Limpia el campo
							$("#decodigo").val("");								
							$("#msj").text("");
							$("#decodigo").focus();
							

						},2000);


					 }else{

					 	$("#msj").html('Pedido no encontrado');
					 	$("#msj").css("color","red");
					 	
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
	
	// Manejador del evento click del button ingrasar pedido al sistema 
	$("#ingresar_pedido_sistema").click(function(){

		// Llamar a la función que crará los objetos
		ingresarPedidoSistema();

		// Poner el focus en el campo código
		$("#decodigo").focus();
		// Cambiar el texto de este DIV
		$("#ingreso").text("Ingresar pedido");

		$("#buscar").click(function(){

			// Varable de datos a utilizar
			var codigo = $("#decodigo").val();
			
			if (codigo != "") {
				
				// Array de tipo json para ser enviado
				var dato = {id_pedido: codigo};				

				$.ajax({
					type: "POST",
					url: "cargarDetallePedido.php",		
					data: dato,
				
				})
				.done(function(dato){

					// Preguntar si trajo datos la consulta; si la misma no devuelve ningun valor. Imprime el msj
					if (dato == -1) {

						$("#msj").html("Pedido no encontrado");
						$("#msj").css("color","red");
						$("#decodigo").focus();
						setTimeout(function(){

							$("#msj").html("");
							$("#tablaRegistroIngresar").html("");
							

						},2000);

					}else{

						$("#tablaRegistroIngresar").html(dato);					


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





// Ingresar nueva pedido
function crearPedido(){

	// Variables a utilizar
	var tablainf, tabladet;
	var fieldset;
	var buttones;	

	$("#inf_pedido").text("Información del Pedido");	

	
	// Creación de la tablas a necesitar
	tablainf += "<tr><td><label class='lbl_registro'>Id: </label><input type='number' name='id_pedido' id='did_pedido' /></td></tr>";
	tablainf += "<tr><td><label class='lbl_registro'>Id Proveedor: </label><input type='number' name='id_proveedor' id='did_proveedor' /></td></tr>";	
	tablainf += "<tr><td><label class='lbl_registro'>Fecha: </label><input type='date' name='fecha' id='dfecha' /></td></tr>";
	

	tabladet += "<tr><td><label class='lbl_registro'>Id Pedido: </label><input type='number' name='id_pedido_detalle' id='did_pedido_detalle' /></td></tr>";
	tabladet += "<tr><td><label class='lbl_registro'>Id Producto: </label><input type='number' name='id_producto' id='did_producto' /></td></tr>";	
	tabladet += "<tr><td><label class='lbl_registro'>Cantidad: </label><input type='number' name='cantidad' id='dcantidad' /></td></tr>";
	tabladet += "<tr><td><label class='lbl_registro'>Precio: </label><input type='number' name='precio' id='dprecio' /></td></tr>";
	tabladet += "<tr><td><label class='lbl_registro'>Descuento: </label><input type='number' name='descuento' id='ddescuento' value=0 /></td></tr>";
	tabladet += "<tr><td><label class='lbl_registro'>Importe: </label><input type='number' name='importe' id='dimporte' /></td></tr>";
	tabladet += "<tr><td><label class='lbl_registro'>Estatus: </label><select name='estatus' id='destatus'>";
	tabladet += "<option value='espera'>En espera</option>";
	tabladet += "</select></td></tr>";	
		
	

	// Esconder los objetos
	$("#fset_pedido").show();
	$("#fset_detalle").show();
	// Limpia el contenido de la tabla
	$("#tablaRegistroEliminar").html("");
	// Limpia el objeto	
	$("#tablaRegistroIngresar").html("");	

	// Escribir las tablas creada en la página que las llamó	
	$("#tablaRegistroCrearpedinf").html(tablainf);	
	$("#tablaRegistroCrearpeddet").html(tabladet);


	// Crear los buttones
	buttones = "<input type='button' value='Ingresar Pedido.' id='ingresar' />";
	buttones += "<input type='button' value='Limpiar Camp.' id='limpiar' />";
	buttones += "<label id='msj'></label>";	
	// Escribir los buttones en el Div botones despues de la tabla ya creada
	$("#botones").html(buttones);
	

}

// Ingresar nueva pedido
function ingresarPedidoSistema(){

	// Variables a utilizar
	var tablainf;
	var fieldset;
	var buttones;

	// Escribir inforamción del pedido
	$("#inf_pedido").text("Buscar pedido");
	
	
	// Creación de la tabla Ped
	tablainf += "<tr><td><input type='number' name='codigo' id='decodigo' placeholder='Introduzca el pedido aquí' /></td></tr>";
	tablainf += "<tr><td><input type='button' name='buscar' id='buscar' value='Buscar Ped' /><label id='msj'></label></td></tr>";
	
			
	// Esconder los objetos
	$("#fset_pedido").show();
	// Ocultar el objeto
	$("#fset_detalle").hide();	
	// Limpia el contenido de la tabla
	$("#tablaRegistroEliminar").html("");
	// Limpia el objeto
	$("#botones").html("");
	// Escribir las tablas creada en la página que las llamó	
	$("#tablaRegistroCrearpedinf").html(tablainf);	
	
	

}

// Eliminar pedido
function eliminarPedido(){

	// Variables a utilizar
	var tabla;
	var buttones;	
	
	
	// Creación de la tabla Ped
	tabla += "<tr><td><input type='number' name='codigo' id='decodigo' placeholder='Intoduzca el código aquí' /></td></tr>";
	tabla += "<tr><td><input type='button' name='eliminar' id='deeliminar' value='Eliminar Ped' /><label id='msj'></label></td></tr>";	
	

	// Esconde los objetos
	$("#fset_pedido").hide();
	$("#fset_detalle").hide();
	// Limpia los botones
	$("#botones").html("");
	// Limpia el objeto	
	$("#tablaRegistroIngresar").html("");
	
	// Escribir la tabla creada en la página que la llamó
	$("#tablaRegistroEliminar").html(tabla);

		
}

// Calculará el importe de cada detalle pedido
function calcularImporte(){
	
	// Variables a utilizar
	var cantidad = $('#dcantidad').val();
	var precio = $('#dprecio').val();
	var descuento = $('#ddescuento').val();
	var importe = $('#dimporte').val();
	var imp,desc;
	

	// Caluculo correspondiente al descuento
	if (descuento == 0) {

		imp = cantidad * precio;
		return imp;

	}else if (descuento == "") {
		imp = cantidad * precio;			
		return imp;

	}else{
		imp = cantidad * precio;
		desc = (cantidad * precio) / 100 * descuento ;
		return imp - desc;
	}

	

}

// Borrar algunos campos de texto
function limpiar_campo(){
	
	$("#did_producto").val("");	
	$("#dcantidad").val("");
	$("#dprecio").val("");
	$("#ddescuento").val("0");
	$("#dimporte").val("");
	$("#destatus").val("");
	$("#msj").text("");


}

// Funciones para deshabilita los campos de texto segun la necesidad
function deshabitar_campo(){

	$("#did_pedido_detalle").attr("disabled", true);
	$("#did_producto").attr("disabled", true);	
	$("#dcantidad").attr("disabled", true);
	$("#dprecio").attr("disabled", true);
	$("#ddescuento").attr("disabled", true);
	$("#dimporte").attr("disabled", true);
	$("#destatus").attr("disabled", true);	
	$("#ingresar").attr("disabled", true);	


}

function habitar_campo(){
	
	$("#did_producto").attr("disabled", false);	
	$("#dcantidad").attr("disabled", false);
	$("#dprecio").attr("disabled", false);
	$("#ddescuento").attr("disabled", false);
	$("#dimporte").attr("disabled", false);
	$("#destatus").attr("disabled", false);
	$("#ingresar").attr("disabled", false);	


}

function deshabilita_campo_pedido(){

	$("#did_pedido").attr("disabled", true);
	$("#did_proveedor").attr("disabled", true);	
	$("#dfecha").attr("disabled", true);
	
	
}

function habilita_campo_pedido(){

	$("#did_pedido").attr("disabled", false);
	$("#did_proveedor").attr("disabled", false);	
	$("#dfecha").attr("disabled", false);
		

}  

function cargar_pedido_sistema(num,id_pro,cant,id_ped){	
	
					
	// Actuar sobre el boton seleccionado. El valor a evaluear será el enviado del servidor (num)
	switch(num){

		case 0:		
		// Carga la linea al sistema
		cargar_linea(num,id_pro,cant,id_ped);		
		break;

		case 1:		
		// Carga la linea al sistema
		cargar_linea(num,id_pro,cant,id_ped);	
		break;

		case 2:
		// Carga la linea al sistema
		cargar_linea(num,id_pro,cant,id_ped);	
		break;

		case 3:
		// Carga la linea al sistema
		cargar_linea(num,id_pro,cant,id_ped);	
		break;

		case 4:
		// Carga la linea al sistema
		cargar_linea(num,id_pro,cant,id_ped);	
		break;

		case 5:
		// Carga la linea al sistema
		cargar_linea(num,id_pro,cant,id_ped);	
		break;

		case 6:
		// Carga la linea al sistema
		cargar_linea(num,id_pro,cant,id_ped);	
		break;

		case 7:
		// Carga la linea al sistema
		cargar_linea(num,id_pro,cant,id_ped);	
		break;

		case 8:
		// Carga la linea al sistema
		cargar_linea(num,id_pro,cant,id_ped);	
		break;

		case 9:
		// Carga la linea al sistema
		cargar_linea(num,id_pro,cant,id_ped);	
		break;

		default:
		alert("Error de elección");

	}	
	
	
}

function cargar_linea(num,id_pro,cant,id_ped){

	// Array de tipo json para ser enviado
	var dato = {id_pro: id_pro, cant: cant, id_ped: id_ped};	
	
		$.ajax({
			type: "POST",
			url: "cargarLineas.php",		
			data: dato,
		})
		.done(function(dato){


			if (dato == 1) {

				switch(num){

					case 0:
					$("#cero").val("Linea registrada");
					$("#cero").attr("disabled", true);						
					break;

					case 1:
					$("#uno").val("Linea registrada");
					$("#uno").attr("disabled", true);
					break;

					case 2:
					$("#dos").val("Linea registrada");
					$("#dos").attr("disabled", true);
					break;

					case 3:
					$("#tres").val("Linea registrada");
					$("#tres").attr("disabled", true);
					break;

					case 4:
					$("#cuatro").val("Linea registrada");
					$("#cuatro").attr("disabled", true);
					break;

					case 5:
					$("#cinco").val("Linea registrada");
					$("#cinco").attr("disabled", true);
					break;

					case 6:
					$("#seis").val("Linea registrada");
					$("#seis").attr("disabled", true);
					break;

					case 7:
					$("#siete").val("Linea registrada");
					$("#siete").attr("disabled", true);
					break;

					case 8:
					$("#ocho").val("Linea registrada");
					$("#ocho").attr("disabled", true);
					break;

					case 9:
					$("#nueve").val("Linea registrada");
					$("#nueve").attr("disabled", true);
					break;

					default:
					alert("Error de elección");

				}	
				

			}else{
				// mensaje de error al usuario
				alert("Linea no registrada");
			}

			
		})
		.fail(function(){
			// En caso de error			

		})
		.always(function(){
			// Siempre se ejecuta
		});

	


}