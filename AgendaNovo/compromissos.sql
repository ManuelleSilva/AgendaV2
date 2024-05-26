CREATE DATABASE compromissos;
USE compromissos;

CREATE TABLE eventos (
    id INT(5) NOT NULL AUTO_INCREMENT,
    nome_evento VARCHAR(255),
    data_evento DATE,
    hora_inicio TIME,
    hora_fim TIME,
    descricao VARCHAR(255),
    local_evento VARCHAR(255),
    responsavel VARCHAR(255),
    PRIMARY KEY (id)
);

CREATE TABLE  tb_dados (
  nome varchar(50) NOT NULL,
  senha varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

insert into tb_dados (nome,senha) values ("Manu","Manu");


select * from tb_dados;


CREATE TABLE arquivo (
  codigo int(11) NOT NULL,
  arquivo varchar(100) NOT NULL,
  data_foto datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE arquivo
  ADD PRIMARY KEY (codigo);

--
-- AUTO_INCREMENT de tabela arquivo
--
ALTER TABLE arquivo
  MODIFY codigo int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


select * from arquivo;