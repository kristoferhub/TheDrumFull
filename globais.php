<?php
//Local onde vai ficar algumas variáveis globais, que possam ser acessadas e alteradas em qualquer parte do sistema.

// Definir e mostrar os erros da aplicação. True = Quando estiver em modelagem. False = Quando for entregar.
putenv('DISPLAY_ERROS_DATAILS='. true);

//Ligação com o banco de dados para lojas
putenv('GERENCIADOR_DE_LOJAS_MYSQL_HOST=localhost'); //host
putenv('GERENCIADOR_DE_LOJAS_MYSQL_DBNAME=gerenciador_de_lojas'); //nome do banco
putenv('GERENCIADOR_DE_LOJAS_MYSQL_USER=root'); //usuário que é root
putenv('GERENCIADOR_DE_LOJAS_MYSQL_PASSWORD'); //Ainda não definida
putenv('GERENCIADOR_DE_LOJAS_MYSQL_PORT=3306'); //Porta de acesso
//JWT
putenv('JWT_SECRET_KEY=ApMo8ah2eQCT3cPEQs-11XDg1vCJ9wYIxUUrf_1ASxg'); //Chave secreta k...nome