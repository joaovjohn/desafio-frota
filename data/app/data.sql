create database frota;

CREATE TABLE veiculos (
    id int auto_increment PRIMARY KEY,
    placa varchar(7) not null,
    renavam varchar(30),
    modelo varchar(20) not null,
    marca varchar(20) not null,
    ano int not null,
    cor varchar(20) not null
);

CREATE TABLE motoristas (
    id int auto_increment primary key,
    nome varchar(200) not null,
    rg varchar(20) not null,
    cpf varchar(11) not null unique ,
    telefone varchar(20),
    veiculoID int,
    foreign key (veiculoID) references veiculos(id)
);