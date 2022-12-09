-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema exerciseLooper
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema exerciseLooper
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `exerciseLooper` DEFAULT CHARACTER SET utf8 ;
USE `exerciseLooper` ;

-- -----------------------------------------------------
-- Table `exerciseLooper`.`exercises`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `exerciseLooper`.`exercises` ;

CREATE TABLE IF NOT EXISTS `exerciseLooper`.`exercises` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NULL,
  `state` VARCHAR(40),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `exerciseLooper`.`fields`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `exerciseLooper`.`fields` ;

CREATE TABLE IF NOT EXISTS `exerciseLooper`.`fields` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(50) NULL,
  `exercises_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_fields_exercises_idx` (`exercises_id` ASC) VISIBLE,
  CONSTRAINT `fk_fields_exercises`
    FOREIGN KEY (`exercises_id`)
    REFERENCES `exerciseLooper`.`exercises` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `exerciseLooper`.`fulfillments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `exerciseLooper`.`fulfillments` ;

CREATE TABLE IF NOT EXISTS `exerciseLooper`.`fulfillments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date` DATETIME NULL,
  `exercises_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_fulfillments_exercises1_idx` (`exercises_id` ASC) VISIBLE,
  CONSTRAINT `fk_fulfillments_exercises1`
    FOREIGN KEY (`exercises_id`)
    REFERENCES `exerciseLooper`.`exercises` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `exerciseLooper`.`fields_has_fulfillments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `exerciseLooper`.`fields_has_fulfillments` ;

CREATE TABLE IF NOT EXISTS `exerciseLooper`.`fields_has_fulfillments` (
  `fields_id` INT NOT NULL,
  `fulfillments_id` INT NOT NULL,
  `value` VARCHAR(255) NULL,
  PRIMARY KEY (`fields_id`, `fulfillments_id`),
  INDEX `fk_fields_has_fulfillments_fulfillments1_idx` (`fulfillments_id` ASC) VISIBLE,
  INDEX `fk_fields_has_fulfillments_fields1_idx` (`fields_id` ASC) VISIBLE,
  CONSTRAINT `fk_fields_has_fulfillments_fields1`
    FOREIGN KEY (`fields_id`)
    REFERENCES `exerciseLooper`.`fields` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_fields_has_fulfillments_fulfillments1`
    FOREIGN KEY (`fulfillments_id`)
    REFERENCES `exerciseLooper`.`fulfillments` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
