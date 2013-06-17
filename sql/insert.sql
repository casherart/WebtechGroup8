/* to use in console:
mysql --user=root -p < insert.sql
*/
USE seapal;

/* insert users */
INSERT INTO benutzer (benutzername, passwort, vorname, nachname, mail, geburtsdatum, registrierung) VALUES ("dominic", "pwd", "Dominic", "Eschbach", "doeschba@htwg-konstanz.de", DATE("2012-07-04"), DATE("2012-10-03"));
INSERT INTO benutzer (benutzername, passwort, vorname, nachname, mail, geburtsdatum, registrierung) VALUES ("timo", "pwd", "Timo", "Partl", "tipartl@htwg-konstanz.de", DATE("2012-07-02"), DATE("2012-10-03"));

/* insert boats */
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Titanic", 101, "TI101", "New York", "New York Yacht Club", "George Boat", "Württembergische", "TI", "Schiff", "Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Queen Mary 2", 80, "QM80", "Dover", "Dover Yacht Club", "Hans Ebert", "Wüstenrot", "QM", "Schiff", "Rainer Berger", 200, 50, 7, 10, 1000, "T20", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("MS Deutschland", 150, "MSD15", "Hamburg", "Hamburg Yacht Club", "Peter Miller", "Allianz", "MSD", "Schiff", "Emil Klaus", 200, 50, 7, 10, 1000, "T27", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Titanic2", 103, "TI102", "New Hampture", "New Hampture Yacht Club", "George Miller", "Württembergische", "TI2", "Schiff", "Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Costa Conales", 104, "CC203", "Cannes", " Bateau et la peache Cannes Yacht Club", "Henri Wales", "Asurance", "COSTA", "Schiff", "Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Abracadabra", 105, "AB300", "Konstanz", "HTWG Yacht Club", "Sophie Shishkov", "Württembergische", "ABRA", "L","Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Ali Baba", 106, "ALI3", "Dubai", "Al Hasaf Yacht Club", "Sadam Ali", "Württembergische", "ALI", "M","Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Albatross", 107, "ALBA1", "Hamburg", "Kuestenwache", "Peter Elas", "Württembergische", "ALBATROSS", "L", "Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Aurora", 108, "Aura3", "Monaco", "Yacht Club monegasque", "Prince Albert", "Asurance", "AURA", "K", "Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Blackstar", 110, "BS345", "Helifax", "Yacht Club Helifax", "Jack Sparrow", "Württembergische", "BLACKI", "S","Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Blu Balu", 120, "BB51", "Los Angeles", "LAYC", "Angelina Jolie", "Württembergische", "BALU", "S","Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Blue Angel", 113, "BA89", "Shanghai", "Zhong guo Yacht Club", "Jet Li", "Württembergische", "ANGEL","A", "Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Black Pearl", 131, "BP78", "Port Royal", "Port Yacht Club", "Jack Sparrow", "Württembergische","BLACKP", "B","Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Mirabelle", 141, "MI45", "Dünkirchen", "Club nautique de Dunkerque", "Michel Paris", "Asurance", "MIRA", "M","Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Mermaid", 191, "MD90", "Tokio", "Tokio Yacht Club", "Naruto Usumaki", "Württembergische", "MERM", "B","Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Mayflower", 201, "MF67", "Rio", "Rio Porta Yacht Club", "Speedy Gonzales", "Württembergische","MAY", "TI","Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Oceanic", 601, "OC56", "Brasilia", "Ronaldo's Yacht Club", "Arina Gonzales", "Württembergische", "OCEANIC", "O","Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Olympic", 801, "PL876", "Helifax", "Helifax Yacht Club", "Pete Brown", "Württembergische", "OLYMPIC", "P", "Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Orion", 401, "OR123", "Florida", "Flo Rida Club", "Flo Rida", "Württembergische", "ORION","S", "Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Miss Sophie", 801, "MS52", "Saint-Tropez", "Club nautique de Saint Tropez", "Jaques Tropez", "Asurance", "SOPHIE", "R", "Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Neptun", 671, "N213", "New Fundland", "New Fundland Sailing Club", "James Morris", "Württembergische", "NEPTUN", "N","Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Perseus", 131, "P324", "New Braunswick", "New Braunswick Sailing Yacht Club", "Peter Potter", "Württembergische", "PERSEUS", "T", "Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Princess", 901, "PR2345", "Singapur", "Yacht Club von Singapur", "Chan Kong Sang", "Württembergische", "PRINCE", "P","Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Pegasus", 121, "Pe2324", "Marktdorf", "Angelverein Marktdorf", "Georg Kitzelmann", "Württembergische", "PEGASUS", "L", "Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Polaris", 211, "PO8", "Bregenz", "Bregenzer Angelverein", "Tim Schweinebraten", "Östereichische Versicherung", "POLARIS","E","Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Rainbow", 901, "Rai234", "Friedrichshafen", "Sportfreunde FN", "Kai Lebenslust", "Württembergische", "Schiff","Q","RAINBOW", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Pink Panther", 601, "PP345", "Sophia", "Motorrennbootverein Sophia", "Svetlana Kubitshov", "Württembergische", "PINKY", "PI","Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Pocahontas", 504, "PC342", "Überlingen", "der Kanutreff", "Justin Hackbraten", "Württembergische","POCA", "G", "POCA", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);
INSERT INTO bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung, rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart, baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse, genuagroesse, spigroesse) VALUES ("Petticoat", 132, "PT023", "New York", "U.S. Army", "Louis Hornspi", "Württembergische", "Petti","A", "Peter Schiff", 200, 50, 7, 10, 1000, "T34", 1993, "Duotec 100", 500, 50, 30, 10, 25, 13);


