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
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Data for the table `crp_adjuntos` */

LOCK TABLES `crp_adjuntos` WRITE;

insert  into `crp_adjuntos`(`id`,`tarea_id`,`administrador`,`nombre`,`descripcion`,`url_archivo`,`archivo`,`activo`,`count_descargas`,`created`,`modified`) values (1,24,1,'ass','sasad','4.jpg',NULL,1,0,'2017-04-24 16:22:49','2017-04-24 16:22:49'),(3,26,1,'Pdf','Archivo PDF',NULL,NULL,1,0,'2017-04-24 17:01:36','2017-04-24 17:01:36'),(5,29,1,'Excel','Archivo Excel','productos_toolmania.xlsx',NULL,1,0,'2017-04-24 17:08:19','2017-04-24 17:08:19'),(22,40,1,'Catálogo de productos','','adjunto_0jzdkvfp49.pdf',NULL,1,0,'2017-05-02 17:58:01','2017-05-02 17:58:01'),(7,30,1,'Word','Archivo Word','contratotoolmania.com.docx',NULL,1,0,'2017-04-24 17:09:27','2017-04-24 17:09:27'),(21,38,1,'Catálogo de la marca','','adjunto_bmgifuerz3.pdf',NULL,1,0,'2017-04-28 10:20:37','2017-05-03 13:25:33'),(9,34,1,'Otro','Otro','9van7lrg6ofh4xpgirdt',NULL,1,0,'2017-04-25 10:22:02','2017-04-25 10:22:02'),(11,35,1,'as','as','nqldrm7btrvmja5o0q8hpdf',NULL,1,0,'2017-04-25 10:23:27','2017-04-25 10:23:27'),(13,36,1,'ba','vva','zytkypvpukieccwq1mig.pdf',NULL,1,0,'2017-04-25 10:25:17','2017-04-25 10:25:17'),(14,36,1,'df','ddf','ogsu8qrtj7spfklhwy2z.jpg',NULL,1,0,'2017-04-25 10:25:17','2017-04-25 10:25:17'),(15,36,1,'dd','dd','3u2nrgplya0v1utrnwzp.xlsx',NULL,1,0,'2017-04-25 10:25:17','2017-04-25 10:25:17'),(23,54,1,'Catálogo de productos','sasadsad','adjunto_8wpnd2riqy.xlsx',NULL,1,0,'2017-05-09 15:50:41','2017-05-09 15:50:41'),(25,57,1,'Catálogo','','adjunto_jelxanp948.pdf',NULL,1,0,'2017-05-17 09:28:21','2017-05-17 09:28:21'),(26,61,1,'Catálogo','Agregar solo 2 productos del catálogo','adjunto_kobqcqwbc6.pdf',NULL,1,0,'2017-06-09 15:48:28','2017-06-09 15:48:28');

UNLOCK TABLES;

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

/*Data for the table `crp_administradores` */

LOCK TABLES `crp_administradores` WRITE;

insert  into `crp_administradores`(`id`,`rol_id`,`codigopais_id`,`nombre`,`apellidos`,`email`,`clave`,`fono`,`imagen`,`ultimo_acceso`,`google_id`,`google_dominio`,`google_nombre`,`google_apellido`,`google_imagen`,`count_tareas`,`activo`,`created`,`modified`) values (1,1,1,'Desarrollo Nodriza Spa','','desarrollo@nodriza.cl','c1721c9e60f0c1a4a5f9df1cd0b4f0c916b02275','99291234',NULL,'2017-06-20 12:49:35',NULL,'','','','',0,1,'2017-04-12 17:58:56','2017-06-20 12:49:35'),(2,1,1,'Cristian ','Rojas Pérez','cristian.rojas@nodriza.cl','43496642d74ad5c4a0cce621044f02fd817a0928','992965777',NULL,'2017-06-22 09:30:44','100199598951995687437','nodriza.cl','Cristian','Rojas','https://lh6.googleusercontent.com/-jYJmerMF8sQ/AAAAAAAAAAI/AAAAAAAAAEw/ax7lJsKiR4w/photo.jpg?sz=50',0,1,'2017-06-15 16:53:17','2017-06-22 09:30:44'),(3,2,1,'Cristian ','Rojas','cristian18@outlook.cl','43496642d74ad5c4a0cce621044f02fd817a0928','992965777',NULL,'2017-06-16 11:07:20',NULL,NULL,NULL,NULL,NULL,0,1,'2017-06-16 11:07:05','2017-06-16 11:07:20'),(4,2,1,'Ivan','Henriquez','ivan.henriquez@nodriza.cl','dbf0c726fb22e4c4c4f3e21146504443ada82bc1','87299120',NULL,'2017-06-22 09:52:01','115451242425447688236','nodriza.cl','Ivan','Henriquez','https://lh3.googleusercontent.com/-6gii5tCQTk8/AAAAAAAAAAI/AAAAAAAAAAA/H9i6R23NFQ8/photo.jpg?sz=50',0,1,'2017-06-16 11:15:53','2017-06-22 09:52:01');

UNLOCK TABLES;

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

/*Data for the table `crp_bancos` */

LOCK TABLES `crp_bancos` WRITE;

insert  into `crp_bancos`(`id`,`nombre`,`activo`,`created`,`modified`) values (1,'Banco Santander',1,'2017-04-26 17:48:17','2017-04-26 17:48:17'),(2,'Banco de Chile',1,'2017-06-16 10:48:05','2017-06-16 10:48:05'),(3,'Banco Internacional',1,'2017-06-16 10:48:19','2017-06-16 10:48:19'),(4,'Scotiabank',1,'2017-06-16 10:48:40','2017-06-16 10:48:40'),(5,'Banco BCI',1,'2017-06-16 10:49:04','2017-06-16 10:49:04'),(6,'Banco Bice',1,'2017-06-16 10:49:25','2017-06-16 10:50:30'),(7,'HSBC Bank',1,'2017-06-16 10:49:53','2017-06-16 10:49:53'),(8,'Banco Itaú',1,'2017-06-16 10:50:09','2017-06-16 10:50:09'),(9,'Banco Security',1,'2017-06-16 10:50:27','2017-06-16 10:50:27'),(10,'Banco Falabella',1,'2017-06-16 10:50:45','2017-06-16 10:50:45'),(11,'Banco Ripley',1,'2017-06-16 10:51:03','2017-06-16 10:51:03'),(12,'Rabobank Chile',1,'2017-06-16 10:51:18','2017-06-16 10:51:18'),(13,'Banco Consorcio',1,'2017-06-16 10:51:40','2017-06-16 10:51:40'),(14,'Banco Penta',1,'2017-06-16 10:51:56','2017-06-16 10:51:56'),(15,'Banco Paris',1,'2017-06-16 10:52:07','2017-06-16 10:52:07'),(16,'Banco BBVA',1,'2017-06-16 10:53:16','2017-06-16 10:53:16'),(17,'Banco BTG Pactual Chile',1,'2017-06-16 10:53:38','2017-06-16 10:53:38'),(18,'Banco Estado',1,'2017-06-16 10:53:59','2017-06-16 10:53:59');

UNLOCK TABLES;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `crp_calificaciones` */

LOCK TABLES `crp_calificaciones` WRITE;

insert  into `crp_calificaciones`(`id`,`usuario_id`,`calificacion`,`mensaje`,`activo`,`created`,`modified`) values (1,2,4,'Bien',1,'2017-06-20 15:38:15','2017-06-20 15:38:15'),(2,2,1,'Blas',1,'2017-06-20 16:10:48','2017-06-20 16:10:48');

UNLOCK TABLES;

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

/*Data for the table `crp_caracteristicas` */

LOCK TABLES `crp_caracteristicas` WRITE;

UNLOCK TABLES;

/*Table structure for table `crp_caracteristicas_especificaciones` */

DROP TABLE IF EXISTS `crp_caracteristicas_especificaciones`;

CREATE TABLE `crp_caracteristicas_especificaciones` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `caracteristica_id` bigint(20) DEFAULT NULL,
  `id_feature` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `crp_caracteristicas_especificaciones` */

LOCK TABLES `crp_caracteristicas_especificaciones` WRITE;

UNLOCK TABLES;

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

/*Data for the table `crp_categoriatareas` */

LOCK TABLES `crp_categoriatareas` WRITE;

UNLOCK TABLES;

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

/*Data for the table `crp_codigopaises` */

LOCK TABLES `crp_codigopaises` WRITE;

insert  into `crp_codigopaises`(`id`,`nombre`,`pais`,`activo`,`created`,`modified`) values (1,56,'Chile',1,'2017-04-17 10:43:35','2017-04-17 10:43:35');

UNLOCK TABLES;

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

/*Data for the table `crp_comentarios` */

LOCK TABLES `crp_comentarios` WRITE;

UNLOCK TABLES;

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

/*Data for the table `crp_configuraciones` */

LOCK TABLES `crp_configuraciones` WRITE;

insert  into `crp_configuraciones`(`id`,`dias_notificar_tareas`,`stock_minimo`,`bcc_tareas`,`bcc_comentarios`,`imagen_ancho_min`,`imagen_ancho_max`,`imagen_alto_min`,`imagen_alto_max`,`imagen_peso`) values (1,5,5,'cristian.rojas@nodriza.cl','cristian.rojas@nodriza.cl','500','1200','500','1200',2);

UNLOCK TABLES;

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `crp_correos` */

LOCK TABLES `crp_correos` WRITE;

