-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2025 a las 23:30:19
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
-- Base de datos: `proadmi5`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `idestado` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`idestado`, `estado`) VALUES
(1, 'Amazonas'),
(2, 'Anzoátegui'),
(3, 'Apure'),
(4, 'Aragua'),
(5, 'Barinas'),
(6, 'Bolívar'),
(7, 'Carabobo'),
(8, 'Cojedes'),
(9, 'Distrito Capital'),
(10, 'Falcón'),
(11, 'Guárico'),
(12, 'Lara'),
(13, 'Mérida'),
(14, 'Miranda'),
(15, 'Monagas'),
(16, 'Nueva Esparta'),
(17, 'Potuguesa'),
(18, 'Sucre'),
(19, 'Táchira'),
(20, 'Trujillo'),
(21, 'Vargas'),
(22, 'Yaracuy'),
(23, 'Zulia'),
(24, 'Delta Amacuro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `idmunicipio` int(11) NOT NULL,
  `idestado` int(11) NOT NULL,
  `municipio` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`idmunicipio`, `idestado`, `municipio`) VALUES
(1, 1, 'Atures'),
(2, 1, 'Alto Orinoco'),
(3, 1, 'Atabapo'),
(4, 1, 'Autana'),
(5, 1, 'Manapiare'),
(6, 1, 'Maroa'),
(7, 1, 'Río Negro'),
(8, 2, 'Anaco'),
(9, 2, 'Aragua'),
(10, 2, 'Bolívar'),
(11, 2, 'Bruzual'),
(12, 2, 'Cajigal'),
(13, 2, 'Carvajal'),
(14, 2, 'Diego Bautista Urbaneja'),
(15, 2, 'Freites'),
(16, 2, 'Guanipa'),
(17, 2, 'Guanta'),
(18, 2, 'Independencia'),
(19, 2, 'Libertad'),
(20, 2, 'McGregor'),
(21, 2, 'Miranda'),
(22, 2, 'Monagas'),
(23, 2, 'Peñalver'),
(24, 2, 'Píritu'),
(25, 2, 'San Juan de Capistrano'),
(26, 2, 'Santa Ana'),
(27, 2, 'Simón Rodriguez'),
(28, 2, 'Sotillo'),
(29, 3, 'Achaguas'),
(30, 3, 'Biruaca'),
(31, 3, 'Muñoz'),
(32, 3, 'Páez'),
(33, 3, 'Pedro Camejo'),
(34, 3, 'Rómulo Gallegos'),
(35, 3, 'San Fernando'),
(36, 4, 'Bolívar'),
(37, 4, 'Camatagua'),
(38, 4, 'Francisco Linares Alcántara'),
(39, 4, 'Girardot'),
(40, 4, 'José Ángel Lamas'),
(41, 4, 'José Félix Ribas'),
(42, 4, 'José Rafael Revenga'),
(43, 4, 'Libertador'),
(44, 4, 'Mario Briceño Iragorry'),
(45, 4, 'Ocumare de la Costa de Oro'),
(46, 4, 'San Casimiro'),
(47, 4, 'San Sebastián'),
(48, 4, 'Santiago Mariño'),
(49, 4, 'Santos Michelena'),
(50, 4, 'Sucre'),
(51, 4, 'Tovar'),
(52, 4, 'Urdaneta'),
(53, 4, 'Zamora'),
(54, 5, 'Alberto Arvelo Torrealba'),
(55, 5, 'Andrés Eloy Blanco'),
(56, 5, 'Antonio José de Sucre'),
(57, 5, 'Arismendi'),
(58, 5, 'Barinas'),
(59, 5, 'Bolívar'),
(60, 5, 'Cruz Paredes'),
(61, 5, 'Ezequiel Zamora'),
(62, 5, 'Obispos'),
(63, 5, 'Pedraza'),
(64, 5, 'Rojas'),
(65, 5, 'Sosa'),
(66, 6, 'Caroní'),
(67, 6, 'Cedeño'),
(68, 6, 'El Callao'),
(69, 6, 'Gran Sabana'),
(70, 6, 'Heres'),
(71, 6, 'Piar'),
(72, 6, 'Raúl Leoni'),
(73, 6, 'Roscio'),
(74, 6, 'Sifontes'),
(75, 6, 'Sucre'),
(76, 6, 'Padre Pedro Chen'),
(77, 7, 'Bejuma'),
(78, 7, 'Carlos Arvelo'),
(79, 7, 'Diego Ibarra'),
(80, 7, 'Guacara'),
(81, 7, 'Juan José Mora'),
(82, 7, 'Libertador'),
(83, 7, 'Los Guayos'),
(84, 7, 'Miranda'),
(85, 7, 'Montalbán'),
(86, 7, 'Naguanagua'),
(87, 7, 'Puerto Cabello'),
(88, 7, 'San Diego'),
(89, 7, 'San Joaquín'),
(90, 7, 'Valencia'),
(91, 8, 'Anzoátegui'),
(92, 8, 'Falcón'),
(93, 8, 'Girardot'),
(94, 8, 'Lima Blanco'),
(95, 8, 'Pao de San Juan Bautista'),
(96, 8, 'Ricaurte'),
(97, 8, 'Rómulo Gallegos'),
(98, 9, 'Libertador'),
(99, 10, 'Acosta'),
(100, 10, 'Bolívar'),
(101, 10, 'Buchivacoa'),
(102, 10, 'Cacique Manaure'),
(103, 10, 'Carirubana'),
(104, 10, 'Colina'),
(105, 10, 'Dabajuro'),
(106, 10, 'Democracia'),
(107, 10, 'Falcón'),
(108, 10, 'Federación'),
(109, 10, 'Jacura'),
(110, 10, 'Los Taques'),
(111, 10, 'Mauroa'),
(112, 10, 'Miranda'),
(113, 10, 'Monseñor Iturriza'),
(114, 10, 'Palmasola'),
(115, 10, 'Petit'),
(116, 10, 'Píritu'),
(117, 10, 'San Francisco'),
(118, 10, 'Silva'),
(119, 10, 'Sucre'),
(120, 10, 'Tocópero'),
(121, 10, 'Unión'),
(122, 10, 'Urumaco'),
(123, 10, 'Zamora'),
(124, 11, 'Esteros de Camaguan'),
(125, 11, 'Chaguaramas'),
(126, 11, 'El Socorro'),
(127, 11, 'Francisco de Miranda'),
(128, 11, 'José Félix Ribas'),
(129, 11, 'José Tadeo Monagas'),
(130, 11, 'Juan Germán Roscio'),
(131, 11, 'Julián Mellado'),
(132, 11, 'Las Mercedes'),
(133, 11, 'Leonardo Infante'),
(134, 11, 'Pedro Zaraza'),
(135, 11, 'Ortíz'),
(136, 11, 'San Gerónimo de Guayabal'),
(137, 11, 'San José de Guaribe'),
(138, 11, 'Santa María de Ipire'),
(139, 12, 'Andrés Eloy Blanco'),
(140, 12, 'Crespo'),
(141, 12, 'Iribarren'),
(142, 12, 'Jiménez'),
(143, 12, 'Morán'),
(144, 12, 'Palavecino'),
(145, 12, 'Simón Planas'),
(146, 12, 'Torres'),
(147, 12, 'Urdaneta'),
(148, 13, 'Alberto Adriani'),
(149, 13, 'Andrés Bello'),
(150, 13, 'Antonio Pinto Salinas'),
(151, 13, 'Sucre'),
(152, 13, 'Tovar'),
(153, 13, 'Tulio Febres Cordero'),
(154, 13, 'Zea'),
(155, 14, 'Acevedo'),
(156, 14, 'Andrés Bello'),
(157, 14, 'Baruta'),
(158, 14, 'Brión'),
(159, 14, 'Buroz'),
(160, 14, 'Carrizal'),
(161, 14, 'Chacao'),
(162, 14, 'Cristóbal Rojas'),
(163, 14, 'El Hatillo'),
(164, 14, 'Guaicaipuro'),
(165, 14, 'Independencia'),
(166, 14, 'Lander'),
(167, 14, 'Los Salias'),
(168, 14, 'Páez'),
(169, 14, 'Paz Castillo'),
(170, 14, 'Pedro Gual'),
(171, 14, 'Plaza'),
(172, 14, 'Simón Bolívar'),
(173, 14, 'Sucre'),
(174, 14, 'Urdaneta'),
(175, 14, 'Zamora'),
(176, 15, 'Acosta'),
(177, 15, 'Aguasay'),
(178, 15, 'Bolívar'),
(179, 15, 'Cedeño'),
(180, 15, 'Ezequiel Zamora'),
(181, 15, 'Libertador'),
(182, 15, 'Maturín'),
(183, 15, 'Piar'),
(184, 15, 'Punceres'),
(185, 15, 'Santa Bárbara'),
(186, 15, 'Sotillo'),
(187, 15, 'Uracoa'),
(188, 16, 'Antolín del Campo'),
(189, 16, 'Arismendi'),
(190, 16, 'Díaz'),
(191, 16, 'García'),
(192, 16, 'Gómez'),
(193, 16, 'Maneiro'),
(194, 16, 'Marcano'),
(195, 16, 'Mariño'),
(196, 16, 'Península de Macanao'),
(197, 16, 'Tubores'),
(198, 16, 'Villalba'),
(199, 17, 'Agua Blanca'),
(200, 17, 'Araure'),
(201, 17, 'Esteller'),
(202, 17, 'Guanare'),
(203, 17, 'Guanarito'),
(204, 17, 'Monseñor José Vicenti de Unda'),
(205, 17, 'Ospino'),
(206, 17, 'Páez'),
(207, 17, 'Papelon'),
(208, 17, 'San Genaro de Boconoíto'),
(209, 17, 'San Rafael de Onoto'),
(210, 17, 'Santa Rosalía'),
(211, 17, 'Sucre'),
(212, 17, 'Turén'),
(213, 18, 'Andrés Eloy Blanco'),
(214, 18, 'Andrés Mata'),
(215, 18, 'Arismendi'),
(216, 18, 'Benítez'),
(217, 18, 'Bermúdez'),
(218, 18, 'Bolívar'),
(219, 18, 'Cajigal'),
(220, 18, 'Cruz Salmerón Acosta'),
(221, 18, 'Libertador'),
(222, 18, 'Mariño'),
(223, 18, 'Mejía'),
(224, 18, 'Montes'),
(225, 18, 'Ribero'),
(226, 18, 'Sucre'),
(227, 18, 'Valdez'),
(228, 19, 'Andrés Bello'),
(229, 19, 'Antonio Rómulo Costa'),
(230, 19, 'Ayacucho'),
(231, 19, 'Bolívar'),
(232, 19, 'Cárdenas'),
(233, 19, 'Córdoba'),
(234, 19, 'Fernández Feo'),
(235, 19, 'Francisco de Miranda'),
(236, 19, 'García de Hevia'),
(237, 19, 'Guásimos'),
(238, 19, 'Independencia'),
(239, 19, 'Jáuregui'),
(240, 19, 'José María Vargas'),
(241, 19, 'Junín'),
(242, 19, 'San Judas Tadeo'),
(243, 19, 'Libertad'),
(244, 19, 'Libertador'),
(245, 19, 'Lobatera'),
(246, 19, 'Michelena'),
(247, 19, 'Panamericano'),
(248, 19, 'Pedro María Ureña'),
(249, 19, 'Rafael Urdaneta'),
(250, 19, 'Samuel Dario Maldonado'),
(251, 19, 'San Cristóbal'),
(252, 19, 'Seboruco'),
(253, 19, 'Simón Rodríguez'),
(254, 19, 'Sucre'),
(255, 19, 'Torbes'),
(256, 19, 'Uribante'),
(257, 20, 'Andrés Bello'),
(258, 20, 'Boconó'),
(259, 20, 'Bolívar'),
(260, 20, 'Candelaria'),
(261, 20, 'Carache'),
(262, 20, 'Escuque'),
(263, 20, 'José Felipe Márquez Cañizalez'),
(264, 20, 'Juan Vicente Campos Elías'),
(265, 20, 'La Ceiba'),
(266, 20, 'Miranda'),
(267, 20, 'Pampán'),
(268, 20, 'Trujillo'),
(269, 20, 'Andres Linares'),
(270, 20, 'Pampanito'),
(271, 21, 'Vargas'),
(272, 22, 'Arístides Bastidas'),
(273, 22, 'Bolívar'),
(274, 22, 'Bruzual'),
(275, 22, 'Cocorote'),
(276, 22, 'Independencia'),
(277, 23, 'Almirante Padilla'),
(278, 23, 'Baralt'),
(279, 23, 'Cabimas'),
(280, 23, 'Catatumbo'),
(281, 23, 'Colón'),
(282, 23, 'Francisco Javier Pulgar'),
(283, 23, 'Jesús Enrique Losada'),
(284, 23, 'Jesús María Semprún'),
(285, 24, 'Antonio Díaz'),
(286, 24, 'Casacoima'),
(287, 24, 'Pedernales'),
(288, 24, 'tucupita');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idestado`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`idmunicipio`),
  ADD KEY `idestado` (`idestado`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_ibfk_1` FOREIGN KEY (`idestado`) REFERENCES `estados` (`idestado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
