$(document).ready(function(){  
 
   
    //Ocultar el elemento
    $("#mes").hide();  

    //Evento del boton buscar
    $("#buscar").click(function() {

        //Variable a utilizar
        var texto_opcion = $("#opcion_venta option:selected").text();

        switch(texto_opcion)
        {
            case "Día":
            if ($("#dia").val() != "") {
                //Hacer la consulta por día
                buscar_dia();

            }else{
                
                $("#msj").html("Debes introducir una fecha");
                //Apliar un Objeto Json a la propiedad
                $("#msj").css({
                    color: 'red'            
                });

                setTimeout(function(){
                //Borrar los valores establecidos a los Objetos
                $("#msj").html("");
                $("#msj").css({                    
                    color: ''                
                });

                },2000);
            }                       
            break;

            case "Mes":
            if ($("#dia").val() != "" && $("#mes").val() != "") {
                //Hacer la consulta por intervalo de tiempo
                buscar_mes();

            }else{
                
                $("#msj").html("Debes introducir dos fechas");
                //Apliar un Objeto Json a la propiedad
                $("#msj").css({
                    color: 'red'            
                });

                setTimeout(function(){
                //Borrar los valores establecidos a los Objetos
                $("#msj").html("");
                $("#msj").css({                    
                    color: ''                
                });

                },2000);
            }            
                       
            break;

            default:
            $("#msj").html("Opción incorrecta");
            //Apliar un Objeto Json a la propiedad
            $("#msj").css({
                color: 'red'            
            });

            setTimeout(function(){
                //Borrar los valores establecidos a los Objetos
                $("#msj").html("");
                $("#msj").css({
                    color: ''                
                 });

            },2000);
            
            break;


        }
        
        
    });

    //Evento del objeto select
    $("#opcion_venta").change(function() {
        
        var texto_opcion = $("#opcion_venta option:selected").text();

        switch(texto_opcion)
        {
            case "Día":
            $("#mes").hide();            
            break;

            case "Mes":
            $("#mes").show();            
            break;

            default:
            $("#msj").html("Opción incorrecta");
            //Apliar un Objeto Json a la propiedad
            $("#msj").css({
                color: 'red'            
            });

            setTimeout(function(){
                //Borrar los valores establecidos a los Objetos
                $("#msj").html("");
                $("#msj").css({
                    color: ''                
                 });

            },2000);
            
            break;


        }


    });




});

//Extrae de la BDD la consulta de una fecha específica del usuario
function buscar_dia(){

                
                     
    // Variable que controla el tipo de acción a ejecutar
    var neto, importe, cantidad;
    var cantidad_final = 0;
    var neto_final = 0;
    var importe_final = 0;
    var venta_dia = "dia";
    var fecha_dia = $('#dia').val();
                      

    // Array de tipo json para ser enviado
    var dato = {venta_dia: venta_dia, fecha_dia: fecha_dia};              

    $.ajax({

        type: "POST",
        url: "venta.class.php",      
        data: dato,

    })
    .done(function(data){

                  
        //Crear un objeto Json
        var json = JSON.parse(data);
                                 
        if (json.length > 0) {

         //Mostrar el detalle de la venta buscada   
         detalle_venta_dia(0);
            
            //Extraer los campo del objeto
            $.each(json, function(i, item){

                //Asignar cada valor a su item correpondiente
                $('#fecha').text(json[i+ 1].fecha);              
                cantidad = parseInt(json[i + 1].cantidad);
                neto = parseFloat(json[i + 1].neto); 
                importe = parseFloat(json[i + 1].importe);
                //Hacer calculos correspondiente con cada variable
                cantidad_final = cantidad_final + cantidad;            
                neto_final = neto_final + neto;
                importe_final = importe_final + importe;
                //Hacer la resta correspondiente de estas dos variables   
                ganancias =parseFloat(importe_final - neto_final);
                //Escribir el resultado redondeado a los id correspondientes
                $('#cantidad').text(cantidad_final); 
                $('#monto_total').text(importe_final.toFixed(2)); 
                $('#ganancia').text(ganancias.toFixed(2));
                    
                                                       
                       
            });
        

        }else{

            $("#msj").html("No contiene datos la Consulta");
            //Apliar un Objeto Json a la propiedad
            $("#msj").css({
                color: 'red'            
            });

            setTimeout(function(){
                //Borrar los valores establecidos a los Objetos
                $("#msj").html("");
                $("#msj").css({
                    color: ''                
                 });

            },2000);
        }
        
                     

    })
    .fail(function(){

        $("#msj").html("Error al conectar al Servidor");
        //Apliar un Objeto Json a la propiedad
        $("#msj").css({
            color: 'red'            
        });

        setTimeout(function(){

            //Borrar los valores establecidos a los Objetos
            $("#msj").html("");
            $("#msj").css({
                color: ''                
            });

    },2000);
    
    })
    .always(function(){
    // Siempre se ejecuta
    });
             

}

