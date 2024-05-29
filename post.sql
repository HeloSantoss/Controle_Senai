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

