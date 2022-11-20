$(document).ready(function(){  

    

    $("#buscar").click(function() {
         
       //Llamar la función
       detalle_abst(0);     

   });



});




function detalle_abst(limite){

    var buscar = "buscar";

    //Json a ulizar
    var dato = {limite: limite, buscar: buscar};


    $.ajax({
        type: "POST",
        url: "detalle_abst.class.php",      
        data: dato,
    })
    .done(function(data){        

        //Bloque de codigo para validar los datos enviado del Servidor
        if (data != 'no') {

            $("#tb_detalles_abst").html(data); 

        }else{

            $("#msj").html("No se encontraron materiales para ser Reababastecido");
            $("#msj").css("color","red");
            setTimeout(function(){

                $("#msj").html("");
                $("#msj").css("color","");

             },4000);

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

function detalle_abst_paginar(limite){

    
    //Json a ulizar
    var dato = {limite: limite};


    $.ajax({
        type: "POST",
        url: "detalle_abst.class.php",      
        data: dato,
    })
    .done(function(data){
     
        $("#tb_detalles_abst").html(data);      
        

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