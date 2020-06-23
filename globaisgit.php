<?php
//Local onde vai ficar algumas variáveis globais, que possam ser acessadas e alteradas em qualquer parte do sistema.

// Definir e mostrar os erros da aplicação. True = Quando estiver em modelagem. False = Quando for entregar.
putenv('DISPLAY_ERROS_DATAILS='. false);// False para não mostrar os erros da aplicação

//Ligação com o banco de dados
putenv('GERENCIADOR_DE_LOJAS_MYSQL_HOST='); //host
putenv('GERENCIADOR_DE_LOJAS_MYSQL_DBNAME='); //nome do banco
putenv('GERENCIADOR_DE_LOJAS_MYSQL_USER='); //usuário que é root
putenv('GERENCIADOR_DE_LOJAS_MYSQL_PASSWORD'); //Ainda não definida
putenv('GERENCIADOR_DE_LOJAS_MYSQL_PORT='); //Porta de acesso
//JWT
putenv('JWT_SECRET_KEY='); //Chave secreta k...