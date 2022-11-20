insert into empresas () value(1,'Mercasid','Ventas al por mayor','526-4578-8974','Av. Obando','mercasidca@gsid.com');
insert into empresas () value(2,'Ramos','Ventas al por mayor','526-4578-8974','Av. Obando','mercasidca@gsid.com');
insert into empresas () value(3,'Cola Cola','Ventas al por mayor','526-4578-5689','Av. Jose Marti','inf@gcocacola.com');
insert into empresas () value(4,'La Fabril','Ventas al por mayor','526-4578-6699','Av. Heroes','info@fabril.com');
select * from empresas;
delete from empresas where id_empresa = 2;
update empresas set nombre='man' where id_empresa = 1;