select * from detalles_facturas
where id_factura = 7
limit 0,3;

insert into detalles_facturas () value(1,5,10,11.95,120);

select cantidad, (precio_ingreso * cantidad) As neto, importe, facturas.fecha
from detalles_facturas
inner join facturas
on detalles_facturas.id_factura = facturas.id_factura
inner join productos
on detalles_facturas.id_producto = productos.id_producto
where facturas.fecha = "2016/11/17";


select cantidad, (precio_ingreso * cantidad) As neto, importe, facturas.fecha
from detalles_facturas
inner join facturas
on detalles_facturas.id_factura = facturas.id_factura
inner join productos
on detalles_facturas.id_producto = productos.id_producto
where facturas.fecha between "2016/11/17" and "2016/11/30";














select facturas.id_factura, productos.codigo_barra, productos.descripcion,productos.precio_ingreso, productos.precio_venta, detalles_facturas.cantidad, detalles_facturas.importe from detalles_facturas
inner join facturas
on detalles_facturas.id_factura = facturas.id_factura
inner join productos
on detalles_facturas.id_producto = productos.id_producto
where facturas.fecha = "2016/11/17"
limit 0,10;

select count(*) as Total from detalles_facturas
inner join facturas
on detalles_facturas.id_factura = facturas.id_factura
where facturas.fecha = "2016/11/30";

select * from detalles_facturas 
inner join facturas
on detalles_facturas.id_factura = facturas.id_factura;


select detalles_facturas.id_factura, productos.codigo_barra, productos.nombre, productos.precio_venta, detalles_facturas.cantidad, productos.itebis,
       detalles_facturas.importe, facturas.fecha, clientes.nombre as nombre_cliente
from detalles_facturas
inner join productos
on detalles_facturas.id_producto = productos.id_producto
inner join clientes
on detalles_facturas.id_cliente = clientes.id_cliente
inner join facturas
on detalles_facturas.id_factura = facturas.id_factura
where facturas.id_factura = 2;

select *
from detalles_facturas
limit 0, 2;







