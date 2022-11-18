-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 18-11-2022 a las 00:58:36
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cursolandia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `costo` decimal(10,0) DEFAULT '0',
  `cupo` int(11) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `temario` text,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dueno_id` bigint(20) NOT NULL,
  `etiqueta_id` bigint(11) NOT NULL,
  PRIMARY KEY (`id`,`dueno_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_cursos_usuarios1_idx` (`dueno_id`),
  KEY `etiqueta_id` (`etiqueta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `titulo`, `descripcion`, `costo`, `cupo`, `fecha_inicio`, `fecha_fin`, `temario`, `fecha_creacion`, `dueno_id`, `etiqueta_id`) VALUES
(17, 'Programacion Basica', 'curso de fundamentos de programacion', '50', 3, '2022-11-10 00:00:00', '2022-11-26 00:00:00', 'Variables\r\n\r\nCondicionales\r\n\r\nIteraciones', '2022-11-01 13:20:32', 15, 1),
(18, 'Curso adobe Illustrator', 'asdsda', '50', 35, '2022-11-10 00:00:00', '2022-11-26 00:00:00', 'asdsadsadsa', '2022-11-01 13:21:15', 15, 2),
(21, 'Finanzas personales', 'consejos para mejorar tus finanzas', '0', 35, '2022-11-04 00:00:00', '2022-11-25 00:00:00', NULL, '2022-11-01 15:15:34', 17, 3),
(22, 'Python basico', 'curso de fundamentos de python', '0', 2, '2022-11-21 00:00:00', '2022-12-21 00:00:00', NULL, '2022-11-14 00:39:34', 19, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_etiquetas`
--

DROP TABLE IF EXISTS `cursos_etiquetas`;
CREATE TABLE IF NOT EXISTS `cursos_etiquetas` (
  `cursos_id` bigint(20) NOT NULL,
  `etiquetas_id` bigint(20) NOT NULL,
  PRIMARY KEY (`cursos_id`,`etiquetas_id`),
  KEY `fk_cursos_has_etiquetas_etiquetas1_idx` (`etiquetas_id`),
  KEY `fk_cursos_has_etiquetas_cursos1_idx` (`cursos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

DROP TABLE IF EXISTS `etiquetas`;
CREATE TABLE IF NOT EXISTS `etiquetas` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `etiquetas`
--

INSERT INTO `etiquetas` (`id`, `nombre`) VALUES
(2, 'diseño'),
(3, 'finanzas'),
(1, 'programacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

DROP TABLE IF EXISTS `materiales`;
CREATE TABLE IF NOT EXISTS `materiales` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `ruta` varchar(45) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `unidad` int(11) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cursos_id` bigint(20) NOT NULL,
  `tipo_materiales_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`cursos_id`,`id`) USING BTREE,
  UNIQUE KEY `id` (`id`),
  KEY `fk_materiales_tipo_materiales1_idx` (`tipo_materiales_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`id`, `nombre`, `ruta`, `peso`, `unidad`, `fecha_creacion`, `cursos_id`, `tipo_materiales_id`) VALUES
(20, 'fundamentos-prog.pdf', NULL, 605247, NULL, '2022-11-14 01:35:32', 17, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
CREATE TABLE IF NOT EXISTS `notificaciones` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `contenido` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `es_leido` tinyint(1) DEFAULT '0',
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuarios_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `contenido`, `es_leido`, `fecha_creacion`, `usuarios_id`) VALUES
(4, 'catalina ha iniciado una pregunta en el curso \"Programacion Basica\"', 0, '2022-11-15 23:06:59', 17),
(5, 'catalina ha iniciado una pregunta en el curso \"Programacion Basica\"', 0, '2022-11-15 23:14:26', 17),
(12, 'josue ha realizado una respuesta a la pregunta \"¿Que es una variable?\" del curso \"Programacion Basica', 0, '2022-11-16 00:54:46', 16),
(13, 'josue ha realizado una respuesta a la pregunta \"¿Que es una variable?\" del curso \"Programacion Basica', 1, '2022-11-16 00:54:46', 15),
(14, 'josue ha realizado una respuesta a la pregunta \"¿Que es una variable?\" del curso \"Programacion Basica', 0, '2022-11-16 00:54:46', 17),
(15, 'josue ha realizado una respuesta a la pregunta \"¿Que es una variable?\" del curso \"Programacion Basica', 0, '2022-11-16 00:55:35', 16),
(16, 'josue ha realizado una respuesta a la pregunta \"¿Que es una variable?\" del curso \"Programacion Basica', 1, '2022-11-16 00:55:35', 15),
(17, 'josue ha realizado una respuesta a la pregunta \"¿Que es una variable?\" del curso \"Programacion Basica', 0, '2022-11-16 00:55:35', 17),
(18, 'josue ha realizado una respuesta a la pregunta \"¿Que es una variable?\" del curso \"Programacion Basica', 0, '2022-11-16 00:57:11', 16),
(19, 'josue ha realizado una respuesta a la pregunta \"¿Que es una variable?\" del curso \"Programacion Basica', 1, '2022-11-16 00:57:11', 15),
(20, 'josue ha realizado una respuesta a la pregunta \"¿Que es una variable?\" del curso \"Programacion Basica', 0, '2022-11-16 00:57:11', 17),
(21, 'mario ha iniciado una pregunta en el curso \"Programacion Basica\"', 0, '2022-11-16 11:37:18', 16),
(22, 'mario ha iniciado una pregunta en el curso \"Programacion Basica\"', 0, '2022-11-16 11:37:18', 19),
(25, 'josue ha realizado una respuesta a la pregunta \"¿Que es una funcion?\" del curso \"Programacion Basica', 0, '2022-11-16 15:17:31', 17),
(26, 'josue ha realizado una respuesta a la pregunta \"¿Que es una funcion?\" del curso \"Programacion Basica', 0, '2022-11-16 15:17:31', 15),
(27, 'catalina ha realizado una respuesta a la pregunta \"¿Que es una funcion?\" del curso \"Programacion Basica', 0, '2022-11-16 15:21:26', 17),
(28, 'catalina ha realizado una respuesta a la pregunta \"¿Que es una funcion?\" del curso \"Programacion Basica', 0, '2022-11-16 15:21:26', 15),
(29, 'catalina ha realizado una respuesta a la pregunta \"¿Que es una funcion?\" del curso \"Programacion Basica', 0, '2022-11-16 15:21:26', 19),
(30, 'josue ha realizado una respuesta a la pregunta \"¿Que es una funcion?\" del curso \"Programacion Basica', 0, '2022-11-16 15:42:43', 17),
(31, 'josue ha realizado una respuesta a la pregunta \"¿Que es una funcion?\" del curso \"Programacion Basica', 0, '2022-11-16 15:42:43', 15),
(32, 'josue ha realizado una respuesta a la pregunta \"¿Que es una funcion?\" del curso \"Programacion Basica', 0, '2022-11-16 15:42:43', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

DROP TABLE IF EXISTS `preguntas`;
CREATE TABLE IF NOT EXISTS `preguntas` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `contenido` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `es_concluida` tinyint(1) DEFAULT '0',
  `cursos_id` bigint(11) NOT NULL,
  `creador_id` bigint(11) NOT NULL,
  PRIMARY KEY (`titulo`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `titulo`, `contenido`, `fecha_creacion`, `es_concluida`, `cursos_id`, `creador_id`) VALUES
(10, '¿Que es una funcion?', '¿Alguien me puede explicar que es una funcion? Aun no logro entenderlo.', '2022-11-16 11:37:18', 0, 17, 17),
(7, '¿Que es una variable?', 'No puedo entender que es una variable', '2022-11-08 15:37:05', 1, 17, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

DROP TABLE IF EXISTS `respuestas`;
CREATE TABLE IF NOT EXISTS `respuestas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `contenido` text COLLATE utf8_spanish_ci NOT NULL,
  `es_destacado` bigint(20) DEFAULT '0',
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `preguntas_id` bigint(20) NOT NULL,
  `creador_id` bigint(20) NOT NULL,
  `respuesta_citada_id` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `contenido`, `es_destacado`, `fecha_creacion`, `preguntas_id`, `creador_id`, `respuesta_citada_id`) VALUES
(7, 'haciendo otra respuesta', 0, '2022-11-08 17:31:41', 1, 17, NULL),
(14, 'Una variable es un objeto del lenguaje cuyo valor se puede cambiar. Antes de utilizar una variable ésta debe de ser declarada. Al declarar una variable, se le asocia un identificador, es decir, un nombre, con un tipo de almacenamiento cuya forma determina la visibilidad y existencia de la variable.', 1, '2022-11-16 00:29:01', 7, 17, NULL),
(17, 'una variable es una caja donde se guardan valores', 0, '2022-11-16 00:57:11', 7, 19, 14),
(23, 'Una función es un bloque de código que realiza alguna operación. Una función puede definir opcionalmente parámetros de entrada que permiten a los llamadores pasar argumentos a la función. Una función también puede devolver un valor como salida.', 0, '2022-11-16 15:17:31', 10, 19, NULL),
(24, 'En programación, una función es una sección de un programa que calcula un valor de manera independiente al resto del programa', 0, '2022-11-16 15:21:26', 10, 16, NULL),
(25, 'Las funciones son un elemento muy utilizado en la programación. Empaquetan y \'aíslan\' del resto del programa ', 0, '2022-11-16 15:42:43', 10, 19, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(2, 'admin'),
(1, 'user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_pro`
--

DROP TABLE IF EXISTS `solicitudes_pro`;
CREATE TABLE IF NOT EXISTS `solicitudes_pro` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_id` (`usuario_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_materiales`
--

DROP TABLE IF EXISTS `tipo_materiales`;
CREATE TABLE IF NOT EXISTS `tipo_materiales` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_notificaciones`
--

DROP TABLE IF EXISTS `tipo_notificaciones`;
CREATE TABLE IF NOT EXISTS `tipo_notificaciones` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `fecha_nacimiento` varchar(45) DEFAULT NULL,
  `antecedentes` varchar(255) DEFAULT NULL,
  `imagen` varchar(45) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vencimiento_pro` date DEFAULT NULL,
  `roles_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`roles_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_usuarios_roles1_idx` (`roles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `contrasena`, `email`, `telefono`, `fecha_nacimiento`, `antecedentes`, `imagen`, `fecha_registro`, `vencimiento_pro`, `roles_id`) VALUES
(1, 'admin', '$2y$10$/bcMNNiZCBEUmaFGFoLQbeSgrCyjodGED4VZ2TD0gj8ahwD0u6QbO', 'admin@gmail.com', NULL, NULL, NULL, NULL, '2022-10-19 20:47:31', NULL, 2),
(15, 'ivan', '$2y$10$gYs2qial.rQTYgr55B5Ume23mUidbYUWySh.8gzzSy2nHGMqErAuq', 'ivan@gmail.com', '2664191000', '1970-02-19', 'Soy programador web, con 10 años de experiencia en el desarrollo de aplicaciones web, con lenguajes PHP y Javascript', 'ivan.jpg', '2022-10-19 21:43:59', '2023-11-04', 1),
(16, 'catalina', '$2y$10$GN6pwg9is1caXz/5.F3fweMHEhVHuWCs/aVwJGV8IwwVzgbSNkAdm', 'catalina@gmail.com', '2664122324', '1970-01-01', 'soy diseñadora grafica', 'catalina.jpg', '2022-11-01 14:33:50', NULL, 1),
(17, 'mario', '$2y$10$jFkshRKgOmgILtPpb6Gg6eZaUFLm5iY7jlZIZQqp4UIZt/ZuRchA.', 'mario@gmail.com', NULL, NULL, NULL, NULL, '2022-11-01 14:36:44', NULL, 1),
(18, 'pedro', '$2y$10$VlMsFMGYeVvI3/nu.1NwF.vleaKAnvLYoOTZNXZIj6TEFt64NvVUO', 'pedro@gmail.com', NULL, NULL, NULL, NULL, '2022-11-09 10:53:37', '2023-11-09', 1),
(19, 'josue', '$2y$10$neDWtnObBl7HaHrHy14ZCeOlbT1h1LobZXx7LQ8QXKeNLQKRdC9.S', 'josue@gmail.com', '', '2005-09-25', 'Soy estudiante de programacion en la UNSL', 'josue.jpg', '2022-11-13 13:31:04', NULL, 1),
(20, 'asdsa', '$2y$10$8neXni2A4Bw5hOFvWdIa8ueP9tYjM6Ecmi8vh.KgSpM2ztRUZrSM2', 'asdsa@asda.com', NULL, NULL, NULL, NULL, '2022-11-13 13:44:45', NULL, 1),
(21, 'nacho', '$2y$10$kwVLiS7syRuqo0MPAgUQVelrGwkXVp8sgJbY7dX.zKi1l2xKpdVoS', 'nacho@gmail.com', '', '1970-01-01', '', NULL, '2022-11-17 21:46:30', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_cursos`
--

DROP TABLE IF EXISTS `usuarios_cursos`;
CREATE TABLE IF NOT EXISTS `usuarios_cursos` (
  `usuarios_id` bigint(20) NOT NULL,
  `cursos_id` bigint(20) NOT NULL,
  `pago_pendiente` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`usuarios_id`,`cursos_id`),
  KEY `fk_users_has_courses_courses1_idx` (`cursos_id`),
  KEY `fk_users_has_courses_users1_idx` (`usuarios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios_cursos`
--

INSERT INTO `usuarios_cursos` (`usuarios_id`, `cursos_id`, `pago_pendiente`) VALUES
(15, 21, 0),
(16, 17, 0),
(17, 17, 0),
(19, 17, 0),
(21, 21, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_etiquetas`
--

DROP TABLE IF EXISTS `usuarios_etiquetas`;
CREATE TABLE IF NOT EXISTS `usuarios_etiquetas` (
  `usuario_id` int(11) NOT NULL,
  `etiqueta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios_etiquetas`
--

INSERT INTO `usuarios_etiquetas` (`usuario_id`, `etiqueta_id`) VALUES
(14, 1),
(14, 3),
(16, 2),
(15, 3),
(19, 1),
(21, 2),
(21, 3);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `fk_cursos_usuarios1` FOREIGN KEY (`dueno_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cursos_etiquetas`
--
ALTER TABLE `cursos_etiquetas`
  ADD CONSTRAINT `fk_cursos_has_etiquetas_cursos1` FOREIGN KEY (`cursos_id`) REFERENCES `cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cursos_has_etiquetas_etiquetas1` FOREIGN KEY (`etiquetas_id`) REFERENCES `etiquetas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD CONSTRAINT `fk_materiales_cursos1` FOREIGN KEY (`cursos_id`) REFERENCES `cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materiales_tipo_materiales1` FOREIGN KEY (`tipo_materiales_id`) REFERENCES `tipo_materiales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios_cursos`
--
ALTER TABLE `usuarios_cursos`
  ADD CONSTRAINT `fk_users_has_courses_courses1` FOREIGN KEY (`cursos_id`) REFERENCES `cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_courses_users1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
