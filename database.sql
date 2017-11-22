drop database gesgym;

create database gesgym;

use gesgym;

create table users (
		username varchar(255),
		passwd varchar(255),
		tlf integer(9),
		tipo ENUM('cliente','entrenador','administrador'),
		calle varchar(255),
		ciudad varchar(255),
		codPostal varchar(255),
		
		primary key (username)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

create table tables (
		tableid varchar(255),
		tabletipo ENUM('person','noPerson'),
		
		primary key (tableid)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

create table sessions (
		sessionid varchar(255),
		username varchar(255),
		tableid varchar(255),
		fechaInicio datetime,
		fechaFin datetime,
		
		primary key (sessionid),
		foreign key (username) references users(username),
		foreign key (tableid) references tables(tableid)
		
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

create table comments (
	commentid varchar(255),	 
	content varchar(255),
	username varchar(255),
	sessionid varchar(255),
	tableid varchar(255),

	primary key (commentid),
	foreign key (username) references users(username),
	foreign key (sessionid) references sessions(sessionid),
	foreign key (tableid) references tables(tableid)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

create table exercises (
		exerciseid varchar(255),
		exer_name varchar(255),
		exer_tipo ENUM('cardio','musculacion','estiramiento'),
		
		primary key (exerciseid)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

create table activities (
		activityid varchar(255),
		plazas int(10),
		
		primary key (activityid)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

create table resources (
		id varchar(255),
		tipo ENUM('instalacion','material'),
		location varchar(255),
		canafo int(10),
		
		primary key (id)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

create table act_use_res (
		activityid varchar(255),
		resourceid varchar(255),
		
		foreign key (activityid) references activities(activityid),
		foreign key (resourceid) references resources(id)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

create table use_participates_act (
		username varchar(255),
		activityid varchar(255),
		fecha datetime,
		
		foreign key (username) references users(username),
		foreign key (activityid) references activities(activityid)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

create table tab_has_exe (
		tableid varchar(255),
		exerciseid varchar(255),
		series int(10),
		repe int(10),
		tiempo int(7),
		
		foreign key (tableid) references tables(tableid),
		foreign key (exerciseid) references exercises(exerciseid)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

grant all privileges on gesgym.* to gguser@localhost identified by "ggpass";

INSERT INTO users values ('12345','12345',666225577,'administrador','Avenida Nula N0','Nulilandia','30000');

INSERT INTO users values ('ejemplo1','ejemplo1',666224466,'cliente','ejemplo1','ejemplo1','ejemplo1');
INSERT INTO users values ('ejemplo2','ejemplo2',666224466,'entrenador','ejemplo2','ejemplo2','ejemplo2');
INSERT INTO users values ('ejemplo3','ejemplo3',666224466,'cliente','ejemplo3','ejemplo3','ejemplo3');
INSERT INTO users values ('ejemplo4','ejemplo4',666224466,'entrenador','ejemplo4','ejemplo4','ejemplo4');
INSERT INTO users values ('ejemplo5','ejemplo5',666224466,'cliente','ejemplo5','ejemplo5','ejemplo5');

INSERT INTO tables values ('ejemplo1', 'person');
INSERT INTO tables values ('ejemplo2', 'noPerson');
INSERT INTO tables values ('ejemplo3', 'person');
INSERT INTO tables values ('ejemplo4', 'noPerson');
INSERT INTO tables values ('ejemplo5', 'person');

INSERT INTO sessions values ('ejemplo1', 'ejemplo1', 'ejemplo1', '2017-11-01 00:00:00', '2017-11-30 00:00:00');
INSERT INTO sessions values ('ejemplo2', 'ejemplo2', 'ejemplo2', '2017-11-01 00:00:00', '2017-11-30 00:00:00');
INSERT INTO sessions values ('ejemplo3', 'ejemplo3', 'ejemplo3', '2017-11-01 00:00:00', '2017-11-30 00:00:00');
INSERT INTO sessions values ('ejemplo4', 'ejemplo4', 'ejemplo4', '2017-11-01 00:00:00', '2017-11-30 00:00:00');
INSERT INTO sessions values ('ejemplo5', 'ejemplo5', 'ejemplo5', '2017-11-01 00:00:00', '2017-11-30 00:00:00');

INSERT INTO comments values ('ejemplo1', 'ejemplo1', 'ejemplo1', 'ejemplo1', 'ejemplo1');
INSERT INTO comments values ('ejemplo2', 'ejemplo2', 'ejemplo2', 'ejemplo2', 'ejemplo2');
INSERT INTO comments values ('ejemplo3', 'ejemplo3', 'ejemplo3', 'ejemplo3', 'ejemplo3');
INSERT INTO comments values ('ejemplo4', 'ejemplo4', 'ejemplo4', 'ejemplo4', 'ejemplo4');
INSERT INTO comments values ('ejemplo5', 'ejemplo5', 'ejemplo5', 'ejemplo5', 'ejemplo5');

INSERT INTO exercises values ('ejemplo1','ejemplo1', 'cardio');
INSERT INTO exercises values ('ejemplo2','ejemplo2', 'musculacion');
INSERT INTO exercises values ('ejemplo3','ejemplo3', 'estiramiento');
INSERT INTO exercises values ('ejemplo4','ejemplo4', 'cardio');
INSERT INTO exercises values ('ejemplo5','ejemplo5', 'musculacion');

INSERT INTO activities values ('ejemplo1', 100);
INSERT INTO activities values ('ejemplo2', 100);
INSERT INTO activities values ('ejemplo3', 100);
INSERT INTO activities values ('ejemplo4', 100);
INSERT INTO activities values ('ejemplo5', 100);

INSERT INTO resources values ('ejemplo1','material', 'ejemplo1', 100);
INSERT INTO resources values ('ejemplo2','instalacion', 'ejemplo2', 100);
INSERT INTO resources values ('ejemplo3','material', 'ejemplo3', 100);
INSERT INTO resources values ('ejemplo4','instalacion', 'ejemplo4', 100);
INSERT INTO resources values ('ejemplo5','material', 'ejemplo5', 100);

INSERT INTO act_use_res values ('ejemplo1', 'ejemplo1');
INSERT INTO act_use_res values ('ejemplo2', 'ejemplo2');
INSERT INTO act_use_res values ('ejemplo3', 'ejemplo3');
INSERT INTO act_use_res values ('ejemplo4', 'ejemplo4');
INSERT INTO act_use_res values ('ejemplo5', 'ejemplo5');

INSERT INTO use_participates_act values ('ejemplo1', 'ejemplo1', '2017-11-15 00:00:00');
INSERT INTO use_participates_act values ('ejemplo2', 'ejemplo2', '2017-11-15 00:00:00');
INSERT INTO use_participates_act values ('ejemplo3', 'ejemplo3', '2017-11-15 00:00:00');
INSERT INTO use_participates_act values ('ejemplo4', 'ejemplo4', '2017-11-15 00:00:00');
INSERT INTO use_participates_act values ('ejemplo5', 'ejemplo5', '2017-11-15 00:00:00');

INSERT INTO tab_has_exe values ('ejemplo1', 'ejemplo1', 5, 20, 150);
INSERT INTO tab_has_exe values ('ejemplo2', 'ejemplo2', 5, 20, 150);
INSERT INTO tab_has_exe values ('ejemplo3', 'ejemplo3', 5, 20, 150);
INSERT INTO tab_has_exe values ('ejemplo4', 'ejemplo4', 5, 20, 150);
INSERT INTO tab_has_exe values ('ejemplo5', 'ejemplo5', 5, 20, 150);