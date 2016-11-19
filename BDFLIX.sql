-- Gera��o de Modelo f�sico
-- Sql ANSI 2003 - brModelo.



CREATE TABLE Genero (
idGenero INT PRIMARY KEY,
nome VARCHAR(50)
);

CREATE TABLE Serie (
idSerie INT PRIMARY KEY,
pesquisas INT,
faixa INT,
nome VARCHAR(50)
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
pesquisas INT
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
idMidia INT PRIMARY KEY,
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
idPerfil INT PRIMARY KEY,
idCliente INT,
nome VARCHAR(50),
senha VARCHAR(50),
ftPerfil VARCHAR(255),
idade INT
);

CREATE TABLE Plano (
idPlano INT PRIMARY KEY,
nomePlano VARCHAR(50),
qtdPerfis INT,
valor FLOAT
);

CREATE TABLE SegueList (
idPerfil INT,
idList INT,
PRIMARY KEY(idPerfil,idList),
FOREIGN KEY(idPerfil) REFERENCES Perfil (idPerfil)
);

CREATE TABLE Cliente (
idCliente INT PRIMARY KEY,
user VARCHAR(50),
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
FOREIGN KEY(idPlano) REFERENCES Plano (idPlano)
);

CREATE TABLE Fatura (
nFat INT PRIMARY KEY,
dataIni DATE,
dataFim DATE,
paga BOOL,
valor FLOAT,
idCliente INT,
FOREIGN KEY(idCliente) REFERENCES Cliente (idCliente)
);

CREATE TABLE Movielist (
idList INT PRIMARY KEY,
idCriador INT,
nome VARCHAR(50),
descricao VARCHAR(100),
publica BOOL,
FOREIGN KEY(idCriador) REFERENCES Perfil (idPerfil)
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
PRIMARY KEY(idSerie,idMidia),
FOREIGN KEY(idSerie) REFERENCES Serie (idSerie),
FOREIGN KEY(idMidia) REFERENCES Midia (idMidia)
);

ALTER TABLE Preferencia ADD FOREIGN KEY(idPerfil) REFERENCES Perfil (idPerfil);
ALTER TABLE Filme ADD FOREIGN KEY(idMidia) REFERENCES Midia (idMidia);
ALTER TABLE MidiasList ADD FOREIGN KEY(id) REFERENCES Midia (idMidia);
ALTER TABLE MidiasList ADD FOREIGN KEY(idList) REFERENCES Movielist (idList);
ALTER TABLE Historico ADD FOREIGN KEY(idPerfil) REFERENCES Perfil (idPerfil);
ALTER TABLE Perfil ADD FOREIGN KEY(idCliente) REFERENCES Cliente (idCliente);
ALTER TABLE SegueList ADD FOREIGN KEY(idList) REFERENCES Movielist (idList);
