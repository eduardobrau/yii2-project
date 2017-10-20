-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema yii
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema yii
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `yii` DEFAULT CHARACTER SET utf8 ;
USE `yii` ;

-- -----------------------------------------------------
-- Table `yii`.`cidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii`.`cidades` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cidade` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii`.`bairros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii`.`bairros` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `bairro` VARCHAR(150) NOT NULL,
  `cep` VARCHAR(10) NULL,
  `cidade_id` INT NOT NULL,
  PRIMARY KEY (`id`, `cidade_id`),
  INDEX `idx_cidades` (`cidade_id` ASC),
  CONSTRAINT `fk_cidades`
    FOREIGN KEY (`cidade_id`)
    REFERENCES `yii`.`cidades` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
PACK_KEYS = DEFAULT;


-- -----------------------------------------------------
-- Table `yii`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii`.`categorias` (
  `id` INT NOT NULL,
  `categoria` VARCHAR(80) NOT NULL,
  `descrição` MEDIUMTEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii`.`anuncios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii`.`anuncios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(250) NOT NULL,
  `slogan` VARCHAR(200) NULL COMMENT 'Um slogan serve para descrever em poucas palavras a finalidade do anuncio.',
  `texto` MEDIUMTEXT NOT NULL COMMENT 'Texto do anuncio',
  `telefone` VARCHAR(45) NOT NULL,
  `endereco` VARCHAR(150) NOT NULL,
  `site` VARCHAR(45) NULL,
  `bairro_id` INT NOT NULL,
  `categoria_id` INT NOT NULL,
  PRIMARY KEY (`id`, `bairro_id`, `categoria_id`),
  INDEX `idx_categorias` USING BTREE (`categoria_id` ASC),
  INDEX `idx_bairros` (`bairro_id` ASC),
  CONSTRAINT `fk_bairros`
    FOREIGN KEY (`bairro_id`)
    REFERENCES `yii`.`bairros` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_categorias`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `yii`.`categorias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii`.`redes_sociais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii`.`redes_sociais` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `rede_social` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii`.`anuncios_redes_sociais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii`.`anuncios_redes_sociais` (
  `id` INT NOT NULL,
  `anuncio_id` INT NOT NULL,
  `rede_social_id` INT NOT NULL,
  `url` VARCHAR(150) NULL,
  PRIMARY KEY (`id`, `anuncio_id`, `rede_social_id`),
  INDEX `idx_anuncios` (`anuncio_id` ASC),
  INDEX `idx_redes_sociais` (`rede_social_id` ASC),
  CONSTRAINT `fk_anuncios`
    FOREIGN KEY (`anuncio_id`)
    REFERENCES `yii`.`anuncios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_redes_sociais`
    FOREIGN KEY (`rede_social_id`)
    REFERENCES `yii`.`redes_sociais` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii`.`tags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii`.`tags` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tag` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii`.`anuncios_tags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii`.`anuncios_tags` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `anuncio_id` INT NOT NULL,
  `tag_id` INT NOT NULL,
  PRIMARY KEY (`id`, `anuncio_id`, `tag_id`),
  INDEX `idx_anuncios` (`anuncio_id` ASC),
  INDEX `idx_tags` (`tag_id` ASC),
  CONSTRAINT `fk_anuncios_tags_anuncios1`
    FOREIGN KEY (`anuncio_id`)
    REFERENCES `yii`.`anuncios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anuncios_tags_tags1`
    FOREIGN KEY (`tag_id`)
    REFERENCES `yii`.`tags` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
