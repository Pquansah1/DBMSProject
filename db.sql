

drop database if exists cop4710;


create database cop4710;


use cop4710;


CREATE TABLE users (
	user_id 	INT(11) NOT NULL auto_increment,
	username 	varchar(20) NOT NULL,
	password 	char(40) NOT NULL,
	priv 		int(1) NOT NULL,
	firstname	VARCHAR(30) NOT NULL,
	lastname	VARCHAR(30) NOT NULL,
	email		VARCHAR(50),
	reg_date	TIMESTAMP,
	rso			INT,
	univ_id		INT,
	PRIMARY KEY (user_id),
	UNIQUE KEY 	username (username)
); 

	

CREATE TABLE universities (
	univ_id			INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name			VARCHAR (30),
	location		VARCHAR (30), 
	description		VARCHAR (50),
	num_students	INT,
	pictures		LONGBLOB
);




CREATE TABLE comments (
	comment_id		INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	event_id		INT,
	user_id			INT,
	text			VARCHAR(140)
);


CREATE TABLE events (
	event_id		INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name			VARCHAR (30),
	category		VARCHAR (30),
	description		VARCHAR (50),
	event_time		VARCHAR (50),
	event_date		VARCHAR (50), 
	location		VARCHAR (100),
	univ_id			INT,
	priv			INT,
	rso				INT,
	contact_phone	BIGINT(10),
	contact_email	VARCHAR (50)
);


CREATE TABLE ratings (
	rating_id		INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	event_id		INT,
	comment_id		INT,
	rating			INT,
	user_id			INT
);


CREATE TABLE rso(
	rso_id			INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	email			VARCHAR(20),
	admin			INT
);
	


INSERT INTO users (username, password, priv, firstname, lastname, email, reg_date, univ_id, rso) VALUES ("mark", "qwerty", 1, "super", "aladen", "google@ucf.edu", NOW(), 1, 0);
INSERT INTO users (username, password, priv, firstname, lastname, email, reg_date, univ_id, rso) VALUES ("roy", "maame", 2, "admin", " ", "example@knights.ucf.edu", NOW(), 1, 1);
INSERT INTO users (username, password, priv, firstname, lastname, email, reg_date, univ_id, rso) VALUES ("jane", "etweba", 3, "user", "name", "endofterm@knights.ucf.edu", NOW(), 1, 0);
INSERT INTO users (username, password, priv, firstname, lastname, email, reg_date, univ_id, rso) VALUES ("truumu", "pssword", 3, "Brock", "Stoops", "koties@knights.ucf.edu", NOW(), 1, 1);
INSERT INTO users (username, password, priv, firstname, lastname, email, reg_date, univ_id, rso) VALUES ("odwan", "database", 3, "michael", "schnell", "odwanl@knights.ucf.edu", NOW(), 1, 1);
INSERT INTO universities (name, location, description, num_students, pictures) VALUES("UCF", "Orlando", "University of Central Florida", 144, null);
INSERT INTO universities (name, location, description, num_students, pictures) VALUES("UCB", "Berkeley", "University of California - Berkeley", 70145, null);
INSERT INTO universities (name, location, description, num_students, pictures) VALUES("USF", "Tampa", "University of South Florida", 12345, null);
INSERT INTO events (name, category, description, event_time, event_date, location, univ_id, priv, rso, contact_phone, contact_email) VALUES ("eces", "public", "internship and career", "14:00:00", "2022-04-15", "University of Central Florida", 1, 0, 0, "4071231247", "awoo.yaa@knights.ucf.edu");
INSERT INTO events (name, category, description, event_time, event_date, location, univ_id, priv, rso, contact_phone, contact_email) VALUES ("ucf volleyball", "rso", "sports and tailgate", "14:30:00", "2022-06-16", "University of Central Florida", 1, 1, 0, "4072457567", "olamide.osi@knights.ucf.edu"); 
INSERT INTO events (name, category, description, event_time, event_date, location, univ_id, priv, rso, contact_phone, contact_email) VALUES ("SGA ", "rso", "Team Dynamics", "09:00:00", "2022-04-17", "University of Central Florida", 1, 0, 0, "4071234567", "schoolpresident@knights.ucf.edu");
INSERT INTO events (name, category, description, event_time, event_date, location, univ_id, priv, rso, contact_phone, contact_email) VALUES ("NSBE", "university", "Data Structures", "12:30:00", "2022-04-05", "University of California Berkeley", 2, 0, 0, "4071245836", "hunkan@calmail.berkeley.edu"); 
INSERT INTO events (name, category, description, event_time, event_date, location, univ_id, priv, rso, contact_phone, contact_email) VALUES ("grad bash", "university", "Party after party", "12:30:00", "2022-04-16", "University of California Berkeley", 2, 1, 0, "4071245547", "dunsin.oyekan@calmail.berkeley.edu"); 
INSERT INTO events (name, category, description, event_time, event_date, location, univ_id, priv, rso, contact_phone, contact_email) VALUES ("MAC 4144", "class", "mathB", "15:30:00", "2022-04-14", "University of South Florida", 3, 0, 0, "4071234567", "andres.vargas@bulls.usf.edu");
INSERT INTO events (name, category, description, event_time, event_date, location, univ_id, priv, rso, contact_phone, contact_email) VALUES ("Staff", "public", "weekly reflection", "17:30:00", "2022-04-02", "University of Central Florida", 1, 2, 1, "4112544522", "employeee@knights.ucf.edu");
INSERT INTO rso (email, admin) VALUES ("peregrinoquansah@.ucf.edu", 1);
INSERT INTO rso (email, admin) VALUES ("zachmach@.ucf.edu", 2);
INSERT INTO comments (event_id, text) VALUES (2, "awesome work");
INSERT INTO comments (event_id, text) VALUES (1, "not soo impressed");
INSERT INTO comments (event_id, text) VALUES (2, "i am supposed to write a comment");
INSERT INTO ratings (event_id, rating, comment_id) VALUES (1, 5, 1);
INSERT INTO ratings (event_id, rating, comment_id) VALUES (2, 6, 2);
INSERT INTO ratings (event_id, rating, comment_id) VALUES (7, 2,3);



SELECT e.* FROM events e, universities u, users s WHERE s.univ_id = u.univ_id AND u.location = e.location AND s.user_id = (?)
SELECT e.* FROM events e, universities u WHERE e.location = u.location AND e.priv = 0 AND u.location = (?)
SELECT e.* FROM events e, universities u WHERE e.location = u.location AND e.priv = 0 AND u.univ_id = (?)
SELECT e.* FROM events e, users s WHERE s.RSO = e.RSO AND s.user_id = (?)
SELECT * FROM events WHERE priv = 0
SELECT e.* FROM events e, universities u, users s WHERE s.univ_id = u.univ_id AND u.location = e.location AND e.priv = 1 AND s.user_id = (?)
SELECT c.text FROM comments c, events e WHERE e.event_id = c.event_id AND e.event_id = (?)
SELECT r.rating FROM ratings r, events e WHERE e.event_id = r.rating AND e.event_id = (?)
SELECT c.text, r.rating FROM comments c, ratings r, events e WHERE e.event_id = c.event_id AND r.comment_id = c.comment_id AND e.event_id = 2
SELECT DISTINCT e.* FROM events e, users u WHERE u.user_id = (?) AND ((e.priv = 0) OR (e.priv = 1 AND u.univ_id = e.univ_id) OR (e.priv = 2 AND u.rso = e.rso))
78