insert  into `crp_correos`(`id`,`estado`,`html`,`asunto`,`destinatario_email`,`destinatario_nombre`,`remitente_email`,`remitente_nombre`,`cc_email`,`bcc_email`,`traza`,`proceso_origen`,`procesado`,`enviado`,`reintentos`,`atachado`,`created`,`modified`) values (1,'Notificación de nueva cuenta','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n<style type=\"text/css\">\n  body, .mainTable { height:100% !important; width:100% !important; margin:0; padding:0; }\n  img, a img { border:0; outline:none; text-decoration:none; }\n  .imageFix { display:block; }\n  table, td { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;}\n  p {margin:0; padding:0; margin-bottom:0;}\n  .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}\n  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}\n  img{-ms-interpolation-mode: bicubic;}\n  body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}\n</style><style>\ntable{ border-collapse: collapse; }\n@media only screen and (max-width: 600px) {\n    body[yahoo] .rimg {\n       max-width: 100%;\n       height: auto;\n    }\n    body[yahoo] .rtable{\n        width: 100% !important;\n        table-layout: fixed;\n    }\n}\n</style>\n\n<!--[if gte mso 9]>\n<xml>\n  <o:OfficeDocumentSettings>\n    <o:AllowPNG/>\n    <o:PixelsPerInch>96</o:PixelsPerInch>\n  </o:OfficeDocumentSettings>\n</xml>\n<![endif]-->\n</head>\n<body yahoo=fix scroll=\"auto\" style=\"padding:0; margin:0; FONT-SIZE: 12px; FONT-FAMILY: Arial, Helvetica, sans-serif; cursor:auto; background:#F3F3F3\">\n  \n<TABLE class=\"rtable mainTable\" cellSpacing=0 cellPadding=0 width=\"100%\" bgColor=#f3f3f3>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0\">&#160;</TD>\n  </TR>\n  <TR>\n    <TD vAlign=top>\n      <TABLE class=rtable style=\"WIDTH: 600px; MARGIN: 0px auto\" cellSpacing=0 cellPadding=0 width=600 align=center border=0>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #1d2127\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: middle; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 10px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <TABLE cellSpacing=0 cellPadding=0 align=center border=0>\n                    <TR>\n                      <TD style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=center>\n                        <TABLE cellSpacing=0 cellPadding=0 border=0>\n                          <TR>\n                            <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\">\n                              <img src=\"http://dev.nodriza.cl/mantenedores/img/nodrizablanco.png\" vspace=\"0\" hspace=\"0\" border=\"0\" class=\"rimg\" style=\"MAX-WIDTH: 135px; BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block; BACKGROUND-COLOR: transparent\" alt=\"\"/>                            </TD>\n                          </TR>\n                        </TABLE>\n                      </TD>\n                    </TR>\n                  </TABLE>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: #dbdbdb 1px solid; BORDER-RIGHT: #dbdbdb 1px solid; BORDER-BOTTOM: #dbdbdb 1px solid; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: #dbdbdb 1px solid; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 20px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; TEXT-ALIGN: center; PADDING-TOP: 35px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: #feffff\">\n                  <P style=\"FONT-SIZE: 18px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>\n                    <STRONG>Estimado/a Cristian</STRONG>\n                  </P>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Bienvenido al portal de trabajo de Nodriza Spa. <BR>Para comenzar a trabajar ingrese al portal haciendo click en el siguiente link:\n                  <BR>\n                  <a href=\"http://dev.nodriza.cl/mantenedores/maintainers/login\" style=\"background-color:#771D97; font-size: 14px; font-family: arial, helvetica, sans-serif; color: #ffffff; padding: 5px 15px; text-decoration: none; margin-top: 15px; display: inline-block; text-align: center;\">Ingreso al portal</a>                  <BR>\n                  <BR>\n                  <FONT style=\"FONT-SIZE: 14px\"><STRONG>Sus credenciales: </STRONG></FONT>\n                  <BR>Email: cristian.rojas@nodriza.cl \n                  <BR>Contrase&#241;a: rpy0K8WQkf</P>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Recuerde completar su informaci&#243;n de perfil para poder recibir los pagos de sus tareas finalizadas.</P>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Atte Equipo de mantenci&#243;n Nodriza Spa.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; PADDING-TOP: 1px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Por favor no conteste este email, ya que es generado autom&#225;ticamente por nuestro sistema.</P>\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>&#169;2017 Nodriza Spa.Todos los derechos reservados.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n      </TABLE>\n    </TD>\n  </TR>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0\">&#160;\n    </TD>\n  </TR>\n</TABLE>\n</body>\n</html>','¡Bienvenido a Nodriza Spa!','cristian.rojas@nodriza.cl','Cristian','no-reply@nodriza.cl','Portal mantenedores - Nodriza Spa','','cristian.rojas@nodriza.cl',NULL,NULL,1,1,1,NULL,'2017-06-15 17:06:51','2017-06-15 17:07:01'),(2,'Notificación de nueva cuenta','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n<style type=\"text/css\">\n  body, .mainTable { height:100% !important; width:100% !important; margin:0; padding:0; }\n  img, a img { border:0; outline:none; text-decoration:none; }\n  .imageFix { display:block; }\n  table, td { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;}\n  p {margin:0; padding:0; margin-bottom:0;}\n  .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}\n  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}\n  img{-ms-interpolation-mode: bicubic;}\n  body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}\n</style><style>\ntable{ border-collapse: collapse; }\n@media only screen and (max-width: 600px) {\n    body[yahoo] .rimg {\n       max-width: 100%;\n       height: auto;\n    }\n    body[yahoo] .rtable{\n        width: 100% !important;\n        table-layout: fixed;\n    }\n}\n</style>\n\n<!--[if gte mso 9]>\n<xml>\n  <o:OfficeDocumentSettings>\n    <o:AllowPNG/>\n    <o:PixelsPerInch>96</o:PixelsPerInch>\n  </o:OfficeDocumentSettings>\n</xml>\n<![endif]-->\n</head>\n<body yahoo=fix scroll=\"auto\" style=\"padding:0; margin:0; FONT-SIZE: 12px; FONT-FAMILY: Arial, Helvetica, sans-serif; cursor:auto; background:#F3F3F3\">\n  \n<TABLE class=\"rtable mainTable\" cellSpacing=0 cellPadding=0 width=\"100%\" bgColor=#f3f3f3>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0\">&#160;</TD>\n  </TR>\n  <TR>\n    <TD vAlign=top>\n      <TABLE class=rtable style=\"WIDTH: 600px; MARGIN: 0px auto\" cellSpacing=0 cellPadding=0 width=600 align=center border=0>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #1d2127\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: middle; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 10px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <TABLE cellSpacing=0 cellPadding=0 align=center border=0>\n                    <TR>\n                      <TD style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=center>\n                        <TABLE cellSpacing=0 cellPadding=0 border=0>\n                          <TR>\n                            <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\">\n                              <img src=\"http://mantenedores.nodriza.cl/img/nodrizablanco.png\" vspace=\"0\" hspace=\"0\" border=\"0\" class=\"rimg\" style=\"MAX-WIDTH: 135px; BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block; BACKGROUND-COLOR: transparent\" alt=\"\"/>                            </TD>\n                          </TR>\n                        </TABLE>\n                      </TD>\n                    </TR>\n                  </TABLE>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: #dbdbdb 1px solid; BORDER-RIGHT: #dbdbdb 1px solid; BORDER-BOTTOM: #dbdbdb 1px solid; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: #dbdbdb 1px solid; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 20px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; TEXT-ALIGN: center; PADDING-TOP: 35px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: #feffff\">\n                  <P style=\"FONT-SIZE: 18px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>\n                    <STRONG>Estimado/a Cristian</STRONG>\n                  </P>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Bienvenido al portal de trabajo de Nodriza Spa. <BR>Para comenzar a trabajar ingrese al portal haciendo click en el siguiente link:\n                  <BR>\n                  <a href=\"http://mantenedores.nodriza.cl/maintainers/login\" style=\"background-color:#771D97; font-size: 14px; font-family: arial, helvetica, sans-serif; color: #ffffff; padding: 5px 15px; text-decoration: none; margin-top: 15px; display: inline-block; text-align: center;\">Ingreso al portal</a>                  <BR>\n                  <BR>\n                  <FONT style=\"FONT-SIZE: 14px\"><STRONG>Sus credenciales: </STRONG></FONT>\n                  <BR>Email: cristian.rojas@nodriza.cl \n                  <BR>Contrase&#241;a: 2gdOyLrtiw</P>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Recuerde completar su informaci&#243;n de perfil para poder recibir los pagos de sus tareas finalizadas.</P>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Atte Equipo de mantenci&#243;n Nodriza Spa.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; PADDING-TOP: 1px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Por favor no conteste este email, ya que es generado autom&#225;ticamente por nuestro sistema.</P>\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>&#169;2017 Nodriza Spa.Todos los derechos reservados.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n      </TABLE>\n    </TD>\n  </TR>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0\">&#160;\n    </TD>\n  </TR>\n</TABLE>\n</body>\n</html>','¡Bienvenido a Nodriza Spa!','cristian.rojas@nodriza.cl','Cristian','no-reply@nodriza.cl','Portal mantenedores - Nodriza Spa','','cristian.rojas@nodriza.cl',NULL,NULL,1,1,1,NULL,'2017-06-19 09:46:18','2017-06-19 09:56:01'),(3,'Notificación de tarea asignada','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n<style type=\"text/css\">\n  body, .mainTable { height:100% !important; width:100% !important; margin:0; padding:0; }\n  img, a img { border:0; outline:none; text-decoration:none; }\n  .imageFix { display:block; }\n  table, td { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;}\n  p {margin:0; padding:0; margin-bottom:0;}\n  .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}\n  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}\n  img{-ms-interpolation-mode: bicubic;}\n  body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}\n</style><style>\ntable{ border-collapse: collapse; }\n@media only screen and (max-width: 600px) {\n    body[yahoo] .rimg {\n       max-width: 100%;\n       height: auto;\n    }\n    body[yahoo] .rtable{\n        width: 100% !important;\n        table-layout: fixed;\n    }\n}\n</style>\n\n<!--[if gte mso 9]>\n<xml>\n  <o:OfficeDocumentSettings>\n    <o:AllowPNG/>\n    <o:PixelsPerInch>96</o:PixelsPerInch>\n  </o:OfficeDocumentSettings>\n</xml>\n<![endif]-->\n</head>\n<body yahoo=fix scroll=\"auto\" style=\"padding:0; margin:0; FONT-SIZE: 12px; FONT-FAMILY: Arial, Helvetica, sans-serif; cursor:auto; background:#F3F3F3\">\n  \n<TABLE class=\"rtable mainTable\" cellSpacing=0 cellPadding=0 width=\"100%\" bgColor=#f3f3f3>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0\">&#160;</TD>\n  </TR>\n  <TR>\n    <TD vAlign=top>\n      <TABLE class=rtable style=\"WIDTH: 600px; MARGIN: 0px auto\" cellSpacing=0 cellPadding=0 width=600 align=center border=0>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #1d2127\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: middle; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 10px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <TABLE cellSpacing=0 cellPadding=0 align=center border=0>\n                    <TR>\n                      <TD style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=center>\n                        <TABLE cellSpacing=0 cellPadding=0 border=0>\n                          <TR>\n                            <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\">\n                              <img src=\"http://localhost/mantenedores/img/nodrizablanco.png\" vspace=\"0\" hspace=\"0\" border=\"0\" class=\"rimg\" style=\"MAX-WIDTH: 135px; BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block; BACKGROUND-COLOR: transparent\" alt=\"\"/>                            </TD>\n                          </TR>\n                        </TABLE>\n                      </TD>\n                    </TR>\n                  </TABLE>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: #dbdbdb 1px solid; BORDER-RIGHT: #dbdbdb 1px solid; BORDER-BOTTOM: #dbdbdb 1px solid; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: #dbdbdb 1px solid; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 20px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; TEXT-ALIGN: center; PADDING-TOP: 35px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: #feffff\">\n                  <P style=\"FONT-SIZE: 18px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>\n                    <STRONG>La tarea identificador #1, nombre [TEST] Tarea 10 ha sido asiganda a usted.</STRONG>\n                  </P>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>\n                  Sí no desea trabajar en la tarea, notifique al administrador comentandola. \n                  <BR>\n                  <BR>Para comenzar a trabajar ingrese al portal haciendo click en el siguiente link:\n                  <BR>\n                  <a href=\"http://localhost/mantenedores/maintainers/login\" style=\"background-color:#771D97; font-size: 14px; font-family: arial, helvetica, sans-serif; color: #ffffff; padding: 5px 15px; text-decoration: none; margin-top: 15px; display: inline-block; text-align: center;\">Ingreso al portal</a>                  <BR>\n                  <BR>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Atte Equipo de mantenci&#243;n Nodriza Spa.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; PADDING-TOP: 1px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Por favor no conteste este email, ya que es generado autom&#225;ticamente por nuestro sistema.</P>\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>&#169;2017 Nodriza Spa.Todos los derechos reservados.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n      </TABLE>\n    </TD>\n  </TR>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0\">&#160;\n    </TD>\n  </TR>\n</TABLE>\n</body>\n</html>','[NDRZA] ¡Se le ha asignado una tarea!','cristian.rojas@nodriza.cl','Cristian','no-reply@nodriza.cl','Portal mantenedores - Nodriza Spa','','cristian.rojas@nodriza.cl',NULL,NULL,1,1,1,NULL,'2017-06-19 16:44:48','2017-06-19 16:45:01'),(4,'Notificación de inicio tarea a administrador','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n<style type=\"text/css\">\n  body, .mainTable { height:100% !important; width:100% !important; margin:0; padding:0; }\n  img, a img { border:0; outline:none; text-decoration:none; }\n  .imageFix { display:block; }\n  table, td { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;}\n  p {margin:0; padding:0; margin-bottom:0;}\n  .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}\n  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}\n  img{-ms-interpolation-mode: bicubic;}\n  body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}\n</style><style>\ntable{ border-collapse: collapse; }\n@media only screen and (max-width: 600px) {\n    body[yahoo] .rimg {\n       max-width: 100%;\n       height: auto;\n    }\n    body[yahoo] .rtable{\n        width: 100% !important;\n        table-layout: fixed;\n    }\n}\n</style>\n\n<!--[if gte mso 9]>\n<xml>\n  <o:OfficeDocumentSettings>\n    <o:AllowPNG/>\n    <o:PixelsPerInch>96</o:PixelsPerInch>\n  </o:OfficeDocumentSettings>\n</xml>\n<![endif]-->\n</head>\n<body yahoo=fix scroll=\"auto\" style=\"padding:0; margin:0; FONT-SIZE: 12px; FONT-FAMILY: Arial, Helvetica, sans-serif; cursor:auto; background:#F3F3F3\">\n  \n<TABLE class=\"rtable mainTable\" cellSpacing=0 cellPadding=0 width=\"100%\" bgColor=#f3f3f3>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0\">&#160;</TD>\n  </TR>\n  <TR>\n    <TD vAlign=top>\n      <TABLE class=rtable style=\"WIDTH: 600px; MARGIN: 0px auto\" cellSpacing=0 cellPadding=0 width=600 align=center border=0>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #1d2127\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: middle; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 10px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <TABLE cellSpacing=0 cellPadding=0 align=center border=0>\n                    <TR>\n                      <TD style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=center>\n                        <TABLE cellSpacing=0 cellPadding=0 border=0>\n                          <TR>\n                            <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\">\n                              <img src=\"http://localhost/mantenedores/img/nodrizablanco.png\" vspace=\"0\" hspace=\"0\" border=\"0\" class=\"rimg\" style=\"MAX-WIDTH: 135px; BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block; BACKGROUND-COLOR: transparent\" alt=\"\"/>                            </TD>\n                          </TR>\n                        </TABLE>\n                      </TD>\n                    </TR>\n                  </TABLE>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: #dbdbdb 1px solid; BORDER-RIGHT: #dbdbdb 1px solid; BORDER-BOTTOM: #dbdbdb 1px solid; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: #dbdbdb 1px solid; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 20px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 35px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: #feffff\">\n                  <p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">\n                    Estimado/a Desarrollo Nodriza Spa                  </p>\n                  <p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">\n                    El mantenedor encargado de la tarea identificador #1 la ha iniciado el 19 de 06 del 2017  a las 16:46:33.\n                  </p>\n                  <BR>\n                  <BR>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Atte Equipo de mantenci&#243;n Nodriza Spa.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; PADDING-TOP: 1px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Por favor no conteste este email, ya que es generado autom&#225;ticamente por nuestro sistema.</P>\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>&#169;2017 Nodriza Spa.Todos los derechos reservados.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n      </TABLE>\n    </TD>\n  </TR>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0\">&#160;\n    </TD>\n  </TR>\n</TABLE>\n</body>\n</html>','[NDRZA] El mantenedor ha iniciado una tarea','desarrollo@nodriza.cl','Desarrollo Nodriza Spa','no-reply@nodriza.cl','Portal mantenedores - Nodriza Spa','','cristian.rojas@nodriza.cl',NULL,NULL,1,1,1,NULL,'2017-06-19 16:46:38','2017-06-19 16:47:01'),(5,'Notificación de tarea modificada','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n<style type=\"text/css\">\n  body, .mainTable { height:100% !important; width:100% !important; margin:0; padding:0; }\n  img, a img { border:0; outline:none; text-decoration:none; }\n  .imageFix { display:block; }\n  table, td { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;}\n  p {margin:0; padding:0; margin-bottom:0;}\n  .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}\n  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}\n  img{-ms-interpolation-mode: bicubic;}\n  body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}\n</style><style>\ntable{ border-collapse: collapse; }\n@media only screen and (max-width: 600px) {\n    body[yahoo] .rimg {\n       max-width: 100%;\n       height: auto;\n    }\n    body[yahoo] .rtable{\n        width: 100% !important;\n        table-layout: fixed;\n    }\n}\n</style>\n\n<!--[if gte mso 9]>\n<xml>\n  <o:OfficeDocumentSettings>\n    <o:AllowPNG/>\n    <o:PixelsPerInch>96</o:PixelsPerInch>\n  </o:OfficeDocumentSettings>\n</xml>\n<![endif]-->\n</head>\n<body yahoo=fix scroll=\"auto\" style=\"padding:0; margin:0; FONT-SIZE: 12px; FONT-FAMILY: Arial, Helvetica, sans-serif; cursor:auto; background:#F3F3F3\">\n  \n<TABLE class=\"rtable mainTable\" cellSpacing=0 cellPadding=0 width=\"100%\" bgColor=#f3f3f3>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0\">&#160;</TD>\n  </TR>\n  <TR>\n    <TD vAlign=top>\n      <TABLE class=rtable style=\"WIDTH: 600px; MARGIN: 0px auto\" cellSpacing=0 cellPadding=0 width=600 align=center border=0>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #1d2127\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: middle; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 10px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <TABLE cellSpacing=0 cellPadding=0 align=center border=0>\n                    <TR>\n                      <TD style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=center>\n                        <TABLE cellSpacing=0 cellPadding=0 border=0>\n                          <TR>\n                            <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\">\n                              <img src=\"http://localhost/mantenedores/img/nodrizablanco.png\" vspace=\"0\" hspace=\"0\" border=\"0\" class=\"rimg\" style=\"MAX-WIDTH: 135px; BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block; BACKGROUND-COLOR: transparent\" alt=\"\"/>                            </TD>\n                          </TR>\n                        </TABLE>\n                      </TD>\n                    </TR>\n                  </TABLE>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: #dbdbdb 1px solid; BORDER-RIGHT: #dbdbdb 1px solid; BORDER-BOTTOM: #dbdbdb 1px solid; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: #dbdbdb 1px solid; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 20px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; TEXT-ALIGN: center; PADDING-TOP: 35px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: #feffff\">\n                  <P style=\"FONT-SIZE: 18px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>\n                    <STRONG>La tarea identificador #1, nombre [TEST] Tarea 10 ha sido modificada por el administrador.</STRONG>\n                  </P>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>\n                  Sí tiene dudas comente la tarea o contacte al administrador.\n                  <BR>\n                  <BR>Para ingresar a la tarea pinche en el siguiente botón:\n                  <BR>\n                  <a href=\"http://localhost/mantenedores/maintainers/tareas/work/1\" style=\"background-color:#771D97; font-size: 14px; font-family: arial, helvetica, sans-serif; color: #ffffff; padding: 5px 15px; text-decoration: none; margin-top: 15px; display: inline-block; text-align: center; margin-right: auto;\">Ingresar a la tarea</a>                  <BR>\n                  <BR>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Atte Equipo de mantenci&#243;n Nodriza Spa.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; PADDING-TOP: 1px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Por favor no conteste este email, ya que es generado autom&#225;ticamente por nuestro sistema.</P>\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>&#169;2017 Nodriza Spa.Todos los derechos reservados.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n      </TABLE>\n    </TD>\n  </TR>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0\">&#160;\n    </TD>\n  </TR>\n</TABLE>\n</body>\n</html>','[NDRZA] Se ha modificado su tarea','cristian.rojas@nodriza.cl','Cristian','no-reply@nodriza.cl','Portal mantenedores - Nodriza Spa','','cristian.rojas@nodriza.cl',NULL,NULL,1,1,1,NULL,'2017-06-20 15:04:02','2017-06-20 15:05:01'),(6,'Notificación de revision tarea a administrador','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n<style type=\"text/css\">\n  body, .mainTable { height:100% !important; width:100% !important; margin:0; padding:0; }\n  img, a img { border:0; outline:none; text-decoration:none; }\n  .imageFix { display:block; }\n  table, td { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;}\n  p {margin:0; padding:0; margin-bottom:0;}\n  .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}\n  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}\n  img{-ms-interpolation-mode: bicubic;}\n  body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}\n</style><style>\ntable{ border-collapse: collapse; }\n@media only screen and (max-width: 600px) {\n    body[yahoo] .rimg {\n       max-width: 100%;\n       height: auto;\n    }\n    body[yahoo] .rtable{\n        width: 100% !important;\n        table-layout: fixed;\n    }\n}\n</style>\n\n<!--[if gte mso 9]>\n<xml>\n  <o:OfficeDocumentSettings>\n    <o:AllowPNG/>\n    <o:PixelsPerInch>96</o:PixelsPerInch>\n  </o:OfficeDocumentSettings>\n</xml>\n<![endif]-->\n</head>\n<body yahoo=fix scroll=\"auto\" style=\"padding:0; margin:0; FONT-SIZE: 12px; FONT-FAMILY: Arial, Helvetica, sans-serif; cursor:auto; background:#F3F3F3\">\n  \n<TABLE class=\"rtable mainTable\" cellSpacing=0 cellPadding=0 width=\"100%\" bgColor=#f3f3f3>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0\">&#160;</TD>\n  </TR>\n  <TR>\n    <TD vAlign=top>\n      <TABLE class=rtable style=\"WIDTH: 600px; MARGIN: 0px auto\" cellSpacing=0 cellPadding=0 width=600 align=center border=0>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #1d2127\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: middle; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 10px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <TABLE cellSpacing=0 cellPadding=0 align=center border=0>\n                    <TR>\n                      <TD style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=center>\n                        <TABLE cellSpacing=0 cellPadding=0 border=0>\n                          <TR>\n                            <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\">\n                              <img src=\"http://localhost/mantenedores/img/nodrizablanco.png\" vspace=\"0\" hspace=\"0\" border=\"0\" class=\"rimg\" style=\"MAX-WIDTH: 135px; BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block; BACKGROUND-COLOR: transparent\" alt=\"\"/>                            </TD>\n                          </TR>\n                        </TABLE>\n                      </TD>\n                    </TR>\n                  </TABLE>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: #dbdbdb 1px solid; BORDER-RIGHT: #dbdbdb 1px solid; BORDER-BOTTOM: #dbdbdb 1px solid; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: #dbdbdb 1px solid; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 20px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 35px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: #feffff\">\n                  <p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">\n                    Estimado/a Desarrollo Nodriza Spa                  </p>\n                  <p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">\n                    Tiene una nueva tarea para revisar.\n                    El mantenedor cristian.rojas@nodriza.cl ha enviado a revisión una tarea. Recuerde revisar uno a uno todos los productos cargados y verificar que la configuración se haya respetado a cabalidad.\n                  </p>\n                  <p style=\"FONT-SIZE: 14px; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">Para ver la tarea ingrese haciendo click en el siguiente link:</p>\n                  <a href=\"http://localhost/mantenedores/admin/tareas/edit/1\" style=\"background-color:#771D97; font-size: 14px; font-family: arial, helvetica, sans-serif; color: #ffffff; padding: 5px 15px; text-decoration: none; margin-top: 15px; display: inline-block; text-align: center;\">Revisar la tarea</a>                  <BR>\n                  <BR>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Atte Equipo de mantenci&#243;n Nodriza Spa.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; PADDING-TOP: 1px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Por favor no conteste este email, ya que es generado autom&#225;ticamente por nuestro sistema.</P>\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>&#169;2017 Nodriza Spa.Todos los derechos reservados.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n      </TABLE>\n    </TD>\n  </TR>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0\">&#160;\n    </TD>\n  </TR>\n</TABLE>\n</body>\n</html>','[NDRZA] Nueva tarea para revisión','desarrollo@nodriza.cl','Desarrollo Nodriza Spa','no-reply@nodriza.cl','Portal mantenedores - Nodriza Spa','','cristian.rojas@nodriza.cl',NULL,NULL,1,1,1,NULL,'2017-06-20 15:29:16','2017-06-20 15:30:02'),(7,'Notificación de tarea aceptada a mantenedor','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n<style type=\"text/css\">\n  body, .mainTable { height:100% !important; width:100% !important; margin:0; padding:0; }\n  img, a img { border:0; outline:none; text-decoration:none; }\n  .imageFix { display:block; }\n  table, td { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;}\n  p {margin:0; padding:0; margin-bottom:0;}\n  .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}\n  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}\n  img{-ms-interpolation-mode: bicubic;}\n  body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}\n</style><style>\ntable{ border-collapse: collapse; }\n@media only screen and (max-width: 600px) {\n    body[yahoo] .rimg {\n       max-width: 100%;\n       height: auto;\n    }\n    body[yahoo] .rtable{\n        width: 100% !important;\n        table-layout: fixed;\n    }\n}\n</style>\n\n<!--[if gte mso 9]>\n<xml>\n  <o:OfficeDocumentSettings>\n    <o:AllowPNG/>\n    <o:PixelsPerInch>96</o:PixelsPerInch>\n  </o:OfficeDocumentSettings>\n</xml>\n<![endif]-->\n</head>\n<body yahoo=fix scroll=\"auto\" style=\"padding:0; margin:0; FONT-SIZE: 12px; FONT-FAMILY: Arial, Helvetica, sans-serif; cursor:auto; background:#F3F3F3\">\n  \n<TABLE class=\"rtable mainTable\" cellSpacing=0 cellPadding=0 width=\"100%\" bgColor=#f3f3f3>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0\">&#160;</TD>\n  </TR>\n  <TR>\n    <TD vAlign=top>\n      <TABLE class=rtable style=\"WIDTH: 600px; MARGIN: 0px auto\" cellSpacing=0 cellPadding=0 width=600 align=center border=0>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #1d2127\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: middle; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 10px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <TABLE cellSpacing=0 cellPadding=0 align=center border=0>\n                    <TR>\n                      <TD style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=center>\n                        <TABLE cellSpacing=0 cellPadding=0 border=0>\n                          <TR>\n                            <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\">\n                              <img src=\"http://localhost/mantenedores/img/nodrizablanco.png\" vspace=\"0\" hspace=\"0\" border=\"0\" class=\"rimg\" style=\"MAX-WIDTH: 135px; BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block; BACKGROUND-COLOR: transparent\" alt=\"\"/>                            </TD>\n                          </TR>\n                        </TABLE>\n                      </TD>\n                    </TR>\n                  </TABLE>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: #dbdbdb 1px solid; BORDER-RIGHT: #dbdbdb 1px solid; BORDER-BOTTOM: #dbdbdb 1px solid; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: #dbdbdb 1px solid; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 20px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 35px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: #feffff\">\n                  <p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">\n                    ¡Hurra! Su tarea fue aceptada\n                  </p>\n                  <p style=\"FONT-SIZE: 14px; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">\n                    Estimado/a Cristian su tarea #1 fue revisada y <b>aceptada</b> por el administrador.\n                  </p>\n                  <p style=\"FONT-SIZE: 14px; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">\n                    Recuerde completar la información de su cuenta bancaria para realizar los pagos de sus tareas finalizadas.\n                  </p>\n                  <p style=\"FONT-SIZE: 14px; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">Para ver la tarea ingrese haciendo click en el siguiente link:</p>\n                  <a href=\"http://localhost/mantenedores/maintainers/tareas/view/1\" style=\"background-color:#771D97; font-size: 14px; font-family: arial, helvetica, sans-serif; color: #ffffff; padding: 5px 15px; text-decoration: none; margin-top: 10px; display: inline-block; text-align: center;\">Revisar la tarea</a>                  <BR>\n                  <BR>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Atte Equipo de mantenci&#243;n Nodriza Spa.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; PADDING-TOP: 1px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Por favor no conteste este email, ya que es generado autom&#225;ticamente por nuestro sistema.</P>\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>&#169;2017 Nodriza Spa.Todos los derechos reservados.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n      </TABLE>\n    </TD>\n  </TR>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0\">&#160;\n    </TD>\n  </TR>\n</TABLE>\n</body>\n</html>','[NDRZA] ¡Hurra! su tarea fue aceptada','cristian.rojas@nodriza.cl','Cristian','no-reply@nodriza.cl','Portal mantenedores - Nodriza Spa','','cristian.rojas@nodriza.cl',NULL,NULL,1,1,1,NULL,'2017-06-20 15:38:24','2017-06-20 15:39:01'),(8,'Notificación de tarea re abierta','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n<style type=\"text/css\">\n  body, .mainTable { height:100% !important; width:100% !important; margin:0; padding:0; }\n  img, a img { border:0; outline:none; text-decoration:none; }\n  .imageFix { display:block; }\n  table, td { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;}\n  p {margin:0; padding:0; margin-bottom:0;}\n  .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}\n  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}\n  img{-ms-interpolation-mode: bicubic;}\n  body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}\n</style><style>\ntable{ border-collapse: collapse; }\n@media only screen and (max-width: 600px) {\n    body[yahoo] .rimg {\n       max-width: 100%;\n       height: auto;\n    }\n    body[yahoo] .rtable{\n        width: 100% !important;\n        table-layout: fixed;\n    }\n}\n</style>\n\n<!--[if gte mso 9]>\n<xml>\n  <o:OfficeDocumentSettings>\n    <o:AllowPNG/>\n    <o:PixelsPerInch>96</o:PixelsPerInch>\n  </o:OfficeDocumentSettings>\n</xml>\n<![endif]-->\n</head>\n<body yahoo=fix scroll=\"auto\" style=\"padding:0; margin:0; FONT-SIZE: 12px; FONT-FAMILY: Arial, Helvetica, sans-serif; cursor:auto; background:#F3F3F3\">\n  \n<TABLE class=\"rtable mainTable\" cellSpacing=0 cellPadding=0 width=\"100%\" bgColor=#f3f3f3>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0\">&#160;</TD>\n  </TR>\n  <TR>\n    <TD vAlign=top>\n      <TABLE class=rtable style=\"WIDTH: 600px; MARGIN: 0px auto\" cellSpacing=0 cellPadding=0 width=600 align=center border=0>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #1d2127\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: middle; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 10px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <TABLE cellSpacing=0 cellPadding=0 align=center border=0>\n                    <TR>\n                      <TD style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=center>\n                        <TABLE cellSpacing=0 cellPadding=0 border=0>\n                          <TR>\n                            <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\">\n                              <img src=\"http://localhost/mantenedores/img/nodrizablanco.png\" vspace=\"0\" hspace=\"0\" border=\"0\" class=\"rimg\" style=\"MAX-WIDTH: 135px; BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block; BACKGROUND-COLOR: transparent\" alt=\"\"/>                            </TD>\n                          </TR>\n                        </TABLE>\n                      </TD>\n                    </TR>\n                  </TABLE>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: #dbdbdb 1px solid; BORDER-RIGHT: #dbdbdb 1px solid; BORDER-BOTTOM: #dbdbdb 1px solid; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: #dbdbdb 1px solid; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 20px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; TEXT-ALIGN: center; PADDING-TOP: 35px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: #feffff\">\n                  <P style=\"FONT-SIZE: 16px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>\n                    Estimado/a Cristian<br>\n                    <STRONG>La tarea identificador #1, nombre [TEST] Tarea 10, ha sido abierta nuevamente.</STRONG>\n                  </P>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>\n                  Sí tiene dudas, revise los comentarios e la tarea o contácte con el administrador.\n                  <BR>\n                  <BR>Para comenzar a trabajar ingrese al portal haciendo click en el siguiente link:\n                  <BR>\n                  <a href=\"http://localhost/mantenedores/maintainers/tareas/work/1\" style=\"background-color:#771D97; font-size: 14px; font-family: arial, helvetica, sans-serif; color: #ffffff; padding: 5px 15px; text-decoration: none; margin-top: 15px; display: inline-block; text-align: center;\">Ingresar a la tarea</a>                  <BR>\n                  <BR>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Atte Equipo de mantenci&#243;n Nodriza Spa.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; PADDING-TOP: 1px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Por favor no conteste este email, ya que es generado autom&#225;ticamente por nuestro sistema.</P>\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>&#169;2017 Nodriza Spa.Todos los derechos reservados.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n      </TABLE>\n    </TD>\n  </TR>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0\">&#160;\n    </TD>\n  </TR>\n</TABLE>\n</body>\n</html>','[NDRZA] La tarea 1 ha sido re abierta','cristian.rojas@nodriza.cl','Cristian','no-reply@nodriza.cl','Portal mantenedores - Nodriza Spa','','cristian.rojas@nodriza.cl',NULL,NULL,1,1,1,NULL,'2017-06-20 15:54:03','2017-06-20 15:55:01'),(9,'Notificación de inicio tarea a administrador','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n<style type=\"text/css\">\n  body, .mainTable { height:100% !important; width:100% !important; margin:0; padding:0; }\n  img, a img { border:0; outline:none; text-decoration:none; }\n  .imageFix { display:block; }\n  table, td { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;}\n  p {margin:0; padding:0; margin-bottom:0;}\n  .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}\n  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}\n  img{-ms-interpolation-mode: bicubic;}\n  body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}\n</style><style>\ntable{ border-collapse: collapse; }\n@media only screen and (max-width: 600px) {\n    body[yahoo] .rimg {\n       max-width: 100%;\n       height: auto;\n    }\n    body[yahoo] .rtable{\n        width: 100% !important;\n        table-layout: fixed;\n    }\n}\n</style>\n\n<!--[if gte mso 9]>\n<xml>\n  <o:OfficeDocumentSettings>\n    <o:AllowPNG/>\n    <o:PixelsPerInch>96</o:PixelsPerInch>\n  </o:OfficeDocumentSettings>\n</xml>\n<![endif]-->\n</head>\n<body yahoo=fix scroll=\"auto\" style=\"padding:0; margin:0; FONT-SIZE: 12px; FONT-FAMILY: Arial, Helvetica, sans-serif; cursor:auto; background:#F3F3F3\">\n  \n<TABLE class=\"rtable mainTable\" cellSpacing=0 cellPadding=0 width=\"100%\" bgColor=#f3f3f3>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0\">&#160;</TD>\n  </TR>\n  <TR>\n    <TD vAlign=top>\n      <TABLE class=rtable style=\"WIDTH: 600px; MARGIN: 0px auto\" cellSpacing=0 cellPadding=0 width=600 align=center border=0>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #1d2127\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: middle; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 10px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <TABLE cellSpacing=0 cellPadding=0 align=center border=0>\n                    <TR>\n                      <TD style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=center>\n                        <TABLE cellSpacing=0 cellPadding=0 border=0>\n                          <TR>\n                            <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\">\n                              <img src=\"http://localhost/mantenedores/img/nodrizablanco.png\" vspace=\"0\" hspace=\"0\" border=\"0\" class=\"rimg\" style=\"MAX-WIDTH: 135px; BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block; BACKGROUND-COLOR: transparent\" alt=\"\"/>                            </TD>\n                          </TR>\n                        </TABLE>\n                      </TD>\n                    </TR>\n                  </TABLE>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: #dbdbdb 1px solid; BORDER-RIGHT: #dbdbdb 1px solid; BORDER-BOTTOM: #dbdbdb 1px solid; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: #dbdbdb 1px solid; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 20px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 35px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: #feffff\">\n                  <p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">\n                    Estimado/a Desarrollo Nodriza Spa                  </p>\n                  <p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">\n                    El mantenedor encargado de la tarea identificador #1 la ha iniciado el 20 de 06 del 2017  a las 15:54:56.\n                  </p>\n                  <BR>\n                  <BR>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Atte Equipo de mantenci&#243;n Nodriza Spa.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; PADDING-TOP: 1px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Por favor no conteste este email, ya que es generado autom&#225;ticamente por nuestro sistema.</P>\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>&#169;2017 Nodriza Spa.Todos los derechos reservados.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n      </TABLE>\n    </TD>\n  </TR>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0\">&#160;\n    </TD>\n  </TR>\n</TABLE>\n</body>\n</html>','[NDRZA] El mantenedor ha iniciado una tarea','desarrollo@nodriza.cl','Desarrollo Nodriza Spa','no-reply@nodriza.cl','Portal mantenedores - Nodriza Spa','','cristian.rojas@nodriza.cl',NULL,NULL,1,1,1,NULL,'2017-06-20 15:55:01','2017-06-20 15:56:01'),(10,'Notificación de revision tarea a administrador','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n<style type=\"text/css\">\n  body, .mainTable { height:100% !important; width:100% !important; margin:0; padding:0; }\n  img, a img { border:0; outline:none; text-decoration:none; }\n  .imageFix { display:block; }\n  table, td { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;}\n  p {margin:0; padding:0; margin-bottom:0;}\n  .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}\n  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}\n  img{-ms-interpolation-mode: bicubic;}\n  body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}\n</style><style>\ntable{ border-collapse: collapse; }\n@media only screen and (max-width: 600px) {\n    body[yahoo] .rimg {\n       max-width: 100%;\n       height: auto;\n    }\n    body[yahoo] .rtable{\n        width: 100% !important;\n        table-layout: fixed;\n    }\n}\n</style>\n\n<!--[if gte mso 9]>\n<xml>\n  <o:OfficeDocumentSettings>\n    <o:AllowPNG/>\n    <o:PixelsPerInch>96</o:PixelsPerInch>\n  </o:OfficeDocumentSettings>\n</xml>\n<![endif]-->\n</head>\n<body yahoo=fix scroll=\"auto\" style=\"padding:0; margin:0; FONT-SIZE: 12px; FONT-FAMILY: Arial, Helvetica, sans-serif; cursor:auto; background:#F3F3F3\">\n  \n<TABLE class=\"rtable mainTable\" cellSpacing=0 cellPadding=0 width=\"100%\" bgColor=#f3f3f3>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0\">&#160;</TD>\n  </TR>\n  <TR>\n    <TD vAlign=top>\n      <TABLE class=rtable style=\"WIDTH: 600px; MARGIN: 0px auto\" cellSpacing=0 cellPadding=0 width=600 align=center border=0>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #1d2127\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: middle; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 10px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <TABLE cellSpacing=0 cellPadding=0 align=center border=0>\n                    <TR>\n                      <TD style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=center>\n                        <TABLE cellSpacing=0 cellPadding=0 border=0>\n                          <TR>\n                            <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\">\n                              <img src=\"http://localhost/mantenedores/img/nodrizablanco.png\" vspace=\"0\" hspace=\"0\" border=\"0\" class=\"rimg\" style=\"MAX-WIDTH: 135px; BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block; BACKGROUND-COLOR: transparent\" alt=\"\"/>                            </TD>\n                          </TR>\n                        </TABLE>\n                      </TD>\n                    </TR>\n                  </TABLE>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: #dbdbdb 1px solid; BORDER-RIGHT: #dbdbdb 1px solid; BORDER-BOTTOM: #dbdbdb 1px solid; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: #dbdbdb 1px solid; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 20px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 35px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: #feffff\">\n                  <p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">\n                    Estimado/a Desarrollo Nodriza Spa                  </p>\n                  <p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">\n                    Tiene una nueva tarea para revisar.\n                    El mantenedor cristian.rojas@nodriza.cl ha enviado a revisión una tarea. Recuerde revisar uno a uno todos los productos cargados y verificar que la configuración se haya respetado a cabalidad.\n                  </p>\n                  <p style=\"FONT-SIZE: 14px; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">Para ver la tarea ingrese haciendo click en el siguiente link:</p>\n                  <a href=\"http://localhost/mantenedores/admin/tareas/edit/1\" style=\"background-color:#771D97; font-size: 14px; font-family: arial, helvetica, sans-serif; color: #ffffff; padding: 5px 15px; text-decoration: none; margin-top: 15px; display: inline-block; text-align: center;\">Revisar la tarea</a>                  <BR>\n                  <BR>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Atte Equipo de mantenci&#243;n Nodriza Spa.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; PADDING-TOP: 1px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Por favor no conteste este email, ya que es generado autom&#225;ticamente por nuestro sistema.</P>\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>&#169;2017 Nodriza Spa.Todos los derechos reservados.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n      </TABLE>\n    </TD>\n  </TR>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0\">&#160;\n    </TD>\n  </TR>\n</TABLE>\n</body>\n</html>','[NDRZA] Nueva tarea para revisión','desarrollo@nodriza.cl','Desarrollo Nodriza Spa','no-reply@nodriza.cl','Portal mantenedores - Nodriza Spa','','cristian.rojas@nodriza.cl',NULL,NULL,1,1,1,NULL,'2017-06-20 16:07:11','2017-06-20 16:08:01'),(11,'Notificación de tarea aceptada a mantenedor','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n<style type=\"text/css\">\n  body, .mainTable { height:100% !important; width:100% !important; margin:0; padding:0; }\n  img, a img { border:0; outline:none; text-decoration:none; }\n  .imageFix { display:block; }\n  table, td { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;}\n  p {margin:0; padding:0; margin-bottom:0;}\n  .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}\n  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}\n  img{-ms-interpolation-mode: bicubic;}\n  body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}\n</style><style>\ntable{ border-collapse: collapse; }\n@media only screen and (max-width: 600px) {\n    body[yahoo] .rimg {\n       max-width: 100%;\n       height: auto;\n    }\n    body[yahoo] .rtable{\n        width: 100% !important;\n        table-layout: fixed;\n    }\n}\n</style>\n\n<!--[if gte mso 9]>\n<xml>\n  <o:OfficeDocumentSettings>\n    <o:AllowPNG/>\n    <o:PixelsPerInch>96</o:PixelsPerInch>\n  </o:OfficeDocumentSettings>\n</xml>\n<![endif]-->\n</head>\n<body yahoo=fix scroll=\"auto\" style=\"padding:0; margin:0; FONT-SIZE: 12px; FONT-FAMILY: Arial, Helvetica, sans-serif; cursor:auto; background:#F3F3F3\">\n  \n<TABLE class=\"rtable mainTable\" cellSpacing=0 cellPadding=0 width=\"100%\" bgColor=#f3f3f3>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0\">&#160;</TD>\n  </TR>\n  <TR>\n    <TD vAlign=top>\n      <TABLE class=rtable style=\"WIDTH: 600px; MARGIN: 0px auto\" cellSpacing=0 cellPadding=0 width=600 align=center border=0>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #1d2127\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: middle; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 10px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <TABLE cellSpacing=0 cellPadding=0 align=center border=0>\n                    <TR>\n                      <TD style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=center>\n                        <TABLE cellSpacing=0 cellPadding=0 border=0>\n                          <TR>\n                            <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\">\n                              <img src=\"http://localhost/mantenedores/img/nodrizablanco.png\" vspace=\"0\" hspace=\"0\" border=\"0\" class=\"rimg\" style=\"MAX-WIDTH: 135px; BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block; BACKGROUND-COLOR: transparent\" alt=\"\"/>                            </TD>\n                          </TR>\n                        </TABLE>\n                      </TD>\n                    </TR>\n                  </TABLE>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: #dbdbdb 1px solid; BORDER-RIGHT: #dbdbdb 1px solid; BORDER-BOTTOM: #dbdbdb 1px solid; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: #dbdbdb 1px solid; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 20px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 35px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: #feffff\">\n                  <p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">\n                    ¡Hurra! Su tarea fue aceptada\n                  </p>\n                  <p style=\"FONT-SIZE: 14px; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">\n                    Estimado/a Cristian su tarea #1 fue revisada y <b>aceptada</b> por el administrador.\n                  </p>\n                  <p style=\"FONT-SIZE: 14px; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">\n                    Recuerde completar la información de su cuenta bancaria para realizar los pagos de sus tareas finalizadas.\n                  </p>\n                  <p style=\"FONT-SIZE: 14px; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">Para ver la tarea ingrese haciendo click en el siguiente link:</p>\n                  <a href=\"http://localhost/mantenedores/maintainers/tareas/view/1\" style=\"background-color:#771D97; font-size: 14px; font-family: arial, helvetica, sans-serif; color: #ffffff; padding: 5px 15px; text-decoration: none; margin-top: 10px; display: inline-block; text-align: center;\">Revisar la tarea</a>                  <BR>\n                  <BR>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Atte Equipo de mantenci&#243;n Nodriza Spa.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; PADDING-TOP: 1px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Por favor no conteste este email, ya que es generado autom&#225;ticamente por nuestro sistema.</P>\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>&#169;2017 Nodriza Spa.Todos los derechos reservados.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n      </TABLE>\n    </TD>\n  </TR>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0\">&#160;\n    </TD>\n  </TR>\n</TABLE>\n</body>\n</html>','[NDRZA] ¡Hurra! su tarea fue aceptada','cristian.rojas@nodriza.cl','Cristian','no-reply@nodriza.cl','Portal mantenedores - Nodriza Spa','','cristian.rojas@nodriza.cl',NULL,NULL,1,1,1,NULL,'2017-06-20 16:10:57','2017-06-20 16:11:02'),(12,'Notificación de tarea asignada','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n<style type=\"text/css\">\n  body, .mainTable { height:100% !important; width:100% !important; margin:0; padding:0; }\n  img, a img { border:0; outline:none; text-decoration:none; }\n  .imageFix { display:block; }\n  table, td { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;}\n  p {margin:0; padding:0; margin-bottom:0;}\n  .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}\n  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}\n  img{-ms-interpolation-mode: bicubic;}\n  body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}\n</style><style>\ntable{ border-collapse: collapse; }\n@media only screen and (max-width: 600px) {\n    body[yahoo] .rimg {\n       max-width: 100%;\n       height: auto;\n    }\n    body[yahoo] .rtable{\n        width: 100% !important;\n        table-layout: fixed;\n    }\n}\n</style>\n\n<!--[if gte mso 9]>\n<xml>\n  <o:OfficeDocumentSettings>\n    <o:AllowPNG/>\n    <o:PixelsPerInch>96</o:PixelsPerInch>\n  </o:OfficeDocumentSettings>\n</xml>\n<![endif]-->\n</head>\n<body yahoo=fix scroll=\"auto\" style=\"padding:0; margin:0; FONT-SIZE: 12px; FONT-FAMILY: Arial, Helvetica, sans-serif; cursor:auto; background:#F3F3F3\">\n  \n<TABLE class=\"rtable mainTable\" cellSpacing=0 cellPadding=0 width=\"100%\" bgColor=#f3f3f3>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0\">&#160;</TD>\n  </TR>\n  <TR>\n    <TD vAlign=top>\n      <TABLE class=rtable style=\"WIDTH: 600px; MARGIN: 0px auto\" cellSpacing=0 cellPadding=0 width=600 align=center border=0>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #1d2127\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: middle; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 10px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <TABLE cellSpacing=0 cellPadding=0 align=center border=0>\n                    <TR>\n                      <TD style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=center>\n                        <TABLE cellSpacing=0 cellPadding=0 border=0>\n                          <TR>\n                            <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\">\n                              <img src=\"http://mantenedores.nodriza.cl/img/nodrizablanco.png\" vspace=\"0\" hspace=\"0\" border=\"0\" class=\"rimg\" style=\"MAX-WIDTH: 135px; BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block; BACKGROUND-COLOR: transparent\" alt=\"\"/>                            </TD>\n                          </TR>\n                        </TABLE>\n                      </TD>\n                    </TR>\n                  </TABLE>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: #dbdbdb 1px solid; BORDER-RIGHT: #dbdbdb 1px solid; BORDER-BOTTOM: #dbdbdb 1px solid; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: #dbdbdb 1px solid; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 20px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; TEXT-ALIGN: center; PADDING-TOP: 35px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: #feffff\">\n                  <P style=\"FONT-SIZE: 18px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>\n                    <STRONG>La tarea identificador #666, nombre [TEST] FInal ha sido asiganda a usted.</STRONG>\n                  </P>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>\n                  Sí no desea trabajar en la tarea, notifique al administrador comentandola. \n                  <BR>\n                  <BR>Para comenzar a trabajar ingrese al portal haciendo click en el siguiente link:\n                  <BR>\n                  <a href=\"http://mantenedores.nodriza.cl/maintainers/login\" style=\"background-color:#771D97; font-size: 14px; font-family: arial, helvetica, sans-serif; color: #ffffff; padding: 5px 15px; text-decoration: none; margin-top: 15px; display: inline-block; text-align: center;\">Ingreso al portal</a>                  <BR>\n                  <BR>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Atte Equipo de mantenci&#243;n Nodriza Spa.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; PADDING-TOP: 1px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Por favor no conteste este email, ya que es generado autom&#225;ticamente por nuestro sistema.</P>\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>&#169;2017 Nodriza Spa.Todos los derechos reservados.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n      </TABLE>\n    </TD>\n  </TR>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0\">&#160;\n    </TD>\n  </TR>\n</TABLE>\n</body>\n</html>','[NDRZA] ¡Se le ha asignado una tarea!','cristian.rojas@nodriza.cl','Cristian','no-reply@nodriza.cl','Portal mantenedores - Nodriza Spa','','cristian.rojas@nodriza.cl',NULL,NULL,1,1,1,NULL,'2017-06-22 10:03:23','2017-06-22 10:04:01'),(13,'Notificación de inicio tarea a administrador','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n<style type=\"text/css\">\n  body, .mainTable { height:100% !important; width:100% !important; margin:0; padding:0; }\n  img, a img { border:0; outline:none; text-decoration:none; }\n  .imageFix { display:block; }\n  table, td { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;}\n  p {margin:0; padding:0; margin-bottom:0;}\n  .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}\n  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}\n  img{-ms-interpolation-mode: bicubic;}\n  body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}\n</style><style>\ntable{ border-collapse: collapse; }\n@media only screen and (max-width: 600px) {\n    body[yahoo] .rimg {\n       max-width: 100%;\n       height: auto;\n    }\n    body[yahoo] .rtable{\n        width: 100% !important;\n        table-layout: fixed;\n    }\n}\n</style>\n\n<!--[if gte mso 9]>\n<xml>\n  <o:OfficeDocumentSettings>\n    <o:AllowPNG/>\n    <o:PixelsPerInch>96</o:PixelsPerInch>\n  </o:OfficeDocumentSettings>\n</xml>\n<![endif]-->\n</head>\n<body yahoo=fix scroll=\"auto\" style=\"padding:0; margin:0; FONT-SIZE: 12px; FONT-FAMILY: Arial, Helvetica, sans-serif; cursor:auto; background:#F3F3F3\">\n  \n<TABLE class=\"rtable mainTable\" cellSpacing=0 cellPadding=0 width=\"100%\" bgColor=#f3f3f3>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0\">&#160;</TD>\n  </TR>\n  <TR>\n    <TD vAlign=top>\n      <TABLE class=rtable style=\"WIDTH: 600px; MARGIN: 0px auto\" cellSpacing=0 cellPadding=0 width=600 align=center border=0>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #1d2127\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: middle; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 10px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <TABLE cellSpacing=0 cellPadding=0 align=center border=0>\n                    <TR>\n                      <TD style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=center>\n                        <TABLE cellSpacing=0 cellPadding=0 border=0>\n                          <TR>\n                            <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\">\n                              <img src=\"http://mantenedores.nodriza.cl/img/nodrizablanco.png\" vspace=\"0\" hspace=\"0\" border=\"0\" class=\"rimg\" style=\"MAX-WIDTH: 135px; BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block; BACKGROUND-COLOR: transparent\" alt=\"\"/>                            </TD>\n                          </TR>\n                        </TABLE>\n                      </TD>\n                    </TR>\n                  </TABLE>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: #dbdbdb 1px solid; BORDER-RIGHT: #dbdbdb 1px solid; BORDER-BOTTOM: #dbdbdb 1px solid; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: #dbdbdb 1px solid; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 20px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 35px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: #feffff\">\n                  <p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">\n                    Estimado/a Cristian                   </p>\n                  <p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a8a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">\n                    El mantenedor encargado de la tarea identificador #666 la ha iniciado el 22 de 06 del 2017  a las 10:04:20.\n                  </p>\n                  <BR>\n                  <BR>\n                  <P style=\"FONT-SIZE: 12px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #a7a7a7; LINE-HEIGHT: 155%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Atte Equipo de mantenci&#243;n Nodriza Spa.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n        <TR>\n          <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; PADDING-TOP: 1px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent\">\n            <TABLE class=rtable style=\"WIDTH: 100%\" cellSpacing=0 cellPadding=0 align=left>\n              <TR style=\"HEIGHT: 10px\">\n                <TD style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 100%; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 1px; TEXT-ALIGN: center; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>Por favor no conteste este email, ya que es generado autom&#225;ticamente por nuestro sistema.</P>\n                  <P style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: Arial, Helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 125%; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=left>&#169;2017 Nodriza Spa.Todos los derechos reservados.</P>\n                </TD>\n              </TR>\n            </TABLE>\n          </TD>\n        </TR>\n      </TABLE>\n    </TD>\n  </TR>\n  <TR>\n    <TD style=\"FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0\">&#160;\n    </TD>\n  </TR>\n</TABLE>\n</body>\n</html>','[NDRZA] El mantenedor ha iniciado una tarea','cristian.rojas@nodriza.cl','Cristian ','no-reply@nodriza.cl','Portal mantenedores - Nodriza Spa','','cristian.rojas@nodriza.cl',NULL,NULL,1,1,1,NULL,'2017-06-22 10:04:20','2017-06-22 10:05:01');

