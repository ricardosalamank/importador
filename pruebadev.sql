
--
--Tabla codigos de campaña
--

create table codigos_campanas
(
	consecutivo serial,
	nombre varchar(300),
	descripcion text
);


INSERT INTO codigos_campanas (consecutivo, nombre, descripcion) VALUES (1, 'nueva Campana', 'prueba campana');


------tabla campañas

create table campanas
(
	consecutivo serial,
	codigo_campana int,
	nombres varchar(400),
	apellidos varchar(400),
	telefono varchar(300),
	direccion varchar(500)
);


