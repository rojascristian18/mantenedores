-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-04-2017 a las 12:30:59
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mantenedores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_adjuntos`
--

CREATE TABLE `crp_adjuntos` (
  `id` bigint(20) NOT NULL,
  `tarea_id` bigint(20) DEFAULT NULL,
  `administrador` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `descripcion` text,
  `url_archivo` varchar(200) DEFAULT NULL,
  `archivo` varchar(200) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `count_descargas` int(11) DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_administradores`
--

CREATE TABLE `crp_administradores` (
  `id` int(11) NOT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `codigo_fono` text,
  `fono` varchar(9) NOT NULL DEFAULT '1',
  `imagen` varchar(150) DEFAULT NULL,
  `ultimo_acceso` datetime NOT NULL,
  `google_id` varchar(100) DEFAULT NULL,
  `google_dominio` varchar(100) DEFAULT NULL,
  `google_nombre` varchar(50) DEFAULT NULL,
  `google_apellido` varchar(50) DEFAULT NULL,
  `google_imagen` varchar(100) DEFAULT NULL,
  `count_tareas` int(11) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `crp_administradores`
--

INSERT INTO `crp_administradores` (`id`, `rol_id`, `nombre`, `apellidos`, `email`, `clave`, `codigo_fono`, `fono`, `imagen`, `ultimo_acceso`, `google_id`, `google_dominio`, `google_nombre`, `google_apellido`, `google_imagen`, `count_tareas`, `activo`, `created`, `modified`) VALUES
(1, NULL, 'Desarrollo Nodriza Spa', NULL, 'desarrollo@nodriza.cl', 'c1721c9e60f0c1a4a5f9df1cd0b4f0c916b02275', NULL, '1', NULL, '2017-04-12 05:58:56', NULL, NULL, NULL, NULL, NULL, 0, 1, '2017-04-12 17:58:56', '2017-04-12 17:58:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_calificaciones`
--

CREATE TABLE `crp_calificaciones` (
  `id` bigint(20) NOT NULL,
  `usuario_id` bigint(20) DEFAULT NULL,
  `calificacion` int(10) UNSIGNED NOT NULL,
  `mensaje` text,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_categoriatareas`
--

CREATE TABLE `crp_categoriatareas` (
  `id` bigint(20) NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `nombre` varchar(30) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_comentarios`
--

CREATE TABLE `crp_comentarios` (
  `id` bigint(20) NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `tarea_id` bigint(20) DEFAULT NULL,
  `importancia_id` int(11) DEFAULT NULL,
  `usuario` bigint(20) DEFAULT NULL,
  `administrador` int(11) DEFAULT NULL,
  `comentario` text NOT NULL,
  `visualizado` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_visualizado` datetime DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `adjunto` varchar(200) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_grupocaracteristicas`
--

CREATE TABLE `crp_grupocaracteristicas` (
  `id` bigint(20) NOT NULL,
  `tienda_id` int(11) DEFAULT NULL,
  `nombre` varchar(30) NOT NULL,
  `desripcion` text NOT NULL,
  `count_caracteristicas` int(11) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_imagenes`
--

CREATE TABLE `crp_imagenes` (
  `id` bigint(20) NOT NULL,
  `producto_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_importancias`
--

CREATE TABLE `crp_importancias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `color` varchar(6) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_modulos`
--

CREATE TABLE `crp_modulos` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `nombre` varchar(30) NOT NULL,
  `url` varchar(50) DEFAULT NULL,
  `icono` varchar(30) NOT NULL,
  `orden` int(11) NOT NULL DEFAULT '1',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_modulos_roles`
--

CREATE TABLE `crp_modulos_roles` (
  `modulo_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_notificaciones`
--

CREATE TABLE `crp_notificaciones` (
  `id` bigint(20) NOT NULL,
  `usuario_id` bigint(20) DEFAULT NULL,
  `importancia_id` int(11) DEFAULT NULL,
  `tarea_id` bigint(20) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `mensaje` text,
  `visualizada` tinyint(1) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_palabraclaves`
--

CREATE TABLE `crp_palabraclaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_palabraclaves_productos`
--

CREATE TABLE `crp_palabraclaves_productos` (
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `palabraclave_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_palabraclaves_tareas`
--

CREATE TABLE `crp_palabraclaves_tareas` (
  `tarea_id` bigint(20) NOT NULL,
  `palabraclave_id` bigint(20) UNSIGNED NOT NULL,
  `autorizada` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_pregunta_frecuentes`
--

CREATE TABLE `crp_pregunta_frecuentes` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(200) NOT NULL,
  `respuesta` text NOT NULL,
  `slug` varchar(200) NOT NULL,
  `orden` smallint(6) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_productos`
--

CREATE TABLE `crp_productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tarea_id` bigint(20) DEFAULT NULL,
  `grupocaracteristica_id` bigint(20) DEFAULT NULL,
  `proveedor_id` int(10) UNSIGNED NOT NULL,
  `fabricante_id` int(10) UNSIGNED NOT NULL,
  `categoria_deafult_id` int(11) DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `referencia` varchar(32) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `nombre_final` varchar(200) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `descripcion_corta` text NOT NULL,
  `descripcion` text,
  `precio` bigint(20) NOT NULL,
  `largo` decimal(20,6) UNSIGNED DEFAULT NULL,
  `alto` decimal(20,6) UNSIGNED DEFAULT NULL,
  `profundidad` decimal(20,6) UNSIGNED DEFAULT NULL,
  `peso` decimal(20,6) UNSIGNED DEFAULT NULL,
  `cantidad` smallint(6) NOT NULL DEFAULT '5',
  `meta_titulo` varchar(100) NOT NULL,
  `meta_descripcion` text,
  `validado` tinyint(1) NOT NULL DEFAULT '0',
  `aceptado` tinyint(1) NOT NULL DEFAULT '0',
  `rechazado` tinyint(1) NOT NULL DEFAULT '1',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_productos_caracteristicas`
--

CREATE TABLE `crp_productos_caracteristicas` (
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `id_feature` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_roles`
--

CREATE TABLE `crp_roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `permisos` text NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_tareas`
--

CREATE TABLE `crp_tareas` (
  `id` bigint(20) NOT NULL,
  `usuario_id` bigint(20) DEFAULT NULL,
  `administrador_id` int(11) DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `categoriatarea_id` bigint(20) DEFAULT NULL,
  `tienda_id` int(11) DEFAULT NULL,
  `impuesto_default_id` int(10) UNSIGNED NOT NULL,
  `idioma_id` int(10) UNSIGNED NOT NULL,
  `shop_id` smallint(5) UNSIGNED NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` varchar(10) NOT NULL,
  `fecha_entrega` datetime NOT NULL,
  `porcentaje_realizado` int(11) NOT NULL DEFAULT '0',
  `iniciado` datetime NOT NULL,
  `count_comentarios` int(10) UNSIGNED DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `en_progreso` tinyint(1) NOT NULL DEFAULT '0',
  `en_revision` tinyint(1) NOT NULL DEFAULT '0',
  `finalizado` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_finalizado` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_tareas_usuarios`
--

CREATE TABLE `crp_tareas_usuarios` (
  `usuario_id` bigint(20) NOT NULL,
  `tarea_id` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_tiendas`
--

CREATE TABLE `crp_tiendas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `url` varchar(50) NOT NULL,
  `db_configuracion` varchar(20) NOT NULL,
  `prefijo` varchar(20) NOT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT '0',
  `tema` varchar(50) NOT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_usuarios`
--

CREATE TABLE `crp_usuarios` (
  `id` bigint(20) NOT NULL,
  `rut` varchar(12) DEFAULT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(70) NOT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `codigo_fono` text,
  `fono` varchar(9) NOT NULL DEFAULT '1',
  `imagen` varchar(150) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `count_tareas_terminadas` tinyint(4) NOT NULL DEFAULT '0',
  `ultimo_acceso` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `crp_adjuntos`
--
ALTER TABLE `crp_adjuntos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship8` (`tarea_id`);

--
-- Indices de la tabla `crp_administradores`
--
ALTER TABLE `crp_administradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship14` (`rol_id`);

--
-- Indices de la tabla `crp_calificaciones`
--
ALTER TABLE `crp_calificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship5` (`usuario_id`);

--
-- Indices de la tabla `crp_categoriatareas`
--
ALTER TABLE `crp_categoriatareas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crp_comentarios`
--
ALTER TABLE `crp_comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship9` (`tarea_id`),
  ADD KEY `IX_Relationship18` (`importancia_id`);

--
-- Indices de la tabla `crp_grupocaracteristicas`
--
ALTER TABLE `crp_grupocaracteristicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship19` (`tienda_id`);

--
-- Indices de la tabla `crp_imagenes`
--
ALTER TABLE `crp_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship21` (`producto_id`);

--
-- Indices de la tabla `crp_importancias`
--
ALTER TABLE `crp_importancias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crp_modulos`
--
ALTER TABLE `crp_modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crp_modulos_roles`
--
ALTER TABLE `crp_modulos_roles`
  ADD PRIMARY KEY (`modulo_id`,`rol_id`),
  ADD KEY `Relationship16` (`rol_id`);

--
-- Indices de la tabla `crp_notificaciones`
--
ALTER TABLE `crp_notificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship6` (`usuario_id`),
  ADD KEY `IX_Relationship10` (`importancia_id`),
  ADD KEY `IX_Relationship17` (`tarea_id`);

--
-- Indices de la tabla `crp_palabraclaves`
--
ALTER TABLE `crp_palabraclaves`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crp_palabraclaves_productos`
--
ALTER TABLE `crp_palabraclaves_productos`
  ADD PRIMARY KEY (`producto_id`,`palabraclave_id`),
  ADD KEY `Relationship23` (`palabraclave_id`);

--
-- Indices de la tabla `crp_palabraclaves_tareas`
--
ALTER TABLE `crp_palabraclaves_tareas`
  ADD PRIMARY KEY (`tarea_id`,`palabraclave_id`),
  ADD KEY `Relationship25` (`palabraclave_id`);

--
-- Indices de la tabla `crp_pregunta_frecuentes`
--
ALTER TABLE `crp_pregunta_frecuentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crp_productos`
--
ALTER TABLE `crp_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship26` (`tarea_id`),
  ADD KEY `IX_Relationship30` (`grupocaracteristica_id`);

--
-- Indices de la tabla `crp_productos_caracteristicas`
--
ALTER TABLE `crp_productos_caracteristicas`
  ADD PRIMARY KEY (`producto_id`);

--
-- Indices de la tabla `crp_roles`
--
ALTER TABLE `crp_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crp_tareas`
--
ALTER TABLE `crp_tareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship7` (`usuario_id`),
  ADD KEY `IX_Relationship11` (`categoriatarea_id`),
  ADD KEY `IX_Relationship12` (`administrador_id`),
  ADD KEY `IX_Relationship13` (`tienda_id`);

--
-- Indices de la tabla `crp_tareas_usuarios`
--
ALTER TABLE `crp_tareas_usuarios`
  ADD PRIMARY KEY (`usuario_id`,`tarea_id`),
  ADD KEY `rel_tareas_tareas_usuarios` (`tarea_id`);

--
-- Indices de la tabla `crp_tiendas`
--
ALTER TABLE `crp_tiendas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crp_usuarios`
--
ALTER TABLE `crp_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `crp_adjuntos`
--
ALTER TABLE `crp_adjuntos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_administradores`
--
ALTER TABLE `crp_administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `crp_calificaciones`
--
ALTER TABLE `crp_calificaciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_categoriatareas`
--
ALTER TABLE `crp_categoriatareas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_grupocaracteristicas`
--
ALTER TABLE `crp_grupocaracteristicas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_imagenes`
--
ALTER TABLE `crp_imagenes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_importancias`
--
ALTER TABLE `crp_importancias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_modulos`
--
ALTER TABLE `crp_modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_notificaciones`
--
ALTER TABLE `crp_notificaciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_palabraclaves`
--
ALTER TABLE `crp_palabraclaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_pregunta_frecuentes`
--
ALTER TABLE `crp_pregunta_frecuentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_productos`
--
ALTER TABLE `crp_productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_roles`
--
ALTER TABLE `crp_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_tareas`
--
ALTER TABLE `crp_tareas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_tiendas`
--
ALTER TABLE `crp_tiendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_usuarios`
--
ALTER TABLE `crp_usuarios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
