create database gesgym;

use gesgym;

--Heredado del ejemplo original, necesita modificaciones.
create table users (
		username varchar(255),
		passwd varchar(255),
		
		primary key (username)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

--Heredado del ejemplo original, necesita ser eliminado.
create table posts (
	id int auto_increment,
	title varchar(255),
	content varchar(255),
	author varchar(255) not null,

	primary key (id),
	foreign key (author) references users(username)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

--Heredado del ejemplo original, necesita modificaciones.
create table comments (
	id int auto_increment,	 
	content varchar(255),
	author varchar(255) not null,
	post int not null,

	primary key (id),
	foreign key (author) references users(username),
	foreign key (post) references posts(id) on delete cascade
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

--Faltan atributos.
create table tables (
		tableid varchar(255),
		primary key (tableid)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

--Faltan atributos.
create table sessions (
		sessionid varchar(255),
		username varchar(255),
		tableid varchar(255),
		commentid int auto_increment,
		
		primary key (sessionid),
		foreign key (username) references users(username),
		foreign key (tableid) references tables(tableid),
		foreign key (commentid) references comments(id)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

--Faltan atributos.
create table exercises (
		exerciseid varchar(255),
		
		primary key (exerciseid)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

--Faltan atributos.
create table activities (
		activityid varchar(255),
		primary key (activityid)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

--Faltan atributos, usar el mismo atributo para aforo y cantidad y así evitar tener una tabla más.
create table resources (
		resourceid varchar(255),
		
		primary key (resourceid)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

--Faltan atributos.
create table act_use_res (
		activityid varchar(255),
		resourceid varchar(255),
		
		foreign key (activityid) references activities(activityid),
		foreign key (resourceid) references resources(resourceid)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

--Faltan atributos.
create table use_participates_act (
		username varchar(255),
		activityid varchar(255),
		
		foreign key (username) references users(username),
		foreign key (activityid) references activities(activityid)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;

--Faltan atributos.
create table tab_has_exe (
		tableid varchar(255),
		exerciseid varchar(255),
		
		foreign key (tableid) references tables(tableid),
		foreign key (exerciseid) references exercises(exerciseid)
) ENGINE=INNODB DEFAULT CHARACTER SET = utf8;