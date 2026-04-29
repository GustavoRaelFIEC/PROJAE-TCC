
-- CRIAR BANCO
CREATE DATABASE IF NOT EXISTS projae
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
USE projae;


-- TABELA USUARIOS (LOGIN)
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('pessoa','empresa') NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- TABELA PESSOAS
CREATE TABLE IF NOT EXISTS pessoas (
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
CREATE TABLE IF NOT EXISTS empresas (
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
CREATE TABLE IF NOT EXISTS vagas (
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
CREATE TABLE IF NOT EXISTS inscricao (
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

INSERT IGNORE INTO `usuarios` VALUES
(1,'devPessoa@gmail.com','$2y$10$wH8Q8Q6YQJ2VQ0Qk5GxY8e8d2uY0lYQv6u5hQ2u6c3YQfQe6Q9Q0K','pessoa','2026-03-12 19:43:00'),
(2,'devEmpresa@gmail.com','$2y$10$wH8Q8Q6YQJ2VQ0Qk5GxY8e8d2uY0lYQv6u5hQ2u6c3YQfQe6Q9Q0K','empresa','2026-03-12 19:43:00');


INSERT IGNORE INTO `pessoas` VALUES
(1,'devPessoa','12345678910','19998745263','fiec','informatica',1);



INSERT IGNORE INTO `empresas` VALUES 
(1,'devEmpresa','54675103000180','1938018688','Indaiatuba-SP', 1);


INSERT IGNORE INTO `vagas` VALUES 
(1,'Estagiário de Informática','Auxiliar na manutenção de computadores e suporte básico aos usuários','estagio',1.00,'Indaiatuba','aberta','2026-03-12 20:06:57',1),
(2,'Aprendiz Administrativo','Ajudar na organização de documentos e digitar informações no sistema','aprendiz',750.00,'Vitoria','aberta','2026-03-12 20:06:57',1);


INSERT IGNORE INTO `inscricao` VALUES 
(1,'2026-03-12 20:10:00',1,1),
(2,'2026-03-12 20:15:00',2,2);


