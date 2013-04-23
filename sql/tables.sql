/* to use in console:
	mysql --user=root -p < tables.sql
*/

CREATE DATABASE seapal;

/* table for users */
CREATE TABLE IF NOT EXISTS seapal.benutzer (
	bnr INT NOT NULL AUTO_INCREMENT,
	benutzername VARCHAR(20) NOT NULL,
	passwort VARCHAR(10) NOT NULL,
	vorname VARCHAR(20) NOT NULL,
	nachname VARCHAR(20) NOT NULL,
	mail VARCHAR(30) NOT NULL,
	geburtsdatum DATE NOT NULL,
	registrierung DATE NOT NULL,
	PRIMARY KEY (bnr)
);


/* table for bootinformations */
CREATE TABLE IF NOT EXISTS seapal.bootinfo (
	bnr INT NOT NULL AUTO_INCREMENT,
	bootname VARCHAR(30) NOT NULL,
	registernummer INT NOT NULL,
	segelzeichen VARCHAR(5) NOT NULL,
	heimathafen VARCHAR(30) DEFAULT NULL,
	yachtclub VARCHAR(30) DEFAULT NULL,
	eigner VARCHAR(30) NOT NULL,
	versicherung VARCHAR(30) NOT NULL,
	rufzeichen VARCHAR(5) DEFAULT NULL,
	typ VARCHAR(10) NOT NULL,
	konstrukteur VARCHAR(30) DEFAULT NULL,
	laenge FLOAT NOT NULL,
	breite FLOAT NOT NULL,
	tiefgang FLOAT NOT NULL,
	masthoehe FLOAT NOT NULL,
	verdraengung FLOAT NOT NULL,
	rigart VARCHAR(10) DEFAULT NULL,
	baujahr INT NOT NULL,
	motor VARCHAR(30) DEFAULT NULL,
	tankgroesse FLOAT DEFAULT NULL,
	wassertankgroesse FLOAT DEFAULT NULL,
	abwassertankgroesse FLOAT DEFAULT NULL,
	grosssegelgroesse FLOAT DEFAULT NULL,
	genuagroesse FLOAT DEFAULT NULL,
	spigroesse FLOAT DEFAULT NULL,
	PRIMARY KEY (bnr)
);

/* table for tripinformations */
CREATE TABLE IF NOT EXISTS seapal.tripinfo (
	tnr INT NOT NULL AUTO_INCREMENT,
	titel VARCHAR(30) NOT NULL,
	von VARCHAR(30) NOT NULL,
	nach VARCHAR(30) NOT NULL,
	skipper VARCHAR(30) NOT NULL,
	crew VARCHAR(100) DEFAULT NULL,
	tstart DATE NOT NULL,
	tende DATE NOT NULL,
	tdauer FLOAT NOT NULL,
	motor FLOAT DEFAULT NULL,
	tank BOOLEAN DEFAULT FALSE,
	PRIMARY KEY (tnr)
);

/* table for waypoints */
CREATE TABLE IF NOT EXISTS seapal.wegpunkte (
	wnr INT NOT NULL AUTO_INCREMENT,
	tnr INT NOT NULL,
	name VARCHAR(30) NOT NULL,
	btm VARCHAR(30) NOT NULL,
	dtm VARCHAR(30) NOT NULL,
	lat VARCHAR(30) NOT NULL,
	lng VARCHAR(30) NOT NULL,
	sog VARCHAR(30) NOT NULL,
	cog VARCHAR(30) NOT NULL,
	manoever VARCHAR(30) DEFAULT NULL,
	vorsegel VARCHAR(30) DEFAULT NULL,
	wdate VARCHAR(30) DEFAULT NULL,
	wtime VARCHAR(30) DEFAULT NULL,
	marker VARCHAR(30) DEFAULT NULL,
	PRIMARY KEY (wnr),
	FOREIGN KEY (tnr) REFERENCES tripinfo (tnr) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS seapal.direction(
	id int AUTO_INCREMENT,
	description varchar(50) UNIQUE,
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS seapal.wind_direction(
	id int AUTO_INCREMENT,
	direction_id int,	
	PRIMARY KEY (id),
	FOREIGN KEY (direction_id) REFERENCES seapal.direction(id)
);


CREATE TABLE IF NOT EXISTS seapal.wave_direction(
	id int AUTO_INCREMENT,
	direction_id int,	
	PRIMARY KEY (id),
	FOREIGN KEY (direction_id) REFERENCES seapal.direction(id)
);

CREATE TABLE IF NOT EXISTS seapal.rain(
	id int AUTO_INCREMENT,
	description varchar(50) UNIQUE,
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS seapal.clouds(
	id int AUTO_INCREMENT,
	description varchar(50) UNIQUE,
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS seapal.wind_strength(
	id int AUTO_INCREMENT,
	description varchar(50) UNIQUE,
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS seapal.seapal_weather(
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
	FOREIGN KEY (wind_strength) REFERENCES seapal.wind_strength(id),
	FOREIGN KEY (wind_direction) REFERENCES seapal.wind_direction(id),
	FOREIGN KEY (wave_direction) REFERENCES seapal.wave_direction(id),
	FOREIGN KEY (clouds) REFERENCES seapal.clouds(id),
	FOREIGN KEY (rain) REFERENCES seapal.rain(id)
);
