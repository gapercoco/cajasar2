-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 10-09-2014 a las 12:54:10
-- Versión del servidor: 5.1.73-community
-- Versión de PHP: 5.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lgi_format`
--

DROP TABLE IF EXISTS `lgi_format`;
CREATE TABLE IF NOT EXISTS `lgi_format` (
  `IDFormat` int(11) NOT NULL AUTO_INCREMENT,
  `format` varchar(50) NOT NULL,
  PRIMARY KEY (`IDFormat`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Formato de operaciones' AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `lgi_format`
--

INSERT INTO `lgi_format` (`IDFormat`, `format`) VALUES
(1, 'Venta'),
(2, 'Alquiler'),
(3, 'Plano'),
(4, 'Maqueta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lgi_fotosxprop`
--

DROP TABLE IF EXISTS `lgi_fotosxprop`;
CREATE TABLE IF NOT EXISTS `lgi_fotosxprop` (
  `ID` int(11) NOT NULL,
  `path_pic` text NOT NULL,
  KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Fotos de cada propiedad';

--
-- Volcado de datos para la tabla `lgi_fotosxprop`
--

INSERT INTO `lgi_fotosxprop` (`ID`, `path_pic`) VALUES
(1, 'img/propiedades/01.jpg'),
(1, 'img/propiedades/02.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lgi_messages`
--

DROP TABLE IF EXISTS `lgi_messages`;
CREATE TABLE IF NOT EXISTS `lgi_messages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `ID_prop` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `date_call` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `lgi_messages`
--

INSERT INTO `lgi_messages` (`ID`, `name`, `email`, `phone`, `message`, `ID_prop`, `date`, `date_call`) VALUES
(2, 'Guillermo', 'gapercoco@hotmail.com', '1234567890', 'Esto es una prueba.', 0, '2014-09-04 22:03:42', '0000-00-00 00:00:00'),
(3, 'Guillermo', 'gapercoco@hotmail.com', '1234567890', 'Esto es una prueba.', 0, '2014-09-04 22:04:19', '0000-00-00 00:00:00'),
(4, 'Guillermo', 'gapercoco@hotmail.com', '1234567890', 'Esto es una prueba.', 0, '2014-09-04 22:04:50', '0000-00-00 00:00:00'),
(5, 'Guillermo', 'gapercoco@hotmail.com', '98765432', 'Esto es una prueba.', 0, '2014-09-04 22:06:08', '0000-00-00 00:00:00'),
(6, 'fede', 'defe@fede.com', '123456', 'prueba', 0, '2014-09-04 22:08:03', '0000-00-00 00:00:00'),
(7, 'fede', 'fede@fede.com', '12345', 'Prueba.', 0, '2014-09-04 22:09:20', '0000-00-00 00:00:00'),
(8, 'fede', 'fede@fede.com', '12345', 'Prueba.', 0, '2014-09-04 22:12:05', '0000-00-00 00:00:00'),
(9, 'fede', 'fede@fede.com', '12345', 'Prueba.', 0, '2014-09-04 22:12:13', '0000-00-00 00:00:00'),
(10, 'Guido', 'guido@fede.com', '12345678', 'Prueba de guido.', 0, '2014-09-04 22:13:59', '0000-00-00 00:00:00'),
(11, 'Guido', 'guido@fede.com', '12345678', 'Prueba de guido.', 0, '2014-09-04 22:15:51', '0000-00-00 00:00:00'),
(12, 'Nico', 'nico@fede.com.ar', '123456787654323456', 'Esto es la ultima prueba.', 0, '2014-09-04 22:17:41', '0000-00-00 00:00:00'),
(13, 'Guillermo', 'pepe@fede.com.ar', '123', 'perwefasd', 0, '2014-09-04 22:24:06', '0000-00-00 00:00:00'),
(14, 'fede', 'fede@fede.com', '124', 'asdas', 0, '2014-09-04 22:26:42', '0000-00-00 00:00:00'),
(15, 'fede', '', '', '', 0, '2014-09-04 22:27:48', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lgi_options`
--

DROP TABLE IF EXISTS `lgi_options`;
CREATE TABLE IF NOT EXISTS `lgi_options` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(60) NOT NULL,
  `option_value` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `lgi_options`
--

INSERT INTO `lgi_options` (`ID`, `option_name`, `option_value`) VALUES
(1, 'title', 'Cajas.AR'),
(2, 'description', 'Trabajo final para la materia LGI, de la escuela Urquiza, Rosario, Santa Fe, Republica Argentina'),
(3, 'keywords', 'cajas.ar, lgi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lgi_pages`
--

DROP TABLE IF EXISTS `lgi_pages`;
CREATE TABLE IF NOT EXISTS `lgi_pages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `page_creator` int(11) NOT NULL,
  `page_parent` int(11) NOT NULL DEFAULT '0',
  `page_order` int(11) NOT NULL DEFAULT '0',
  `page_title` text NOT NULL,
  `page_icon` varchar(50) NOT NULL,
  `page_content` text,
  `page_status` tinyint(1) NOT NULL DEFAULT '0',
  `page_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `page_view` varchar(50) DEFAULT NULL,
  `page_vars` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Paginas del sitio' AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `lgi_pages`
--

INSERT INTO `lgi_pages` (`ID`, `page_creator`, `page_parent`, `page_order`, `page_title`, `page_icon`, `page_content`, `page_status`, `page_modified`, `page_view`, `page_vars`) VALUES
(1, 1, 0, 10, 'Nosotros', 'imagenes/iconologo.png', '<div class="panel panel-default">\n<div class="panel-body text-center">\n<b>"El secreto de los logros de una empresa no solo est&aacute; en cumplir bien su trabajo, sino tambi&eacute;n en superarse y saber para qu&eacute; se trabaja." </b>\n</div>\n</div>\nSi necesit&aacute;s comprar, vender, alquilar, o decidir c&oacute;mo y d&oacute;nde invertir tus ahorros, posiblemente preguntar&aacute;s referencias a tus conocidos, averiguar&aacute;s entre las empresas m&aacute;s reconocidas del mercado, o recorrer&aacute;s aquellas empresas con mejores referencias y trayectoria.<br><br>\nSeguramente, cajas.ar estar&aacute; en la lista que confecciones. Te comentamos que nuestra firma comenz&oacute; su actividad hace ya 20 a&ntilde;os durante los cuales hemos aprendido a satisfacer tus necesidades, ya sean en compra, alquiler, administracion, tasaci&oacute;n, asesoramiento en cuanto a inversiones y/o impositivo y legal.<br><br>\nNos preocupamos por las necesidades que ten&eacute;s, al acercar tus inquietudes y ponerlas en nuestras manos.\nComprendemos el valor que significa tomar una decisi&oacute;n tan trascendente como elegir el lugar donde vivir o la inversi&oacute;n a realizar para resguardar tus ahorros.', 1, '2014-06-04 22:35:15', NULL, NULL),
(2, 1, 0, 20, 'Propiedades', 'imagenes/inicio1.png', 'Nuestras propiedades<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu ligula ut nunc placerat interdum ac auctor orci. Proin ac urna ipsum. Vestibulum et massa orci. Vivamus non diam commodo, tempor quam a, semper mauris. Maecenas imperdiet enim nec libero tempus ultricies. Fusce aliquam nec nulla ut dapibus. Integer semper ligula sed pulvinar aliquam. Suspendisse aliquet nisl ipsum, quis posuere orci auctor quis. Mauris tincidunt nisl sapien, sed bibendum felis consectetur et. Ut imperdiet, nulla in viverra malesuada, est quam tincidunt metus, sed mollis sem nisi placerat augue. Etiam fermentum orci in vehicula vulputate.\n\nMauris vel tristique felis. Quisque nec velit porttitor, dignissim diam id, varius eros. Sed tortor turpis, tempus elementum cursus non, volutpat vitae purus. Vestibulum eleifend sagittis pellentesque. Duis volutpat nec augue ac vestibulum. Nullam feugiat sed leo at vehicula. Aenean cursus augue dolor, bibendum posuere ante elementum eget. Integer nisi sapien, lobortis in sodales vel, iaculis hendrerit nunc. Vivamus luctus est odio, ut consectetur ligula interdum eu. Fusce fringilla elit vitae dui fringilla, vitae pharetra elit fringilla. Phasellus ullamcorper urna sollicitudin iaculis interdum. Quisque lorem elit, lobortis non vestibulum et, sodales iaculis elit. Proin suscipit magna vel purus iaculis sollicitudin nec ac lectus.\n\nNam tortor risus, tristique in lectus a, varius ornare libero. Morbi hendrerit nec tellus et convallis. Quisque semper odio porta sollicitudin lacinia. Maecenas viverra, risus nec mollis rutrum, nulla magna congue nunc, sed tristique orci nisl vel eros. Vivamus ornare erat eu ultrices convallis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eros sapien, sodales a bibendum vitae, ornare at est. Duis hendrerit erat ullamcorper feugiat pulvinar. Phasellus nec purus posuere, eleifend mauris quis, congue nunc. Aliquam erat volutpat. Nunc at semper nibh. Duis at nulla sem.\n\nAliquam nulla tortor, tempor eget cursus quis, iaculis vitae tortor. Nulla blandit pulvinar nulla, sed commodo justo. Fusce mattis arcu non libero scelerisque, eget tincidunt orci dictum. Mauris vel aliquet sapien. Morbi pulvinar, lectus ut venenatis facilisis, leo tellus congue felis, sed mollis urna enim in eros. Etiam sed est sit amet orci varius consequat. Morbi vitae vulputate orci. Sed consectetur magna elementum metus vestibulum tincidunt. Praesent leo dui, tempor a blandit adipiscing, varius ac tortor. Proin ac dui a neque consectetur placerat ut non erat.\n\nProin feugiat sodales diam, sed dapibus nulla elementum id. Fusce posuere tempor turpis, molestie ultricies eros dignissim eget. Curabitur non mi urna. Sed porttitor lacinia mi et laoreet. Sed ultricies vehicula dignissim. Nunc a eros ultricies, semper justo et, tempus massa. Suspendisse pulvinar mollis egestas.', 1, '2014-05-15 19:31:40', NULL, NULL),
(3, 1, 0, 30, 'Promociones', 'imagenes/inicio1.png', 'Estas son nuestras promociones vigentes<br>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu ligula ut nunc placerat interdum ac auctor orci. Proin ac urna ipsum. Vestibulum et massa orci. Vivamus non diam commodo, tempor quam a, semper mauris. Maecenas imperdiet enim nec libero tempus ultricies. Fusce aliquam nec nulla ut dapibus. Integer semper ligula sed pulvinar aliquam. Suspendisse aliquet nisl ipsum, quis posuere orci auctor quis. Mauris tincidunt nisl sapien, sed bibendum felis consectetur et. Ut imperdiet, nulla in viverra malesuada, est quam tincidunt metus, sed mollis sem nisi placerat augue. Etiam fermentum orci in vehicula vulputate.\r\n\r\nMauris vel tristique felis. Quisque nec velit porttitor, dignissim diam id, varius eros. Sed tortor turpis, tempus elementum cursus non, volutpat vitae purus. Vestibulum eleifend sagittis pellentesque. Duis volutpat nec augue ac vestibulum. Nullam feugiat sed leo at vehicula. Aenean cursus augue dolor, bibendum posuere ante elementum eget. Integer nisi sapien, lobortis in sodales vel, iaculis hendrerit nunc. Vivamus luctus est odio, ut consectetur ligula interdum eu. Fusce fringilla elit vitae dui fringilla, vitae pharetra elit fringilla. Phasellus ullamcorper urna sollicitudin iaculis interdum. Quisque lorem elit, lobortis non vestibulum et, sodales iaculis elit. Proin suscipit magna vel purus iaculis sollicitudin nec ac lectus.\r\n\r\nNam tortor risus, tristique in lectus a, varius ornare libero. Morbi hendrerit nec tellus et convallis. Quisque semper odio porta sollicitudin lacinia. Maecenas viverra, risus nec mollis rutrum, nulla magna congue nunc, sed tristique orci nisl vel eros. Vivamus ornare erat eu ultrices convallis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eros sapien, sodales a bibendum vitae, ornare at est. Duis hendrerit erat ullamcorper feugiat pulvinar. Phasellus nec purus posuere, eleifend mauris quis, congue nunc. Aliquam erat volutpat. Nunc at semper nibh. Duis at nulla sem.\r\n\r\nAliquam nulla tortor, tempor eget cursus quis, iaculis vitae tortor. Nulla blandit pulvinar nulla, sed commodo justo. Fusce mattis arcu non libero scelerisque, eget tincidunt orci dictum. Mauris vel aliquet sapien. Morbi pulvinar, lectus ut venenatis facilisis, leo tellus congue felis, sed mollis urna enim in eros. Etiam sed est sit amet orci varius consequat. Morbi vitae vulputate orci. Sed consectetur magna elementum metus vestibulum tincidunt. Praesent leo dui, tempor a blandit adipiscing, varius ac tortor. Proin ac dui a neque consectetur placerat ut non erat.\r\n\r\nProin feugiat sodales diam, sed dapibus nulla elementum id. Fusce posuere tempor turpis, molestie ultricies eros dignissim eget. Curabitur non mi urna. Sed porttitor lacinia mi et laoreet. Sed ultricies vehicula dignissim. Nunc a eros ultricies, semper justo et, tempus massa. Suspendisse pulvinar mollis egestas.', 1, '2014-05-15 19:31:59', NULL, NULL),
(4, 1, 2, 10, 'Departamentos', '', NULL, 1, '2014-06-04 04:22:38', 'buscaPropiedades.php', 'type=1'),
(5, 1, 2, 20, 'Pisos', '', NULL, 1, '2014-05-15 19:37:17', NULL, NULL),
(6, 1, 2, 30, 'Proyectos', '', NULL, 1, '2014-06-04 18:09:25', 'buscaPropiedades.php', 'type=4'),
(7, 1, 2, 40, 'Locales', '', NULL, 1, '2014-06-04 18:10:42', 'buscaPropiedades.php', 'type=7'),
(8, 1, 2, 50, 'Casas', '', 'Casas', 1, '2014-06-04 20:35:19', 'buscaPropiedades.php', 'type=2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lgi_propiedades`
--

DROP TABLE IF EXISTS `lgi_propiedades`;
CREATE TABLE IF NOT EXISTS `lgi_propiedades` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `prop_title` varchar(30) NOT NULL,
  `prop_resume` varchar(200) NOT NULL,
  `prop_descrip` text NOT NULL,
  `prop_promo` int(11) NOT NULL,
  `prop_type` int(11) NOT NULL,
  `prop_format` int(11) NOT NULL,
  `prop_slider` text,
  `prop_tags` text NOT NULL,
  `prop_clicks` int(11) NOT NULL,
  `prop_status` int(11) NOT NULL,
  `prop_created` datetime NOT NULL,
  `prop_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `prop_unpublish` datetime DEFAULT NULL,
  `prop_sup_cubierta` int(11) DEFAULT NULL,
  `prop_sup_total` int(11) DEFAULT NULL,
  `prop_dormitorios` int(11) DEFAULT NULL,
  `prop_banios` int(11) DEFAULT NULL,
  `prop_ubicacion` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `lgi_propiedades`
--

INSERT INTO `lgi_propiedades` (`ID`, `prop_title`, `prop_resume`, `prop_descrip`, `prop_promo`, `prop_type`, `prop_format`, `prop_slider`, `prop_tags`, `prop_clicks`, `prop_status`, `prop_created`, `prop_modified`, `prop_unpublish`, `prop_sup_cubierta`, `prop_sup_total`, `prop_dormitorios`, `prop_banios`, `prop_ubicacion`) VALUES
(1, 'Duplex vista al Rio', 'Excepcional duplex con vista al R&iacute;o Parana. 3 dormitorios', 'Unidades con terminaciones de alta calidad, balcones terraza y vista franca al r&iacute;o.\nDos dormitorios con doble ingreso, amplio estar comedor, dos dormitorios en suite, cocina separada, lavadero separado y amplio balc&oacute;n aterrazado.', 0, 1, 1, 'img/propiedades/01.jpg', '', 0, 1, '2014-05-14 00:00:00', '2014-06-04 20:31:50', '0000-00-00 00:00:00', 70, 95, 3, 2, 'Santa Fe 1745'),
(2, 'Casa de campo', 'A solo 5 minutos de Rosario, espectacular casa de campo de 4 dormitorios y 300m2', 'Su dise&ntilde;o urban&iacute;stico comprende dos avenidas principales residenciales y/o comerciales de hormig&oacute;n armado, que atraviesan el predio en forma din&aacute;mica y asegurando r&aacute;pidas salidas.\nCalles secundarias se internan en las distintas manzanas, algunas de ellas finalizando en cul-de-sac garantizando recorridos internos tranquilos y seguros.\n<br>\nServicios:\n<ul>\n<li>Red El&eacute;ctrica   </li>\n    <li>Planta Potabilizadora   </li>\n    <li>Red de Gas</li>\n    <li>Telefon&iacute;a e Internet   </li>\n    <li>Forestaci&oacute;n   </li>\n    <li>Seguridad</li>\n    <li>Transporte P&uacute;blico   </li>\n    <li>Parking   </li>\n    <li>Kinder</li>\n    <li>Restaurant   </li>\n    <li>Apart Hotel   </li>\n    <li>Centro Comercial</li>\n    <li>Piscina cubierta climatizada   </li>\n    <li>Gym Center & Spa   </li>\n    <li>1 F&uacute;tbol 7</li>\n    <li>1 F&uacute;tbol 5 Cubierta   </li>\n    <li>3 Tenis Polvo de ladrillo   </li>\n    <li> Basket</li>\n</ul>\n', 0, 2, 1, 'img/propiedades/02.jpg', '', 0, 1, '2014-05-14 00:00:00', '2014-06-04 18:43:45', NULL, 450, 600, 4, 3, 'Callao 230 bis'),
(3, 'Loft - Duplex', 'En zona centro, 90m2 a estrenar', 'Piso exclusivo. 200 metros . 4 dormitorios, 3 ba&ntild;os, cocina comedor, living comedor, habitaci&oacute;n y ba&ntilde;o de servicio. Piso roble americano.  Dependencias. Espectacular vista panor&aacute;mica.Balc&oacute;n frente. Vista Oro&ntilde;o, R&iacute;o .Quincho/Sum .Seguridad fines de semana. Expensas promedio $2500', 0, 1, 2, 'img/propiedades/03.jpg', '', 0, 1, '2014-05-14 00:00:00', '2014-06-05 01:02:36', NULL, 90, 95, 1, 1, 'C&oacute;rdoba 2001'),
(4, 'Proyecto familia', 'Casa 4 ambientes ideal familia', 'Casa en esquina, 11,46 x 12,67 (frente esquinas) x 11,49 fondo. \n\nDos dormitorios, living comedor, cocina, cochera. Patio techado, terraza,  la casa cuenta con doble ingreso, por ambos frentes.', 0, 4, 3, 'img/propiedades/04.jpg', '', 0, 1, '2014-05-14 00:00:00', '2014-06-04 20:30:37', NULL, 120, 200, 3, 2, 'San Mart&iacute;n 4900'),
(5, 'Proyecto Luxury', 'Mansi&oacute;n 500m2 zona residencial', '', 0, 4, 3, 'img/propiedades/05.jpg', '', 0, 1, '2014-05-14 00:00:00', '2014-06-04 12:45:01', NULL, 300, 500, 5, 4, 'Cerrito 1550');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lgi_tiposprop`
--

DROP TABLE IF EXISTS `lgi_tiposprop`;
CREATE TABLE IF NOT EXISTS `lgi_tiposprop` (
  `IDType` int(11) NOT NULL AUTO_INCREMENT,
  `type_desc` varchar(50) NOT NULL,
  PRIMARY KEY (`IDType`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Tipos de propiedades' AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `lgi_tiposprop`
--

INSERT INTO `lgi_tiposprop` (`IDType`, `type_desc`) VALUES
(1, 'Departamento'),
(2, 'Casa'),
(3, 'Pozo'),
(4, 'Proyecto'),
(5, 'Piso'),
(6, 'Cochera'),
(7, 'Local');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lgi_users`
--

DROP TABLE IF EXISTS `lgi_users`;
CREATE TABLE IF NOT EXISTS `lgi_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL,
  `user_passwd` varchar(64) NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_profile` varchar(20) NOT NULL,
  `user_lastlogin` datetime NOT NULL,
  `user_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `user_login` (`user_login`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `lgi_users`
--

INSERT INTO `lgi_users` (`ID`, `user_login`, `user_passwd`, `user_name`, `user_email`, `user_profile`, `user_lastlogin`, `user_status`) VALUES
(1, 'admin', '12345', 'Administrador', 'gapercoco@hotmail.com', 'admin', '0000-00-00 00:00:00', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
