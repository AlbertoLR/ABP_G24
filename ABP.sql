-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 30-12-2017 a las 18:48:10
-- Versión del servidor: 10.1.26-MariaDB-0+deb9u1
-- Versión de PHP: 7.0.19-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ABP`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Accion`
--

CREATE TABLE `Accion` (
  `idAccion` int(11) NOT NULL,
  `nombreAc` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Accion`
--

INSERT INTO `Accion` (`idAccion`, `nombreAc`) VALUES
(1, 'alta'),
(2, 'baja'),
(3, 'modificacion'),
(4, 'consulta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AccionControlador`
--

CREATE TABLE `AccionControlador` (
  `idControlador` int(11) NOT NULL,
  `idAccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Actividad`
--

CREATE TABLE `Actividad` (
  `Id_Actividad` int(11) NOT NULL,
  `Nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Sala` int(10) UNSIGNED NOT NULL,
  `Capacidad` int(10) UNSIGNED NOT NULL,
  `HoraInicio` time NOT NULL,
  `HoraFin` time NOT NULL,
  `Dia` enum('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado') NOT NULL,
  `Id_Recurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Actividad`
--

INSERT INTO `Actividad` (`Id_Actividad`, `Nombre`, `Sala`, `Capacidad`, `HoraInicio`, `HoraFin`, `Dia`, `Id_Recurso`) VALUES
(1, 'Juegos', 3, 50, '16:00:00', '18:00:00', 'Viernes', 0),
(2, 'Baile', 5, 30, '18:00:00', '20:00:00', 'Jueves', 0),
(3, 'Escape Room', 4, 4, '17:00:00', '18:00:00', 'Martes', 0),
(4, 'Spinning', 5, 6, '16:00:00', '18:00:00', 'Lunes', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AsignacionTabla`
--

CREATE TABLE `AsignacionTabla` (
  `idUsuario` int(11) NOT NULL,
  `idTabla` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `AsignacionTabla`
--

INSERT INTO `AsignacionTabla` (`idUsuario`, `idTabla`) VALUES
(3, 1),
(3, 2),
(4, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Asistencia`
--

CREATE TABLE `Asistencia` (
  `Usuario_idUsuario` int(11) NOT NULL,
  `Actividad_idActividad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Controlador`
--

CREATE TABLE `Controlador` (
  `idControlador` int(11) NOT NULL,
  `nombreCt` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Controlador`
--

INSERT INTO `Controlador` (`idControlador`, `nombreCt`) VALUES
(1, 'Controlador'),
(2, 'Accion'),
(3, 'Sesion'),
(4, 'Ejercicio'),
(5, 'Tabla'),
(6, 'Usuario'),
(7, 'PerfilUsuario'),
(8, 'Actividad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ejercicio`
--

CREATE TABLE `Ejercicio` (
  `idEjercicio` int(11) NOT NULL,
  `nombreEj` varchar(45) NOT NULL,
  `descripcionEj` varchar(45) DEFAULT NULL,
  `tipoEj` enum('aerobico','anaerobico','mixto') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Ejercicio`
--

INSERT INTO `Ejercicio` (`idEjercicio`, `nombreEj`, `descripcionEj`, `tipoEj`) VALUES
(1, 'abdominal', 'Baja tripa', 'aerobico'),
(2, 'flexion', 'besa el suelo', 'aerobico'),
(3, 'sentadilla', 'mueve el culo', 'anaerobico'),
(4, 'marcha', 'circula leñe', 'anaerobico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EjercicioTabla`
--

CREATE TABLE `EjercicioTabla` (
  `idTabla` int(11) NOT NULL,
  `idEjercicio` int(11) NOT NULL,
  `tiempo` varchar(30) DEFAULT NULL,
  `repeticion` int(11) DEFAULT NULL,
  `serie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PerfilUsuario`
--

CREATE TABLE `PerfilUsuario` (
  `Id_PerfilUsuario` int(11) NOT NULL,
  `Tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `PerfilUsuario`
--

INSERT INTO `PerfilUsuario` (`Id_PerfilUsuario`, `Tipo`) VALUES
(1, 'Administrador'),
(2, 'Entrenador'),
(3, 'UsuarioPEF'),
(4, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Permiso`
--

CREATE TABLE `Permiso` (
  `idPerfilUsuario` int(11) NOT NULL,
  `idControlador` int(11) NOT NULL,
  `AccidAccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Recurso`
--

CREATE TABLE `Recurso` (
  `Id_Recurso` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Capacidad` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Recurso`
--

INSERT INTO `Recurso` (`Id_Recurso`, `Nombre`, `Capacidad`) VALUES
(1, 'Sala Spinning', 30),
(2, 'Sala Spinning', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sesion`
--

CREATE TABLE `Sesion` (
  `idSesion` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idTabla` int(11) NOT NULL,
  `nombreSesion` varchar(45) NOT NULL,
  `horaInicio` datetime NOT NULL,
  `horaFin` datetime NOT NULL,
  `comentario` varchar(140) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Sesion`
--

INSERT INTO `Sesion` (`idSesion`, `idUsuario`, `idTabla`, `nombreSesion`, `horaInicio`, `horaFin`, `comentario`) VALUES
(1, 3, 1, 'abdominal tabla 1', '2015-12-01 16:00:00', '2015-12-01 16:20:00', 'como cansa esto'),
(2, 3, 1, 'sentadillas tabla 1', '2015-12-01 18:00:00', '2015-12-01 18:15:00', 'me duelen las piernas'),
(3, 4, 2, 'flexiones tabla 2', '2016-10-01 17:00:00', '2016-10-01 17:20:00', ' ay mi tripita'),
(4, 4, 2, 'marcha tabla 2', '2016-11-01 16:00:00', '2016-11-01 18:00:00', 'no aguanto mas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tabla`
--

CREATE TABLE `Tabla` (
  `idTabla` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `tipoTabla` enum('Predeterminada','Personalizada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Tabla`
--

INSERT INTO `Tabla` (`idTabla`, `nombre`, `tipoTabla`) VALUES
(1, 'Tabla Basica 1', 'Predeterminada'),
(2, 'Tabla Basica 2', 'Predeterminada'),
(3, 'Tabla Personalizada 1', 'Personalizada'),
(4, 'Tabla Personalizada 2', 'Personalizada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `Id_usuario` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `Id_PerfilUsuario` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `Id_entrenador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`Id_usuario`, `Nombre`, `DNI`, `Id_PerfilUsuario`, `password`,`Id_entrenador`) VALUES
(1, 'Alberto', '44488826H', 1, 'cambiame',NULL),
(2, 'Samuel', '46573898J', 2, 'cambiame',NULL),
(3, 'Iago', '12345678K', 3, 'cambiame',2),
(4, 'Amparo', '87654321J', 4, 'cambiame',2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Accion`
--
ALTER TABLE `Accion`
  ADD PRIMARY KEY (`idAccion`);

--
-- Indices de la tabla `AccionControlador`
--
ALTER TABLE `AccionControlador`
  ADD PRIMARY KEY (`idControlador`,`idAccion`),
  ADD KEY `fk_Controlador_has_AccionControlador_AccionControlador1_idx` (`idAccion`),
  ADD KEY `fk_Controlador_has_AccionControlador_Controlador1_idx` (`idControlador`);

--
-- Indices de la tabla `Actividad`
--
ALTER TABLE `Actividad`
  ADD PRIMARY KEY (`Id_Actividad`),
  ADD KEY `Id_Recurso` (`Id_Recurso`);

--
-- Indices de la tabla `AsignacionTabla`
--
ALTER TABLE `AsignacionTabla`
  ADD PRIMARY KEY (`idUsuario`,`idTabla`),
  ADD KEY `fk_Usuario_has_Tabla_Tabla1_idx` (`idTabla`),
  ADD KEY `fk_Usuario_has_Tabla_Usuario1_idx` (`idUsuario`);

--
-- Indices de la tabla `Asistencia`
--
ALTER TABLE `Asistencia`
  ADD PRIMARY KEY (`Usuario_idUsuario`,`Actividad_idActividad`),
  ADD KEY `fk_Usuario_has_Actividad_Actividad1_idx` (`Actividad_idActividad`),
  ADD KEY `fk_Usuario_has_Actividad_Usuario1_idx` (`Usuario_idUsuario`);

--
-- Indices de la tabla `Controlador`
--
ALTER TABLE `Controlador`
  ADD PRIMARY KEY (`idControlador`);

--
-- Indices de la tabla `Ejercicio`
--
ALTER TABLE `Ejercicio`
  ADD PRIMARY KEY (`idEjercicio`);

--
-- Indices de la tabla `EjercicioTabla`
--
ALTER TABLE `EjercicioTabla`
  ADD PRIMARY KEY (`idTabla`,`idEjercicio`),
  ADD KEY `fk_Tabla_has_Ejercicio_Ejercicio1_idx` (`idEjercicio`),
  ADD KEY `fk_Tabla_has_Ejercicio_Tabla1_idx` (`idTabla`);

--
-- Indices de la tabla `PerfilUsuario`
--
ALTER TABLE `PerfilUsuario`
  ADD PRIMARY KEY (`Id_PerfilUsuario`);

--
-- Indices de la tabla `Permiso`
--
ALTER TABLE `Permiso`
  ADD PRIMARY KEY (`idPerfilUsuario`,`idControlador`,`AccidAccion`),
  ADD KEY `fk_PerfilUsuario_has_AccionControlador_AccionControlador1_idx` (`idControlador`,`AccidAccion`),
  ADD KEY `fk_PerfilUsuario_has_AccionControlador_PerfilUsuario1_idx` (`idPerfilUsuario`);

--
-- Indices de la tabla `Recurso`
--
ALTER TABLE `Recurso`
  ADD PRIMARY KEY (`Id_Recurso`);

--
-- Indices de la tabla `Sesion`
--
ALTER TABLE `Sesion`
  ADD PRIMARY KEY (`idSesion`),
  ADD KEY `fk_Sesion_AsignacionTabla1_idx` (`idUsuario`,`idTabla`);

--
-- Indices de la tabla `Tabla`
--
ALTER TABLE `Tabla`
  ADD PRIMARY KEY (`idTabla`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`Id_usuario`),
  ADD KEY `fk_Usuario_PerfilUsuario_idx` (`Id_PerfilUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Accion`
--
ALTER TABLE `Accion`
  MODIFY `idAccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `Actividad`
--
ALTER TABLE `Actividad`
  MODIFY `Id_Actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `Controlador`
--
ALTER TABLE `Controlador`
  MODIFY `idControlador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `Ejercicio`
--
ALTER TABLE `Ejercicio`
  MODIFY `idEjercicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `PerfilUsuario`
--
ALTER TABLE `PerfilUsuario`
  MODIFY `Id_PerfilUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `Recurso`
--
ALTER TABLE `Recurso`
  MODIFY `Id_Recurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `Sesion`
--
ALTER TABLE `Sesion`
  MODIFY `idSesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `Tabla`
--
ALTER TABLE `Tabla`
  MODIFY `idTabla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `Id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `AccionControlador`
--
ALTER TABLE `AccionControlador`
  ADD CONSTRAINT `fk_Controlador_has_AccionControlador_AccionControlador1` FOREIGN KEY (`idAccion`) REFERENCES `Accion` (`idAccion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Controlador_has_AccionControlador_Controlador1` FOREIGN KEY (`idControlador`) REFERENCES `Controlador` (`idControlador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `AsignacionTabla`
--
ALTER TABLE `AsignacionTabla`
  ADD CONSTRAINT `fk_Usuario_has_Tabla_Tabla1` FOREIGN KEY (`idTabla`) REFERENCES `Tabla` (`idTabla`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_has_Tabla_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`Id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Asistencia`
--
ALTER TABLE `Asistencia`
  ADD CONSTRAINT `fk_Usuario_has_Actividad_Actividad1` FOREIGN KEY (`Actividad_idActividad`) REFERENCES `Actividad` (`Id_Actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_has_Actividad_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `Usuario` (`Id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `EjercicioTabla`
--
ALTER TABLE `EjercicioTabla`
  ADD CONSTRAINT `fk_Tabla_has_Ejercicio_Ejercicio1` FOREIGN KEY (`idEjercicio`) REFERENCES `Ejercicio` (`idEjercicio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tabla_has_Ejercicio_Tabla1` FOREIGN KEY (`idTabla`) REFERENCES `Tabla` (`idTabla`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Permiso`
--
ALTER TABLE `Permiso`
  ADD CONSTRAINT `fk_PerfilUsuario_has_AccionControlador_AccionControlador1` FOREIGN KEY (`idControlador`,`AccidAccion`) REFERENCES `AccionControlador` (`idControlador`, `idAccion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PerfilUsuario_has_AccionControlador_PerfilUsuario1` FOREIGN KEY (`idPerfilUsuario`) REFERENCES `PerfilUsuario` (`Id_PerfilUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Sesion`
--
ALTER TABLE `Sesion`
  ADD CONSTRAINT `fk_Sesion_AsignacionTabla1` FOREIGN KEY (`idUsuario`,`idTabla`) REFERENCES `AsignacionTabla` (`idUsuario`, `idTabla`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `fk_Usuario_PerfilUsuario` FOREIGN KEY (`Id_PerfilUsuario`) REFERENCES `PerfilUsuario` (`Id_PerfilUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
