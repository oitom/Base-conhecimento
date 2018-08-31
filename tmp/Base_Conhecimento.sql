SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `base_conhecimento` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `base_conhecimento` ;

-- -----------------------------------------------------
-- Table `base_conhecimento`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`usuarios` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`usuarios` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `descricao` TEXT NULL,
  `foto` VARCHAR(45) NULL,
  `situacao` INT NOT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `base_conhecimento`.`plataformas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`plataformas` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`plataformas` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` TEXT NOT NULL,
  `estilo` TEXT NOT NULL,
  `logo` TEXT NOT NULL,
  `codigo_usuario` INT NOT NULL,
  `ext_bloqueio` TEXT NULL,
  `tipo_bloqueio` TEXT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_plataformas_usuarios1_idx` (`codigo_usuario` ASC),
  CONSTRAINT `fk_plataformas_usuarios1`
    FOREIGN KEY (`codigo_usuario`)
    REFERENCES `base_conhecimento`.`usuarios` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`bases`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`bases` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`bases` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_plataforma` INT NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` TEXT NOT NULL,
  `data_hora` DATETIME NOT NULL,
  `publica` TINYINT(1) NOT NULL,
  `codigo_pai` INT NULL,
  `codigo_usuario` INT NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_BaseConhecimento_Plataforma_idx` (`codigo_plataforma` ASC),
  INDEX `fk_BaseConhecimento_BaseConhecimento1_idx` (`codigo_pai` ASC),
  INDEX `fk_bases_usuarios1_idx` (`codigo_usuario` ASC),
  CONSTRAINT `fk_BaseConhecimento_Plataforma`
    FOREIGN KEY (`codigo_plataforma`)
    REFERENCES `base_conhecimento`.`plataformas` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_BaseConhecimento_BaseConhecimento1`
    FOREIGN KEY (`codigo_pai`)
    REFERENCES `base_conhecimento`.`bases` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bases_usuarios1`
    FOREIGN KEY (`codigo_usuario`)
    REFERENCES `base_conhecimento`.`usuarios` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`conteudos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`conteudos` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`conteudos` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_base` INT NOT NULL,
  `titulo` VARCHAR(255) NOT NULL,
  `descricao` TEXT NOT NULL,
  `data_hora` DATETIME NOT NULL,
  `situacao` TINYINT NOT NULL COMMENT '1) Aguardando Aprovação\n2) Necessita de Revisão\n3) Aprovado',
  `publico` TINYINT(1) NOT NULL,
  `tipo` INT NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_Conteudo_BaseConhecimento1_idx` (`codigo_base` ASC),
  CONSTRAINT `fk_Conteudo_BaseConhecimento1`
    FOREIGN KEY (`codigo_base`)
    REFERENCES `base_conhecimento`.`bases` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`palavraschave`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`palavraschave` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`palavraschave` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `codigo_plataforma` INT NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_PalavraChave_Plataforma1_idx` (`codigo_plataforma` ASC),
  CONSTRAINT `fk_PalavraChave_Plataforma1`
    FOREIGN KEY (`codigo_plataforma`)
    REFERENCES `base_conhecimento`.`plataformas` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`conteudo_palavraschave`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`conteudo_palavraschave` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`conteudo_palavraschave` (
  `codigo_conteudo` INT NOT NULL,
  `codigo_palavraschave` INT NOT NULL,
  PRIMARY KEY (`codigo_conteudo`, `codigo_palavraschave`),
  INDEX `fk_Conteudo_has_PalavraChave_PalavraChave1_idx` (`codigo_palavraschave` ASC),
  INDEX `fk_Conteudo_has_PalavraChave_Conteudo1_idx` (`codigo_conteudo` ASC),
  CONSTRAINT `fk_Conteudo_has_PalavraChave_Conteudo1`
    FOREIGN KEY (`codigo_conteudo`)
    REFERENCES `base_conhecimento`.`conteudos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Conteudo_has_PalavraChave_PalavraChave1`
    FOREIGN KEY (`codigo_palavraschave`)
    REFERENCES `base_conhecimento`.`palavraschave` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`base_palavraschave`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`base_palavraschave` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`base_palavraschave` (
  `codigo_base` INT NOT NULL,
  `codigo_palavraschave` INT NOT NULL,
  PRIMARY KEY (`codigo_base`, `codigo_palavraschave`),
  INDEX `fk_PalavraChave_has_BaseConhecimento_BaseConhecimento1_idx` (`codigo_base` ASC),
  INDEX `fk_PalavraChave_has_BaseConhecimento_PalavraChave1_idx` (`codigo_palavraschave` ASC),
  CONSTRAINT `fk_PalavraChave_has_BaseConhecimento_PalavraChave1`
    FOREIGN KEY (`codigo_palavraschave`)
    REFERENCES `base_conhecimento`.`palavraschave` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PalavraChave_has_BaseConhecimento_BaseConhecimento1`
    FOREIGN KEY (`codigo_base`)
    REFERENCES `base_conhecimento`.`bases` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`artigos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`artigos` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`artigos` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_conteudo` INT NOT NULL,
  `texto` TEXT NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_Artigo_Conteudo1_idx` (`codigo_conteudo` ASC),
  CONSTRAINT `fk_Artigo_Conteudo1`
    FOREIGN KEY (`codigo_conteudo`)
    REFERENCES `base_conhecimento`.`conteudos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`arquivos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`arquivos` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`arquivos` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_conteudo` INT NOT NULL,
  `nome` VARCHAR(255) NULL,
  `extensao` VARCHAR(45) NULL,
  `caminho` VARCHAR(255) NOT NULL,
  `tamanho` BIGINT NULL COMMENT 'bytes',
  PRIMARY KEY (`codigo`),
  INDEX `fk_arquivos_conteudos1_idx` (`codigo_conteudo` ASC),
  CONSTRAINT `fk_arquivos_conteudos1`
    FOREIGN KEY (`codigo_conteudo`)
    REFERENCES `base_conhecimento`.`conteudos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`audios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`audios` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`audios` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_arquivo` INT NOT NULL,
  `duracao` TIME NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_audios_arquivos1_idx` (`codigo_arquivo` ASC),
  CONSTRAINT `fk_audios_arquivos1`
    FOREIGN KEY (`codigo_arquivo`)
    REFERENCES `base_conhecimento`.`arquivos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`imagens`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`imagens` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`imagens` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_arquivo` INT NOT NULL,
  `altura` INT NOT NULL,
  `largura` INT NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_imagens_arquivos1_idx` (`codigo_arquivo` ASC),
  CONSTRAINT `fk_imagens_arquivos1`
    FOREIGN KEY (`codigo_arquivo`)
    REFERENCES `base_conhecimento`.`arquivos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`videos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`videos` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`videos` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_arquivo` INT NOT NULL,
  `duracao` TIME NOT NULL,
  `altura` INT NOT NULL,
  `largura` INT NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_videos_arquivos1_idx` (`codigo_arquivo` ASC),
  CONSTRAINT `fk_videos_arquivos1`
    FOREIGN KEY (`codigo_arquivo`)
    REFERENCES `base_conhecimento`.`arquivos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`links`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`links` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`links` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_conteudo` INT NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_links_conteudos1_idx` (`codigo_conteudo` ASC),
  CONSTRAINT `fk_links_conteudos1`
    FOREIGN KEY (`codigo_conteudo`)
    REFERENCES `base_conhecimento`.`conteudos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`perguntas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`perguntas` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`perguntas` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_conteudo` INT NOT NULL,
  `texto` TEXT NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_perguntas_conteudos1_idx` (`codigo_conteudo` ASC),
  CONSTRAINT `fk_perguntas_conteudos1`
    FOREIGN KEY (`codigo_conteudo`)
    REFERENCES `base_conhecimento`.`conteudos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`respostas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`respostas` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`respostas` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_pergunta` INT NOT NULL,
  `texto` TEXT NOT NULL,
  `codigo_usuario` INT NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_respostas_perguntas1_idx` (`codigo_pergunta` ASC),
  INDEX `fk_respostas_usuarios1_idx` (`codigo_usuario` ASC),
  CONSTRAINT `fk_respostas_perguntas1`
    FOREIGN KEY (`codigo_pergunta`)
    REFERENCES `base_conhecimento`.`perguntas` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_respostas_usuarios1`
    FOREIGN KEY (`codigo_usuario`)
    REFERENCES `base_conhecimento`.`usuarios` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`livros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`livros` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`livros` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_conteudo` INT NOT NULL,
  `subtitulo` VARCHAR(255) NULL,
  `autor` VARCHAR(255) NOT NULL,
  `paginas` INT NULL,
  `edicao` INT NULL,
  `editora` VARCHAR(255) NULL,
  `ano` CHAR(4) NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_livros_conteudos1_idx` (`codigo_conteudo` ASC),
  CONSTRAINT `fk_livros_conteudos1`
    FOREIGN KEY (`codigo_conteudo`)
    REFERENCES `base_conhecimento`.`conteudos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`anexos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`anexos` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`anexos` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_resposta` INT NOT NULL,
  `caminho` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_anexos_respostas1_idx` (`codigo_resposta` ASC),
  CONSTRAINT `fk_anexos_respostas1`
    FOREIGN KEY (`codigo_resposta`)
    REFERENCES `base_conhecimento`.`respostas` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`comentarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`comentarios` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`comentarios` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_conteudo` INT NOT NULL,
  `texto` TEXT NOT NULL,
  `data_hora` DATETIME NOT NULL,
  `aprovado` TINYINT(1) NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_comentarios_conteudos1_idx` (`codigo_conteudo` ASC),
  CONSTRAINT `fk_comentarios_conteudos1`
    FOREIGN KEY (`codigo_conteudo`)
    REFERENCES `base_conhecimento`.`conteudos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`revisoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`revisoes` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`revisoes` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_conteudo` INT NOT NULL,
  `codigo_usuario` INT NOT NULL,
  `data_hora` DATETIME NOT NULL,
  `texto` TEXT NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC),
  INDEX `fk_revisoes_conteudos1_idx` (`codigo_conteudo` ASC),
  INDEX `fk_revisoes_usuarios1_idx` (`codigo_usuario` ASC),
  CONSTRAINT `fk_revisoes_conteudos1`
    FOREIGN KEY (`codigo_conteudo`)
    REFERENCES `base_conhecimento`.`conteudos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_revisoes_usuarios1`
    FOREIGN KEY (`codigo_usuario`)
    REFERENCES `base_conhecimento`.`usuarios` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`campos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`campos` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`campos` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `obrigatorio` TINYINT(1) NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`metadados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`metadados` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`metadados` (
  `codigo_usuario` INT NOT NULL,
  `codigo_campo` INT NOT NULL,
  `valor` TEXT NULL,
  INDEX `fk_usuarios_has_campos_campos1_idx` (`codigo_campo` ASC),
  INDEX `fk_usuarios_has_campos_usuarios1_idx` (`codigo_usuario` ASC),
  CONSTRAINT `fk_usuarios_has_campos_usuarios1`
    FOREIGN KEY (`codigo_usuario`)
    REFERENCES `base_conhecimento`.`usuarios` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_campos_campos1`
    FOREIGN KEY (`codigo_campo`)
    REFERENCES `base_conhecimento`.`campos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`funcoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`funcoes` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`funcoes` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `tipo` INT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`grupos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`grupos` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`grupos` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` TEXT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`permissoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`permissoes` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`permissoes` (
  `codigo_funcao` INT NOT NULL,
  `codigo_grupo` INT NOT NULL,
  PRIMARY KEY (`codigo_funcao`, `codigo_grupo`),
  INDEX `fk_funcoes_has_grupos_grupos1_idx` (`codigo_grupo` ASC),
  INDEX `fk_funcoes_has_grupos_funcoes1_idx` (`codigo_funcao` ASC),
  CONSTRAINT `fk_funcoes_has_grupos_funcoes1`
    FOREIGN KEY (`codigo_funcao`)
    REFERENCES `base_conhecimento`.`funcoes` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_funcoes_has_grupos_grupos1`
    FOREIGN KEY (`codigo_grupo`)
    REFERENCES `base_conhecimento`.`grupos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_conhecimento`.`acessos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`acessos` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`acessos` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_base` INT NOT NULL,
  `codigo_grupo` INT NOT NULL,
  `codigo_usuario` INT NOT NULL,
  `data_hora` DATETIME NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_grupos_has_usuarios_usuarios1_idx` (`codigo_usuario` ASC),
  INDEX `fk_grupos_has_usuarios_grupos1_idx` (`codigo_grupo` ASC),
  INDEX `fk_grupos_has_usuarios_BaseConhecimento1_idx` (`codigo_base` ASC),
  CONSTRAINT `fk_grupos_has_usuarios_grupos1`
    FOREIGN KEY (`codigo_grupo`)
    REFERENCES `base_conhecimento`.`grupos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupos_has_usuarios_usuarios1`
    FOREIGN KEY (`codigo_usuario`)
    REFERENCES `base_conhecimento`.`usuarios` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupos_has_usuarios_BaseConhecimento1`
    FOREIGN KEY (`codigo_base`)
    REFERENCES `base_conhecimento`.`bases` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `base_conhecimento`.`auditorias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`auditorias` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`auditorias` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_funcao` INT NOT NULL,
  `codigo_acesso` INT NOT NULL,
  `data_hora` DATETIME NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_auditorias_funcoes1_idx` (`codigo_funcao` ASC),
  INDEX `fk_auditorias_acessos1_idx` (`codigo_acesso` ASC),
  CONSTRAINT `fk_auditorias_funcoes1`
    FOREIGN KEY (`codigo_funcao`)
    REFERENCES `base_conhecimento`.`funcoes` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_auditorias_acessos1`
    FOREIGN KEY (`codigo_acesso`)
    REFERENCES `base_conhecimento`.`acessos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `base_conhecimento`.`visitas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `base_conhecimento`.`visitas` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`visitas` (
  `codigo_visita` INT NOT NULL AUTO_INCREMENT,
  `data_hora` DATETIME NOT NULL,
  `key` VARCHAR(255) NOT NULL COMMENT '   ',
  `codigo_conteudo` INT NOT NULL,
  `codigo_base` INT NOT NULL,
  PRIMARY KEY (`codigo_visita`),
  INDEX `fk_visitas_conteudos1_idx` (`codigo_conteudo` ASC),
  INDEX `fk_visitas_bases1_idx` (`codigo_base` ASC),
  CONSTRAINT `fk_visitas_conteudos1`
    FOREIGN KEY (`codigo_conteudo`)
    REFERENCES `base_conhecimento`.`conteudos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_visitas_bases1`
    FOREIGN KEY (`codigo_base`)
    REFERENCES `base_conhecimento`.`bases` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `base_conhecimento`.`outros`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `base_conhecimento`.`outros` ;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`outros` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_arquivo` INT NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_imagens_arquivos1_idx` (`codigo_arquivo` ASC),
  CONSTRAINT `fk_imagens_arquivos10`
    FOREIGN KEY (`codigo_arquivo`)
    REFERENCES `base_conhecimento`.`arquivos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

DROP TABLE IF EXISTS `base_conhecimento`.`conteudo_favoritos`;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`conteudo_favoritos` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_usuario` INT NOT NULL,
  `codigo_conteudo` INT NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_favoritos_usuarios1_idx` (`codigo_usuario` ASC),
  INDEX `fk_favoritos_conteudos1_idx` (`codigo_conteudo` ASC),
  CONSTRAINT `fk_favoritos_usuarios1`
    FOREIGN KEY (`codigo_usuario`)
    REFERENCES `base_conhecimento`.`usuarios` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_favoritos_conteudos1`
    FOREIGN KEY (`codigo_conteudo`)
    REFERENCES `base_conhecimento`.`conteudos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

DROP TABLE IF EXISTS `base_conhecimento`.`base_favoritos`;

CREATE TABLE IF NOT EXISTS `base_conhecimento`.`base_favoritos` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `codigo_usuario` INT NOT NULL,
  `codigo_base` INT NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_base_favoritos_usuarios1_idx` (`codigo_usuario` ASC),
  INDEX `fk_base_favoritos_bases1_idx` (`codigo_base` ASC),
  CONSTRAINT `fk_base_favoritos_usuarios1`
    FOREIGN KEY (`codigo_usuario`)
    REFERENCES `base_conhecimento`.`usuarios` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_base_favoritos_bases1`
    FOREIGN KEY (`codigo_base`)
    REFERENCES `base_conhecimento`.`bases` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;




INSERT INTO `usuarios` (`codigo`, `nome`, `email`, `senha`, `descricao`, `foto`, `situacao`) VALUES
(1, 'Wellington Costa', 'wcosta.ale@gmail.com', '1234', 'Rá! ', NULL, 1),
(2, 'Natã Locão', 'nata@gmail.com', '1234', 'Ha', NULL, 1),
(3, 'Iago ruim de bola', 'iago@gmail.com', '1234', NULL, NULL, 1),
(4, 'Felipe micreiro', 'felipe@gmail.com', '1234', 'Ra', NULL, 1);

INSERT INTO `plataformas` (`codigo`, `nome`, `descricao`, `codigo_usuario`) VALUES
(1, 'IFSPCJO', 'A plataforma do IFSPCJO é um repositório organizado de conhecimentos do Instituto Federal Campus Campos do Jordão', 1);

INSERT INTO `bases` (`codigo`, `codigo_plataforma`, `nome`, `descricao`, `data_hora`, `publica`, `codigo_pai`, `codigo_usuario`) VALUES
(1, 1, 'Otimização Matemática', 'Lorem ipsum dolor sit amet, consectetur  nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequatconsectetur  nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat', '2014-10-21 00:00:00', 1, NULL, 1),
(2, 1, 'Desenvolvimento PHP', 'Lorem ipsum dolor sit amet, consectetur  nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequatconsectetur  nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat', '2014-10-21 00:00:00', 1, NULL, 1),
(3, 1, 'Engenharia de Software', 'Lorem ipsum dolor sit amet, consectetur  nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequatconsectetur  nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat', '2014-10-21 00:00:00', 1, NULL, 1),
(4, 1, 'Redes de Computadores', 'Lorem ipsum dolor sit amet, consectetur  nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequatconsectetur  nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat', '2014-10-21 00:00:00', 1, NULL, 1),
(5, 1, 'Matemática Discreta', 'Lorem ipsum dolor sit amet, consectetur  nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequatconsectetur  nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat', '2014-10-21 00:00:00', 1, NULL, 1),
(6, 1, 'Lógica de Programação', 'Lorem ipsum dolor sit amet, consectetur  nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequatconsectetur  nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat', '2014-10-21 00:00:00', 1, NULL, 1),
(7, '1', 'Algoritmos de busca', 'sdfsdfsdfsdfsdfasdfasdfsdfsadf', '2014-10-30 00:00:00', '1', '6', '1'),
(8, '1', 'Metodologias de Desenvolvimento', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2014-10-30 00:00:00', '1', '3', '1');

INSERT INTO `campos` (`codigo`, `nome`, `obrigatorio`, `tipo`) VALUES
(1, 'Telefone', 0, 'text');

INSERT INTO `conteudos` (`codigo`, `codigo_base`, `titulo`, `descricao`, `data_hora`, `situacao`, `publico`, `tipo`) VALUES
(1, 3, 'Fundamentos de Engenharia de Software - Introdução', '', '2014-10-23 00:00:00', 3, 1, 1),
(2, 3, 'Fundamentos Engenharia de Software - Princípios', '', '2014-10-23 00:00:00', 3, 1, 1),
(3, 3, 'Requisitos Funcionais', '', '2014-10-23 00:00:00', 3, 1, 1),
(4, 3, 'Casos de Uso', '', '2014-10-23 00:00:00', 3, 1, 1),
(5, 3, 'Introdução a Projeto de Software', '', '2014-10-23 00:00:00', 3, 1, 1),
(6, 3, 'Projeto de Arquitetura', '', '2014-10-23 00:00:00', 3, 1, 1),
(7, 2, 'Link para Estudos', 'Ótimo link para estudos', '2014-10-23 00:00:00', 3, 1, 7),
(8, 3, 'Engenharia de Software uma Abordagem Profissional', 'Livro sobre Engenharia de Software', '2014-10-23 00:00:00', 3, 1, 5),
(9, 3, 'Caso de Uso', 'Exemplo de Caso de Uso', '2014-10-23 00:00:00', 3, 1, 3),
(10, 3, 'Vídeo Aula UML', 'Vídeo Aula de introdução ao UML', '2014-10-23 00:00:00', 3, 1, 2),
(11, 3, 'Dúvidas e Dicas - Requisitos Funcionais', 'Algumas das principais dúvidas na hora de fazer o análise requisitos funcionais ', '2014-10-24 00:00:00', 3, 1, 6),
(12, 3, 'Podcast - Caso de Uso', 'Podcast introdução a UML e Casos de Uso', '2014-10-24 00:00:00', 3, 1, 4),
(13, 3, 'Diagrama de Classe - UML', 'Exmplo de Diagrama de Classe em UML', '2014-10-24 00:00:00', 3, 1, 3),
(14, 3, 'Exmplo de Caso de Uso', 'Exmplo de Caso de Uso', '2014-10-24 00:00:00', 3, 1, 8);

INSERT INTO `artigos` (`codigo`, `codigo_conteudo`, `texto`) VALUES
(1, 1, 'Tópicos\r\n• Natureza do Software\r\n• Definição de Software\r\n• Aplicações de Software\r\n• Software Legado\r\n• Aplicativos Web\r\n• Engenharia de Software\r\n• Como Aplicar a Engenharia de Software\r\n• Processo\r\n• Princípios\r\n• Mitos'),
(2, 2, 'Tópicos\r\n• Princípios Fundamentais\r\n• Orientam o processo\r\n• Orientam a prática\r\n• Princípios de Atividades Metodológicas\r\n• Comunicação\r\n• Planejamento\r\n• Modelagem\r\n• Requisitos\r\n• Projeto'),
(3, 3, 'bla bla bla'),
(4, 4, 'Casos de Usoooooooooooooooooooooo'),
(5, 5, 'Tópicos\r\n• Panorama\r\n• O que é projeto de software?\r\n• Qual o objetivo?\r\n• Quem realiza?\r\n• Por que é importante?\r\n• Quais as etapas envolvidas?\r\n• O que é gerado?\r\n• Estratégia Diversificação/Convergência\r\n• Projeto na Engenharia de Software\r\n• Processo de Projeto\r\n• Conceitos de Projeto'),
(6, 6, 'Tópicos\r\n• Panorama\r\n• O que é projeto de arquitetura?\r\n• Quem realiza?\r\n• Por que é importante?\r\n• Gêneros de Arquitetura\r\n• Estilos de Arquitetura');

INSERT INTO `arquivos` (`codigo`, `codigo_conteudo`, `nome`, `extensao`, `caminho`, `tamanho`) VALUES
(1, 9, 'Exemplo Caso de Uso', 'gif', 'http://epf.eclipse.org/wikis/openuppt/openup_basic/guidances/concepts/resources/ATMUCdiagram.GIF', 40),
(3, 10, 'UML - Caso de Uso', '', '//www.youtube.com/embed/fx0mBsgS4Uw', 0),
(4, 12, 'Podcast - Use Case', 'mp3', 'http://shows.thirstydeveloper.com/TD046.mp3', 100),
(5, 13, 'Exmplo de Diagrama de Classe - UML', 'gif', 'http://www.dsc.ufcg.edu.br/~jacques/cursos/map/html/uml/diagramas/classes/images/conceitual_exemplo_banco.GIF', 20),
(6, 14, 'Exemplos Caso de Uso', 'zip', 'caso_de_uso.zip', '230');

INSERT INTO `imagens` (`codigo`, `codigo_arquivo`, `altura`, `largura`) VALUES
(1, 1, '100', '100'),
(2, 5, '100', '100');

INSERT INTO `outros` (`codigo`, `codigo_arquivo`, `descricao`) VALUES
(1, 6, 'Arquivo compactado');

INSERT INTO `audios` (`codigo`, `codigo_arquivo`, `duracao`) VALUES
(1, 4, '00:20:00');

INSERT INTO `links` (`codigo`, `codigo_conteudo`, `url`) VALUES
(1, 7, 'http://localhost/base_conhecimento/index.php/base/index/3');


INSERT INTO `funcoes` (`codigo`, `nome`, `tipo`) VALUES
(1, 'Cadastrar Usuário', 1);

INSERT INTO `grupos` (`codigo`, `nome`, `descricao`) VALUES
(1, 'Administrador', NULL),
(2, 'Proprietário', NULL),
(3, 'Colaborador', NULL),
(4, 'Membro', NULL);


INSERT INTO `livros` (`codigo`, `codigo_conteudo`, `subtitulo`, `autor`, `paginas`, `edicao`, `editora`, `ano`) VALUES
(1, 8, 'Uma Abordagem Profissional', 'Roger S. Pressman', 300, 7, 'Mc Graw Hill', '2012-01-01');

INSERT INTO `palavraschave` (`codigo`, `titulo`, `codigo_plataforma`) VALUES
(1, 'Instituto', 1),
(2, 'Federal', 1),
(3, 'Plataforma', 1),
(4, 'IFSP', 1),
(5, 'Engenharia de Software', 1),
(6, 'UML', 1);

INSERT INTO `base_palavraschave` (`codigo_base`, `codigo_palavraschave`) VALUES
(3, 5),
(3, 6);

INSERT INTO `conteudo_palavraschave` (`codigo_conteudo`, `codigo_palavraschave`) VALUES
(1, 5),
(10, 6);

INSERT INTO `perguntas` (`codigo`, `codigo_conteudo`, `texto`) VALUES
(1, 11, 'Como é feito?'),
(2, 11, 'Como eu relaciono um requisito em um caso de uso textual?');


INSERT INTO `respostas` (`codigo`, `codigo_pergunta`, `texto`, `codigo_usuario`) VALUES
(1, 1, 'Em uma tabela deve ser preenchido os seguintes campos: Referência do requisito ex.(RF1). Descrição do requisito e prioridade.', 1),
(2, 2, 'Cada requisito funcional pode ser relacionado com um caso de uso textual e é especificado no campo: Requisito relacionado', 2);

INSERT INTO `permissoes` (`codigo_funcao`, `codigo_grupo`) VALUES
(1, 1);

INSERT INTO `revisoes` (`codigo`, `codigo_conteudo`, `codigo_usuario`, `data_hora`, `texto`) VALUES
(1, 1, 2, '2014-10-23 00:00:00', 'Aprovado'),
(2, 2, 3, '2014-10-23 00:00:00', 'Aprovado');


INSERT INTO `metadados` (`codigo_usuario`, `codigo_campo`, `valor`) VALUES
(1, 1, '1233334444');

INSERT INTO `videos` (`codigo`, `codigo_arquivo`, `duracao`, `altura`, `largura`) VALUES
(1, 3, '00:21:37', 0, 0);

INSERT INTO `comentarios` (`codigo`, `codigo_conteudo`, `texto`, `data_hora`, `aprovado`) VALUES
(1, 1, 'ótimo conteúdo com exemplos claros', '2014-10-24 00:00:00', 1);

INSERT INTO `acessos` (`codigo`, `codigo_base`, `codigo_grupo`, `codigo_usuario`, `data_hora`) VALUES
(1, 1, 1, 2, '2014-10-23 00:00:00');

INSERT INTO `auditorias` (`codigo`, `codigo_funcao`, `codigo_acesso`, `data_hora`) VALUES
(1, 1, 1, '2014-10-24 00:00:00');

INSERT INTO `anexos` (`codigo`, `codigo_resposta`, `caminho`) VALUES
(1, 2, 'http://www.scielo.br/img/revistas/tla/v49n1/09f1.gif');


  INSERT INTO `visitas` (`codigo_visita`, `data_hora`, `key`, `codigo_conteudo`, `codigo_base`) VALUES
(1, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 6, 3),
(2, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 6, 3),
(3, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 6, 3),
(4, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 6, 3),
(5, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 6, 3),
(6, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 6, 3),
(7, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 6, 3),
(8, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 6, 3),
(9, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 6, 3),
(10, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 6, 3),
(11, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 6, 3),
(12, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 6, 3),
(13, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 6, 3),
(14, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 6, 3),
(15, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 6, 3),
(16, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 10, 3),
(17, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 10, 3),
(18, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 10, 3),
(19, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 10, 3),
(20, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 10, 3),
(21, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 10, 3),
(22, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 10, 3),
(23, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 10, 3),
(24, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 10, 3),
(25, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 10, 3),
(26, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 10, 3),
(27, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 14, 3),
(28, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 14, 3),
(29, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 14, 3),
(30, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 14, 3),
(31, '2014-11-05 00:00:00', 'asdf23j4lksdk23jljk', 14, 3);



