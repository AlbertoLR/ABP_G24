
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
  `DNI` VARCHAR(9) NOT NULL,
  `Id_PerfilUsuario` INT NOT NULL,
  PRIMARY KEY (`Id_usuario`),
  CONSTRAINT `fk_Usuario_PerfilUsuario`
    FOREIGN KEY (`Id_PerfilUsuario`)
    REFERENCES `PerfilUsuario` (`Id_PerfilUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Usuario_PerfilUsuario_idx` ON `Usuario` (`Id_PerfilUsuario` ASC);


-- -----------------------------------------------------
-- Table `Actividad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Actividad` ;

CREATE TABLE IF NOT EXISTS `Actividad` (
  `Id_Actividad` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL,
  `Sala` INT UNSIGNED NOT NULL,
  `Capacidad` INT UNSIGNED NOT NULL,
  `HoraInicio` TIME(0) NOT NULL,
  `HoraFin` TIME(0) NOT NULL,
  `Dia` ENUM('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado') NOT NULL,
  PRIMARY KEY (`Id_Actividad`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Asistencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Asistencia` ;

CREATE TABLE IF NOT EXISTS `Asistencia` (
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

CREATE INDEX `fk_Usuario_has_Actividad_Actividad1_idx` ON `Asistencia` (`Actividad_idActividad` ASC);

CREATE INDEX `fk_Usuario_has_Actividad_Usuario1_idx` ON `Asistencia` (`Usuario_idUsuario` ASC);


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
  `horaFin` DATETIME NOT NULL,
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
  PRIMARY KEY (`idEjercicio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `EjercicioTabla`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `EjercicioTabla` ;

CREATE TABLE IF NOT EXISTS `EjercicioTabla` (
  `idTabla` INT NOT NULL,
  `idEjercicio` INT NOT NULL,
  `cantidad` INT NOT NULL,
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
(3, 'Usuario'),
(4, 'Usuario1');


--
-- dumping data for table `Usuario`
--

insert into `Usuario` (`Id_usuario`, `Nombre`, `DNI`, `Id_PerfilUsuario`) values
(1, 'Alberto', '44488826H', 1),
(2, 'Samuel', '46573898J', 2),
(3, 'Iago', '12345678K', 3),
(4, 'Amparo', '87654321J', 4);


--
-- dumping data for table `Controlador`
--

insert into `Controlador` (`idControlador`, `nombreCt`) values
(1, 'Controlador'),
(2, 'Accion'),
(3, 'Sesion'),
(4, 'Ejercicio'),
(5, 'Tabla'),
(6, 'Usuario'),
(7, 'PerfilUsuario'),
(8, 'Actividad');


--
-- dumping data for table `Accion`
--

insert into `Accion` (`idAccion`, `nombreAc`) values
(1, 'alta'),
(2, 'baja'),
(3, 'modificacion'),
(4, 'consulta');


--
-- dumping data for table `Actividad`
--

insert into `Actividad` (`Id_Actividad`, `Nombre`, `Sala`, `Capacidad`, `HoraInicio`, `HoraFin`, `Dia`) values
(1, 'Juegos', '3', '50', '16:00', '18:00', 'Viernes'),
(2, 'Baile', '5', '30', '18:00', '20:00', 'Jueves'),
(3, 'Escape Room', '4', '4', '17:00', '18:00', 'Martes'),
(4, 'Spinning', '5', '6', '16:00', '18:00', 'Lunes');


--
-- dumping data for table `Ejercicio`
--

insert into `Ejercicio` (`idEjercicio`, `nombreEj`, `descripcionEj`) values
(1, 'abdominal', 'Baja tripa'),
(2, 'flexion', 'besa el suelo'),
(3, 'sentadilla', 'mueve el culo'),
(4, 'marcha', 'circula leñe');


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
('3', '1'),
('3', '2'),
('4', '1'),
('4', '2');


--
-- dumping data for table `Sesion`
--

insert into `Sesion` (`idSesion`, `idUsuario`, `idTabla`, `nombreSesion`, `horaInicio`, `horaFin`, `comentario`) values
(1, '3', '1',  'abdominal tabla 1', '2015-12-01 16:00:00', '2015-12-01 16:20:00', 'como cansa esto'),
(2, '3', '1', 'sentadillas tabla 1', '2015-12-01 18:00:00', '2015-12-01 18:15:00', 'me duelen las piernas'),
(3, '4', '2', 'flexiones tabla 2', '2016-10-01 17:00:00', '2016-10-01 17:20:00', ' ay mi tripita'),
(4, '4', '2', 'marcha tabla 2', '2016-11-01 16:00:00', '2016-11-01 18:00:00', 'no aguanto mas');
