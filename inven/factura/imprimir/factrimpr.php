<?php
 
//Iniciar sessión
session_start(); 

if (isset($_SESSION["usuario"]) && isset($_SESSION["nombre"]) && isset($_SESSION["apellidos"]) && isset($_SESSION["id_tipo_usuario"])) {
  
  echo "";
  
}else{

  echo "<script> window.location='../lg/login.php'; </script>";
}


//Variable que seran recibidas 
$itebis_ = 0;
$importe_ = 0;
$total_compra = 0; 


// Validar cada una de las variables enviadas al servidor
if (isset($_GET['id_factura']) && !empty($_GET['id_factura'])){  

//Obtener la variable que fe enviada al Servidor
$id = $_GET['id_factura'];


//Intanciar la clase
$venta = new Venta();
//Asignar a una variable todos los productos de la bd
$productos = $venta->items($id);


//Recorrer todos los productos
foreach ($productos as $dato_) {     

         //Sólo hará el bluque para capturar cada uno de los Items 
             
}    

//Cargar la librería
require_once('mpdf/mpdf.php');



//Código HTML que será mostrado
$codigo_html = '<!DOCTYPE html>
<html lang="en"> 
  <head>
    <meta charset="utf-8">
    <title>Factura a Imprimir</title>
    <link rel="stylesheet" href="css/style.css" media="all" />
  </head>
  <body>

    <header class="clearfix"> 
      <div id="logo">
        <img src="img/logo.png">
      </div>
      <h1>Desarrollo de Software Torres</h1>      
      <div id="company">          
        <div class="datos_company">DST</div>       
        <div class="datos_company">Dirección: Av. Venezuela #165 Los Mina Viejo</div>
        <div class="datos_company">Teléfono: 809-698-xxxx</div>
        <div class="datos_company">Cliente: '.$dato_['nombre_cliente'].'</div>
        <div class="datos_company">NCF: 00000130429456</div>
        <div class="datos_company">Factura No.: '.$id.'</div>
        <div class="datos_company">Fecha: '.$dato_['fecha'].'</div>
        <div class="datos_company">Le Atendió: '.$_SESSION['nombre']. " ".$_SESSION['apellidos'].' </div>                       
      </div>      
    </header>

    <main>
      <table>

        <thead>
          <tr>            
            <th id="_nombre">Descripción</th>
            <th id="_precio">Precio</th>
            <th id="_cantidad">Cant.</th>
            <th id="_itebis">Itebis</th>
            <th id="_importe">Total</th>
          </tr>
        </thead>

        <tbody>';             

        //Recorrer todos los productos
        foreach ($productos as $producto) {          
          //Concatenar cada un de las filas
          $codigo_html .= '<tr>                                
                                <td class="nombre">'.$producto['nombre'].'</td>
                                <td class="precio">'.$producto['precio_venta'].'</td>
                                <td class="cantidad">'.$producto['cantidad'].'</td>
                                <td class="itebis">'.$producto['itebis'].'</td>                                
                                <td class="importe">'.$producto['importe'].'</td>

                          </tr> ';
                          
                          //Calcula la suma del Importe de cada material
                          $importe_ += $producto['importe'];
                          //Calcula la suma del Itebis de cada material
                          $itebis_ += $producto['itebis'];
                          //Calcula la suma Total de la compra
                          $total_compra = $importe_ + $itebis_;
                          
           }    
 

       $codigo_html .= '                           
          
        </tbody>

      </table>

      <div class="dato_factura">
         <div id="sub_total">Sub Total: '.$importe_.'</div> 
         <div id="itebis_facturado">Itebis: '.$itebis_.'</div>
         <div id="total">Total: '.$total_compra.'</div>
         <div id="pagado">Pagado: 1000 </div>
         <div id="cambio">Cambio: 120</div>
      </div>

      <div class="informacion">
        <div class="texto1">INFORMACION:</div>
        <div class="texto2">Gracias por su compra</div>
      </div>

    </main>

    <footer>
      Factura creada con todos los derechos de autor del ING. Rafael Torres. 
    </footer>

  </body>
</html>';

//Utilización de la librería y sus respectivos comandos
$mpdf = new mPDF('c', 'A4');
//Cargar el archivo CSS de la pc
$css = file_get_contents('css/style.css');
//Cargar el archivo CSS a la librería
$mpdf->writeHTML($css, 1);
//Código HTML
$mpdf->writeHTML($codigo_html);
//Salida del Reporte
$mpdf->Output('FACTURA NO. '.$id.'.pdf', 'I');

    

  
}else{
  echo "Error, datos enviado al Servidor incorrectos.";
}








class Venta{

  
  //Constructor de la clase
  function __construct(){   

    //Data


  }


  function items($id){
    
    
    //Incluir datos de la conexión a traves de un archivo externo.
    require('../../libreria/bd_conexion.php');


    //Crear el SELECT y traer los productos que se hayan vendido
    $select = mysqli_query($conexion, "select detalles_facturas.id_factura, productos.codigo_barra, productos.nombre, productos.precio_venta,
                                      detalles_facturas.cantidad, productos.itebis, detalles_facturas.importe, facturas.fecha,
                                      clientes.nombre as nombre_cliente
                                      from detalles_facturas
                                      inner join productos
                                      on detalles_facturas.id_producto = productos.id_producto
                                      inner join clientes
                                      on detalles_facturas.id_cliente = clientes.id_cliente
                                      inner join facturas
                                      on detalles_facturas.id_factura = facturas.id_factura
                                      where facturas.id_factura ='".$id."'");


    //Pregunta si la consulta esta correcta
    if(!$select)
      die("Error, verificar la consulta sql");


    //Validar si la consulta trajo resultados
    if (mysqli_num_rows($select) > 0){


      //Crear un array
      $datos[] = array();
          
      while ($fila = mysqli_fetch_array($select)) {

        //Llenar el array
        $datos[] = $fila;

        
      } 

      
      //Libera la memoria del resultado
        mysqli_free_result($select);

       //Cierra la conexión con la base de datos 
        mysqli_close($conexion); 

        //Devuelve un arreglo de tipo Json con los datos obtenidos
        return $datos;  


    }   


  }



}



?>