/* insert trips */
INSERT INTO tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("Langer Trip nach England", "Hamburg", "Dover", "Hr. Hein", "Martin Felix Manuel", DATE("2012-07-02"), DATE("2012-07-02"), 300, 1241, true);
INSERT INTO tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("BodenseeTour", "Konstanz", "Meersburg", "Hr. Boger", "Martin Felix Manuel", DATE("2012-08-06"), DATE("2012-08-013"), 300, 1241, true);
INSERT INTO tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("Ausflug", "Friedrichshafen", "Bregenz", "Hr. Hein", "Duy Felix Irmgard", DATE("2013-09-01"), DATE("2013-09-02"), 300, 1241, true);
INSERT INTO tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("Segelregatta", "Konstanz", "Bregenz", "Duy", "Fred Felix Irmgard", DATE("2013-09-10"), DATE("2013-09-11"), 900, 1301, true);
INSERT INTO tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("JungvernfahrtTitanic", "Marktdorf", "Konstanz", "Kurt", "Joseph", DATE("2013-01-14"), DATE("2013-01-13"), 1400, 1695, true);
INSERT INTO tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("Partytour", "Bregenz", "Lindau", "Duy", "Fred Felix Karin", DATE("2013-06-13"), DATE("2013-06-13"), 1000, 2045, true);
INSERT INTO tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("Segelkurs", "Salem", "Konstanz", "Kurt", " Felix Karin", DATE("2013-06-13"), DATE("2013-06-13"), 1000, 2045, true);
INSERT INTO tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("AbiTrip", "Bregenz", "Lindau", "Felix", " Elvis Jürgen", DATE("2013-06-13"), DATE("2013-06-13"), 1000, 2045, true);
INSERT INTO tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("CasinoTour", "Salem", "Lindau", "Fred", " Kerstin Karin", DATE("2013-06-13"), DATE("2013-06-13"), 1000, 2045, true);
INSERT INTO tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("Unternehmenstrip", "Lindau", "Salem", "Xaver", " Johannes Kurt", DATE("2013-06-13"), DATE("2013-06-13"), 1000, 2045, true);
INSERT INTO tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("Abschlusstour", "Bregenz", "Lindau", "Martin", " Lorita Karin", DATE("2013-06-13"), DATE("2013-06-13"), 1000, 2045, true);
INSERT INTO tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("Angelclubtour", "Salem", "Lindau", "Maria", " Oliver Karin", DATE("2013-06-13"), DATE("2013-06-13"), 1000, 2045, true);
INSERT INTO tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("Angeln", "Bregenz", "Konstanz", "Karin", " Felix Xaver", DATE("2013-06-13"), DATE("2013-06-13"), 1000, 2045, true);
INSERT INTO tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("Bootstour", "Überlingen", "Kreuzlingen", "Seraphin", " Stella Xaver", DATE("2013-06-13"), DATE("2013-06-13"), 1000, 2045, true);
INSERT INTO tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("Sushi essen", "Konstanz", "Bregenz ", "Fred", " Duy Dani Martin Sebastian Kerstin", DATE("2013-06-13"), DATE("2013-06-13"), 1000, 2045, true);
INSERT INTO tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("Queen Merry Jubeleum", "Konstanz", "Bregenz ", "Captain Jack", " Jonny Elithabeth", DATE("2013-06-13"), DATE("2013-06-13"), 1000, 2045, true);
INSERT INTO tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("Piratenfahrt", "Marktdorf", "Lindau ", "Captain Morgan", " Fred Duy Dani Martin Sebastian Kerstin", DATE("2013-06-13"), DATE("2013-06-13"), 1000, 2045, true);
INSERT INTO tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES ("Kapernfahrt", "Konstanz", "Lindau ", "Jack Sparrow", " Elithabeth Will Barbossa", DATE("2013-06-13"), DATE("2013-06-13"), 1000, 2045, true);






