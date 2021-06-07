DROP DATABASE IF EXISTS aulatecnologia;
CREATE DATABASE aulatecnologia
CHARACTER SET utf8
COLLATE utf8_spanish_ci;

use aulatecnologia;


DROP TABLE IF EXISTS Empresa_externa;

CREATE TABLE Empresa_externa(

id_empresa int(13) primary key auto_increment,
Nombre varchar(12) not null,
email varchar(100) not null unique,
Apellidos varchar(30) not null

);


DROP TABLE IF EXISTS Coordinador;

CREATE TABLE Coordinador(

id_coordinador int(13)  primary key auto_increment,
Dni varchar(12) not null,
Nombre varchar(12) not null,
Apellidos varchar(30) not null,
email varchar(100) not null unique,
Fecha_ingreso date not null,
Fecha_baja date,
passcoordinador varchar(250),
idEmpresaexterna int(13) default null,


 FOREIGN KEY (idEmpresaexterna) REFERENCES Empresa_externa(id_empresa) on delete set null on update cascade
 
 

);

DROP TABLE IF EXISTS Profesor;

CREATE TABLE Profesor(

id_profesor int(13) primary key auto_increment,
Dni varchar(12) not null,
Nombre varchar(12) not null,
Apellidos varchar(30) not null,
email varchar(100) not null unique,
passprofesor varchar(250),
idcoordinador int(13) default null,
FOREIGN KEY (idcoordinador) REFERENCES Coordinador(id_coordinador) on delete set null on update cascade

);




DROP TABLE IF EXISTS Incidencia;

CREATE TABLE Incidencia(

Id_incidencia int(13)  primary key auto_increment,
Naula int(255) not null,
Clase varchar(100) not null,
Fecha_alta date not null,
Problema varchar(300) not null,
Fecha_reparacion date,
Solucionado char default 'N',
idEmpresaexterna int(13) default null,
idProfesor int(13) default null,
idCoordinador int(13) default null,

 FOREIGN KEY (idEmpresaexterna) REFERENCES Empresa_externa(id_empresa) on delete  set null on update cascade,
 FOREIGN KEY (idCoordinador) REFERENCES Coordinador(id_coordinador) on delete  set null on update cascade,
 FOREIGN KEY (idProfesor) REFERENCES Profesor(id_profesor) on delete  set null on update cascade

);

DROP TABLE IF EXISTS Usuariosadmin;

CREATE TABLE Usuariosadmin(

Idadmin int(13)  primary key auto_increment,
nombre varchar(20) unique,
email varchar(100) unique,
pass varchar(250)


);

INSERT INTO Usuariosadmin(nombre,email,pass) VALUES('admin','laureguillen93@gmail.com',md5('Admin1'));





