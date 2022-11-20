insert into usuarios () value(1,1,'Rafael','Torres Paulino', 'rtorres','2678','2016/08/22');
insert into usuarios () value(2,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
insert into usuarios () value(3,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
insert into usuarios () value(4,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
insert into usuarios () value(5,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
insert into usuarios () value(6,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
insert into usuarios () value(7,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
insert into usuarios () value(8,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
insert into usuarios () value(9,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
insert into usuarios () value(10,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
insert into usuarios () value(11,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
insert into usuarios () value(12,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
insert into usuarios () value(13,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
insert into usuarios () value(14,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
insert into usuarios () value(15,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
insert into usuarios () value(16,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
insert into usuarios () value(17,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
insert into usuarios () value(18,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
insert into usuarios () value(19,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
insert into usuarios () value(20,2,'Prueba','En el Sistema', 'prueba','2678','2016/08/22');
select * from usuarios;
delete from usuarios where id_usuario = 4;


update usuarios set nombre = 'Juan' where id_usuario = 2;
delete from usuarios where usuario = 'c.mercedes' && clave = '1122' && id_tipo_usuario= 2  ;
select * from usuarios where usuario = 'prueba' && clave = '2678';