$(document).ready(function(){
	// Efecto hover sobre el menú de navegación
	$('ul li').hover(function(){
		$(this).find('ul').slideDown(100);

	}, function(){
		$(this).find('ul').slideUp(100); 
	});

	// Muestra la hora del Sistema
	horaActual();

	 

});

// Función para mostrar la hora actual del Sistema
function horaActual(){

	// Variable que contiene la Date
	var tiempo = new Date();


	// Dias de la semana	
	var dia=new Array(7);
	dia[0]="Domingo";
	dia[1]="Lunes";
	dia[2]="Martes";
	dia[3]="Miercoles";
	dia[4]="Jueves";
	dia[5]="Viernes";
	dia[6]="Sabado";

	// Meses del año		
	var mes = new Array(12);
	mes[0]="Enero";
	mes[1]="Febrero";
	mes[2]="Marzo";
	mes[3]="Abril";
	mes[4]="Mayo";
	mes[5]="Junio";
	mes[6]="Julio";
	mes[7]="Agosto";
	mes[8]="Septiembre";
	mes[9]="Octubre";
	mes[10]="Noviembre";
	mes[11]="Diciembre";

	// Hora actual	
	var hora = tiempo.getHours();
	var minuto = tiempo.getMinutes();
	var segundo = tiempo.getSeconds();
	// Escribir la fecha en el Div
	$('#fecha').text(hora +":" + minuto + ":" + segundo + " " + dia[tiempo.getDay()] + " " + tiempo.getDate() + " "+ mes[tiempo.getMonth()] + " "+ tiempo.getFullYear());
	// Llamada recusiva a si mismo
	setTimeout("horaActual()", 1000);

}