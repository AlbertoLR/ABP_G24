
-- Model: New Model    Version: 1.0


SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema ABP
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `ABP` ;

-- -----------------------------------------------------
-- Schema ABP
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ABP` DEFAULT CHARACTER SET utf8 ;
USE `ABP` ;

-- -----------------------------------------------------
-- Table `PerfilUsuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PerfilUsuario` ;

CREATE TABLE IF NOT EXISTS `PerfilUsuario` (
  `Id_PerfilUsuario` INT NOT NULL AUTO_INCREMENT,
  `Tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Id_PerfilUsuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Usuario` ;

CREATE TABLE IF NOT EXISTS `Usuario` (
  `Id_usuario` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `DNI` VARCHAR(9) NOT NULL,
  `Telefono` int(12) NOT NULL,
  `Id_PerfilUsuario` INT NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  `Id_entrenador` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_usuario`),
  CONSTRAINT `fk_Usuario_PerfilUsuario`
    FOREIGN KEY (`Id_PerfilUsuario`)
    REFERENCES `PerfilUsuario` (`Id_PerfilUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_Usuario`
	FOREIGN KEY (`Id_entrenador`)
	REFERENCES `Usuario` (`Id_usuario`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Usuario_PerfilUsuario_idx` ON `Usuario` (`Id_PerfilUsuario` ASC);

CREATE INDEX `fk_Usuario_Usuario_idx` ON `Usuario` (`Id_entrenador` ASC);

-- -----------------------------------------------------
-- Table `Recurso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Recurso`;

CREATE TABLE `Recurso` (
  `Id_Recurso` INT(11) NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(20) NOT NULL,
  `Capacidad` INT(20) NOT NULL,
  PRIMARY KEY (`Id_Recurso`))
ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `Actividad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Actividad` ;

CREATE TABLE IF NOT EXISTS `Actividad` (
  `Id_Actividad` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  `Id_Recurso` INT(11) NOT NULL,
  `Capacidad` INT(10) UNSIGNED NOT NULL,
  `HoraInicio` TIME(0) NOT NULL,
  `HoraFin` TIME(0) NOT NULL,
  `Dia` ENUM('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado') NOT NULL,
  PRIMARY KEY (`Id_Actividad`),
  CONSTRAINT `fk_Actividad_Recurso`
	FOREIGN KEY (`Id_Recurso`)
	REFERENCES `Recurso` (`Id_Recurso`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Actividad_Recurso_idx` ON `Actividad` (`Id_Recurso` ASC);

-- -----------------------------------------------------
-- Table `Inscripcion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Inscripcion` ;

CREATE TABLE IF NOT EXISTS `Inscripcion` (
  `Usuario_idUsuario` INT NOT NULL,
  `Actividad_idActividad` INT NOT NULL,
  PRIMARY KEY (`Usuario_idUsuario`, `Actividad_idActividad`),
  CONSTRAINT `fk_Usuario_has_Actividad_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `Usuario` (`Id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_has_Actividad_Actividad1`
    FOREIGN KEY (`Actividad_idActividad`)
    REFERENCES `Actividad` (`id_Actividad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Usuario_has_Actividad_Actividad1_idx` ON `Inscripcion` (`Actividad_idActividad` ASC);

CREATE INDEX `fk_Usuario_has_Actividad_Usuario1_idx` ON `Inscripcion` (`Usuario_idUsuario` ASC);


-- -----------------------------------------------------
-- Table `Asistencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Asistencia` ;

CREATE TABLE IF NOT EXISTS `Asistencia` (
  `idUsuario` INT NOT NULL,
  `idActividad` INT NOT NULL,
  `Presencia` BOOLEAN NOT NULL,
  PRIMARY KEY (`idUsuario`, `idActividad`, `Presencia`),
  CONSTRAINT `fk_Usuario_has_Actividad_Inscripcion`
    FOREIGN KEY (`idUsuario` , `idActividad`)
    REFERENCES `Inscripcion` (`Usuario_idUsuario` , `Actividad_idActividad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Usuario_has_Actividad_Inscripcion_idx` ON `Asistencia` (`idUsuario` ASC, `idActividad` ASC);


-- -----------------------------------------------------
-- Table `Controlador`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Controlador` ;

CREATE TABLE IF NOT EXISTS `Controlador` (
  `idControlador` INT NOT NULL AUTO_INCREMENT,
  `nombreCt` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idControlador`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Accion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Accion` ;

CREATE TABLE IF NOT EXISTS `Accion` (
  `idAccion` INT NOT NULL AUTO_INCREMENT,
  `nombreAc` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idAccion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AccionControlador`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AccionControlador` ;

CREATE TABLE IF NOT EXISTS `AccionControlador` (
  `idControlador` INT NOT NULL,
  `idAccion` INT NOT NULL,
  PRIMARY KEY (`idControlador`, `idAccion`),
  CONSTRAINT `fk_Controlador_has_AccionControlador_Controlador1`
    FOREIGN KEY (`idControlador`)
    REFERENCES `Controlador` (`idControlador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Controlador_has_AccionControlador_AccionControlador1`
    FOREIGN KEY (`idAccion`)
    REFERENCES `Accion` (`idAccion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Controlador_has_AccionControlador_AccionControlador1_idx` ON `AccionControlador` (`idAccion` ASC);

CREATE INDEX `fk_Controlador_has_AccionControlador_Controlador1_idx` ON `AccionControlador` (`idControlador` ASC);


-- -----------------------------------------------------
-- Table `Permiso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Permiso` ;

CREATE TABLE IF NOT EXISTS `Permiso` (
  `idPerfilUsuario` INT NOT NULL,
  `idControlador` INT NOT NULL,
  `AccidAccion` INT NOT NULL,
  PRIMARY KEY (`idPerfilUsuario`, `idControlador`, `AccidAccion`),
  CONSTRAINT `fk_PerfilUsuario_has_AccionControlador_PerfilUsuario1`
    FOREIGN KEY (`idPerfilUsuario`)
    REFERENCES `PerfilUsuario` (`Id_PerfilUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PerfilUsuario_has_AccionControlador_AccionControlador1`
    FOREIGN KEY (`idControlador` , `AccidAccion`)
    REFERENCES `AccionControlador` (`idControlador` , `idAccion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_PerfilUsuario_has_AccionControlador_AccionControlador1_idx` ON `Permiso` (`idControlador` ASC, `AccidAccion` ASC);

CREATE INDEX `fk_PerfilUsuario_has_AccionControlador_PerfilUsuario1_idx` ON `Permiso` (`idPerfilUsuario` ASC);


-- -----------------------------------------------------
-- Table `Tabla`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Tabla` ;

CREATE TABLE IF NOT EXISTS `Tabla` (
  `idTabla` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `tipoTabla` ENUM('Predeterminada', 'Personalizada') NOT NULL,
  PRIMARY KEY (`idTabla`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Sesion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Sesion` ;

DROP TABLE IF EXISTS `Sesion` ;

CREATE TABLE IF NOT EXISTS `Sesion` (
  `idSesion` INT NOT NULL AUTO_INCREMENT,
  `idUsuario` INT NOT NULL,
  `idTabla` INT NOT NULL,
  `nombreSesion` VARCHAR(45) NOT NULL,
  `horaInicio` DATETIME NOT NULL,
  `duracion` TIME NOT NULL,
  `comentario` VARCHAR(140) NULL,
  PRIMARY KEY (`idSesion`),
  CONSTRAINT `fk_Sesion_AsignacionTabla1`
    FOREIGN KEY (`idUsuario` , `idTabla`)
    REFERENCES `AsignacionTabla` (`idUsuario` , `idTabla`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Sesion_AsignacionTabla1_idx` ON `Sesion` (`idUsuario` ASC, `idTabla` ASC);


-- -----------------------------------------------------
-- Table `AsignacionTabla`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AsignacionTabla` ;

CREATE TABLE IF NOT EXISTS `AsignacionTabla` (
  `idUsuario` INT NOT NULL,
  `idTabla` INT NOT NULL,
  PRIMARY KEY (`idUsuario`, `idTabla`),
  CONSTRAINT `fk_Usuario_has_Tabla_Usuario1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `Usuario` (`Id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_has_Tabla_Tabla1`
    FOREIGN KEY (`idTabla`)
    REFERENCES `Tabla` (`idTabla`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Usuario_has_Tabla_Tabla1_idx` ON `AsignacionTabla` (`idTabla` ASC);

CREATE INDEX `fk_Usuario_has_Tabla_Usuario1_idx` ON `AsignacionTabla` (`idUsuario` ASC);


-- -----------------------------------------------------
-- Table `Ejercicio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Ejercicio` ;

CREATE TABLE IF NOT EXISTS `Ejercicio` (
  `idEjercicio` INT NOT NULL AUTO_INCREMENT,
  `nombreEj` VARCHAR(45) NOT NULL,
  `descripcionEj` VARCHAR(45) NULL,
  `tipoEj` ENUM('aerobico','anaerobico','mixto') NOT NULL,
  PRIMARY KEY (`idEjercicio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `EjercicioTabla`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `EjercicioTabla` ;

CREATE TABLE IF NOT EXISTS `EjercicioTabla` (
  `idTabla` INT NOT NULL,
  `idEjercicio` INT NOT NULL,
  `tiempo` TIME(0),
  `repeticion` INT,
  `serie` INT,
  PRIMARY KEY (`idTabla`, `idEjercicio`),
  CONSTRAINT `fk_Tabla_has_Ejercicio_Tabla1`
    FOREIGN KEY (`idTabla`)
    REFERENCES `Tabla` (`idTabla`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tabla_has_Ejercicio_Ejercicio1`
    FOREIGN KEY (`idEjercicio`)
    REFERENCES `Ejercicio` (`idEjercicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tabla_has_Ejercicio_Ejercicio1_idx` ON `EjercicioTabla` (`idEjercicio` ASC);

CREATE INDEX `fk_Tabla_has_Ejercicio_Tabla1_idx` ON `EjercicioTabla` (`idTabla` ASC);


-- ---------------------------------------------------------
-- Table Notificacion
-- ---------------------------------------------------------
DROP TABLE IF EXISTS `Notificacion`;

CREATE TABLE IF NOT EXISTS `Notificacion` (
	`idNotificacion` INT NOT NULL AUTO_INCREMENT,
	`idUsuario` INT NOT NULL,
	`titulo` VARCHAR(80) NOT NULL,
	`txtNotificacion` VARCHAR(500),
	PRIMARY KEY (`idNotificacion`),
	CONSTRAINT `fk_Notificacion_Usuario`
		FOREIGN KEY (`idUsuario`)
		REFERENCES `Usuario` (`Id_usuario`)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Notificacion_Usuario_idx` ON `Notificacion` (`idUsuario` ASC);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


-- ---------------------------------------------------

--
-- dumping data for table `PerfilUsuario`
--

insert into `PerfilUsuario` (`Id_PerfilUsuario`, `Tipo`) values
(1, 'Administrador'),
(2, 'Entrenador'),
(3, 'UsuarioPEF'),
(4, 'UsuarioTDU');


--
-- dumping data for table `Usuario`
--

INSERT INTO `Usuario` (`Id_usuario`, `Nombre`, `Apellido`, `DNI`, `Telefono`, `Id_PerfilUsuario`, `password`, `Id_entrenador`) VALUES
(1, 'Alberto', 'Lopez Rodriguez', '44488826H', 666123456, 1, 'cambiame', NULL),
(2, 'Samuel', 'Gonzalez Veloso', '46573898J', 666987654, 2, 'cambiame', NULL),
(3, 'Iago', 'Novoa Gonzalez', '12345678K', 988123456, 3, 'cambiame', 2),
(4, 'Amparo', 'Lopez Lopez', '87654321J', 988987654, 3, 'cambiame', 2),
(5, 'Pedro', 'Martinez Morales', '35581709V', 600123456, 4, 'cambiame', NULL),
(6, 'Ana', 'Suarez Suarez', '45454545B', 600654321, 2, 'cambiame', NULL);

--
-- dumping data for table `Controlador`
--

insert into `Controlador` (`idControlador`, `nombreCt`) values
(1, 'Recurso'),
(2, 'Inscripcion'),
(3, 'Sesion'),
(4, 'Ejercicio'),
(5, 'Tabla'),
(6, 'Usuario'),
(7, 'PerfilUsuario'),
(8, 'Actividad'),
(9, 'Asistencia'),
(10, 'EjercicioTabla'),
(11, 'AsignacionTabla'),
(12, 'Notificacion');


--
-- dumping data for table `Recurso`
--

INSERT INTO `Recurso` (`Id_Recurso`, `Nombre`, `Capacidad`) VALUES
(1, 'Sala Variada', 30),
(2, 'Sala Spinning', 30),
(3, 'Sala Infantil', 70),
(4, 'Sala Laberinto', 20),
(5, 'Sala Baile', 100);

--
-- dumping data for table `Accion`
--

insert into `Accion` (`idAccion`, `nombreAc`) values
(1, 'alta'),
(2, 'baja'),
(3, 'modificacion'),
(4, 'consulta');


--
-- dumping data for `AccionControlador`
--

INSERT INTO `AccionControlador` (`idControlador`, `idAccion`) VALUES
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
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4);


--
-- dumping data for table `Permiso`
--

INSERT INTO `Permiso` (`idPerfilUsuario`, `idControlador`, `AccidAccion`) VALUES
(1, 1, 1),
(1, 1, 2),
(1, 1, 3),
(1, 1, 4),
(1, 6, 1),
(1, 6, 2),
(1, 6, 3),
(1, 6, 4),
(1, 8, 1),
(1, 8, 2),
(1, 8, 3),
(1, 8, 4),
(1, 12, 1),
(1, 12, 2),
(1, 12, 3),
(1, 12, 4),
(2, 6, 3),
(2, 6, 4),
(2, 4, 1),
(2, 4, 2),
(2, 4, 3),
(2, 4, 4),
(2, 5, 1),
(2, 5, 2),
(2, 5, 3),
(2, 5, 4),
(2, 9, 1),
(2, 9, 2),
(2, 9, 3),
(2, 9, 4),
(2, 8, 4),
(2, 3, 4),
(3, 6, 3),
(3, 6, 4),
(3, 2, 1),
(3, 2, 2),
(3, 2, 4),
(3, 3, 1),
(3, 3, 2),
(3, 3, 3),
(3, 3, 4),
(3, 4, 4),
(3, 10, 4),
(3, 11, 4),
(3, 12, 4),
(4, 6, 3),
(4, 6, 4),
(4, 2, 1),
(4, 2, 2),
(4, 2, 4),
(4, 3, 1),
(4, 3, 2),
(4, 3, 3),
(4, 3, 4),
(4, 4, 4),
(4, 10, 4),
(4, 11, 4),
(4, 12, 4);



--
-- dumping data for table `Actividad`
--

INSERT INTO `Actividad` (`Id_Actividad`, `Nombre`, `Id_Recurso`, `Capacidad`, `HoraInicio`, `HoraFin`, `Dia`) VALUES
(1, 'Juegos', 3, 50, '16:00:00', '18:00:00', 'Viernes'),
(2, 'Baile', 5, 30, '18:00:00', '20:00:00', 'Jueves'),
(3, 'Escape Room', 4, 4, '17:00:00', '18:00:00', 'Martes'),
(4, 'Spinning', 2, 6, '16:00:00', '18:00:00', 'Lunes');


--
-- dumping data for table `Inscripcion`
--

INSERT INTO `Inscripcion` (`Usuario_idUsuario`,`Actividad_idActividad`) VALUES
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(5, 1),
(5, 2),
(5, 3),
(5, 4);


--
-- dumping data for table `Ejercicio`
--

insert into `Ejercicio` (`idEjercicio`, `nombreEj`, `descripcionEj`,`tipoEj`) values
(1, 'abdominal', 'Baja tripa','aerobico'),
(2, 'flexion', 'besa el suelo','aerobico'),
(3, 'sentadilla', 'mueve el culo','anaerobico'),
(4, 'marcha', 'circula leñe','anaerobico');


--
-- dumping data for table `Tabla`
--

insert into `Tabla` (`idTabla`, `nombre`, `tipoTabla`) values
(1, 'Tabla Basica 1', 'Predeterminada'),
(2, 'Tabla Basica 2', 'Predeterminada'),
(3, 'Tabla Personalizada 1', 'Personalizada'),
(4, 'Tabla Personalizada 2', 'Personalizada');



--
-- dumping data for table `AsignacionTabla`
--

insert into `AsignacionTabla` (`idUsuario`, `idTabla`) values
(3, 1),
(3, 2),
(4, 1),
(4, 2);


--
-- dumping data for table `Notificacion`
--

INSERT INTO `Notificacion` (`idNotificacion`, `idUsuario`, `titulo`, `txtNotificacion`) VALUES
(1, 3, 'Prueba 1', 'Mensaje de prueba 1'),
(2, 3, 'Prueba 2', 'Mensaje de prueba 2'),
(3, 3, 'Prueba 3', 'Mensaje de prueba 3'),
(4, 4, 'Prueba 1', 'Mensaje de prueba 1'),
(5, 4, 'Prueba 2', 'Mensaje de prueba 2'),
(6, 4, 'Prueba 3', 'Mensaje de prueba 3'),
(7, 5, 'Prueba 1', 'Mensaje de prueba 1'),
(8, 5, 'Prueba 2', 'Mensaje de prueba 2'),
(9, 5, 'Prueba 3', 'Mensaje de prueba 3');

--
-- dumping data for table `Sesion`
--

INSERT INTO `Sesion` (`idSesion`, `idUsuario`, `idTabla`, `nombreSesion`, `horaInicio`, `duracion`, `comentario`) VALUES
(1, 3, 1, 'abdominal tabla 1', '2015-12-01 16:00:00', '4:20:00', 'como cansa esto'),
(2, 3, 1, 'sentadillas tabla 1', '2015-12-01 18:00:00', '3:15:00', 'me duelen las piernas'),
(3, 4, 2, 'flexiones tabla 2', '2016-10-01 17:00:00', '2:20:00', ' ay mi tripita'),
(4, 4, 2, 'marcha tabla 2', '2016-11-01 16:00:00', '1:00:00', 'no aguanto mas');
