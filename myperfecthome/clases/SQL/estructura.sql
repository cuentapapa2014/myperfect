--Creacion de la BBDD bdphp
 CREATE DATABASE myperfect default character set utf8 collate utf8_unicode_ci;

--Accedemos a la BBDD creada
 use bdphp;

--Creacion del usuario userphp con contraseña clavephp y dándole todos los
--permisos en la BBDD bdphp
 GRANT ALL PRIVILEGES ON bdphp to 'userphp'@'localhost' IDENTIFIED BY 'clavephp';

--Aplicamos los privilegios
 flush privileges;

--Creación de la primera tabla de la BBDD anunciantes
 CREATE TABLE anunciantes (
    ID integer primary key auto_increment,
    nif varchar(9) NOT NULL,
    nombre varchar(40) NOT NULL,
    apellidos varchar(60) NOT NULL,
    telefono integer(9) NOT NULL,
    email varchar(50) NOT NULL
 )engine=innodb charset=utf8 collate=utf8_unicode_ci;

--Creación de la segunda tabla de la BBDD anuncios
 CREATE TABLE anuncios (
    ID integer primary key auto_increment,	
    titulo varchar(60) NOT NULL,				
    descripcion varchar(300) NOT NULL,			
    producto enum (				
	"Apartamento",				
	"Piso",					
	"Casa",
	"Bajo",
	"Rústico",
	"Industrial") NOT NULL,
    metros integer,
    habitaciones integer NOT NULL,
    aseos integer NOT NULL,
    calle varchar(40) NOT NULL,
    numero integer NOT NULL,
    planta varchar(4) NOT NULL,
    localidad varchar(30) NOT NULL,
    provincia varchar(20) NOT NULL,
    operacion enum (
	"Venta",
	"Alquiler") NOT NULL,
    precio float(8,2),
    id_anunciante integer,
    FOREIGN KEY (id_anunciante) REFERENCES anunciantes(ID)
 )engine=innodb charset=utf8 collate=utf8_unicode_ci;



