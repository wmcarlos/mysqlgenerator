create table ttransportista(
	transportista_id int auto_increment not null,
	rif varchar(15) not null,
	razon_social varchar(60) not null,
	direccion varchar(255) not null,
	correo varchar(100) not null,
	telefono varchar(20) not null,
	estatus int not null default 1,
	constraint pk_transportista_id primary key (transportista_id)
)engine = InnoDB;

create table tchofer(
	chofer_id int auto_increment not null,
	cedula varchar(12) not null,
	nombre varchar(30) not null,
	apellido varchar(30) not null,
	direccion varchar(255) not null,
	correo varchar(100) not null,
	telefono varchar(20) not null,
	transportista_id int not null,
	estatus int not null default 1,
	constraint pk_chofer_id primary key (chofer_id),
	constraint fk_transportista_id foreign key (transportista_id) references ttransportista (transportista_id) on update cascade on delete restrict
)engine = InnoDB;

create table vehiculo(
	vehiculo_id int auto_increment not null,
	
)engine=InnoDB;