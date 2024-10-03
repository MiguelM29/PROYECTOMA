-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-09-2024 a las 16:33:55
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
-- Base de datos: `negocio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(5) NOT NULL,
  `categorias` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categorias`) VALUES
(1, 'Laptop Gamer'),
(2, 'Laptop'),
(3, 'Escritorio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `componentes`
--

CREATE TABLE `componentes` (
  `id_componentes` int(11) NOT NULL,
  `procesador` varchar(15) NOT NULL,
  `grafica` varchar(20) DEFAULT NULL,
  `ram` int(3) NOT NULL,
  `color` varchar(10) NOT NULL,
  `disco` varchar(6) NOT NULL,
  `frecuencia` varchar(15) NOT NULL,
  `pulgadas` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `componentes`
--

INSERT INTO `componentes` (`id_componentes`, `procesador`, `grafica`, `ram`, `color`, `disco`, `frecuencia`, `pulgadas`) VALUES
(1, 'i5 13th', 'RTX 4040', 32, 'Gris', '1tb', '165hz', '18in'),
(2, 'i7 12th', 'RTX 4090', 16, 'Blanca', '500gb', '120hz', '15in'),
(3, 'i9 10th', 'RTX 3050', 16, 'Azul', '255gb', '60hz', '16in'),
(4, 'i9 13th', 'RTX 4090 SUPER', 64, 'Negra con ', '1tb', '165hz', '15'),
(5, 'i3 10th', NULL, 8, 'Roja', '500gb', '60hz', '15in'),
(6, 'i3 12th', NULL, 8, 'Gris', '255gb', '60hz', '14in'),
(7, 'i9 14th', 'GTX 1460', 32, 'Rojo con b', '1tb', '120hz', '18in');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(5) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `precio` double NOT NULL,
  `cantidad` int(5) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `id_categoria` int(5) NOT NULL,
  `id_componentes` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `precio`, `cantidad`, `foto`, `id_categoria`, `id_componentes`) VALUES
(1, 'Lenovo', 11000, 10, 'loadimg/2.jpg', 2, 5),
(2, 'Acerr Nitro Gaming', 21000, 7, 'loadimg/4.jpg', 2, 2),
(4, 'Lenovo', 11000, 10, 'loadimg/laptop.png', 2, 5),
(5, 'Machenike light 16 pro', 24000, 5, 'loadimg/5.jpg', 1, 1),
(6, 'Escritorio ensamblada', 15000, 4, 'loadimg/escritorio.png', 3, 3),
(7, 'Escritorio ensamblada', 20000, 7, 'loadimg/escritorio2.png', 3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipusuarios`
--

CREATE TABLE `tipusuarios` (
  `id_usuario` int(4) NOT NULL,
  `tusuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipusuarios`
--

INSERT INTO `tipusuarios` (`id_usuario`, `tusuario`) VALUES
(1, 'Administrador'),
(2, 'Gerente'),
(3, 'Empleado'),
(4, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_uusuario` int(4) NOT NULL,
  `unombre` varchar(20) NOT NULL,
  `uap` varchar(20) NOT NULL,
  `uam` varchar(20) NOT NULL,
  `ucorreo` varchar(50) NOT NULL,
  `upassword` varchar(20) NOT NULL,
  `utelefono` bigint(10) NOT NULL,
  `ruta` varchar(100) NOT NULL,
  `id_usuario` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_uusuario`, `unombre`, `uap`, `uam`, `ucorreo`, `upassword`, `utelefono`, `ruta`, `id_usuario`) VALUES
(1, 'Miguel Angel', 'Meza', 'Mendez', 'm@hotmail.com', '123456', 2481038880, 'hola', 1),
(3, 'Arath', 'Saavedra', 'Cabrera', 'arath@gmail.com', '12345', 2480000000, '', 1),
(4, 'Luz Belen', 'Sanchez', 'Romano', 'luz@gmail.com', '12345', 2480000000, '', 2),
(7, 'Juan Diego', 'Estrada', 'Rojas', 'juan@gmail.com', '123456', 2481111111, 'e10adc3949ba59abbe56e057f20f883e', 3),
(9, 'Jesus', 'Benitez', 'Altamirano', 'n@hotmail.com', '12345', 2482222222, '827ccb0eea8a706c4c34a16891f84e7b', 2),
(10, 'Kalebb', 'Fuentes', 'Vazquez', 'kalebb@gmail.com', '123', 2481900000, '202cb962ac59075b964b07152d234b70', 3),
(11, 'Israel', 'Pereze', 'Hernandez', 'israel@gmail.com', '1234', 2480000000, '81dc9bdb52d04dc20036dbd8313ed055', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `componentes`
--
ALTER TABLE `componentes`
  ADD PRIMARY KEY (`id_componentes`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_componentes` (`id_componentes`);

--
-- Indices de la tabla `tipusuarios`
--
ALTER TABLE `tipusuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_uusuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `componentes`
--
ALTER TABLE `componentes`
  MODIFY `id_componentes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipusuarios`
--
ALTER TABLE `tipusuarios`
  MODIFY `id_usuario` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_uusuario` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_componentes`) REFERENCES `componentes` (`id_componentes`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tipusuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
