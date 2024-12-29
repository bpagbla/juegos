
DROP DATABASE IF EXISTS games;
DROP USER IF EXISTS 'games'@'%';
CREATE USER IF NOT EXISTS 'games'@'%' identified by 'gamespass';
GRANT ALL PRIVILEGES ON games.* to 'games'@'%';

CREATE DATABASE games;
USE games;

CREATE TABLE usuario (
  `ID` int NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(128) COLLATE utf8mb4_general_ci NOT NULL UNIQUE,
  `NICK` varchar(32) COLLATE utf8mb4_general_ci NOT NULL UNIQUE,
  `ROLE` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `NOMBRE` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `APELLIDOS` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `PASSWORD` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `CARRITO` varchar(128) COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `email_usuario` (`EMAIL`),
  UNIQUE KEY `nick_usuario` (`NICK`)
);

CREATE TABLE tarjeta_bancaria (
  `NUMERO` int NOT NULL,
  `CVV` int DEFAULT NULL,
  `FECHA_CADUC` date DEFAULT NULL,
  `ID_USUARIO` int DEFAULT NULL,
  PRIMARY KEY (`NUMERO`),
  KEY `FK_TAR_IDUS_USU_ID` (`ID_USUARIO`),
  CONSTRAINT `FK_TAR_IDUS_USU_ID` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID`)
);

CREATE TABLE compania (
  `ID` int NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
);

CREATE TABLE juego (
  `ID` int NOT NULL,
  `TITULO` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `RUTA` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `PORTADA` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `DESARROLLADOR` int NOT NULL,
  `DISTRIBUIDOR` int NOT NULL,
  `ANIO` year NOT NULL,
  PRIMARY KEY (`ID`),
  CONSTRAINT `FK_JDEV_IDJ_COM_ID` FOREIGN KEY (`DESARROLLADOR`) REFERENCES `compania` (`ID`),
  CONSTRAINT `FK_JDIS_IDJ_COM_ID` FOREIGN KEY (`DISTRIBUIDOR`) REFERENCES `compania` (`ID`),
  UNIQUE KEY `RUTA` (`RUTA`)
);

CREATE TABLE regala (
  `ID_JUEGO` int NOT NULL,
  `ID_US1` int NOT NULL,
  `ID_US2` int NOT NULL,
  `FECHA` date NOT NULL,
  PRIMARY KEY (`ID_JUEGO`,`ID_US1`,`ID_US2`),
  KEY `FK_REG_IDU1_USU_ID` (`ID_US1`),
  KEY `FK_REG_IDU2_USU_ID` (`ID_US2`),
  CONSTRAINT `FK_REG_IDJ_JUE_ID` FOREIGN KEY (`ID_JUEGO`) REFERENCES `juego` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `FK_REG_IDU1_USU_ID` FOREIGN KEY (`ID_US1`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `FK_REG_IDU2_USU_ID` FOREIGN KEY (`ID_US2`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE
);

CREATE TABLE presta (
  `ID_JUEGO` int NOT NULL,
  `ID_U1` int NOT NULL,
  `ID_U2` int NOT NULL,
  `FECHA` date NOT NULL,
  PRIMARY KEY (`ID_JUEGO`,`ID_U1`,`ID_U2`,`FECHA`),
  KEY `FK_PRES_IDU1_USU_ID` (`ID_U1`),
  KEY `FK_PRES_IDU2_USU_ID` (`ID_U2`),
  CONSTRAINT `FK_PRES_IDJ_JUE_ID` FOREIGN KEY (`ID_JUEGO`) REFERENCES `juego` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `FK_PRES_IDU1_USU_ID` FOREIGN KEY (`ID_U1`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_PRES_IDU2_USU_ID` FOREIGN KEY (`ID_U2`) REFERENCES `usuario` (`id`) ON DELETE CASCADE
);

CREATE TABLE posee (
  `ID_USUARIO` int NOT NULL,
  `ID_JUEGO` int NOT NULL,
  `FECHA` date NOT NULL,
  PRIMARY KEY (`ID_USUARIO`,`ID_JUEGO`),
  KEY `FK_COMP_IDJU_JUE_ID` (`ID_JUEGO`),
  CONSTRAINT `FK_COMP_IDJU_JUE_ID` FOREIGN KEY (`ID_JUEGO`) REFERENCES `juego` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `FK_COMP_IDUS_USU_ID` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE
);

CREATE TABLE genero (
  `ID` int NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
);

CREATE TABLE juego_genero (
  `ID_JUEGO` int NOT NULL,
  `ID_GENERO` int NOT NULL,
  PRIMARY KEY (`ID_JUEGO`,`ID_GENERO`),
  KEY `FK_JGEN_IDJ_GEN_ID` (`ID_GENERO`),
  CONSTRAINT `FK_JGEN_IDJ_GEN_ID` FOREIGN KEY (`ID_GENERO`) REFERENCES `genero` (`ID`),
  CONSTRAINT `FK_JGEN_IDJ_JUE_ID` FOREIGN KEY (`ID_JUEGO`) REFERENCES `juego` (`ID`)
);

CREATE TABLE `genero_genero` (
  `ID_G1` int NOT NULL,
  `ID_G2` int NOT NULL,
  PRIMARY KEY (`ID_G1`,`ID_G2`),
  CONSTRAINT `FK_GREL_IDG1_GEN_ID` FOREIGN KEY (`ID_G1`) REFERENCES `genero` (`ID`)
);

CREATE TABLE sistema (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
);

