insert into pagos () value(null,1,84,1000,1800,100,'Efectivo');
insert into pagos () value(null,1,84,1880,1986,100,'Caja');
insert into pagos () value(null,1,84,1070,1489,100,'Credito');
select * from pagos

where id_factura = 9;

delete from pagos where id_pago = 9;

select facturas.fecha, pagos.monto_pagado from pagos
inner join facturas on pagos.id_factura = facturas.id_factura
where facturas.fecha = '2016/11/17';