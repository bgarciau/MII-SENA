-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-05-2023 a las 17:43:16
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mii`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centros_formacion`
--

DROP TABLE IF EXISTS `centros_formacion`;
CREATE TABLE IF NOT EXISTS `centros_formacion` (
  `pk_id_cefo` int NOT NULL,
  `cefo_nom_centro_formacion` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cefo_nom_regional` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `cefo_nom_director_regional` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `cefo_nom_sub_director` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `cefo_nom_coordinador` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `cefo_telefono` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `cefo_email` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`pk_id_cefo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `centros_formacion`
--

INSERT INTO `centros_formacion` (`pk_id_cefo`, `cefo_nom_centro_formacion`, `cefo_nom_regional`, `cefo_nom_director_regional`, `cefo_nom_sub_director`, `cefo_nom_coordinador`, `cefo_telefono`, `cefo_email`) VALUES
(1, 'automatizacion2', 'caldas', 'paula', 'cristian', 'brayan G', '3245678943', 'nini@gmail.com'),
(2, 'COMERCIO', 'caldas', 'brayan', 'paula', 'cristian', '3123', 'centro2@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresaaprendiz`
--

DROP TABLE IF EXISTS `empresaaprendiz`;
CREATE TABLE IF NOT EXISTS `empresaaprendiz` (
  `pk_seleccion` int NOT NULL AUTO_INCREMENT,
  `nom_funcionario` varchar(200) DEFAULT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `observaciones` varchar(500) NOT NULL,
  `contratar` varchar(20) NOT NULL,
  `ciudad_diligenciamiento` varchar(40) NOT NULL,
  `fecha_diligenciamiento` date NOT NULL,
  `fk_id_empresa` int NOT NULL,
  `fk_id_aprendiz` int NOT NULL,
  PRIMARY KEY (`pk_seleccion`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `empresaaprendiz`
--

INSERT INTO `empresaaprendiz` (`pk_seleccion`, `nom_funcionario`, `telefono`, `correo`, `observaciones`, `contratar`, `ciudad_diligenciamiento`, `fecha_diligenciamiento`, `fk_id_empresa`, `fk_id_aprendiz`) VALUES
(1, 'BRAYAN', '23123123', 'brayanra@gmail.com', 'v', 'si', 'Manizales', '2023-05-24', 3, 1010028095),
(5, 'David', '321321', 'david@gmail.com', 'c', 'si', 'Manizales', '2023-05-25', 4444, 1002),
(6, 'BRAYAN', '321321', 'brayanra@gmail.com', 'sfdsdfs', 'si', 'Manizales', '2023-05-25', 3, 1002);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudio`
--

DROP TABLE IF EXISTS `estudio`;
CREATE TABLE IF NOT EXISTS `estudio` (
  `pk_id_estudio` int NOT NULL AUTO_INCREMENT,
  `numero` int NOT NULL,
  `estudio_titulo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estudio_institucion` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estudio_fecha_grado` date DEFAULT NULL,
  `estudio_semestres_aprobados` int DEFAULT NULL,
  `tipo_estudio` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fk_id_usr` int NOT NULL,
  PRIMARY KEY (`pk_id_estudio`),
  KEY `fk_Estudio_Usuarios1` (`fk_id_usr`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudio`
--

INSERT INTO `estudio` (`pk_id_estudio`, `numero`, `estudio_titulo`, `estudio_institucion`, `estudio_fecha_grado`, `estudio_semestres_aprobados`, `tipo_estudio`, `fk_id_usr`) VALUES
(15, 1, 'BACHILLER', 'coelgio12 1', '2023-05-21', NULL, 'BACHILLER', 1010028095),
(21, 1, 'BACHILLER', 'ENSC', '2018-12-01', NULL, 'BACHILLER', 1002),
(25, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1),
(26, 2, 'BACHILLER', 'sena', NULL, 8, 'Tecnologo', 1002),
(27, 2, 'ADSI', 'SENA', NULL, 8, 'Tecnologo', 1010028095);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichas`
--

DROP TABLE IF EXISTS `fichas`;
CREATE TABLE IF NOT EXISTS `fichas` (
  `pk_id_ficha` int NOT NULL,
  `ficha_fecha_inicio` date NOT NULL,
  `ficha_fecha_terminacion` date NOT NULL,
  `ficha_etapa` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `fk_id_pro` int NOT NULL,
  PRIMARY KEY (`pk_id_ficha`),
  KEY `fk_Ficha_Programa1` (`fk_id_pro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fichas`
--

INSERT INTO `fichas` (`pk_id_ficha`, `ficha_fecha_inicio`, `ficha_fecha_terminacion`, `ficha_etapa`, `fk_id_pro`) VALUES
(123, '2023-05-11', '2023-05-17', 'LECTIVA', 3),
(342345, '2023-05-11', '2023-05-17', 'PRACTICA', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

DROP TABLE IF EXISTS `programas`;
CREATE TABLE IF NOT EXISTS `programas` (
  `pk_id_pro` int NOT NULL,
  `pro_nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pro_perfil` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `pro_ocupaciones` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `fk_id_cefo` int NOT NULL,
  PRIMARY KEY (`pk_id_pro`),
  KEY `fk_Programa_Centro_Formacion1` (`fk_id_cefo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`pk_id_pro`, `pro_nombre`, `pro_perfil`, `pro_ocupaciones`, `fk_id_cefo`) VALUES
(1, 'adso', 'perfil adso', 'ocupasiones adso', 1),
(3, 'adsi', 'perfil ADSI', 'ocupaciones', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

DROP TABLE IF EXISTS `tipo_documento`;
CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `pk_id_tipo_doc` int NOT NULL,
  `tipo_doc_descripcion` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`pk_id_tipo_doc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`pk_id_tipo_doc`, `tipo_doc_descripcion`) VALUES
(1, 'Cedula de Ciudadania'),
(2, 'Tarjeta de Identidad'),
(3, 'Cedula de Extranjeria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuarios`
--

DROP TABLE IF EXISTS `tipo_usuarios`;
CREATE TABLE IF NOT EXISTS `tipo_usuarios` (
  `pk_id_tipo_usr` int NOT NULL,
  `tipo_usr_descripcion` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`pk_id_tipo_usr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_usuarios`
--

INSERT INTO `tipo_usuarios` (`pk_id_tipo_usr`, `tipo_usr_descripcion`) VALUES
(1, 'aprendiz'),
(2, 'funcionario'),
(3, 'empresa'),
(4, 'instructor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `pk_id_usr` int NOT NULL,
  `usr_nombre` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `usr_empresa` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usr_apellidos` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `usr_telefono` int NOT NULL,
  `usr_email` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `usr_rh` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usr_direccion` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usr_estrato` int DEFAULT NULL,
  `usr_ciudad` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usr_hv` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usr_contacto` int DEFAULT NULL,
  `usr_cargo` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usr_fecha_nacimiento` date DEFAULT NULL,
  `usr_libreta_militar` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fk_id_ficha` int DEFAULT NULL,
  `fk_id_tipo_doc` int DEFAULT NULL,
  `fk_id_tipo_usr` int NOT NULL,
  `login_pass` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `foto` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`pk_id_usr`),
  KEY `fk_Usuarios_Tipo_Usuarios` (`fk_id_tipo_usr`),
  KEY `fk_Usuarios_Tipo_Documento1` (`fk_id_tipo_doc`),
  KEY `fk_Usuarios_Ficha1` (`fk_id_ficha`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`pk_id_usr`, `usr_nombre`, `usr_empresa`, `usr_apellidos`, `usr_telefono`, `usr_email`, `usr_rh`, `usr_direccion`, `usr_estrato`, `usr_ciudad`, `usr_hv`, `usr_contacto`, `usr_cargo`, `usr_fecha_nacimiento`, `usr_libreta_militar`, `fk_id_ficha`, `fk_id_tipo_doc`, `fk_id_tipo_usr`, `login_pass`, `foto`) VALUES
(1, '2', NULL, '2', 1, '1@1.com', 'AB-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 123, 3, 1, '123', '../fotos/chu.jpg'),
(2, 'funcionario', NULL, 'rodriguez', 31242777, 'funcionario@gmail.com', 'O-', NULL, NULL, NULL, NULL, NULL, 'f', NULL, NULL, NULL, 1, 2, 'funcionario', '../fotos/123.jpg'),
(3, 'empresa', 'empresaaa', 'rodri', 321412, 'empresaP@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'empresa', ''),
(99, 'Jesus DavidD', NULL, 'Agudelo Linux', 1312319, 'jesus@sena.com', 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, '123', '../fotos/defecto.jpg'),
(999, 'Jesus David', NULL, 'Agudelo Linux', 131231, 'jesus@sena.com', 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, '123', '../fotos/defecto.jpg'),
(1002, 'Brayan', NULL, 'Garcia Useda', 314, 'brayan@gmail.com', 'O+', 'cr 32a #32-14', 1, 'manizales', 'si', NULL, NULL, '2001-04-30', 'NO', 123, 1, 1, '123', '../fotos/defecto.jpg'),
(1122, 'chucho', NULL, 'linux2', 23124999, 'chucho@sena.com', 'AB -', NULL, NULL, NULL, NULL, NULL, 'cargpo', NULL, NULL, NULL, 1, 2, '123', '../fotos/defecto.jpg'),
(4444, 'Jorge', 'Prometalicos', 'prometalicos', 123123123, 'jorge@pro.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '123', ''),
(1010028095, 'Cristian', NULL, 'Cruz', 316484542, 'cristian10100@outlook.com', 'A+', 'calle 2446 .12', 23, 'manizales', 'si', NULL, NULL, '2023-05-11', 'NO', 123, NULL, 1, '1234', '../fotos/IMG_20230517_092757.jpg');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estudio`
--
ALTER TABLE `estudio`
  ADD CONSTRAINT `estudio_ibfk_1` FOREIGN KEY (`fk_id_usr`) REFERENCES `usuarios` (`pk_id_usr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fichas`
--
ALTER TABLE `fichas`
  ADD CONSTRAINT `fk_Ficha_Programa1` FOREIGN KEY (`fk_id_pro`) REFERENCES `programas` (`pk_id_pro`);

--
-- Filtros para la tabla `programas`
--
ALTER TABLE `programas`
  ADD CONSTRAINT `fk_Programa_Centro_Formacion1` FOREIGN KEY (`fk_id_cefo`) REFERENCES `centros_formacion` (`pk_id_cefo`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_Usuarios_Ficha1` FOREIGN KEY (`fk_id_ficha`) REFERENCES `fichas` (`pk_id_ficha`),
  ADD CONSTRAINT `fk_Usuarios_Tipo_Documento1` FOREIGN KEY (`fk_id_tipo_doc`) REFERENCES `tipo_documento` (`pk_id_tipo_doc`),
  ADD CONSTRAINT `fk_Usuarios_Tipo_Usuarios` FOREIGN KEY (`fk_id_tipo_usr`) REFERENCES `tipo_usuarios` (`pk_id_tipo_usr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