UNLOCK TABLES;

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

/*Data for the table `crp_cuentas` */

LOCK TABLES `crp_cuentas` WRITE;

insert  into `crp_cuentas`(`id`,`usuario_id`,`banco_id`,`tipo_cuenta_id`,`otro`,`cuenta`,`principal`,`created`,`modified`) values (1,1,1,1,'','66064476',1,'2017-06-15 17:10:20','2017-06-15 17:59:26'),(2,2,1,1,'','12233221',1,'2017-06-19 10:10:24','2017-06-19 16:46:08');

UNLOCK TABLES;

/*Table structure for table `crp_especificaciones_productos` */

DROP TABLE IF EXISTS `crp_especificaciones_productos`;

CREATE TABLE `crp_especificaciones_productos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_feature` bigint(20) DEFAULT NULL,
  `producto_id` bigint(20) DEFAULT NULL,
  `valor` varchar(150) DEFAULT NULL,
  `llave_valor` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `crp_especificaciones_productos` */

LOCK TABLES `crp_especificaciones_productos` WRITE;

insert  into `crp_especificaciones_productos`(`id`,`id_feature`,`producto_id`,`valor`,`llave_valor`) values (3,150,1,'12222',NULL),(4,1800,1,'12x12x12',NULL),(5,1626,2,'Bla',NULL),(6,1590,2,'Bla 2',NULL),(7,1306,2,'Bla 3',NULL),(8,280,2,'Bla 4',NULL),(9,22,2,'Bla 5',NULL),(10,20,2,'Bla 6',NULL),(11,17,2,'Bla 7',NULL);

