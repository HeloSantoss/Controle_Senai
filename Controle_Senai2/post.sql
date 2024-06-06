CREATE TABLE cadastro_itens (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100),
    quantidade INT,
    preco NUMERIC(10,2)
);

CREATE TABLE solic_itens (
    id SERIAL PRIMARY KEY,
    nome_item VARCHAR(100),
    quantidade INT,
    destino VARCHAR(100)
);

CREATE TYPE tipo_bloco AS ENUM ('A', 'B', 'C');

CREATE TABLE cadas_blocos (
    id SERIAL PRIMARY KEY,
    bloco tipo_bloco,
    sala VARCHAR(100)
);

CREATE TABLE patrimonio (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    valor DECIMAL(10, 2),
    data_aquisicao DATE,
    localizacao VARCHAR(255),
    estado VARCHAR(50)
);

CREATE TABLE blocos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(1) NOT NULL
);

CREATE TABLE salas (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    bloco_id INT REFERENCES blocos(id)
);

CREATE TABLE patrimonio (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    descricao TEXT,
    valor DECIMAL(10, 2),
    data_aquisicao DATE,
    sala_id INT REFERENCES salas(id),
    estado VARCHAR(50)
);


INSERT INTO blocos (nome) VALUES ('A'), ('B'), ('C'), ('D');


