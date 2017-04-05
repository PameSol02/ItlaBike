create database itlabike;
use itlabike;

create table Usuario (
	usuarioId int not null auto_increment,
    nombre varchar (50),
    apellido varchar (50),
    email varchar (100),
    password varchar (100),
    foto varchar (500),
    rolId int not null,
    
    constraint pk_usuarioid primary key (usuarioId),
    constraint fk_roid foreign key (rolId) references Rol (RolId)
);

create table VendedorDireccion (
	vendedorDireccionId int not null auto_increment,
	usuarioId int not null,
    calle varchar (100),
    numero varchar (10),
    sector varchar (50),
    ciudad varchar (50),
    provincia varchar (50),
    
    constraint pk_vendedordireccionid primary key (vendedorDireccionId),
    constraint fk_usuarioid foreign key (usuarioId) references Usuario (usuarioId)
);

create table telefonoUsuario (
	telefonoUsuarioId int not null auto_increment,
	usuarioId int,
    telefono varchar (10),
    
    constraint pk_telefonousuarioid primary key (telefonoUsuarioId),
    constraint fk_telefonousuarioid foreign key (usuarioId) references Usuario (usuarioId)
);

create table anuncio (
	anuncioId int not null auto_increment,
    categoriaId int not null,
    titulo varchar (100),
    descripcion varchar (500),
    precio decimal (13,2),
    marca varchar (100),
    modelo varchar (100),
    accionId int not null,
    imagen1 varchar (500),
	imagen2 varchar (500),
	imagen3 varchar (500),
	imagen4 varchar (500),
	imagen5 varchar (500),
    
    constraint pk_anuncioid primary key (anuncioId),
    constraint fk_categoriaid foreign key (categoriaId) references Categoria (categoriaId),
    constraint fk_accionid foreign key (accionId) references Accion (accionId)
);

create table accion (
	accionId int not null auto_increment,
    accion varchar (50),
    
    constraint fk_accionId primary key (accionId)
);

create table admin (
	adminId int not null, 
    nombre varchar (50),
    apellido varchar (50),
    email varchar (50),
    password varchar (100),
    
    constraint pk_adminid primary key (adminId)
);

create table comentario (
	comentarioId int not null auto_increment,
    anuncioId int not null,
    comentario varchar (500),
    usuarioId int,
    fecha date,
    hora datetime,
    
    constraint pk_comentarioid primary key (comentarioId),
    constraint fk_anuncioid foreign key (anuncioId) references Anuncio (anuncioId),
    constraint fk_anunciousuarioid foreign key (usuarioId) references Usuario (usuarioId)
);

create table Rol (
	rolId int not null auto_increment,
    rol varchar (50),
    
	constraint pk_rolid primary key (rolId)
);

create table categoria (
	categoriaId int not null,
    categoria varchar (50),
    
    constraint pk_categoriaid primary key (categoriaId)
);

create table anuncioPubicitario (
	anuncioPublicitarioId int not null auto_increment,
	foto varchar (500),
    link varchar (500),
    
    constraint pk_anunciopublicitarioid primary key (anuncioPublicitarioId)
);