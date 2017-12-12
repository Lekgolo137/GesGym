DROP DATABASE IF EXISTS gesgym;

CREATE DATABASE gesgym;

USE gesgym;

-- TABLAS PRINCIPALES --

CREATE TABLE users (
	id INT(11) NOT NULL AUTO_INCREMENT,
	username VARCHAR(255) UNIQUE NOT NULL,
	password VARCHAR(255) NOT NULL,
	tipo ENUM('deportista','entrenador','administrador') NOT NULL,
	subtipo ENUM('tdu', 'pef'),
	
	PRIMARY KEY (id)
) ENGINE=INNODB DEFAULT CHARACTER SET = UTF8;

CREATE TABLE exercises (
	id INT(11) NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL,
	tipo ENUM('muscular','cardio','estiramiento') NOT NULL,
	descripcion VARCHAR(20000),
	url VARCHAR(255),
	
	PRIMARY KEY (id)
) ENGINE=INNODB DEFAULT CHARACTER SET = UTF8;

CREATE TABLE tables (
	id INT(11) NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL,
	tipo ENUM('estandar','personalizada') NOT NULL,
	descripcion VARCHAR(20000),
	
	PRIMARY KEY (id)
) ENGINE=INNODB DEFAULT CHARACTER SET = UTF8;

CREATE TABLE activities (
	id INT(11) NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL,
	descripcion VARCHAR(20000),
	dia SET ('lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'),
	hora_inicio TIME,
	hora_fin TIME,
	plazas INT(11),
	entrenador INT(11) NOT NULL,
	
	PRIMARY KEY (id),
	FOREIGN KEY (entrenador) REFERENCES users(id)
) ENGINE=INNODB DEFAULT CHARACTER SET = UTF8;

CREATE TABLE resources (
	id INT(11) NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL,
	aforo INT(11),
	descripcion VARCHAR(20000),

	PRIMARY KEY (id)
) ENGINE=INNODB DEFAULT CHARACTER SET = UTF8;

CREATE TABLE sessions (
	id INT(11) NOT NULL AUTO_INCREMENT,
	comentarios VARCHAR(20000),
	fecha_inicio DATETIME,
	fecha_fin DATETIME,
	usuario INT(11) NOT NULL,
	tabla INT(11) NOT NULL,

	PRIMARY KEY (id),
	FOREIGN KEY (usuario) REFERENCES users(id),
	FOREIGN KEY (tabla) REFERENCES tables(id)
) ENGINE=INNODB DEFAULT CHARACTER SET = UTF8;

-- TABLAS DE RELACIONES --

CREATE TABLE tables_user (
	usuario INT(11) NOT NULL,
	tabla INT(11) NOT NULL,

	PRIMARY KEY (usuario, tabla),
	FOREIGN KEY (usuario) REFERENCES users(id),
	FOREIGN KEY (tabla) REFERENCES tables(id)
)ENGINE=INNODB DEFAULT CHARACTER SET = UTF8;

CREATE TABLE activities_user (
	usuario INT(11) NOT NULL,
	actividad INT(11) NOT NULL,

	PRIMARY KEY (usuario, actividad),
	FOREIGN KEY (usuario) REFERENCES users(id),
	FOREIGN KEY (actividad) REFERENCES activities(id)
)ENGINE=INNODB DEFAULT CHARACTER SET = UTF8;

CREATE TABLE exercises_table (
	tabla INT(11) NOT NULL,
	ejercicio INT(11) NOT NULL,

	PRIMARY KEY (tabla, ejercicio),
	FOREIGN KEY (tabla) REFERENCES tables(id),
	FOREIGN KEY (ejercicio) REFERENCES exercises(id)
)ENGINE=INNODB DEFAULT CHARACTER SET = UTF8;

CREATE TABLE resources_activity (
	actividad INT(11) NOT NULL,
	recurso INT(11) NOT NULL,

	PRIMARY KEY (actividad, recurso),
	FOREIGN KEY (actividad) REFERENCES activities(id),
	FOREIGN KEY (recurso) REFERENCES resources(id)
)ENGINE=INNODB DEFAULT CHARACTER SET = UTF8;

-- PERMISOS E INSERCIONES --

grant all privileges on gesgym.* to gguser@localhost identified by "ggpass";

INSERT INTO users (username, password, tipo, subtipo) VALUES ('admin','admin','administrador',null);

