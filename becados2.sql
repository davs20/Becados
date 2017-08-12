-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-04-2017 a las 23:32:32
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `becados2`
--
CREATE DATABASE IF NOT EXISTS `becados2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `becados2`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `ID_Usuario` varchar(13) NOT NULL,
  `Contrasena` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`ID_Usuario`, `Contrasena`) VALUES
('0101199702515', '09dejulio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `ID_Carrera` int(11) NOT NULL,
  `Nombre_Carrera` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`ID_Carrera`, `Nombre_Carrera`) VALUES
(1, 'Ingenieria En Ciencias De la Computacion'),
(2, 'Ingenieria Civil'),
(3, 'Ingenieria Industrial'),
(4, 'Ingenieria Ambiental'),
(5, 'Arquitectura'),
(6, 'Derecho'),
(7, 'Teologia'),
(8, 'Relaciones Internacionales'),
(9, 'Gestion Estrategica de Empresas'),
(10, 'Psicologia'),
(11, 'Odontologia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `DepartamentoID` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`DepartamentoID`, `Nombre`) VALUES
(1, 'Contabilidad'),
(2, 'Pastoral'),
(3, 'Bienestar'),
(4, 'Registro'),
(5, 'Auditoria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `ID_Usuario` varchar(13) NOT NULL,
  `Contrasena` varchar(25) NOT NULL,
  `Invitado` varchar(1) NOT NULL,
  `Correo_Electronico` varchar(45) NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL,
  `Nombre_Completo` varchar(45) NOT NULL,
  `Numero_Telefono` varchar(9) NOT NULL,
  `ID_Carrera` int(11) NOT NULL,
  `Meta` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`ID_Usuario`, `Contrasena`, `Invitado`, `Correo_Electronico`, `Fecha_Ingreso`, `Nombre_Completo`, `Numero_Telefono`, `ID_Carrera`, `Meta`) VALUES
('0104119640005', '123', '0', 'davdelcid@unicah.edu', '2016-03-26 00:00:00', 'Pedro Delcid', '98970923', 9, '1'),
('0104199602581', '1235', '0', 'casmoncada@gmail.com', '2015-03-08 00:00:00', 'Castulo Moncada', '95966058', 1, NULL),
('0104199802516', '', '0', 'franando14@gmail.com', '2016-05-01 00:00:00', 'Fernando Delcid', '95879936', 2, NULL),
('0107199804563', '0907', '0', 'elbrayan@gmail.com', '2014-07-05 00:00:00', 'Kevin Velasquez', '95954520', 8, '1'),
('0108199509782', '0123', '0', 'vladimir_delcid@outlook.con', '2016-03-26 00:00:00', 'Vlad rivera', '95242952', 10, NULL),
('0108199602584', 'masa', '0', 'karloskevin@yahoo.com', '2015-01-14 00:00:00', 'Carlos Kevi', '91915465', 2, NULL),
('0805196400003', 'blanca', '0', 'blanca@m.com', '2017-03-09 00:00:00', 'Blanca Luz ', '24426450', 4, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas_laboradas`
--

CREATE TABLE `horas_laboradas` (
  `ID_Usuario` varchar(25) NOT NULL,
  `Fecha_Inicio` datetime NOT NULL,
  `DepartamentoID` int(11) NOT NULL,
  `Comentario` varchar(100) DEFAULT NULL,
  `Horas_Cumplidas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `horas_laboradas`
--

INSERT INTO `horas_laboradas` (`ID_Usuario`, `Fecha_Inicio`, `DepartamentoID`, `Comentario`, `Horas_Cumplidas`) VALUES
('0104119640005', '2017-03-28 14:00:00', 1, NULL, 3),
('0104119640005', '2017-03-29 00:00:00', 3, NULL, 3),
('0104119640005', '2017-03-29 18:00:00', 3, NULL, 2),
('0104199602581', '2017-03-28 06:00:00', 3, NULL, 2),
('0104199602581', '2017-04-06 00:00:00', 2, NULL, 3),
('0104199802516', '2017-03-29 00:00:00', 2, NULL, 1),
('0107199804563', '2017-03-27 06:00:00', 3, NULL, 2),
('0107199804563', '2017-04-03 00:00:00', 5, NULL, 898);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `new2_view`
--
CREATE TABLE `new2_view` (
`ID_Usuario` varchar(25)
,`SUM(Horas_Cumplidas)` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `new3_view`
--
CREATE TABLE `new3_view` (
`ID_Usuario` varchar(25)
,`horas_totales` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `new2_view`
--
DROP TABLE IF EXISTS `new2_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `new2_view`  AS  select `horas_laboradas`.`ID_Usuario` AS `ID_Usuario`,sum(`horas_laboradas`.`Horas_Cumplidas`) AS `SUM(Horas_Cumplidas)` from `horas_laboradas` group by `horas_laboradas`.`ID_Usuario` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `new3_view`
--
DROP TABLE IF EXISTS `new3_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `new3_view`  AS  select `horas_laboradas`.`ID_Usuario` AS `ID_Usuario`,sum(`horas_laboradas`.`Horas_Cumplidas`) AS `horas_totales` from `horas_laboradas` group by `horas_laboradas`.`ID_Usuario` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`ID_Usuario`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`ID_Carrera`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`DepartamentoID`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD KEY `ID_Carrera` (`ID_Carrera`);

--
-- Indices de la tabla `horas_laboradas`
--
ALTER TABLE `horas_laboradas`
  ADD PRIMARY KEY (`ID_Usuario`,`Fecha_Inicio`),
  ADD KEY `DepartamentoID` (`DepartamentoID`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`ID_Carrera`) REFERENCES `carreras` (`ID_Carrera`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `horas_laboradas`
--
ALTER TABLE `horas_laboradas`
  ADD CONSTRAINT `ID_Usuario` FOREIGN KEY (`ID_Usuario`) REFERENCES `estudiantes` (`ID_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `horas_laboradas_ibfk_1` FOREIGN KEY (`DepartamentoID`) REFERENCES `departamento` (`DepartamentoID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
