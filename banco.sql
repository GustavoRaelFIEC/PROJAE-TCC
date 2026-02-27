
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