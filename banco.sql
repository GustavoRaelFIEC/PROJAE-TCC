
-- CRIAR BANCO
CREATE DATABASE projae;
USE projae;


-- TABELA USUARIOS (LOGIN)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('pessoa','empresa') NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- TABELA PESSOAS
CREATE TABLE pessoas (
    id_pessoa INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    cpf VARCHAR(14) UNIQUE,
    telefone VARCHAR(20),
    instituicao VARCHAR(150),
    curso VARCHAR(100),
    
    id_usuario INT NOT NULL,
    
    CONSTRAINT fk_pessoa_usuario
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- TABELA EMPRESAS
CREATE TABLE empresas (
    id_empresa INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    cnpj VARCHAR(14) UNIQUE,
    telefone VARCHAR(20),
    cidade VARCHAR(100),
    
    id_usuario INT NOT NULL,
    
    CONSTRAINT fk_empresa_usuario
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- TABELA VAGAS
CREATE TABLE vagas (
    id_vaga INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    descricao TEXT,
    tipo ENUM('estagio','aprendiz') NOT NULL,
    salario DECIMAL(10,2),
    cidade VARCHAR(100),
    status ENUM('aberta','fechada') DEFAULT 'aberta',
    data_publicacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    
    id_empresa INT NOT NULL,
    
    CONSTRAINT fk_vaga_empresa
    FOREIGN KEY (id_empresa) REFERENCES empresas(id_empresa)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- TABELA INSCRIÇÃO
CREATE TABLE inscricao (
    id_inscricao INT AUTO_INCREMENT PRIMARY KEY,
    data_inscricao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    id_pessoa INT NOT NULL,
    id_vaga INT NOT NULL,
    
    CONSTRAINT fk_inscricao_pessoa
    FOREIGN KEY (id_pessoa) REFERENCES pessoas(id_pessoa),
    
    CONSTRAINT fk_inscricao_vaga
    FOREIGN KEY (id_vaga) REFERENCES vagas(id_vaga),
    
    UNIQUE (id_pessoa, id_vaga)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `usuarios` VALUES
(1,'davi001@gmail.com','Davi12340987','pessoa','2026-03-12 19:43:00'),
(2,'dellsac@gmail.com','Dell574839','empresa','2026-03-12 19:43:00'),
(3,'pedrovieira98@gmail.com','pedrinho6767','pessoa','2026-03-12 19:43:00');

INSERT INTO `pessoas` VALUES
(1,'Davi','12345678910','19998745263','fiec','gastronomia',1),
(2,'Rael','78945612320','21996547812','senai','mecanica',2),
(3,'Luiza','20093350740','19993792956','senac','engenharia',3);

INSERT INTO `empresas` VALUES 
(1,'FIEC','54675103000180','1938018688','Indaiatuba-SP','',1),
(2,'SENAI','3810810000100','2733345200','Vitória-ES','',2),
(3,'Objetivo','66996232000230','1938258801','Indaiatuba','',3);

INSERT INTO `vagas` VALUES 
(1,'Estagiário de Informática','Auxiliar na manutenção de computadores e suporte básico aos usuários','estagio',1.00,'Indaiatuba','aberta','2026-03-12 20:06:57',1),
(2,'Aprendiz Administrativo','Ajudar na organização de documentos e digitar informações no sistema','aprendiz',750.00,'Vitoria','aberta','2026-03-12 20:06:57',2),
(3,'Estagiário de suporte TI','Apoiar na resolução de problemas simples de informática e configuração de impressoras','estagio',1.20,'Indaiatuba','aberta','2026-03-12 20:06:57',3);

INSERT INTO `inscricao` VALUES 
(1,'2026-03-12 20:10:00',1,1),
(2,'2026-03-12 20:15:00',2,2),
(3,'2026-03-12 20:20:00',3,3);

