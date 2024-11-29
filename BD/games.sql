-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2024 a las 18:35:27
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `games`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `ID_USUARIO` int(11) NOT NULL,
  `ID_JUEGO` int(11) NOT NULL,
  `FECHA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero_rel`
--

CREATE TABLE `genero_rel` (
  `ID_G1` int(11) NOT NULL,
  `ID_G2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juego`
--

CREATE TABLE `juego` (
  `ID` int(11) NOT NULL,
  `TITULO` varchar(50) NOT NULL,
  `RUTA` varchar(100) NOT NULL,
  `DESARROLLADOR` varchar(50) NOT NULL,
  `DISTRIBUIDOR` varchar(50) NOT NULL,
  `ANIO` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juego_gen`
--

CREATE TABLE `juego_gen` (
  `ID_JUEGO` int(11) NOT NULL,
  `ID_GEN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juego_rel`
--

CREATE TABLE `juego_rel` (
  `ID_J1` int(11) NOT NULL,
  `ID_J2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juego_sist`
--

CREATE TABLE `juego_sist` (
  `ID_JUEGO` int(11) NOT NULL,
  `ID_SIST` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presta`
--

CREATE TABLE `presta` (
  `ID_JUEGO` int(11) NOT NULL,
  `ID_U1` int(11) NOT NULL,
  `ID_U2` int(11) NOT NULL,
  `FECHA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regala`
--

CREATE TABLE `regala` (
  `ID_JUEGO` int(11) NOT NULL,
  `ID_US1` int(11) NOT NULL,
  `ID_US2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sistema`
--

CREATE TABLE `sistema` (
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetabancaria`
--

CREATE TABLE `tarjetabancaria` (
  `NUMERO` int(11) NOT NULL,
  `CCV` int(3) DEFAULT NULL,
  `FECHA_CADUC` date DEFAULT NULL,
  `ID_USUARIO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nick` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`ID_USUARIO`,`ID_JUEGO`),
  ADD KEY `FK_COMP_IDJU_JUE_ID` (`ID_JUEGO`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `genero_rel`
--
ALTER TABLE `genero_rel`
  ADD PRIMARY KEY (`ID_G1`,`ID_G2`);

--
-- Indices de la tabla `juego`
--
ALTER TABLE `juego`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RUTA` (`RUTA`);

--
-- Indices de la tabla `juego_gen`
--
ALTER TABLE `juego_gen`
  ADD PRIMARY KEY (`ID_JUEGO`,`ID_GEN`),
  ADD KEY `FK_JGEN_IDJ_GEN_ID` (`ID_GEN`);

--
-- Indices de la tabla `juego_rel`
--
ALTER TABLE `juego_rel`
  ADD PRIMARY KEY (`ID_J1`,`ID_J2`),
  ADD KEY `FK_JREL_IDJ2_JUE_ID` (`ID_J2`);

--
-- Indices de la tabla `juego_sist`
--
ALTER TABLE `juego_sist`
  ADD PRIMARY KEY (`ID_JUEGO`,`ID_SIST`),
  ADD KEY `FK_JSIST_IDJ_SIST_ID` (`ID_SIST`);

--
-- Indices de la tabla `presta`
--
ALTER TABLE `presta`
  ADD PRIMARY KEY (`ID_JUEGO`,`ID_U1`,`ID_U2`,`FECHA`),
  ADD KEY `FK_PRES_IDU1_USU_ID` (`ID_U1`),
  ADD KEY `FK_PRES_IDU2_USU_ID` (`ID_U2`);

--
-- Indices de la tabla `regala`
--
ALTER TABLE `regala`
  ADD PRIMARY KEY (`ID_JUEGO`,`ID_US1`,`ID_US2`),
  ADD KEY `FK_REG_IDU1_USU_ID` (`ID_US1`),
  ADD KEY `FK_REG_IDU2_USU_ID` (`ID_US2`);

--
-- Indices de la tabla `sistema`
--
ALTER TABLE `sistema`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tarjetabancaria`
--
ALTER TABLE `tarjetabancaria`
  ADD PRIMARY KEY (`NUMERO`),
  ADD KEY `FK_TAR_IDUS_USU_ID` (`ID_USUARIO`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nick` (`nick`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `FK_COMP_IDJU_JUE_ID` FOREIGN KEY (`ID_JUEGO`) REFERENCES `juego` (`ID`),
  ADD CONSTRAINT `FK_COMP_IDUS_USU_ID` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `genero_rel`
--
ALTER TABLE `genero_rel`
  ADD CONSTRAINT `FK_GREL_IDG1_GEN_ID` FOREIGN KEY (`ID_G1`) REFERENCES `genero` (`ID`);

--
-- Filtros para la tabla `juego_gen`
--
ALTER TABLE `juego_gen`
  ADD CONSTRAINT `FK_JGEN_IDJ_GEN_ID` FOREIGN KEY (`ID_GEN`) REFERENCES `genero` (`ID`),
  ADD CONSTRAINT `FK_JGEN_IDJ_JUE_ID` FOREIGN KEY (`ID_JUEGO`) REFERENCES `juego` (`ID`);

--
-- Filtros para la tabla `juego_rel`
--
ALTER TABLE `juego_rel`
  ADD CONSTRAINT `FK_JREL_IDJ1_JUE_ID` FOREIGN KEY (`ID_J1`) REFERENCES `juego` (`ID`),
  ADD CONSTRAINT `FK_JREL_IDJ2_JUE_ID` FOREIGN KEY (`ID_J2`) REFERENCES `juego` (`ID`);

--
-- Filtros para la tabla `juego_sist`
--
ALTER TABLE `juego_sist`
  ADD CONSTRAINT `FK_JSIST_IDJ_JUE_ID` FOREIGN KEY (`ID_JUEGO`) REFERENCES `juego` (`ID`),
  ADD CONSTRAINT `FK_JSIST_IDJ_SIST_ID` FOREIGN KEY (`ID_SIST`) REFERENCES `sistema` (`ID`);

--
-- Filtros para la tabla `presta`
--
ALTER TABLE `presta`
  ADD CONSTRAINT `FK_PRES_IDJ_JUE_ID` FOREIGN KEY (`ID_JUEGO`) REFERENCES `juego` (`ID`),
  ADD CONSTRAINT `FK_PRES_IDU1_USU_ID` FOREIGN KEY (`ID_U1`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_PRES_IDU2_USU_ID` FOREIGN KEY (`ID_U2`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `regala`
--
ALTER TABLE `regala`
  ADD CONSTRAINT `FK_REG_IDJ_JUE_ID` FOREIGN KEY (`ID_JUEGO`) REFERENCES `juego` (`ID`),
  ADD CONSTRAINT `FK_REG_IDU1_USU_ID` FOREIGN KEY (`ID_US1`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_REG_IDU2_USU_ID` FOREIGN KEY (`ID_US2`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `tarjetabancaria`
--
ALTER TABLE `tarjetabancaria`
  ADD CONSTRAINT `FK_TAR_IDUS_USU_ID` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
