create database itlabike;
use itlabike;

create table Rol (
	rolId int not null auto_increment,
    rol varchar (50),
    
	constraint pk_rolid primary key (rolId)
);

create table Usuario (
	usuarioId int not null auto_increment,
    nombre varchar (50),
    apellido varchar (50),
    email varchar (100),
    password varchar (100),
    foto varchar (500),
    rolId int not null,
    telefono varchar (15),
    
    constraint pk_usuarioid primary key (usuarioId),
    constraint fk_roid foreign key (rolId) references Rol (RolId)
);


create table UsuarioDireccion (
	UsusarioDireccionId int not null auto_increment,
	usuarioId int not null,
    calle varchar (100),
    numero varchar (10),
    sector varchar (50),
    ciudad varchar (50),
    provincia varchar (50),
    pais varchar (100),
    
    constraint pk_usuariodireccionid primary key (usuariorDireccionId),
    constraint fk_usuarioid foreign key (usuarioId) references Usuario (usuarioId)
);

select * from usuariodireccion;

delete from usuarioDireccion where usuarioDireccionId > 0;

create table accion (
	accionId int not null auto_increment,
    accion varchar (50),
    
    constraint fk_accionId primary key (accionId)
);

insert into accion (accion) values ('Alquilar');
select * from accion;

create table categoria (
	categoriaId int not null,
    categoria varchar (50),
    
    constraint pk_categoriaid primary key (categoriaId)
);

create table anuncio (
	anuncioId int not null auto_increment,
    categoria varchar (50),
    titulo varchar (100),
    descripcion varchar (500),
    precio decimal (13,2),
    marca varchar (100),
    modelo varchar (100),
    accionId int not null,
    fecha timestamp default current_timestamp on update current_timestamp,
    usuarioId int,
   
    constraint pk_anuncioid primary key (anuncioId),
    constraint fk_accionid foreign key (accionId) references Accion (accionId),
    constraint pk_usuarioidanuncio foreign key (usuarioId) references Usuario (usuarioId)
);

DELETE FROM Anuncio WHERE anuncioId = 1;

select * from anuncio;


create table anuncioImage (
	anuncioImageId int not null auto_increment,
    image varchar (500),
    anuncioId int not null,
    
    constraint pk_anuncionimageid primary key (anuncioImageId),
    constraint fk_anuncioidimage foreign key (anuncioId) references Anuncio (anuncioId)
);

select * from anuncioImage;
select * from anuncio;

delete from anuncio where anuncioid > 0;


select * from anuncio;

select anuncio.anuncioId, anuncio.titulo, anuncio.descripcion, anuncio.precio, 
anuncio.marca, anuncio.modelo, anuncio.accionId, max(anuncioImage.image) as foto
from anuncio inner join anuncioImage on (anuncio.anuncioId = anuncioImage.anuncioId)
group by anuncio.anuncioId;

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

drop table comentario;

create table anuncioPubicitario (
	anuncioPublicitarioId int not null auto_increment,
	foto varchar (500),
    link varchar (500),
    
    constraint pk_anunciopublicitarioid primary key (anuncioPublicitarioId)
);

UPDATE Anuncio set categoria = '{$anuncio->categoria}', titulo = '{$anuncio->titulo}', descripcion = '{$anuncio->descripcion}', 
precio = '900', marca = '{$anuncio->marca}', modelo = '{$anuncio->modelo}', anuncioId = '1' 
WHERE anuncioId = 8;

select * from anuncio;