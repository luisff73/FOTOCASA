-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-12-2023 a las 11:32:25
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
-- Base de datos: `fotocasa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmueble`
--

CREATE TABLE `inmueble` (
  `id` int(11) NOT NULL,
  `ref_catastral` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `m2` varchar(50) NOT NULL,
  `habitaciones` varchar(50) NOT NULL,
  `localidad` varchar(50) NOT NULL,
  `extras` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `precio` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `fecha_publicacion` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inmueble`
--

INSERT INTO `inmueble` (`id`, `ref_catastral`, `tipo`, `m2`, `habitaciones`, `localidad`, `extras`, `estado`, `precio`, `activo`, `fecha_publicacion`) VALUES
(80, 'absssdd', 'vivienda', '50', '2', 'albaida', '', 'Buen estado', '5600', 1, '12/12/2023'),
(88, 'dsfg', 'vivienda', '346', '2', 'montixelvo', '', 'Buen estado', '56335', 1, '18/12/2023'),
(90, 'ab', 'Adosado', '346', '2', 'VIELLA-SIERO', '', 'Buen estado', '56', 1, '21/12/2023'),
(91, 'abcc', 'Terreno', '50', '4', 'VALENCIA', 'Ascensor:Calefaccion central:', 'A estrenar', '56', 1, '21/12/2023'),
(92, 'abccsdf', 'Piso', '50', '4', 'VALENCIA', 'Aire acondicionado:Terraza:Piscina:', 'Buen estado', '56', 1, '18/12/2023');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inmueble`
--
ALTER TABLE `inmueble`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inmueble`
--
ALTER TABLE `inmueble`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
