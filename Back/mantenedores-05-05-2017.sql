-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2017 a las 19:46:06
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
  `codigopais_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_bancos`
--

CREATE TABLE `crp_bancos` (
  `id` smallint(6) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
-- Estructura de tabla para la tabla `crp_codigopaises`
--

CREATE TABLE `crp_codigopaises` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` int(5) NOT NULL,
  `pais` varchar(50) DEFAULT NULL,
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
  `usuario_id` bigint(20) DEFAULT NULL,
  `administrador_id` int(11) DEFAULT NULL,
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
-- Estructura de tabla para la tabla `crp_correos`
--

CREATE TABLE `crp_correos` (
  `id` bigint(20) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `html` text NOT NULL,
  `asunto` varchar(200) NOT NULL,
  `destinatario_email` text NOT NULL,
  `destinatario_nombre` varchar(200) DEFAULT NULL,
  `remitente_email` varchar(200) NOT NULL,
  `remitente_nombre` varchar(200) DEFAULT NULL,
  `cc_email` text,
  `bcc_email` text,
  `traza` varchar(200) DEFAULT NULL,
  `proceso_origen` varchar(50) DEFAULT NULL,
  `procesado` tinyint(1) NOT NULL DEFAULT '0',
  `enviado` tinyint(1) NOT NULL DEFAULT '0',
  `reintentos` int(11) NOT NULL,
  `atachado` varchar(200) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_cuentas`
--

CREATE TABLE `crp_cuentas` (
  `id` bigint(20) NOT NULL,
  `usuario_id` bigint(20) NOT NULL,
  `banco_id` smallint(6) NOT NULL,
  `tipo_cuenta_id` smallint(6) NOT NULL,
  `otro` varchar(50) DEFAULT NULL,
  `cuenta` varchar(50) NOT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT '1',
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
  `count_categorias` int(11) DEFAULT NULL,
  `count_palabras_claves` int(11) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_grupocaracteristicas_categorias`
--

CREATE TABLE `crp_grupocaracteristicas_categorias` (
  `id` bigint(20) NOT NULL,
  `grupocaracteristica_id` bigint(20) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_grupocaracteristicas_especificaciones`
--

CREATE TABLE `crp_grupocaracteristicas_especificaciones` (
  `id` bigint(20) NOT NULL,
  `grupocaracteristica_id` bigint(20) NOT NULL,
  `id_feature` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_grupocaracteristicas_palabraclaves`
--

CREATE TABLE `crp_grupocaracteristicas_palabraclaves` (
  `id` bigint(20) NOT NULL,
  `grupocaracteristica_id` bigint(20) NOT NULL,
  `palabraclave_id` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_grupocaracteristicas_tareas`
--

CREATE TABLE `crp_grupocaracteristicas_tareas` (
  `id` bigint(20) NOT NULL,
  `grupocaracteristica_id` bigint(20) NOT NULL,
  `tarea_id` bigint(20) NOT NULL
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

--
-- Volcado de datos para la tabla `crp_modulos`
--

INSERT INTO `crp_modulos` (`id`, `parent_id`, `nombre`, `url`, `icono`, `orden`, `activo`, `created`, `modified`) VALUES
(1, NULL, 'Accesos', '', 'fa fa-unlock-alt', 1, 1, '2017-04-13 13:35:40', '2017-04-13 13:35:40'),
(2, 1, 'Administradores', 'administradores', 'fa fa-user', 1, 1, '2017-04-13 13:37:39', '2017-04-13 13:37:39'),
(3, 1, 'Módulos', 'modulos', 'fa fa-cubes', 1, 1, '2017-04-13 13:39:18', '2017-04-13 13:39:18'),
(4, 1, 'Roles de usuario', 'roles', 'fa fa-flag-checkered', 3, 1, '2017-04-13 13:40:13', '2017-04-13 13:41:07'),
(5, NULL, 'Tiendas', 'tiendas', 'fa fa-shopping-cart', 2, 1, '2017-04-13 13:48:54', '2017-04-18 16:49:35'),
(6, NULL, 'Preferencias', '', 'fa fa-cogs', 4, 1, '2017-04-17 10:42:24', '2017-04-18 16:49:08'),
(7, 6, 'Códigos de paises', 'codigopaises', 'fa fa-book', 1, 1, '2017-04-17 10:43:07', '2017-04-17 10:43:07'),
(8, 6, 'Nivel de importancia', 'importancias', 'fa fa-exclamation-triangle', 2, 1, '2017-04-17 12:16:55', '2017-04-17 12:16:55'),
(9, NULL, 'Tareas', '', 'fa fa-pencil', 1, 1, '2017-04-17 16:22:05', '2017-04-17 16:22:05'),
(10, 9, 'Mis tareas', 'tareas', 'fa fa-pencil-square-o', 1, 1, '2017-04-17 16:22:54', '2017-04-17 16:22:54'),
(11, 9, 'Categorías', 'categoriatareas', 'fa fa-list-ol', 2, 0, '2017-04-17 16:23:35', '2017-04-28 10:15:33'),
(12, 9, 'Palabras Claves', 'palabraclaves', 'fa fa-key', 3, 1, '2017-04-18 13:23:51', '2017-04-18 13:24:09'),
(13, 9, 'Grupos de características', 'grupocaracteristicas', 'fa fa-folder', 4, 1, '2017-04-18 16:32:20', '2017-04-24 09:22:33'),
(14, NULL, 'Mantenedores', 'usuarios', 'fa fa-user', 4, 1, '2017-04-18 16:48:34', '2017-04-18 16:48:34'),
(15, 6, 'Bancos', 'bancos', 'fa fa-university', 3, 1, '2017-04-26 17:45:23', '2017-04-26 17:45:23'),
(16, 6, 'Tipos de cuentas', 'tipoCuentas', 'fa fa-credit-card', 4, 1, '2017-04-26 17:46:49', '2017-04-26 17:46:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_modulos_roles`
--

CREATE TABLE `crp_modulos_roles` (
  `modulo_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `crp_modulos_roles`
--

INSERT INTO `crp_modulos_roles` (`modulo_id`, `rol_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1);

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
-- Estructura de tabla para la tabla `crp_pagos`
--

CREATE TABLE `crp_pagos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `administrador_id` int(11) NOT NULL,
  `usuario_id` bigint(20) NOT NULL,
  `tarea_id` bigint(20) NOT NULL,
  `tienda_id` int(11) NOT NULL,
  `cuenta_id` int(11) NOT NULL,
  `monto_pagado` varchar(50) NOT NULL,
  `codigo_pago` varchar(100) NOT NULL,
  `medio_de_pago` varchar(300) NOT NULL,
  `detalle` text,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) NOT NULL,
  `palabraclave_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_palabraclaves_tareas`
--

CREATE TABLE `crp_palabraclaves_tareas` (
  `id` int(11) NOT NULL,
  `tarea_id` bigint(20) NOT NULL,
  `palabraclave_id` bigint(20) NOT NULL,
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
  `id` bigint(20) NOT NULL,
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

--
-- Volcado de datos para la tabla `crp_roles`
--

INSERT INTO `crp_roles` (`id`, `nombre`, `permisos`, `activo`, `created`, `modified`) VALUES
(1, 'Super usuario', '{\r\n	"adjuntos" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"administradores" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"calificaciones" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"categoriatareas" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"comentarios" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"grupocaracteristicas" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"imagenes" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"importancias" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"modulos" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"modulos_roles" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"notificaciones" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"palabraclaves" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"palabraclaves_productos" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"palabraclaves_tareas" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"pregunta_frecuentes" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"productos" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"productos_caracteristicas" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"roles" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"tareas" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"tareas_usuarios" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"tiendas" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"usuarios" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"codigopaises" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"bancos" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	},\r\n	"tipoCuentas" : {\r\n		"agregar" : 1, "editar" : 1, "ver" : 1, "eliminar" : 1, "activar" : 1, "exportar" : 1\r\n	}\r\n}', 1, '2017-04-13 00:00:00', '2017-04-26 17:51:49');

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
  `descripcion` longtext NOT NULL,
  `precio` varchar(10) NOT NULL,
  `fecha_entrega` datetime NOT NULL,
  `cantidad_productos` int(11) NOT NULL DEFAULT '0',
  `porcentaje_realizado` int(11) NOT NULL DEFAULT '0',
  `iniciado` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_iniciado` datetime DEFAULT NULL,
  `count_comentarios` int(10) UNSIGNED DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `en_progreso` tinyint(1) NOT NULL DEFAULT '0',
  `en_revision` tinyint(1) NOT NULL DEFAULT '0',
  `rechazado` tinyint(1) NOT NULL DEFAULT '0',
  `finalizado` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_finalizado` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_tiendas`
--

CREATE TABLE `crp_tiendas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `url` varchar(50) NOT NULL,
  `nombre_base_de_datos` varchar(50) NOT NULL,
  `host` varchar(100) NOT NULL,
  `usuario_mysql` varchar(50) NOT NULL,
  `pass_mysql` varchar(50) NOT NULL,
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
-- Estructura de tabla para la tabla `crp_tipo_cuentas`
--

CREATE TABLE `crp_tipo_cuentas` (
  `id` smallint(6) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crp_usuarios`
--

CREATE TABLE `crp_usuarios` (
  `id` bigint(20) NOT NULL,
  `codigopais_id` int(11) DEFAULT NULL,
  `rut` varchar(12) DEFAULT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(70) NOT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `fono` varchar(9) DEFAULT NULL,
  `imagen` varchar(150) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `count_tareas_terminadas` tinyint(4) NOT NULL DEFAULT '0',
  `calificacion_media` int(10) UNSIGNED DEFAULT '0',
  `ultimo_acceso` datetime DEFAULT NULL,
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
  ADD KEY `IX_Relationship14` (`rol_id`),
  ADD KEY `codigo_pais` (`codigopais_id`);

--
-- Indices de la tabla `crp_bancos`
--
ALTER TABLE `crp_bancos`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `crp_codigopaises`
--
ALTER TABLE `crp_codigopaises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crp_comentarios`
--
ALTER TABLE `crp_comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship9` (`tarea_id`),
  ADD KEY `IX_Relationship18` (`importancia_id`);

--
-- Indices de la tabla `crp_correos`
--
ALTER TABLE `crp_correos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crp_cuentas`
--
ALTER TABLE `crp_cuentas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crp_grupocaracteristicas`
--
ALTER TABLE `crp_grupocaracteristicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship19` (`tienda_id`);

--
-- Indices de la tabla `crp_grupocaracteristicas_categorias`
--
ALTER TABLE `crp_grupocaracteristicas_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crp_grupocaracteristicas_especificaciones`
--
ALTER TABLE `crp_grupocaracteristicas_especificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crp_grupocaracteristicas_palabraclaves`
--
ALTER TABLE `crp_grupocaracteristicas_palabraclaves`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crp_grupocaracteristicas_tareas`
--
ALTER TABLE `crp_grupocaracteristicas_tareas`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `crp_pagos`
--
ALTER TABLE `crp_pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crp_palabraclaves`
--
ALTER TABLE `crp_palabraclaves`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crp_palabraclaves_productos`
--
ALTER TABLE `crp_palabraclaves_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crp_palabraclaves_tareas`
--
ALTER TABLE `crp_palabraclaves_tareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tarea_id` (`tarea_id`),
  ADD KEY `palabraclaves_id` (`palabraclave_id`);

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
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `crp_tiendas`
--
ALTER TABLE `crp_tiendas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crp_tipo_cuentas`
--
ALTER TABLE `crp_tipo_cuentas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crp_usuarios`
--
ALTER TABLE `crp_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigo_pais` (`codigopais_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `crp_adjuntos`
--
ALTER TABLE `crp_adjuntos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `crp_administradores`
--
ALTER TABLE `crp_administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `crp_bancos`
--
ALTER TABLE `crp_bancos`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `crp_calificaciones`
--
ALTER TABLE `crp_calificaciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `crp_categoriatareas`
--
ALTER TABLE `crp_categoriatareas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_codigopaises`
--
ALTER TABLE `crp_codigopaises`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `crp_comentarios`
--
ALTER TABLE `crp_comentarios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `crp_correos`
--
ALTER TABLE `crp_correos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT de la tabla `crp_cuentas`
--
ALTER TABLE `crp_cuentas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `crp_grupocaracteristicas`
--
ALTER TABLE `crp_grupocaracteristicas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `crp_grupocaracteristicas_categorias`
--
ALTER TABLE `crp_grupocaracteristicas_categorias`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT de la tabla `crp_grupocaracteristicas_especificaciones`
--
ALTER TABLE `crp_grupocaracteristicas_especificaciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;
--
-- AUTO_INCREMENT de la tabla `crp_grupocaracteristicas_palabraclaves`
--
ALTER TABLE `crp_grupocaracteristicas_palabraclaves`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `crp_grupocaracteristicas_tareas`
--
ALTER TABLE `crp_grupocaracteristicas_tareas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `crp_notificaciones`
--
ALTER TABLE `crp_notificaciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_pagos`
--
ALTER TABLE `crp_pagos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_palabraclaves`
--
ALTER TABLE `crp_palabraclaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `crp_palabraclaves_productos`
--
ALTER TABLE `crp_palabraclaves_productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_palabraclaves_tareas`
--
ALTER TABLE `crp_palabraclaves_tareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT de la tabla `crp_pregunta_frecuentes`
--
ALTER TABLE `crp_pregunta_frecuentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_productos`
--
ALTER TABLE `crp_productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `crp_productos_caracteristicas`
--
ALTER TABLE `crp_productos_caracteristicas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crp_roles`
--
ALTER TABLE `crp_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `crp_tareas`
--
ALTER TABLE `crp_tareas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT de la tabla `crp_tiendas`
--
ALTER TABLE `crp_tiendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `crp_tipo_cuentas`
--
ALTER TABLE `crp_tipo_cuentas`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `crp_usuarios`
--
ALTER TABLE `crp_usuarios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