INSERT INTO users (username, password, tipo, subtipo) VALUES ('juan','admin','administrador',null);
INSERT INTO users (username, password, tipo, subtipo) VALUES ('marcos','admin','administrador',null);
INSERT INTO users (username, password, tipo, subtipo) VALUES ('maria','admin','administrador',null);
INSERT INTO users (username, password, tipo, subtipo) VALUES ('jorge','admin','administrador',null);
INSERT INTO users (username, password, tipo, subtipo) VALUES ('pedro','admin','administrador',null);
INSERT INTO users (username, password, tipo, subtipo) VALUES ('miguel','admin','administrador',null);
INSERT INTO users (username, password, tipo, subtipo) VALUES ('martin','admin','administrador',null);
INSERT INTO users (username, password, tipo, subtipo) VALUES ('borja','admin','administrador',null);
INSERT INTO users (username, password, tipo, subtipo) VALUES ('laura','admin','administrador',null);
INSERT INTO users (username, password, tipo, subtipo) VALUES ('manolo','admin','administrador',null);

INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Abdominal','muscular', '', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Abdominal','muscular', '', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Abdominal','muscular', '', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Abdominal','muscular', '', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Abdominal','muscular', '', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Abdominal','muscular', '', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Abdominal','muscular', '', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Abdominal','muscular', '', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Abdominal','muscular', '', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Abdominal','muscular', '', '');

INSERT INTO tables (nombre, tipo, descripcion) values ('Aumento de volumen', 'estandar', '');
INSERT INTO tables (nombre, tipo, descripcion) values ('Aumento de volumen', 'estandar', '');
INSERT INTO tables (nombre, tipo, descripcion) values ('Aumento de volumen', 'estandar', '');
INSERT INTO tables (nombre, tipo, descripcion) values ('Aumento de volumen', 'estandar', '');
INSERT INTO tables (nombre, tipo, descripcion) values ('Aumento de volumen', 'estandar', '');
INSERT INTO tables (nombre, tipo, descripcion) values ('Aumento de volumen', 'estandar', '');
INSERT INTO tables (nombre, tipo, descripcion) values ('Aumento de volumen', 'estandar', '');
INSERT INTO tables (nombre, tipo, descripcion) values ('Aumento de volumen', 'estandar', '');
INSERT INTO tables (nombre, tipo, descripcion) values ('Aumento de volumen', 'estandar', '');
INSERT INTO tables (nombre, tipo, descripcion) values ('Aumento de volumen', 'estandar', '');

INSERT INTO activities (nombre, descripcion, dia, hora_inicio, hora_fin, plazas, entrenador) values ('Yoga', '', 'martes,jueves', '16:00:00', '18:00:00', 20, 1);
INSERT INTO activities (nombre, descripcion, dia, hora_inicio, hora_fin, plazas, entrenador) values ('Yoga', '', 'martes,jueves', '16:00:00', '18:00:00', 20, 1);
INSERT INTO activities (nombre, descripcion, dia, hora_inicio, hora_fin, plazas, entrenador) values ('Yoga', '', 'martes,jueves', '16:00:00', '18:00:00', 20, 1);
INSERT INTO activities (nombre, descripcion, dia, hora_inicio, hora_fin, plazas, entrenador) values ('Yoga', '', 'martes,jueves', '16:00:00', '18:00:00', 20, 1);
INSERT INTO activities (nombre, descripcion, dia, hora_inicio, hora_fin, plazas, entrenador) values ('Yoga', '', 'martes,jueves', '16:00:00', '18:00:00', 20, 1);
INSERT INTO activities (nombre, descripcion, dia, hora_inicio, hora_fin, plazas, entrenador) values ('Yoga', '', 'martes,jueves', '16:00:00', '18:00:00', 20, 1);
INSERT INTO activities (nombre, descripcion, dia, hora_inicio, hora_fin, plazas, entrenador) values ('Yoga', '', 'martes,jueves', '16:00:00', '18:00:00', 20, 1);
INSERT INTO activities (nombre, descripcion, dia, hora_inicio, hora_fin, plazas, entrenador) values ('Yoga', '', 'martes,jueves', '16:00:00', '18:00:00', 20, 1);
INSERT INTO activities (nombre, descripcion, dia, hora_inicio, hora_fin, plazas, entrenador) values ('Yoga', '', 'martes,jueves', '16:00:00', '18:00:00', 20, 1);
INSERT INTO activities (nombre, descripcion, dia, hora_inicio, hora_fin, plazas, entrenador) values ('Yoga', '', 'martes,jueves', '16:00:00', '18:00:00', 20, 1);