INSERT INTO wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 1", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Marker 2");
INSERT INTO wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 2", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Marker 3");
INSERT INTO wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 3", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Marker 4");
INSERT INTO wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 4", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Marker 5");
INSERT INTO wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 5", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Marker 6");
INSERT INTO wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 6", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Marker 7");
INSERT INTO wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 7", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Marker 8");
INSERT INTO wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 8", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Marker 9");
INSERT INTO wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 9", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Marker 10");
INSERT INTO wegpunkte (tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (1, "Marker 10", "btm", "dtm", "lat", "lng", "sog", "cog", "manoever", "vorsegel", "Date", "Time", "Ziel");



/* insert select boxes values */

INSERT INTO direction (description)
VALUES 
	(''),
	('Nord'),
	('Ost'),
	('S&uuml;d'),
	('West'),
	('Nord-Ost'),
	('Nord-West'),
	('S&uuml;d-Ost'),
	('S&uuml;d-West')
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
	('kein Regen'), 
	('leichter Regen < 0.5 mm/h'), 
	('moderater Regen < 4 mm/h'), 
	('starker Regen < 10 mm/h'), 
	('gewaltiger Regen > 8 mm/min')
;

INSERT INTO clouds (description)
VALUES
	(''),
	('0/8 (klarer Himmel/wolkenlos)'),
	('1/8 (sonnig)'),
	('2/8 (&Uuml;berwiegend klar/heiter)'),
	('3/8 (leicht/teilweise bew&ouml;lkt)'),
	('4/8 (Himmel halb bedeckt/wolkig)'),
	('5/8 (bew&ouml;lkt)'),
	('6/8 (stark bew&ouml;lkt )'),
	('7/8 (fast bedeckt)'),
	('8/8 (komplett bedeckt)'),
	('9/8 (Himmel nicht erkennbar)')
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


INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES (1, 1, 1, 3, 0, 1, 1, 0, 1, 1, 1, '2013-05-24 17:49:56');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(2, 1, 1, 3, 4, 3, 3, 4, 3, 3, 2, '2013-05-24 17:57:50');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(3, 1, 8, 3, 4, 3, 3, 4, 3, 3, 2, '2013-05-24 17:58:03');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(4, 1, 2, 3, 4, 3, 3, 4, 3, 3, 2, '2013-05-24 17:59:10');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(5, 1, 1, 3, 4, 3, 3, 4, 3, 3, 2, '2013-05-24 18:02:20');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(6, 1, 1, 3, 4, 3, 3, 4, 3, 3, 1, '2013-05-24 18:02:26');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(7, 1, 2, 30, 10, 4, 5, 0, 5, 3, 1, '2013-05-24 18:02:57');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(8, 1, 3, 23, 11, 7, 6, 3, 7, 4, 3, '2013-05-24 18:03:18');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(9, 1, 4, 10, 100, 14, 7, 10, 7, 11, 5, '2013-05-24 18:03:46');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(10, 1, 5, 4, 100, 14, 7, 8, 7, 11, 5, '2013-05-24 18:04:03');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(11, 1, 6, 30, 50, 6, 8, 0, 8, 3, 1, '2013-05-24 18:04:33');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(12, 1, 7, 20, 50, 4, 5, 0, 2, 7, 1, '2013-05-24 18:05:00');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(13, 1, 8, 20, 50, 7, 5, 0, 2, 8, 4, '2013-05-24 18:05:14');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(14, 1, 9, 25, 50, 7, 5, 0, 2, 9, 2, '2013-05-24 18:05:31');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(15, 1, 10, 25, 100, 7, 4, 0, 4, 5, 4, '2013-05-24 18:05:54');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(16, 1, 11, 10, 100, 7, 4, 0, 4, 2, 4, '2013-05-24 18:06:11');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(17, 1, 12, 15, 100, 7, 4, 0, 4, 2, 1, '2013-05-24 18:06:28');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(18, 1, 13, 15, 100, 7, 4, 0, 4, 4, 3, '2013-05-24 18:06:36');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(19, 1, 14, 15, 100, 9, 3, 3, 2, 5, 2, '2013-05-24 18:06:59');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(20, 1, 15, 15, 100, 9, 3, 3, 2, 5, 4, '2013-05-24 18:07:09');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(21, 1, 16, 17, 100, 12, 3, 3, 2, 5, 4, '2013-05-24 18:07:21');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(22, 1, 17, 12, 100, 12, 3, 8, 2, 5, 2, '2013-05-24 18:07:35');
INSERT INTO seapal_weather (`id`, `bnr`, `tnr`, `temperatur`, `airpreasure`, `wind_strength`, `wind_direction`, `wave_height`, `wave_direction`, `clouds`, `rain`, `insertDate`) VALUES(23, 1, 18, 19, 100, 12, 3, 3, 2, 5, 3, '2013-05-24 18:07:47');
