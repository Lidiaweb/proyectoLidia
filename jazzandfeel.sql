-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2021 a las 16:27:03
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jazzandfeel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `idEvento` int(11) NOT NULL,
  `fk_tipo` int(11) NOT NULL,
  `fk_lugar` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugarevent`
--

CREATE TABLE `lugarevent` (
  `idLugar` int(11) NOT NULL,
  `poblacion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lugarevent`
--

INSERT INTO `lugarevent` (`idLugar`, `poblacion`) VALUES
(1, 'Aguadulce'),
(2, 'Alanis'),
(3, 'Albaida del Aljarafe'),
(4, 'Alcala de Guadaira'),
(5, 'Alcala del Rio'),
(6, 'Alcolea del Rio'),
(7, 'Algaba, La'),
(8, 'Algamitas'),
(9, 'Almaden de la Plata'),
(10, 'Almensilla'),
(11, 'Arahal'),
(12, 'Aznalcazar'),
(13, 'Aznalcollar'),
(14, 'Badolatosa'),
(15, 'Benacazón'),
(16, 'Bollullos de la Mitacion'),
(17, 'Bormujos'),
(18, 'Brenes'),
(19, 'Burguillos'),
(20, 'Cabezas de San Juan, Las'),
(21, 'Camas'),
(22, 'Campana'),
(23, 'Cantillana'),
(24, 'Cañada Rosal'),
(25, 'Carmona'),
(26, 'Carrion de los Cespedes'),
(27, 'Casariche'),
(28, 'Castilblanco de los Arroyos'),
(29, 'Castilleja de Guzman'),
(30, 'Castilleja de la Cuesta'),
(31, 'Castilleja del Campo'),
(32, 'Castillo de las Guardas, El'),
(33, 'Cazalla de la Sierra'),
(34, 'Constantina'),
(35, 'Coria del Rio'),
(36, 'Coripe'),
(37, 'Coronil, El'),
(38, 'Corrales'),
(39, 'Cuervo de Sevilla, El'),
(40, 'Dos Hermanas'),
(41, 'Ecija'),
(42, 'Espartinas'),
(43, 'Estepa'),
(44, 'Fuentes de Andalucia'),
(45, 'Garrobo, El'),
(46, 'Gelves'),
(47, 'Gerena'),
(48, 'Gilena'),
(49, 'Gines'),
(50, 'Guadalcanal'),
(51, 'Guillena'),
(52, 'Herrera'),
(53, 'Huevar del Aljarafe'),
(54, 'Isla Mayor'),
(55, 'Lantejuela, La'),
(56, 'Lebrija'),
(57, 'Lora de Estepa'),
(58, 'Lora del Rio'),
(59, 'Luisiana'),
(60, 'Madroño, El'),
(61, 'Mairena del Alcor'),
(62, 'Mairena del Aljarafe'),
(63, 'Marchena'),
(64, 'Marinaleda'),
(65, 'Martin de la Jara'),
(66, 'Molares, Los'),
(67, 'Montellano'),
(68, 'Moron de la Frontera'),
(69, 'Navas de la Concepcion, Las'),
(70, 'Olivares'),
(71, 'Osuna'),
(72, 'Palacios y Villafranca'),
(73, 'Palomares del Rio'),
(74, 'Paradas'),
(75, 'Pedrera'),
(76, 'Pedroso'),
(77, 'Peñaflor'),
(78, 'Pilas'),
(79, 'Pruna'),
(80, 'Puebla de Cazalla'),
(81, 'Puebla de los Infantes'),
(82, 'Puebla del Rio, La'),
(83, 'Real de la Jara'),
(84, 'Rinconada, La'),
(85, 'Roda de Andalucia, La'),
(86, 'Ronquillo'),
(87, 'Rubio'),
(88, 'Salteras'),
(89, 'San Juan de Aznalfarache'),
(90, 'San Nicolas del Puerto'),
(91, 'Sanlucar la Mayor'),
(92, 'Santiponce'),
(93, 'Saucejo'),
(94, 'Sevilla'),
(95, 'Tocina'),
(96, 'Tomares'),
(97, 'Umbrete'),
(98, 'Utrera'),
(99, 'Valencina de la Concepcion'),
(100, 'Villamanrique de la Condesa'),
(101, 'Villanueva de San Juan'),
(102, 'Villanueva del Ariscal'),
(103, 'Villanueva del Rio y Minas'),
(104, 'Villaverde del Rio'),
(105, 'Viso del Alcor'),
(109, 'Otra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoevent`
--

CREATE TABLE `tipoevent` (
  `idTipoEvent` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoevent`
--

INSERT INTO `tipoevent` (`idTipoEvent`, `tipo`) VALUES
(1, 'Boda'),
(2, 'Evento para empresa'),
(3, 'Evento privado'),
(4, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tlf` int(11) NOT NULL,
  `tipo` char(1) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombreUsuario`, `apellido`, `email`, `tlf`, `tipo`, `pass`) VALUES
(136, 'Lidia', 'Gómez', 'contacto@jazzandfeel.com', 666777888, 'a', '$2y$10$Kn.F9H3/mwfXOWz5La1.Fezu7xeKClfmqFb4Z2YFle9ECidt.obbW');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`idEvento`),
  ADD KEY `fk_usuario` (`fk_usuario`),
  ADD KEY `fk_lugar` (`fk_lugar`) USING BTREE,
  ADD KEY `fk_tipo` (`fk_tipo`);

--
-- Indices de la tabla `lugarevent`
--
ALTER TABLE `lugarevent`
  ADD PRIMARY KEY (`idLugar`);

--
-- Indices de la tabla `tipoevent`
--
ALTER TABLE `tipoevent`
  ADD PRIMARY KEY (`idTipoEvent`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT de la tabla `lugarevent`
--
ALTER TABLE `lugarevent`
  MODIFY `idLugar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de la tabla `tipoevent`
--
ALTER TABLE `tipoevent`
  MODIFY `idTipoEvent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `evento_ibfk_2` FOREIGN KEY (`fk_tipo`) REFERENCES `tipoevent` (`idTipoEvent`),
  ADD CONSTRAINT `evento_ibfk_3` FOREIGN KEY (`fk_lugar`) REFERENCES `lugarevent` (`idLugar`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
