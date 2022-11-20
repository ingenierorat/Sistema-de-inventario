
/*Establecer la base de datos a trabajar en el momento*/
use inventario;

/*Crear la tabla admin_server*/
create table admin_server (
	id_server  int not null auto_increment,
    host_name  varchar(50),
    host_user  varchar(30),
    host_pass  varchar(30),
    host_db    varchar(30),
    host_status varchar(20),
    primary key (id_server)
)	engine=InnoDB;