-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2023 a las 00:24:13
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

CREATE TABLE `item` (
  `id_item` int(11) NOT NULL,
  `nombre_item` varchar(55) NOT NULL,
  `desc_item` varchar(55) NOT NULL,
  `foto_item` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `item`
--

INSERT INTO `item` (`id_item`, `nombre_item`, `desc_item`, `foto_item`) VALUES
(1, '13', 'numero maldito', 'img_65586d1b80b6f.jpg'),
(2, 'ariana', 'asesino', 'img_655a7f65a4be2.jpg'),
(3, 'Sebastian', 'assdasdasdasd', 'img_655a9109116e8.JPG'),
(4, 'adasda', 'ajaja', 'img_655a9119acee3.jpg'),
(5, 'MAMA', 'tiene el pelo bonito ', 'img_655a920bca040.jpg'),
(6, 'Hacha', 'Descripción del Item 2', '../img/hacha.png'),
(7, 'Carolina', 'altita', ''),
(8, 'ropero2', 'asdnasjda', 'img_655bd67779d78.jpeg'),
(9, 'MAMa', 'vsfdsf', 'img_655be6c50c893.jpeg'),
(10, 'carol asassing', 'adasfafafas', 'img_655be734f1cd1.jpeg'),
(11, 'hoja', 'blanca', 'img_655be8e88621f.jpeg'),
(12, 'ropa', 'es mucha', 'img_655be9af5b3cc.jpeg'),
(13, 'talla', 'es grande', 'img_655be9fd99e5f.jpeg'),
(14, 'pelota', 'adasfafafa', 'img_655bea1911c3f.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_us` int(11) NOT NULL,
  `nombre_us` varchar(55) NOT NULL,
  `contrasenia_us` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_us`, `nombre_us`, `contrasenia_us`) VALUES
(1, 'Sebastian', 'hola'),
(2, 'carolina', 'quetal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_item_relacion`
--

CREATE TABLE `usuario_item_relacion` (
  `id_relacion` int(11) NOT NULL,
  `id_usuarios` int(11) NOT NULL,
  `id_items` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario_item_relacion`
--

INSERT INTO `usuario_item_relacion` (`id_relacion`, `id_usuarios`, `id_items`) VALUES
(3, 1, 3),
(5, 1, 5),
(8, 1, 9),
(9, 1, 10),
(10, 2, 11),
(11, 2, 12),
(12, 2, 13),
(13, 2, 14);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_us`);

--
-- Indices de la tabla `usuario_item_relacion`
--
ALTER TABLE `usuario_item_relacion`
  ADD PRIMARY KEY (`id_relacion`),
  ADD KEY `id_usuarios` (`id_usuarios`),
  ADD KEY `id_items` (`id_items`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_us` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario_item_relacion`
--
ALTER TABLE `usuario_item_relacion`
  MODIFY `id_relacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario_item_relacion`
--
ALTER TABLE `usuario_item_relacion`
  ADD CONSTRAINT `usuario_item_relacion_ibfk_1` FOREIGN KEY (`id_usuarios`) REFERENCES `usuario` (`id_us`),
  ADD CONSTRAINT `usuario_item_relacion_ibfk_2` FOREIGN KEY (`id_items`) REFERENCES `item` (`id_item`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
