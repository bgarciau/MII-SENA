-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 22-06-2023 a las 20:56:04
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
  `cefo_nom_regional` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cefo_nom_director_regional` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cefo_nom_sub_director` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cefo_nom_coordinador` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cefo_telefono` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cefo_email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`pk_id_cefo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `centros_formacion`
--

INSERT INTO `centros_formacion` (`pk_id_cefo`, `cefo_nom_centro_formacion`, `cefo_nom_regional`, `cefo_nom_director_regional`, `cefo_nom_sub_director`, `cefo_nom_coordinador`, `cefo_telefono`, `cefo_email`) VALUES
(1, 'Centro de Automatización Industrial ', 'caldas', 'Paula Andrea Valencia', 'Cristian Cruz', 'Brayan Garcia', '3245678943', 'nini@gmail.com');

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
  `fk_id_empresa` bigint NOT NULL,
  `fk_id_aprendiz` bigint NOT NULL,
  PRIMARY KEY (`pk_seleccion`),
  KEY `fk_id_empresa` (`fk_id_empresa`),
  KEY `fk_id_aprendiz` (`fk_id_aprendiz`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `empresaaprendiz`
--

INSERT INTO `empresaaprendiz` (`pk_seleccion`, `nom_funcionario`, `telefono`, `correo`, `observaciones`, `contratar`, `ciudad_diligenciamiento`, `fecha_diligenciamiento`, `fk_id_empresa`, `fk_id_aprendiz`) VALUES
(10, 'Viviana', '3124576799', 'viviana@colgas.com', 'apto', 'si', 'manizales', '2023-06-20', 9002023301, 1002636272);

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
  `tipo_estudio` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fk_id_usr` bigint NOT NULL,
  PRIMARY KEY (`pk_id_estudio`),
  KEY `fk_Estudio_Usuarios1` (`fk_id_usr`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudio`
--

INSERT INTO `estudio` (`pk_id_estudio`, `numero`, `estudio_titulo`, `estudio_institucion`, `estudio_fecha_grado`, `estudio_semestres_aprobados`, `tipo_estudio`, `fk_id_usr`) VALUES
(64, 1, 'BACHILLER', 'ENSC', '2018-11-30', NULL, 'BACHILLER', 1002636272),
(65, 2, 'ADSI', 'sena', NULL, 8, 'Tecnologo', 1002636272),
(66, 1, 'BACHILLER', 'coelgio1', '2018-12-05', NULL, 'BACHILLER', 1002023301),
(67, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1002023302),
(68, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1002023303),
(69, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1002023304),
(70, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1002023305),
(71, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1002023306),
(72, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1002023307),
(73, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1002023308),
(74, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1002023309),
(75, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1002023310),
(76, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1002023311),
(77, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1002023312),
(78, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1002023313),
(79, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1002023314),
(80, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1002023315),
(81, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1002023316),
(82, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1002023317),
(83, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1002023318),
(84, 1, NULL, NULL, NULL, NULL, 'BACHILLER', 1002023319),
(85, 2, '', '', NULL, 0, '', 1002023301);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichas`
--

DROP TABLE IF EXISTS `fichas`;
CREATE TABLE IF NOT EXISTS `fichas` (
  `pk_id_ficha` int NOT NULL,
  `ficha_fecha_inicio` date NOT NULL,
  `ficha_fecha_terminacion` date NOT NULL,
  `ficha_etapa` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fk_id_pro` int NOT NULL,
  PRIMARY KEY (`pk_id_ficha`),
  KEY `fk_Ficha_Programa1` (`fk_id_pro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fichas`
--

INSERT INTO `fichas` (`pk_id_ficha`, `ficha_fecha_inicio`, `ficha_fecha_terminacion`, `ficha_etapa`, `fk_id_pro`) VALUES
(2023001, '2022-06-13', '2023-07-24', 'PRACTICA', 202301),
(2023002, '2023-06-19', '2024-08-23', 'LECTIVA', 2023014),
(2023003, '2022-07-11', '2023-06-23', 'PRACTICA', 2023013),
(2023004, '2021-07-05', '2023-07-17', 'PRACTICA', 202302),
(2023005, '2023-06-11', '2024-06-14', 'LECTIVA', 2023010),
(2023006, '2023-06-21', '2025-07-25', 'LECTIVA', 202306),
(2023007, '2022-08-01', '2023-07-28', 'PRACTICA', 2023012),
(2023008, '2023-06-05', '2023-06-23', 'PRACTICA', 202304),
(2023009, '2023-06-05', '2024-06-14', 'LECTIVA', 2023011),
(2342583, '2021-06-14', '2023-06-30', 'PRACTICA', 202303),
(20230010, '2023-02-13', '2025-02-21', 'LECTIVA', 202356),
(20230011, '2023-05-29', '2024-07-19', 'LECTIVA', 202305),
(20230012, '2022-07-11', '2023-06-30', 'PRACTICA', 202307),
(20230013, '2022-10-10', '2023-10-27', 'PRACTICA', 2023010),
(20230014, '2022-10-17', '2023-10-27', 'PRACTICA', 2023010),
(20230015, '2023-06-26', '2024-07-05', 'LECTIVA', 202309),
(20230016, '2022-07-04', '2024-07-05', 'LECTIVA', 2023015),
(20230017, '2021-06-28', '2023-06-16', 'PRACTICA', 2023017),
(20230018, '2023-06-20', '2024-06-21', 'LECTIVA', 2023018),
(20230019, '2022-01-17', '2023-01-27', 'PRACTICA', 2023016),
(20230020, '2023-01-16', '2024-12-20', 'LECTIVA', 2023019);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

DROP TABLE IF EXISTS `programas`;
CREATE TABLE IF NOT EXISTS `programas` (
  `pk_id_pro` int NOT NULL,
  `pro_nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pro_perfil` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pro_ocupaciones` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fk_id_cefo` int NOT NULL,
  PRIMARY KEY (`pk_id_pro`),
  KEY `fk_Programa_Centro_Formacion1` (`fk_id_cefo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`pk_id_pro`, `pro_nombre`, `pro_perfil`, `pro_ocupaciones`, `fk_id_cefo`) VALUES
(202301, 'Animacion 3D', 'Diseñar', 'Diseñador', 1),
(202302, 'Automatizacion Industrial', 'AI', 'AI', 1),
(202303, 'ADSI', 'Programador y Desarrollador de Sistemas de Informacion', 'Programador', 1),
(202304, 'Control de Calidad de Alimentos', 'Inspector de Calidad', 'Controlador de Calidad', 1),
(202305, 'Decoracion de Espacios Interiores', 'Decorador', 'Decorador', 1),
(202306, 'Desarrollo de Videojuegos', 'Programador', 'Programador', 1),
(202307, 'Desarrollo Multimedia y Web', 'Desarrollador', 'Desarrollador', 1),
(202308, 'Electricidad Industrial', 'Electricista', 'Electricista', 1),
(202309, 'Entrenamiento Deportivo', 'Entrenador ', 'Entrenador', 1),
(202356, 'ADSO', 'Programador', 'Programador', 1),
(2023010, 'Fotografia Y Procesos Digitales', 'Fotografo', 'Fotografo', 1),
(2023011, 'Gestion Administrativa', 'Administrador', 'Administrador', 1),
(2023012, 'Asesoria Comercial', 'Asesor', 'Asesor', 1),
(2023013, 'Carpinteria', 'Carpintero', 'Carpintero', 1),
(2023014, 'Cocina', 'Cocinero', 'Cocinero', 1),
(2023015, 'Actuacion', 'Actor', 'Actor', 1),
(2023016, 'Elaboracion de Productos de Confiteria', 'Produccion de confiteria', 'confitero', 1),
(2023017, 'Acuicultura', 'Acuicultor', 'Acuicultor', 1),
(2023018, 'Automatizacion de Sistemas Mecatronicos', 'Mecatronico', 'Mecatronico', 1),
(2023019, 'Comunicacion Comercial', 'Asesor Comercial', 'Asesor Comercial', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

DROP TABLE IF EXISTS `tipo_documento`;
CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `pk_id_tipo_doc` int NOT NULL,
  `tipo_doc_descripcion` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
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
  `tipo_usr_descripcion` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
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
  `pk_id_usr` bigint NOT NULL,
  `usr_nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usr_empresa` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usr_apellidos` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usr_telefono` bigint NOT NULL,
  `usr_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usr_rh` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usr_direccion` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usr_estrato` int DEFAULT NULL,
  `usr_ciudad` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usr_hv` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usr_contacto` int DEFAULT NULL,
  `usr_cargo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usr_fecha_nacimiento` date DEFAULT NULL,
  `usr_libreta_militar` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fk_id_ficha` int DEFAULT NULL,
  `fk_id_tipo_doc` int DEFAULT NULL,
  `fk_id_tipo_usr` int NOT NULL,
  `login_pass` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`pk_id_usr`),
  KEY `fk_Usuarios_Tipo_Usuarios` (`fk_id_tipo_usr`),
  KEY `fk_Usuarios_Tipo_Documento1` (`fk_id_tipo_doc`),
  KEY `fk_Usuarios_Ficha1` (`fk_id_ficha`),
  KEY `usr_empresa` (`usr_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`pk_id_usr`, `usr_nombre`, `usr_empresa`, `usr_apellidos`, `usr_telefono`, `usr_email`, `usr_rh`, `usr_direccion`, `usr_estrato`, `usr_ciudad`, `usr_hv`, `usr_contacto`, `usr_cargo`, `usr_fecha_nacimiento`, `usr_libreta_militar`, `fk_id_ficha`, `fk_id_tipo_doc`, `fk_id_tipo_usr`, `login_pass`, `foto`) VALUES
(74523456, 'Jesus David', NULL, 'Agudelo Linux', 3145678342, 'jesus@sena.com', 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, '$2y$07$AtG60OYJgHsO0Q2Z3ggqre7GEHQKlqwOleqY5A7pWjFCLUFg1rG2K', '../fotos/defecto.jpg'),
(102023225, 'Susana', NULL, 'rodriguez', 3141615241, 'empresa@ejemplo.com', 'B-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 4, '$2y$07$Z2k10SXVNJ986EJz8otr1O7IwiXaf/qf.TgYC07d3dx6.9hLi/xA.', '../fotos/defecto.jpg'),
(1002023101, 'Mateo', NULL, 'Gimenez', 31280917351, 'mateo@gimenez.com', 'AB-', NULL, NULL, NULL, NULL, NULL, 'administrador', NULL, NULL, NULL, 3, 2, '$2y$07$S962.6ezWt.dqhLwy.NFgeg.Q2LtDjEzGupUWawBB8MmU1Ijj9rZm', '../fotos/defecto.jpg'),
(1002023102, 'Simon', NULL, 'Parra', 3109271092, 'Simon@parra', 'B-', NULL, NULL, NULL, NULL, NULL, 'coordinador', NULL, NULL, NULL, 1, 2, '$2y$07$K9ykTt5sR6Sm/EmtqslEC.GnOexN3uwo1kwU5kNr2ZEMTjK4ctS0u', '../fotos/defecto.jpg'),
(1002023103, 'Armando', NULL, 'Marin', 3172819035, 'armando@marin', 'O+', NULL, NULL, NULL, NULL, NULL, 'Asistente', NULL, NULL, NULL, 1, 2, '$2y$07$hCva/fhqDaJMWv63bcdCO.57GisvQnL.9rJsJzYt6jRFHiuswFETa', '../fotos/defecto.jpg'),
(1002023104, 'Rafael ', NULL, 'Valencia', 3124512785, 'Rafael@valencia', 'B+', NULL, NULL, NULL, NULL, NULL, 'Asistente', NULL, NULL, NULL, 3, 2, '$2y$07$VZG5OeaPXc5VyEcse9B3i.zRQUDcO7RyojrWilc6.wpEUMMQbnk56', '../fotos/defecto.jpg'),
(1002023105, 'Samuel', NULL, 'Cuesta', 3102978290, 'samuel@cuesta.com', 'O+', NULL, NULL, NULL, NULL, NULL, 'Asistente', NULL, NULL, NULL, 3, 2, '$2y$07$y9WKdgw265ZwT8gzsh1gR.gVJEr/kH6klraAPk3xAj./dt5JWzT8u', '../fotos/defecto.jpg'),
(1002023106, 'Francisco', NULL, 'Acosta', 3120945167, 'Francisco@Acosta.com', 'AB+', NULL, NULL, NULL, NULL, NULL, 'Asistente', NULL, NULL, NULL, 3, 2, '$2y$07$p3EFcfd1llqijMm28t9fbuXkTycAUAD/TI12vORJe/GcPxhrf4fva', '../fotos/defecto.jpg'),
(1002023107, 'German', NULL, 'Pulido', 3102978102, 'german@pulido', 'B+', NULL, NULL, NULL, NULL, NULL, 'Asistente', NULL, NULL, NULL, 1, 2, '$2y$07$diPxkpJjfERAZgzxuBlFquyaYpSFScelzNJodtLFLy1SX8oCcr7di', '../fotos/defecto.jpg'),
(1002023108, 'Enrique ', NULL, 'Jimenez', 3190204671, 'enrique@jimenez.com', 'B-', NULL, NULL, NULL, NULL, NULL, 'Seguimiento Practica', NULL, NULL, NULL, 3, 2, '$2y$07$wR1P/kRveVb9N/AWV1m2JeD2cNl91P6wXnsCNZgM2Y./t6ovMGIdK', '../fotos/defecto.jpg'),
(1002023109, 'Diego', NULL, 'Taborda', 3019361019, 'diego@taborda', 'O+', NULL, NULL, NULL, NULL, NULL, 'Seguimiento Practica', NULL, NULL, NULL, 1, 2, '$2y$07$uVKpu5fvkeBVgD/w44oPeuS66Asx2XcKgY.j/lRU62buYgqjgIFna', '../fotos/defecto.jpg'),
(1002023110, 'Yohana', NULL, 'Gomez', 3156289019, 'Yohana@gomez.com', 'AB+', NULL, NULL, NULL, NULL, NULL, 'Secretaria', NULL, NULL, NULL, 3, 2, '$2y$07$yYva87uLqXTdefwBDATUv.boNARXcoFrptjQhBOGq2a5MmSjZkyZK', '../fotos/defecto.jpg'),
(1002023111, 'Julieth', NULL, 'Perez', 3172019204, 'julieth@perez.com', 'B-', NULL, NULL, NULL, NULL, NULL, 'Secretaria', NULL, NULL, NULL, 3, 2, '$2y$07$c1Juk6Zs19SkVzBvlkHkJesZvTT5jyffqvwpewPHm3LfuwB8Emn/K', '../fotos/defecto.jpg'),
(1002023112, 'Eliana', NULL, 'Palacio', 3204948201, 'eliana@palacio.com', 'B+', NULL, NULL, NULL, NULL, NULL, 'Secretaria', NULL, NULL, NULL, 3, 2, '$2y$07$Hjr4JMDysyDiO5YFqJtNMec2XFQkfpSPWtJIUgZukPfR27AqN4NaC', '../fotos/defecto.jpg'),
(1002023113, 'Francia', NULL, 'Quintana', 3180192610, 'francia@quintana.com', 'B+', NULL, NULL, NULL, NULL, NULL, 'Secretaria', NULL, NULL, NULL, 1, 2, '$2y$07$RalQD77nDPuJcnJZY9EbCOUnmUKjkYDviYcBjcHu4FGoCcuLRRXj.', '../fotos/defecto.jpg'),
(1002023114, 'Teresa', NULL, 'Rincon', 3192036194, 'teresa@rincon.com', 'A-', NULL, NULL, NULL, NULL, NULL, 'Secretaria', NULL, NULL, NULL, 3, 2, '$2y$07$/rCNa41sVHtsgcfuX2g7O.d/bn1vwDw1T5XN1tRnNKh2NcntjkKMS', '../fotos/defecto.jpg'),
(1002023115, 'Stella', NULL, 'Trujillo', 3157103957, 'stella@trujillo.com', 'B+', NULL, NULL, NULL, NULL, NULL, 'Secretaria', NULL, NULL, NULL, 1, 2, '$2y$07$vCHONtKEM4rHOMgRnEQ/vOycQ.4NcyFIQippOa7MlslC.NkGx50iC', '../fotos/defecto.jpg'),
(1002023116, 'Carolina', NULL, 'Paz', 3130185631, 'carolina@paz', 'B+', NULL, NULL, NULL, NULL, NULL, 'Secretaria', NULL, NULL, NULL, 3, 2, '$2y$07$UuQPI5VcWsNB9TpjPS2bouNU1YehAqJzHpPrcurI5ee1nV4XuUgRu', '../fotos/defecto.jpg'),
(1002023117, 'Alicia', NULL, 'Berrio', 3178104659, 'alicia@berrio.com', 'B+', NULL, NULL, NULL, NULL, NULL, 'Secretaria', NULL, NULL, NULL, 1, 2, '$2y$07$3ryw7BPoM9M7FBnRye69QuYC5CuohTwjlP.wWrPwIm4lMFYBhGoWe', '../fotos/defecto.jpg'),
(1002023118, 'Catalina', NULL, 'Meza', 3167102956, 'catalina@meza.com', 'A-', NULL, NULL, NULL, NULL, NULL, 'Secretaria', NULL, NULL, NULL, 1, 2, '$2y$07$L9IALKmGdyvZRzNL/LRDju.I9/mzvMRJ3PRmoVZSBt9k1dSTj8nAW', '../fotos/defecto.jpg'),
(1002023119, 'Ayda', NULL, 'Zapata', 3159381672, 'ayda@zapata.com', 'B+', NULL, NULL, NULL, NULL, NULL, 'Secretaria', NULL, NULL, NULL, 3, 2, '$2y$07$XBDqlypFcKflbMXUxw23iOzEQPcsSFUuciYF6PwvkiT1SE82Kmk3S', '../fotos/defecto.jpg'),
(1002023120, 'Silvia', NULL, 'Suarez', 3314728451, 'silvia@carmona.com', 'B+', NULL, NULL, NULL, NULL, NULL, 'Secretaria', NULL, NULL, NULL, 1, 2, '$2y$07$E6iOX32uscxw.q34glWN3..gSI5XRe.zQ/o1FivDhMGSmnTHsW6qi', '../fotos/defecto.jpg'),
(1002023201, 'Darwin', NULL, 'Yepes', 3146271819, 'darwin@yepes.com', 'AB-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 4, '$2y$07$L.wgF0zkvkmppOko.aDM0OnJynjqK0QrHGA16biYoq9v9tX1cZ5MG', '../fotos/defecto.jpg'),
(1002023202, 'Maria', NULL, 'Rojas', 3146278190, 'maria@rojas.com', 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, '$2y$07$LDL1xHn60d2atcFIxgrH5eggPvg1w8aucY/qJIvY44VLGGh1XvJ1G', '../fotos/defecto.jpg'),
(1002023203, 'Alexander', NULL, 'Soto', 3124526718, 'alex@soto.com', 'O-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 4, '$2y$07$dbzNDMbj/wKUP8j/yqVrnuLNf2IPObMT2rmkAmGHTn8776NFeZS4u', '../fotos/defecto.jpg'),
(1002023204, 'Erika ', NULL, 'Higuita', 3152672890, 'erika@higuita.com', 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, '$2y$07$2xSAKP4RiRhBkfC9eq37oebXIKhj.Gs99xH6UtFfLJapBe00oPufm', '../fotos/defecto.jpg'),
(1002023205, 'Antonio', NULL, 'Perez', 3142671890, 'antonio@perez.com', 'B-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, '$2y$07$XiS0mD2fH/qaKz2ukkdOL.ZiyT1RunQ8kk/Z17bfJcYI41wLi21Qe', '../fotos/defecto.jpg'),
(1002023206, 'Angeles', NULL, 'Ortiz', 3125671902, 'Angeles@ortiz.com', 'A-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 4, '$2y$07$S1J05EV2snADQw5bOHpc3OhR6Gq/Eaq70hpesmK1cb3iHyRB4gB7e', '../fotos/defecto.jpg'),
(1002023207, 'Ruben', NULL, 'Gallego', 3218901847, 'Ruben@gallego.com', 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, '$2y$07$11DU9C/ockqCLiUK46aVYOPofpwdknAzsjvNyL/3iLcDceqM53cCC', '../fotos/defecto.jpg'),
(1002023208, 'Rosario', NULL, 'Marquez', 3245162790, 'Rosario@marque.con', 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 4, '$2y$07$MTikHAJjsc.eSgbEBPSM5ufvPKo6yvDCr5W/NmocXbDSPZLHi16ca', '../fotos/defecto.jpg'),
(1002023209, 'Esteban', NULL, 'Vega', 3210295171, 'esteban@vega.com', 'A-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, '$2y$07$3u51P1n35I9hIg/r7RoEk.WLIXEuDSjviCBQmNw2CRYKYIUog2kvm', '../fotos/defecto.jpg'),
(1002023210, 'Maria', NULL, 'Suarez', 3167281901, 'maria@suarez', 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, '$2y$07$FZZTuLnQkzaI21vfJKf2/uaIywe7gmET2IrG1cKT3iPRrrZCoUMVy', '../fotos/defecto.jpg'),
(1002023211, 'Ramiro', NULL, 'Lara', 3189021902, 'ramiro@lara.com', 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 4, '$2y$07$PJMx4lMGvgwfTfdfAJnoWudIUD0c9TJD1ZUgIJKzAVL6vkHndRw4W', '../fotos/defecto.jpg'),
(1002023212, 'Lorena', NULL, 'Reyes', 3145271890, 'lorena@reyes.com', 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, '$2y$07$ZUn13gP2bjZg9p6GBxLzOedcoF0vBDsiVWBPYqkGSyh.00j5UYp9C', '../fotos/defecto.jpg'),
(1002023213, 'Milton', NULL, 'Delgado', 3157890921, 'milton@delgado.com', 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, '$2y$07$YWVn7MUP2q7ZgEqVFOqsqOgZO9o0EDbHWb6GvgIGQR5C4awIhmzWa', '../fotos/defecto.jpg'),
(1002023214, 'Susana', NULL, 'Benitez', 3189019288, 'susana@benitez.com', 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 4, '$2y$07$S3Ga8ASJmLWVBWoUMqsGKO9N3f5EW8T2zwyooKGE5Y8sy0K0uZqkG', '../fotos/defecto.jpg'),
(1002023215, 'Diomedes', NULL, 'Torres', 3156178921, 'diomedes@torres.com', 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, '$2y$07$NVWEyXlQtMtA5126kL425OZQQ6zSUbb0NoCnuXL.acI0i352pdqlO', '../fotos/defecto.jpg'),
(1002023216, 'Luisa', NULL, 'Romero', 3181029855, 'luisa@romero', 'B-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 4, '$2y$07$NDppDzqEPEs01oWFOLQVSuxoUdRcI/0nnvI7ky2S1D8zJODMuQo..', '../fotos/defecto.jpg'),
(1002023217, 'Yolanda', NULL, 'Ortiz', 3167812135, 'yolanda@ortiz', 'B-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, '$2y$07$1zFWrJzZLSofZFXQVnvRdOFuGwosTgm.9ZEhoJLPBMRYrUm5nRuOu', '../fotos/defecto.jpg'),
(1002023219, 'Daniela', NULL, 'Delgado', 3125672149, 'daniela@delgado.com', 'O-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 4, '$2y$07$xZFeXw7Sai5wSqVQ6P9EaO085nTQHBklMbITGInTQkb5B7LfOb8gO', '../fotos/defecto.jpg'),
(1002023220, 'Silvia', NULL, 'Carmona', 31627180295, 'silvia@carmona', 'B-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 4, '$2y$07$oOcAwGIic6NF2fRZR/0lZuEBU2TcREiNbkPPKJ4caFlXH58wq1N/q', '../fotos/defecto.jpg'),
(1002023222, 'Yeison', NULL, 'Grajales', 3162781028, 'Yeison@grajales.com', 'O-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, '$2y$07$ZRJKNkRj5J/QI6PwIJWY.e0uMjCxffaEJ1kpnMmgd.frxfszwxqfW', '../fotos/defecto.jpg'),
(1002023301, 'Cristian', NULL, 'Cruz', 3224582910, 'cristian@cruz.com', 'A+', 'calle pimienta nº 13-13', 3, 'manizales', 'si', NULL, NULL, '2000-11-14', 'NO', 2023001, 1, 1, '$2y$07$EWHZhnUFM6DSjdKJjaLUCOr7OF5MJfe3.LZ2XncP8UqFW4lq1GYbm', '../fotos/ch2.jpg'),
(1002023302, 'Angel', NULL, 'Lozano', 3227950195, 'angel@lozano.com', 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2023002, 2, 1, '$2y$07$GDSqc63EQfc/mKy/Jxl/su3I9gyYG87yeEeRZsKWH6mntIYF3ifpq', '../fotos/defecto.jpg'),
(1002023303, 'Paula', NULL, 'Valencia', 3120476582, 'paula@valencia.com', 'B-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2023003, 3, 1, '$2y$07$vsG6p21ldRBi4ehY.8wZpeMlk3Co67tGTPsmKucL1tGbjP66xlv8.', '../fotos/defecto.jpg'),
(1002023304, 'Cesar', NULL, 'Ruiz', 3105837391, 'cesar@ruiz.com', 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2023004, 1, 1, '$2y$07$3kZlGfLz/GWsveLUNMepJ.t3FOxdigCrTPyn3W/dLVGH1c4tTpH5O', '../fotos/defecto.jpg'),
(1002023305, 'Jesus', NULL, 'pueblo', 3125786362, 'jesus@pueblo.com', 'O-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2023005, 2, 1, '$2y$07$nzzLIXL2HZix5yKZa78eJOFNHsGukEp91yspJnml1lCx.D1.EFsfG', '../fotos/defecto.jpg'),
(1002023306, 'Daniel', NULL, 'Castro', 3175849201, 'danielgbt@pimienta2.com', 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2023006, 3, 1, '$2y$07$eESvOYKcwGrjZ3UINsNpH.R9fxXJzoxBf9Uzd1fxFgFBYlH82cvcG', '../fotos/defecto.jpg'),
(1002023307, 'Jenny', NULL, 'Galeano', 3156958291, 'jenny@galeano', 'A-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2023007, 1, 1, '$2y$07$ilDPJT10z2.D0QgXjpSZCu/9jTTReUneQABes/huIcgssL0Qvpy2G', '../fotos/defecto.jpg'),
(1002023308, 'Jhon', NULL, 'Hernandez', 3215742901, 'jhon@hernandez', 'AB-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2023008, 1, 1, '$2y$07$DeiGxWoKpYtqJqz/3aIFkeIYAglnSSPUzcKg4iwJ1VWwx8bYurZPu', '../fotos/defecto.jpg'),
(1002023309, 'Anderson', NULL, 'Gallego', 3146794031, 'anderson@gallego.com', 'B-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2023009, 2, 1, '$2y$07$C5Qab.G7ZHOYCpwKP39AxOwQuoUziMi39SYu3SFEutQjGyKqCNFa2', '../fotos/defecto.jpg'),
(1002023310, 'Victor', NULL, 'Marin', 3159305689, 'victor@marin.com', 'B-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20230010, 3, 1, '$2y$07$vfjl3eDgJWCW2VgO76dDx.fROOoCYzdhgJJndIPLKuM9cVCNxKlTK', '../fotos/defecto.jpg'),
(1002023311, 'Daniel ', NULL, 'Tabares', 3156793102, 'daniel@tabares', 'A-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20230011, 1, 1, '$2y$07$yaO6iY22IkT.xUneVSF21ODtNURquEN4EHZsLg4REF9S55hQFgMsK', '../fotos/defecto.jpg'),
(1002023312, 'Martha', NULL, 'Pardo', 3189204726, 'martha@pardo.com', 'B-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20230012, 2, 1, '$2y$07$feWBjR3Tje8aNzNLSh37p.F5.MbZGco6U.HWFt.JyvRTP3pexyOxy', '../fotos/defecto.jpg'),
(1002023313, 'Milena', NULL, 'Acevedo', 3148290195, 'milena@acevedo.com', 'A+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20230013, 1, 1, '$2y$07$owZjcVOejtNuxabTwgdZnuTb2t.AoFlnUSjPHrzfm5ZmVQlytN0J2', '../fotos/defecto.jpg'),
(1002023314, 'Katherine ', NULL, 'Duran', 3179829019, 'katherine@duran.com', 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20230014, 3, 1, '$2y$07$Tb0Tff79zHtuxXj3CykCiuduSEC1fCOmIHYl7JJOApu1I4kQL6vRG', '../fotos/defecto.jpg'),
(1002023315, 'Alejandra', NULL, 'Cardona', 3125639103, 'alejandra@cardona.com', 'O+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20230015, 2, 1, '$2y$07$TAbH.q8w0T8DfmavyTcPvOGrnXvL84PbVF0sqElNitfFpyuJe9QRK', '../fotos/defecto.jpg'),
(1002023316, 'Susana', NULL, 'Bolaños', 3255749102, 'susana@bolan.com', 'AB+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20230016, 3, 1, '$2y$07$.NlZQsbHefCkRkQhYuWzre7KCgg0sGTpfR6OS1ULH.BGbrAmjAXf.', '../fotos/defecto.jpg'),
(1002023317, 'Monica', NULL, 'Rendon', 3146271892, 'monica@rendon.com', 'O-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20230017, 3, 1, '$2y$07$jNpYA9xPKolfQzDBTslKG.MfyNEP4cp7b.VjPpQvnqD1M25Yvjlzi', '../fotos/defecto.jpg'),
(1002023318, 'Liliana', NULL, 'Tamayo', 3105874931, 'liliana@tamayo.com', 'B+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20230018, 1, 1, '$2y$07$lVqCFu23ICG5deqy43jJA.v9bn2AYFTCZ1fdBd754vzNxDRUcTW0q', '../fotos/defecto.jpg'),
(1002023319, 'Ana', NULL, 'Botero', 3019389457, 'ana@botero', 'A-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20230019, 2, 1, '$2y$07$anbfTNtfxLW1.MJyW9V9k.gr8qRpOOqrG4zodeDi91LTYLgZsYaU.', '../fotos/defecto.jpg'),
(1002636272, 'Brayan', NULL, 'Garcia Useda', 3148928562, 'brayan@gmail.com', 'O+', 'cr 32a #32-14', 1, 'manizales', 'si', NULL, NULL, '2001-04-30', 'NO', 2342583, 1, 1, '$2y$07$52IEzm3HsiFwdeiQsqoDSelyA1Jp9rQtdigaHDwy8OJZCHEZnmoK6', '../fotos/foto 2.jpg'),
(1002636273, 'Brayan', NULL, 'Garcia Useda', 3148928562, 'brayang0430@gmail.com', 'O+', NULL, NULL, NULL, NULL, NULL, 'ADMINISTRADOR', NULL, NULL, NULL, 1, 2, '$2y$07$7BDZ64q2kOk6eubgjMNS3uP.PuEHKyXTWTHdhdQs3XX3Trl4tyxHC', '../fotos/trav1.jpg'),
(8908009994, 'David', 'Prometalicos', 'Ramirez', 3145674567, 'david@pro.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$I9Wo/cI5wtZ6MbVhV2mY4OXnRxi2LjCM.rZtcC/iZiZrZSR/e3tFi', ''),
(9002023301, 'Viviana', 'Colgas', 'Miranda', 3128493057, 'Viviana@colgas.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$ibl.XeoNmuqrA0vzRdG21O1ZX.dezy33jfKjMfGDe.Iq9bZOChulO', ''),
(9002023302, 'Giovanny', 'Hp', 'Quintana', 3168920192, 'Giovanny@hp.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$oTrfPzV/gDYTTJpUL/JueudCru/h0vzWHgIhCfiVzlSOpWps.eunG', ''),
(9002023303, 'Didier', 'Colombina', 'cano', 3142856478, 'didier@colombina.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$GXnZUfOzsgvOFEN7OW1JrO3ycY6X2ycOYwM1isKqqvETr.RFgVoXK', ''),
(9002023304, 'Esteban', 'Postobon', 'Jimenez', 3175839019, 'esteban@postobon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$LkBGr/0QXfGkVZfLyFdGcO9IqOOtRnDKR4BaMKcg.WDJwhtAHQoye', ''),
(9002023305, 'Sonia', 'Bavaria', 'Cortes', 3125281057, 'sonia@bavaria.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$swfo55V75z5iVoD/TR4kpebD93glspHo5E/F1bNjvg7LKE4NzV74S', ''),
(9002023306, 'David', 'El pais', 'Ortega', 3190294719, 'david@elpais.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$cLQDxps1VuewoB34j1lw1OcCaenioU3449Pdc.tftSGTWfA3FLE3O', ''),
(9002023307, 'Marlon', 'Ecopetrol', 'Tovar', 3182950471, 'marlon@ecopetrol.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$Yyxn77eXSFJ8TgddOPeG6eM7OLW6qXd0YyzjdePIHUCJUgmSWZg/W', ''),
(9002023308, 'Walter ', 'Imusa', 'Pacheco', 3185391032, 'walter@imusa.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$g4NjHkYBesxMigdU9Gal/uD9O9nXJ00C9/wcVrtEoCgSiyMEmrrte', ''),
(9002023309, 'James', 'Compumax', 'Guerrero', 3183451781, 'james@compumax.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$UrkmTSIIHIjqgfgdxfE8V.zxdysFOzL34U8eELrWfIWfbk4r5neKO', ''),
(9002023310, 'James', 'Compumax', 'Guerrero', 3183451781, 'james@compumax.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$z8tqK6wWQdjQZeY4wRTnIOI8W1S9j.ZjWJkLKKJ/SRPO8rZw3VAnO', ''),
(9002023311, 'Gabriel', 'Servientrega', 'Marquez', 3167349201, 'gabriel@servientrega.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$YSsKw/rNnO5Ag19vskzcwOwBFBI7JwjUhl2nXDkR3O61.WC5d32Cq', ''),
(9002023312, 'Alvaro', 'Kokorico', 'Muñoz', 3126481902, 'alvaro@kokorico.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$CUXcLoigI6BGiewGFI4Dt.gS2JptNQ1gzoiSNm8oqr4zXvuCZBNRC', ''),
(9002023313, 'daniel', 'Frisby', 'Bonilla', 3164729105, 'daniel@frisby.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$1FllFMCKvtRbe18IZyJQkOQikI.aEHY0XD/6CmVZ5bpt7y14cG.9u', ''),
(9002023314, 'Carmen', 'Sura EPS', 'Ayala', 3174830195, 'carmen@sura.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$RT2mCGFx4PsiSeS22VIKLuK9kL.R.htWef8Kn6G4OxJdYMbOap9dW', ''),
(9002023315, 'Sandra', 'Claro', 'Robles', 3106745209, 'sandra@claro.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$weyhZ/5kvP6Ge5WdDmG4yOHDLCVqemxtSflurUaHZfajuA5DkqD32', ''),
(9002023316, 'Mariana', 'Movistar', 'Holguin', 3146182956, 'mariana@movistar.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$lNVoKf7FCkSv9uCQn.JL4eoq9v//K8SsBlgsEJ0x49pM9YqS0Xjsu', ''),
(9002023317, 'Silvia', 'Homecenter', 'Rocha', 3148291056, 'silvia@homecenter.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$S3gCXDx1Dhar53.8FIoS9O/dz56nNDdDkIM8mmwxrgHGtXcI/Bb4G', ''),
(9002023318, 'Blanca', 'Carulla', 'Soto', 3124527189, 'blanca@carulla.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$T2icyd6BU2gUaiSe/lABKO7ZvFQyY2Qd/lLM1HpMGtRyovUis4is2', ''),
(9002023319, 'Yeni', 'Cinemark', 'Vallejo', 3202859420, 'yeni@cinemark.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$vay4Li3BRWigeX5RvXPbsOJN4Gv56ZfpI2R5pr9yV2VseOECfrm7q', ''),
(9002023320, 'Maria', 'empresaa', 'cruz', 316829127, 'maria@rojas.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '$2y$07$2BfXDxQaUtfp7FGz0yEjAejIjalz2fvN29PqgXV8uPNgJrM4wknre', ''),
(10020232180, 'Gonzalo', NULL, 'Bravo', 3125678901, 'gonzalo@bravo.com', 'AB-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, '$2y$07$KccubIPMtO1K56caXBjBPeCI6LaeMnowZcEWdzEHXYHxbkfA00092', '../fotos/defecto.jpg');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empresaaprendiz`
--
ALTER TABLE `empresaaprendiz`
  ADD CONSTRAINT `empresaaprendiz_ibfk_1` FOREIGN KEY (`fk_id_empresa`) REFERENCES `usuarios` (`pk_id_usr`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empresaaprendiz_ibfk_2` FOREIGN KEY (`fk_id_aprendiz`) REFERENCES `usuarios` (`pk_id_usr`) ON DELETE CASCADE ON UPDATE CASCADE;

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
