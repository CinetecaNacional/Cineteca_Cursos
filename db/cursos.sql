-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2019 a las 23:45:43
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cursos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `curso_id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `disponible` tinyint(4) NOT NULL,
  `descripcion` longtext,
  `imagen` varchar(50) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `tipo_curso` varchar(45) NOT NULL,
  `precio_promocion` decimal(10,2) DEFAULT NULL,
  `vigencia_promocion` date DEFAULT NULL,
  `promocion_disponible` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`curso_id`, `nombre`, `disponible`, `descripcion`, `imagen`, `precio`, `tipo_curso`, `precio_promocion`, `vigencia_promocion`, `promocion_disponible`) VALUES
(1, 'Maestria', 0, NULL, NULL, '2000.00', 'Maestría', NULL, NULL, NULL),
(2, 'Akira Kurosawa', 1, 'Curso de 16 sesiones a lo largo de 9 semanas, que abarca, clases exclusivas de Cineteca Nacional con el experto, revisión de películas completas, lecturas relacionadas, evaluación, y al concluir satisfactoriamente el curso, la emisión de una constancia.', NULL, '2000.00', 'Online', '1500.00', '2019-02-14', 1),
(3, 'William Shakespeare', 0, NULL, NULL, '2000.00', 'Online', NULL, NULL, NULL),
(4, 'Cine Estadounidense 1', 0, NULL, NULL, '2000.00', 'Online', NULL, NULL, NULL),
(5, 'Cine Estadounidense 2', 0, NULL, NULL, '2000.00', 'Online', NULL, NULL, NULL),
(6, 'Cine Estadounidense 3', 0, NULL, NULL, '2000.00', 'Online', NULL, NULL, NULL),
(7, 'Cine Político', 0, NULL, NULL, '2000.00', 'Presencial', NULL, NULL, NULL),
(8, 'Peter Greenaway', 0, NULL, NULL, '2000.00', 'Presencial', NULL, NULL, NULL),
(9, 'Las Rutas del Miedo', 0, NULL, NULL, '2000.00', 'Presencial', NULL, NULL, NULL),
(10, 'Ciencia Ficción', 0, NULL, NULL, '2000.00', 'Presencial', NULL, NULL, NULL),
(11, 'Cine Mexicano Contemporáneo', 0, NULL, NULL, '2000.00', 'Presencial', NULL, NULL, NULL),
(12, 'Películas que ameritan explicación', 0, NULL, NULL, '2000.00', 'Presencial', NULL, NULL, NULL),
(13, 'Alfred Hitchcock', 0, NULL, NULL, '2000.00', 'Presencial', NULL, NULL, NULL),
(14, 'Federico Fellini', 0, NULL, NULL, '2000.00', 'Presencial', NULL, NULL, NULL),
(15, 'Expresionismo alemán', 0, NULL, NULL, '2000.00', 'Presencial', NULL, NULL, NULL),
(16, 'Woody Allen', 0, NULL, NULL, '2000.00', 'Presencial', NULL, NULL, NULL),
(17, 'Gaumont', 0, NULL, NULL, '2000.00', 'Presencial', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_usuarios`
--

