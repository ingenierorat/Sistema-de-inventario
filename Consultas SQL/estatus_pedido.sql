insert into pedidos() values(1,1,'2017/01/4');
insert into pedidos() values(2,2,'2017/01/4');
insert into pedidos() values(5,3,'2017/01/4');
insert into pedidos() values(6,1,'2017/01/4');
insert into pedidos() values(9,3,'2017/01/4');
delete from pedidos where id_pedido = 21;
select * from pedidos;



insert into detalles_pedidos() values(2,1,6,85.48,0,100,'En espera');
select * from detalles_pedidos;

select * from productos; 
select * from proveedores; 
select * from empresas;

select pedidos.id_pedido,productos.codigo_barra,detalles_pedidos.cantidad,detalles_pedidos.precio,productos.nombre,proveedores.nombre_proveedor,detalles_pedidos.importe,detalles_pedidos.estatus,pedidos.fecha
from pedidos  
inner join detalles_pedidos on pedidos.id_pedido = detalles_pedidos.id_pedido
inner join proveedores on pedidos.id_proveedor = proveedores.id_proveedor
inner join productos on detalles_pedidos.id_producto = productos.id_producto;



select pedidos.id_pedido,productos.codigo_barra,detalles_pedidos.cantidad,detalles_pedidos.precio,productos.nombre,proveedores.nombre_proveedor,detalles_pedidos.importe,detalles_pedidos.estatus,pedidos.fecha
from pedidos  
inner join detalles_pedidos on pedidos.id_pedido = detalles_pedidos.id_pedido
inner join proveedores on pedidos.id_proveedor = proveedores.id_proveedor
inner join productos on detalles_pedidos.id_producto = productos.id_producto
where pedidos.id_pedido = 22;

select productos.codigo_barra,pedidos.id_pedido,detalles_pedidos.cantidad,detalles_pedidos.precio,productos.nombre,proveedores.nombre_proveedor,detalles_pedidos.importe,detalles_pedidos.estatus,pedidos.fecha
from pedidos  
inner join detalles_pedidos on pedidos.id_pedido = detalles_pedidos.id_pedido
inner join proveedores on pedidos.id_proveedor = proveedores.id_proveedor
inner join productos on detalles_pedidos.id_producto = productos.id_producto
where productos.codigo_barra = 2678;

