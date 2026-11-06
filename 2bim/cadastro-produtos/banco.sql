-- Rode uma vez no MySQL: mysql -u root -p < banco.sql
CREATE DATABASE IF NOT EXISTS loja CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE loja;

CREATE TABLE IF NOT EXISTS produtos (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nome       VARCHAR(100)  NOT NULL,
    categoria  VARCHAR(60)   NOT NULL,
    preco      DECIMAL(10,2) NOT NULL,
    quantidade INT           NOT NULL
);
