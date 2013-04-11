
/* to use in console:
mysql --user=root -p < sqlSeapal.sql
*/

DROP DATABASE seapal;
CREATE DATABASE seapal;

use seapal;

CREATE TABLE IF NOT EXISTS direction(
	id int AUTO_INCREMENT,
	description varchar(50) UNIQUE,
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS wind_direction(
	id int AUTO_INCREMENT,
	direction_id int,	
	PRIMARY KEY (id),
	FOREIGN KEY (direction_id) REFERENCES direction(id)
);


CREATE TABLE IF NOT EXISTS wave_direction(
	id int AUTO_INCREMENT,
	direction_id int,	
	PRIMARY KEY (id),
	FOREIGN KEY (direction_id) REFERENCES direction(id)
);

CREATE TABLE IF NOT EXISTS rain(
	id int AUTO_INCREMENT,
	description varchar(50) UNIQUE,
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS clouds(
	id int AUTO_INCREMENT,
	description varchar(50) UNIQUE,
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS wind_strength(
	id int AUTO_INCREMENT,
	description varchar(50) UNIQUE,
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS seapal_main(
	id int AUTO_INCREMENT,
	templeratur FLOAT,
	airpreasure FLOAT,
	wind_strength int,
	wind_direction int,
	wave_height FLOAT,
	wave_direction int,
	clouds int,
	rain int,
	PRIMARY KEY (id),
	FOREIGN KEY (wind_strength) REFERENCES wind_strength(id),
	FOREIGN KEY (wind_direction) REFERENCES wind_direction(id),
	FOREIGN KEY (wave_direction) REFERENCES wave_direction(id)
);

INSERT INTO direction (description)
VALUES 
	(''),
	('North'),
	('East'),
	('South'),
	('West'),
	('North-East'),
	('North-West'),
	('South-East'),
	('South-West')
;	

INSERT INTO wind_direction (direction_id)
VALUES
	(1), 
	(2), 
	(3), 
	(4), 
	(5), 
	(6), 
	(7),
	(8), 
	(9)
;

INSERT INTO wave_direction (direction_id)
VALUES
	(1), 
	(2), 
	(3), 
	(4), 
	(5), 
	(6), 
	(7),
	(8), 
	(9)
;

INSERT INTO rain (description)
VALUES
	(''), 
	('Light rain < 0.5 mm/h'), 
	('Moderate rain < 4 mm/h'), 
	('Heavy rain < 10 mm/h'), 
	('Violent rain > 8 mm/min')
;

INSERT INTO clouds (description)
VALUES
	(''),
	('0/8 (sky completely clear)'),
	('1/8 (sunny)'),
	('2/8 (mainly clear)'),
	('3/8 (partly cloudy)'),
	('4/8 (sky half cloudy)'),
	('5/8 (cloudy)'),
	('6/8 (strong cloudy)'),
	('7/8 (almost overcast)'),
	('8/8 (completely overcast)'),
	('9/8 (sky not visible)')
;

INSERT INTO wind_strength (description)
VALUES
	(''),
	('0 (0 - 2 km/h)'), 
	('1 (2 - 5 km/h)'), 
	('2 (6 - 11 km/h)'), 
	('3 (12 - 19 km/h)'), 
	('4 (20 - 28 km/h)'), 
	('5 (29 - 38 km/h)'), 
	('6 (39 - 49 km/h)'), 
	('7 (50 - 61 km/h)'),
	('8 (62 - 74 km/h)'),
	('9 (75 - 88 km/h)'),
	('10 (89 - 102 km/h)'),
	('11 (103 - 117 km/h)'),
	('12 (≥ 117 km/h)')
;
commit;