UNLOCK TABLES;

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `crp_grupocaracteristicas` */

LOCK TABLES `crp_grupocaracteristicas` WRITE;

insert  into `crp_grupocaracteristicas`(`id`,`tienda_id`,`nombre`,`desripcion`,`count_caracteristicas`,`count_categorias`,`count_palabras_claves`,`activo`,`created`,`modified`) values (1,1,'Taladro Rotación','Taladro Rotación reversible',10,1,0,1,'2017-06-19 13:51:50','2017-06-19 17:57:55'),(2,1,'Taladro Percutor','Taladro Percutor',10,1,NULL,1,'2017-06-20 11:35:10','2017-06-22 10:30:41'),(3,1,'Taladro Atornillador con Batería','Taladro Atornillador con Batería',10,1,0,1,'2017-06-20 11:41:12','2017-06-20 12:17:57'),(4,1,'Taladro Atornillador Percutor con Batería','Taladro Atornillador Percutor con Batería',10,1,0,1,'2017-06-20 11:53:11','2017-06-20 12:18:25'),(5,1,'Taladro Atornillador sin Batería','Taladro Atornillador sin Batería',10,1,0,1,'2017-06-20 12:14:27','2017-06-20 12:48:04'),(9,1,'Atornillador de Impacto ','Atornillador de Impacto',6,1,0,1,'2017-06-22 10:37:24','2017-06-22 11:04:03'),(8,1,'Taladro Atornillador Percutor sin Batería','Taladro Atornillador Percutor sin Batería',10,1,0,1,'2017-06-20 13:27:31','2017-06-22 10:16:33'),(10,1,'Atornillador de Impacto con Batería','Atornillador de Impacto con Batería',7,1,NULL,1,'2017-06-22 11:27:27','2017-06-22 11:27:27');

