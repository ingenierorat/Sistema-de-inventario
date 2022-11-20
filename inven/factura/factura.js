$(document).ready(function(){  
 
    //Propiedades configurada de objetos
    $("#txtbuscar").attr("type", "number");
    $("#txtbuscar").attr("disabled",false);

    
    //Eventos de los diferentes objetos
    $("#buscar").click(function() { 
         
       var opcionSelected = $('#opcion option:selected').text();
       var id_factura = $('#txtbuscar').val();
        
        
            if ($("#txtbuscar").val() != "" || $("#txtbuscar").attr("disabled")){   

                switch(opcionSelected){             

                    case 'Código': 
                        //Llamar a la función
                        buscarCodigo(id_factura);                           
                        break;                    

                    case 'Cargar Tod.':
                        //Llamar a la función
                        buscarTodo(0)                        
                        break;

                    default:
                        // Mensaje de al usuario en caso de error
                        $("#msj").css("color","red");
                        $("#msj").html("opción incorrecta");
                        // Limpia la etiqueta en el tiempo determinado
                        setTimeout(function(){

                            $("#msj").html("");

                        },2000);

                }


            }else{

                // Mensaje de al usuario en caso de error
                $("#msj").css("color","red");
                $("#msj").html("El campo no debe estar vacío");
                // Limpia la etiqueta en el tiempo determinado
                setTimeout(function(){

                    $("#msj").html("");                    

                },2000);
                                
            }   
            

   });

    
    $("#opcion").change(function(){
        // Variables a utilizar
        var texto = $("#opcion option:selected").text();
        // Switch de comprabación
        switch(texto) {             

            case 'Código':
                $("#txtbuscar").attr("disabled", false);
                $("#txtbuscar").attr("type", "number"); 
                break;                 
                                                    
                    
            case 'Cargar Tod.':
                $("#txtbuscar").val("");
                $("#txtbuscar").attr("disabled", true);
                $("#txtbuscar").attr("type", "text");                             
                break;

            default:

            // Mensaje al usuario en caso de error
            $("#msj").html("Opción incorrecta");
            $("#msj").css("color","red");
            // Limpia la etiqueta en el tiempo determinado
            setTimeout(function(){

                $("#msj").html("");
                $("#msj").css("color","");

            },2000);

                
        }


    });


       


});




function buscarCodigo(id_factura){

    
    //Json a ulizar
    var dato = {id_factura: id_factura};


    $.ajax({
        type: "POST",
        url: "factura.class.php",      
        data: dato,
    })
    .done(function(data){        

       
        //Bloque de codigo para validar los datos enviado del Servidor
        if (data != -1) {

            $("#tb_detalle_factura").html(data); 

        }else{

            $("#msj").html("La Factura no existe");
            $("#msj").css("color","red");
            setTimeout(function(){

                $("#msj").html("");
                $("#msj").css("color","");
                $("#tb_detalle_factura").html(""); 

             },2000);

        }
     
        
        
    })
    .fail(function(){

        $("#msj").html("Error en la conexión al Servidor");
        $("#msj").css("color","red");
        setTimeout(function(){

            $("#msj").html("Elija la opción a consultar");
            $("#msj").css("color","");

        },2000);
        
    })
    .always(function(){
        // Siempre se ejecuta
    
    });


}

function buscarTodo(limite){

    
    //Json a ulizar
    var dato = {limite: limite};


    $.ajax({
        type: "POST",
        url: "factura.class.php",      
        data: dato,
    })
    .done(function(data){
     
        //Bloque de codigo para validar los datos enviado del Servidor
        if (data != -1) {

            $("#tb_detalle_factura").html(data); 

        }else{

            $("#msj").html("No existe Factura");
            $("#msj").css("color","red");
            setTimeout(function(){

                $("#msj").html("");
                $("#msj").css("color","");
                $("#tb_detalle_factura").html(""); 

             },2000);

        }     
        

    })
    .fail(function(){

        $("#msj").html("Error en la conexión al Servidor");
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

function imprimir_factura(id){


   //Asignar el lugar donde se abrirá la página.
   location.target="contenido";
   //Llamar la página la cual imprimirá la factura y a la vez pe pasamos el id de la factura a Imprimir.
   location.href="imprimir/factrimpr.php?id_factura="+id+"";


}






    



