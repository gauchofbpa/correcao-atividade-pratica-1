CREATE DATABASE pratica_1_gaucho;
USE pratica_1_gaucho;

CREATE TABLE cliente (
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(200) NOT NULL,
	email VARCHAR (200) UNIQUE NOT NULL,
    telefone CHAR (18) NOT NULL
);

CREATE TABLE colaborador (
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(200) NOT NULL,
	email VARCHAR (200) UNIQUE NOT NULL,
    telefone CHAR (18) NOT NULL
);

CREATE TABLE chamado (
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,	
    descricao TEXT NOT NULL,
    criticidade VARCHAR(5) NOT NULL,
    status_chamado VARCHAR(15) NOT NULL,
    data_abertura TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
	id_cliente INT NOT NULL,
    FOREIGN KEY(id_cliente) REFERENCES cliente (id),
	id_colaborador INT NOT NULL,
    FOREIGN KEY(id_colaborador) REFERENCES colaborador (id)
);