CREATE TABLE juego_sistema (
  `ID_JUEGO` int NOT NULL,
  `ID_SIST` int NOT NULL,
  PRIMARY KEY (`ID_JUEGO`,`ID_SIST`),
  KEY `FK_JSIST_IDJ_SIST_ID` (`ID_SIST`),
  CONSTRAINT `FK_JSIST_IDJ_JUE_ID` FOREIGN KEY (`ID_JUEGO`) REFERENCES `juego` (`ID`),
  CONSTRAINT `FK_JSIST_IDJ_SIST_ID` FOREIGN KEY (`ID_SIST`) REFERENCES `sistema` (`ID`)
);

CREATE TABLE `juego_juego` (
  `ID_J1` int NOT NULL,
  `ID_J2` int NOT NULL,
  PRIMARY KEY (`ID_J1`,`ID_J2`),
  KEY `FK_JREL_IDJ2_JUE_ID` (`ID_J2`),
  CONSTRAINT `FK_JREL_IDJ1_JUE_ID` FOREIGN KEY (`ID_J1`) REFERENCES `juego` (`ID`),
  CONSTRAINT `FK_JREL_IDJ2_JUE_ID` FOREIGN KEY (`ID_J2`) REFERENCES `juego` (`ID`)
);

CREATE TABLE carrito (
  `ID_USUARIO` int NOT NULL,
  `ID_JUEGO` int NOT NULL,
  PRIMARY KEY (`ID_USUARIO`,`ID_JUEGO`),
  CONSTRAINT `FK_CARR_IDJU_JUE_ID` FOREIGN KEY (`ID_JUEGO`) REFERENCES `juego` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `FK_CARR_IDUS_USU_ID` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE
);

#Users
INSERT INTO usuario(EMAIL, NICK, NOMBRE, APELLIDOS, PASSWORD, ROLE) VALUES('user@gmail.com','user','user','user','$2a$12$/.57XI5riojUPwXeoQXX9O/ru1XsQ5MRSsj8lZAo85sJb2b0tbEsi', 'user');
INSERT INTO usuario(EMAIL, NICK, NOMBRE, APELLIDOS, PASSWORD, ROLE) VALUES('admin@gmail.com','admin','admin','admin','$2y$10$xiAIe5dxN/fi39Jq08f1nu3BLCnuU7OBhcHoDcuDnVNJqtrOZUJzK', 'admin');

#Empresa
INSERT INTO compania(ID, NOMBRE) VALUES (20858, 'Plug In Digital SAS');
INSERT INTO compania(ID, NOMBRE) VALUES (6920, 'Kylotonn Entertainment');
INSERT INTO compania(ID, NOMBRE) VALUES (16712, 'Uranium Software');
INSERT INTO compania(ID, NOMBRE) VALUES (24675, 'Night School Studio, LLC');
INSERT INTO compania(ID, NOMBRE) VALUES (23619, 'Nyamyam Ltd.');
INSERT INTO compania(ID, NOMBRE) VALUES (26326, 'Netflix Inc.');

#Games
INSERT INTO juego (ID, TITULO, RUTA, PORTADA, DESARROLLADOR, DISTRIBUIDOR, ANIO) VALUES (150886, 'Truck Racer', 'algo', 'img/game-thumbnail/150886.webp', 6920, 20858,2013);
INSERT INTO juego (ID, TITULO, RUTA, PORTADA, DESARROLLADOR, DISTRIBUIDOR, ANIO) VALUES (63690, 'Pako 2', 'algo2', 'img/game-thumbnail/63690.webp', 16712, 16712,1995);
INSERT INTO juego (ID, TITULO, RUTA, PORTADA, DESARROLLADOR, DISTRIBUIDOR, ANIO) VALUES (136678, 'Afterparty', 'algo3', 'img/game-thumbnail/136678.webp', 24675, 24675,2020);
INSERT INTO juego (ID, TITULO, RUTA, PORTADA, DESARROLLADOR, DISTRIBUIDOR, ANIO) VALUES (73736, 'Tengami', 'algo4', 'img/game-thumbnail/73736.webp', 23619, 23619,2014);
INSERT INTO juego (ID, TITULO, RUTA, PORTADA, DESARROLLADOR, DISTRIBUIDOR, ANIO) VALUES (190922, 'Oxenfree II: Lost Signals',  'algo5','img/game-thumbnail/190922.webp', 24675, 26326,2023);

#Ownership
INSERT INTO posee(ID_USUARIO, ID_JUEGO, FECHA) VALUES (1,150886, date(now()));
INSERT INTO posee(ID_USUARIO, ID_JUEGO, FECHA) VALUES (1,63690, date(now()));

#Genre
INSERT INTO genero(ID, NOMBRE) VALUES (1, 'Action');
INSERT INTO genero(ID, NOMBRE) VALUES (2, 'Adventure');
INSERT INTO genero(ID, NOMBRE) VALUES (62, 'Add-on');
INSERT INTO genero(ID, NOMBRE) VALUES (76, 'Compilation');
INSERT INTO genero(ID, NOMBRE) VALUES (12, 'Educational');

#Systems
INSERT INTO sistema(ID, nombre) VALUES (1,'Linux');
INSERT INTO sistema(ID, nombre) VALUES (2,'DOS');
INSERT INTO sistema(ID, nombre) VALUES (3,'Windows');
INSERT INTO sistema(ID, nombre) VALUES (4,'PC Booter');
INSERT INTO sistema(ID, nombre) VALUES (5,'Windows 3.x');
