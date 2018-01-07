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
	entrenador INT(11),
	
	PRIMARY KEY (id),
	FOREIGN KEY (entrenador) REFERENCES users(id)
) ENGINE=INNODB DEFAULT CHARACTER SET = UTF8;

CREATE TABLE exercises (
	id INT(11) NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL,
	tipo ENUM('musculacion','cardio','estiramiento') NOT NULL,
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
	entrenador INT(11),
	
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
	conf BIT NOT NULL,

	PRIMARY KEY (usuario, actividad),
	FOREIGN KEY (usuario) REFERENCES users(id) ON DELETE CASCADE,
	FOREIGN KEY (actividad) REFERENCES activities(id) ON DELETE CASCADE
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
	FOREIGN KEY (actividad) REFERENCES activities(id) ON DELETE CASCADE,
	FOREIGN KEY (recurso) REFERENCES resources(id) ON DELETE CASCADE
)ENGINE=INNODB DEFAULT CHARACTER SET = UTF8;

-- PERMISOS E INSERCIONES --

grant all privileges on gesgym.* to gguser@localhost identified by "ggpass";

INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('admin','12345','administrador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('entrenador','12345','entrenador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('deportista','12345','deportista','tdu',null);

INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('juan','12345','administrador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('marcos','12345','entrenador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('maria','12345','deportista','tdu',2);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('jorge','12345','administrador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('pedro','12345','entrenador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('miguel','12345','deportista','pef',2);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('martin','12345','administrador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('borja','12345','entrenador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('laura','12345','deportista','tdu',2);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('manolo','12345','administrador',null,null);

INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Abdominales estándar','musculacion', 'Son aquellos que el movimiento “aísla” los músculos abdominales, es decir, que trabaja solo esa parte. Para hacerlos, te acuestas boca arriba con los pies apoyados en el suelo y las rodillas flexionadas. También puede ser con las piernas estiradas, elevadas o descansando en un banco. Las manos van detrás de la cabeza, ligeramente. Flexionas haciendo presión con los músculos del estómago lo más alto posible, manteniendo la zona lumbar apoyada en el suelo o colchoneta. Regresa a la posición inicial.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Abdominales con balón','musculacion', 'Se trata de un ejercicio muy interesante que te permite activar la parte inferior de los abdominales, así como también tener más fuerza en el torso por la activación de ciertos grupos musculares. Para realizar estos abdominales debes sentarte en una pelota y caminar hacia adelante para que gire por tu espalda. Dobla las caderas y las rodillas, dejando que tu cabeza y los hombros cuelguen. Coloca las manos detrás de la cabeza e inclínate hacia adelante hasta la altura de la cintura. Mantén la espalda baja contra el balón.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Abdominales reversos','musculacion', 'Sirven para aumentar la fuerza en el recto inferior del abdomen. Debes acostarte con las piernas y los brazos extendidos. Las palmas apoyadas en el piso. Eleva las piernas hasta que queden perpendiculares al techo. Baja y sube las piernas sin flexionarlas y sin que lleguen a tocar el piso. Otra opción es llevar las rodillas al pecho y estirar las piernas para que queden paralelas al suelo.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Abdominales con torsión','musculacion', 'Estos ejercicios sirven para trabajar los abdominales oblicuos, es decir, los de los laterales del cuerpo. Acuéstate boca arriba, dobla las rodillas y apoya los pies en el piso. Las manos detrás de la cabeza. Levántate como si fueras a hacer un abdominal estándar, pero al llegar arriba gira el torso hacia la derecha. Baja y repite hacia la izquierda. Recuerda siempre dejar abiertos los codos.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values (' Flexiones básicas','musculacion', 'Apóyate de tus manos, que estén un poco más abiertas que tus hombros y mantén tu cuerpo alineado. Lo primero que debería tocar el suelo es tu pecho, no tu pelvis. Debes tomar en cuenta que es crucial mantener una postura adecuada a la hora de hacer este ejercicio y mantenerte equilibrado, no quieres apoyar más peso de un lado que del otro. Si esto se hace muy difícil, puedes apoyarte de tus rodillas en vez de la punta de tus pies.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Flexiones de aplauso','musculacion', 'Es la flexión pliométrica más común. Debes empujarte del suelo y dar una palmada mientras estás en el aire. Esto, teóricamente, no es tan complicado. Mucha gente asume la velocidad por fuerza, por lo tanto hay que tener en cuenta que, el objetivo final de este ejercicio, es impulsarnos lo más alto posible, no lo más rápido posible. Recomendamos que comiences en un suelo más suave al principio, para así evitar que estampes tus dientes contra el piso.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Flexiones de Diamante','musculacion', 'De acuerdo a un estudio hecho en EE.UU., esta es la mejor manera de generar músculos en los tríceps. Como hemos mencionado antes, generar músculo ayuda a quemar grasa. Ponte en tu posición habitual de flexión y forma un diamante con tus manos, posiciónalas justo debajo de tu pecho. Asegúrate que estés recto y que estés utilizando tu abdomen.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Flexiones de Spider-Man','musculacion', 'Esta variante te ayudará a obtener el cuerpo de un superhéroe, sin necesidad de usar un traje de lycra. Cuando llegues al punto más bajo de tu flexión, levanta una de tus rodillas hacia adelante hasta que toque tu codo. Alterna este paso. Este ejercicio crea resistencia y fortalece tu equilibrio, debido al movimiento de tus piernas, sin contar que fortalece tu parte abdominal.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Sentadilla clásica','musculacion', 'Desde la posición de pies paralelos con rodillas estiradas (pero no bloqueadas) y espalda recta, flexiona tus rodillas y baja tu cadera hacia el suelo. Puedes hacer este ejercicio sin carga, como en la foto, o darle un punto extra de intensidad sujetando unas pesas a los lados.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Sentadilla frontal','musculacion', 'Como la sentadilla clásica,pero sujetando la carga por delante del cuerpo y apoyada en los hombros, buscando la posición de apoyo más cómoda posible.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values (' Sentadilla con salto','musculacion', 'Es una sentadilla clásica pero terminada en salto. Es un ejercicio excelente para trabajar tus glúteos, por la cantidad de fibras que tienes que usar para generar la potencia que te haga saltar. Además, es un movimiento muy útil para ayudarnos a adelgazar.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Sentadilla isométrica','musculacion', 'Apoya tu espalda en la pared, flexiona las rodillas y mantén la posición unos segundos, así de fácil. Las sentadillas isométricas son ideales para ganar fuerza en los cuádriceps,', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Salto de comba','cardio', 'Saltar a la comba es un ejercicio que requiere coordinación de movimientos, equilibrio, fuerza y resistencia. Es una manera muy eficaz de hacer ejercicio intenso', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Jumping Jacks','cardio', 'Es un ejercicio en el que, estando de pie, hay que saltar y separar las piernas a la vez que das una palmada sobre la cabeza, para después volver a saltar y unir las piernas, volviendo a dejar las manos abajo, a lo largo del cuerpo.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Burpees','cardio', 'Se parte de posición de pie, te agachas, te tiras al suelo haciendo una flexión de brazos, desde esa posición te reincorporas, te pones de pie, y das un salto vertical', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Mountain climbers','cardio', 'La posición de partida es con ambas manos apoyadas en el suelo, separadas la anchura de los hombros, y manteniendo los codos rectos. Las piernas se colocan una extendida y otra flexionada, apoyando las puntas de los pies en el suelo. Acercamos de forma alternativa las rodillas al pecho, haciendo un movimiento similar a como si estuviéramos corriendo, o más bien escalando.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Salto con las rodillas al pecho','cardio', 'Permaneciendo de pie, con las piernas separadas a la anchura de los hombros, se da un salto, elevando las rodillas como si quisiéramos llevarlas al pecho.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Cuello ','estiramiento', 'De pie con  la espalda recta y las manos entrelazadas por detrás de la nuca. Tira de la cabeza hacia abajo, sin encorvar el tronco, hasta que la barbilla toque el pecho.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Deltoides','estiramiento', 'Ponte de pie con la espalda recta. Pasa un brazo por detrás de la espalda sujétalo con la mano contraria por la  muñeca y tira de ella. En esa posición ladea la cabeza todo lo que puedas hacia el mismo lado hacia el que estás tirando del brazo. Notarás una gran tensión un lado de tu cuello.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Hombros','estiramiento', 'De pie pasa el brazo por delante del hombro contrario, y con la otra mano presionas sobre el brazo haciendo así el estiramiento.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Tríceps','estiramiento', 'De pie con los brazos sobre la cabeza, se sostiene un codo con la mano del otro brazo. Lentamente, tiraremos el codo hacia la nuca.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Muñeca y antebrazo','estiramiento', 'A cuatro patas y con los brazos estirados con las manos mirando hacia las rodillas, ir tirando poco a poco hacia atrás, para ir notando tensión poco a poco en las muñecas y antebrazos.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Dorsales','estiramiento', 'De pie con los brazos sobre la cabeza, se sostiene un codo con la mano del otro brazo. Lentamente inclinamos el tronco hacia el lado contrario al que sujetas el codo.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Glúteo','estiramiento', 'Túmbate en el suelo con los brazos en cruz, flexiona una pierna y gira la cadera sin separar los hombros del suelo hasta que tu rodilla flexionada toque el suelo.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Cuádriceps','estiramiento', 'De pie, coge un pie con las manos por detrás de la espalda e intenta tocar con el talón en el glúteo. Puedes apoyarte en la pared para tener mejor equilibrio.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Isquiotibiales','estiramiento', 'De pie, flexiona el tronco hacia adelante para tocar la punta de los pies. Evita doblar las rodillas.', '');

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

INSERT INTO activities_user VALUES (1, 1, 0);
INSERT INTO activities_user VALUES (1, 2, 0);
INSERT INTO activities_user VALUES (1, 3, 0);
INSERT INTO activities_user VALUES (1, 4, 0);
INSERT INTO activities_user VALUES (1, 5, 0);
INSERT INTO activities_user VALUES (1, 6, 0);
INSERT INTO activities_user VALUES (1, 7, 0);
INSERT INTO activities_user VALUES (1, 8, 0);
INSERT INTO activities_user VALUES (1, 9, 0);
INSERT INTO activities_user VALUES (1, 10, 0);

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