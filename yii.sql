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


INSERT INTO `yii2`.`bairros` (`bairro`, `cidade_id`) 
  VALUES 
    ('Bangu', '1'),
    ('Campestre','1'),
    ('Capuava','1'),
    ('Casa Branca','1'),
    ('Cata Preta','1'),
    ('Centreville','1'),
    ('Centro','1'),
    ('Chácara Engenho da Serra','1'),
    ('Cidade Recreio da Borda do Campo','1'),
    ('Cidade São Jorge','1'),
    ('Condomínio Maracanã','1'),
    ('Conjunto Dona Beatriz','1'),
    ('Conjunto Habitacional Jardim Santo André','1'),
    ('Estância Rio Grande','1'),
    ('Jardim','1'),
    ('Jardim Aclimação','1'),
    ('Jardim Alvorada','1'),
    ('Jardim Alzira Franco','1'),
    ('Jardim Ana Maria','1'),
    ('Jardim Bela Vista','1'),
    ('Jardim Bom Pastor','1'),
    ('Jardim Cambuí','1'),
    ('Jardim Cipreste','1'),
    ('Jardim Clube de Campo','1'),
    ('Jardim Cristiane','1'),
    ('Jardim das Maravilhas','1'),
    ('Jardim do Estádio','1'),
    ('Jardim Europa','1'),
    ('Jardim Guarará','1'),
    ('Jardim Guaripocaba','1'),
    ('Jardim Ipanema','1'),
    ('Jardim Irene','1'),
    ('Jardim Itapoan','1'),
    ('Jardim Jamaica','1'),
    ('Jardim Las Vegas','1'),
    ('Jardim Marek','1'),
    ('Jardim Monções','1'),
    ('Jardim Ocara','1'),
    ('Jardim Oriental','1'),
    ('Jardim Paraíso','1'),
    ('Jardim Progresso','1'),
    ('Jardim Renata','1'),
    ('Jardim Rina','1'),
    ('Jardim Riviera','1'),
    ('Jardim Santa Cristina','1'),
    ('Jardim Santo Alberto','1'),
    ('Jardim Santo André','1'),
    ('Jardim Santo Antônio','1'),
    ('Jardim Santo Antônio de Pádua','1'),
    ('Jardim Silvana','1'),
    ('Jardim Stella','1'),
    ('Jardim Stetel','1'),
    ('Jardim Teles de Menezes','1'),
    ('Jardim Utinga','1'),
    ('Jardim Vila Rica','1')
    ('Loteamento Tamaratuca','1'),
    ('Núcleo Lamartine','1'),
    ('Paraíso','1'),
    ('Paranapiacaba','1'),
    ('Parque Andreense','1'),
    ('Parque Bandeirante','1'),
    ('Parque Capuava','1'),
    ('Parque das Nações','1'),
    ('Parque Erasmo Assunção','1'),
    ('Parque Gerassi','1'),
    ('Parque Industriário','1'),
    ('Parque Jacatuba','1'),
    ('Parque João Ramalho','1'),
    ('Parque Marajoara','1'),
    ('Parque Miami','1'),
    ('Parque Nações','1'),
    ('Parque Novo Oratório','1'),
    ('Parque Oratório','1'),
    ('Parque Represa Billings','1'),
    ('Parque Rio Grande','1'),
    ('Santa Maria','1'),
    ('Santa Teresinha','1'),
    ('Santo Antônio','1'),
    ('Silveira','1'),
    ('Sítio Cassaquera','1'),
    ('Sítio dos Vianas','1'),
    ('Sítio Taquaral','1'),
    ('Utinga','1'),
    ('Vila Alice','1'),
    ('Vila Alpina','1'),
    ('Vila Alto de Santo André','1'),
    ('Vila Alzira','1'),
    ('Vila Amabile Pezzolo','1'),
    ('Vila América','1'),
    ('Vila Apiaí','1'),
    ('Vila Aquilino','1'),
    ('Vila Assunção','1'),
    ('Vila Bastos','1'),
    ('Vila Bela Vista','1'),
    ('Vila Boa Vista','1'),
    ('Vila Camilópolis','1'),
    ('Vila Cecília Maria','1'),
    ('Vila Clarice','1'),
    ('Vila Cláudio','1'),
    ('Vila Curuçá','1'),
    ('Vila Dora','1'),
    ('Vila Elclor','1'),
    ('Vila Eldizia','1'),
    ('Vila Floresta','1'),
    ('Vila Francisco Matarazzo','1'),
    ('Vila Gilda','1'),
    ('Vila Guaraciaba','1'),
    ('Vila Guarani','1'),
    ('Vila Guarará','1'),
    ('Vila Guiomar','1'),
    ('Vila Helena','1'),
    ('Vila Homero Thon','1'),
    ('Vila Humaitá','1'),
    ('Vila João Ramalho','1'),
    ('Vila Junqueira','1'),
    ('Vila Lea','1'),
    ('Vila Linda','1'),
    ('Vila Lucinda','1'),
    ('Vila Lutecia','1'),
    ('Vila Luzita','1'),
    ('Vila Marajó','1'),
    ('Vila Marina','1'),
    ('Vila Mazzei','1'),
    ('Vila Metalúrgica','1'),
    ('Vila Palmares','1'),
    ('Vila Pinheirinho','1'),
    ('Vila Pires','1'),
    ('Vila Príncipe de Gales','1'),
    ('Vila Progresso','1'),
    ('Vila Prosperidade','1'),
    ('Vila Sacadura Cabral','1'),
    ('Vila Santa Teresa','1'),
    ('Vila Santo Alberto','1'),
    ('Vila São João','1'),
    ('Vila São Pedro','1'),
    ('Vila Scarpelli','1'),
    ('Vila Silvestre','1'),
    ('Vila Suíça','1'),
    ('Vila Tibiriçá','1'),
    ('Vila Valparaíso','1'),
    ('Vila Vitória','1'),
    ('Alto da Serra','2'),
    ('Alto Industrial','2'),
    ('Alvarenga','2'),
    ('Alves Dias','2'),
    ('Anchieta','2'),
    ('Assunção','2'),
    ('Baeta Neves','2'),
    ('Balneária','2'),
    ('Batistini','2'),
    ('Capivari','2'),
    ('Casa','2'),
    ('Centro','2'),
    ('Cooperativa','2'),
    ('Curucutu','2'),
    ('Demarchi','2'),
    ('dos Casa','2'),
    ('dos Finco','2'),
    ('Favela Jardim Silvina','2'),
    ('Ferrazópolis','2'),
    ('Independência','2'),
    ('Jardim do Mar','2'),
    ('Jardim Farina','2'),
    ('Jardim Imperador','2'),
    ('Jardim Independência','2'),
    ('Jardim Industrial','2'),
    ('Jardim Jussara','2'),
    ('Jardim Las Vegas','2'),
    ('Jardim Laura','2'),
    ('Jardim Los Angeles','2'),
    ('Jardim Maria Adelaide','2'),
    ('Jardim Nazareth','2'),
    ('Jardim Novo Horizonte','2'),
    ('Jardim O Ipe','2'),
    ('Jardim Olavo Bilac','2'),
    ('Jardim Petroni','2'),
    ('Jardim Regina','2'),
    ('Jardim São Luís','2'),
    ('Jordanópolis','2'),
    ('Montanhão','2'),
    ('Nova Baeta','2'),
    ('Nova Petrópolis','2'),
    ('Parque Botujuru','2'),
    ('Parque São Bernardo','2'),
    ('Parque São Bernardo Novo','2'),
    ('Parque Selecta','2'),
    ('Parque Terra Nova','2'),
    ('Parque Terra Nova II','2'),
    ('Pauliceia','2'),
    ('Planalto','2'),
    ('Rio Grande','2'),
    ('Rudge Ramos','2'),
    ('Santa Cruz','2'),
    ('Santa Terezinha','2'),
    ('Sítio Bela Vista','2'),
    ('Taboão','2'),
    ('Taquacetuba','2'),
    ('Tatetos','2'),
    ('Vila das Valsas','2'),
    ('Vila Euclídes','2'),
    ('Vila Gonçalves','2'),
    ('Vila Industrial','2'),
    ('Vila Lusitânia','2'),
    ('Vila Santa Mônica','2'),
    ('Vila Scopel','2'),
    ('Vila Tupi','2'),
    ('Vila Vianas','2'),
    ('Zanzala','2')
    ('Barcelona','3'),
    ('Boa Vista','3'),
    ('Centro','3'),
    ('Cerâmica','3'),
    ('Fundação','3'),
    ('Jardim São Caetano','3'),
    ('Mauá','3'),
    ('Nova Gerty','3'),
    ('Olímpico','3'),
    ('Osvaldo Cruz','3'),
    ('Prosperidade','3'),
    ('Santa Maria','3'),
    ('Santa Paula','3'),
    ('Santo Antônio','3'),
    ('São José','3')
    ('Campanário','4'),
    ('Canhema','4'),
    ('Casa Grande','4'),
    ('Centro','4'),
    ('Eldorado','4'),
    ('Inamar','4'),
    ('Jardim União','4'),
    ('Piraporinha','4'),
    ('Serraria','4'),
    ('Taboão','4'),
    ('Vila Nogueira','4'),
    ("Alto Boa Vista","5"),
    ("Alto da Boa Vista","5"),
    ("Capuava","5"),
    ("Centro","5"),
    ("Chácara Maria Aparecida","5"),
    ("Chácara Maria Francisca","5"),
    ("Chácara São Braz","5"),
    ("Chácara São Lucido","5"),
    ("Jardim Adelina","5"),
    ("Jardim Anchieta","5"),
    ("Jardim Aracy","5"),
    ("Jardim Araguaia","5"),
    ("Jardim Bela Vista","5"),
    ("Jardim Bogus","5"),
    ("Jardim Bom Recanto","5"),
    ("Jardim Camila","5"),
    ("Jardim Campo Verde","5"),
    ("Jardim Canadá","5"),
    ("Jardim Cerqueira Leite","5"),
    ("Jardim Colúmbia","5"),
    ("Jardim Cruzeiro","5"),
    ("Jardim Cruzeiro do Sul","5"),
    ("Jardim Éden","5"),
    ("Jardim Elizabeth","5"),
    ("Jardim Esperança","5"),
    ("Jardim Estrela","5"),
    ("Jardim Flórida","5"),
    ("Jardim Guapituba","5"),
    ("Jardim Haydee","5"),
    ("Jardim Hélida","5"),
    ("Jardim Ipe","5"),
    ("Jardim Itapark Novo","5"),
    ("Jardim Itapark Velho","5"),
    ("Jardim Itapeva","5"),
    ("Jardim Luzitano","5"),
    ("Jardim Maria Eneida","5"),
    ("Jardim Maringá","5"),
    ("Jardim Mauá","5"),
    ("Jardim Miranda D'aviz","5"),
    ("Jardim Olinda","5"),
    ("Jardim Oratório","5"),
    ("Jardim Paranavai","5"),
    ("Jardim Paulista","5"),
    ("Jardim Pedroso","5"),
    ("Jardim Pilar","5"),
    ("Jardim Planalto","5"),
    ("Jardim Primavera","5"),
    ("Jardim Quarto Centenário","5"),
    ("Jardim Rosina","5"),
    ("Jardim Santa Lídia","5"),
    ("Jardim Santista","5"),
    ("Jardim São Francisco","5"),
    ("Jardim São Gabriel","5"),
    ("Jardim São Jorge do Guapituba","5"),
    ("Jardim São José","5"),
    ("Jardim São Judas","5"),
    ("Jardim Sílvia Maria","5"),
    ("Jardim Sônia Maria","5"),
    ("Jardim Taquarussu","5"),
    ("Jardim Zaira","5"),
    ("Loteamento Industrial Coral","5"),
    ("Matriz","5"),
    ("Núcleo Doutor Sampaio Vidal","5"),
    ("Parque Alvorada","5"),
    ("Parque Bandeirantes","5"),
    ("Parque Boa Esperança","5"),
    ("Parque das Américas","5"),
    ("Parque São Vicente","5"),
    ("Recanto Vital Brasil","5"),
    ("São João","5"),
    ("Sertãozinho","5"),
    ("Sítio Bela Vista","5"),
    ("Vila América","5"),
    ("Vila Ana Maria","5"),
    ("Vila Assis Brasil","5"),
    ("Vila Augusto","5"),
    ("Vila Bocaina","5"),
    ("Vila Carlina","5"),
    ("Vila Correia","5"),
    ("Vila Dirce","5"),
    ("Vila Emílio","5"),
    ("Vila Falchi","5"),
    ("Vila Feital","5"),
    ("Vila Flórida","5"),
    ("Vila Guarani","5"),
    ("Vila Independência","5"),
    ("Vila João Ramalho","5"),
    ("Vila Lisboa","5"),
    ("Vila Magini","5"),
    ("Vila Mercedes","5"),
    ("Vila Morelli","5"),
    ("Vila Noêmia","5"),
    ("Vila Nossa Senhora das Vitórias","5"),
    ("Vila Nova Canaã","5"),
    ("Vila Nova Mauá","5"),
    ("Vila Oratório","5"),
    ("Vila Real","5"),
    ("Vila Santa Cecília","5"),
    ("Vila Santa Rosa","5"),
    ("Vila São Francisco","5"),
    ("Vila Tavares","5"),
    ("Aliança","6"),
    ("Barro Branco","6"),
    ("Bocaina","6"),
    ("Centro","6"),
    ("Centro Alto","6"),
    ("Centro de Ouro Fino Paulista","6"),
    ("Colônia","6"),
    ("Itrapoa","6"),
    ("Km 4","6"),
    ("Pastoril","6"),
    ("Pilar Velho","6"),
    ("Ponte Seca","6"),
    ("Pouso Alegre","6"),
    ("Quarta Divisão","6"),
    ("Represa","6"),
    ("Roncon","6"),
    ("Santa Luzia","6"),
    ("Santana","6"),
    ("São Caetaninho","6"),
    ("Somma","6"),
    ("Suíssa","6"),
    ("Tanque Caio","6"),
    ("Tecelão","6"),
    ("Acamp Anchieta","7"),
    ("Centro","7"),
    ("Chácara S Paulo","7"),
    ("Chácara Santa Fé","7"),
    ("Fazenda S Joaquim","7"),
    ("Jardim Encantado","7"),
    ("Jardim Esperança","7"),
    ("Jardim Guaripocaba","7"),
    ("Jardim Joaquim Lima","7"),
    ("Jardim Lavínia","7"),
    ("Jardim Maria Paula","7"),
    ("Jardim Novo Horizonte","7"),
    ("Jardim Oásis Paulista","7"),
    ("Jardim Palmira","7"),
    ("Jardim Rachel","7"),
    ("Jardim Santa Tereza","7"),
    ("Oas Paulist","7"),
    ("Parque América","7"),
    ("Parque Governador","7"),
    ("Parque Indaiá","7"),
    ("Parque Pouso Alegre","7"),
    ("Parque Rio Grande","7"),
    ("Pedreira","7"),
    ("Recanto das Flores","7"),
    ("Recanto Flores","7"),
    ("Recanto Monte Alegre","7"),
    ("Rio Pequeno","7"),
    ("Santa Tereza","7"),
    ("Sítio Maria Joana","7"),
    ("Vila Albano","7"),
    ("Vila Arnaoud","7"),
    ("Vila Arnoud","7"),
    ("Vila Condomínio Siciliano","7"),
    ("Vila Felicidade","7"),
    ("Vila Figueiredo","7"),
    ("Vila Lavínia","7"),
    ("Vila Lopes","7"),
    ("Vila Marcos","7"),
    ("Vila Monte Alegre","7"),
    ("Vila Niwa","7"),
    ("Vila Nova Califórnia","7"),
    ("Vila Oásis Paulista","7"),
    ("Vila Ota","7"),
    ("Vila Recanto Flores","7"),
    ("Vila Rio Grande","7"),
    ("Vila Santa Tereza","7"),
    ("Vila São João","7"),
    ("Vila Suzuki","7"),
    ("Vila Tsuzuki","7")