UNLOCK TABLES;

/*Table structure for table `crp_grupocaracteristicas_categorias` */

DROP TABLE IF EXISTS `crp_grupocaracteristicas_categorias`;

CREATE TABLE `crp_grupocaracteristicas_categorias` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `grupocaracteristica_id` bigint(20) NOT NULL,
  `id_category` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Data for the table `crp_grupocaracteristicas_categorias` */

LOCK TABLES `crp_grupocaracteristicas_categorias` WRITE;

insert  into `crp_grupocaracteristicas_categorias`(`id`,`grupocaracteristica_id`,`id_category`) values (1,1,250),(24,2,250),(12,4,270),(11,3,270),(14,5,285),(25,9,251),(22,8,285),(26,10,271);

UNLOCK TABLES;

/*Table structure for table `crp_grupocaracteristicas_especificaciones` */

DROP TABLE IF EXISTS `crp_grupocaracteristicas_especificaciones`;

CREATE TABLE `crp_grupocaracteristicas_especificaciones` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `grupocaracteristica_id` bigint(20) NOT NULL,
  `id_feature` bigint(20) NOT NULL,
  `unidad_medida_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=319 DEFAULT CHARSET=utf8;

/*Data for the table `crp_grupocaracteristicas_especificaciones` */

LOCK TABLES `crp_grupocaracteristicas_especificaciones` WRITE;

insert  into `crp_grupocaracteristicas_especificaciones`(`id`,`grupocaracteristica_id`,`id_feature`,`unidad_medida_id`) values (21,1,1852,NULL),(20,1,1851,NULL),(19,1,1850,NULL),(18,1,1626,NULL),(17,1,1590,NULL),(16,1,1306,NULL),(15,1,280,NULL),(14,1,22,NULL),(13,1,20,NULL),(12,1,17,NULL),(290,2,17,2),(291,2,20,6),(292,2,22,7),(293,2,280,1),(294,2,1306,NULL),(295,2,1590,1),(296,2,1626,1),(297,2,1850,4),(298,2,1851,1),(299,2,1852,1),(171,3,1852,NULL),(170,3,1851,NULL),(169,3,1849,NULL),(168,3,1848,NULL),(167,3,1626,NULL),(166,3,1306,NULL),(165,3,280,NULL),(164,3,67,NULL),(163,3,22,NULL),(162,3,20,NULL),(172,4,20,NULL),(173,4,22,NULL),(174,4,67,NULL),(175,4,280,NULL),(176,4,1306,NULL),(177,4,1626,NULL),(178,4,1848,NULL),(179,4,1849,NULL),(180,4,1851,NULL),(181,4,1852,NULL),(221,5,1852,NULL),(220,5,1851,NULL),(219,5,1849,NULL),(218,5,1848,NULL),(217,5,1626,NULL),(216,5,1306,NULL),(215,5,280,NULL),(214,5,67,NULL),(213,5,22,NULL),(212,5,20,NULL),(270,8,20,6),(310,9,70,13),(271,8,22,7),(272,8,67,5),(273,8,280,1),(274,8,1306,NULL),(275,8,1626,1),(276,8,1848,8),(277,8,1849,9),(278,8,1851,1),(279,8,1852,1),(311,9,152,3),(309,9,67,5),(308,9,22,7),(307,9,20,6),(306,9,17,2),(312,10,1848,8),(313,10,1849,9),(314,10,152,3),(315,10,20,6),(316,10,67,5),(317,10,70,13),(318,10,22,7);

UNLOCK TABLES;

/*Table structure for table `crp_grupocaracteristicas_palabraclaves` */

DROP TABLE IF EXISTS `crp_grupocaracteristicas_palabraclaves`;

CREATE TABLE `crp_grupocaracteristicas_palabraclaves` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `grupocaracteristica_id` bigint(20) NOT NULL,
  `palabraclave_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

