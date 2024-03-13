-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-03-2024 a las 15:45:49
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
-- Estructura de tabla para la tabla `adapted`
--

CREATE TABLE `adapted` (
  `id_adapted` int(11) NOT NULL,
  `adapted` varchar(50) NOT NULL DEFAULT 'Adaptada',
  `id_vivienda` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `adapted`
--

INSERT INTO `adapted` (`id_adapted`, `adapted`, `id_vivienda`) VALUES
(1, 'Adaptada', 4),
(2, 'Adaptada', 1111125),
(3, 'Adaptada', 26),
(4, 'Adaptada', 27),
(5, 'Adaptada', 28),
(6, 'Adaptada', 5),
(7, 'Adaptada', 24),
(8, 'Adaptada', 29),
(9, 'Adaptada', 30),
(10, 'Adaptada', 31),
(11, 'Adaptada', 32),
(12, 'Adaptada', 38),
(13, 'Adaptada', 39),
(14, 'Adaptada', 40),
(15, 'Adaptada', 41),
(16, 'Adaptada', 7),
(17, 'Adaptada', 19),
(18, 'Adaptada', 20),
(19, 'Adaptada', 21),
(20, 'Adaptada', 22),
(21, 'Adaptada', 23),
(22, 'Adaptada', 42);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id_category` int(50) NOT NULL,
  `category_name` varchar(250) NOT NULL,
  `image_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id_category`, `category_name`, `image_name`) VALUES
(1, 'Piso', 'view/img/piso_category.jpg'),
(2, 'Adosado', '	\nview/img/adosado_category.jpg'),
(3, 'Parcela', '	\nview/img/parcela_category.jpg'),
(4, 'Local', '	\nview/img/local_category.jpg'),
(6, 'Chalet', '	\nview/img/chalet_category.jpg'),
(7, 'Trastero', '	\nview/img/trastero_category.jpg'),
(8, 'Nave Industrial', 'view/img/nave_industrial_category.jpg'),
(9, 'Duplex', 'view/img/duplex_category.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `city`
--

CREATE TABLE `city` (
  `id_city` int(50) NOT NULL,
  `city_name` varchar(250) NOT NULL,
  `image_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `city`
--

INSERT INTO `city` (`id_city`, `city_name`, `image_name`) VALUES
(1, 'Albaida', 'view/img/albaida.jpg'),
(2, 'Fontanars', 'view/img/fontanars.jpg'),
(3, 'Ontinyent', 'view/img/ontinyent.jpg'),
(4, 'Bocairent', 'view/img/bocairent.jpg'),
(5, 'Agullent', 'view/img/agullent.jpg'),
(6, 'Paterna', 'view/img/paterna.jpg'),
(7, 'Valencia', 'view/img/valencia.jpg'),
(8, 'Xativa', 'view/img/xativa.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id_image` int(50) NOT NULL,
  `id_vivienda` int(50) NOT NULL,
  `image_name` varchar(250) NOT NULL,
  `image_category` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id_image`, `id_vivienda`, `image_name`, `image_category`) VALUES
(1, 4, 'view/img/piso1.jpg', 'casa'),
(2, 4, 'view/img/piso2.jpg', 'casa'),
(3, 4, 'view/img/piso3.jpg', 'casa'),
(4, 4, 'view/img/piso4.jpg', 'casa'),
(5, 4, 'view/img/piso5.jpg', 'casa'),
(6, 5, 'view/img/adosado1.jpg', 'casa'),
(7, 5, 'view/img/adosado2.jpg', 'casa'),
(8, 5, 'view/img/adosado3.jpg', 'casa'),
(9, 5, 'view/img/adosado4.jpg', 'casa'),
(10, 5, 'view/img/adosado5.jpg', 'casa'),
(11, 6, 'view/img/duplex1.jpg', 'duplex'),
(12, 6, 'view/img/duplex2.jpg', 'duplex'),
(13, 6, 'view/img/duplex3.jpg', 'duplex'),
(14, 6, 'view/img/duplex4.jpg', 'duplex'),
(15, 6, 'view/img/duplex5.jpg', 'duplex'),
(16, 7, 'view/img/duplex6.jpg', 'duplex');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `most_visited`
--

CREATE TABLE `most_visited` (
  `id_vivienda` int(50) NOT NULL,
  `visitas` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `most_visited`
--

INSERT INTO `most_visited` (`id_vivienda`, `visitas`) VALUES
(4, 29),
(5, 26),
(4, 29),
(5, 26),
(6, 26),
(7, 27),
(8, 28),
(9, 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operation`
--

CREATE TABLE `operation` (
  `id_operation` int(50) NOT NULL,
  `operation_name` varchar(250) NOT NULL,
  `image_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `operation`
--

INSERT INTO `operation` (`id_operation`, `operation_name`, `image_name`) VALUES
(13, 'Compra', 'view/img/compra.jpg'),
(14, 'Venta', 'view/img/venta.jpg'),
(15, 'Alquiler', 'view/img/alquiler.jpg'),
(16, 'Alquiler opcion a Compra', 'view/img/alquiler_compra.jpg'),
(17, 'Alquier Habitaciones', 'view/img/alquiler_habitaciones.jpg'),
(18, 'Compra Naves ', 'view/img/compra_nave.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type`
--

CREATE TABLE `type` (
  `id_type` int(50) NOT NULL,
  `type_name` varchar(250) NOT NULL,
  `image_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `type`
--

INSERT INTO `type` (`id_type`, `type_name`, `image_name`) VALUES
(7, 'A estrenar', 'view/img/a_estrenar.jpg'),
(8, 'Buen estado', 'view/img/buen_estado.jpg'),
(9, 'A reformar', 'view/img/a_reformar.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viviendas`
--

CREATE TABLE `viviendas` (
  `id_vivienda` int(50) NOT NULL,
  `vivienda_name` varchar(250) NOT NULL,
  `id_city` int(50) NOT NULL,
  `state` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `vivienda_price` int(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `image_name` varchar(250) NOT NULL,
  `m2` int(50) NOT NULL,
  `habitaciones` int(50) NOT NULL,
  `baños` int(10) NOT NULL,
  `id_type` int(50) NOT NULL,
  `id_operation` int(50) NOT NULL,
  `id_category` int(50) NOT NULL,
  `id_image` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viviendas`
--

INSERT INTO `viviendas` (`id_vivienda`, `vivienda_name`, `id_city`, `state`, `status`, `vivienda_price`, `description`, `image_name`, `m2`, `habitaciones`, `baños`, `id_type`, `id_operation`, `id_category`, `id_image`) VALUES
(4, 'Piso en Albaida', 1, 'Valencia', 'Disponible', 138000, 'Encantador piso de 2 habitaciones con diseño moderno y luminoso. Cocina totalmente equipada, amplio salón con vistas panorámicas. Ubicación céntrica, cerca de servicios y transporte público. Ideal para aquellos que buscan comodidad y estilo en un hog', 'view/img/piso1.jpg', 90, 5, 2, 9, 13, 1, 1),
(5, 'Adosado en Albaida', 1, 'Valencia', 'Disponible', 256000, 'Agradable adosado de 3 dormitorios con diseño contemporáneo. Cocina equipada, luminoso salón y patio privado. Ubicación conveniente cerca de servicios y transporte. Perfecto para aquellos que buscan confort y estilo en un hogar adosado moderno.', 'view/img/adosado1.jpg', 120, 2, 3, 8, 14, 2, 1),
(6, 'Duplex en Bocairent', 4, 'Valencia', 'Disponible', 156000, 'Agradable duplex de 3 dormitorios con diseño contemporáneo. Cocina equipada, luminoso salón y patio privado. Ubicación conveniente cerca de servicios y transporte. Perfecto para aquellos que buscan confort y estilo en un hogar adosado moderno.', 'view/img/duplex1.jpg', 139, 4, 2, 7, 14, 9, 1),
(7, 'Chalet en Fontanars', 2, 'Valencia', 'Disponible', 132500, 'Agradable Chalet de 8 dormitorios con diseño moderno. Cocina equipada, luminoso salón y patio privado. Ubicación conveniente cerca de servicios y transporte. Perfecto para aquellos que buscan confort y estilo en un hogar adosado moderno.', 'view/img/chalet1.jpg', 380, 6, 3, 9, 14, 6, 1),
(8, 'Trastero \n economico', 2, 'Valencia', 'Disponible', 20000, 'Trastero espacioso en venta.', 'view/img/trastero1.jpg', 10, 1, 0, 9, 14, 7, 1),
(9, 'Trastero a reformar', 1, 'Valencia', 'Disponible', 20000, 'Trastero espacioso en venta.', 'view/img/trastero2.jpg', 10, 1, 0, 9, 14, 7, 1),
(10, 'Trastero comunitario', 2, 'Valencia', 'Disponible', 18000, 'Trastero espacioso en venta.', 'view/img/trastero3.jpg', 120, 1, 0, 9, 15, 7, 1),
(11, 'Trastero con posiblidades', 3, 'Valencia', 'Disponible', 8000, 'Trastero espacioso en venta.', 'view/img/trastero4.jpg', 13, 1, 0, 9, 16, 7, 1),
(12, 'Amplio trastero', 4, 'Valencia', 'Disponible', 2500, 'Trastero espacioso en venta.', 'view/img/trastero5.jpg', 20, 1, 0, 9, 14, 7, 1),
(13, 'Trastero en venta', 5, 'Valencia', 'Disponible', 12000, 'Trastero espacioso en venta.', 'view/img/trastero6.jpg', 12, 1, 0, 9, 15, 7, 1),
(14, 'Nave Industrial totalmente reformada.', 1, 'Valencia', 'Disponible', 200000, 'Venta: Nave Industrial 1000m², zona industrial prime.', 'view/img/nave1.jpg', 1000, 1, 0, 9, 18, 8, 1),
(15, 'Nave Industrial en poligono Alcocer', 2, 'Valencia', 'Disponible', 180000, 'Venta: Nave Industrial 1000m², zona industrial prime.', 'view/img/nave2.jpg', 1200, 1, 0, 9, 18, 8, 1),
(16, 'Nave Industrial a reformar', 3, 'Valencia', 'Disponible', 80000, 'Venta: Nave Industrial 1000m², zona industrial prime.', 'view/img/nave3.jpg', 1300, 1, 0, 9, 18, 8, 1),
(17, 'Nave Industrial con estanterias', 4, 'Valencia', 'Disponible', 75000, 'Venta: Nave Industrial 1000m², zona industrial prime.', 'view/img/nave4.jpg', 2000, 1, 0, 9, 18, 8, 1),
(18, 'Nave Industrial adaptada.', 5, 'Valencia', 'Disponible', 120000, 'Venta: Nave Industrial 1000m², zona industrial prime.', 'view/img/nave5.jpg', 1200, 1, 0, 9, 18, 8, 1),
(19, 'Chalet en la montaña', 1, 'Valencia', 'Disponible', 200000, 'Venta: Chalet 300m², jardín amplio.', 'view/img/chalet7.jpg', 100, 4, 3, 9, 14, 6, 1),
(20, 'Chalet en la playa', 2, 'Valencia', 'Disponible', 180000, 'Venta: Chalet 300m², jardín amplio.', 'view/img/chalet2.jpg', 120, 3, 2, 9, 15, 6, 1),
(21, 'Chalet con muchas posiblilidades', 3, 'Valencia', 'Disponible', 80000, 'Venta: Chalet 4 hab., piscina', 'view/img/chalet3.jpg', 130, 8, 0, 9, 14, 6, 1),
(22, 'Chalet con piscina', 4, 'Valencia', 'Disponible', 75000, 'Venta: Chalet 4 hab., piscina', 'view/img/chalet6.jpg', 200, 4, 4, 9, 14, 6, 1),
(23, 'Chalet de ensueño', 5, 'Valencia', 'Disponible', 120000, 'Venta: Chalet exclusivo, vistas panorámicas.', 'view/img/chalet5.jpg', 2500, 5, 3, 9, 15, 6, 1),
(24, 'Adosado en Albaida', 1, 'Valencia', 'Preventa', 248000, 'Agradable adosado de 5 dormitorios con diseño contemporáneo. Cocina equipada, luminoso salón y patio privado. Ubicación conveniente cerca de servicios y transporte. Perfecto para aquellos que buscan confort y estilo en un hogar adosado moderno.', 'view/img/adosado2.jpg', 234, 5, 2, 7, 14, 2, 1),
(25, 'Piso en Agullent', 5, 'Valencia', 'Disponible', 134000, 'Encantador piso de 5 habitaciones con diseño moderno y luminoso. Cocina totalmente equipada, amplio salón con vistas panorámicas. Ubicación céntrica, cerca de servicios y transporte público. Ideal para aquellos que buscan comodidad.', 'view/img/piso2.jpg', 88, 3, 1, 7, 14, 1, 1),
(26, 'Piso en Bocairent', 4, 'Valencia', 'Disponible', 98000, 'Piso de 2 habitaciones con diseño moderno y luminoso. Cocina totalmente equipada, amplio salón con vistas panorámicas. Ubicación céntrica, cerca de servicios y transporte público. Ideal para aquellos que buscan comodidad y estilo.', 'view/img/piso3.jpg', 88, 3, 2, 9, 14, 1, 1),
(27, 'Piso en Bocairent', 4, 'Valencia', 'Disponible', 72000, 'Encantador piso de 3 habitaciones con diseño moderno y luminoso. Cocina totalmente equipada, amplio salón con vistas panorámicas. Ubicación céntrica, cerca de servicios y transporte público. Ideal para aquellos que buscan comodidad.', 'view/img/piso4.jpg', 65, 2, 1, 8, 14, 1, 1),
(28, 'Piso unifamiliar', 2, 'Valencia', 'Disponible', 56000, 'Pequeño piso de 2 habitaciones con diseño moderno y luminoso. Cocina totalmente equipada, amplio salón con vistas panorámicas. Ubicación céntrica, cerca de servicios y transporte público. Ideal para aquellos que buscan comodidad.', 'view/img/piso5.jpg', 65, 2, 1, 9, 14, 1, 1),
(29, 'Adosado con Jaquzzi', 3, 'Valencia', 'Preventa', 248000, 'Agradable adosado de 5 dormitorios con piscina, Cocina equipada, luminoso salón y patio privado. Ubicación conveniente cerca de servicios y transporte. Perfecto para aquellos que buscan confort y estilo en un hogar adosado moderno.', 'view/img/adosado3.jpg', 159, 3, 2, 7, 14, 2, 1),
(30, 'Alquiler Adosado.', 8, 'Valencia', 'Preventa', 135000, 'Estupendo adosado de 5 dormitorios con piscina, Cocina equipada, luminoso salón y patio privado. Ubicación conveniente cerca de servicios y transporte. Perfecto para aquellos que buscan confort y estilo en un hogar adosado moderno.', 'view/img/adosado4.jpg', 125, 3, 2, 7, 15, 2, 1),
(31, 'Adosado en Paterna', 6, 'Valencia', 'Preventa', 98000, 'Estupendo adosado de 5 dormitorios con piscina, Cocina equipada, luminoso salón y patio privado. Ubicación conveniente cerca de servicios y transporte. Perfecto para aquellos que buscan confort y estilo en un hogar adosado moderno.', 'view/img/adosado5.jpg', 132, 4, 2, 7, 15, 2, 1),
(32, 'Local en Albaida', 1, 'Valencia', 'Disponible', 25000, 'Local de 200 metros con diseño moderno y luminoso. ', 'view/img/local1.jpg', 30, 1, 0, 9, 13, 4, 1),
(33, 'Parcela en Albaida', 1, 'Valencia', 'Disponible', 25000, 'Parcela de 2000 metros con arboles', 'view/img/parcela1.jpg', 2000, 0, 0, 9, 14, 3, 1),
(34, 'Parcela en Fontanars', 2, 'Valencia', 'Disponible', 78000, 'Parcela de 1820 metros con arboles', 'view/img/parcela2.jpg', 1820, 0, 0, 9, 14, 3, 1),
(35, 'Parcela en Xativa', 8, 'Valencia', 'Disponible', 56800, 'Parcela de 2000 metros urbanizable', 'view/img/parcela3.jpg', 2000, 0, 0, 9, 14, 3, 1),
(36, 'Parcela en Valencia', 7, 'Valencia', 'Disponible', 135800, 'Parcela de 2000 metros urbanizable en el extraradio de Valencia', 'view/img/parcela4.jpg', 2000, 0, 0, 9, 14, 3, 1),
(37, 'Parcela en Paterna', 6, 'Valencia', 'Disponible', 12500, 'Parcela de 500 metros urbanizable en con muchas posibilidades', 'view/img/parcela5.jpg', 2000, 0, 0, 9, 14, 3, 1),
(38, 'Local en Paterna', 6, 'Valencia', 'Disponible', 32000, 'Local de 200 metros en zona comercial.', 'view/img/local2.jpg', 200, 1, 0, 9, 13, 4, 1),
(39, 'Local en Ontinyent', 3, 'Valencia', 'Disponible', 56000, 'Local de 200 en centro comercial', 'view/img/local3.jpg', 200, 1, 0, 9, 13, 4, 1),
(40, 'Local en Valencia', 7, 'Valencia', 'Disponible', 56000, 'Local de 200m2 en centro comercial', 'view/img/local4.jpg', 200, 1, 0, 9, 15, 4, 1),
(41, 'Local comercial', 7, 'Valencia', 'Disponible', 118000, 'Local de 200m2 en el centro de Valencia, apto para talleres de motos', 'view/img/local5.jpg', 90, 1, 0, 9, 15, 4, 1),
(42, 'Chalet con muchas posiblilidades', 3, 'Valencia', 'Disponible', 80000, 'Venta: Chalet 4 hab., piscina', 'view/img/chalet4.jpg', 130, 8, 0, 9, 14, 6, 1),
(43, 'Duplex a estrenar', 3, 'Valencia', 'Disponible', 320000, 'Agradable duplex de 3 dormitorios con diseño contemporáneo. Cocina equipada, luminoso salón y patio privado. Ubicación conveniente cerca de servicios y transporte. Perfecto para aquellos que buscan confort y estilo en un hogar adosado moderno.', 'view/img/duplex2.jpg', 157, 3, 2, 7, 14, 9, 1),
(44, 'Duplex en Valencia', 7, 'Valencia', 'Disponible', 211500, 'Espectacular duplex de 3 dormitorios con diseño contemporáneo. Cocina equipada, luminoso salón y patio privado. Ubicación conveniente cerca de servicios y transporte. Perfecto para aquellos que buscan confort y estilo en un hogar adosado moderno.', 'view/img/duplex3.jpg', 132, 3, 2, 7, 16, 9, 1),
(45, 'Espectacular Duplex', 7, 'Valencia', 'Disponible', 211500, 'Magnifico duplex de 3 dormitorios con diseño contemporáneo. Cocina equipada, luminoso salón y patio privado. Ubicación conveniente cerca de servicios y transporte. Perfecto para aquellos que buscan confort y estilo en un hogar adosado moderno.', 'view/img/duplex4.jpg', 132, 3, 2, 8, 15, 9, 1),
(46, 'Duplex en Fontanars', 2, 'Valencia', 'Disponible', 211500, 'Duplex con cocina equipada, luminoso salón y patio privado. Ubicación conveniente cerca de servicios y transporte. Perfecto para aquellos que buscan confort y estilo en un hogar adosado moderno.', 'view/img/duplex5.jpg', 132, 3, 2, 8, 14, 9, 1),
(47, 'Duplex en Xativa', 8, 'Valencia', 'Disponible', 218000, 'Duplex con cocina equipada, luminoso salón y patio privado. Ubicación conveniente cerca de servicios y transporte. Perfecto para aquellos que buscan confort y estilo en un hogar adosado moderno.', 'view/img/duplex6.jpg', 156, 4, 3, 7, 14, 9, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adapted`
--
ALTER TABLE `adapted`
  ADD PRIMARY KEY (`id_adapted`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indices de la tabla `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id_city`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `id_vivienda` (`id_vivienda`),
  ADD KEY `id_vivienda_2` (`id_vivienda`),
  ADD KEY `id_vivienda_3` (`id_vivienda`);

--
-- Indices de la tabla `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`id_operation`);

--
-- Indices de la tabla `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indices de la tabla `viviendas`
--
ALTER TABLE `viviendas`
  ADD PRIMARY KEY (`id_vivienda`),
  ADD KEY `id_city` (`id_city`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_type` (`id_type`) USING BTREE,
  ADD KEY `id_operation` (`id_operation`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adapted`
--
ALTER TABLE `adapted`
  MODIFY `id_adapted` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `city`
--
ALTER TABLE `city`
  MODIFY `id_city` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id_image` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `operation`
--
ALTER TABLE `operation`
  MODIFY `id_operation` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `viviendas`
--
ALTER TABLE `viviendas`
  MODIFY `id_vivienda` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`id_vivienda`) REFERENCES `viviendas` (`id_vivienda`);

--
-- Filtros para la tabla `viviendas`
--
ALTER TABLE `viviendas`
  ADD CONSTRAINT `viviendas_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE NO ACTION,
  ADD CONSTRAINT `viviendas_city` FOREIGN KEY (`id_city`) REFERENCES `city` (`id_city`) ON DELETE NO ACTION,
  ADD CONSTRAINT `viviendas_operation` FOREIGN KEY (`id_operation`) REFERENCES `operation` (`id_operation`) ON DELETE NO ACTION,
  ADD CONSTRAINT `viviendas_type` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