INSERT INTO resources (nombre, aforo, descripcion) values ('Pista de tenis', 200, '');
INSERT INTO resources (nombre, aforo, descripcion) values ('Pista de tenis', 200, '');
INSERT INTO resources (nombre, aforo, descripcion) values ('Pista de tenis', 200, '');
INSERT INTO resources (nombre, aforo, descripcion) values ('Pista de tenis', 200, '');
INSERT INTO resources (nombre, aforo, descripcion) values ('Pista de tenis', 200, '');
INSERT INTO resources (nombre, aforo, descripcion) values ('Pista de tenis', 200, '');
INSERT INTO resources (nombre, aforo, descripcion) values ('Pista de tenis', 200, '');
INSERT INTO resources (nombre, aforo, descripcion) values ('Pista de tenis', 200, '');
INSERT INTO resources (nombre, aforo, descripcion) values ('Pista de tenis', 200, '');
INSERT INTO resources (nombre, aforo, descripcion) values ('Pista de tenis', 200, '');

INSERT INTO sessions (comentarios, fecha_inicio, fecha_fin, usuario, tabla) values ('', '2017-11-15 16:00:00', '2017-11-15 18:00:00', 1, 1);
INSERT INTO sessions (comentarios, fecha_inicio, fecha_fin, usuario, tabla) values ('', '2017-11-15 16:00:00', '2017-11-15 18:00:00', 1, 1);
INSERT INTO sessions (comentarios, fecha_inicio, fecha_fin, usuario, tabla) values ('', '2017-11-15 16:00:00', '2017-11-15 18:00:00', 1, 1);
INSERT INTO sessions (comentarios, fecha_inicio, fecha_fin, usuario, tabla) values ('', '2017-11-15 16:00:00', '2017-11-15 18:00:00', 1, 1);
INSERT INTO sessions (comentarios, fecha_inicio, fecha_fin, usuario, tabla) values ('', '2017-11-15 16:00:00', '2017-11-15 18:00:00', 1, 1);
INSERT INTO sessions (comentarios, fecha_inicio, fecha_fin, usuario, tabla) values ('', '2017-11-15 16:00:00', '2017-11-15 18:00:00', 1, 1);
INSERT INTO sessions (comentarios, fecha_inicio, fecha_fin, usuario, tabla) values ('', '2017-11-15 16:00:00', '2017-11-15 18:00:00', 1, 1);
INSERT INTO sessions (comentarios, fecha_inicio, fecha_fin, usuario, tabla) values ('', '2017-11-15 16:00:00', '2017-11-15 18:00:00', 1, 1);
INSERT INTO sessions (comentarios, fecha_inicio, fecha_fin, usuario, tabla) values ('', '2017-11-15 16:00:00', '2017-11-15 18:00:00', 1, 1);
INSERT INTO sessions (comentarios, fecha_inicio, fecha_fin, usuario, tabla) values ('', '2017-11-15 16:00:00', '2017-11-15 18:00:00', 1, 1);

INSERT INTO tables_user VALUES (1, 1);
INSERT INTO tables_user VALUES (1, 2);
INSERT INTO tables_user VALUES (1, 3);
INSERT INTO tables_user VALUES (1, 4);
INSERT INTO tables_user VALUES (1, 5);
INSERT INTO tables_user VALUES (1, 6);
INSERT INTO tables_user VALUES (1, 7);
INSERT INTO tables_user VALUES (1, 8);
INSERT INTO tables_user VALUES (1, 9);
INSERT INTO tables_user VALUES (1, 10);

INSERT INTO activities_user VALUES (1, 1);
INSERT INTO activities_user VALUES (1, 2);
INSERT INTO activities_user VALUES (1, 3);
INSERT INTO activities_user VALUES (1, 4);
INSERT INTO activities_user VALUES (1, 5);
INSERT INTO activities_user VALUES (1, 6);
INSERT INTO activities_user VALUES (1, 7);
INSERT INTO activities_user VALUES (1, 8);
INSERT INTO activities_user VALUES (1, 9);
INSERT INTO activities_user VALUES (1, 10);

INSERT INTO exercises_table VALUES (1, 1);
INSERT INTO exercises_table VALUES (1, 2);
INSERT INTO exercises_table VALUES (1, 3);
INSERT INTO exercises_table VALUES (1, 4);
INSERT INTO exercises_table VALUES (1, 5);
INSERT INTO exercises_table VALUES (1, 6);
INSERT INTO exercises_table VALUES (1, 7);
INSERT INTO exercises_table VALUES (1, 8);
INSERT INTO exercises_table VALUES (1, 9);
INSERT INTO exercises_table VALUES (1, 10);

INSERT INTO resources_activity VALUES (1, 1);
INSERT INTO resources_activity VALUES (1, 2);
INSERT INTO resources_activity VALUES (1, 3);
INSERT INTO resources_activity VALUES (1, 4);
INSERT INTO resources_activity VALUES (1, 5);
INSERT INTO resources_activity VALUES (1, 6);
INSERT INTO resources_activity VALUES (1, 7);
INSERT INTO resources_activity VALUES (1, 8);
INSERT INTO resources_activity VALUES (1, 9);
INSERT INTO resources_activity VALUES (1, 10);