//Extrae de la BDD la consulta de un intervalo de fecha elegido por el usuario
function buscar_mes(){

    var neto, importe, cantidad;
    var cantidad_final = 0;
    var neto_final = 0;
    var importe_final = 0;          
    var venta_mes = "mes";
    var fecha_dia = $('#dia').val();
    var fecha_mes = $('#mes').val();                      

    //Array de tipo json para ser enviado
    var dato = {venta_mes: venta_mes, fecha_dia: fecha_dia, fecha_mes: fecha_mes};              

    $.ajax({
        type: "POST",
        url: "venta.class.php",      
        data: dato,

    })
    .done(function(data){

        
        // Crear un objeto Json
        var json = JSON.parse(data);
               
        
        if (json.length > 0) {

         //Mostrar el detalle de la venta buscada   
         detalle_venta_mes(0);

            // Extrael los campo del objeto
            $.each(json, function(i, item){

                // Asignar los valores cada objeto
                $('#fecha').text("Desde " + $('#dia').val() + " Hasta " + $('#mes').val());
                cantidad = parseInt(json[i + 1].cantidad);
                neto = parseFloat(json[i + 1].neto); 
                importe = parseFloat(json[i + 1].importe);
                //Hacer calculos correspondiente con cada variable
                cantidad_final = cantidad_final + cantidad;            
                neto_final = neto_final + neto;
                importe_final = importe_final + importe;
                //Hacer la resta correspondiente de estas dos variables   
                ganancias =parseFloat(importe_final - neto_final);
                //Escribir el resultado redondeado a los id correspondientes
                $('#cantidad').text(cantidad_final); 
                $('#monto_total').text(importe_final.toFixed(2)); 
                $('#ganancia').text(ganancias.toFixed(2));
               
                                                             
                        
            });

            


        }else{

            $("#msj").html("No contiene datos la Consulta");
            //Apliar un Objeto Json a la propiedad
            $("#msj").css({
                color: 'red'            
            });

            setTimeout(function(){
                //Borrar los valores establecidos a los Objetos
                $("#msj").html("");
                $("#msj").css({
                    color: ''                
                 });

            },2000);
        }
        
                     

    })
    .fail(function(){

        $("#msj").html("Error al conectar al Servidor");
        //Apliar un Objeto Json a la propiedad
        $("#msj").css({
            color: 'red'            
        });

        setTimeout(function(){

            //Borrar los valores establecidos a los Objetos
            $("#msj").html("");
            $("#msj").css({
                color: ''                
            });

    },2000);
    
    })
    .always(function(){
    // Siempre se ejecuta
    });


}

//Función que permite hacer la búsqueda detallada de todos los elementos vendidos por única fecha.
function detalle_venta_dia(limite){

    var fecha_dia = $("#dia").val();
    var dato = {limite: limite, fecha_dia: fecha_dia};


    $.ajax({
        type: "POST",
        url: "detalle_venta_dia.class.php",      
        data: dato,
    })
    .done(function(data){
     
        $("#tb_detalles_venta").html(data);      
        

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

//Función que permite hacer la búsqueda detallada de todos los elementos vendidos entre un intervalo de fecha
function detalle_venta_mes(limite){

    var fecha_dia = $("#dia").val();
    var fecha_mes = $("#mes").val();
    var dato = {limite: limite, fecha_dia: fecha_dia, fecha_mes: fecha_mes};


    $.ajax({
        type: "POST",
        url: "detalle_venta_mes.class.php",      
        data: dato,
    })
    .done(function(data){
     
        $("#tb_detalles_venta").html(data);      
        

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