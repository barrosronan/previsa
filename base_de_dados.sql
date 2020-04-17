create schema empresa default character set utf8;
use empresa;

create table Funcionario(
	CodFuncionario int not null primary key AUTO_INCREMENT,
    Nome varchar(400) not null,
    DataNascimento datetime not null,
    Salario numeric(18,2) not null,
    Atividades varchar(21437) not null
);

create table FuncionarioFilho(
	CodFuncionarioFilho int not null primary key auto_increment,
    CodFuncionario int not null,
    Nome varchar(400),
    DataDeNascimento datetime not null,
    constraint fk_codFuncionario foreign key (CodFuncionario) references Funcionario(CodFuncionario)
);
