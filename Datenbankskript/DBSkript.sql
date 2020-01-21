-- MySQL Script generated by MySQL Workbench
-- Di 21 Jan 2020 10:33:14 CET
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `k95631_musik` DEFAULT CHARACTER SET utf8 ;
USE `k95631_musik` ;

-- -----------------------------------------------------
-- Table `k95631_musik`.`Genre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `k95631_musik`.`Genre` (
  `GenreID` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`GenreID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `k95631_musik`.`Track`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `k95631_musik`.`Track` (
  `TrackID` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(20) NOT NULL,
  `Länge` TIME NULL,
  `Veröffentlichungsjahr` YEAR NULL,
  PRIMARY KEY (`TrackID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `k95631_musik`.`Typ`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `k95631_musik`.`Typ` (
  `TypID` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`TypID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `k95631_musik`.`Künstler`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `k95631_musik`.`Künstler` (
  `KünstlerID` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(20) NULL,
  `TypID` INT NOT NULL,
  PRIMARY KEY (`KünstlerID`),
  INDEX `fk_Künstler_Typ_idx` (`TypID` ASC) VISIBLE,
  CONSTRAINT `fk_Künstler_Typ`
    FOREIGN KEY (`TypID`)
    REFERENCES `k95631_musik`.`Typ` (`TypID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `k95631_musik`.`Album`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `k95631_musik`.`Album` (
  `AlbumID` INT NOT NULL,
  `Name` VARCHAR(30) NOT NULL,
  `Trackzahl` TINYINT NULL,
  `Veröffentlichungsjahr` YEAR NULL,
  PRIMARY KEY (`AlbumID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `k95631_musik`.`Trackzuordnung`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `k95631_musik`.`Trackzuordnung` (
  `TrackID` INT NOT NULL,
  `AlbumID` INT NOT NULL,
  PRIMARY KEY (`TrackID`, `AlbumID`),
  INDEX `fk_Track_has_Album_Album1_idx` (`AlbumID` ASC) VISIBLE,
  INDEX `fk_Track_has_Album_Track1_idx` (`TrackID` ASC) VISIBLE,
  CONSTRAINT `fk_Track_has_Album_Track1`
    FOREIGN KEY (`TrackID`)
    REFERENCES `k95631_musik`.`Track` (`TrackID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Track_has_Album_Album1`
    FOREIGN KEY (`AlbumID`)
    REFERENCES `k95631_musik`.`Album` (`AlbumID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `k95631_musik`.`Trackinterpret`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `k95631_musik`.`Trackinterpret` (
  `TrackID` INT NOT NULL,
  `KünstlerID` INT NOT NULL,
  PRIMARY KEY (`TrackID`, `KünstlerID`),
  INDEX `fk_Track_has_Künstler_Künstler1_idx` (`KünstlerID` ASC) VISIBLE,
  INDEX `fk_Track_has_Künstler_Track1_idx` (`TrackID` ASC) VISIBLE,
  CONSTRAINT `fk_Track_has_Künstler_Track1`
    FOREIGN KEY (`TrackID`)
    REFERENCES `k95631_musik`.`Track` (`TrackID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Track_has_Künstler_Künstler1`
    FOREIGN KEY (`KünstlerID`)
    REFERENCES `k95631_musik`.`Künstler` (`KünstlerID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `k95631_musik`.`Genrezuordnung`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `k95631_musik`.`Genrezuordnung` (
  `TrackID` INT NOT NULL,
  `GenreID` INT NOT NULL,
  PRIMARY KEY (`TrackID`, `GenreID`),
  INDEX `fk_Track_has_Genre_Genre1_idx` (`GenreID` ASC) VISIBLE,
  INDEX `fk_Track_has_Genre_Track1_idx` (`TrackID` ASC) VISIBLE,
  CONSTRAINT `fk_Track_has_Genre_Track1`
    FOREIGN KEY (`TrackID`)
    REFERENCES `k95631_musik`.`Track` (`TrackID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Track_has_Genre_Genre1`
    FOREIGN KEY (`GenreID`)
    REFERENCES `k95631_musik`.`Genre` (`GenreID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