INSERT INTO `yii2`.`tags` (`tag`)
  VALUES
('Academias de Ginástica'),
('Academias de Natação'),
('Acessórios para Banheiros'),
('Acessórios para Carros'),
('Açougues'),
('Acupuntura'),
('Adegas'),
('Advogados'),
('Afiação de Facas/Tesouras'),
('Agências de Emprego'),
('Agências de Viagem'),
('Água Mineral'),
('Alfaiates'),
('Alimentos'),
('Aluguel de Acess. p/ Festas'),
('Aluguel de Brinquedos'),
('Aluguel de Carros'),
('Aluguel de Trajes'),
('Animação de Festas'),
('Aparelhos Ortopédicos'),
('Aquários'),
('Armarinhos'),
('Artesanato'),
('Artes Marciais'),
('Artigos de Mesa e Cozinha'),
('Artigos Esotéricos'),
('Artigos Esportivos'),
('Artigos para Festas'),
('Artigos Religiosos'),
('Assessoria Contábil'),
('Assistência Técnica'),
('Assistência Técnica (Cel.)'),
('Aulas e Cursos'),
('Auto Escolas'),
('Auto Peças'),
('Azulejos Antigos'),
('Bancas de Jornal'),
('Barzinhos e Chopperias'),
('Berçarios e Pré-Escolas'),
('Bicicletas'),
('Bijouterias'),
('Bolsas e Acessórios'),
('Bordados'),
('Borracha'),
('Boxe'),
('Box para Banheiro'),
('Brechós'),
('Brindes Personalizados'),
('Brinquedos'),
('Brinquedos Educativos'),
('Bronzeamento Artificial'),
('Buffets'),
('Buffets Infantis'),
('Cabeleireiros'),
('Caçambas para Entulho'),
('Cafeterias'),
('Calçados e Acessórios'),
('Cama, Mesa e Banho'),
('Camisetas Promocionais'),
('Capas para Sofá'),
('Capoeira'),
('Carimbos'),
('Cartórios e Tabeliães'),
('Cartuchos Reciclados'),
('Casas de Câmbio'),
('Casas de Repouso'),
('Cestas'),
('Chaveiros'),
('Churrascarias'),
('Cirurgia Plástica'),
('Clínicas de Estética'),
('Clinicas de Vacinação'),
('Coberturas e Telhados'),
('Colchões e Travesseiros'),
('Colégios e Cursos Supletivos'),
('Computadores e Periféricos'),
('Comunicação Visual'),
('Concessionárias'),
('Condomínios'),
('Construção Civil'),
('Construtoras'),
('Convites'),
('Cópias Xerox'),
('Cosméticos'),
('Costureiras'),
('Couro'),
('Curso de Enfermagem'),
('Cursos de Informática'),
('Decoração'),
('Decoração de Eventos'),
('Dedetizadoras'),
('Dentistas'),
('Depilação'),
('Desentup. e Hidráulicas'),
('Despachantes'),
('Diaristas e Faxineiras'),
('Discos, CDs e DVDs'),
('Docerias e Confeitarias'),
('Doces'),
('Drogarias e Farmácias'),
('Eletricistas'),
('Eletro-Eletrônica'),
('Elevadores'),
('Embalagens'),
('Encadernação'),
('Encanador e Hidráulica'),
('Escolas de Dança'),
('Escolas de Futebol'),
('Escolas de Música'),
('Espaços para Eventos'),
('Espelhos'),
('Evangelho de Jesus'),
('Extintores de Incêndio'),
('Faculdades'),
('Fantasias'),
('Farmácias de Manipulação'),
('Ferragens'),
('Fisioterapia'),
('Flats'),
('Floriculturas'),
('Fogos de Artifício'),
('Fonoaudiologos'),
('Fotógrafos'),
('Gesso'),
('Gráficas'),
('Home Theater'),
('Hospitais e Laboratórios'),
('Hotéis'),
('Idiomas'),
('Imobiliárias'),
('Impermeabilização'),
('Informática'),
('Instrumentos Musicais'),
('Ioga (Yoga)'),
('Lanchonetes'),
('Lan Houses'),
('Lavagem de Carros'),
('Lavagem de Sofá e Tapetes'),
('Lavanderias e Tinturarias'),
('Lembrancinhas'),
('Lingerie e Moda Íntima'),
('Livrarias e Revistarias'),
('Lustres'),
('Malhas'),
('Máquinas de Costuras'),
('Marcas e Patentes'),
('Marceneiros'),
('Massagem Terapêutica'),
('Materiais Elétricos'),
('Materiais para Artesanato'),
('Materiais para Construção'),
('Mecânicas e Funilarias'),
('Medicina Estética'),
('Metalurgica'),
('Moda Feminina'),
('Moda Gestante'),
('Moda Infantil'),
('Moda Infanto Juvenil'),
('Moda Masculina'),
('Motéis'),
('Motoboys'),
('Móveis'),
('Mudanças e Carretos'),
('Nautica'),
('Nutricionistas'),
('Óticas'),
('Padarias e Confeitarias'),
('Paisagismo e Jardinagem'),
('Papelarias'),
('Papel e Celulose'),
('Parafusos e Porcas'),
('Pedras Mármores Granito'),
('Pensionatos'),
('Perfumarias'),
('Persianas, Cortinas, Toldos'),
('Pesca, Camping, Mergulho'),
('Pet Shops'),
('Pilates'),
('Pintores'),
('Piscinas'),
('Pisos e Assoalhos'),
('Pizzarias'),
('Planos de Saúde'),
('Plásticos'),
('Plotagem'),
('Podólogos'),
('Portas e Janelas'),
('Portões Automáticos'),
('Presentes'),
('Produtos de Limpeza'),
('Produto Naturais'),
('Produtos para Alérgicos'),
('Produtos para Aniversários'),
('Produtos para Piscinas'),
('Psicólogos'),
('Publicidade e Propaganda'),
('Quadras de Esporte'),
('Quadras de Tênis e Squash'),
('Quadros e Molduras'),
('Quarto de Bebê'),
('Quimica e Farmaceutica'),
('Redes de Proteção'),
('Reforço Escolar'),
('Refrigeração'),
('Reiki'),
('Relojoarias'),
('Restauração'),
('Restaurantes'),
('Restaurantes por Quilo'),
('Revelação de Filmes'),
('Revenda de Automóveis'),
('Rotisserias'),
('Sapatarias'),
('Sebos'),
('Seguros'),
('Serralherias'),
('Silk Screen'),
('Sistemas de Segurança'),
('Suplementos Alimentares'),
('Tapeçarias'),
('Tapetes e Carpetes'),
('Tatuagem'),
('Táxi'),
('Tecidos'),
('Terapia'),
('Textil e Vestuarios'),
('Tintas e Pinturas'),
('Tradução de Documentos'),
('Transportadoras'),
('Transportes'),
('Uniformes'),
('Universidades'),
('Varais'),
('Veiculos'),
('Veterinários'),
('Video Locadoras'),
('Vidraçarias')

INSERT INTO `yii2`.`categorias`
  ('categoria')
VALUES
('Animais'),
('Autônomo'),
('Bebidas'),
('Beleza'),
('Comêrcios'),
('Comidas'),
('Empresas'),
('Eletrônicos'),
('Industrias'),
('Informática'),
('Imóveis'),
('Orgão Público'),
('Telefonia'),
('Saúde')
