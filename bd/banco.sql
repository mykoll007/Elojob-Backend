CREATE SCHEMA `bd_elojob` DEFAULT CHARACTER SET utf8 ;

USE `bd_elojob`;

CREATE TABLE `bd_elojob`.`usuarios` (
  `id_cadastro` INT(4) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `token` VARCHAR(255) DEFAULT NULL,
  `data_cadastro` DATETIME NOT NULL,
  PRIMARY KEY (`id_cadastro`))
  ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE `bd_elojob`.`pedidos` (
  `id_pedido` INT(4) NOT NULL AUTO_INCREMENT,
  `pedido` INT(5) NOT NULL,
  `servico` VARCHAR(15) NOT NULL,
  `data_pedido` DATETIME NOT NULL,
  `status` VARCHAR(25) NOT NULL,
  `id_cadastro` INT NOT NULL,  -- Coluna para a FK
  PRIMARY KEY (`id_pedido`),
  CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`id_cadastro`)
    REFERENCES `usuarios` (`id_cadastro`) 
    ON DELETE CASCADE ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;
