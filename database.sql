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
	FOREIGN KEY (usuario) REFERENCES users(id) ON DELETE CASCADE,
	FOREIGN KEY (tabla) REFERENCES tables(id) ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARACTER SET = UTF8;

-- TABLAS DE RELACIONES --

CREATE TABLE tables_user (
	usuario INT(11) NOT NULL,
	tabla INT(11) NOT NULL,

	PRIMARY KEY (usuario, tabla),
	FOREIGN KEY (usuario) REFERENCES users(id) ON DELETE CASCADE,
	FOREIGN KEY (tabla) REFERENCES tables(id) ON DELETE CASCADE
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
	FOREIGN KEY (tabla) REFERENCES tables(id) ON DELETE CASCADE,
	FOREIGN KEY (ejercicio) REFERENCES exercises(id) ON DELETE CASCADE
)ENGINE=INNODB DEFAULT CHARACTER SET = UTF8;

CREATE TABLE resources_activity (
	actividad INT(11) NOT NULL,
	recurso INT(11) NOT NULL,

	PRIMARY KEY (actividad, recurso),
	FOREIGN KEY (actividad) REFERENCES activities(id) ON DELETE CASCADE,
	FOREIGN KEY (recurso) REFERENCES resources(id) ON DELETE CASCADE
)ENGINE=INNODB DEFAULT CHARACTER SET = UTF8;

-- PERMISOS Y USUARIOS DE PRUEBA --

grant all privileges on gesgym.* to gguser@localhost identified by "ggpass";

INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('admin','12345','administrador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('entrenador','12345','entrenador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('deportista','12345','deportista','tdu',null);

-- DATOS DE EJEMPLO --

INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('Juan','12345','administrador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('Marcos','12345','entrenador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('María','12345','deportista','tdu',5);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('Jorge','12345','administrador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('Pedro','12345','entrenador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('Miguel','12345','deportista','pef',8);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('Martín','12345','administrador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('Borja','12345','entrenador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('Laura','12345','deportista','tdu',11);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('Manolo','12345','administrador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('Alex','12345','entrenador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('Natalia','12345','deportista','pef',14);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('Lucía','12345','administrador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('Sergio','12345','entrenador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('David','12345','deportista','tdu',17);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('Lorena','12345','administrador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('Carlos','12345','entrenador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('Alicia','12345','deportista','pef',20);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('José','12345','administrador',null,null);
INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES ('Mónica','12345','entrenador',null,null);

INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Abdominales estándar','musculacion', 'Son aquellos que el movimiento “aísla” los músculos abdominales, es decir, que trabaja solo esa parte. Para hacerlos, te acuestas boca arriba con los pies apoyados en el suelo y las rodillas flexionadas. También puede ser con las piernas estiradas, elevadas o descansando en un banco. Las manos van detrás de la cabeza, ligeramente. Flexionas haciendo presión con los músculos del estómago lo más alto posible, manteniendo la zona lumbar apoyada en el suelo o colchoneta. Regresa a la posición inicial.', 'rr1QGvttEn8');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Abdominales con balón','musculacion', 'Se trata de un ejercicio muy interesante que te permite activar la parte inferior de los abdominales, así como también tener más fuerza en el torso por la activación de ciertos grupos musculares. Para realizar estos abdominales debes sentarte en una pelota y caminar hacia adelante para que gire por tu espalda. Dobla las caderas y las rodillas, dejando que tu cabeza y los hombros cuelguen. Coloca las manos detrás de la cabeza e inclínate hacia adelante hasta la altura de la cintura. Mantén la espalda baja contra el balón.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Abdominales reversos','musculacion', 'Sirven para aumentar la fuerza en el recto inferior del abdomen. Debes acostarte con las piernas y los brazos extendidos. Las palmas apoyadas en el piso. Eleva las piernas hasta que queden perpendiculares al techo. Baja y sube las piernas sin flexionarlas y sin que lleguen a tocar el piso. Otra opción es llevar las rodillas al pecho y estirar las piernas para que queden paralelas al suelo.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Abdominales con torsión','musculacion', 'Estos ejercicios sirven para trabajar los abdominales oblicuos, es decir, los de los laterales del cuerpo. Acuéstate boca arriba, dobla las rodillas y apoya los pies en el piso. Las manos detrás de la cabeza. Levántate como si fueras a hacer un abdominal estándar, pero al llegar arriba gira el torso hacia la derecha. Baja y repite hacia la izquierda. Recuerda siempre dejar abiertos los codos.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Flexiones básicas','musculacion', 'Apóyate de tus manos, que estén un poco más abiertas que tus hombros y mantén tu cuerpo alineado. Lo primero que debería tocar el suelo es tu pecho, no tu pelvis. Debes tomar en cuenta que es crucial mantener una postura adecuada a la hora de hacer este ejercicio y mantenerte equilibrado, no quieres apoyar más peso de un lado que del otro. Si esto se hace muy difícil, puedes apoyarte de tus rodillas en vez de la punta de tus pies.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Flexiones de aplauso','musculacion', 'Es la flexión pliométrica más común. Debes empujarte del suelo y dar una palmada mientras estás en el aire. Esto, teóricamente, no es tan complicado. Mucha gente asume la velocidad por fuerza, por lo tanto hay que tener en cuenta que, el objetivo final de este ejercicio, es impulsarnos lo más alto posible, no lo más rápido posible. Recomendamos que comiences en un suelo más suave al principio, para así evitar que estampes tus dientes contra el piso.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Flexiones de Diamante','musculacion', 'De acuerdo a un estudio hecho en EE.UU., esta es la mejor manera de generar músculos en los tríceps. Como hemos mencionado antes, generar músculo ayuda a quemar grasa. Ponte en tu posición habitual de flexión y forma un diamante con tus manos, posiciónalas justo debajo de tu pecho. Asegúrate que estés recto y que estés utilizando tu abdomen.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Flexiones de Spider-Man','musculacion', 'Esta variante te ayudará a obtener el cuerpo de un superhéroe, sin necesidad de usar un traje de lycra. Cuando llegues al punto más bajo de tu flexión, levanta una de tus rodillas hacia adelante hasta que toque tu codo. Alterna este paso. Este ejercicio crea resistencia y fortalece tu equilibrio, debido al movimiento de tus piernas, sin contar que fortalece tu parte abdominal.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Sentadilla clásica','musculacion', 'Desde la posición de pies paralelos con rodillas estiradas (pero no bloqueadas) y espalda recta, flexiona tus rodillas y baja tu cadera hacia el suelo. Puedes hacer este ejercicio sin carga, como en la foto, o darle un punto extra de intensidad sujetando unas pesas a los lados.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Sentadilla frontal','musculacion', 'Como la sentadilla clásica,pero sujetando la carga por delante del cuerpo y apoyada en los hombros, buscando la posición de apoyo más cómoda posible.', '');
INSERT INTO exercises (nombre, tipo, descripcion, url) values ('Sentadilla con salto','musculacion', 'Es una sentadilla clásica pero terminada en salto. Es un ejercicio excelente para trabajar tus glúteos, por la cantidad de fibras que tienes que usar para generar la potencia que te haga saltar. Además, es un movimiento muy útil para ayudarnos a adelgazar.', '');
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

INSERT INTO resources (nombre, aforo, descripcion) values ('Pista de tenis', 50, 'Pista de tenis ubicada en la esquina noroeste del complejo deportivo, cuenta con un pequeño almacén donde se guardan los materiales.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Piscina', 40, 'Piscina olímpica cubierta ubicada a la derecha de la entrada del complejo deportivo, cuenta con vestuarios y duchas, así como con un almacén.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Pista de atletismo', 200, 'Pista de atletismo ubicada en la zona central del complejo deportivo, cuenta con varios almacenes y gradas.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Gimnasio', 100, 'Gimnasio de uso libre principal, ubicado destrás de la entrada al complejo deportivo, cuenta con la mayoría de máquinas de ejercicios individuales, excepto musculación.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Sala de yoga', 20, 'Sala de yoga ubicada a la izquierda del complejo deportivo, no tiene almacén.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Pista de badminton', 30, 'Pista de badminton ubicada en la esquina noroeste del complejo deportivo, adyacente a la pista de tenis. Cuenta con un pequeño almacén.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Pista de frontón', 20, 'Pista de frontón ubicada detrás del gimnasio de uso general, no cuenta con un almacén.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Sala de musculación', 30, 'Sala de uso libre secundaria, ubicada adyacente al gimnasio, que cuenta con todas las herramientas y máquinas de musculación.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Campo de fútbol', 200, 'Campo de fútbol al aire libre con cesped artificial, ubicado a la izquierda de la pista de atletismo en el centro del complejo, cuenta con un almacen y gradas.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Campo de baloncesto', 200, 'Campo de baloncesto cubierto ubicado detrás de la piscina en la parte este del complejo, cuenta con un almacén y gradas.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Campo de balonmano', 150, 'Campo de balonmano cubierto, ubicado adyacente al campo de baloncesto, con el que comparte almacén y gradas.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Campo de fútbol sala', 150, 'Campo de fútbol sala cubierto, ubicado adyacente al campo de balonmano, con el que comparte almacén y gradas.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Pista de hockey', 100, 'Pista de hockey cubierta ubicada en la parte posterior del complejo, con almacen compartido y gradas.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Pista de patinaje', 75, 'Pista de patinaje ubicada cubierta ubicada en la parte posterior del complejo, adyacente a la pista de hockey, con la que comparte almacén y gradas.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Pista de hielo', 60, 'Pista de patinaje sobre hielo y hockey sobre hielo cubierta ubicada en la parte oeste del complejo, solo disponible en ciertas temporadas: consultar al administrador.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Campo de voleibol', 110, 'Campo de voleibol cubierto ubicado adyacente al campo de fútbol sala en el centro del complejo, con almacén y gradas compartidas.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Sala de esgrima', 45, 'Sala de esgrima cubierta ubicada adyacente a la sala de yoga, sin almacén.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Sala de judo', 40, 'Sala de judo cubierta ubicada adyacente a la sala de esgrima, sin almacén.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Sala de kárate', 40, 'Sala de kárate cubierta ubicada adyacente a la sala de esgrima, sin almacén.');
INSERT INTO resources (nombre, aforo, descripcion) values ('Sala de boxeo', 55, 'Sala de boxeo cubierta ubicada en la zona noreste del complejo deportivo, cuenta con almacén propio así como con los distintos materiales necesarios para practicar y entrenar el deporte.');

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

INSERT INTO tables_user VALUES (4, 1);
INSERT INTO tables_user VALUES (5, 2);
INSERT INTO tables_user VALUES (6, 3);
INSERT INTO tables_user VALUES (7, 4);
INSERT INTO tables_user VALUES (8, 5);
INSERT INTO tables_user VALUES (9, 6);
INSERT INTO tables_user VALUES (10, 7);
INSERT INTO tables_user VALUES (11, 8);
INSERT INTO tables_user VALUES (12, 9);
INSERT INTO tables_user VALUES (13, 10);
INSERT INTO tables_user VALUES (14, 11);
INSERT INTO tables_user VALUES (15, 12);
INSERT INTO tables_user VALUES (16, 13);
INSERT INTO tables_user VALUES (17, 14);
INSERT INTO tables_user VALUES (18, 15);
INSERT INTO tables_user VALUES (19, 16);
INSERT INTO tables_user VALUES (20, 17);
INSERT INTO tables_user VALUES (21, 18);
INSERT INTO tables_user VALUES (22, 19);
INSERT INTO tables_user VALUES (23, 20);

INSERT INTO activities_user VALUES (4, 1, 0);
INSERT INTO activities_user VALUES (5, 2, 1);
INSERT INTO activities_user VALUES (6, 3, 0);
INSERT INTO activities_user VALUES (7, 4, 1);
INSERT INTO activities_user VALUES (8, 5, 0);
INSERT INTO activities_user VALUES (9, 6, 1);
INSERT INTO activities_user VALUES (10, 7, 0);
INSERT INTO activities_user VALUES (11, 8, 1);
INSERT INTO activities_user VALUES (12, 9, 0);
INSERT INTO activities_user VALUES (13, 10, 1);
INSERT INTO activities_user VALUES (14, 11, 0);
INSERT INTO activities_user VALUES (15, 12, 1);
INSERT INTO activities_user VALUES (16, 13, 0);
INSERT INTO activities_user VALUES (17, 14, 1);
INSERT INTO activities_user VALUES (18, 15, 0);
INSERT INTO activities_user VALUES (19, 16, 1);
INSERT INTO activities_user VALUES (20, 17, 0);
INSERT INTO activities_user VALUES (21, 18, 1);
INSERT INTO activities_user VALUES (22, 19, 0);
INSERT INTO activities_user VALUES (23, 20, 1);

INSERT INTO exercises_table VALUES (1, 1);
INSERT INTO exercises_table VALUES (2, 2);
INSERT INTO exercises_table VALUES (3, 3);
INSERT INTO exercises_table VALUES (4, 4);
INSERT INTO exercises_table VALUES (5, 5);
INSERT INTO exercises_table VALUES (6, 6);
INSERT INTO exercises_table VALUES (7, 7);
INSERT INTO exercises_table VALUES (8, 8);
INSERT INTO exercises_table VALUES (9, 9);
INSERT INTO exercises_table VALUES (10, 10);
INSERT INTO exercises_table VALUES (11, 11);
INSERT INTO exercises_table VALUES (12, 12);
INSERT INTO exercises_table VALUES (13, 13);
INSERT INTO exercises_table VALUES (14, 14);
INSERT INTO exercises_table VALUES (15, 15);
INSERT INTO exercises_table VALUES (16, 16);
INSERT INTO exercises_table VALUES (17, 17);
INSERT INTO exercises_table VALUES (18, 18);
INSERT INTO exercises_table VALUES (19, 19);
INSERT INTO exercises_table VALUES (20, 20);

INSERT INTO resources_activity VALUES (1, 1);
INSERT INTO resources_activity VALUES (2, 2);
INSERT INTO resources_activity VALUES (3, 3);
INSERT INTO resources_activity VALUES (4, 4);
INSERT INTO resources_activity VALUES (5, 5);
INSERT INTO resources_activity VALUES (6, 6);
INSERT INTO resources_activity VALUES (7, 7);
INSERT INTO resources_activity VALUES (8, 8);
INSERT INTO resources_activity VALUES (9, 9);
INSERT INTO resources_activity VALUES (10, 10);
INSERT INTO resources_activity VALUES (11, 11);
INSERT INTO resources_activity VALUES (12, 12);
INSERT INTO resources_activity VALUES (13, 13);
INSERT INTO resources_activity VALUES (14, 14);
INSERT INTO resources_activity VALUES (15, 15);
INSERT INTO resources_activity VALUES (16, 16);
INSERT INTO resources_activity VALUES (17, 17);
INSERT INTO resources_activity VALUES (18, 18);
INSERT INTO resources_activity VALUES (19, 19);
INSERT INTO resources_activity VALUES (20, 20);