/*Data for the table `crp_grupocaracteristicas_palabraclaves` */

LOCK TABLES `crp_grupocaracteristicas_palabraclaves` WRITE;

insert  into `crp_grupocaracteristicas_palabraclaves`(`id`,`grupocaracteristica_id`,`palabraclave_id`) values (1,1,1),(2,1,4),(3,1,5),(77,2,5),(78,2,3),(79,2,1),(40,4,3),(41,4,7),(42,4,2),(43,4,1),(44,4,14),(37,3,14),(36,3,6),(35,3,2),(34,3,1),(39,4,6),(38,3,16),(45,4,16),(46,5,1),(47,5,2),(48,5,6),(49,5,14),(50,5,15),(80,9,17),(68,8,15),(69,8,14),(70,8,6),(71,8,7),(72,8,2),(73,8,1),(81,9,19),(82,9,20),(83,9,21),(84,10,17),(85,10,19),(86,10,20),(87,10,22);

UNLOCK TABLES;

/*Table structure for table `crp_grupocaracteristicas_tareas` */

DROP TABLE IF EXISTS `crp_grupocaracteristicas_tareas`;

CREATE TABLE `crp_grupocaracteristicas_tareas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `grupocaracteristica_id` bigint(20) NOT NULL,
  `tarea_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `crp_grupocaracteristicas_tareas` */

