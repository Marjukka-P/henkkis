
DROP DATABASE IF EXISTS henkilotiedot;
CREATE DATABASE henkilotiedot DEFAULT CHARACTER SET utf8 COLLATE utf8_swedish_ci;
USE henkilotiedot;
DROP TABLE IF EXISTS Yhteystiedot;
CREATE TABLE Yhteystiedot(
osoiteID int PRIMARY KEY NOT NULL AUTO_INCREMENT,
katuosoite varchar(100),
postinumero varchar(5),                                    
postitoimipaikka varchar(50),                                                                                                                           
tiedotPaivitetty date                                                                                                                                                                                      
);

DROP TABLE IF EXISTS Henkilotiedot;
CREATE Table Henkilotiedot (
henkiloID int PRIMARY KEY NOT NULL AUTO_INCREMENT,
osoiteID int NOT NULL,
etunimi varchar(50),
sukunimi varchar (50),
puhkoti varchar(50),
sahkoposti varchar(50),
koeaikaPaattyy date,
syntymapaiva date,
toihintulopaiva date,
FOREIGN KEY (osoiteID) REFERENCES Yhteystiedot(osoiteID) 
ON UPDATE CASCADE
ON DELETE NO ACTION
);

DROP TABLE IF EXISTS Muistaminen;
CREATE TABLE Muistaminen(
muistamisID int PRIMARY KEY NOT NULL AUTO_INCREMENT,
henkiloID int NOT NULL,
kukka varchar(50),
lahja varchar(50),
tyontekijaaInformoitu date,
FOREIGN KEY(henkiloID) REFERENCES Henkilotiedot(henkiloID)
ON UPDATE CASCADE
ON DELETE NO ACTION
);

DROP TABLE IF EXISTS Perehdytys;
CREATE TABLE Perehdytys(
moduliID int PRIMARY KEY NOT NULL AUTO_INCREMENT,
modulinNimi varchar(50)
);

DROP TABLE IF EXISTS Osaaminen;
CREATE TABLE Osaaminen( 
osaamisID int PRIMARY KEY NOT NULL AUTO_INCREMENT,
perehdytettavaID int NOT NULL,                                                                                                                                                                                                      
perehdyttajaID int NOT NULL,
moduliID int NOT NULL,                                                                                                                                                                                                                            
suorituspaiva  date,
FOREIGN KEY (perehdytettavaID) REFERENCES Henkilotiedot(henkiloID)
ON UPDATE CASCADE
ON DELETE NO ACTION,
FOREIGN KEY (perehdyttajaID) REFERENCES Henkilotiedot(henkiloID)
ON UPDATE CASCADE
ON DELETE NO ACTION,
FOREIGN KEY (moduliID) REFERENCES Perehdytys(moduliID)
ON UPDATE CASCADE
ON DELETE NO ACTION
);

INSERT INTO Yhteystiedot(katuosoite,postinumero,postitoimipaikka,tiedotPaivitetty) VALUES 
('Peukaloisenpolku 15','02760','Espoo','2018-11-25'),
('Hiirulaisentie 89','01510','Vantaa','2017-01-9'),
('Esikkokatu 1','00350','Helsinki','2019-05-30'),
('Tontunmaki 7', '00760', 'Helsinki','2018-10-11'),
('Pikkulinnuntie 22','02540','Espoo','2012-08-20'),
('Jalkakatu 4 a 5', '00510', 'Helsinki','2019-05-02'),
('Eerontie 5', '03890', 'Kirkkonummi', '2018-12-31'),
('Lounapolku 55', '78210', 'Karjaa','2017-05-05'),
('Lillintie 6b87', '00100', 'Helsinki','2019-08-01'),
('Lusmuoja 4','21500','Turku', '2016-06-25');

INSERT INTO Henkilotiedot(osoiteID,etunimi,sukunimi,puhkoti,sahkoposti,koeaikaPaattyy,syntymapaiva,toihintulopaiva) VALUES
(6,'Maija','Poppanen','040-123456','maija.p@gmail.com','2008-12-31','1955-06-22', '2008-06-30'),
(7,'Matti','Mallikas','050-123456','matti@luukku.com','2017-01-05', '1974-05-17', '2017-01-05'),
(8,'Ville','Vallaton','040-654321','vv1@me.com','2020-06-15', '1981-03-06', '2019-08-31'),
(9,'Veera','Vikkela','09-654321','vikkela.veera@hotmail.com','2019-10-24', '1971-12-25', '2019-05-24'),
(10,'Onni','Orava','045-123456','orava.o@gmail.com','2001-07-19', '1964-04-05', '2001-03-19'),
(1, 'Maija', 'Ekaluokkalainen', '050-4567852', 'm.ekaluokkalainen@gmail.com','2011-04-04', '1955-06-04', '2011-01-01'),
(2, 'Kari', 'Kakattaja','09-4521789', 'kari.kakattaja@suomi24.fi','2014-06-16', '1971-11-11', '2014-02-16'),
(4, 'Lauri', 'Liukas', '019-7850354', 'Lauri.L@yahoo.com','2020-01-01', '1965-04-08', '2019-01-06'),
(3, 'Lilli', 'Marjaisa','040-7563298', 'Lillis@gmail.com','1995-05-07', '1945-03-02', '1995-05-07'),
(5, 'Erkki', 'Keikki','044-98511234', 'EK@hotmail.com','1999-07-06', '1968-12-14', '1999-07-01');

INSERT INTO Muistaminen(henkiloID,kukka,lahja,tyontekijaaInformoitu) VALUES
(1,'syntymäpäiväkukka','300e 60v lahjakortti','2015-05-04'),
(2,'syntymäpäiväkakku','2v lahja','0000-00-00'),
(9,'syntymäpäiväkukka','200e lahjakortti','2015-03-02'),
(4,'syntymäpäiväkukka','50 e lahjakortti','2004-03-15'),
(10,'','10 v kylpyläloma','2008-12-11'),
(3, '40v. syntymäpäiväkukka','','0000-00-00'),
(4, '35v.syntymäpäiväkukka','','0000-00-00'),
(7, '15v kukka','15 lahja','2015-05-05'),
(5, '50v syntymäpäiväkukka','50v lahjakortti','2014-02-06'),
(2, '30v syntymäpäiväkukka','','0000-00-00'),
(9, '60v kukka','60v lahjakortti','2015-05-05'),
(6, '5v työssäolokukka','','0000-00-00'),
(8, 'valmistujaiskukka','','0000-00-00');

INSERT INTO Perehdytys(modulinNimi)VALUES
('Toimintaan perehtyminen'),
('Työsuhdeasioiden läpikäynti'),
('Työtilat'),
('Turvallinen työskentely'),
('Työtehtäviin perehtyminen'),
('Paloturvallisuus'),
('Tietoturva'),
('Järjestelmät'),
('Työhöntulotarkastus'),
('Organisaatio');

INSERT INTO Osaaminen(perehdytettavaID,perehdyttajaID,moduliID,suorituspaiva)VALUES
(4,1,1,'2019-06-15'),
(3,7,2,'2019-09-03'),
(2,5,10,'2019-05-25'),
(1,10,8,'2008-07-19'),
(6,9,3,'2011-01-02'),
(7,9,9,'2014-03-15'),
(2,6,6,'2017-01-29'),
(8,2,5,'2019-02-28'),
(9,4,4,'2019-08-10'),
(10,4,4,'2019-08-10');