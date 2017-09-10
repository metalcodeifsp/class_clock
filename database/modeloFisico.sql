-- MySQL Script generated by MySQL Workbench
-- dom 10 set 2017 13:49:25 -03
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema horario
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `horario` ;

-- -----------------------------------------------------
-- Schema horario
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `horario` DEFAULT CHARACTER SET latin1 ;
USE `horario` ;

-- -----------------------------------------------------
-- Table `horario`.`grau`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `horario`.`grau` ;

CREATE TABLE IF NOT EXISTS `horario`.`grau` (
  `id` TINYINT(4) NOT NULL AUTO_INCREMENT,
  `nome_grau` VARCHAR(50) NOT NULL,
  `codigo` INT(11) NOT NULL,
  `deletado_em` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `horario`.`curso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `horario`.`curso` ;

CREATE TABLE IF NOT EXISTS `horario`.`curso` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `grau_id` TINYINT(4) NOT NULL,
  `codigo_curso` CHAR(5) NOT NULL,
  `nome_curso` VARCHAR(75) NOT NULL,
  `sigla_curso` CHAR(3) NOT NULL,
  `qtd_semestre` TINYINT(2) NOT NULL,
  `fechamento` CHAR(1) NOT NULL,
  `deletado_em` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_curso_grau1_idx` (`grau_id` ASC),
  CONSTRAINT `fk_curso_grau1`
    FOREIGN KEY (`grau_id`)
    REFERENCES `horario`.`grau` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `horario`.`tipo_sala`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `horario`.`tipo_sala` ;

CREATE TABLE IF NOT EXISTS `horario`.`tipo_sala` (
  `id` TINYINT(4) NOT NULL AUTO_INCREMENT,
  `nome_tipo_sala` VARCHAR(30) NOT NULL,
  `descricao_tipo_sala` VARCHAR(254) NOT NULL,
  `deletado_em` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `horario`.`disciplina`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `horario`.`disciplina` ;

CREATE TABLE IF NOT EXISTS `horario`.`disciplina` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `curso_id` SMALLINT(6) NOT NULL,
  `tipo_sala_id` TINYINT(4) NOT NULL,
  `nome_disciplina` VARCHAR(50) NOT NULL,
  `sigla_disciplina` CHAR(5) NOT NULL,
  `qtd_professor` TINYINT(1) NOT NULL,
  `qtd_aulas` TINYINT(2) NOT NULL,
  `deletado_em` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_disciplina_curso1_idx` (`curso_id` ASC),
  INDEX `fk_disciplina_tipo_sala` (`tipo_sala_id` ASC),
  CONSTRAINT `fk_disciplina_curso1`
    FOREIGN KEY (`curso_id`)
    REFERENCES `horario`.`curso` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_disciplina_tipo_sala`
    FOREIGN KEY (`tipo_sala_id`)
    REFERENCES `horario`.`tipo_sala` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `horario`.`turno`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `horario`.`turno` ;

CREATE TABLE IF NOT EXISTS `horario`.`turno` (
  `id` TINYINT(4) NOT NULL AUTO_INCREMENT,
  `nome_turno` VARCHAR(25) NOT NULL,
  `deletado_em` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nome_turno_UNIQUE` (`nome_turno` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `horario`.`horario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `horario`.`horario` ;

CREATE TABLE IF NOT EXISTS `horario`.`horario` (
  `id` TINYINT(4) NOT NULL AUTO_INCREMENT,
  `turno_id` TINYINT(4) NOT NULL,
  `inicio` TIME NOT NULL,
  `fim` TIME NOT NULL,
  `deletado_em` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_horario_turno_idx` (`turno_id` ASC),
  CONSTRAINT `fk_horario_turno`
    FOREIGN KEY (`turno_id`)
    REFERENCES `horario`.`turno` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `horario`.`tipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `horario`.`tipo` ;

CREATE TABLE IF NOT EXISTS `horario`.`tipo` (
  `id` TINYINT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(25) NOT NULL,
  `deletado_em` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `horario`.`area`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `horario`.`area` ;

CREATE TABLE IF NOT EXISTS `horario`.`area` (
  `id` SMALLINT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `horario`.`pessoa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `horario`.`pessoa` ;

CREATE TABLE IF NOT EXISTS `horario`.`pessoa` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `prontuario` CHAR(6) NOT NULL,
  `senha` CHAR(64) NOT NULL,
  `nascimento` DATE NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `deletado_em` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `horario`.`docente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `horario`.`docente` ;

CREATE TABLE IF NOT EXISTS `horario`.`docente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pessoa_id` INT NOT NULL,
  `area_id` SMALLINT NOT NULL,
  `ingressoCampus` DATE NOT NULL,
  `ingressoIFSP` DATE NOT NULL,
  `regime` CHAR(1) NOT NULL,
  `deletado_em` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_docente_area1_idx` (`area_id` ASC),
  INDEX `fk_docente_pessoa1_idx` (`pessoa_id` ASC),
  CONSTRAINT `fk_docente_area1`
    FOREIGN KEY (`area_id`)
    REFERENCES `horario`.`area` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_docente_pessoa1`
    FOREIGN KEY (`pessoa_id`)
    REFERENCES `horario`.`pessoa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `horario`.`tipo_pessoa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `horario`.`tipo_pessoa` ;

CREATE TABLE IF NOT EXISTS `horario`.`tipo_pessoa` (
  `tipo_id` TINYINT NOT NULL,
  `pessoa_id` INT NOT NULL,
  PRIMARY KEY (`tipo_id`, `pessoa_id`),
  INDEX `fk_tipo_has_pessoa_pessoa1_idx` (`pessoa_id` ASC),
  INDEX `fk_tipo_has_pessoa_tipo1_idx` (`tipo_id` ASC),
  CONSTRAINT `fk_tipo_has_pessoa_tipo1`
    FOREIGN KEY (`tipo_id`)
    REFERENCES `horario`.`tipo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipo_has_pessoa_pessoa1`
    FOREIGN KEY (`pessoa_id`)
    REFERENCES `horario`.`pessoa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
