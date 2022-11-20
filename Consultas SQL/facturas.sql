insert into facturas () value(null,'2016/8/17');
select * from facturas;
delete from facturas where id_factura= 17;
delete from facturas;
alter table facturas auto_increment = 1;
select max(id_factura) as Maximo, id_factura from facturas;
TRUNCATE TABLE facturas;
select * from facturas
where fecha = '2016/8/15';
select * from facturas
where fecha between '2016/8/1' and '2016/8/31';

select * from facturas;

select facturas.fecha, sum(cantidad) as cantidad, sum(importe) as monto FROM detalles_facturas
inner join facturas
on detalles_facturas.id_factura = facturas.id_factura
where facturas.fecha between '2016/11/1' and '2016/11/31';



select * FROM detalles_facturas
inner join facturas
on detalles_facturas.id_factura = facturas.id_factura
where facturas.fecha between '2016/11/1' and '2016/11/31'
limit 0, 10;

select facturas.id_factura, productos.codigo_barra, productos.descripcion, productos.precio_venta, detalles_facturas.cantidad,	     detalles_facturas.importe from detalles_facturas
inner join facturas
on detalles_facturas.id_factura = facturas.id_factura
inner join productos
on detalles_facturas.id_producto = productos.id_producto
where facturas.fecha between '2016/11/1' and '2016/11/31'
limit 0, 10;