LOCK TABLES `crp_grupocaracteristicas_tareas` WRITE;

insert  into `crp_grupocaracteristicas_tareas`(`id`,`grupocaracteristica_id`,`tarea_id`) values (2,1,1),(4,5,666);

UNLOCK TABLES;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `crp_imagenes` */

LOCK TABLES `crp_imagenes` WRITE;

UNLOCK TABLES;

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

/*Data for the table `crp_importancias` */

LOCK TABLES `crp_importancias` WRITE;

UNLOCK TABLES;

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

/*Data for the table `crp_marcas` */

LOCK TABLES `crp_marcas` WRITE;

insert  into `crp_marcas`(`id`,`tienda_id`,`nombre`,`activo`,`created`,`modified`) values (1,1,'Dremel',1,'2017-06-19 09:38:44','2017-06-19 16:39:13'),(2,1,'Black&Decker',1,'2017-06-19 09:39:08','2017-06-19 16:40:09'),(3,1,'Hyundai',1,'2017-06-19 09:39:34','2017-06-19 09:39:34'),(4,1,'ATG',1,'2017-06-19 09:39:44','2017-06-19 09:39:44'),(5,1,'Fein',1,'2017-06-19 09:39:53','2017-06-19 09:39:53'),(6,1,'Bosch',1,'2017-06-19 09:40:20','2017-06-19 09:40:20'),(7,1,'Hitachi',1,'2017-06-19 09:40:36','2017-06-19 09:40:36'),(8,1,'Stanley',1,'2017-06-19 09:41:31','2017-06-19 09:41:31'),(9,1,'Cardi',1,'2017-06-19 09:41:43','2017-06-19 09:41:43'),(10,1,'Jepson',1,'2017-06-19 09:41:55','2017-06-19 09:41:55'),(11,1,'Kothman',1,'2017-06-19 09:42:07','2017-06-19 09:42:07'),(12,1,'Heller',1,'2017-06-19 09:42:20','2017-06-19 09:42:20'),(13,1,'Makita MT',1,'2017-06-19 09:42:30','2017-06-19 09:42:30'),(14,1,'Famastil',1,'2017-06-19 09:42:39','2017-06-19 09:42:39'),(15,1,'Technoflex',1,'2017-06-19 09:42:48','2017-06-19 09:42:48'),(16,1,'Einhell',1,'2017-06-19 09:42:56','2017-06-19 09:42:56'),(17,1,'Metabo',1,'2017-06-19 09:43:07','2017-06-19 09:43:07'),(18,1,'Skil',1,'2017-06-19 09:43:25','2017-06-19 09:43:25'),(19,1,'Makita',1,'2017-06-19 09:43:34','2017-06-19 09:43:34'),(20,1,'DeWalt',1,'2017-06-19 09:43:41','2017-06-19 09:43:41'),(21,1,'KSTools',1,'2017-06-19 09:43:51','2017-06-19 09:43:51');

UNLOCK TABLES;

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

/*Data for the table `crp_modulos` */

LOCK TABLES `crp_modulos` WRITE;

insert  into `crp_modulos`(`id`,`parent_id`,`nombre`,`url`,`icono`,`orden`,`activo`,`created`,`modified`) values (1,NULL,'Accesos','','fa fa-unlock-alt',1,1,'2017-04-13 13:35:40','2017-04-13 13:35:40'),(2,1,'Administradores','administradores','fa fa-user',1,1,'2017-04-13 13:37:39','2017-04-13 13:37:39'),(3,1,'Módulos','modulos','fa fa-cubes',1,1,'2017-04-13 13:39:18','2017-04-13 13:39:18'),(4,1,'Roles de usuario','roles','fa fa-flag-checkered',3,1,'2017-04-13 13:40:13','2017-04-13 13:41:07'),(5,NULL,'Tiendas','tiendas','fa fa-shopping-cart',2,1,'2017-04-13 13:48:54','2017-06-16 11:04:11'),(6,NULL,'Preferencias','','fa fa-cogs',4,1,'2017-04-17 10:42:24','2017-06-16 11:04:25'),(7,6,'Códigos de paises','codigopaises','fa fa-book',1,1,'2017-04-17 10:43:07','2017-06-16 11:04:37'),(8,6,'Nivel de importancia','importancias','fa fa-exclamation-triangle',2,1,'2017-04-17 12:16:55','2017-04-17 12:16:55'),(9,NULL,'Tareas','','fa fa-pencil',1,1,'2017-04-17 16:22:05','2017-06-16 11:04:53'),(10,9,'Mis tareas','tareas','fa fa-pencil-square-o',1,1,'2017-04-17 16:22:54','2017-06-16 11:05:02'),(11,9,'Categorías','categoriatareas','fa fa-list-ol',2,0,'2017-04-17 16:23:35','2017-04-28 10:15:33'),(12,9,'Palabras Claves','palabraclaves','fa fa-key',3,1,'2017-04-18 13:23:51','2017-06-16 11:05:13'),(13,9,'Grupos de características','grupocaracteristicas','fa fa-folder',4,1,'2017-04-18 16:32:20','2017-06-16 11:05:32'),(14,NULL,'Mantenedores','usuarios','fa fa-user',4,1,'2017-04-18 16:48:34','2017-06-16 11:05:40'),(15,6,'Bancos','bancos','fa fa-university',3,1,'2017-04-26 17:45:23','2017-06-16 11:05:50'),(16,6,'Tipos de cuentas','tipoCuentas','fa fa-credit-card',4,1,'2017-04-26 17:46:49','2017-06-16 11:05:57'),(17,NULL,'Preguntas Frecuentes','preguntaFrecuentes','fa fa-question-circle',8,1,'2017-06-12 10:34:17','2017-06-16 11:06:05'),(18,9,'Marcas','marcas','fa fa-list',3,1,'2017-06-15 12:16:10','2017-06-16 11:06:13'),(19,9,'Unidades de medidas','unidadMedidas','fa fa-crop',4,1,'2017-06-20 10:59:27','2017-06-20 10:59:27');

UNLOCK TABLES;

/*Table structure for table `crp_modulos_roles` */

DROP TABLE IF EXISTS `crp_modulos_roles`;

