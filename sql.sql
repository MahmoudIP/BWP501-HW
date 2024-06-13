CREATE DATABASE "deepspace";


-- users table
CREATE TABLE `deepspace`.`users` (
  `id` INT GENERATED ALWAYS AS () VIRTUAL,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE);

-- product table 
CREATE TABLE `deepspace`.`product` (
  `idproduct` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `price` FLOAT NOT NULL,
  `description` VARCHAR(45) NOT NULL,
  `imag` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idproduct`),
  UNIQUE INDEX `idproduct_UNIQUE` (`idproduct` ASC) VISIBLE);



  -- cart table 
CREATE TABLE `deepspace`.`cart` (
  `id_u` INT NOT NULL,
  `id_p` INT NOT NULL,
  `count` INT NOT NULL,
  INDEX `id_u_idx` (`id_u` ASC) VISIBLE,
  INDEX `id_p_idx` (`id_p` ASC) VISIBLE,
  CONSTRAINT `id_u`
    FOREIGN KEY (`id_u`)
    REFERENCES `deepspace`.`users` (`id_u`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_p`
    FOREIGN KEY (`id_p`)
    REFERENCES `deepspace`.`product` (`id_p`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

