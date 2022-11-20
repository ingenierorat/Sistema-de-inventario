-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema inventario
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema inventario
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `inventario` DEFAULT CHARACTER SET latin1 ;
USE `inventario` ;

-- -----------------------------------------------------
-- Table `inventario`.`empresas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`empresas` (
  `id_empresa` BIGINT(20) NOT NULL,
  `nombre` VARCHAR(45) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `descripcion` VARCHAR(144) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `telefono` VARCHAR(45) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `direccion` VARCHAR(45) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `mail` VARCHAR(45) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  PRIMARY KEY (`id_empresa`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `inventario`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`categoria` (
  `id_categoria` BIGINT(20) NOT NULL,
  `descripcion` VARCHAR(45) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `inventario`.`productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`productos` (
  `id_producto` BIGINT(20) NOT NULL,
  `id_categoria` BIGINT(20) NOT NULL,
  `id_empresa` BIGINT(20) NOT NULL,
  `codigo_barra` VARCHAR(50) CHARACTER SET 'latin1' NOT NULL,
  `nombre` VARCHAR(50) CHARACTER SET 'latin1' NOT NULL,
  `descripcion` VARCHAR(144) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `precio_ingreso` FLOAT NOT NULL,
  `porciento_venta` FLOAT NOT NULL,
  `itebis` FLOAT NULL DEFAULT NULL,
  `precio_venta` FLOAT NOT NULL,
  `disponibilidad_min` INT(11) NOT NULL,
  `disponibilidad` INT(11) NOT NULL,
  `fecha_ingreso` DATE NOT NULL,
  PRIMARY KEY (`id_producto`),
  UNIQUE INDEX `id_producto_UNIQUE` (`id_producto` ASC),
  UNIQUE INDEX `Codigo_barra_UNIQUE` (`codigo_barra` ASC),
  INDEX `fk_productos_categoria1_idx` (`id_categoria` ASC),
  INDEX `fk_productos_empresas1_idx` (`id_empresa` ASC),
  CONSTRAINT `fk_productos_categoria1`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `inventario`.`categoria` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productos_empresas1`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `inventario`.`empresas` (`id_empresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `inventario`.`proveedores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`proveedores` (
  `id_proveedor` BIGINT(20) NOT NULL,
  `id_empresa` BIGINT(20) NOT NULL,
  `nombre` VARCHAR(50) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `apellidos` VARCHAR(50) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `telefono` CHAR(15) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `mail` VARCHAR(100) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `cedula` CHAR(13) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `sexo` CHAR(1) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `fecha_ingreso` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id_proveedor`),
  UNIQUE INDEX `cedula_UNIQUE` (`cedula` ASC),
  INDEX `fk_proveedores_empresas1_idx` (`id_empresa` ASC),
  CONSTRAINT `fk_proveedores_empresas1`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `inventario`.`empresas` (`id_empresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `inventario`.`abastecimientos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`abastecimientos` (
  `id_abastecimiento` BIGINT(20) NOT NULL,
  `id_producto` BIGINT(20) NOT NULL,
  `id_empresa` BIGINT(20) NOT NULL,
  `id_proveedor` BIGINT(20) NOT NULL,
  `fecha` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id_abastecimiento`),
  INDEX `fk_abastecimientos_productos1_idx` (`id_producto` ASC),
  INDEX `fk_abastecimientos_empresas1_idx` (`id_empresa` ASC),
  INDEX `fk_abastecimientos_proveedores1_idx` (`id_proveedor` ASC),
  CONSTRAINT `fk_abastecimientos_empresas1`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `inventario`.`empresas` (`id_empresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_abastecimientos_productos1`
    FOREIGN KEY (`id_producto`)
    REFERENCES `inventario`.`productos` (`id_producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_abastecimientos_proveedores1`
    FOREIGN KEY (`id_proveedor`)
    REFERENCES `inventario`.`proveedores` (`id_proveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `inventario`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`clientes` (
  `id_cliente` BIGINT(20) NOT NULL,
  `nombre` VARCHAR(50) CHARACTER SET 'latin1' NOT NULL,
  `apellidos` VARCHAR(50) CHARACTER SET 'latin1' NOT NULL,
  `telefono` CHAR(15) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `mail` VARCHAR(100) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `direccion` VARCHAR(144) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `cedula` CHAR(13) CHARACTER SET 'latin1' NOT NULL,
  `sexo` CHAR(1) CHARACTER SET 'latin1' NOT NULL,
  `fecha_ingreso` DATE NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE INDEX `cedula_UNIQUE` (`cedula` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `inventario`.`facturas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`facturas` (
  `id_factura` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `fecha` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id_factura`))
ENGINE = InnoDB
AUTO_INCREMENT = 84
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `inventario`.`detalles_facturas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`detalles_facturas` (
  `id_factura` BIGINT(20) NOT NULL,
  `id_producto` BIGINT(20) NOT NULL,
  `id_cliente` BIGINT(20) NOT NULL,
  `cantidad` INT(11) NOT NULL,
  `precio` FLOAT NOT NULL,
  `importe` FLOAT NOT NULL,
  INDEX `fk_facturas_has_productos_productos1_idx` (`id_producto` ASC),
  INDEX `fk_facturas_has_productos_facturas1_idx` (`id_factura` ASC),
  INDEX `fk_detalles_facturas_clientes1_idx` (`id_cliente` ASC),
  CONSTRAINT `fk_detalles_facturas_clientes1`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `inventario`.`clientes` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_facturas_has_productos_facturas1`
    FOREIGN KEY (`id_factura`)
    REFERENCES `inventario`.`facturas` (`id_factura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_facturas_has_productos_productos1`
    FOREIGN KEY (`id_producto`)
    REFERENCES `inventario`.`productos` (`id_producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `inventario`.`pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`pedidos` (
  `id_pedido` BIGINT(20) NOT NULL,
  `id_proveedor` BIGINT(20) NOT NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`id_pedido`),
  INDEX `fk_pedidos_proveedores1_idx` (`id_proveedor` ASC),
  CONSTRAINT `fk_pedidos_proveedores1`
    FOREIGN KEY (`id_proveedor`)
    REFERENCES `inventario`.`proveedores` (`id_proveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `inventario`.`detalles_pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`detalles_pedidos` (
  `id_pedido` BIGINT(20) NOT NULL,
  `id_producto` BIGINT(20) NOT NULL,
  `cantidad` INT(11) NOT NULL,
  `precio` FLOAT NOT NULL,
  `descuento` FLOAT NULL DEFAULT NULL,
  `importe` FLOAT NOT NULL,
  `estatus` VARCHAR(50) CHARACTER SET 'latin1' NOT NULL,
  INDEX `fk_pedidos_has_productos_productos1_idx` (`id_producto` ASC),
  INDEX `fk_pedidos_has_productos_pedidos1_idx` (`id_pedido` ASC),
  CONSTRAINT `fk_pedidos_has_productos_pedidos1`
    FOREIGN KEY (`id_pedido`)
    REFERENCES `inventario`.`pedidos` (`id_pedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedidos_has_productos_productos1`
    FOREIGN KEY (`id_producto`)
    REFERENCES `inventario`.`productos` (`id_producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `inventario`.`pagos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`pagos` (
  `id_pago` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `id_cliente` BIGINT(20) NOT NULL,
  `id_factura` BIGINT(20) NOT NULL,
  `monto_pagado` FLOAT NOT NULL,
  `monto_suministrado` FLOAT NOT NULL,
  `devuelta` FLOAT NULL DEFAULT NULL,
  `descripcion` VARCHAR(50) CHARACTER SET 'latin1' NOT NULL,
  PRIMARY KEY (`id_pago`),
  INDEX `fk_pagos_clientes1_idx` (`id_cliente` ASC),
  INDEX `fk_pagos_facturas1_idx` (`id_factura` ASC),
  CONSTRAINT `fk_pagos_clientes1`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `inventario`.`clientes` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pagos_facturas1`
    FOREIGN KEY (`id_factura`)
    REFERENCES `inventario`.`facturas` (`id_factura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 28
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `inventario`.`tipo_usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`tipo_usuarios` (
  `id_tipo_usuario` BIGINT(20) NOT NULL,
  `descripcion` VARCHAR(50) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipo_usuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `inventario`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`usuarios` (
  `id_usuario` BIGINT(20) NOT NULL,
  `id_tipo_usuario` BIGINT(20) NOT NULL,
  `nombre` VARCHAR(50) CHARACTER SET 'latin1' NOT NULL,
  `apellidos` VARCHAR(50) CHARACTER SET 'latin1' NOT NULL,
  `usuario` VARCHAR(20) CHARACTER SET 'latin1' NOT NULL,
  `clave` VARCHAR(50) CHARACTER SET 'latin1' NOT NULL,
  `fecha_ingreso` DATE NOT NULL,
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_usuarios_tipo_usuarios_idx` (`id_tipo_usuario` ASC),
  CONSTRAINT `fk_usuarios_tipo_usuarios`
    FOREIGN KEY (`id_tipo_usuario`)
    REFERENCES `inventario`.`tipo_usuarios` (`id_tipo_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


-- -----------------------------------------------------
-- Table `inventario`.`ncf`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`ncf` (
  `id_ncf` BINARY(20) NOT NULL,
  `id_cliente` BIGINT(20) NOT NULL,
  `id_factura` BIGINT(20) NOT NULL,
  `id_producto` BIGINT(20) NOT NULL,
  `id_pago` BIGINT(20) NOT NULL,
  `id_usuario` BIGINT(20) NOT NULL,
  `ncf` VARCHAR(45) CHARACTER SET 'latin1' NOT NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`id_ncf`),
  INDEX `fk_ncf_clientes1_idx` (`id_cliente` ASC),
  INDEX `fk_ncf_facturas1_idx` (`id_factura` ASC),
  INDEX `fk_ncf_productos1_idx` (`id_producto` ASC),
  INDEX `fk_ncf_pagos1_idx` (`id_pago` ASC),
  INDEX `fk_ncf_usuarios1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_ncf_clientes1`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `inventario`.`clientes` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ncf_facturas1`
    FOREIGN KEY (`id_factura`)
    REFERENCES `inventario`.`facturas` (`id_factura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ncf_productos1`
    FOREIGN KEY (`id_producto`)
    REFERENCES `inventario`.`productos` (`id_producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ncf_pagos1`
    FOREIGN KEY (`id_pago`)
    REFERENCES `inventario`.`pagos` (`id_pago`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ncf_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `inventario`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_spanish_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
