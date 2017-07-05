/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.6.25-log : Database - mantenedores_dev
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `crp_adjuntos` */

DROP TABLE IF EXISTS `crp_adjuntos`;

CREATE TABLE `crp_adjuntos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tarea_id` bigint(20) DEFAULT NULL,
  `administrador` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `descripcion` text,
  `url_archivo` varchar(200) DEFAULT NULL,
  `archivo` varchar(200) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `count_descargas` int(11) DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_Relationship8` (`tarea_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_administradores` */

DROP TABLE IF EXISTS `crp_administradores`;

CREATE TABLE `crp_administradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) DEFAULT NULL,
  `codigopais_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `fono` varchar(9) NOT NULL DEFAULT '1',
  `imagen` varchar(150) DEFAULT NULL,
  `ultimo_acceso` datetime DEFAULT NULL,
  `google_id` varchar(100) DEFAULT NULL,
  `google_dominio` varchar(100) DEFAULT NULL,
  `google_nombre` varchar(50) DEFAULT NULL,
  `google_apellido` varchar(50) DEFAULT NULL,
  `google_imagen` varchar(100) DEFAULT NULL,
  `count_tareas` int(11) DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_Relationship14` (`rol_id`),
  KEY `codigo_pais` (`codigopais_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_bancos` */

DROP TABLE IF EXISTS `crp_bancos`;

CREATE TABLE `crp_bancos` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_calificaciones` */

DROP TABLE IF EXISTS `crp_calificaciones`;

CREATE TABLE `crp_calificaciones` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) DEFAULT NULL,
  `calificacion` int(10) unsigned NOT NULL,
  `mensaje` text,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_Relationship5` (`usuario_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_caracteristicas` */

DROP TABLE IF EXISTS `crp_caracteristicas`;

CREATE TABLE `crp_caracteristicas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) DEFAULT NULL,
  `valor` varchar(100) NOT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `crp_caracteristicas_especificaciones` */

DROP TABLE IF EXISTS `crp_caracteristicas_especificaciones`;

CREATE TABLE `crp_caracteristicas_especificaciones` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `caracteristica_id` bigint(20) DEFAULT NULL,
  `id_feature` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `crp_categoriatareas` */

DROP TABLE IF EXISTS `crp_categoriatareas`;

CREATE TABLE `crp_categoriatareas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT NULL,
  `nombre` varchar(30) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `crp_codigopaises` */

DROP TABLE IF EXISTS `crp_codigopaises`;

CREATE TABLE `crp_codigopaises` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` int(5) NOT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_comentarios` */

DROP TABLE IF EXISTS `crp_comentarios`;

CREATE TABLE `crp_comentarios` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_Relationship9` (`tarea_id`),
  KEY `IX_Relationship18` (`importancia_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `crp_configuraciones` */

DROP TABLE IF EXISTS `crp_configuraciones`;

CREATE TABLE `crp_configuraciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dias_notificar_tareas` int(11) NOT NULL DEFAULT '7',
  `stock_minimo` int(10) NOT NULL DEFAULT '5',
  `bcc_tareas` varchar(100) DEFAULT NULL,
  `bcc_comentarios` varchar(100) DEFAULT NULL,
  `imagen_ancho_min` varchar(50) NOT NULL,
  `imagen_ancho_max` varchar(50) NOT NULL,
  `imagen_alto_min` varchar(50) NOT NULL,
  `imagen_alto_max` varchar(50) NOT NULL,
  `imagen_peso` int(10) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_correos` */

DROP TABLE IF EXISTS `crp_correos`;

CREATE TABLE `crp_correos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_cuentas` */

DROP TABLE IF EXISTS `crp_cuentas`;

CREATE TABLE `crp_cuentas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) NOT NULL,
  `banco_id` smallint(6) NOT NULL,
  `tipo_cuenta_id` smallint(6) NOT NULL,
  `otro` varchar(50) DEFAULT NULL,
  `cuenta` varchar(50) NOT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_especificaciones_productos` */

DROP TABLE IF EXISTS `crp_especificaciones_productos`;

CREATE TABLE `crp_especificaciones_productos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_feature` bigint(20) DEFAULT NULL,
  `producto_id` bigint(20) DEFAULT NULL,
  `no_aplica` tinyint(1) DEFAULT '0',
  `valor` varchar(150) DEFAULT NULL,
  `llave_valor` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_grupocaracteristicas` */

DROP TABLE IF EXISTS `crp_grupocaracteristicas`;

CREATE TABLE `crp_grupocaracteristicas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tienda_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `desripcion` text NOT NULL,
  `count_caracteristicas` int(11) DEFAULT NULL,
  `count_categorias` int(11) DEFAULT NULL,
  `count_palabras_claves` int(11) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_Relationship19` (`tienda_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_grupocaracteristicas_categorias` */

DROP TABLE IF EXISTS `crp_grupocaracteristicas_categorias`;

CREATE TABLE `crp_grupocaracteristicas_categorias` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `grupocaracteristica_id` bigint(20) NOT NULL,
  `id_category` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_grupocaracteristicas_especificaciones` */

DROP TABLE IF EXISTS `crp_grupocaracteristicas_especificaciones`;

CREATE TABLE `crp_grupocaracteristicas_especificaciones` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `grupocaracteristica_id` bigint(20) NOT NULL,
  `id_feature` bigint(20) NOT NULL,
  `unidad_medida_id` int(11) DEFAULT NULL,
  `permitidos` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=368 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_grupocaracteristicas_palabraclaves` */

DROP TABLE IF EXISTS `crp_grupocaracteristicas_palabraclaves`;

CREATE TABLE `crp_grupocaracteristicas_palabraclaves` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `grupocaracteristica_id` bigint(20) NOT NULL,
  `palabraclave_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_grupocaracteristicas_tareas` */

DROP TABLE IF EXISTS `crp_grupocaracteristicas_tareas`;

CREATE TABLE `crp_grupocaracteristicas_tareas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `grupocaracteristica_id` bigint(20) NOT NULL,
  `tarea_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_imagenes` */

DROP TABLE IF EXISTS `crp_imagenes`;

CREATE TABLE `crp_imagenes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) unsigned DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `imagen` varchar(200) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_Relationship21` (`producto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_importancias` */

DROP TABLE IF EXISTS `crp_importancias`;

CREATE TABLE `crp_importancias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `color` varchar(6) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `crp_marcas` */

DROP TABLE IF EXISTS `crp_marcas`;

CREATE TABLE `crp_marcas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tienda_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_modulos` */

DROP TABLE IF EXISTS `crp_modulos`;

CREATE TABLE `crp_modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `nombre` varchar(30) NOT NULL,
  `url` varchar(50) DEFAULT NULL,
  `icono` varchar(30) NOT NULL,
  `orden` int(11) NOT NULL DEFAULT '1',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_modulos_roles` */

DROP TABLE IF EXISTS `crp_modulos_roles`;

CREATE TABLE `crp_modulos_roles` (
  `modulo_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`modulo_id`,`rol_id`),
  KEY `Relationship16` (`rol_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `crp_notificaciones` */

DROP TABLE IF EXISTS `crp_notificaciones`;

CREATE TABLE `crp_notificaciones` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) DEFAULT NULL,
  `importancia_id` int(11) DEFAULT NULL,
  `tarea_id` bigint(20) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `mensaje` text,
  `visualizada` tinyint(1) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_Relationship6` (`usuario_id`),
  KEY `IX_Relationship10` (`importancia_id`),
  KEY `IX_Relationship17` (`tarea_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `crp_pagos` */

DROP TABLE IF EXISTS `crp_pagos`;

CREATE TABLE `crp_pagos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `administrador_id` int(11) NOT NULL,
  `usuario_id` bigint(20) NOT NULL,
  `tarea_id` bigint(20) NOT NULL,
  `tienda_id` int(11) NOT NULL,
  `cuenta_id` int(11) NOT NULL,
  `nombre_tarea` varchar(100) NOT NULL,
  `porcentaje_realizado` int(3) DEFAULT NULL,
  `monto_a_pagar` int(11) NOT NULL,
  `monto_pagado` varchar(50) DEFAULT NULL,
  `codigo_pago` varchar(100) DEFAULT NULL,
  `medio_de_pago` varchar(300) DEFAULT NULL,
  `detalle` text,
  `pagado` tinyint(1) DEFAULT '0',
  `fecha_pagado` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_palabraclaves` */

DROP TABLE IF EXISTS `crp_palabraclaves`;

CREATE TABLE `crp_palabraclaves` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_palabraclaves_productos` */

DROP TABLE IF EXISTS `crp_palabraclaves_productos`;

CREATE TABLE `crp_palabraclaves_productos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) NOT NULL,
  `palabraclave_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `crp_palabraclaves_tareas` */

DROP TABLE IF EXISTS `crp_palabraclaves_tareas`;

CREATE TABLE `crp_palabraclaves_tareas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarea_id` bigint(20) NOT NULL,
  `palabraclave_id` bigint(20) NOT NULL,
  `autorizada` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tarea_id` (`tarea_id`),
  KEY `palabraclaves_id` (`palabraclave_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `crp_pregunta_frecuentes` */

DROP TABLE IF EXISTS `crp_pregunta_frecuentes`;

CREATE TABLE `crp_pregunta_frecuentes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(200) NOT NULL,
  `respuesta` text NOT NULL,
  `slug` varchar(200) NOT NULL,
  `orden` smallint(6) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_productos` */

DROP TABLE IF EXISTS `crp_productos`;

CREATE TABLE `crp_productos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tarea_id` bigint(20) DEFAULT NULL,
  `grupocaracteristica_id` bigint(20) DEFAULT NULL,
  `proveedor_id` int(10) unsigned DEFAULT NULL,
  `fabricante_id` int(10) unsigned DEFAULT NULL,
  `marca_id` int(11) DEFAULT NULL,
  `categoria_deafult_id` int(11) DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `referencia` varchar(32) NOT NULL,
  `usuario_id` bigint(20) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `nombre_final` varchar(200) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `descripcion_corta` text NOT NULL,
  `descripcion` text,
  `precio` bigint(20) DEFAULT NULL,
  `largo` decimal(20,6) unsigned DEFAULT NULL,
  `alto` decimal(20,6) unsigned DEFAULT NULL,
  `profundidad` decimal(20,6) unsigned DEFAULT NULL,
  `peso` decimal(20,6) unsigned DEFAULT NULL,
  `cantidad` smallint(6) NOT NULL DEFAULT '5',
  `meta_titulo` varchar(100) NOT NULL,
  `meta_descripcion` text,
  `validado` tinyint(1) NOT NULL DEFAULT '0',
  `aceptado` tinyint(1) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_Relationship26` (`tarea_id`),
  KEY `IX_Relationship30` (`grupocaracteristica_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_productos_caracteristicas` */

DROP TABLE IF EXISTS `crp_productos_caracteristicas`;

CREATE TABLE `crp_productos_caracteristicas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) unsigned NOT NULL,
  `id_feature` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `crp_roles` */

DROP TABLE IF EXISTS `crp_roles`;

CREATE TABLE `crp_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `permisos` text NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_tareas` */

DROP TABLE IF EXISTS `crp_tareas`;

CREATE TABLE `crp_tareas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) DEFAULT NULL,
  `administrador_id` int(11) DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `categoriatarea_id` bigint(20) DEFAULT NULL,
  `tienda_id` int(11) DEFAULT NULL,
  `impuesto_default_id` int(10) unsigned NOT NULL,
  `idioma_id` int(10) unsigned NOT NULL,
  `shop_id` smallint(5) unsigned NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` longtext NOT NULL,
  `precio` varchar(10) NOT NULL,
  `fecha_entrega` datetime NOT NULL,
  `cantidad_productos` int(11) NOT NULL DEFAULT '0',
  `porcentaje_realizado` int(11) NOT NULL DEFAULT '0',
  `iniciado` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_iniciado` datetime DEFAULT NULL,
  `count_comentarios` int(10) unsigned DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `en_progreso` tinyint(1) NOT NULL DEFAULT '0',
  `en_revision` tinyint(1) NOT NULL DEFAULT '0',
  `rechazado` tinyint(1) NOT NULL DEFAULT '0',
  `finalizado` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_finalizado` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_Relationship7` (`usuario_id`),
  KEY `IX_Relationship11` (`categoriatarea_id`),
  KEY `IX_Relationship12` (`administrador_id`),
  KEY `IX_Relationship13` (`tienda_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_tiendas` */

DROP TABLE IF EXISTS `crp_tiendas`;

CREATE TABLE `crp_tiendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_tipo_cuentas` */

DROP TABLE IF EXISTS `crp_tipo_cuentas`;

CREATE TABLE `crp_tipo_cuentas` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_unidad_medidas` */

DROP TABLE IF EXISTS `crp_unidad_medidas`;

CREATE TABLE `crp_unidad_medidas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `ejemplo` varchar(50) DEFAULT NULL,
  `tipo_campo` varchar(20) DEFAULT NULL,
  `permitidos` varchar(300) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Table structure for table `crp_usuarios` */

DROP TABLE IF EXISTS `crp_usuarios`;

CREATE TABLE `crp_usuarios` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `calificacion_media` int(10) unsigned DEFAULT '0',
  `ultimo_acceso` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `tour_inicio` tinyint(1) DEFAULT '1',
  `tour_tarea` tinyint(1) DEFAULT '1',
  `tour_producto` tinyint(1) DEFAULT '1',
  `tour_perfil` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `codigo_pais` (`codigopais_id`)
) ENGINE=MyISAM AUTO_INCREMENT=666 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
