-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2016 a las 08:19:43
-- Versión del servidor: 5.5.49-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `DB`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

create database crud_users;
use crud_users;

CREATE TABLE IF NOT EXISTS `usuario` (
  `user` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `sex` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `birthdate` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `age` int(2) NOT NULL,
  `country` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `language` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `comment` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `hobby` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`user`, `pass`, `name`, `dni`, `sex`, `birthdate`, `age`, `country`, `language`, `comment`, `hobby`) VALUES
('ancoca', 'User-123', 'angel', '48292627X', 'Hombre', '19/07/1993', 22, 'Francia', 'Ingles:Frances:', 'Welcome to this page', 'Informatica:Alimentacion:Automovil:'),
('daurgil', 'User-123', 'david', '87654321X', 'Hombre', '06/06/1990', 25, 'EspaÃ±a', 'EspaÃ±ol:Ingles:', 'Hoal mundo', 'Informatica:'),
('usuario', 'User-123', 'usuario', '12345678Z', 'Hombre', '16/05/1980', 36, 'EspaÃ±a', 'Ingles:', 'Adios mundo', 'Informatica:Automovil:');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
