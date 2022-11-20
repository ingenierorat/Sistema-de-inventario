
<?php
// Iniciar la sessión
session_start();
if (isset($_SESSION["usuario"]) && isset($_SESSION["nombre"]) && isset($_SESSION["apellidos"]) && isset($_SESSION["id_tipo_usuario"])) {
	
	echo "";
	
}else{
	echo "<script> window.location='../lg/login.php'; </script>";
}

 
?>


<!DOCTYPE html>  
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Crear Factura</title>

	<link rel="stylesheet" type="text/css" href="factr.css">
	<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="factr.js"></script>
	
  
</head>             
 
<body>  

	<div id="contenedorGeneral"> 
		
		<div id="frmRegistro">		
				<fieldset id='fset_factura'>				
					<legend id='inf_factura'>Datos Factura</legend>					
					<p>
						<label class="nombre_campo">Telefono</label><input type='text' name='telefono' id='telefono' />
						<input id="nuevo_cliente" type="button" name="nuevo_cliente" value="Nuevo"><label id="msj"></label>
						<label id="no_factura">No. Factura</label><label id="no">0000</label>
					</p>

					<p><label class="nombre_campo">Nombre completo</label><input type='text' name='nombre_cliente' id='nombre_cliente' /></p>
					
					<p>
						<label class="nombre_campo">Código barra</label><input type='text' name='prodcuto' id='producto' />
						<label id="nombre">Nombre</label><label id="nombre_pro"></label>
						<label id="stock_txt">Stock</label><label id="stock"></label>
						<label id="precio_txt">Precio</label><label id="precio"></label>
				 	</p>

					<p> 
						<label class="nombre_campo">Cantidad</label>
						<input type='number' name='cantidad_ordenar' id='cantidad_ordenar' value='' />
						<label id="importe_txt">Importe</label><label id='importe'></label>
					</p>

					 

					<p> 
						<input type='button' name='anadir_items' id='anadir_items' value="Añadir Items" />
						<label id="noregistro_txt">No. Registros</label><label id='noregistro'></label>

					</p>
					
					 

					<fieldset id='fset_pantalla'>				
						<legend id='inf_pantalla'>Facturación</legend>
						<p><label class="facturacion" id="subtotal_txt">SUB TOTAL</label><label id="subtotal"></label></p>
						<p><label class="facturacion" id="itebis_txt">ITEBIS 18%</label><label id="itebis"></label></p>
						<p><label class="facturacion" id="total_txt">TOTAL</label><label id="total"></label></p>
											
				    </fieldset>	  
			    
					
				</fieldset>

				<fieldset id='fset_detalle_factura'>				
					<legend id='inf_detalle_factura'>Detalles de la Factura</legend>
					<table id="tdetalle_factura"></table>	
																					
				</fieldset>						
				


				<fieldset id='fset_pago'>								
					<legend id='inf_pago'>Opciones de pago</legend>
					
					<p><label class="pagos" id="opcion_pago_txt">MODO DE PAGO</label>
						<select id="opcion_pago">
						<option value="null" selected>Elija una Opción</option>
						<option value="tcredito">Tarjeta Crédito</option>
						<option value="efectivo">Efectivo</option>
						<option value="cheques">Cheques</option>
						</select>
					</p>
					<p><label class="pagos">MONTO</label><input type='number' name='monto' id='monto' /></p>
					<p><label class="pagos">CAMBIO</label><label id="devuelta"></label></p>
					<p><input type='button' name='pagar' id='pagar' value="Pagar" /></p>

				<div id="caja_imprimir">

					<a id="imprimir" href="javascript:pasarVariableAPhp()" target="contenido">Imprimir</a>			

				</div>	
										
				</fieldset>	

										
						
		</div>	

		
	 <dialog name="dialog">
			<label id="texto_cli">Nuevo cliente</label>			  
			<p><input id="id_cliente" type='number' value='' placeholder="Código" /></p>
			<p><input id="nombre_cli" type='text' value='' placeholder="Nombre" /></p>
			<p><input id="apellidos_cliente" type='text' value='' placeholder="Apellidos" /></p>
			<p><input id="telefono_cliente" type='text' value='' placeholder="Teléfono" /></p>
			<p><input id="mail_cliente" type='text' value='' placeholder="Mail" /></p>
			<p><textarea id="direccion_cliente" type='text' placeholder="Dirección"></textarea></p>
			<p><input id="cedula_cliente" type='text' value='' placeholder="Cédula" /></p>
			<p><select id="sexo_cliente">				
				<option value="m" selected>M</option>
				<option value="f">F</option>
			</select></p>
			<p><input id="fecha_ingreso_cliente" type='date' /></p>
			<p><button id="ingresar">Ingresar</button></p>			
			<p><button id="cerrar">Salir</button><label id="msj_nuevo_cliente"></label></p>

	 </dialog>

			


	</div>	




</body>
</html>