<?php

 /*Datos de la conexón */  
 $host = 'localhost';
 $user = 'root';
 $pass = '2678';
 $bd = 'inventario';  

 /*Crear un objeto de tipo array e inicializarlo*/
 $datos = array('on' => 'Activo', 'off' => 'Inactivo', 'error' => 'Error');
 

 /*Comprobar la cadena de conexión al Servidor*/
 if (!($cn = mysqli_connect($host, $user, $pass,$bd)))
    echo json_encode($datos['error']);

 /*Si al conectarse se produce un error, entonces devolvera TRUE y, entraria en la condicional*/
 if(mysqli_connect_errno()){

    /*Objeto a enviar*/
    echo json_encode($datos['error']);    

 }

 /*Comprobar si el servidor sigue funcionando*/
if (mysqli_ping($cn)) {

    /*Objeto a enviar*/
    echo json_encode($datos['on']);
    /*Cierra la conexión al servidor*/
    mysqli_close($cn);

}else{  

   /*Objeto a enviar*/
   echo json_encode($datos['off']);

}





?>