CREATE TABLE `cursos_usuarios` (
  `cursos_usuarios_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `descuento` varchar(50) NOT NULL,
  `referencia` varchar(45) NOT NULL,
  `vigencia_curso` date NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha_limite_pago` date NOT NULL,
  `password` text,
  `estatus` tinyint(4) DEFAULT NULL,
  `experiencia` varchar(45) DEFAULT NULL,
  `link_curso` varchar(100) DEFAULT NULL,
  `pago` tinyint(4) DEFAULT NULL,
  `comprobante_pago` varchar(50) DEFAULT NULL,
  `nombre_factura` varchar(100) DEFAULT NULL,
  `razon_social` varchar(50) DEFAULT NULL,
  `rfc` varchar(13) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `descuento_id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `porcentaje` decimal(10,2) NOT NULL,
  `disponible` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `descuentos`
--

INSERT INTO `descuentos` (`descuento_id`, `nombre`, `porcentaje`, `disponible`) VALUES
(1, 'SIN DESCUENTO', '0.00', 1),
(2, 'OFERTA POR TIEMPO LIMITADO', '0.00', 1),
(3, 'PRIMER INGRESO', '0.00', 1),
(4, 'ESTUDIANTE', '10.00', 1),
(5, 'PROFESOR', '10.00', 1),
(6, 'INAPAM', '10.00', 1),
(7, 'EXALUMNO', '10.00', 1),
(8, 'ESTUDIANTE + EXALUMNO', '20.00', 1),
(9, 'PROFESOR + EXALUMNO', '20.00', 1),
(10, 'INAPAM + EXALUMNO', '20.00', 1),
(11, 'BECADO', '100.00', 1),
(12, 'CINETECA', '100.00', 1),
(13, 'PROMOCION', '50.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL,
  `matricula` varchar(9) NOT NULL,
  `password` text,
  `tipo_usuario` varchar(45) NOT NULL,
  `disponible` tinyint(4) DEFAULT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `curp` varchar(18) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `ocupacion` varchar(45) DEFAULT NULL,
  `estudios` varchar(45) DEFAULT NULL,
  `email` varchar(70) NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `municipio` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `colonia` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `matricula`, `password`, `tipo_usuario`, `disponible`, `apellido_paterno`, `apellido_materno`, `nombre`, `curp`, `sexo`, `fecha_nacimiento`, `ocupacion`, `estudios`, `email`, `telefono`, `codigo_postal`, `municipio`, `estado`, `colonia`) VALUES
(1, 'principal', 'adivina', 'Administrador principal', 1, 'GUERRERO', 'PLACENCIA', 'YAROSLAVA ', 'GUPY740311MDFRLR0', 'MUJER', '1974-03-11', '', NULL, 'yarygp74@gmail.com', NULL, '14020', NULL, NULL, NULL);

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `before_insert_generar_boleta` BEFORE INSERT ON `usuarios` FOR EACH ROW IF (NEW.matricula='' AND NEW.tipo_usuario='Online') THEN
  SET @year = YEAR(NOW())-2000;
  SET @consecutivo = (SELECT COUNT(matricula) FROM usuarios WHERE LEFT(matricula,2) = @year AND RIGHT(matricula,1) = 2);
  IF(@consecutivo<999) THEN
    SET NEW.matricula  = CONCAT(@YEAR,LPAD(@consecutivo+1,3,'0'),2);
    ELSE
      SET @consecutivo = (SELECT COUNT(matricula) FROM usuarios WHERE LEFT(matricula,2) = @year+1 AND RIGHT(matricula,1) = 2);
      SET NEW.matricula  = CONCAT(@YEAR+1,LPAD(@consecutivo+1,3,'0'),2);
      END IF;
 ELSEIF (NEW.matricula='' AND NEW.tipo_usuario='Presencial') THEN
  SET @year = YEAR(NOW())-2000;
  SET @consecutivo = (SELECT COUNT(matricula) FROM usuarios WHERE LEFT(matricula,2) = @year AND RIGHT(matricula,1) = 1);
  IF(@consecutivo<999) THEN
  SET NEW.matricula  = CONCAT(@YEAR,LPAD(@consecutivo+1,3,'0'),1);
    ELSE
      SET @consecutivo = (SELECT COUNT(matricula) FROM usuarios WHERE LEFT(matricula,2) = @year+1 AND RIGHT(matricula,1) = 1);
      SET NEW.matricula  = CONCAT(@YEAR+1,LPAD(@consecutivo+1,3,'0'),1);
      END IF;
  END IF
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`curso_id`);

--
-- Indices de la tabla `cursos_usuarios`
--
ALTER TABLE `cursos_usuarios`
  ADD PRIMARY KEY (`cursos_usuarios_id`),
  ADD KEY `cursos_usuarios_ibfk_1` (`curso_id`),
  ADD KEY `cursos_usuarios_ibfk_2` (`usuario_id`);

--
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`descuento_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `curso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `cursos_usuarios`
--
ALTER TABLE `cursos_usuarios`
  MODIFY `cursos_usuarios_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `descuento_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos_usuarios`
--
ALTER TABLE `cursos_usuarios`
  ADD CONSTRAINT `cursos_usuarios_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`curso_id`),
  ADD CONSTRAINT `cursos_usuarios_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`),
  ADD CONSTRAINT `cursos_usuarios_ibfk_3` FOREIGN KEY (`descuento_id`) REFERENCES `descuentos` (`descuento_id`);

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `update_disponibilidad_promocion` ON SCHEDULE EVERY 8 HOUR STARTS '2019-01-16 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE cursos SET promocion_disponible='0' WHERE vigencia_promocion <CURDATE()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
