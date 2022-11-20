insert into productos () value(1,1,1,'22447','Pantalon','Ropa para caballeros',200,10,18,259.6,5,100,'2016-11-17');
insert into productos () value(2,1,1,'78526','Sanllon','Ropa para caballeros',200,10,18,259.6,5,100,'2016-11-17');
insert into productos () value(3,1,1,'78826','Camisa','Ropa para caballeros',200,10,18,259.6,5,100,'2016-11-17');
select * from productos;

UPDATE  productos
SET nombre='Pan', id_categoria = 2, itebis= ''
where id_producto= 3;

delete from productos where id_producto = 1;
select * from productos where codigo_barra = 6666;
select * from productos where id_producto = 1;
update productos set disponibilidad = 200 where id_producto = 2678;
update productos set disponibilidad_min = 5 where id_producto = 1;
select * from productos;

select disponibilidad_min, disponibilidad from productos
where disponibilidad <= disponibilidad_min;

select productos.id_producto, productos.codigo_barra, productos.nombre, productos.descripcion, empresas.nombre as suplidor,
productos.disponibilidad as stock
from productos
inner join empresas on productos.id_empresa = empresas.id_empresa
where productos.disponibilidad <= productos.disponibilidad_min;



select facturas.id_factura, productos.codigo_barra, productos.descripcion, productos.itebis, productos.porciento_venta, 
productos.precio_ingreso, productos.precio_venta, detalles_facturas.cantidad, detalles_facturas.importe from detalles_facturas
inner join facturas
on detalles_facturas.id_factura = facturas.id_factura
inner join productos
on detalles_facturas.id_producto = productos.id_producto
where facturas.fecha = "2016/11/17"
limit 0, 15;

