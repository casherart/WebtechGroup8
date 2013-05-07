/* to use in console:
mysql --user=root -p < insert.sql
*/

/* insert users */
INSERT INTO seapal.benutzer (benutzername, passwort, vorname, nachname, mail, geburtsdatum, registrierung) VALUES ("dominic", "pwd", "Dominic", "Eschbach", "doeschba@htwg-konstanz.de", DATE("2012-07-04"), DATE("2012-10-03"));
INSERT INTO seapal.benutzer (benutzername, passwort, vorname, nachname, mail, geburtsdatum, registrierung) VALUES ("timo", "pwd", "Timo", "Partl", "tipartl@htwg-konstanz.de", DATE("2012-07-02"), DATE("2012-10-03"));

/* insert boats */
INSERT INTO seapal.bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Titanic", 101, "TI101", "New York", "New York Yacht Club", "George Boat", "Württembergische", "TI", "Schiff", "Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO seapal.bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Queen Mary 2", 80, "QM80", "Dover", "Dover Yacht Club", "Hans Ebert", "Wüstenrot", "QM", "Schiff", "Rainer Berger", 200, 50, 7, 10, 1000, "T20", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO seapal.bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("MS Deutschland", 150, "MSD15", "Hamburg", "Hamburg Yacht Club", "Peter Miller", "Allianz", "MSD", "Schiff", "Emil Klaus", 200, 50, 7, 10, 1000, "T27", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);

/* insert trips */
INSERT INTO seapal.tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("Langer Trip nach England", "Hamburg", "Dover", "Hr. Hein", "Martin Felix Manuel", DATE("2012-07-02"), DATE("2012-07-02"), 300, 1241, true);

INSERT INTO seapal.wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 1", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Marker 2");
INSERT INTO seapal.wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 2", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Marker 3");
INSERT INTO seapal.wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 3", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Marker 4");
INSERT INTO seapal.wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 4", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Marker 5");
INSERT INTO seapal.wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 5", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Marker 6");
INSERT INTO seapal.wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 6", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Marker 7");
INSERT INTO seapal.wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 7", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Marker 8");
INSERT INTO seapal.wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 8", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Marker 9");
INSERT INTO seapal.wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 9", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Marker 10");
INSERT INTO seapal.wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 10", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Ziel");


/* insert select boxes values */

INSERT INTO seapal.direction (description)
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

INSERT INTO seapal.wind_direction (direction_id)
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

INSERT INTO seapal.wave_direction (direction_id)
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

INSERT INTO seapal.rain (description)
VALUES
	('No rain'), 
	('Light rain < 0.5 mm/h'), 
	('Moderate rain < 4 mm/h'), 
	('Heavy rain < 10 mm/h'), 
	('Violent rain > 8 mm/min')
;

INSERT INTO seapal.clouds (description)
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

INSERT INTO seapal.wind_strength (description)
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