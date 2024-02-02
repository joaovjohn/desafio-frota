Projeto Frota de Veiculos
=======================
------------
Utilizando Zend Framework 2, Doctrine2, JQuery e outros recursos de sua preferência. Desenvolva
um pequeno projeto que deve conter as seguintes telas:
   CRUD de Veículos (listar, cadastrar, editar e remover) com os seguintes campos:
      - Placa 
      - Renavam
      - Modelo
      - Marca
      - Ano
      - Cor
   CRUD de Motoristas (listar, cadastrar, editar e remover);
      - Nome
      - RG
      - CPF
      - Telefone
      - Veículo

BONUS: Criar uma tela com um mapa utilizando Google Maps e inserir dentro do mapa alguns
Markers com InfoWindows contendo Placa do veículo e Nome do motorista (Dados fixos no
código).

Dependendo da versão do PHP, pode ser necessário realizar o downgrade da versão para o projeto funcionar.

Necessário fazer a vinculação manualmente criando o arquivo doctrine_orm.local.php na pasta config/autoload:
Os comandos sql's para a criação da base de dados estão no arquivo "/data/app/data.sql".

Para rodar a aplicação, basta rodar o comando:

    php -S 0.0.0.0:8080 -t public/ public/index.php
