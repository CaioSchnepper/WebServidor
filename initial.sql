CREATE DATABASE webservidor;

USE webservidor;

CREATE TABLE Feedback (
  id INT PRIMARY KEY AUTO_INCREMENT,
  titulo VARCHAR(255),
  descricao VARCHAR(255),
  tipo VARCHAR(255),
  status VARCHAR(255)
);