CREATE TABLE `crp_modulos_roles` (
  `modulo_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`modulo_id`,`rol_id`),
  KEY `Relationship16` (`rol_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `crp_modulos_roles` */

LOCK TABLES `crp_modulos_roles` WRITE;

insert  into `crp_modulos_roles`(`modulo_id`,`rol_id`) values (1,1),(2,1),(3,1),(4,1),(5,1),(5,2),(6,1),(6,2),(7,1),(7,2),(8,1),(9,1),(9,2),(10,1),(10,2),(11,1),(12,1),(12,2),(13,1),(13,2),(14,1),(14,2),(15,1),(15,2),(16,1),(16,2),(17,1),(17,2),(18,1),(18,2),(19,1),(19,2);

UNLOCK TABLES;

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

/*Data for the table `crp_notificaciones` */

LOCK TABLES `crp_notificaciones` WRITE;

UNLOCK TABLES;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `crp_pagos` */

LOCK TABLES `crp_pagos` WRITE;

UNLOCK TABLES;

/*Table structure for table `crp_palabraclaves` */

DROP TABLE IF EXISTS `crp_palabraclaves`;

CREATE TABLE `crp_palabraclaves` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Data for the table `crp_palabraclaves` */

LOCK TABLES `crp_palabraclaves` WRITE;

insert  into `crp_palabraclaves`(`id`,`nombre`,`activo`,`created`,`modified`) values (1,'Taladro',1,'2017-06-19 13:29:32','2017-06-19 13:29:32'),(2,'Taladro Atornillador',1,'2017-06-19 13:32:25','2017-06-19 13:32:25'),(3,'Taladro Percutor',1,'2017-06-19 13:32:54','2017-06-19 13:32:54'),(4,'Taladro Rotación',1,'2017-06-19 13:35:40','2017-06-19 13:35:40'),(5,'Taladro Eléctrico',1,'2017-06-19 13:36:31','2017-06-19 13:36:31'),(6,'Taladro inalámbrico',1,'2017-06-19 13:36:56','2017-06-19 13:36:56'),(7,'Taladro Atornillador con Percutor',1,'2017-06-19 13:39:04','2017-06-19 13:39:04'),(8,'Taladro Angular',1,'2017-06-19 13:45:31','2017-06-19 13:45:31'),(9,'Taladro de Banco',1,'2017-06-19 13:45:52','2017-06-19 13:45:52'),(10,'Taladro Pedestal',1,'2017-06-19 13:46:05','2017-06-19 13:46:05'),(11,'Taladro Pedestal',0,'2017-06-19 13:47:00','2017-06-19 13:49:06'),(12,'Taladro Mezclador',1,'2017-06-19 13:49:01','2017-06-19 13:49:01'),(13,'Taladro Magnético',1,'2017-06-19 13:49:41','2017-06-19 13:49:41'),(14,'Taladro a Batería',1,'2017-06-20 11:40:15','2017-06-20 11:40:15'),(15,'Taladro sin Batería',1,'2017-06-20 12:16:14','2017-06-20 12:16:14'),(16,'Taladro con Batería',1,'2017-06-20 12:16:41','2017-06-20 12:16:41'),(17,'Atornillador de impacto',1,'2017-06-20 13:48:59','2017-06-20 13:48:59'),(18,'Atornillador Hexagonal',1,'2017-06-20 13:49:35','2017-06-20 13:49:35'),(19,'Atornillador de Impacto Hexagonal',1,'2017-06-20 13:49:55','2017-06-20 13:49:55'),(20,'Atornillador de Impacto 1/4\"',1,'2017-06-20 13:50:23','2017-06-20 13:50:23'),(21,'Atornillador de Impacto Eléctrico',1,'2017-06-22 10:36:05','2017-06-22 10:36:05'),(22,'Atornillador de Impacto Inalámbrico',1,'2017-06-22 10:36:26','2017-06-22 10:36:26'),(23,'Atornillador de impacto a batería',1,'2017-06-22 11:28:51','2017-06-22 11:28:51'),(24,'Atornillador de impacto a batería',0,'2017-06-22 11:29:21','2017-06-22 11:29:31'),(25,'Atornillador de Impacto con batería',1,'2017-06-22 11:30:19','2017-06-22 11:30:19'),(26,'Atornillador de impacto sin batería',1,'2017-06-22 11:31:48','2017-06-22 11:31:48');

UNLOCK TABLES;

/*Table structure for table `crp_palabraclaves_productos` */

DROP TABLE IF EXISTS `crp_palabraclaves_productos`;

CREATE TABLE `crp_palabraclaves_productos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) NOT NULL,
  `palabraclave_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `crp_palabraclaves_productos` */

LOCK TABLES `crp_palabraclaves_productos` WRITE;

UNLOCK TABLES;

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

/*Data for the table `crp_palabraclaves_tareas` */

LOCK TABLES `crp_palabraclaves_tareas` WRITE;

UNLOCK TABLES;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `crp_pregunta_frecuentes` */

LOCK TABLES `crp_pregunta_frecuentes` WRITE;

UNLOCK TABLES;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `crp_productos` */

LOCK TABLES `crp_productos` WRITE;

UNLOCK TABLES;

/*Table structure for table `crp_productos_caracteristicas` */

DROP TABLE IF EXISTS `crp_productos_caracteristicas`;

CREATE TABLE `crp_productos_caracteristicas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) unsigned NOT NULL,
  `id_feature` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `crp_productos_caracteristicas` */

LOCK TABLES `crp_productos_caracteristicas` WRITE;

UNLOCK TABLES;

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

/*Data for the table `crp_roles` */

LOCK TABLES `crp_roles` WRITE;

insert  into `crp_roles`(`id`,`nombre`,`permisos`,`activo`,`created`,`modified`) values (1,'Super usuario','{\r\n	\"adjuntos\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"administradores\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"calificaciones\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"categoriatareas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"comentarios\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"grupocaracteristicas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"imagenes\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"importancias\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"modulos\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"modulos_roles\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"notificaciones\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"pagos\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"palabraclaves\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"palabraclaves_productos\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"palabraclaves_tareas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"pregunta_frecuentes\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"productos\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"productos_caracteristicas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"roles\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"tareas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"tareas_usuarios\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"tiendas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"usuarios\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"codigopaises\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"bancos\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"tipoCuentas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"configuraciones\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"preguntaFrecuentes\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"marcas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"unidadMedidas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	}\r\n}',1,'2017-04-13 00:00:00','2017-06-20 11:00:20'),(2,'Administrador','{\r\n	\"adjuntos\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"calificaciones\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"categoriatareas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"comentarios\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"grupocaracteristicas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"imagenes\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"notificaciones\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"pagos\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 0, \"activar\" : 0, \"exportar\" : 1\r\n	},\r\n	\"palabraclaves\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 0, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"palabraclaves_productos\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"palabraclaves_tareas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"productos\" : {\r\n		\"agregar\" : 0, \"editar\" : 0, \"ver\" : 1, \"eliminar\" : 0, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"productos_caracteristicas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"tareas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"tareas_usuarios\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"tiendas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 0, \"activar\" : 0, \"exportar\" : 1\r\n	},\r\n	\"usuarios\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 0, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"codigopaises\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 0, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"bancos\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 0, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"tipoCuentas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 0, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"configuraciones\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 0, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"preguntaFrecuentes\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"marcas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 0, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"unidadMedidas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 0, \"activar\" : 1, \"exportar\" : 1\r\n	}\r\n}',1,'2017-06-16 11:03:55','2017-06-20 16:15:45');

UNLOCK TABLES;

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
) ENGINE=MyISAM AUTO_INCREMENT=667 DEFAULT CHARSET=utf8;

/*Data for the table `crp_tareas` */

LOCK TABLES `crp_tareas` WRITE;

insert  into `crp_tareas`(`id`,`usuario_id`,`administrador_id`,`parent_id`,`categoriatarea_id`,`tienda_id`,`impuesto_default_id`,`idioma_id`,`shop_id`,`nombre`,`descripcion`,`precio`,`fecha_entrega`,`cantidad_productos`,`porcentaje_realizado`,`iniciado`,`fecha_iniciado`,`count_comentarios`,`activo`,`en_progreso`,`en_revision`,`rechazado`,`finalizado`,`fecha_finalizado`,`created`,`modified`) values (666,2,2,NULL,NULL,1,1,1,1,'[TEST] FInal','<p>Bla<br></p>','11111','2017-06-23 10:00:25',2,1,1,'2017-06-22 10:04:20',0,1,1,0,0,0,NULL,'2017-06-22 10:03:23','2017-06-22 10:07:13');

UNLOCK TABLES;

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

/*Data for the table `crp_tiendas` */

LOCK TABLES `crp_tiendas` WRITE;

insert  into `crp_tiendas`(`id`,`nombre`,`url`,`nombre_base_de_datos`,`host`,`usuario_mysql`,`pass_mysql`,`db_configuracion`,`prefijo`,`principal`,`tema`,`logo`,`activo`,`created`,`modified`) values (1,'Toolmania','www.toolmania.cl','toolmania2','69.164.205.133','nodriza','IgP_8111980_IgP','toolmania','tm_',1,'dark','logo_min.png',1,'2017-04-13 14:04:20','2017-04-17 16:34:53'),(2,'Walko','www.walko.cl','walko','69.164.205.133','nodriza','IgP_8111980_IgP','walko','ac_',0,'forest','asistecar_1478097949.jpg',1,'2017-04-17 16:28:01','2017-04-17 16:28:01');

UNLOCK TABLES;

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

/*Data for the table `crp_tipo_cuentas` */

LOCK TABLES `crp_tipo_cuentas` WRITE;

insert  into `crp_tipo_cuentas`(`id`,`nombre`,`activo`,`created`,`modified`) values (1,'Cuenta corriente',1,'2017-04-26 17:54:53','2017-04-26 17:54:53'),(2,'Cuenta vista',1,'2017-06-16 10:54:32','2017-06-16 10:54:49'),(3,'Cuenta rut',1,'2017-06-16 10:54:42','2017-06-16 10:54:42');

UNLOCK TABLES;

/*Table structure for table `crp_unidad_medidas` */

DROP TABLE IF EXISTS `crp_unidad_medidas`;

CREATE TABLE `crp_unidad_medidas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `ejemplo` varchar(50) DEFAULT NULL,
  `tipo_campo` varchar(20) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `crp_unidad_medidas` */

LOCK TABLES `crp_unidad_medidas` WRITE;

insert  into `crp_unidad_medidas`(`id`,`nombre`,`ejemplo`,`tipo_campo`,`activo`,`created`,`modified`) values (1,'MM','10 MM','number',1,'2017-06-22 09:54:03','2017-06-22 09:54:03'),(2,'W','2000 W','number',1,'2017-06-22 09:57:13','2017-06-22 09:57:13'),(3,'\"','4-1/2\"','number',1,'2017-06-22 10:03:32','2017-06-22 10:03:32'),(4,'PPM','40000 PPM','number',1,'2017-06-22 10:04:31','2017-06-22 10:04:31'),(5,'NM','30 NM','number',1,'2017-06-22 10:04:46','2017-06-22 10:04:46'),(6,'RPM','11000 RPM','number',1,'2017-06-22 10:11:17','2017-06-22 10:11:17'),(7,'KG','5 KG','number',1,'2017-06-22 10:11:32','2017-06-22 10:11:32'),(8,'V','18 V','number',1,'2017-06-22 10:11:56','2017-06-22 10:11:56'),(9,'AH','2.0 AH','number',1,'2017-06-22 10:12:14','2017-06-22 10:12:14'),(10,'M/MIN','1200 M/MIN','number',1,'2017-06-22 10:12:58','2017-06-22 10:12:58'),(11,'°','45°','number',1,'2017-06-22 10:13:23','2017-06-22 10:13:23'),(12,'OPM','250 OPM','number',1,'2017-06-22 10:14:43','2017-06-22 10:14:43'),(13,'IPM','4000 IPM','number',1,'2017-06-22 10:15:29','2017-06-22 10:15:29'),(14,'SI/NO','PERCUSIÓN: SI','text',0,'2017-06-22 10:20:07','2017-06-22 10:21:10'),(15,'SI','PERCUSIÓN: SI','text',1,'2017-06-22 10:22:15','2017-06-22 10:22:15');

UNLOCK TABLES;

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

/*Data for the table `crp_usuarios` */

LOCK TABLES `crp_usuarios` WRITE;

insert  into `crp_usuarios`(`id`,`codigopais_id`,`rut`,`nombre`,`apellidos`,`email`,`clave`,`fono`,`imagen`,`activo`,`count_tareas_terminadas`,`calificacion_media`,`ultimo_acceso`,`created`,`modified`,`tour_inicio`,`tour_tarea`,`tour_producto`,`tour_perfil`) values (2,1,'17442658-9','Cristian','Rojas Pérez','cristian.rojas@nodriza.cl','43496642d74ad5c4a0cce621044f02fd817a0928','111111111',NULL,1,0,3,'2017-06-22 10:06:58','2017-06-19 09:46:18','2017-06-22 10:06:59',1,1,1,1);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
