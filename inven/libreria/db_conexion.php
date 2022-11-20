<?php

 /*Datos de la conexón */ 
 $host = 'localhost';
 $user = 'root';
 $pass = '2678';
 $bd = 'inventario';  


 /*Cadena de conexión al Servidor*/
 $cn = mysqli_connect($host, $user, $pass,$bd);

 /*Si al conectarse se produce un error, entonces devolvera TRUE y, entraria en la condicional*/
 if(mysqli_connect_errno()){

    /*Imprime en pantalla este mensaje*/
    printf("Conexión fallida: %s\n ", mysqli_connect_errno());
    /*Sale del programa*/
    exit();

 }

 /*Comprobar si el servidor sigue funcionando*/
/*if (mysqli_ping($cn)) {

    printf("¡La conexión está bien!: %s\n ", mysqli_connect_errno());

} else {
   printf("Error en la conexión: %s\n", mysqli_connect_error());
}
*/

?>