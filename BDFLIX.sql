-- Gera��o de Modelo f�sico
-- Sql ANSI 2003 - brModelo.



CREATE TABLE Genero (
idGenero INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(50)
);

CREATE TABLE Serie (
idSerie INT PRIMARY KEY,
pesquisas INT,
faixa INT,
nome VARCHAR(50),
timestamp TIMESTAMP,
capa VARCHAR(255),
trailer VARCHAR(255)
);

CREATE TABLE Preferencia (
idGenero INT,
idPerfil INT,
PRIMARY KEY(idGenero,idPerfil),
FOREIGN KEY(idGenero) REFERENCES Genero (idGenero)
);

CREATE TABLE GeneroSerie (
idGenero INT,
idSerie INT,
PRIMARY KEY(idGenero,idSerie),
FOREIGN KEY(idGenero) REFERENCES Genero (idGenero),
FOREIGN KEY(idSerie) REFERENCES Serie (idSerie)
);

CREATE TABLE Filme (
idMidia INT PRIMARY KEY,
faixa INT,
trailer VARCHAR(255),
pesquisas INT,
timestamp TIMESTAMP,
capa VARCHAR(255)
);

CREATE TABLE GeneroFilme (
idGenero INT,
idFilme INT,
PRIMARY KEY(idGenero,idFilme),
FOREIGN KEY(idGenero) REFERENCES Genero (idGenero),
FOREIGN KEY(idFilme) REFERENCES Filme (idMidia)
);

CREATE TABLE MidiasList (
id INT,
idList INT,
PRIMARY KEY(id,idList)
);

CREATE TABLE Midia (
idMidia INT PRIMARY KEY AUTO_INCREMENT,
duracao INT,
titulo VARCHAR(50),
tipo BOOL
);

CREATE TABLE Historico (
idPerfil INT,
idMidia INT,
contador INT,
PRIMARY KEY(idPerfil,idMidia),
FOREIGN KEY(idMidia) REFERENCES Midia (idMidia) 
);

CREATE TABLE Perfil (
idPerfil INT PRIMARY KEY AUTO_INCREMENT,
idCliente INT,
nome VARCHAR(50) UNIQUE,
senha VARCHAR(50),
ftPerfil VARCHAR(255),
idade INT
);

CREATE TABLE Plano (
idPlano INT PRIMARY KEY AUTO_INCREMENT,
nomePlano VARCHAR(50),
qtdPerfis INT,
valor FLOAT
);

CREATE TABLE SegueList (
idPerfil INT,
idList INT,
PRIMARY KEY(idPerfil,idList),
FOREIGN KEY(idPerfil) REFERENCES Perfil (idPerfil) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Cliente (
idCliente INT PRIMARY KEY AUTO_INCREMENT,
user VARCHAR(50) UNIQUE,
nome VARCHAR(50),
cpf BIGINT,
email VARCHAR(50),
senha CHAR(32),
nCartao VARCHAR(20),
codCartao INT,
valCartao DATE,
estado VARCHAR(3),
cidade VARCHAR(50),
bairro VARCHAR(50),
rua VARCHAR(50),
numero INT,
complemento VARCHAR(100),
idPlano INT,
FOREIGN KEY(idPlano) REFERENCES Plano (idPlano) ON UPDATE CASCADE
);

CREATE TABLE Fatura (
nFat INT PRIMARY KEY AUTO_INCREMENT,
dataIni DATE,
dataFim DATE,
paga BOOL,
valor FLOAT,
idCliente INT,
FOREIGN KEY(idCliente) REFERENCES Cliente (idCliente)
);

CREATE TABLE Movielist (
idList INT PRIMARY KEY AUTO_INCREMENT,
idCriador INT,
nome VARCHAR(50),
descricao VARCHAR(100),
publica BOOL,
seguidores INT,
FOREIGN KEY(idCriador) REFERENCES Perfil (idPerfil) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Descricao (
id INT,
idIdioma INT,
descricao VARCHAR(200),
PRIMARY KEY(id,idIdioma),
FOREIGN KEY(id) REFERENCES Midia (idMidia)
);

CREATE TABLE Episodio (
idSerie INT,
idMidia INT,
temporada INT,
episodio INT,
trailer VARCHAR(255),
PRIMARY KEY(idSerie,idMidia),
FOREIGN KEY(idSerie) REFERENCES Serie (idSerie),
FOREIGN KEY(idMidia) REFERENCES Midia (idMidia)
);

CREATE TABLE admin(
idAdmin INT PRIMARY KEY AUTO_INCREMENT,
user VARCHAR(50),
senha CHAR(32)
);

ALTER TABLE Preferencia ADD FOREIGN KEY(idPerfil) REFERENCES Perfil (idPerfil) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Filme ADD FOREIGN KEY(idMidia) REFERENCES Midia (idMidia);
ALTER TABLE MidiasList ADD FOREIGN KEY(id) REFERENCES Midia (idMidia);
ALTER TABLE MidiasList ADD FOREIGN KEY(idList) REFERENCES Movielist (idList) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Historico ADD FOREIGN KEY(idPerfil) REFERENCES Perfil (idPerfil) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Perfil ADD FOREIGN KEY(idCliente) REFERENCES Cliente (idCliente);
ALTER TABLE SegueList ADD FOREIGN KEY(idList) REFERENCES Movielist (idList) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Genero AUTO_INCREMENT = 0;
ALTER TABLE Midia AUTO_INCREMENT = 0;
ALTER TABLE Perfil AUTO_INCREMENT = 0;
ALTER TABLE Plano AUTO_INCREMENT = 0;
ALTER TABLE Cliente AUTO_INCREMENT = 0;
ALTER TABLE Fatura AUTO_INCREMENT = 0;
ALTER TABLE Movielist AUTO_INCREMENT = 0;
