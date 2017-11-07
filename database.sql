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
		fichaFin datetime,
		
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
		exe_tipo ENUM('cardio','musculacion','estiramiento'),
		
		primary key (exerciseid)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

create table activities (
		activityid varchar(255),
		plazas int(10),
		
		primary key (activityid)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

create table resources (
		resourceid varchar(255),
		resource_tipo ENUM('instalacion','material'),
		location varchar(255),
		cant_afor int(10),
		
		primary key (resourceid)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

create table act_use_res (
		activityid varchar(255),
		resourceid varchar(255),
		
		foreign key (activityid) references activities(activityid),
		foreign key (resourceid) references resources(resourceid)
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

INSERT INTO users values ('12345','12345',666225577,'administrador','Avenida Nula Nº0','Nulilandia','30000');