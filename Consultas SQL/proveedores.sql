insert into proveedores () value(1,1,'Pedro','Veras','859-568-4578','pedro@gmail.com','056-0089748-4','m','2016/06/09');
insert into proveedores () value(2,4,'Ramos','Castro','809-568-4578','Rmoas@gmail.com','056-0669748-4','m','2016/06/09');
insert into proveedores () value(3,1,'Juan','Pulio','849-568-4578','Juna@gmail.com','056-0089968-4','m','2016/06/09');
insert into proveedores () value(4,2,'Sandy','Veras','809-568-4578','sandy@gmail.com','056-0022748-4','m','2016/06/09');
insert into proveedores () value(5,3,'Antonio','Gonzales','859-588-4578','antonio@gmail.com','056-0549748-4','m','2016/06/09');
insert into proveedores () value(6,1,'Yudith','Reyes','859-566-4578','yudith@gmail.com','056-0089578-4','f','2016/06/09');
select * from proveedores;
delete from proveedores where id_proveedor = 1;

update proveedores
set nombre= 'pan'
where id_proveedor = 5;
